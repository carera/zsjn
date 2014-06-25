<?php
/**
 * @package HDboilerplate
 */
	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>
 
<!-- You can start editing here. -->
 
<?php if ( have_comments() ) : ?>

	<p><h3 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3></p>
 
	<ol class="commentlist" style= "list-style:none;">
		<?php wp_list_comments('type=comment&callback=HDboilerplate_comment'); //this is the important part that ensures we call our custom comment layout defined above  ?>
	</ol>

	<ol style= "list-style:none;">
	<?php wp_list_comments(array('type' => 'trackback')); ?>
	<?php wp_list_comments(array('type' => 'pingback')); ?>
	</ol>

	<div class="clear"></div>
	<div class="comment-navigation">
		<div class="older"><?php previous_comments_link() ?></div>
		<div class="newer"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>
 
	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
 
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"></p>
 
	<?php endif; ?>
<?php endif; ?>
 
 
<?php if ( comments_open() ) : ?>
 
<div id="respond">
 
<br /> 
 
<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
<?php else : ?>
 
<?php  
	$post_id = get_the_ID();
	$aria_req = null;
	
	$defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
    'author' => '<br /><p class="comment-form-author">' .
                '<label for="author">' . __( 'Name', 'HDboilerplate' ) . ' *</label><br /> ' .
                '<input id="author" name="author" type="text" value="' .
                esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1"' . $aria_req . ' />' .
                '</p><!-- #form-section-author .form-section -->',
    'email'  => '<p class="comment-form-email">' .
                '<label for="email">' . __( 'Email', 'HDboilerplate' ) . ' *</label> ' .
                '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2"' . $aria_req . ' />' .
                '</p><!-- #form-section-email .form-section -->',
    'url'    => '<p class="comment-form-url">' .
                '<label for="url">' . __( 'Website', 'HDboilerplate' ) . '</label>' .
                '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" />' .
                '</p><!-- #form-section-url .form-section -->' ) ),
    'comment_field' => '<p class="comment-form-comment">' .
                '<label for="comment">' . __( 'Comment', 'HDboilerplate' ) . '</label>' .
                '<textarea id="comment" name="comment" cols="45" rows="8" tabindex="4" aria-required="true"></textarea>' .
                '</p><!-- #form-section-comment .form-section -->',
    'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
    'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%s">%s</a>. <a href="%s" title="Log out of this account">Log out?</a></p>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ),
    'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email is <em>never</em> published nor shared.', 'HDboilerplate' ) . ( $req ? __( ' Required fields are marked <span class="required">*</span>' ) : '' ) . '</p>',
     'id_form' => 'commentform',
    'id_submit' => 'submit',
    'title_reply' => __( 'Leave a Reply', 'HDboilerplate' ),
    'title_reply_to' => __( 'Leave a Reply to %s', 'HDboilerplate' ),
    'cancel_reply_link' => __( 'Cancel reply', 'HDboilerplate' ),
    'label_submit' => __( 'Post Comment', 'HDboilerplate' ),
  );
  comment_form($defaults); 
?>
 
<?php endif; // If registration required and not logged in ?>
</div>


<?php endif; // if you delete this the sky will fall on your head ?>