<?php

if ( ! function_exists('chillnews_mikado_header_options_map') ) {

	function chillnews_mikado_header_options_map() {

		chillnews_mikado_add_admin_page(
			array(
				'slug' => '_header_page',
				'title' => 'Header',
				'icon' => 'fa fa-header'
			)
		);

			/****** HEADER PANEL ******/

			$panel_header = chillnews_mikado_add_admin_panel(
				array(
					'page' => '_header_page',
					'name' => 'panel_header',
					'title' => 'Header'
				)
			);

				chillnews_mikado_add_admin_field(
					array(
						'parent' => $panel_header,
						'type' => 'select',
						'name' => 'header_behaviour',
						'default_value' => 'fixed-on-scroll',
						'label' => 'Choose Header behaviour',
						'description' => 'Select the behaviour of header when you scroll down to page',
						'options' => array(
							'fixed-on-scroll' => 'Fixed on scroll'
						)
					)
				);

				chillnews_mikado_add_admin_field(
					array(
						'name' => 'top_bar',
						'type' => 'yesno',
						'default_value' => 'yes',
						'label' => 'Top Bar',
						'description' => 'Enabling this option will show top bar area',
						'parent' => $panel_header,
						'args' => array(
							"dependence" => true,
							"dependence_hide_on_yes" => "",
							"dependence_show_on_yes" => "#mkdf_top_bar_container"
						)
					)
				);

					$top_bar_container = chillnews_mikado_add_admin_container(array(
						'name' => 'top_bar_container',
						'parent' => $panel_header,
						'hidden_property' => 'top_bar',
						'hidden_value' => 'no'
					));

						chillnews_mikado_add_admin_field(
							array(
								'name' => 'top_bar_in_grid',
								'type' => 'yesno',
								'default_value' => 'no',
								'label' => 'Top Bar in grid',
								'description' => 'Set top bar content to be in grid',
								'parent' => $top_bar_container,
								'args' => array()
							)
						);

						chillnews_mikado_add_admin_field(array(
							'name' => 'top_bar_background_color',
							'type' => 'color',
							'label' => 'Background Color',
							'description' => 'Set background color for top bar',
							'parent' => $top_bar_container
						));


				chillnews_mikado_add_admin_field(
					array(
						'parent' => $panel_header,
						'type' => 'yesno',
						'name' => 'bottom_header_area_in_grid',
						'default_value' => 'yes',
						'label' => 'Set Bottom Header Area In Grid',
						'description' => 'Set bottom header area content to be in grid'
					)
				);		

				chillnews_mikado_add_admin_field(
					array(
						'parent' => $panel_header,
						'type' => 'text',
						'name' => 'logo_area_height_header_type3',
						'default_value' => '',
						'label' => 'Logo Area Height',
						'description' => 'Enter logo area height (default is 220px)',
						'args' => array(
							'col_width' => 3,
							'suffix' => 'px'
						)
					)
				);

				chillnews_mikado_add_admin_field(
					array(
						'parent' => $panel_header,
						'type' => 'text',
						'name' => 'menu_area_height_header_type3',
						'default_value' => '',
						'label' => 'Menu Area Height',
						'description' => 'Enter menu area height (default is 60px)',
						'args' => array(
							'col_width' => 3,
							'suffix' => 'px'
						)
					)
				);

				chillnews_mikado_add_admin_field(
					array(
						'name' => 'hide_top_bar_on_mobile',
						'type' => 'yesno',
						'default_value' => 'yes',
						'label' => 'Hide Top Bar on Mobile Devices',
						'description' => 'Enabling this option you will hide top header area on mobile devices',
						'parent' => $top_bar_container
					)
				);

			/****** MAIN MENU PANEL ******/		

				$panel_main_menu = chillnews_mikado_add_admin_panel(
					array(
						'title' => 'Main Menu',
						'name' => 'panel_main_menu',
						'page' => '_header_page'
					)
				);

					chillnews_mikado_add_admin_section_title(
						array(
							'parent' => $panel_main_menu,
							'name' => 'main_menu_area_title',
							'title' => 'Main Menu General Settings'
						)
					);

					chillnews_mikado_add_admin_field(
						array(
							'name' => 'show_nav_search',
							'type' => 'yesno',
							'default_value' => 'yes',
							'label' => 'Enable Search Form',
							'description' => 'Enabling this option will show search form next to the main menu navigation',
							'parent' => $panel_main_menu
						)
					);

					$first_level_group = chillnews_mikado_add_admin_group(
						array(
							'parent' => $panel_main_menu,
							'name' => 'first_level_group',
							'title' => '1st Level Menu',
							'description' => 'Define styles for 1st level in Top Navigation Menu'
						)
					);

						$first_level_row1 = chillnews_mikado_add_admin_row(
							array(
								'parent' => $first_level_group,
								'name' => 'first_level_row1'
							)
						);

							chillnews_mikado_add_admin_field(
								array(
									'parent' => $first_level_row1,
									'type' => 'colorsimple',
									'name' => 'menu_color',
									'default_value' => '',
									'label' => 'Text Color',
								)
							);

							chillnews_mikado_add_admin_field(
								array(
									'parent' => $first_level_row1,
									'type' => 'colorsimple',
									'name' => 'menu_hovercolor',
									'default_value' => '',
									'label' => 'Hover Text Color',
								)
							);

							chillnews_mikado_add_admin_field(
								array(
									'parent' => $first_level_row1,
									'type' => 'colorsimple',
									'name' => 'menu_activecolor',
									'default_value' => '',
									'label' => 'Active Text Color',
								)
							);

							$first_level_row2 = chillnews_mikado_add_admin_row(
								array(
									'parent' => $first_level_group,
									'name' => 'first_level_row2',
									'next' => true
								)
							);

							chillnews_mikado_add_admin_field(
								array(
									'parent' => $first_level_row2,
									'type' => 'colorsimple',
									'name' => 'menu_text_background_color',
									'default_value' => '',
									'label' => 'Text Background Color',
								)
							);

							chillnews_mikado_add_admin_field(
								array(
									'parent' => $first_level_row2,
									'type' => 'colorsimple',
									'name' => 'menu_hover_background_color',
									'default_value' => '',
									'label' => 'Hover Text Background Color',
								)
							);

							chillnews_mikado_add_admin_field(
								array(
									'parent' => $first_level_row2,
									'type' => 'colorsimple',
									'name' => 'menu_active_background_color',
									'default_value' => '',
									'label' => 'Active Text Background Color',
								)
							);

						$first_level_row5 = chillnews_mikado_add_admin_row(
							array(
								'parent' => $first_level_group,
								'name' => 'first_level_row5',
								'next' => true
							)
						);

							chillnews_mikado_add_admin_field(
								array(
									'parent' => $first_level_row5,
									'type' => 'fontsimple',
									'name' => 'menu_google_fonts',
									'default_value' => '-1',
									'label' => 'Font Family',
								)
							);

							chillnews_mikado_add_admin_field(
								array(
									'parent' => $first_level_row5,
									'type' => 'textsimple',
									'name' => 'menu_fontsize',
									'default_value' => '',
									'label' => 'Font Size',
									'args' => array(
										'suffix' => 'px'
									)
								)
							);

							chillnews_mikado_add_admin_field(
								array(
									'parent' => $first_level_row5,
									'type' => 'textsimple',
									'name' => 'menu_lineheight',
									'default_value' => '',
									'label' => 'Line Height',
									'args' => array(
										'suffix' => 'px'
									)
								)
							);

							chillnews_mikado_add_admin_field(
								array(
									'parent' => $first_level_row5,
									'type' => 'selectblanksimple',
									'name' => 'menu_fontweight',
									'default_value' => '',
									'label' => 'Font Weight',
									'options' => chillnews_mikado_get_font_weight_array()
								)
							);

						$first_level_row6 = chillnews_mikado_add_admin_row(
							array(
								'parent' => $first_level_group,
								'name' => 'first_level_row6',
								'next' => true
							)
						);

							chillnews_mikado_add_admin_field(
								array(
									'parent' => $first_level_row6,
									'type' => 'selectblanksimple',
									'name' => 'menu_fontstyle',
									'default_value' => '',
									'label' => 'Font Style',
									'options' => chillnews_mikado_get_font_style_array()
								)
							);

							chillnews_mikado_add_admin_field(
								array(
									'parent' => $first_level_row6,
									'type' => 'textsimple',
									'name' => 'menu_letterspacing',
									'default_value' => '',
									'label' => 'Letter Spacing',
									'args' => array(
										'suffix' => 'px'
									)
								)
							);

							chillnews_mikado_add_admin_field(
								array(
									'parent' => $first_level_row6,
									'type' => 'selectblanksimple',
									'name' => 'menu_texttransform',
									'default_value' => '',
									'label' => 'Text Transform',
									'options' => chillnews_mikado_get_text_transform_array()
								)
							);
								
			/****** FIXED HEADER PANEL ******/
			
			$panel_fixed_header = chillnews_mikado_add_admin_panel(
				array(
					'title' => 'Fixed Header',
					'name' => 'panel_fixed_header',
					'page' => '_header_page'
				)
			);

			chillnews_mikado_add_admin_field(array(
				'name' => 'fixed_header_background_color',
				'type' => 'color',
				'default_value' => '',
				'label' => 'Header Background Color',
				'description' => 'Set background color for fixed header',
				'parent' => $panel_fixed_header
			));

			chillnews_mikado_add_admin_field(array(
				'name' => 'fixed_header_background_color_transparency',
				'type' => 'text',
				'label' => 'Header Transparency',
				'description' => 'Enter transparency for fixed header (value from 0 to 1)',
				'parent' => $panel_fixed_header,
				'args' => array(
					'col_width' => 1
				)
			));			

			$group_fixed_header_menu = chillnews_mikado_add_admin_group(array(
				'title' => 'Fixed Header Menu',
				'name' => 'group_fixed_header_menu',
				'parent' => $panel_fixed_header,
				'description' => 'Define typography for fixed menu items',
			));

				$row1_fixed_header_menu = chillnews_mikado_add_admin_row(array(
					'name' => 'row1',
					'parent' => $group_fixed_header_menu
				));

					chillnews_mikado_add_admin_field(array(
						'name' => 'fixed_color',
						'type' => 'colorsimple',
						'label' => 'Text Color',
						'description' => '',
						'parent' => $row1_fixed_header_menu
					));

					chillnews_mikado_add_admin_field(array(
						'name' => 'fixed_hovercolor',
						'type' => 'colorsimple',
						'label' => 'Hover/Active color',
						'description' => '',
						'parent' => $row1_fixed_header_menu
					));

				$row2_fixed_header_menu = chillnews_mikado_add_admin_row(array(
					'name' => 'row2',
					'parent' => $group_fixed_header_menu
				));

					chillnews_mikado_add_admin_field(
						array(
							'name' => 'fixed_google_fonts',
							'type' => 'fontsimple',
							'label' => 'Font Family',
							'default_value' => '-1',
							'parent' => $row2_fixed_header_menu,
						)
					);

					chillnews_mikado_add_admin_field(
						array(
							'type' => 'textsimple',
							'name' => 'fixed_fontsize',
							'label' => 'Font Size',
							'default_value' => '',
							'parent' => $row2_fixed_header_menu,
							'args' => array(
								'suffix' => 'px'
							)
						)
					);

					chillnews_mikado_add_admin_field(
						array(
							'type' => 'textsimple',
							'name' => 'fixed_lineheight',
							'label' => 'Line height',
							'default_value' => '',
							'parent' => $row2_fixed_header_menu,
							'args' => array(
								'suffix' => 'px'
							)
						)
					);

					chillnews_mikado_add_admin_field(
						array(
							'type' => 'selectblanksimple',
							'name' => 'fixed_texttransform',
							'label' => 'Text transform',
							'default_value' => '',
							'options' => chillnews_mikado_get_text_transform_array(),
							'parent' => $row2_fixed_header_menu
						)
					);

				$row3_fixed_header_menu = chillnews_mikado_add_admin_row(array(
					'name' => 'row3',
					'parent' => $group_fixed_header_menu
				));

					chillnews_mikado_add_admin_field(
						array(
							'type' => 'selectblanksimple',
							'name' => 'fixed_fontstyle',
							'default_value' => '',
							'label' => 'Font Style',
							'options' => chillnews_mikado_get_font_style_array(),
							'parent' => $row3_fixed_header_menu
						)
					);

					chillnews_mikado_add_admin_field(
						array(
							'type' => 'selectblanksimple',
							'name' => 'fixed_fontweight',
							'default_value' => '',
							'label' => 'Font Weight',
							'options' => chillnews_mikado_get_font_weight_array(),
							'parent' => $row3_fixed_header_menu
						)
					);

					chillnews_mikado_add_admin_field(
						array(
							'type' => 'textsimple',
							'name' => 'fixed_letterspacing',
							'label' => 'Letter Spacing',
							'default_value' => '',
							'parent' => $row3_fixed_header_menu,
							'args' => array(
								'suffix' => 'px'
							)
						)
					);

			/****** MOBILE HEADER PANEL ******/

			$panel_mobile_header = chillnews_mikado_add_admin_panel(array(
				'title' => 'Mobile header',
				'name'  => 'panel_mobile_header',
				'page'  => '_header_page'
			));

			chillnews_mikado_add_admin_field(array(
				'name'        => 'mobile_header_height',
				'type'        => 'text',
				'label'       => 'Mobile Header Height',
				'description' => 'Enter height for mobile header in pixels',
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			));

			chillnews_mikado_add_admin_field(array(
				'name'        => 'mobile_header_background_color',
				'type'        => 'color',
				'label'       => 'Mobile Header Background Color',
				'description' => 'Choose color for mobile header',
				'parent'      => $panel_mobile_header
			));

			chillnews_mikado_add_admin_field(array(
				'name'        => 'mobile_menu_background_color',
				'type'        => 'color',
				'label'       => 'Mobile Menu Background Color',
				'description' => 'Choose color for mobile menu',
				'parent'      => $panel_mobile_header
			));

			chillnews_mikado_add_admin_field(array(
				'name'        => 'mobile_menu_separator_color',
				'type'        => 'color',
				'label'       => 'Mobile Menu Item Separator Color',
				'description' => 'Choose color for mobile menu horizontal separators',
				'parent'      => $panel_mobile_header
			));

			chillnews_mikado_add_admin_field(array(
				'name'        => 'mobile_logo_height',
				'type'        => 'text',
				'label'       => 'Logo Height For Mobile Header',
				'description' => 'Define logo height for screen size smaller than 1000px',
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			));

			chillnews_mikado_add_admin_field(array(
				'name'        => 'mobile_logo_height_phones',
				'type'        => 'text',
				'label'       => 'Logo Height For Mobile Devices',
				'description' => 'Define logo height for screen size smaller than 480px',
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			));

			chillnews_mikado_add_admin_section_title(array(
				'name' => 'mobile_opener_panel',
				'parent' => $panel_mobile_header,
				'title' => 'Mobile Menu Opener'
			));

			chillnews_mikado_add_admin_field(array(
				'name'        => 'mobile_menu_title',
				'type'        => 'text',
				'label'       => 'Mobile Navigation Title',
				'description' => 'Enter title for mobile menu navigation',
				'parent'      => $panel_mobile_header,
				'default_value' => 'MENU',
				'args' => array(
					'col_width' => 3
				)
			));

			chillnews_mikado_add_admin_field(array(
				'name'        => 'mobile_icon_pack',
				'type'        => 'select',
				'label'       => 'Mobile Navigation Icon Pack',
				'default_value' => 'font_elegant',
				'description' => 'Choose icon pack for mobile navigation icon',
				'parent'      => $panel_mobile_header,
				'options'     => chillnews_mikado_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'simple_line_icons'))
			));

			chillnews_mikado_add_admin_field(array(
				'name'        => 'mobile_icon_color',
				'type'        => 'color',
				'label'       => 'Mobile Navigation Icon Color',
				'description' => 'Choose color for icon header',
				'parent'      => $panel_mobile_header
			));

			chillnews_mikado_add_admin_field(array(
				'name'        => 'mobile_icon_hover_color',
				'type'        => 'color',
				'label'       => 'Mobile Navigation Icon Hover Color',
				'description' => 'Choose hover color for mobile navigation icon ',
				'parent'      => $panel_mobile_header
			));

			chillnews_mikado_add_admin_field(array(
				'name'        => 'mobile_icon_size',
				'type'        => 'text',
				'label'       => 'Mobile Navigation Icon size',
				'description' => 'Choose size for mobile navigation icon ',
				'parent'      => $panel_mobile_header,
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			));

	}

	add_action( 'chillnews_mikado_options_map', 'chillnews_mikado_header_options_map', 4);
}