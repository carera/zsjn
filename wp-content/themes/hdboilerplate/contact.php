<?php
/**
 * Template Name: Contact
 *
 * The template for displaying a contact page with form.
 *
 * @package HDboilerplate
 */
?>

<?php get_header(); ?>

		<div class="main-body">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-content">
						<?php if(isset($emailSent) && $emailSent == true) { ?>
							<div class="thanks">
								<p>Thanks, your email was sent successfully.</p>
							</div>
						<?php } else { ?>
							<?php the_content(); ?>
							<?php if(isset($hasError) || isset($captchaError)) { ?>
								<p class="error">Sorry, an error occured.<p>
							<?php } ?>

						<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
							<ul class="contactform">
							<li><br/>
								<label for="contactName">Name:</label>
								<br />
								<input class="contact_input" type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
								<?php if($nameError != '') { ?>
									<br /><span class="error"><?php echo $nameError;?></span>
								<?php } ?>
							</li>

							<li><br/>
								<label for="email">Email:</label>
								<br />
								<input class="contact_input" type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
								<?php if($emailError != '') { ?>
									<br /><span class="error"><?php echo $emailError;?></span>
								<?php } ?>
							</li>

							<li><br/>
								<label for="commentsText">Message:</label>
								<br />
								<textarea name="comments" id="commentsText" rows="10" cols="45" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
								
								<?php if($commentError != '') { ?>
									<br /><p><span class="error"><?php echo $commentError;?></span></p>
								<?php } ?>
							</li>

							<li>
								<p><input type="submit" value="Send Email"></p>
							</li>
						</ul>
						<input type="hidden" name="submitted" id="submitted" value="true" />
					</form>
				<?php } ?>
				</div><!-- .entry-content -->
			</div><!-- .post -->

				<?php endwhile; endif; ?>
			 
			 <?php edit_post_link( __( 'Edit&nbsp;Page', 'HDboilerplate' ), '', '' ); ?>

			 </div>
   
			 <!-- main widget sidebar -->	  
			 <div class="main-sidebar">
			   <?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
			 </div>		 
			 
		   </div>
	</div>


<?php get_footer(); ?>