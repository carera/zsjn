<?php $option =  get_option('scl_options'); ?>
<style type="text/css">
/*Primary Color*/
#topmenu ul .current-menu-parent ul .current-menu-item, #topmenu ul li ul li a:hover, #topmenu ul li .sub-menu .current-menu-item a:hover, #slide_wrap, #lay1 .post, #lay2 .post, #slide_acord, #lay4 .post, .post, .type-page, .type-attachment, .amp_page, .amp_next, .amp_prev, .page-numbers, .comment-body, #respond, .share_this, #related {background:#f2ebe3 url(<?php echo get_template_directory_uri(); ?>/images/<?php echo $option['scl_patterns'] ?>.png) repeat!important;}

/*Secondary Color*/
#topmenu ul li:hover, #topmenu ul li.current-menu-item, #topmenu ul .current-menu-item ul li, #topmenu ul li ul li, #prevBtn, #nextBtn, #lay1 .date, #lay2 .block_comm, .post .date, .type-page .date, .type-attachment .date, .post tr th, .post thead th, #posts .sticky, .more-link, .amp_current, .amp_page:hover, .amp_next:hover, .amp_prev:hover, .page-numbers:hover, .navigation .current, #respond #submit, .bypostauthor .comment-body, #related h3, .entry-content #submit_msg, .trigger_wrap, .scl_button { background:#84b1b4 url(<?php echo get_template_directory_uri(); ?>/images/<?php echo $option['scl_patterns'] ?>.png) repeat!important; }

.post .post_content a, .page .post_content a{color:#84B1B4!important;}

/*Widgets*/
#sidebar ul .widget{ background:#84b1b4 url(<?php echo get_template_directory_uri(); ?>/images/<?php echo $option['scl_patterns'] ?>.png) repeat!important; }

#sidebar .widgettitle{background:#f2ebe3 url(<?php echo get_template_directory_uri(); ?>/images/<?php echo $option['scl_patterns'] ?>.png) repeat;}


/*Background COLOR*/
body { background:#33282c!important;}

/*Background Pattern*/
.pattern{ background:url(<?php echo get_template_directory_uri(); ?>/images/<?php echo $option['scl_patterns'] ?>.png) repeat!important; }


/*FEATURED RIBBON*/

.ribbon{ color:#ffffff!important; background:#84b1b4 url(<?php echo get_template_directory_uri(); ?>/images/<?php echo $option['scl_patterns'] ?>.png) repeat!important;}

/*THE DATE BADGE*/
.post .date, .type-page .date, .type-attachment .date, #lay1 .date, #lay2 .date{ color:#405c5e!important; background:#84b1b4 url(<?php echo get_template_directory_uri(); ?>/images/<?php echo $option['scl_patterns'] ?>.png) repeat!important;}


/*FONT COLOR*/
/*-------------*/
/*LOGO and Other Outside Elements*/
#logo a, #topmenu ul li a, #footmenu ul li a, #comments, body, .towfiq{ color:#f2ebe3!important;}

/*Primary Colors- Font color*/
#prevBtn a, #nextBtn a, #lay1 .post, #lay2 .post, #lay4 .post, .post, .type-page, .type-attachment, .post a, .type-page a, .type-attachment a, .amp_page, .amp_next, .amp_prev, .page-numbers, .comments_template a, .comment-body, #respond, #respond input, #respond textarea, #related a, .entry-content input, .entry-content textarea{ color:#33282c!important;}

#lay1 .post_meta a, #posts .block_comm2 a{color: #33282c!important;}

/*Secondary Colors- FOnt COLOR*/
#topmenu ul li:hover a, #topmenu ul li.current-menu-item a, #topmenu ul .current-menu-item a, #topmenu ul .current-menu-item ul li a, #topmenu ul li ul li a, .post tr th, .post thead th, .amp_current, .amp_page:hover, .amp_next:hover, .amp_prev:hover, .page-numbers:hover, .navigation .current, .bypostauthor a, #posts .sticky a, #related h3  { color:#ffffff!important;}

/*WIDGET Font COLOR*/
#sidebar a, #sidebar{ color:#ffffff!important;}
#sidebar h3, #sidebar h3 a{ color:#33282c!important;}

/*POST TITLE COLOR*/
#posts .postitle, #posts .postitle a, #content .postitle a{ color:#405C5E!important;}
#content .more-link{ color:#ffffff!important;}

</style>