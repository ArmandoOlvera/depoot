<?php depot_mikado_get_content_bottom_area(); ?>
</div> <!-- close div.content_inner -->
	</div>  <!-- close div.content -->
		<?php if($display_footer) { ?>
			<footer class="mkd-page-footer">
				<?php
					if($display_footer_top) {
						depot_mikado_get_footer_top();
					}
					if($display_footer_bottom) {
						depot_mikado_get_footer_bottom();
					}
				?>
			</footer>
		<?php } ?>
	</div> <!-- close div.mkd-wrapper-inner  -->
</div> <!-- close div.mkd-wrapper -->
<?php wp_footer(); ?>
</body>
</html>