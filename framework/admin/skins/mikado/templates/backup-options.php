<div class="mkd-tabs-content">
	<div class="tab-content">
		<div class="tab-pane fade in active" id="import">
			<div class="mkd-tab-content">
				<h2 class="mkd-page-title"><?php esc_html_e('Backup Options', 'depot'); ?></h2>
				<form method="post" class="mkd_ajax_form mkd-backup-options-page-holder">
					<div class="mkd-page-form">
						<div class="mkd-page-form-section-holder">
							<h3 class="mkd-page-section-title"><?php esc_html_e('Export/Import Options', 'depot'); ?></h3>
							<div class="mkd-page-form-section">
								<div class="mkd-field-desc">
									<h4><?php esc_html_e('Export', 'depot'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'depot'); ?></p>
								</div>
								<div class="mkd-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_options" id="export_options" class="form-control mkd-form-element" rows="10" readonly><?php echo mkd_core_export_options(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mkd-page-form-section">
								<div class="mkd-field-desc">
									<h4><?php esc_html_e('Import', 'depot'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'depot'); ?></p>
								</div>
								<div class="mkd-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_theme_options" id="import_theme_options" class="form-control mkd-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mkd-page-form-section">
								<div class="mkd-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="mkd-import-theme-options-btn"><?php esc_html_e('Import', 'depot'); ?></button>
									<?php wp_nonce_field('mkd_import_theme_options_secret_value', 'mkd_import_theme_options_secret', false); ?>
									<span class="mkd-bckp-message"></span>
								</div>
							</div>
							<div class="mkd-page-form-section mkd-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'depot') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will overide all your existing options.', 'depot'); ?></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="mkd-page-form-section-holder">
							<h3 class="mkd-page-section-title"><?php esc_html_e('Export/Import Custom Sidebars', 'depot'); ?></h3>
							<div class="mkd-page-form-section">
								<div class="mkd-field-desc">
									<h4><?php esc_html_e('Export', 'depot'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'depot'); ?></p>
								</div>
								<!-- close div.mkd-field-desc -->

								<div class="mkd-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_options" id="export_options" class="form-control mkd-form-element" rows="10" readonly><?php echo mkd_core_export_custom_sidebars(); ?></textarea>
											</div>

										</div>
									</div>
								</div>
								<!-- close div.mkd-section-content -->

							</div>

							<div class="mkd-page-form-section">


								<div class="mkd-field-desc">
									<h4><?php esc_html_e('Import', 'depot'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'depot'); ?></p>
								</div>
								<!-- close div.mkd-field-desc -->



								<div class="mkd-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_custom_sidebars" id="import_custom_sidebars" class="form-control mkd-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
								<!-- close div.mkd-section-content -->

							</div>
							<div class="mkd-page-form-section">


								<div class="mkd-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="mkd-import-custom-sidebars-btn"><?php esc_html_e('Import', 'depot'); ?></button>
									<?php wp_nonce_field('mkd_import_custom_sidebars_secret_value', 'mkd_import_custom_sidebars_secret', false); ?>
									<span class="mkd-bckp-message"></span>
								</div>
							</div>
							<div class="mkd-page-form-section mkd-import-button-wrapper">

								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'depot') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will override all your existing custom sidebars.', 'depot'); ?></li>
									</ul>
								</div>
							</div>
						</div>

						<div class="mkd-page-form-section-holder">
							<h3 class="mkd-page-section-title"><?php esc_html_e('Export/Import Widgets', 'depot'); ?></h3>
							<div class="mkd-page-form-section">
								<div class="mkd-field-desc">
									<h4><?php esc_html_e('Export', 'depot'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'depot'); ?></p>
								</div>
								<!-- close div.mkd-field-desc -->

								<div class="mkd-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_widgets" id="export_widgets" class="form-control mkd-form-element" rows="10" readonly><?php echo mkd_core_export_widgets_sidebars(); ?></textarea>
											</div>

										</div>
									</div>
								</div>
								<!-- close div.mkd-section-content -->

							</div>

							<div class="mkd-page-form-section">


								<div class="mkd-field-desc">
									<h4><?php esc_html_e('Import', 'depot'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'depot'); ?></p>
								</div>
								<!-- close div.mkd-field-desc -->



								<div class="mkd-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_widgets" id="import_widgets" class="form-control mkd-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
								<!-- close div.mkd-section-content -->

							</div>
							<div class="mkd-page-form-section">


								<div class="mkd-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="mkd-import-widgets-btn"><?php esc_html_e('Import', 'depot'); ?></button>
									<?php wp_nonce_field('mkd_import_widgets_secret_value', 'mkd_import_widgets_secret', false); ?>
									<span class="mkd-bckp-message"></span>
								</div>
							</div>
							<div class="mkd-page-form-section mkd-import-button-wrapper">

								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'depot') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will override all your existing widgets.', 'depot'); ?></li>
									</ul>
								</div>
							</div>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>