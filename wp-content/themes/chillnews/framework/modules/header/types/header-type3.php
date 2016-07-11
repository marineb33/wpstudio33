<?php
namespace ChillNewsNamespace\Modules\Header\Types;

use ChillNewsNamespace\Modules\Header\Lib\HeaderType;
/**
 * Class that represents Header Type 1 layout and option
 *
 * Class HeaderType3
 */
class HeaderType3 extends HeaderType {

    /**
     * Sets slug property which is the same as value of option in DB
     */
    public function __construct() {
        $this->slug = 'header-type3';

        if(!is_admin()) {
            $logoAreaHeight       = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('logo_area_height_header_type3'));
            $this->logoAreaHeight = $logoAreaHeight !== '' ? chillnews_mikado_filter_px($logoAreaHeight) : 132;

            $menuAreaHeight       = chillnews_mikado_filter_px(chillnews_mikado_options()->getOptionValue('menu_area_height_header_type3'));
            $this->menuAreaHeight = $menuAreaHeight !== '' ? $menuAreaHeight : 42;

            add_filter('chillnews_mikado_js_global_variables', array($this, 'getGlobalJSVariables'));
        }
    }

    /**
     * Loads template file for this header type
     *
     * @param array $parameters associative array of variables that needs to passed to template
     */
    public function loadTemplate($parameters = array()) {

        $parameters['bottom_header_area_in_grid'] = chillnews_mikado_options()->getOptionValue('bottom_header_area_in_grid') == 'yes' ? true : false;

        $parameters = apply_filters('chillnews_mikado_header_type3_parameters', $parameters);

        chillnews_mikado_get_module_template_part('templates/types/'.$this->slug, $this->moduleName, '', $parameters);
    }

    /**
     * Returns global js variables of header
     *
     * @param $globalVariables
     * @return int|string
     */
    public function getGlobalJSVariables($globalVariables) {
        $globalVariables['mkdfLogoAreaHeight'] = $this->logoAreaHeight;
        $globalVariables['mkdfMenuAreaHeight'] = $this->menuAreaHeight;

        return $globalVariables;
    }
}