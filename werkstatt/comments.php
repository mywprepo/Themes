<?php
/*-----------------------------------------------------------------------------------*/
/*  Begin processing our comments
/*-----------------------------------------------------------------------------------*/
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<?php if ( have_comments() ) : ?>
<!-- Start #comments -->
<div class="comments-container">
	<div class="row align-center">
		<div class="small-12 medium-10 large-7 columns">
			<h4 class="comments-title">
				<?php
					printf( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'comments', 'werkstatt' ),
						number_format_i18n( get_comments_number() ) );
				?>
			</h4>
		
				
			<ul class="commentlist cf">
				<?php wp_list_comments(
					array(
						'type'		  => 'all',
						'style'       => 'ul',
						'short_ping'  => true,
						'avatar_size' => 80
					)
				); ?>
			</ul>
			
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
				<div class="navigation">
					<div class="nav-previous"><?php previous_comments_link(); ?></div>
					<div class="nav-next"><?php next_comments_link(); ?></div>
				</div><!-- .navigation -->
			<?php } ?>
		</div>
	</div>
</div>
<?php else : 
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php _e("Comments are closed", 'werkstatt'); ?></p>
<?php endif; // end ! comments_open() ?>
		
<?php endif; // end have_comments() ?>
		
<div class="respond-container">
	<div class="row align-center">
		<div class="small-12 medium-10 large-7 columns">
<?php
	// Comment Form
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? ' aria-required="true" data-required="true"' : '' );
	
	$defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
	
		'author' => '<div class="row"><div class="small-12 medium-6 columns"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="' . esc_attr__( 'Name', 'werkstatt' ) . '" class="full"/></div>',
		
		'email'  => '<div class="small-12 medium-6 columns"><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="' . esc_attr__( 'Email', 'werkstatt' ) . '" class="full" /></div>',
		
		'url'    => '<div class="small-12 columns"><input name="url" size="30" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" type="text" placeholder="' . esc_attr__( 'Website', 'werkstatt' ) . '" class="full"/></div></div>' ) ),
		
		'comment_field' => '<div class="row"><div class="small-12 columns"><textarea name="comment" id="comment"' . $aria_req . ' rows="3" cols="58" class="full" placeholder="' . esc_attr__( 'Your Comment', 'werkstatt' ) . '"></textarea></div></div>',
		
		'must_log_in' => '<p class="must-log-in">' .  sprintf( wp_kses(__( 'You must be <a href="%s">logged in</a> to post a comment.', 'werkstatt' ), array('a' => array('href' => array(),'title' => array()))), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		
		'logged_in_as' => '<p class="logged-in-as">' . sprintf( wp_kses(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'werkstatt' ), array('a' => array('href' => array(),'title' => array()))), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		
		'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Your email address will not be published.', 'werkstatt' ) . '</p>',
		'comment_notes_after' => '',
		'id_form' => 'form-comment',
		'id_submit' => 'submit',
		'title_reply' => esc_html__( 'Leave a Reply', 'werkstatt' ),
		'title_reply_to' => esc_html__( 'Leave a Reply to %s', 'werkstatt' ),
		'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
		'title_reply_after' => '</h4>',
		'cancel_reply_link' => esc_attr__( 'Cancel reply', 'werkstatt' ),
		'class_submit' => 'submit btn',
		'label_submit' => esc_attr__( 'Submit Comment', 'werkstatt' ),
	); 
comment_form($defaults); 
?>
		</div>
	</div>
</div>
<!-- End #comments -->