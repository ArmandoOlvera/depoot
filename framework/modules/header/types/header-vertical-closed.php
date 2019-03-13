<?php
namespace Depot\Modules\Header\Types;

use Depot\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Vertical layout and option
 *
 * Class HeaderVertical
 */
class HeaderVerticalClosed extends HeaderType {
    protected $mobileHeaderHeight;

    public function __construct() {
        $this->slug = 'header-vertical-closed';

        $mobileHeaderHeight       = depot_mikado_filter_px(depot_mikado_options()->getOptionValue('mobile_header_height'));
        $this->mobileHeaderHeight = $mobileHeaderHeight !== '' ? (int)$mobileHeaderHeight : (int)72;

        add_action('wp', array($this, 'setHeaderHeightProps'));

        add_filter('depot_mikado_js_global_variables', array($this, 'getGlobalJSVariables'));
        add_filter('depot_mikado_per_page_js_vars', array($this, 'getPerPageJSVariables'));
    }

    /**
     * Loads template for header type
     *
     * @param array $parameters associative array of variables to pass to template
     */
    public function loadTemplate($parameters = array()) {
		$parameters['holder_class'] = depot_mikado_vertical_haeder_holder_class();

		$parameters = apply_filters('depot_mikado_header_vertical_parameters', $parameters);

        depot_mikado_get_module_template_part('templates/types/'.$this->slug, $this->moduleName, '', $parameters);
    }

    /**
     * Sets header height properties after WP object is set up
     */
    public function setHeaderHeightProps(){
        $this->mobileHeaderHeight = $this->calculateMobileHeaderHeight();
    }

    /**
     * Returns total height of transparent parts of header
     *
     * @return mixed
     */
    public function calculateHeightOfTransparency() {
        return 0;
    }

    /**
     * Returns height of header parts that are totaly transparent
     *
     * @return mixed
     */
    public function calculateHeightOfCompleteTransparency() {
        return 0;
    }

    /**
     * Returns header height
     *
     * @return mixed
     */
    public function calculateHeaderHeight() {
        return 0;
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
     * @return int|string
     */
    public function getGlobalJSVariables($globalVariables) {
        $globalVariables['mkdLogoAreaHeight'] = 0;
        $globalVariables['mkdMenuAreaHeight'] = 0;
        $globalVariables['mkdMobileHeaderHeight'] = $this->mobileHeaderHeight;

        return $globalVariables;
    }

    /**
     * Returns per page js variables of header
     *
     * @param $perPageVars
     * @return int|string
     */
    public function getPerPageJSVariables($perPageVars) {
        $perPageVars['mkdHeaderTransparencyHeight'] = 0;
        return $perPageVars;
    }

}