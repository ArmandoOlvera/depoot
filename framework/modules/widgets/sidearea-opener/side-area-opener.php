<?php

class DepotMikadoSideAreaOpener extends DepotMikadoWidget {
    public function __construct() {
        parent::__construct(
            'mkd_side_area_opener',
	        esc_html__('Mikado Side Area Opener', 'depot'),
	        array( 'description' => esc_html__( 'Display a "hamburger" icon that opens the side area', 'depot'))
        );

        $this->setParams();
    }
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'        => 'textfield',
				'name'        => 'icon_color',
				'title'       => esc_html__('Side Area Opener Color', 'depot'),
				'description' => esc_html__('Define color for side area opener', 'depot')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'icon_hover_color',
				'title'       => esc_html__('Side Area Opener Hover Color', 'depot'),
				'description' => esc_html__('Define hover color for side area opener', 'depot')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'widget_margin',
				'title'       => esc_html__('Side Area Opener Margin', 'depot'),
				'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'depot')
			),
			array(
				'type' => 'textfield',
				'name' => 'widget_title',
				'title' => esc_html__('Side Area Opener Title', 'depot')
			)
		);
	}
	
	public function widget($args, $instance) {
		$holder_styles = array();
		if (!empty($instance['icon_color'])) {
			$holder_styles[] = 'color: ' . $instance['icon_color'].';';
		}
		if (!empty($instance['widget_margin'])) {
			$holder_styles[] = 'margin: ' . $instance['widget_margin'];
		}
		?>
		<a class="mkd-side-menu-button-opener mkd-icon-has-hover" <?php echo depot_mikado_get_inline_attr($instance['icon_hover_color'], 'data-hover-color'); ?> href="javascript:void(0)" <?php depot_mikado_inline_style($holder_styles); ?>>
			<?php if (!empty($instance['widget_title'])) { ?>
				<h5 class="mkd-side-menu-title"><?php echo esc_html($instance['widget_title']); ?></h5>
			<?php } ?>
			<span class="mkd-side-menu-lines">
        		<span class="mkd-side-menu-line mkd-line-1"></span>
        		<span class="mkd-side-menu-line mkd-line-2"></span>
                <span class="mkd-side-menu-line mkd-line-3"></span>
        	</span>
		</a>
	<?php }
}