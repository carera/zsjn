<?php
 /**
 * HDboilerplate widgets
 *
 * @package HDboilerplate
 */
 
  /* Twitter */
 class HDb_Twitter_Widget extends WP_Widget {
	function HDb_Twitter_Widget() {
		$widget_ops = array('classname' => 'hdtwitter', 'description' => 'Show your latest tweets.' );
		$this->WP_Widget('hdtwitter', '[HD] Twitter', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;		
		echo '<div class="hdtwitter-box">';
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$twitter_name = empty($instance['twitter_name']) ? ' ' : apply_filters('widget_title', $instance['twitter_name']);	
		$limit = empty($instance['limit']) ? ' ' : apply_filters('widget_title', $instance['limit']);	
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo '<div class="oh">';
		echo '<ul id="twitter_update_list"><li>Twitter loading...</li></ul>';
		echo '</div>';
		echo '</div>';
		?>
		<script type="text/javascript">
		function twitterCallback2(twitters) {
		  var statusHTML = [];
		  for (var i=0; i<twitters.length; i++){
			var username = twitters[i].user.screen_name;
			var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
			  return '<a href="'+url+'">'+url+'</a>';
			}).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
			  return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
			});
			statusHTML.push('<li><span>'+status+'</span> <a class="twitter_item" href="http://twitter.com/'+username+'/statuses/'+twitters[i].id_str+'">'+relative_time(twitters[i].created_at)+'</a></li>');
		  }
		  document.getElementById('twitter_update_list').innerHTML = statusHTML.join('');
		}
		
		function relative_time(time_value) {
		  var values = time_value.split(" ");
		  time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
		  var parsed_date = Date.parse(time_value);
		  var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
		  var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
		  delta = delta + (relative_to.getTimezoneOffset() * 60);
		
		  if (delta < 60) {
			return 'less than a minute ago';
		  } else if(delta < 120) {
			return 'about a minute ago';
		  } else if(delta < (60*60)) {
			return (parseInt(delta / 60)).toString() + ' minutes ago';
		  } else if(delta < (120*60)) {
			return 'about an hour ago';
		  } else if(delta < (24*60*60)) {
			return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
		  } else if(delta < (48*60*60)) {
			return '1 day ago';
		  } else {
			return (parseInt(delta / 86400)).toString() + ' days ago';
		  }
		}
		</script>
		<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo $twitter_name; ?>.json?callback=twitterCallback2&count=<?php echo $limit; ?>"></script>
		<?php
		
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter_name'] = strip_tags($new_instance['twitter_name']);
		$instance['limit'] = strip_tags($new_instance['limit']);
		
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'twitter_name' => '', 'limit' => '' ) );
		$title = strip_tags($instance['title']);
		$twitter_name = strip_tags($instance['twitter_name']);
		$limit = strip_tags($instance['limit']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('twitter_name'); ?>">Username: <input class="widefat" id="<?php echo $this->get_field_id('twitter_name'); ?>" name="<?php echo $this->get_field_name('twitter_name'); ?>" type="text" value="<?php echo esc_attr($twitter_name); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('limit'); ?>">Limit: <input class="widefat"  class="admin_input_limit"  id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo esc_attr($limit); ?>" /></label></p>

		<?php
	}
}
register_widget('HDb_Twitter_Widget');




 /* Tag Cloud */
class HDb_Tags_Widget extends WP_Widget {
	function HDb_Tags_Widget() {
		$widget_ops = array('classname' => 'hdtags', 'description' => 'Shows tags as buttons' );
		$this->WP_Widget('hdtags', '[HD] Tags', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };

		$args = array(
		   'smallest'                  => 8, 
   		   'largest'                   => 10,		
		   'number'                    => 25,  
		   'format'                    => 'array',
		   'orderby'                   => 'name', 
		   'order'                     => 'ASC',
		   'link'                      => 'view', 
		   'taxonomy'                  => 'post_tag',
		   'echo'                      => false ); 
		
		echo '<div class="tag_cloud">';

		$tags = wp_tag_cloud($args);
		foreach ($tags as $tag) {
			echo '<div class="tag-cloud"><a href="category/'.$tag.'">'.$tag.'</a></div>';
		}
		echo '</div>';
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<?php
	}
}
register_widget('HDb_Tags_Widget');




 /* Archives */
class HDb_Archives_Widget extends WP_Widget {
	function HDb_Archives_Widget() {
		$widget_ops = array('classname' => 'hdarchives', 'description' => 'Shows archives by month in two columns.' );
		$this->WP_Widget('hdarchives', '[HD] Archives', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo '<ul class="double-list">';
		wp_get_archives('monthly', '', 'html', '', '', false);
		echo '</ul><div class="clear"></div>';
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<?php
	}
}
register_widget('HDb_Archives_Widget');




 /* Categories */
class HDb_Categories_Widget extends WP_Widget {
	function HDb_Categories_Widget() {
		$widget_ops = array('classname' => 'hdcategories', 'description' => 'Shows categories in two columns.' );
		$this->WP_Widget('hdcategories', '[HD] Categories', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };

		echo '<div><ul class="double-list">';
		$categories = get_categories('order=DESC&orderby=count');
		foreach ($categories as $category) {
			echo '<li><a href="category/'.$category->cat_name.'">'.$category->cat_name.' ('.$category->category_count.')</a></li>';
		}
		echo '</ul></div><div class="clear"></div>';
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<?php
	}
}
register_widget('HDb_Categories_Widget');




 /* Recent Comments */
class HDb_RecentComents_Widget extends WP_Widget {
	function HDb_RecentComents_Widget() {
		$widget_ops = array('classname' => 'hdrecentcoments', 'description' => 'Shows recent coments.' );
		$this->WP_Widget('hdrecentcomments', '[HD] Recent Comments', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$limit = empty($instance['limit']) ? ' ' : apply_filters('widget_title', $instance['limit']);
		
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };

		$args = array(
			'status' => 'approve',
			'type' => 'comment',
			'number' => $limit
		);
		
		echo '<ul id="recent-comments"">';
		$comments = get_comments($args);
		foreach($comments as $comment) :
			$post_id = get_post($comment->comment_post_ID,ARRAY_A); 
			echo('<li class="recent-comment-item">'.get_avatar($comment->comment_author_email, 40).'<span class="recent-comments-item">'.$comment->comment_author.'</span> on:<br /><a href="'.get_permalink($post_id['ID']).'#comment-'.$comment->comment_ID.'">'.$post_id['post_title'].'</a>' . '<div class="recent-comment-body">'.$comment->comment_content).'</div></li>';
		endforeach;
		echo '</ul>';
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['limit'] = strip_tags($new_instance['limit']);
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'limit' => '' ) );
		$title = strip_tags($instance['title']);
		$limit = strip_tags($instance['limit']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('limit'); ?>">Limit: <input class="widefat"  class="admin_input_limit"  id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo esc_attr($limit); ?>" /></label></p>

		<?php
	}
}
register_widget('HDb_RecentComents_Widget');




 /* Recent Posts */
class HDb_RecentPosts_Widget extends WP_Widget {
	function HDb_RecentPosts_Widget() {
		$widget_ops = array('classname' => 'hdrecentposts', 'description' => 'Shows recent posts with featured images.' );
		$this->WP_Widget('hdrecentposts', '[HD] Recent Posts', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$limit = empty($instance['limit']) ? ' ' : apply_filters('widget_title', $instance['limit']);
		
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		
		echo '<ul id="recent-posts">';
		
		$pc = new WP_Query('&posts_per_page='.$limit);
		 
		while ($pc->have_posts()) : $pc->the_post();
		
		  echo '<li class="recent-posts-label">';
		  echo '<a href="'.get_permalink().'" title="'.get_the_title().'">'.the_post_thumbnail(array(50,35)).'</a>';
		  echo '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';
		   
		  ?>		
		  <div class="widget_text_line">
		   By <?php the_author() ?> on
		   <?php the_time('M jS, Y') ?>		   
        |
		   <?php comments_popup_link('Add Comment', '1 Comment', '% Comments'); ?>
		   </span>
		  </div>
		  
		  <?php		  
		  echo '</li>';
		 
		endwhile;
		
		echo '</ul>';
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['limit'] = strip_tags($new_instance['limit']);
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'limit' => '' ) );
		$title = strip_tags($instance['title']);
		$limit = strip_tags($instance['limit']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('limit'); ?>">Limit: <input class="widefat"  class="admin_input_limit"  id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo esc_attr($limit); ?>" /></label></p>
		<?php
	}
}
register_widget('HDb_RecentPosts_Widget');




 /* Popular Posts (Horizontal) */
class HDb_AboveFold_Widget extends WP_Widget {
	function HDb_AboveFold_Widget() {
		$widget_ops = array('classname' => 'hdabovefold', 'description' => 'Shows popular posts with featured images in a horizontal pattern.' );
		$this->WP_Widget('hdabovefold', '[HD] Above the Fold. (Horizontal)', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		
		echo '<div class="oh">';
		
		$pc = new WP_Query('orderby=comment_count&posts_per_page=4&meta_key=_thumbnail_id');
		$c=0;
		 
		while ($pc->have_posts()) : $pc->the_post();
		  echo '<div class="popular-item-'.$c.'">';
		    echo '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_post_thumbnail(get_the_ID(),array(214,214),array('class' => 'linkButton popular-item-img')).'</a>';
		    echo '<div class="popular-item-title">';
		    echo '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';
		    echo '</div>';
		   //the_author()
		   //the_time('F jS, Y')
		   //comments_popup_link('No Comments', '1 Comment', '% Comments');
		  echo '</div>';
		  $c++;
		endwhile;
		
		echo '</div>';
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		return null;
	}
	function form($instance) {
	}
}
register_widget('HDb_AboveFold_Widget');




 /* Youtube Widget */
class HDb_YouTube_Widget extends WP_Widget {
	function HDb_YouTube_Widget() {
		$widget_ops = array('classname' => 'hdyoutube', 'description' => 'Embeds a YouTube video by using the url found on the YouTube page.' );
		$this->WP_Widget('hdyoutube', '[HD] YouTube Video', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$url = empty($instance['url']) ? ' ' : apply_filters('widget_url', $instance['url']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		
		echo '<p><iframe width="370" height="260" src="'.$url.'" frameborder="0" allowfullscreen></iframe></p>';
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['url'] = strip_tags($new_instance['url']);
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'url' => '' ) );
		$title = strip_tags($instance['title']);
		$url = strip_tags($instance['url']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('url'); ?>">Embed URL: <input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo esc_attr($url); ?>" /></label></p>
<?php
	}
}
register_widget('HDb_YouTube_Widget');




 /* Popular Posts (Sidebar) */
class HDb_PopularPostsVertical_Widget extends WP_Widget {
	function HDb_PopularPostsVertical_Widget() {
		$widget_ops = array('classname' => 'hdpopularpostsvertical', 'description' => 'Shows popular posts with featured images.' );
		$this->WP_Widget('hdpopularpostsvertical', '[HD] Popular Posts', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$limit = empty($instance['limit']) ? ' ' : apply_filters('widget_title', $instance['limit']);
		
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		
		echo '<ul id="popular-posts">';
		
		$pc = new WP_Query('orderby=comment_count&posts_per_page='.$limit);
		 
		while ($pc->have_posts()) : $pc->the_post();
		
		  echo '<li class="popular-posts-label">';
		  echo '<a href="'.get_permalink().'" title="'.get_the_title().'">'.the_post_thumbnail(array(40,40)).'</a>';
		  echo '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';
		   
		  ?>
		  <br />
		  <span class="widget_text_line">
		   By <?php the_author() ?> on
		   <?php the_time('M jS, Y') ?>
			 |
       <?php comments_popup_link('Add Comment', '1 Comment', '% Comments'); ?>
		  </span>
		  </li>
		  
		  <?php		  
		  echo '</li>';
		 
		endwhile;
		
		echo '</ul>';
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['limit'] = strip_tags($new_instance['limit']);
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'limit' => '' ) );
		$title = strip_tags($instance['title']);
		$limit = strip_tags($instance['limit']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('limit'); ?>">Limit: <input class="widefat"  class="admin_input_limit"  id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo esc_attr($limit); ?>" /></label></p>

<?php
	}
}
register_widget('HDb_PopularPostsVertical_Widget');
?>