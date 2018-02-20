<?php
/**
 * Simple functions and definitions
 *
 * @package Simple
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'simple_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function simple_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Simple, use a find and replace
	 * to change 'simple' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'simple', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'simple' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'simple_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // simple_setup
add_action( 'after_setup_theme', 'simple_setup' );

/**
 * Enqueue scripts and styles.
 */
function simple_scripts() {
	wp_enqueue_style( 'simple-style', get_stylesheet_uri() );

	wp_enqueue_script( 'simple-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'simple-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'simple_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

add_theme_support( 'html5', array( 'search-form' ) );


/**
 * Reply form fields
 */
function simple_reply_fields($fields) {
	$fields['author'] = '<p class="comment-form-author"><input id="author" name="author" type="text" value="" placeholder="姓名" size="30" aria-required="true"></p>';
	$fields['email'] = '<p class="comment-form-email"><input id="email" name="email" type="text" value="" placeholder="电子邮件" size="30" aria-required="true"></p>';
	$fields['url'] = '<p class="comment-form-url"><input id="url" name="url" type="text" placeholder="网址" value="" size="30"></p>';
	return $fields;
}
add_filter('comment_form_default_fields','simple_reply_fields');


/**
 * Gavatar
 */
function simple_get_https_avatar($avatar) {
	// Replacement for HTTPS domain
	$avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "secure.gravatar.com", $avatar);
	// Replacement for HTTPS protocol
	$avatar = str_replace("http", "https", $avatar);
	return $avatar;
}
add_filter('get_avatar', 'simple_get_https_avatar');

/**
* E-mail notify
*/
function comment_mail_notify($comment_id) {
  $comment = get_comment($comment_id);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  $spam_confirmed = $comment->comment_approved;
  if (($parent_id != '') && ($spam_confirmed != 'spam')) {
    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 发出点, no-reply 可改为可用的 e-mail.
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option("blogname") . '] 的留言有了新回复';
    $message = '
    <div>
      <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
      <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br /><blockquote>'
       . trim(get_comment($parent_id)->comment_content) . '</blockquote></p>
      <p>' . trim($comment->comment_author) . ' 给您的回复:<br /><blockquote>'
       . trim($comment->comment_content) . '</blockquote></p>
      <p>您可以<a href="" target="_blank">点击</a>查看回复完整內容</p>
      <p>欢迎再度光临 <a href="' . esc_url( home_url( '/' ) ) .' rel="home">' . bloginfo( 'name' ) . '</a></p>
      <p>(此邮件由系统自动发送，请勿回复.)</p>
    </div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
  }
}
add_action('comment_post', 'comment_mail_notify');

/* Archives */
function archives_shortcode() {
	$ret = "<div class='contents'><section id='posts' class='posts-collapse'>";
	$argc = array (
		'posts_per_page' => 1000
	);
	$posts = get_posts( $argc );
	$lastYear = 0;
	foreach($posts as $post) {
		$currentYear =get_the_date('Y', $post->ID);
		if ($currentYear != $lastYear) {
			$lastYear = $currentYear;
			$ret .= "<div class='collection-title'>";
			$ret .= "	<h2 class='archive-year' id='archive-year-'".$currentYear."'>".$currentYear."</h2>";
			$ret .= "</div>";
		}

		$ret .= "<article class='post post-type-normal'>";
		$ret .= "	<header class='post-header'>";
		$ret .= "		<h1 class='post-title'>";
		$ret .= "			<a class='post-title-link' href='".get_permalink($post)."' target='_blank'>";
		$ret .= "				<span>".$post->post_title."</span>";
		$ret .= "			</a>";
		$ret .= "		 </h1>";
		$ret .= "		<div class='post-meta'>";
		$ret .= "			<time class='post-time' datetime='".esc_attr(get_the_date('c', $post->ID))."'>";
		$ret .= "				".esc_html(get_the_date('m-d', $post->ID));
		$ret .= "			</time>";
		$ret .= "		</div>";
		$ret .= "	</header>";
		$ret .= "</article>";
	}
	$ret .= "</section></div>";
	return $ret;
}
add_shortcode('archives', 'archives_shortcode');

/* Categories */
function categories_shortcode() {
	$ret = "<div class='category-all-page'>";
	$ret .= "	<div class='category-all-title'>";
	$categories = get_categories();
	$ret .= "		目前共计 ".count($categories)." 个分类";
	$ret .= "	</div>";
	$ret .= "	<div class='category-all'>";
	$ret .= "		<ul class='category-list'>";
	foreach ($categories as $category) {
		$ret .= "			<li class='category-list-item'>";
		$ret .= "				<a class='category-list-link' href='".get_category_link( $category->term_id )."'>".$category->name."</a>";
		$ret .= "				<span class='category-list-count'>".$category->count."</span>";
		$ret .= "			</li>";
	}
	$ret .= "		</ul>";
	$ret .= "	</div>";
	$ret .= "</div>";
	return $ret;
}
add_shortcode('categories', 'categories_shortcode');
?>