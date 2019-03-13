<?php
if ( post_password_required() ) {
	return;
}

if ( comments_open() || get_comments_number()) { ?>

	<div class="mkd-comment-holder clearfix <?php if(get_comments_number() == 0){echo "mkd-comment-holder-no-comments";} ?>" id="comments">
		<div class="mkd-comment-holder-inner">
			<div class="mkd-comments-title">
				<h3><span class="mkd-comments-number"> <?php comments_number(); ?> </span></h3>
			</div>
			<div class="mkd-comments">
				<?php if ( have_comments() ) { ?>
					<ul class="mkd-comment-list">
						<?php wp_list_comments(array( 'callback' => 'depot_mikado_comment')); ?>
					</ul>
				<?php } ?>
				<?php if( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' )) { ?>
					<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'depot'); ?></p>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php
		$mkd_commenter = wp_get_current_commenter();
		$mkd_req = get_option( 'require_name_email' );
		$mkd_aria_req = ( $mkd_req ? " aria-required='true'" : '' );

		$mkd_args = array(
			'id_form' => 'commentform',
			'id_submit' => 'submit_comment',
			'title_reply'=> esc_html__( 'LEAVE A COMMENT','depot' ),
			'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
			'title_reply_after' => '</h3>',
			'title_reply_to' => esc_html__( 'Post a Reply to %s','depot' ),
			'cancel_reply_link' => esc_html__( 'cancel reply','depot' ),
			'label_submit' => esc_html__( 'POST COMMENT','depot' ),
			'comment_field' => '<textarea id="comment" placeholder="'.esc_html__( 'Write a comment...','depot' ).'" name="comment" cols="45" rows="6" aria-required="true"></textarea>',
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<input id="author" name="author" placeholder="'. esc_html__( 'Full Name*','depot' ) .'" type="text" value="' . esc_attr( $mkd_commenter['comment_author'] ) . '"' . $mkd_aria_req . ' />',
				'email' => '<input id="email" name="email" placeholder="'. esc_html__( 'Email Address*','depot' ) .'" type="text" value="' . esc_attr(  $mkd_commenter['comment_author_email'] ) . '"' . $mkd_aria_req . ' />',
				'website' => '<input id="url" name="url" placeholder="'. esc_html__( 'Website','depot' ) .'" type="text" value="' . esc_attr(  $mkd_commenter['comment_author_url'] ) . '"' . $mkd_aria_req . ' />'
				 ) ) );
	 ?>
	<?php if(get_comment_pages_count() > 1){ ?>
		<div class="mkd-comment-pager">
			<p><?php paginate_comments_links(); ?></p>
		</div>
	<?php } ?>
	<div class="mkd-comment-form">
		<div class="mkd-comment-form-inner">
			<?php comment_form($mkd_args); ?>
		</div>
	</div>
<?php } ?>
