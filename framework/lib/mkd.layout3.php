<?php

/*
   Class: DepotMikadoMultipleImages
   A class that initializes Mikado Multiple Images
*/
class DepotMikadoMultipleImages implements iDepotMikadoRender {
	private $name;
	private $label;
	private $description;
	
	function __construct($name,$label="",$description="") {
		global $depot_Framework;
		$this->name = $name;
		$this->label = $label;
		$this->description = $description;
		$depot_Framework->mkdMetaBoxes->addOption($this->name,"");
	}

	public function render($factory) {
		global $post;
		?>

		<div class="mkd-page-form-section">
			<div class="mkd-field-desc">
				<h4><?php echo esc_html($this->label); ?></h4>
				<p><?php echo esc_html($this->description); ?></p>
			</div>
			<div class="mkd-section-content">
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
							<div class="mkd-gallery-uploader">
								<a class="mkd-gallery-upload-btn btn btn-sm btn-primary" href="javascript:void(0)"><?php esc_html_e('Upload', 'depot'); ?></a>
								<a class="mkd-gallery-clear-btn btn btn-sm btn-default pull-right" href="javascript:void(0)"><?php esc_html_e('Remove All', 'depot'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

/*
   Class: DepotMikadoImagesVideos
   A class that initializes Mikado Images Videos
*/
class DepotMikadoImagesVideos implements iDepotMikadoRender {
	private $label;
	private $description;
	
	function __construct($label="",$description="") {
		$this->label = $label;
		$this->description = $description;
	}

	public function render($factory) {
		global $post;
		?>
		
		<div class="mkd_hidden_portfolio_images" style="display: none">
			<div class="mkd-page-form-section">
				<div class="mkd-field-desc">
					<h4><?php echo esc_html($this->label); ?></h4>
					<p><?php echo esc_html($this->description); ?></p>
				</div>
				<div class="mkd-section-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-2">
								<em class="mkd-field-description"><?php esc_html_e('Order Number', 'depot'); ?></em>
								<input type="text" class="form-control mkd-input mkd-form-element" id="portfolioimgordernumber_x" name="portfolioimgordernumber_x" />
							</div>
						</div>
						<div class="row next-row">
							<div class="col-lg-12">
								<em class="mkd-field-description"><?php esc_html_e('Image', 'depot'); ?></em>
								<div class="mkd-media-uploader">
									<div style="display: none" class="mkd-media-image-holder">
										<img src="" alt="" class="mkd-media-image img-thumbnail" />
									</div>
									<div style="display: none" class="mkd-media-meta-fields">
										<input type="hidden" class="mkd-media-upload-url" name="portfolioimg_x" id="portfolioimg_x" />
										<input type="hidden" class="mkd-media-upload-height" name="mkd_options_theme[media-upload][height]" value="" />
										<input type="hidden" class="mkd-media-upload-width" name="mkd_options_theme[media-upload][width]" value="" />
									</div>
									<a class="mkd-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e('Select Image', 'depot'); ?>" data-frame-button-text="<?php esc_html_e('Select Image', 'depot'); ?>"><?php esc_html_e('Upload', 'depot'); ?></a>
									<a style="display: none;" href="javascript: void(0)" class="mkd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'depot'); ?></a>
								</div>
							</div>
						</div>
						<div class="row next-row">
							<div class="col-lg-3">
								<em class="mkd-field-description"><?php esc_html_e('Video Type', 'depot'); ?></em>
								<select class="form-control mkd-form-element mkd-portfoliovideotype" name="portfoliovideotype_x" id="portfoliovideotype_x">
									<option value=""></option>
									<option value="youtube"><?php esc_html_e('YouTube', 'depot'); ?></option>
									<option value="vimeo"><?php esc_html_e('Vimeo', 'depot'); ?></option>
									<option value="self"><?php esc_html_e('Self Hosted', 'depot'); ?></option>
								</select>
							</div>
							<div class="col-lg-3">
								<em class="mkd-field-description"><?php esc_html_e('Video ID', 'depot'); ?></em>
								<input type="text" class="form-control mkd-input mkd-form-element" id="portfoliovideoid_x" name="portfoliovideoid_x" />
							</div>
						</div>
						<div class="row next-row">
							<div class="col-lg-12">
								<em class="mkd-field-description">Video image</em>
								<div class="mkd-media-uploader">
									<div style="display: none" class="mkd-media-image-holder">
										<img src="" alt="" class="mkd-media-image img-thumbnail" />
									</div>
									<div style="display: none" class="mkd-media-meta-fields">
										<input type="hidden" class="mkd-media-upload-url" name="portfoliovideoimage_x" id="portfoliovideoimage_x" />
										<input type="hidden" class="mkd-media-upload-height" name="mkd_options_theme[media-upload][height]" value="" />
										<input type="hidden" class="mkd-media-upload-width" name="mkd_options_theme[media-upload][width]" value="" />
									</div>
									<a class="mkd-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e('Select Image', 'depot'); ?>" data-frame-button-text="<?php esc_html_e('Select Image', 'depot'); ?>"><?php esc_html_e('Upload', 'depot'); ?></a>
									<a style="display: none;" href="javascript: void(0)" class="mkd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'depot'); ?></a>
								</div>
							</div>
						</div>
						<div class="row next-row">
							<div class="col-lg-4">
								<em class="mkd-field-description"><?php esc_html_e('Video mp4', 'depot'); ?></em>
								<input type="text" class="form-control mkd-input mkd-form-element" id="portfoliovideomp4_x" name="portfoliovideomp4_x" />
							</div>
						</div>
						<div class="row next-row">
							<div class="col-lg-12">
								<a class="mkd_remove_image btn btn-sm btn-primary" href="/" onclick="javascript: return false;"><?php esc_html_e('Remove portfolio image/video', 'depot'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		$no = 1;
		$portfolio_images = get_post_meta( $post->ID, 'mkd_portfolio_images', true );
		if (count($portfolio_images)>1 && depot_mikado_core_plugin_installed()) {
			usort($portfolio_images, "mkd_core_compare_portfolio_videos");
		}
		while (isset($portfolio_images[$no-1])) {
			$portfolio_image = $portfolio_images[$no-1];
			?>
			
			<div class="mkd_portfolio_image" rel="<?php echo esc_attr($no); ?>" style="display: block;">
				<div class="mkd-page-form-section">
					<div class="mkd-field-desc">
						<h4><?php echo esc_html($this->label); ?></h4>
						<p><?php echo esc_html($this->description); ?></p>
					</div>
					<div class="mkd-section-content">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-2">
									<em class="mkd-field-description"><?php esc_html_e('Order Number', 'depot'); ?></em>
									<input type="text" class="form-control mkd-input mkd-form-element" id="portfolioimgordernumber_<?php echo esc_attr($no); ?>" name="portfolioimgordernumber[]" value="<?php echo isset($portfolio_image['portfolioimgordernumber']) ? esc_attr(stripslashes($portfolio_image['portfolioimgordernumber'])) : ""; ?>" />
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-12">
									<em class="mkd-field-description"><?php esc_html_e('Image', 'depot'); ?></em>
									<div class="mkd-media-uploader">
										<div<?php if (stripslashes($portfolio_image['portfolioimg']) == false) { ?> style="display: none"<?php } ?> class="mkd-media-image-holder">
											<img src="<?php if (stripslashes($portfolio_image['portfolioimg']) == true) { echo esc_url(depot_mikado_get_attachment_thumb_url(stripslashes($portfolio_image['portfolioimg']))); } ?>" alt="" class="mkd-media-image img-thumbnail"/>
										</div>
										<div style="display: none" class="mkd-media-meta-fields">
											<input type="hidden" class="mkd-media-upload-url" name="portfolioimg[]" id="portfolioimg_<?php echo esc_attr($no); ?>" value="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>"/>
											<input type="hidden" class="mkd-media-upload-height" name="mkd_options_theme[media-upload][height]" value="" />
											<input type="hidden" class="mkd-media-upload-width" name="mkd_options_theme[media-upload][width]" value="" />
										</div>
										<a class="mkd-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e('Select Image', 'depot'); ?>" data-frame-button-text="<?php esc_html_e('Select Image', 'depot'); ?>"><?php esc_html_e('Upload', 'depot'); ?></a>
										<a style="display: none;" href="javascript: void(0)" class="mkd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'depot'); ?></a>
									</div>
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-3">
									<em class="mkd-field-description"><?php esc_html_e('Video Type', 'depot'); ?></em>
									<select class="form-control mkd-form-element mkd-portfoliovideotype" name="portfoliovideotype[]" id="portfoliovideotype_<?php echo esc_attr($no); ?>">
										<option value=""></option>
										<option <?php if ($portfolio_image['portfoliovideotype'] == "youtube") { echo "selected='selected'"; } ?>  value="youtube"><?php esc_html_e('YouTube', 'depot'); ?></option>
										<option <?php if ($portfolio_image['portfoliovideotype'] == "vimeo") { echo "selected='selected'"; } ?>  value="vimeo"><?php esc_html_e('Vimeo', 'depot'); ?></option>
										<option <?php if ($portfolio_image['portfoliovideotype'] == "self") { echo "selected='selected'"; } ?>  value="self"><?php esc_html_e('Self Hosted', 'depot'); ?></option>
									</select>
								</div>
								<div class="col-lg-3">
									<em class="mkd-field-description"><?php esc_html_e('Video ID', 'depot'); ?></em>
									<input type="text" class="form-control mkd-input mkd-form-element" id="portfoliovideoid_<?php echo esc_attr($no); ?>" name="portfoliovideoid[]" value="<?php echo isset($portfolio_image['portfoliovideoid']) ? esc_attr(stripslashes($portfolio_image['portfoliovideoid'])) : ""; ?>" />
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-12">
									<em class="mkd-field-description">Video image</em>
									<div class="mkd-media-uploader">
										<div<?php if (stripslashes($portfolio_image['portfoliovideoimage']) == false) { ?> style="display: none"<?php } ?> class="mkd-media-image-holder">
											<img src="<?php if (stripslashes($portfolio_image['portfoliovideoimage']) == true) { echo esc_url(depot_mikado_get_attachment_thumb_url(stripslashes($portfolio_image['portfoliovideoimage']))); } ?>" alt="" class="mkd-media-image img-thumbnail"/>
										</div>
										<div style="display: none" class="mkd-media-meta-fields">
											<input type="hidden" class="mkd-media-upload-url" name="portfoliovideoimage[]" id="portfoliovideoimage_<?php echo esc_attr($no); ?>" value="<?php echo stripslashes($portfolio_image['portfoliovideoimage']); ?>"/>
											<input type="hidden" class="mkd-media-upload-height" name="mkd_options_theme[media-upload][height]" value=""/>
											<input type="hidden" class="mkd-media-upload-width" name="mkd_options_theme[media-upload][width]" value=""/>
										</div>
										<a class="mkd-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e('Select Image', 'depot'); ?>" data-frame-button-text="<?php esc_html_e('Select Image', 'depot'); ?>"><?php esc_html_e('Upload', 'depot'); ?></a>
										<a style="display: none;" href="javascript: void(0)" class="mkd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'depot'); ?></a>
									</div>
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-4">
									<em class="mkd-field-description"><?php esc_html_e('Video mp4', 'depot'); ?></em>
									<input type="text" class="form-control mkd-input mkd-form-element" id="portfoliovideomp4_<?php echo esc_attr($no); ?>" name="portfoliovideomp4[]" value="<?php echo isset($portfolio_image['portfoliovideomp4']) ? esc_attr(stripslashes($portfolio_image['portfoliovideomp4'])) : ""; ?>" />
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-12">
									<a class="mkd_remove_image btn btn-sm btn-primary" href="/" onclick="javascript: return false;"><?php esc_html_e('Remove portfolio image/video', 'depot'); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			$no++;
		}
		?>
		<br />
		<a class="mkd_add_image btn btn-sm btn-primary" onclick="javascript: return false;" href="/"><?php esc_html_e('Add portfolio image/video', 'depot'); ?></a>
	<?php
	}
}

/*
   Class: DepotMikadoImagesVideos
   A class that initializes Mikado Images Videos
*/
class DepotMikadoImagesVideosFramework implements iDepotMikadoRender {
	private $label;
	private $description;

	function __construct($label="",$description="") {
		$this->label = $label;
		$this->description = $description;
	}

	public function render($factory) {
		global $post;
		?>
		
		<div class="mkd-hidden-portfolio-images"  style="display: none">
			<div class="mkd-portfolio-toggle-holder">
				<div class="mkd-portfolio-toggle mkd-toggle-desc">
					<span class="number">1</span><span class="mkd-toggle-inner"><?php esc_html_e('Image - ', 'depot'); ?><em><?php esc_html_e('Order Number', 'depot'); ?></em></span>
				</div>
				<div class="mkd-portfolio-toggle mkd-portfolio-control">
					<span class="toggle-portfolio-media"><i class="fa fa-caret-up"></i></span>
					<a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
				</div>
			</div>
			<div class="mkd-portfolio-toggle-content">
				<div class="mkd-page-form-section">
					<div class="mkd-section-content">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-2">
									<div class="mkd-media-uploader">
										<em class="mkd-field-description"><?php esc_html_e('Image', 'depot'); ?></em>
										<div style="display: none" class="mkd-media-image-holder">
											<img src="" alt="" class="mkd-media-image img-thumbnail">
										</div>
										<div class="mkd-media-meta-fields">
											<input type="hidden" class="mkd-media-upload-url" name="portfolioimg_x" id="portfolioimg_x">
											<input type="hidden" class="mkd-media-upload-height" name="mkd_options_theme[media-upload][height]" value="">
											<input type="hidden" class="mkd-media-upload-width" name="mkd_options_theme[media-upload][width]" value="">
										</div>
										<a class="mkd-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e('Select Image', 'depot'); ?>" data-frame-button-text="<?php esc_html_e('Select Image', 'depot'); ?>"><?php esc_html_e('Upload', 'depot'); ?></a>
										<a style="display: none;" href="javascript: void(0)" class="mkd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'depot'); ?></a>
									</div>
								</div>
								<div class="col-lg-2">
									<em class="mkd-field-description"><?php esc_html_e('Order Number', 'depot'); ?></em>
									<input type="text" class="form-control mkd-input mkd-form-element" id="portfolioimgordernumber_x" name="portfolioimgordernumber_x">
								</div>
							</div>
							<input type="hidden" name="portfoliovideoimage_x" id="portfoliovideoimage_x">
							<input type="hidden" name="portfoliovideotype_x" id="portfoliovideotype_x">
							<input type="hidden" name="portfoliovideoid_x" id="portfoliovideoid_x">
							<input type="hidden" name="portfoliovideomp4_x" id="portfoliovideomp4_x">
							<input type="hidden" name="portfolioimgtype_x" id="portfolioimgtype_x" value="image">
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="mkd-hidden-portfolio-videos"  style="display: none">
			<div class="mkd-portfolio-toggle-holder">
				<div class="mkd-portfolio-toggle mkd-toggle-desc">
					<span class="number">2</span><span class="mkd-toggle-inner"><?php esc_html_e('Video - ', 'depot'); ?><em><?php esc_html_e('Order Number', 'depot'); ?></em></span>
				</div>
				<div class="mkd-portfolio-toggle mkd-portfolio-control">
					<span class="toggle-portfolio-media"><i class="fa fa-caret-up"></i></span> <a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
				</div>
			</div>
			<div class="mkd-portfolio-toggle-content">
				<div class="mkd-page-form-section">
					<div class="mkd-section-content">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-2">
									<div class="mkd-media-uploader">
										<em class="mkd-field-description"><?php esc_html_e('Cover Video Image', 'depot'); ?></em>
										<div style="display: none" class="mkd-media-image-holder">
											<img src="" alt="" class="mkd-media-image img-thumbnail">
										</div>
										<div style="display: none" class="mkd-media-meta-fields">
											<input type="hidden" class="mkd-media-upload-url" name="portfoliovideoimage_x" id="portfoliovideoimage_x">
											<input type="hidden" class="mkd-media-upload-height" name="mkd_options_theme[media-upload][height]" value="">
											<input type="hidden" class="mkd-media-upload-width" name="mkd_options_theme[media-upload][width]" value="">
										</div>
										<a class="mkd-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e('Select Image', 'depot'); ?>" data-frame-button-text="<?php esc_html_e('Select Image', 'depot'); ?>"><?php esc_html_e('Upload', 'depot'); ?></a>
										<a style="display: none;" href="javascript: void(0)" class="mkd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'depot'); ?></a>
									</div>
								</div>
								<div class="col-lg-10">
									<div class="row">
										<div class="col-lg-2">
											<em class="mkd-field-description"><?php esc_html_e('Order Number', 'depot'); ?></em>
											<input type="text" class="form-control mkd-input mkd-form-element" id="portfolioimgordernumber_x" name="portfolioimgordernumber_x">
										</div>
									</div>
									<div class="row next-row">
										<div class="col-lg-2">
											<em class="mkd-field-description"><?php esc_html_e('Video Type', 'depot'); ?></em>
											<select class="form-control mkd-form-element mkd-portfoliovideotype" name="portfoliovideotype_x" id="portfoliovideotype_x">
												<option value=""></option>
												<option value="youtube"><?php esc_html_e('YouTube', 'depot'); ?></option>
												<option value="vimeo"><?php esc_html_e('Vimeo', 'depot'); ?></option>
												<option value="self"><?php esc_html_e('Self Hosted', 'depot'); ?></option>
											</select>
										</div>
										<div class="col-lg-2 mkd-video-id-holder">
											<em class="mkd-field-description" id="videoId"><?php esc_html_e('Video ID', 'depot'); ?></em>
											<input type="text" class="form-control mkd-input mkd-form-element" id="portfoliovideoid_x" name="portfoliovideoid_x">
										</div>
									</div>
									<div class="row next-row mkd-video-self-hosted-path-holder">
										<div class="col-lg-4">
											<em class="mkd-field-description"><?php esc_html_e('Video mp4', 'depot'); ?></em>
											<input type="text" class="form-control mkd-input mkd-form-element" id="portfoliovideomp4_x" name="portfoliovideomp4_x">
										</div>
									</div>
								</div>
							</div>
							<input type="hidden" name="portfolioimg_x" id="portfolioimg_x">
							<input type="hidden" name="portfolioimgtype_x" id="portfolioimgtype_x" value="video">
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		$no = 1;
		$portfolio_images = get_post_meta( $post->ID, 'mkd_portfolio_images', true );
		if (count($portfolio_images)>1 && depot_mikado_core_plugin_installed()) {
			usort($portfolio_images, "mkd_core_compare_portfolio_videos");
		}
		while (isset($portfolio_images[$no-1])) {
			$portfolio_image = $portfolio_images[$no-1];
			if (isset($portfolio_image['portfolioimgtype']))
				$portfolio_img_type = $portfolio_image['portfolioimgtype'];
			else {
				if (stripslashes($portfolio_image['portfolioimg']) == true)
					$portfolio_img_type = "image";
				else
					$portfolio_img_type = "video";
			}
			if ($portfolio_img_type == "image") {
				?>

				<div class="mkd-portfolio-images mkd-portfolio-media" rel="<?php echo esc_attr($no); ?>">
					<div class="mkd-portfolio-toggle-holder">
						<div class="mkd-portfolio-toggle mkd-toggle-desc">
							<span class="number"><?php echo esc_html($no); ?></span><span class="mkd-toggle-inner"><?php esc_html_e('Image - ', 'depot'); ?><em><?php echo stripslashes($portfolio_image['portfolioimgordernumber']); ?></em></span>
						</div>
						<div class="mkd-portfolio-toggle mkd-portfolio-control">
							<a href="#" class="toggle-portfolio-media"><i class="fa fa-caret-down"></i></a>
							<a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
						</div>
					</div>
					<div class="mkd-portfolio-toggle-content" style="display: none">
						<div class="mkd-page-form-section">
							<div class="mkd-section-content">
								<div class="container-fluid">
									<div class="row">
										<div class="col-lg-2">
											<div class="mkd-media-uploader">
												<em class="mkd-field-description"><?php esc_html_e('Image', 'depot'); ?></em>
												<div<?php if (stripslashes($portfolio_image['portfolioimg']) == false) { ?> style="display: none"<?php } ?> class="mkd-media-image-holder">
													<img src="<?php if (stripslashes($portfolio_image['portfolioimg']) == true) { echo esc_url(depot_mikado_get_attachment_thumb_url(stripslashes($portfolio_image['portfolioimg']))); } ?>" alt="" class="mkd-media-image img-thumbnail"/>
												</div>
												<div style="display: none" class="mkd-media-meta-fields">
													<input type="hidden" class="mkd-media-upload-url" name="portfolioimg[]" id="portfolioimg_<?php echo esc_attr($no); ?>" value="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>"/>
													<input type="hidden" class="mkd-media-upload-height" name="mkd_options_theme[media-upload][height]" value=""/>
													<input type="hidden" class="mkd-media-upload-width" name="mkd_options_theme[media-upload][width]" value=""/>
												</div>
												<a class="mkd-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e('Select Image', 'depot'); ?>" data-frame-button-text="<?php esc_html_e('Select Image', 'depot'); ?>"><?php esc_html_e('Upload', 'depot'); ?></a>
												<a style="display: none;" href="javascript: void(0)" class="mkd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'depot'); ?></a>
											</div>
										</div>
										<div class="col-lg-2">
											<em class="mkd-field-description"><?php esc_html_e('Order Number', 'depot'); ?></em>
											<input type="text" class="form-control mkd-input mkd-form-element" id="portfolioimgordernumber_<?php echo esc_attr($no); ?>" name="portfolioimgordernumber[]" value="<?php echo isset($portfolio_image['portfolioimgordernumber']) ? esc_attr(stripslashes($portfolio_image['portfolioimgordernumber'])) : ""; ?>">
										</div>
									</div>
									<input type="hidden" id="portfoliovideoimage_<?php echo esc_attr($no); ?>" name="portfoliovideoimage[]">
									<input type="hidden" id="portfoliovideotype_<?php echo esc_attr($no); ?>" name="portfoliovideotype[]">
									<input type="hidden" id="portfoliovideoid_<?php echo esc_attr($no); ?>" name="portfoliovideoid[]">
									<input type="hidden" id="portfoliovideomp4_<?php echo esc_attr($no); ?>" name="portfoliovideomp4[]">
									<input type="hidden" id="portfolioimgtype_<?php echo esc_attr($no); ?>" name="portfolioimgtype[]" value="image">
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			} else {
				?>
				<div class="mkd-portfolio-videos mkd-portfolio-media" rel="<?php echo esc_attr($no); ?>">
					<div class="mkd-portfolio-toggle-holder">
						<div class="mkd-portfolio-toggle mkd-toggle-desc">
							<span class="number"><?php echo esc_html($no); ?></span><span class="mkd-toggle-inner"><?php esc_html_e('Video - ', 'depot'); ?><em><?php echo stripslashes($portfolio_image['portfolioimgordernumber']); ?></em></span>
						</div>
						<div class="mkd-portfolio-toggle mkd-portfolio-control">
							<a href="#" class="toggle-portfolio-media"><i class="fa fa-caret-down"></i></a> <a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
						</div>
					</div>
					<div class="mkd-portfolio-toggle-content" style="display: none">
						<div class="mkd-page-form-section">
							<div class="mkd-section-content">
								<div class="container-fluid">
									<div class="row">
										<div class="col-lg-2">
											<div class="mkd-media-uploader">
												<em class="mkd-field-description"><?php esc_html_e('Cover Video Image', 'depot'); ?></em>
												<div<?php if (stripslashes($portfolio_image['portfoliovideoimage']) == false) { ?> style="display: none"<?php } ?> class="mkd-media-image-holder">
													<img src="<?php if (stripslashes($portfolio_image['portfoliovideoimage']) == true) { echo esc_url(depot_mikado_get_attachment_thumb_url(stripslashes($portfolio_image['portfoliovideoimage']))); } ?>" alt="" class="mkd-media-image img-thumbnail"/>
												</div>
												<div style="display: none" class="mkd-media-meta-fields">
													<input type="hidden" class="mkd-media-upload-url" name="portfoliovideoimage[]" id="portfoliovideoimage_<?php echo esc_attr($no); ?>" value="<?php echo stripslashes($portfolio_image['portfoliovideoimage']); ?>"/>
													<input type="hidden" class="mkd-media-upload-height" name="mkd_options_theme[media-upload][height]" value=""/>
													<input type="hidden" class="mkd-media-upload-width" name="mkd_options_theme[media-upload][width]" value=""/>
												</div>
												<a class="mkd-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e('Select Image', 'depot'); ?>" data-frame-button-text="<?php esc_html_e('Select Image', 'depot'); ?>"><?php esc_html_e('Upload', 'depot'); ?></a>
												<a style="display: none;" href="javascript: void(0)" class="mkd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'depot'); ?></a>
											</div>
										</div>
										<div class="col-lg-10">
											<div class="row">
												<div class="col-lg-2">
													<em class="mkd-field-description"><?php esc_html_e('Order Number', 'depot'); ?></em>
													<input type="text" class="form-control mkd-input mkd-form-element" id="portfolioimgordernumber_<?php echo esc_attr($no); ?>" name="portfolioimgordernumber[]" value="<?php echo isset($portfolio_image['portfolioimgordernumber']) ? esc_attr(stripslashes($portfolio_image['portfolioimgordernumber'])) : ""; ?>">
												</div>
											</div>
											<div class="row next-row">
												<div class="col-lg-2">
													<em class="mkd-field-description"><?php esc_html_e('Video Type', 'depot'); ?></em>
													<select class="form-control mkd-form-element mkd-portfoliovideotype" name="portfoliovideotype[]" id="portfoliovideotype_<?php echo esc_attr($no); ?>">
														<option value=""></option>
														<option <?php if ($portfolio_image['portfoliovideotype'] == "youtube") { echo "selected='selected'"; } ?>  value="youtube"><?php esc_html_e('YouTube', 'depot'); ?></option>
														<option <?php if ($portfolio_image['portfoliovideotype'] == "vimeo") { echo "selected='selected'"; } ?>  value="vimeo"><?php esc_html_e('Vimeo', 'depot'); ?></option>
														<option <?php if ($portfolio_image['portfoliovideotype'] == "self") { echo "selected='selected'"; } ?>  value="self"><?php esc_html_e('Self Hosted', 'depot'); ?></option>
													</select>
												</div>
												<div class="col-lg-2 mkd-video-id-holder">
													<em class="mkd-field-description"><?php esc_html_e('Video ID', 'depot'); ?></em>
													<input type="text" class="form-control mkd-input mkd-form-element" id="portfoliovideoid_<?php echo esc_attr($no); ?>" name="portfoliovideoid[]" value="<?php echo isset($portfolio_image['portfoliovideoid']) ? esc_attr(stripslashes($portfolio_image['portfoliovideoid'])) : ""; ?>" />
												</div>
											</div>
											<div class="row next-row mkd-video-self-hosted-path-holder">
												<div class="col-lg-4">
													<em class="mkd-field-description"><?php esc_html_e('Video mp4', 'depot'); ?></em>
													<input type="text" class="form-control mkd-input mkd-form-element" id="portfoliovideomp4_<?php echo esc_attr($no); ?>" name="portfoliovideomp4[]" value="<?php echo isset($portfolio_image['portfoliovideomp4']) ? esc_attr(stripslashes($portfolio_image['portfoliovideomp4'])) : ""; ?>" />
												</div>
											</div>
										</div>
									</div>
									<input type="hidden" id="portfolioimg_<?php echo esc_attr($no); ?>" name="portfolioimg[]">
									<input type="hidden" id="portfolioimgtype_<?php echo esc_attr($no); ?>" name="portfolioimgtype[]" value="video">
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			$no++;
		}
		?>

		<div class="mkd-portfolio-add">
			<a class="mkd-add-image btn btn-sm btn-primary" href="#"><i class="fa fa-camera"></i><?php esc_html_e('Add Image', 'depot'); ?></a>
			<a class="mkd-add-video btn btn-sm btn-primary" href="#"><i class="fa fa-video-camera"></i><?php esc_html_e('Add Video', 'depot'); ?></a>
			<a class="mkd-toggle-all-media btn btn-sm btn-default pull-right" href="#"><?php esc_html_e('Expand All', 'depot'); ?></a>
		</div>
	<?php
	}
}

class DepotMikadoTwitterFramework implements  iDepotMikadoRender {
    public function render($factory) {
        $twitterApi = MikadoTwitterApi::getInstance();
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
                $message = esc_html__('You have successfully connected with your Twitter account. If you have any issues fetching data from Twitter try reconnecting.', 'depot');
            } else {
                $message = $responseObj->message;
            }
        }

        $buttonText = $twitterApi->hasUserConnected() ? esc_html__('Re-connect with Twitter', 'depot') : esc_html__('Connect with Twitter', 'depot');
    ?>
        <?php if($message !== '') { ?>
            <div class="alert alert-success" style="margin-top: 20px;">
                <span><?php echo esc_html($message); ?></span>
            </div>
        <?php } ?>
        <div class="mkd-page-form-section" id="mkd_enable_social_share">
            <div class="mkd-field-desc">
                <h4><?php esc_html_e('Connect with Twitter', 'depot'); ?></h4>
                <p><?php esc_html_e('Connecting with Twitter will enable you to show your latest tweets on your site', 'depot'); ?></p>
            </div>
            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <a id="mkd-tw-request-token-btn" class="btn btn-primary" href="#"><?php echo esc_html($buttonText); ?></a>
                            <input type="hidden" data-name="current-page-url" value="<?php echo esc_url($twitterApi->buildCurrentPageURI()); ?>"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
}

class DepotMikadoInstagramFramework implements  iDepotMikadoRender {
    public function render($factory) {
        $instagram_api = MikadoInstagramApi::getInstance();
        $message = '';

        //if code wasn't saved to database
		if(!get_option('mkd_instagram_code')) {
			//check if code parameter is set in URL. That means that user has connected with Instagram
			if(!empty($_GET['code'])) {
				//update code option so we can use it later
				$instagram_api->storeCode();
				$instagram_api->getAccessToken();
				$message = esc_html__('You have successfully connected with your Instagram account. If you have any issues fetching data from Instagram try reconnecting.', 'depot');
				
			} else {
				$instagram_api->storeCodeRequestURI();
			}
		}

		$buttonText = $instagram_api->hasUserConnected() ? esc_html__('Re-connect with Instagram', 'depot') : esc_html__('Connect with Instagram', 'depot');

    ?>
        <?php if($message !== '') { ?>
            <div class="alert alert-success" style="margin-top: 20px;">
                <span><?php echo esc_html($message); ?></span>
            </div>
        <?php } ?>
        <div class="mkd-page-form-section" id="mkd_enable_social_share">
            <div class="mkd-field-desc">
                <h4><?php esc_html_e('Connect with Instagram', 'depot'); ?></h4>
                <p><?php esc_html_e('Connecting with Instagram will enable you to show your latest photos on your site', 'depot'); ?></p>
            </div>
            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary" href="<?php echo esc_url($instagram_api->getAuthorizeUrl()); ?>"><?php echo esc_html($buttonText); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
}

/*
   Class: DepotMikadoImagesVideos
   A class that initializes Mikado Images Videos
*/
class DepotMikadoOptionsFramework implements iDepotMikadoRender {
	private $label;
	private $description;


	function __construct($label="",$description="") {
		$this->label = $label;
		$this->description = $description;
	}

	public function render($factory) {
		global $post;
		?>

		<div class="mkd-portfolio-additional-item-holder" style="display: none">
			<div class="mkd-portfolio-toggle-holder">
				<div class="mkd-portfolio-toggle mkd-toggle-desc">
					<span class="number">1</span><span class="mkd-toggle-inner">Additional Sidebar Item <em><?php esc_html_e('(Order Number, Item Title)', 'depot'); ?></em></span>
				</div>
				<div class="mkd-portfolio-toggle mkd-portfolio-control">
					<span class="toggle-portfolio-item"><i class="fa fa-caret-up"></i></span>
					<a href="#" class="remove-portfolio-item"><i class="fa fa-times"></i></a>
				</div>
			</div>
			<div class="mkd-portfolio-toggle-content">
				<div class="mkd-page-form-section">
					<div class="mkd-section-content">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-2">
									<em class="mkd-field-description"><?php esc_html_e('Order Number', 'depot'); ?></em>
									<input type="text" class="form-control mkd-input mkd-form-element" id="optionlabelordernumber_x" name="optionlabelordernumber_x">
								</div>
								<div class="col-lg-10">
									<em class="mkd-field-description"><?php esc_html_e('Item Title', 'depot'); ?></em>
									<input type="text" class="form-control mkd-input mkd-form-element" id="optionLabel_x" name="optionLabel_x">
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-12">
									<em class="mkd-field-description"><?php esc_html_e('Item Text', 'depot'); ?></em>
									<textarea class="form-control mkd-input mkd-form-element" id="optionValue_x" name="optionValue_x"></textarea>
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-12">
									<em class="mkd-field-description"><?php esc_html_e('Enter Full URL for Item Text Link', 'depot'); ?></em>
									<input type="text" class="form-control mkd-input mkd-form-element" id="optionUrl_x" name="optionUrl_x">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		$no = 1;
		$portfolios = get_post_meta( $post->ID, 'mkd_portfolios', true );
		if (count($portfolios)>1 && depot_mikado_core_plugin_installed()) {
			usort($portfolios, "mkd_core_compare_portfolio_options");
		}
		while (isset($portfolios[$no-1])) {
			$portfolio = $portfolios[$no-1];
			?>
			<div class="mkd-portfolio-additional-item" rel="<?php echo esc_attr($no); ?>">
				<div class="mkd-portfolio-toggle-holder">
					<div class="mkd-portfolio-toggle mkd-toggle-desc">
						<span class="number"><?php echo esc_html($no); ?></span><span class="mkd-toggle-inner">Additional Sidebar Item - <em>(<?php echo stripslashes($portfolio['optionlabelordernumber']); ?>, <?php echo stripslashes($portfolio['optionLabel']); ?>)</em></span>
					</div>
					<div class="mkd-portfolio-toggle mkd-portfolio-control">
						<span class="toggle-portfolio-item"><i class="fa fa-caret-down"></i></span>
						<a href="#" class="remove-portfolio-item"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<div class="mkd-portfolio-toggle-content" style="display: none">
					<div class="mkd-page-form-section">
						<div class="mkd-section-content">
							<div class="container-fluid">
								<div class="row">
									<div class="col-lg-2">
										<em class="mkd-field-description"><?php esc_html_e('Order Number', 'depot'); ?></em>
										<input type="text" class="form-control mkd-input mkd-form-element" id="optionlabelordernumber_<?php echo esc_attr($no); ?>" name="optionlabelordernumber[]" value="<?php echo isset($portfolio['optionlabelordernumber']) ? esc_attr(stripslashes($portfolio['optionlabelordernumber'])) : ""; ?>">
									</div>
									<div class="col-lg-10">
										<em class="mkd-field-description"><?php esc_html_e('Item Title', 'depot'); ?></em>
										<input type="text" class="form-control mkd-input mkd-form-element" id="optionLabel_<?php echo esc_attr($no); ?>" name="optionLabel[]" value="<?php echo esc_attr(stripslashes($portfolio['optionLabel'])); ?>">
									</div>
								</div>
								<div class="row next-row">
									<div class="col-lg-12">
										<em class="mkd-field-description"><?php esc_html_e('Item Text', 'depot'); ?></em>
										<textarea class="form-control mkd-input mkd-form-element" id="optionValue_<?php echo esc_attr($no); ?>" name="optionValue[]"><?php echo esc_attr(stripslashes($portfolio['optionValue'])); ?></textarea>
									</div>
								</div>
								<div class="row next-row">
									<div class="col-lg-12">
										<em class="mkd-field-description"><?php esc_html_e('Enter Full URL for Item Text Link', 'depot'); ?></em>
										<input type="text" class="form-control mkd-input mkd-form-element" id="optionUrl_<?php echo esc_attr($no); ?>" name="optionUrl[]" value="<?php echo stripslashes($portfolio['optionUrl']); ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			$no++;
		}
		?>

		<div class="mkd-portfolio-add">
			<a class="mkd-add-item btn btn-sm btn-primary" href="#"><?php esc_html_e('Add New Item', 'depot'); ?></a>
			<a class="mkd-toggle-all-item btn btn-sm btn-default pull-right" href="#"><?php esc_html_e('Expand All', 'depot'); ?></a>
		</div>
	<?php
	}
}