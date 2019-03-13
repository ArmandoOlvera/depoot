<div class="mkd-fullscreen-search-holder">
	<div class="mkd-fullscreen-search-close-container">
		<div class="mkd-search-close-holder">
			<a class="mkd-fullscreen-search-close" href="javascript:void(0)">
				<span class="icon-arrows-remove"></span>
			</a>
		</div>
	</div>
	<div class="mkd-fullscreen-search-table">
		<div class="mkd-fullscreen-search-cell">
			<div class="mkd-fullscreen-search-inner">
				<form action="<?php echo esc_url(home_url('/')); ?>" class="mkd-fullscreen-search-form" method="get">
					<div class="mkd-form-holder">
						<div class="mkd-form-holder-inner">
							<div class="mkd-field-holder">
								<input type="text"  placeholder="<?php esc_html_e('Search for...', 'depot'); ?>" name="s" class="mkd-search-field" autocomplete="off" />
							</div>
							<button type="submit" class="mkd-search-submit"><span class="icon_search "></span></button>
							<div class="mkd-line"></div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>