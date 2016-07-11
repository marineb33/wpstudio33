<?php

/*
   Interface: iChillNewsInterfaceLayoutNode
   A interface that implements Layout Node methods
*/
interface iChillNewsInterfaceLayoutNode
{
	public function hasChidren();
	public function getChild($key);
	public function addChild($key, $value);
}

/*
   Interface: iChillNewsInterfaceRender
   A interface that implements Render methods
*/
interface iChillNewsInterfaceRender
{
	public function render($factory);
}

/*
   Class: ChillNewsPanel
   A class that initializes Mikado Panel
*/
class ChillNewsPanel implements iChillNewsInterfaceLayoutNode, iChillNewsInterfaceRender {

	public $children;
	public $title;
	public $name;
	public $hidden_property;
	public $hidden_value;
	public $hidden_values;

	function __construct($title="",$name="",$hidden_property="",$hidden_value="",$hidden_values=array()) {
		$this->children = array();
		$this->title = $title;
		$this->name = $name;
		$this->hidden_property = $hidden_property;
		$this->hidden_value = $hidden_value;
		$this->hidden_values = $hidden_values;
	}

	public function hasChidren() {
		return (count($this->children) > 0)?true:false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) {
		$hidden = false;
		if (!empty($this->hidden_property)){
			if (chillnews_mikado_option_get_value($this->hidden_property)==$this->hidden_value)
				$hidden = true;
			else {
				foreach ($this->hidden_values as $value) {
					if (chillnews_mikado_option_get_value($this->hidden_property)==$value)
						$hidden = true;

				}
			}
		}
		?>
		<div class="mkdf-page-form-section-holder" id="mkdf_<?php echo esc_attr($this->name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<h3 class="mkdf-page-section-title"><?php echo esc_html($this->title); ?></h3>
			<?php
			foreach ($this->children as $child) {
				$this->renderChild($child, $factory);
			}
			?>
		</div>
	<?php
	}

	public function renderChild(iChillNewsInterfaceRender $child, $factory) {
		$child->render($factory);
	}
}

/*
   Class: ChillNewsContainer
   A class that initializes Mikado Container
*/
class ChillNewsContainer implements iChillNewsInterfaceLayoutNode, iChillNewsInterfaceRender {

	public $children;
	public $name;
	public $hidden_property;
	public $hidden_value;
	public $hidden_values;

	function __construct($name="",$hidden_property="",$hidden_value="",$hidden_values=array()) {
		$this->children = array();
		$this->name = $name;
		$this->hidden_property = $hidden_property;
		$this->hidden_value = $hidden_value;
		$this->hidden_values = $hidden_values;
	}

	public function hasChidren() {
		return (count($this->children) > 0)?true:false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) {
		$hidden = false;
		if (!empty($this->hidden_property)){
			if (chillnews_mikado_option_get_value($this->hidden_property)==$this->hidden_value)
				$hidden = true;
			else {
				foreach ($this->hidden_values as $value) {
					if (chillnews_mikado_option_get_value($this->hidden_property)==$value)
						$hidden = true;

				}
			}
		}
		?>
		<div class="mkdf-page-form-container-holder" id="mkdf_<?php echo esc_attr($this->name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<?php
			foreach ($this->children as $child) {
				$this->renderChild($child, $factory);
			}
			?>
		</div>
	<?php
	}

	public function renderChild(iChillNewsInterfaceRender $child, $factory) {
		$child->render($factory);
	}
}


/*
   Class: ChillNewsContainerNoStyle
   A class that initializes Mikado Container without css classes
*/
class ChillNewsContainerNoStyle implements iChillNewsInterfaceLayoutNode, iChillNewsInterfaceRender {

	public $children;
	public $name;
	public $hidden_property;
	public $hidden_value;
	public $hidden_values;

	function __construct($name="",$hidden_property="",$hidden_value="",$hidden_values=array()) {
		$this->children = array();
		$this->name = $name;
		$this->hidden_property = $hidden_property;
		$this->hidden_value = $hidden_value;
		$this->hidden_values = $hidden_values;
	}

	public function hasChidren() {
		return (count($this->children) > 0)?true:false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) {
		$hidden = false;
		if (!empty($this->hidden_property)){
			if (chillnews_mikado_option_get_value($this->hidden_property)==$this->hidden_value)
				$hidden = true;
			else {
				foreach ($this->hidden_values as $value) {
					if (chillnews_mikado_option_get_value($this->hidden_property)==$value)
						$hidden = true;

				}
			}
		}
		?>
		<div id="mkdf_<?php echo esc_attr($this->name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<?php
			foreach ($this->children as $child) {
				$this->renderChild($child, $factory);
			}
			?>
		</div>
	<?php
	}

	public function renderChild(iChillNewsInterfaceRender $child, $factory) {
		$child->render($factory);
	}
}

/*
   Class: ChillNewsGroup
   A class that initializes Mikado Group
*/
class ChillNewsGroup implements iChillNewsInterfaceLayoutNode, iChillNewsInterfaceRender {

	public $children;
	public $title;
	public $description;

	function __construct($title="",$description="") {
		$this->children = array();
		$this->title = $title;
		$this->description = $description;
	}

	public function hasChidren() {
		return (count($this->children) > 0)?true:false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) {
		?>

		<div class="mkdf-page-form-section">


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($this->title); ?></h4>

				<p><?php echo esc_html($this->description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->

			<div class="mkdf-section-content">
				<div class="container-fluid">
					<?php
					foreach ($this->children as $child) {
						$this->renderChild($child, $factory);
					}
					?>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php
	}

	public function renderChild(iChillNewsInterfaceRender $child, $factory) {
		$child->render($factory);
	}
}

/*
   Class: ChillNewsNotice
   A class that initializes Mikado Notice
*/
class ChillNewsNotice implements iChillNewsInterfaceRender {

	public $children;
	public $title;
	public $description;
	public $notice;
	public $hidden_property;
	public $hidden_value;
	public $hidden_values;

	function __construct($title="",$description="",$notice="",$hidden_property="",$hidden_value="",$hidden_values=array()) {
		$this->children = array();
		$this->title = $title;
		$this->description = $description;
		$this->notice = $notice;
		$this->hidden_property = $hidden_property;
		$this->hidden_value = $hidden_value;
		$this->hidden_values = $hidden_values;
	}

	public function render($factory) {
		$hidden = false;
		if (!empty($this->hidden_property)){
			if (chillnews_mikado_option_get_value($this->hidden_property)==$this->hidden_value)
				$hidden = true;
			else {
				foreach ($this->hidden_values as $value) {
					if (chillnews_mikado_option_get_value($this->hidden_property)==$value)
						$hidden = true;

				}
			}
		}
		?>

		<div class="mkdf-page-form-section"<?php if ($hidden) { ?> style="display: none"<?php } ?>>


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($this->title); ?></h4>

				<p><?php echo esc_html($this->description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->

			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="alert alert-warning">
						<?php echo esc_html($this->notice); ?>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php
	}
}

/*
   Class: ChillNewsRow
   A class that initializes Mikado Row
*/
class ChillNewsRow implements iChillNewsInterfaceLayoutNode, iChillNewsInterfaceRender {

	public $children;
	public $next;

	function __construct($next=false) {
		$this->children = array();
		$this->next = $next;
	}

	public function hasChidren() {
		return (count($this->children) > 0)?true:false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) {
		?>
		<div class="row<?php if ($this->next) echo " next-row"; ?>">
			<?php
			foreach ($this->children as $child) {
				$this->renderChild($child, $factory);
			}
			?>
		</div>
	<?php
	}

	public function renderChild(iChillNewsInterfaceRender $child, $factory) {
		$child->render($factory);
	}
}

/*
   Class: ChillNewsTitle
   A class that initializes Mikado Title
*/
class ChillNewsTitle implements iChillNewsInterfaceRender {
	private $name;
	private $title;
	public $hidden_property;
	public $hidden_values = array();

	function __construct($name="",$title="",$hidden_property="",$hidden_value="") {
		$this->title = $title;
		$this->name = $name;
		$this->hidden_property = $hidden_property;
		$this->hidden_value = $hidden_value;
	}

	public function render($factory) {
		$hidden = false;
		if (!empty($this->hidden_property)){
			if (chillnews_mikado_option_get_value($this->hidden_property)==$this->hidden_value)
				$hidden = true;
		}
		?>
		<h5 class="mkdf-page-section-subtitle" id="mkdf_<?php echo esc_attr($this->name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>><?php echo esc_html($this->title); ?></h5>
	<?php
	}
}

/*
   Class: ChillNewsField
   A class that initializes Mikado Field
*/
class ChillNewsField implements iChillNewsInterfaceRender {
	private $type;
	private $name;
	private $default_value;
	private $label;
	private $description;
	private $options = array();
	private $args = array();
	public $hidden_property;
	public $hidden_values = array();


	function __construct($type,$name,$default_value="",$label="",$description="", $options = array(), $args = array(),$hidden_property="", $hidden_values = array()) {		
		global $chillnews_mikado_global_Framework;
		$this->type = $type;
		$this->name = $name;
		$this->default_value = $default_value;
		$this->label = $label;
		$this->description = $description;
		$this->options = $options;
		$this->args = $args;
		$this->hidden_property = $hidden_property;
		$this->hidden_values = $hidden_values;
		$chillnews_mikado_global_Framework->mkdOptions->addOption($this->name,$this->default_value, $type);
	}

	public function render($factory) {
		$hidden = false;
		if (!empty($this->hidden_property)){
			foreach ($this->hidden_values as $value) {
				if (chillnews_mikado_option_get_value($this->hidden_property)==$value)
					$hidden = true;

			}
		}
		$factory->render( $this->type, $this->name, $this->label, $this->description, $this->options, $this->args, $hidden );
	}
}

/*
   Class: ChillNewsMetaField
   A class that initializes Mikado Meta Field
*/
class ChillNewsMetaField implements iChillNewsInterfaceRender {
	private $type;
	private $name;
	private $default_value;
	private $label;
	private $description;
	private $options = array();
	private $args = array();
	public $hidden_property;
	public $hidden_values = array();


	function __construct($type,$name,$default_value="",$label="",$description="", $options = array(), $args = array(),$hidden_property="", $hidden_values = array()) {
		global $chillnews_mikado_global_Framework;
		$this->type = $type;
		$this->name = $name;
		$this->default_value = $default_value;
		$this->label = $label;
		$this->description = $description;
		$this->options = $options;
		$this->args = $args;
		$this->hidden_property = $hidden_property;
		$this->hidden_values = $hidden_values;
		$chillnews_mikado_global_Framework->mkdMetaBoxes->addOption($this->name,$this->default_value);
	}

	public function render($factory) {
		$hidden = false;
		if (!empty($this->hidden_property)){
			foreach ($this->hidden_values as $value) {
				if (chillnews_mikado_option_get_value($this->hidden_property)==$value)
					$hidden = true;

			}
		}
		$factory->render( $this->type, $this->name, $this->label, $this->description, $this->options, $this->args, $hidden );
	}
}

abstract class ChillNewsFieldType {

	abstract public function render( $name, $label="",$description="", $options = array(), $args = array(), $hidden = false );

}

class ChillNewsFieldText extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		$col_width = 12;
		if(isset($args["col_width"])) {
            $col_width = $args["col_width"];
        }

        $suffix = !empty($args['suffix']) ? $args['suffix'] : false;

		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->

			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-<?php echo esc_attr($col_width); ?>">
                            <?php if($suffix) : ?>
                            <div class="input-group">
                            <?php endif; ?>
                                <input type="text"
                                    class="form-control mkdf-input mkdf-form-element"
                                    name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(htmlspecialchars(chillnews_mikado_option_get_value($name))); ?>"
                                    placeholder=""/>
                                <?php if($suffix) : ?>
                                    <div class="input-group-addon"><?php echo esc_html($args['suffix']); ?></div>
                                <?php endif; ?>
                            <?php if($suffix) : ?>
                            </div>
                            <?php endif; ?>

                        </div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php

	}

}

class ChillNewsFieldTextSimple extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {

		$suffix = !empty($args['suffix']) ? $args['suffix'] : false;

		?>


		<div class="col-lg-3" id="mkdf_<?php echo esc_attr($name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
			<?php if($suffix) : ?>
			<div class="input-group">
            <?php endif; ?>
				<input type="text"
				   class="form-control mkdf-input mkdf-form-element"
				   name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(htmlspecialchars(chillnews_mikado_option_get_value($name))); ?>"
				   placeholder=""/>
				<?php if($suffix) : ?>
					<div class="input-group-addon"><?php echo esc_html($args['suffix']); ?></div>
				<?php endif; ?>
			<?php if($suffix) : ?>
			</div>
			<?php endif; ?>
		</div>
	<?php

	}

}

class ChillNewsFieldTextArea extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		?>

		<div class="mkdf-page-form-section">


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->


			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<textarea class="form-control mkdf-form-element"
									  name="<?php echo esc_attr($name); ?>"
									  rows="5"><?php echo esc_html(htmlspecialchars(chillnews_mikado_option_get_value($name))); ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php

	}

}

class ChillNewsFieldTextAreaSimple extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		?>

		<div class="col-lg-3">
			<em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
			<textarea class="form-control mkdf-form-element"
					  name="<?php echo esc_attr($name); ?>"
					  rows="5"><?php echo esc_html(chillnews_mikado_option_get_value($name)); ?></textarea>
		</div>
	<?php

	}

}

class ChillNewsFieldColor extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->

			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<input type="text" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>" class="my-color-field"/>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php

	}

}

class ChillNewsFieldColorSimple extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $chillnews_mikado_global_options;
		?>

		<div class="col-lg-3" id="mkdf_<?php echo esc_attr($name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
			<input type="text" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>" class="my-color-field"/>
		</div>
	<?php

	}

}

class ChillNewsFieldImage extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $chillnews_mikado_global_options;
		?>

		<div class="mkdf-page-form-section">


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->

			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="mkdf-media-uploader">
								<div<?php if (!chillnews_mikado_option_has_value($name)) { ?> style="display: none"<?php } ?>
									class="mkdf-media-image-holder">
									<img src="<?php if (chillnews_mikado_option_has_value($name)) { echo esc_url(chillnews_mikado_get_attachment_thumb_url(chillnews_mikado_option_get_value($name))); } ?>" alt=""
										 class="mkdf-media-image img-thumbnail"/>
								</div>
								<div style="display: none"
									 class="mkdf-media-meta-fields">
									<input type="hidden" class="mkdf-media-upload-url"
										   name="<?php echo esc_attr($name); ?>"
										   value="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>"/>
								</div>
								<a class="mkdf-media-upload-btn btn btn-sm btn-primary"
								   href="javascript:void(0)"
								   data-frame-title="<?php esc_html_e('Select Image', 'chillnews'); ?>"
								   data-frame-button-text="<?php esc_html_e('Select Image', 'chillnews'); ?>"><?php esc_html_e('Upload', 'chillnews'); ?></a>
								<a style="display: none;" href="javascript: void(0)"
								   class="mkdf-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'chillnews'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php

	}

}

class ChillNewsFieldImageSimple extends ChillNewsFieldType {

    public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
        ?>


        <div class="col-lg-3" id="mkdf_<?php echo esc_attr($name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
            <em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
            <div class="mkdf-media-uploader">
                <div<?php if (!chillnews_mikado_option_has_value($name)) { ?> style="display: none"<?php } ?>
                    class="mkdf-media-image-holder">
                    <img src="<?php if (chillnews_mikado_option_has_value($name)) { echo esc_url(chillnews_mikado_get_attachment_thumb_url(chillnews_mikado_option_get_value($name))); } ?>" alt=""
                         class="mkdf-media-image img-thumbnail"/>
                </div>
                <div style="display: none"
                     class="mkdf-media-meta-fields">
                    <input type="hidden" class="mkdf-media-upload-url"
                           name="<?php echo esc_attr($name); ?>"
                           value="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>"/>
                </div>
                <a class="mkdf-media-upload-btn btn btn-sm btn-primary"
                   href="javascript:void(0)"
                   data-frame-title="<?php esc_html_e('Select Image', 'chillnews'); ?>"
                   data-frame-button-text="<?php esc_html_e('Select Image', 'chillnews'); ?>"><?php esc_html_e('Upload', 'chillnews'); ?></a>
                <a style="display: none;" href="javascript: void(0)"
                   class="mkdf-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'chillnews'); ?></a>
            </div>
        </div>
    <?php

    }

}

class ChillNewsFieldFont extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $chillnews_mikado_global_options;
		global $chillnews_mikado_global_fonts_array;
		?>

		<div class="mkdf-page-form-section">


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->



			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-3">
							<select class="form-control mkdf-form-element"
									name="<?php echo esc_attr($name); ?>">
								<option value="-1">Default</option>
								<?php foreach($chillnews_mikado_global_fonts_array as $fontArray) { ?>
									<option <?php if (chillnews_mikado_option_get_value($name) == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr(str_replace(' ', '+', $fontArray["family"])); ?>"><?php echo esc_html($fontArray["family"]); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php

	}

}

class ChillNewsFieldFontSimple extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $chillnews_mikado_global_options;
		global $chillnews_mikado_global_fonts_array;
		?>


		<div class="col-lg-3">
			<em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
			<select class="form-control mkdf-form-element"
					name="<?php echo esc_attr($name); ?>">
				<option value="-1">Default</option>
				<?php foreach($chillnews_mikado_global_fonts_array as $fontArray) { ?>
					<option <?php if (chillnews_mikado_option_get_value($name) == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr(str_replace(' ', '+', $fontArray["family"])); ?>"><?php echo esc_html($fontArray["family"]); ?></option>
				<?php } ?>
			</select>
		</div>
	<?php

	}

}

class ChillNewsFieldSelect extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $chillnews_mikado_global_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$show = array();
		if(isset($args["show"]))
			$show = $args["show"];
		$hide = array();
		if(isset($args["hide"]))
			$hide = $args["hide"];
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>" <?php if ($hidden) { ?> style="display: none"<?php } ?>>


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->



			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-3">
							<select class="form-control mkdf-form-element<?php if ($dependence) { echo " dependence"; } ?>"
								<?php foreach($show as $key=>$value) { ?>
									data-show-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
								<?php } ?>
								<?php foreach($hide as $key=>$value) { ?>
									data-hide-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
								<?php } ?>
									name="<?php echo esc_attr($name); ?>">
								<?php foreach($options as $key=>$value) { if ($key == "-1") $key = ""; ?>
									<option <?php if (chillnews_mikado_option_get_value($name) == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php

	}

}

class ChillNewsFieldSelectBlank extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $chillnews_mikado_global_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$show = array();
		if(isset($args["show"]))
			$show = $args["show"];
		$hide = array();
		if(isset($args["hide"]))
			$hide = $args["hide"];
		?>

		<div class="mkdf-page-form-section"<?php if ($hidden) { ?> style="display: none"<?php } ?>>


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->



			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-3">
							<select class="form-control mkdf-form-element<?php if ($dependence) { echo " dependence"; } ?>"
								<?php foreach($show as $key=>$value) { ?>
									data-show-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
								<?php } ?>
								<?php foreach($hide as $key=>$value) { ?>
									data-hide-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
								<?php } ?>
									name="<?php echo esc_attr($name); ?>">
								<option <?php if (chillnews_mikado_option_get_value($name) == "") { echo "selected='selected'"; } ?>  value=""></option>
								<?php foreach($options as $key=>$value) { if ($key == "-1") $key = ""; ?>
									<option <?php if (chillnews_mikado_option_get_value($name) == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php

	}

}

class ChillNewsFieldSelectSimple extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $chillnews_mikado_global_options;
        $dependence = false;
        if(isset($args["dependence"]))
            $dependence = true;
        $show = array();
        if(isset($args["show"]))
            $show = $args["show"];
        $hide = array();
        if(isset($args["hide"]))
            $hide = $args["hide"];
        ?>


		<div class="col-lg-3">
			<em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
            <select class="form-control mkdf-form-element<?php if ($dependence) { echo " dependence"; } ?>"
                <?php foreach($show as $key=>$value) { ?>
                    data-show-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                <?php foreach($hide as $key=>$value) { ?>
                    data-hide-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                    name="<?php echo esc_attr($name); ?>">
                <option <?php if (chillnews_mikado_option_get_value($name) == "") { echo "selected='selected'"; } ?>  value=""></option>
                <?php foreach($options as $key=>$value) { if ($key == "-1") $key = ""; ?>
                    <option <?php if (chillnews_mikado_option_get_value($name) == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                <?php } ?>
            </select>
		</div>
	<?php

	}

}

class ChillNewsFieldSelectBlankSimple extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $chillnews_mikado_global_options;
        $dependence = false;
        if(isset($args["dependence"]))
            $dependence = true;
        $show = array();
        if(isset($args["show"]))
            $show = $args["show"];
        $hide = array();
        if(isset($args["hide"]))
            $hide = $args["hide"];
        ?>


		<div class="col-lg-3">
			<em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
            <select class="form-control mkdf-form-element<?php if ($dependence) { echo " dependence"; } ?>"
                <?php foreach($show as $key=>$value) { ?>
                    data-show-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                <?php foreach($hide as $key=>$value) { ?>
                    data-hide-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                    name="<?php echo esc_attr($name); ?>">
                <option <?php if (chillnews_mikado_option_get_value($name) == "") { echo "selected='selected'"; } ?>  value=""></option>
                <?php foreach($options as $key=>$value) { if ($key == "-1") $key = ""; ?>
                    <option <?php if (chillnews_mikado_option_get_value($name) == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                <?php } ?>
            </select>
		</div>
	<?php

	}

}

class ChillNewsFieldYesNo extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $chillnews_mikado_global_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->



			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (chillnews_mikado_option_get_value($name) == "yes") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'chillnews') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (chillnews_mikado_option_get_value($name) == "no") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'chillnews') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_yesno" value="yes"<?php if (chillnews_mikado_option_get_value($name) == "yes") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_yesno" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php

	}
}

class ChillNewsFieldYesNoSimple extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $chillnews_mikado_global_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="col-lg-3">
			<em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
			<p class="field switch">
				<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
					   class="cb-enable<?php if (chillnews_mikado_option_get_value($name) == "yes") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'chillnews') ?></span></label>
				<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
					   class="cb-disable<?php if (chillnews_mikado_option_get_value($name) == "no") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'chillnews') ?></span></label>
				<input type="checkbox" id="checkbox" class="checkbox"
					   name="<?php echo esc_attr($name); ?>_yesno" value="yes"<?php if (chillnews_mikado_option_get_value($name) == "yes") { echo " selected"; } ?>/>
				<input type="hidden" class="checkboxhidden_yesno" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>"/>
			</p>
		</div>
	<?php

	}
}

class ChillNewsFieldOnOff extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $chillnews_mikado_global_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->



			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">

							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (chillnews_mikado_option_get_value($name) == "on") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('On', 'chillnews') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (chillnews_mikado_option_get_value($name) == "off") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Off', 'chillnews') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_onoff" value="on"<?php if (chillnews_mikado_option_get_value($name) == "on") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_onoff" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php

	}
}

class ChillNewsFieldZeroOne extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->



			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">

							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (chillnews_mikado_option_get_value($name) == "1") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'chillnews') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (chillnews_mikado_option_get_value($name) == "0") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'chillnews') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_zeroone" value="1"<?php if (chillnews_mikado_option_get_value($name) == "1") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_zeroone" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php

	}

}

class ChillNewsFieldImageVideo extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $chillnews_mikado_global_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->



			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch switch-type">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (chillnews_mikado_option_get_value($name) == "image") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Image', 'chillnews') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (chillnews_mikado_option_get_value($name) == "video") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Video', 'chillnews') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_imagevideo" value="image"<?php if (chillnews_mikado_option_get_value($name) == "image") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_imagevideo" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php

	}

}

class ChillNewsFieldYesEmpty extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $chillnews_mikado_global_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->



			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (chillnews_mikado_option_get_value($name) == "yes") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'chillnews') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (chillnews_mikado_option_get_value($name) == "") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'chillnews') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_yesempty" value="yes"<?php if (chillnews_mikado_option_get_value($name) == "yes") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_yesempty" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php

	}

}

class ChillNewsFieldFlagPage extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $chillnews_mikado_global_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->



			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (chillnews_mikado_option_get_value($name) == "page") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'chillnews') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (chillnews_mikado_option_get_value($name) == "") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'chillnews') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_flagpage" value="page"<?php if (chillnews_mikado_option_get_value($name) == "page") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_flagpage" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php

	}

}

class ChillNewsFieldFlagPost extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {

		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->



			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (chillnews_mikado_option_get_value($name) == "post") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'chillnews') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (chillnews_mikado_option_get_value($name) == "") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'chillnews') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_flagpost" value="post"<?php if (chillnews_mikado_option_get_value($name) == "post") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_flagpost" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php

	}

}

class ChillNewsFieldFlagMedia extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $chillnews_mikado_global_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>">


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->



			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (chillnews_mikado_option_get_value($name) == "attachment") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'chillnews') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (chillnews_mikado_option_get_value($name) == "") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'chillnews') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_flagmedia" value="attachment"<?php if (chillnews_mikado_option_get_value($name) == "attachment") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_flagmedia" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php

	}
}

class ChillNewsFieldRange extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		$range_min = 0;
		$range_max = 1;
		$range_step = 0.01;
		$range_decimals = 2;
		if(isset($args["range_min"]))
			$range_min = $args["range_min"];
		if(isset($args["range_max"]))
			$range_max = $args["range_max"];
		if(isset($args["range_step"]))
			$range_step = $args["range_step"];
		if(isset($args["range_decimals"]))
			$range_decimals = $args["range_decimals"];
		?>

		<div class="mkdf-page-form-section">


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->

			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="mkdf-slider-range-wrapper">
								<div class="form-inline">
									<input type="text"
										   class="form-control mkdf-form-element mkdf-form-element-xsmall pull-left mkdf-slider-range-value"
										   name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>"/>

									<div class="mkdf-slider-range small"
										 data-step="<?php echo esc_attr($range_step); ?>" data-min="<?php echo esc_attr($range_min); ?>" data-max="<?php echo esc_attr($range_max); ?>" data-decimals="<?php echo esc_attr($range_decimals); ?>" data-start="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>"></div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php

	}

}

class ChillNewsFieldRangeSimple extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		?>

		<div class="col-lg-3" id="mkdf_<?php echo esc_attr($name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<div class="mkdf-slider-range-wrapper">
				<div class="form-inline">
					<em class="mkdf-field-description"><?php echo esc_html($label); ?></em>
					<input type="text"
						   class="form-control mkdf-form-element mkdf-form-element-xxsmall pull-left mkdf-slider-range-value"
						   name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>"/>

					<div class="mkdf-slider-range xsmall"
						 data-step="0.01" data-max="1" data-start="<?php echo esc_attr(chillnews_mikado_option_get_value($name)); ?>"></div>
				</div>

			</div>
		</div>
	<?php

	}

}

class ChillNewsFieldRadio extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {

		$checked = "";
		if ($default_value == $value)
			$checked = "checked";
		$html = '<input type="radio" name="'.$name.'" value="'.$default_value.'" '.$checked.' /> '.$label.'<br />';
		echo wp_kses($html, array(
			'input' => array(
				'type' => true,
				'name' => true,
				'value' => true,
				'checked' => true
			),
			'br' => true
		));

	}

}

class ChillNewsFieldRadioGroup extends ChillNewsFieldType {

    public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
        $dependence = isset($args["dependence"]) && $args["dependence"] ? true : false;
        $show = !empty($args["show"]) ? $args["show"] : array();
        $hide = !empty($args["hide"]) ? $args["hide"] : array();

        $use_images = isset($args["use_images"]) && $args["use_images"] ? true : false;
        $hide_labels = isset($args["hide_labels"]) && $args["hide_labels"] ? true : false;
        $hide_radios = $use_images ? 'display: none' : '';
        $checked_value = chillnews_mikado_option_get_value($name);
        ?>

        <div class="mkdf-page-form-section" id="mkdf_<?php echo esc_attr($name); ?>" <?php if ($hidden) { ?> style="display: none"<?php } ?>>

            <div class="mkdf-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkdf-field-desc -->

            <div class="mkdf-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(is_array($options) && count($options)) { ?>
                                <div class="mkdf-radio-group-holder <?php if($use_images) echo "with-images"; ?>">
                                    <?php foreach($options as $key => $atts) {
                                        $selected = false;
                                        if($checked_value == $key) {
                                            $selected = true;
                                        }

                                        $show_val = "";
                                        $hide_val = "";
                                        if($dependence) {
                                            if(array_key_exists($key, $show)) {
                                                $show_val = $show[$key];
                                            }

                                            if(array_key_exists($key, $hide)) {
                                                $hide_val = $hide[$key];
                                            }
                                        }
                                    ?>
                                        <label class="radio-inline">
                                            <input
                                                <?php echo chillnews_mikado_get_inline_attr($show_val, 'data-show'); ?>
                                                <?php echo chillnews_mikado_get_inline_attr($hide_val, 'data-hide'); ?>
                                                <?php if($selected) echo "checked"; ?> <?php chillnews_mikado_inline_style($hide_radios); ?>
                                                type="radio"
                                                name="<?php echo esc_attr($name);  ?>"
                                                value="<?php echo esc_attr($key); ?>"
                                                <?php if($dependence) chillnews_mikado_class_attribute("dependence"); ?>> <?php if(!empty($atts["label"]) && !$hide_labels) echo esc_attr($atts["label"]); ?>

                                            <?php if($use_images) { ?>
                                                <img title="<?php if(!empty($atts["label"])) echo esc_attr($atts["label"]); ?>" src="<?php echo esc_url($atts['image']); ?>" alt="<?php echo esc_attr("$key image") ?>"/>
                                            <?php } ?>
                                        </label>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkdf-section-content -->

        </div>
    <?php
    }

}

class ChillNewsFieldCheckBox extends ChillNewsFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {

		$checked = "";
		if ($default_value == $value)
			$checked = "checked";
		$html = '<input type="checkbox" name="'.$name.'" value="'.$default_value.'" '.$checked.' /> '.$label.'<br />';
		echo wp_kses($html, array(
			'input' => array(
				'type' => true,
				'name' => true,
				'value' => true,
				'checked' => true
			),
			'br' => true
		));
	}
}

class ChillNewsFieldFactory {

	public function render( $field_type, $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {


		switch ( strtolower( $field_type ) ) {

			case 'text':
				$field = new ChillNewsFieldText();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'textsimple':
				$field = new ChillNewsFieldTextSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'textarea':
				$field = new ChillNewsFieldTextArea();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'textareasimple':
				$field = new ChillNewsFieldTextAreaSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'color':
				$field = new ChillNewsFieldColor();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'colorsimple':
				$field = new ChillNewsFieldColorSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'image':
				$field = new ChillNewsFieldImage();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

            case 'imagesimple':
				$field = new ChillNewsFieldImageSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'font':
				$field = new ChillNewsFieldFont();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'fontsimple':
				$field = new ChillNewsFieldFontSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'select':
				$field = new ChillNewsFieldSelect();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'selectblank':
				$field = new ChillNewsFieldSelectBlank();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'selectsimple':
				$field = new ChillNewsFieldSelectSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'selectblanksimple':
				$field = new ChillNewsFieldSelectBlankSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'yesno':
				$field = new ChillNewsFieldYesNo();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'yesnosimple':
				$field = new ChillNewsFieldYesNoSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'onoff':
				$field = new ChillNewsFieldOnOff();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'zeroone':
				$field = new ChillNewsFieldZeroOne();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'imagevideo':
				$field = new ChillNewsFieldImageVideo();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'yesempty':
				$field = new ChillNewsFieldYesEmpty();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'flagpost':
				$field = new ChillNewsFieldFlagPost();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'flagpage':
				$field = new ChillNewsFieldFlagPage();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'flagmedia':
				$field = new ChillNewsFieldFlagMedia();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'range':
				$field = new ChillNewsFieldRange();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'rangesimple':
				$field = new ChillNewsFieldRangeSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'radio':
				$field = new ChillNewsFieldRadio();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'checkbox':
				$field = new ChillNewsFieldCheckBox();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'date':
				$field = new ChillNewsFieldDate();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
            case 'radiogroup':
                $field = new ChillNewsFieldRadioGroup();
                $field->render( $name, $label, $description, $options, $args, $hidden );
                break;
			default:
				break;

		}

	}

}

/*
   Class: ChillNewsMultipleImages
   A class that initializes Mikado Multiple Images
*/
class ChillNewsMultipleImages implements iChillNewsInterfaceRender {
	private $name;
	private $label;
	private $description;


	function __construct($name,$label="",$description="") {
		global $chillnews_mikado_global_Framework;
		$this->name = $name;
		$this->label = $label;
		$this->description = $description;
		$chillnews_mikado_global_Framework->mkdMetaBoxes->addOption($this->name,"");
	}

	public function render($factory) {
		global $post;
		?>

		<div class="mkdf-page-form-section">


			<div class="mkdf-field-desc">
				<h4><?php echo esc_html($this->label); ?></h4>

				<p><?php echo esc_html($this->description); ?></p>
			</div>
			<!-- close div.mkdf-field-desc -->

			<div class="mkdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<ul class="mkd-gallery-images-holder clearfix">
								<?php
								$image_gallery_val = get_post_meta( $post->ID, $this->name , true );
								if($image_gallery_val!='' ) $image_gallery_array=explode(',',$image_gallery_val);

								if(isset($image_gallery_array) && count($image_gallery_array)!=0):

									foreach($image_gallery_array as $gimg_id):

										$gimage_wp = wp_get_attachment_image_src($gimg_id,'thumbnail', true);
										echo '<li class="mkd-gallery-image-holder"><img src="'.esc_url($gimage_wp[0]).'"/></li>';

									endforeach;

								endif;
								?>
							</ul>
							<input type="hidden" value="<?php echo esc_attr($image_gallery_val); ?>" id="<?php echo esc_attr( $this->name) ?>" name="<?php echo esc_attr( $this->name) ?>">
							<div class="mkdf-gallery-uploader">
								<a class="mkdf-gallery-upload-btn btn btn-sm btn-primary"
								   href="javascript:void(0)"><?php esc_html_e('Upload', 'chillnews'); ?></a>
								<a class="mkdf-gallery-clear-btn btn btn-sm btn-default pull-right"
								   href="javascript:void(0)"><?php esc_html_e('Remove All', 'chillnews'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkdf-section-content -->

		</div>
	<?php
	}
}

class ChillNewsTwitterFramework implements  iChillNewsInterfaceRender {
    public function render($factory) {
        $twitterApi = MikadofTwitterApi::getInstance();
        $message = '';

        if(!empty($_GET['oauth_token']) && !empty($_GET['oauth_verifier'])) {
            if(!empty($_GET['oauth_token'])) {
                update_option($twitterApi::AUTHORIZE_TOKEN_FIELD, $_GET['oauth_token']);
            }

            if(!empty($_GET['oauth_verifier'])) {
                update_option($twitterApi::AUTHORIZE_VERIFIER_FIELD, $_GET['oauth_verifier']);
            }

            $responseObj = $twitterApi->obtainAccessToken();
            if($responseObj->status) {
                $message = esc_html__('You have successfully connected with your Twitter account. If you have any issues fetching data from Twitter try reconnecting.');
            } else {
                $message = $responseObj->message;
            }
        }

        $buttonText = $twitterApi->hasUserConnected() ? esc_html__('Re-connect with Twitter', 'chillnews') : esc_html__('Connect with Twitter', 'chillnews');
    ?>
        <?php if($message !== '') { ?>
            <div class="alert alert-success" style="margin-top: 20px;">
                <span><?php echo esc_html($message); ?></span>
            </div>
        <?php } ?>
        <div class="mkdf-page-form-section" id="mkdf_enable_social_share">

            <div class="mkdf-field-desc">
                <h4><?php esc_html_e('Connect with Twitter', 'chillnews'); ?></h4>

                <p><?php esc_html_e('Connecting with Twitter will enable you to show your latest tweets on your site'); ?></p>
            </div>
            <!-- close div.mkdf-field-desc -->

            <div class="mkdf-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <a id="mkdf-tw-request-token-btn" class="btn btn-primary" href="#"><?php echo esc_html($buttonText); ?></a>
                            <input type="hidden" data-name="current-page-url" value="<?php echo esc_url($twitterApi->buildCurrentPageURI()); ?>"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkdf-section-content -->

        </div>
    <?php }
}

class ChillNewsInstagramFramework implements iChillNewsInterfaceRender {
    public function render($factory) {
        $message = '';
        $instagram_api = MikadofInstagramApi::getInstance();

        //if code wasn't saved to database
		if(!get_option('mkdf_instagram_code')) {
			//check if code parameter is set in URL. That means that user has connected with Instagram
			if(!empty($_GET['code'])) {
				//update code option so we can use it later
				$instagram_api->storeCode();
				$instagram_api->getAccessToken();
				$message = esc_html__('You have successfully connected with your Instagram account. If you have any issues fetching data from Instagram try reconnecting.', 'chillnews');
				
			} else {
				$instagram_api->storeCodeRequestURI();
			}
		}

		$buttonText = $instagram_api->hasUserConnected() ? esc_html__('Re-connect with Instagram', 'chillnews') : esc_html__('Connect with Instagram', 'chillnews');

    ?>
        <?php if($message !== '') { ?>
            <div class="alert alert-success" style="margin-top: 20px;">
                <span><?php echo esc_html($message); ?></span>
            </div>
        <?php } ?>
        <div class="mkdf-page-form-section" id="mkdf_enable_social_share">

            <div class="mkdf-field-desc">
                <h4><?php esc_html_e('Connect with Instagram', 'chillnews'); ?></h4>

                <p><?php esc_html_e('Connecting with Instagram will enable you to show your latest photos on your site', 'chillnews'); ?></p>
            </div>
            <!-- close div.mkdf-field-desc -->

            <div class="mkdf-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary" href="<?php echo esc_url($instagram_api->getAuthorizeUrl()); ?>"><?php echo esc_html($buttonText); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkdf-section-content -->

        </div>
    <?php }
}