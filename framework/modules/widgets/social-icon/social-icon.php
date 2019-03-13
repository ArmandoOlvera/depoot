<?php

class DepotMikadoSocialIconWidget extends DepotMikadoWidget {
    public function __construct() {
        parent::__construct(
            'mkd_social_icon_widget',
            esc_html__('Mikado Social Icon Widget', 'depot'),
            array( 'description' => esc_html__( 'Add social network icons to widget areas', 'depot'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array_merge(
            depot_mikado_icon_collections()->getSocialIconWidgetParamsArray(),
            array(
                array(
                    'type'  => 'textfield',
                    'name'  => 'link',
                    'title' => esc_html__('Link', 'depot')
                ),
                array(
                    'type'    => 'dropdown',
                    'name'    => 'target',
                    'title'   => esc_html__('Target', 'depot'),
                    'options' => depot_mikado_get_link_target_array()
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'icon_size',
                    'title' => esc_html__('Icon Size (px)', 'depot')
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'color',
                    'title' => esc_html__('Color', 'depot')
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'hover_color',
                    'title' => esc_html__('Hover Color', 'depot')
                ),
                array(
                    'type'        => 'textfield',
                    'name'        => 'margin',
                    'title'       => esc_html__('Margin', 'depot'),
                    'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'depot')
                )
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
        $icon_styles = array();

        if (!empty($instance['color'])) {
            $icon_styles[] = 'color: '.$instance['color'].';';
        }

        if (!empty($instance['icon_size'])) {
            $icon_styles[] = 'font-size: '.depot_mikado_filter_px($instance['icon_size']).'px';
        }

        if (!empty($instance['margin'])) {
            $icon_styles[] = 'margin: '.$instance['margin'].';';
        }

        $link = '#';
        if (!empty($instance['link'])) {
            $link = $instance['link'];
        }

        $target = '_self';
        if (!empty($instance['target'])) {
            $target = $instance['target'];
        }

        $hover_color = '';
        if (!empty($instance['hover_color'])) {
            $hover_color = $instance['hover_color'];
        }

        $icon_html = 'fa-facebook';
        $icon_holder_html = '';
        if (!empty($instance['icon_pack']) && $instance['icon_pack'] !== '') {
            if (!empty($instance['fa_icon']) && $instance['fa_icon'] !== '' && $instance['icon_pack'] === 'font_awesome') {
                $icon_html = $instance['fa_icon'];
                $icon_holder_html = '<i class="mkd-social-icon-widget fa '.$icon_html.'"></i>';
            } else if (!empty($instance['fe_icon']) && $instance['fe_icon'] !== '' && $instance['icon_pack'] === 'font_elegant') {
                $icon_html = $instance['fe_icon'];
                $icon_holder_html = '<span class="mkd-social-icon-widget '.$icon_html.'"></span>';
            } else if (!empty($instance['ion_icon']) && $instance['ion_icon'] !== '' && $instance['icon_pack'] === 'ion_icons') {
                $icon_html = $instance['ion_icon'];
                $icon_holder_html = '<span class="mkd-social-icon-widget '.$icon_html.'"></span>';
            } else if (!empty($instance['simple_line_icons']) && $instance['simple_line_icons'] !== '' && $instance['icon_pack'] === 'simple_line_icons') {
                $icon_html = $instance['simple_line_icons'];
                $icon_holder_html = '<span class="mkd-social-icon-widget '.$icon_html.'"></span>';
            } else {
                $icon_holder_html = '<i class="mkd-social-icon-widget fa '.$icon_html.'"></i>';
            }
        }
        ?>

        <a class="mkd-social-icon-widget-holder mkd-icon-has-hover" <?php echo depot_mikado_get_inline_attr($hover_color, 'data-hover-color'); ?> <?php depot_mikado_inline_style($icon_styles) ?> href="<?php echo esc_html($link); ?>" target="<?php echo esc_attr($target); ?>">
            <?php print $icon_holder_html; ?>
        </a>
    <?php
    }
}