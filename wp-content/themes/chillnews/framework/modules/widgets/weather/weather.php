<?php

/**
 * Widget that adds weather type
 *
 * Class Weather_Widget
 */
class ChillNewsWeatherWidget extends ChillNewsWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_weather_widget', // Base ID
            'Mikado Weather Widget' // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $app_link = 'http://openweathermap.org/appid#get';
        $app_location = 'http://openweathermap.org/find';

        $this->params = array(
            array(
                'type' => 'textfield',
                'title' => 'Widget Title',
                'name' => 'widget_title'
            ),
            array(
                'type' => 'textfield_html',
                'title' => 'API Key',
                'name' => 'api_key',
                'description' => '<a href="'.esc_url($app_link).'" target="_blank">How to get API key</a>'
            ),
            array(
                'type' => 'textfield_html',
                'title' => 'Location',
                'name' => 'location',
                'description' => '<a href="'.esc_url($app_location).'" target="_blank">Find Your Location (i.e: London,UK or New York City,NY)</a>'
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {

        extract($args);

        $api_key = '';
        if (!empty($instance['api_key']) && $instance['api_key'] !== '') {
            $api_key = $instance['api_key'];
        }
        
        $location = '';
        if (!empty($instance['location']) && $instance['location'] !== '') {
            $location = $instance['location'];
        }

        print $args['before_widget'];
        if (!empty($instance['widget_title']) && $instance['widget_title'] !== '') {
            print $args['before_title'].$instance['widget_title'].$args['after_title'];
        }
        echo chillnews_mikado_weather_widget_logic(
            array( 
                'api_key' => $api_key, 
                'location' => $location
                )
            );
        print $args['after_widget'];
    }
}

/* Based on - Awesome Weather Widget https://halgatewood.com/freebies/awesome-weather-widget */
// THE LOGIC
function chillnews_mikado_weather_widget_logic( $atts ) {

    $rtn             = "";
    $weather_data    = array();
    $api_key         = isset($atts['api_key']) ? $atts['api_key'] : false;
    $location        = isset($atts['location']) ? $atts['location'] : false;
    $units           = 'metric';
    $units_display   = 'C';
    $days_to_show    = 5;
    $locale          = 'en';

    $sytem_locale = get_locale();
    $available_locales = array( 'en', 'es', 'sp', 'fr', 'it', 'de', 'pt', 'ro', 'pl', 'ru', 'uk', 'ua', 'fi', 'nl', 'bg', 'sv', 'se', 'ca', 'tr', 'hr', 'zh', 'zh_tw', 'zh_cn', 'hu' ); 
    
    // CHECK FOR LOCALE
    if( in_array( $sytem_locale, $available_locales ) ) $locale = $sytem_locale;
    
    // CHECK FOR LOCALE BY FIRST TWO DIGITS
    if( in_array(substr($sytem_locale, 0, 2), $available_locales ) ) $locale = substr($sytem_locale, 0, 2);

    // NO LOCATION, ABORT ABORT!!!1!
    if( !$location ) { return chillnews_mikado_weather_widget_error(); }
    
    //FIND AND CACHE CITY ID
    if(is_numeric($location)) {
        $city_name_slug = sanitize_title( $location );;
        $api_query      = "id=" . $location;
    } else {
        $city_name_slug = sanitize_title( $location );
        $api_query      = "q=" . $location;
    }
    
    // TRANSIENT NAME
    $weather_transient_name  = 'mkdf_' . $city_name_slug . "_" . $days_to_show . "_" . $units . '_' . $locale;

    // GET WEATHER DATA
    if(get_transient($weather_transient_name)) {
        $weather_data = get_transient( $weather_transient_name );
    } else {
        $weather_data['now'] = array();
        $weather_data['forecast'] = array();
        
        // NOW
        $now_ping = "http://api.openweathermap.org/data/2.5/weather?" . $api_query . "&lang=" . $locale . "&units=" . $units ."&APPID=". $api_key;
        $now_ping = str_replace(" ", "", $now_ping);
        $now_ping_get = wp_remote_get($now_ping);
    
        // PING URL ERROR
        if( is_wp_error( $now_ping_get ) )  return chillnews_mikado_weather_widget_error( $now_ping_get->get_error_message()  );

        // GET BODY OF REQUEST
        $city_data = json_decode( $now_ping_get['body'] );
        
        if( isset($city_data->cod) AND $city_data->cod == 404) {
            return chillnews_mikado_weather_widget_error($city_data->message);
        } else {
            $weather_data['now'] = $city_data;
        }
        
        // FORECAST
        $forecast_ping = "http://api.openweathermap.org/data/2.5/forecast/daily?" . $api_query . "&lang=" . $locale . "&units=" . $units ."&cnt=7&APPID=".$api_key;
        $forecast_ping = str_replace(" ", "", $forecast_ping);
        $forecast_ping_get = wp_remote_get($forecast_ping);
    
        if(is_wp_error($forecast_ping_get)) {
            return chillnews_mikado_weather_widget_error($forecast_ping_get->get_error_message());
        }   
        
        $forecast_data = json_decode( $forecast_ping_get['body'] );
        
        if( isset($forecast_data->cod) AND $forecast_data->cod == 404) {
            return chillnews_mikado_weather_widget_error($forecast_data->message);
        } else {
            $weather_data['forecast'] = $forecast_data;
        } 
        
        if($weather_data['now'] OR $weather_data['forecast']) {
            // SET THE TRANSIENT, CACHE FOR A LITTLE OVER THREE HOURS
            set_transient( $weather_transient_name, $weather_data, apply_filters( 'chillnews_mikado_weather_cache', 1800 ) );
        }
    }

    // NO WEATHER
    if( !$weather_data OR !isset($weather_data['now'])) { return chillnews_mikado_weather_widget_error(); }
    
    // TODAYS TEMPS
    $today          = $weather_data['now'];
    $today_temp     = round($today->main->temp);
    $today_high     = round($today->main->temp_max);
    $today_low      = round($today->main->temp_min);

    // DATA
    $header_title = $today->name;
    
    $today->main->humidity = round($today->main->humidity);
    $today->wind->speed    = round($today->wind->speed);
    
    $wind_label = array ( esc_html__('N', 'chillnews'), esc_html__('NNE', 'chillnews'), esc_html__('NE', 'chillnews'), esc_html__('ENE', 'chillnews'), esc_html__('E', 'chillnews'), esc_html__('ESE', 'chillnews'), esc_html__('SE', 'chillnews'), esc_html__('SSE', 'chillnews'), esc_html__('S', 'chillnews'), esc_html__('SSW', 'chillnews'), esc_html__('SW', 'chillnews'), esc_html__('WSW', 'chillnews'), esc_html__('W', 'chillnews'), esc_html__('WNW', 'chillnews'), esc_html__('NW', 'chillnews'), esc_html__('NNW', 'chillnews') );
                        
    $wind_direction = $wind_label[fmod((($today->wind->deg + 11) / 22.5),16)];

    $holder_class = '';
    if(!empty($today->weather[0]->description) && $today->weather[0]->description !== ''){
        $holder_class = 'mkdf-desc-'.sanitize_title($today->weather[0]->description);
    }

    // DISPLAY WIDGET   
    $rtn .= '<div class="mkdf-weather-widget-holder '.$holder_class.'">
        <div class="mkdf-weather-information">
            <div class="mkdf-weather-today-temp">
                <div class="mkdf-weather-today-temp-inner"><span>'.$today_temp.'<sup>'.esc_html__('C' ,'chillnews').'</sup></span></div>
            </div>
            <div class="mkdf-weather-todays-stats">
                <div class="mkdf-weather-todays-location">'.$today->name.'</div>
                <div class="mkdf-weather-todays-description">'.$today->weather[0]->description.'</div>
                <div class="mkdf-weather-todays-humidty">'.esc_html__('humidity: ' ,'chillnews') . $today->main->humidity . esc_html__('%' ,'chillnews').'</div>
                <div class="mkdf-weather-todays-wind">'.esc_html__('wind: ' ,'chillnews') . $today->wind->speed . esc_html__(' m/s ' ,'chillnews') . $wind_direction.'</div>
                <div class="mkdf-weather-todays-highlow">'.esc_html__('H' ,'chillnews') . $today_high.' &bull; ' . esc_html__('L' ,'chillnews') . $today_low.'</div>
            </div>
        </div>
        <div class="mkdf-weather-forecast">
        ';
        $c = 1;
        $dt_today = date( 'Ymd', current_time( 'timestamp', 0 ) );
        $forecast = $weather_data['forecast'];
        $days_to_show = 5;
        
        foreach((array) $forecast->list as $forecast) {
            if( $dt_today >= date('Ymd', $forecast->dt)) continue;
            $days_of_week = array( esc_html__('Sun' ,'chillnews'), esc_html__('Mon' ,'chillnews'), esc_html__('Tue' ,'chillnews'), esc_html__('Wed' ,'chillnews'), esc_html__('Thu' ,'chillnews'), esc_html__('Fri' ,'chillnews'), esc_html__('Sat' ,'chillnews') );
            
            $forecast->temp = (int) $forecast->temp->day;
            $day_of_week = $days_of_week[ date('w', $forecast->dt) ];
            $rtn .= '
                <div class="mkdf-weather-forecast-day">
                    <div class="mkdf-weather-forecast-day-temp">'.$forecast->temp.'<sup>'.esc_html__('C' ,'chillnews').'</sup></div>
                    <div class="mkdf-weather-forecast-day-abbr">'.$day_of_week.'</div>
                </div>
            ';
            if($c == $days_to_show) break;
            $c++;
        }

        $rtn .= '</div>
    </div>
    ';

    return $rtn;
}

// RETURN ERROR
function chillnews_mikado_weather_widget_error($msg = false) {

    if(!$msg) {
       $msg = esc_html__('No weather information available', 'chillnews');
    } 
    
    return $msg;
}