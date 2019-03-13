<?php
namespace Depot\Modules\Header\Types;

use Depot\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header 'In The Box' layout and option
 *
 * Class HeaderBox
 */
class HeaderBox extends HeaderType {
	protected $heightOfTransparency;
	protected $heightOfCompleteTransparency;
	protected $headerHeight;
	protected $mobileHeaderHeight;

	/**
	 * Sets slug property which is the same as value of option in DB
	 */
	public function __construct() {
		$this->slug = 'header-box';

		if(!is_admin()) {

			$menuAreaHeight       = depot_mikado_filter_px(depot_mikado_options()->getOptionValue('menu_area_height'));
			$this->menuAreaHeight = $menuAreaHeight !== '' ? intval($menuAreaHeight) : 90;

			$mobileHeaderHeight       = depot_mikado_filter_px(depot_mikado_options()->getOptionValue('mobile_header_height'));
			$this->mobileHeaderHeight = $mobileHeaderHeight !== '' ? intval($mobileHeaderHeight) : 60;

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
		$sliderExists        = get_post_meta($id, 'mkd_page_slider_meta', true) !== '';


		$transparencyHeight = $this->menuAreaHeight/2;

		if(($sliderExists && depot_mikado_is_top_bar_enabled())
		   || depot_mikado_is_top_bar_enabled() && depot_mikado_is_top_bar_transparent()
		) {
			$transparencyHeight = $this->menuAreaHeight + depot_mikado_get_top_bar_height();
		}


		return $transparencyHeight;
	}

	/**
	 * Returns height of completely transparent header parts
	 *
	 * @return int
	 */
	public function calculateHeightOfCompleteTransparency() {

		$transparencyHeight = $this->menuAreaHeight/2;

		return $transparencyHeight;
	}


	/**
	 * Returns total height of header
	 *
	 * @return int|string
	 */
	public function calculateHeaderHeight() {
		$headerHeight = $this->menuAreaHeight;
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
		$globalVariables['mkdLogoAreaHeight']     = 0;
		$globalVariables['mkdMenuAreaHeight']     = $this->headerHeight;
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