<?php
namespace Depot\Modules\Header\Types;

use Depot\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Standard Extended layout and option
 *
 * Class HeaderStandardExtended
 */
class HeaderStandardExtended extends HeaderType {
	protected $heightOfTransparency;
	protected $heightOfCompleteTransparency;
	protected $headerHeight;
	protected $mobileHeaderHeight;

	/**
	 * Sets slug property which is the same as value of option in DB
	 */
	public function __construct() {
		$this->slug = 'header-standard-extended';

		if(!is_admin()) {

            $logoAreaHeight       = depot_mikado_filter_px(depot_mikado_options()->getOptionValue('logo_area_height'));
            $this->logoAreaHeight = $logoAreaHeight !== '' ? intval($logoAreaHeight) : 90;

			$menuAreaHeight       = depot_mikado_filter_px(depot_mikado_options()->getOptionValue('menu_area_height'));
			$this->menuAreaHeight = $menuAreaHeight !== '' ? intval($menuAreaHeight) : 65;

			$mobileHeaderHeight       = depot_mikado_filter_px(depot_mikado_options()->getOptionValue('mobile_header_height'));
			$this->mobileHeaderHeight = $mobileHeaderHeight !== '' ? $mobileHeaderHeight : 60;

			add_action('wp', array($this, 'setHeaderHeightProps'));

			add_filter('depot_mikado_js_global_variables', array($this, 'getGlobalJSVariables'));
			add_filter('depot_mikado_per_page_js_vars', array($this, 'getPerPageJSVariables'));
		}
	}

	/**
	 * Loads template file for this header type
	 *
	 * @param array $parameters associative array of variables that needs to passed to template
	 */
	public function loadTemplate($parameters = array()) {
        $id  = depot_mikado_get_page_id();

        $parameters['logo_area_in_grid'] = depot_mikado_get_meta_field_intersect('logo_area_in_grid',$id) == 'yes' ? true : false;
        $parameters['menu_area_in_grid'] = depot_mikado_get_meta_field_intersect('menu_area_in_grid',$id) == 'yes' ? true : false;

		$parameters = apply_filters('depot_mikado_parameters', $parameters);

		depot_mikado_get_module_template_part('templates/types/'.$this->slug, $this->moduleName, '', $parameters);
	}

	/**
	 * Sets header height properties after WP object is set up
	 */
	public function setHeaderHeightProps() {
		$this->heightOfTransparency         = $this->calculateHeightOfTransparency();
		$this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
		$this->headerHeight                 = $this->calculateHeaderHeight();
		$this->mobileHeaderHeight           = $this->calculateMobileHeaderHeight();
	}

	/**
	 * Returns total height of transparent parts of header
	 *
	 * @return int
	 */
	public function calculateHeightOfTransparency() {
		$id                 = depot_mikado_get_page_id();
		$transparencyHeight = 0;

        if(get_post_meta($id, 'mkd_logo_area_background_color_meta', true) !== '') {
            $logoAreaTransparent = get_post_meta($id, 'mkd_logo_area_background_color_meta', true) !== '' &&
                get_post_meta($id, 'mkd_logo_area_background_transparency_meta', true) !== '1';
        } elseif(depot_mikado_options()->getOptionValue('logo_area_background_color') == '') {
            $logoAreaTransparent = depot_mikado_options()->getOptionValue('logo_area_grid_background_color') !== '' &&
                depot_mikado_options()->getOptionValue('logo_area_grid_background_transparency') !== '1';
        } else {
            $logoAreaTransparent = depot_mikado_options()->getOptionValue('logo_area_background_color') !== '' &&
                depot_mikado_options()->getOptionValue('logo_area_background_transparency') !== '1';
        }

        if(get_post_meta($id, 'mkd_menu_area_background_color_meta', true) !== '') {
			$menuAreaTransparent = get_post_meta($id, 'mkd_menu_area_background_color_meta', true) !== '' &&
			                       get_post_meta($id, 'mkd_menu_area_background_transparency_meta', true) !== '1';
		} elseif(depot_mikado_options()->getOptionValue('menu_area_background_color') == '') {
			$menuAreaTransparent = depot_mikado_options()->getOptionValue('menu_area_grid_background_color') !== '' &&
			                       depot_mikado_options()->getOptionValue('menu_area_grid_background_transparency') !== '1';
		} else {
			$menuAreaTransparent = depot_mikado_options()->getOptionValue('menu_area_background_color') !== '' &&
			                       depot_mikado_options()->getOptionValue('menu_area_background_transparency') !== '1';
		}


		$sliderExists        = get_post_meta($id, 'mkd_page_slider_meta', true) !== '';
		$contentBehindHeader = get_post_meta($id, 'mkd_page_content_behind_header_meta', true) === 'yes';

		if($sliderExists || $contentBehindHeader) {
			$menuAreaTransparent = true;
			$logoAreaTransparent = true;
		}

        if($logoAreaTransparent || $menuAreaTransparent) {
            if($logoAreaTransparent) {
                $transparencyHeight = $this->logoAreaHeight + $this->menuAreaHeight;

                if(($sliderExists && depot_mikado_is_top_bar_enabled())
                    || depot_mikado_is_top_bar_enabled() && depot_mikado_is_top_bar_transparent()
                ) {
                    $transparencyHeight += depot_mikado_get_top_bar_height();
                }
            }

            if(!$logoAreaTransparent && $menuAreaTransparent) {
                $transparencyHeight = $this->menuAreaHeight;
            }
        }

		return $transparencyHeight;
	}

	/**
	 * Returns height of completely transparent header parts
	 *
	 * @return int
	 */
	public function calculateHeightOfCompleteTransparency() {
		$id                 = depot_mikado_get_page_id();
		$transparencyHeight = 0;

        if(get_post_meta($id, 'mkd_logo_area_background_color_meta', true) !== '') {
            $logoAreaTransparent = get_post_meta($id, 'mkd_logo_area_background_color_meta', true) !== '' &&
                get_post_meta($id, 'mkd_logo_area_background_transparency_meta', true) === '0';
        } elseif(depot_mikado_options()->getOptionValue('logo_area_background_color') == '') {
            $logoAreaTransparent = depot_mikado_options()->getOptionValue('logo_area_grid_background_color') !== '' &&
                depot_mikado_options()->getOptionValue('logo_area_grid_background_transparency') === '0';
        } else {
            $logoAreaTransparent = depot_mikado_options()->getOptionValue('logo_area_background_color') !== '' &&
                depot_mikado_options()->getOptionValue('logo_area_background_transparency') === '0';
        }


		if(get_post_meta($id, 'mkd_menu_area_background_color_meta', true) !== '') {
			$menuAreaTransparent = get_post_meta($id, 'mkd_menu_area_background_color_meta', true) !== '' &&
			                       get_post_meta($id, 'mkd_menu_area_background_transparency_meta', true) === '0';
		} elseif(depot_mikado_options()->getOptionValue('menu_area_background_color') == '') {
			$menuAreaTransparent = depot_mikado_options()->getOptionValue('menu_area_grid_background_color') !== '' &&
			                       depot_mikado_options()->getOptionValue('menu_area_grid_background_transparency') === '0';
		} else {
			$menuAreaTransparent = depot_mikado_options()->getOptionValue('menu_area_background_color') !== '' &&
			                       depot_mikado_options()->getOptionValue('menu_area_background_transparency') === '0';
		}


        if($logoAreaTransparent || $menuAreaTransparent) {
            if($logoAreaTransparent) {
                $transparencyHeight = $this->logoAreaHeight + $this->menuAreaHeight;

                if(depot_mikado_is_top_bar_enabled() && depot_mikado_is_top_bar_completely_transparent()) {
                    $transparencyHeight += depot_mikado_get_top_bar_height();
                }
            }

            if(!$logoAreaTransparent && $menuAreaTransparent) {
                $transparencyHeight = $this->menuAreaHeight;
            }
        }

		return $transparencyHeight;
	}


	/**
	 * Returns total height of header
	 *
	 * @return int|string
	 */
	public function calculateHeaderHeight() {
		$headerHeight = $this->logoAreaHeight + $this->menuAreaHeight;
		if(depot_mikado_is_top_bar_enabled()) {
			$headerHeight += depot_mikado_get_top_bar_height();
		}

		return $headerHeight;
	}

	/**
	 * Returns total height of mobile header
	 *
	 * @return int|string
	 */
	public function calculateMobileHeaderHeight() {
		$mobileHeaderHeight = $this->mobileHeaderHeight;

		return $mobileHeaderHeight;
	}

	/**
	 * Returns global js variables of header
	 *
	 * @param $globalVariables
	 *
	 * @return int|string
	 */
	public function getGlobalJSVariables($globalVariables) {
		$globalVariables['mkdLogoAreaHeight']     = $this->logoAreaHeight;
		$globalVariables['mkdMenuAreaHeight']     = $this->menuAreaHeight;
		$globalVariables['mkdMobileHeaderHeight'] = $this->mobileHeaderHeight;

		return $globalVariables;
	}

	/**
	 * Returns per page js variables of header
	 *
	 * @param $perPageVars
	 *
	 * @return int|string
	 */
	public function getPerPageJSVariables($perPageVars) {
		//calculate transparency height only if header has no sticky behaviour
		if(!in_array(depot_mikado_get_meta_field_intersect('header_behaviour'), array(
			'sticky-header-on-scroll-up',
			'sticky-header-on-scroll-down-up'
		))
		) {
			$perPageVars['mkdHeaderTransparencyHeight'] = $this->headerHeight - (depot_mikado_get_top_bar_height() + $this->heightOfCompleteTransparency);
		} else {
			$perPageVars['mkdHeaderTransparencyHeight'] = 0;
		}

		return $perPageVars;
	}
}