<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php
    /**
     * depot_mikado_header_meta hook
     *
     * @see depot_mikado_header_meta() - hooked with 10
     * @see depot_mikado_user_scalable_meta - hooked with 10
     */
    do_action('depot_mikado_header_meta');

    wp_head(); ?>
</head>
<body <?php body_class();?> itemscope itemtype="http://schema.org/WebPage">
    <?php
    /**
     * depot_mikado_after_body_tag hook
     *
     * @see depot_mikado_get_side_area() - hooked with 10
     * @see depot_mikado_smooth_page_transitions() - hooked with 10
     */
    do_action('depot_mikado_after_body_tag'); ?>

    <div class="mkd-wrapper">
        <div class="mkd-wrapper-inner">
            <?php depot_mikado_get_header(); ?>
	
	        <?php
	        /**
	         * depot_mikado_after_header_area hook
	         *
	         * @see depot_mikado_back_to_top_button() - hooked with 10
	         * @see depot_mikado_get_full_screen_menu() - hooked with 10
	         */
	        do_action('depot_mikado_after_header_area'); ?>
	        
            <div class="mkd-content" <?php depot_mikado_content_elem_style_attr(); ?>>
                <div class="mkd-content-inner">