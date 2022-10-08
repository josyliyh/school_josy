<?php
/**
 * school_josy functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package school_josy
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function school_josy_setup() {

	
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on school_josy, use a find and replace
		* to change 'school_josy' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'school_josy', get_template_directory() . '/languages' );

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
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'main-menu', 'school_josy' ),
		)
	);


	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'school_josy_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'school_josy_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function school_josy_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'school_josy_content_width', 640 );
}
add_action( 'after_setup_theme', 'school_josy_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function school_josy_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'school_josy' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'school_josy' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
}
add_action( 'widgets_init', 'school_josy_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function school_josy_scripts() {
	wp_enqueue_style( 'school_josy-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'school_josy-style', 'rtl', 'replace' );

	wp_enqueue_script( 'school_josy-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'school_josy_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



/**
 * Custom Post Types & Taxonomies.
 */

require get_template_directory() . '/inc/cpt-taxonomy.php';


// Change the excerpt lenth
function fwd_excerpt_length($length){
	return 25;
}
add_filter('excerpt_length', 'fwd_excerpt_length', 999);

// Add a link to the end of the excerpt
function fwd_excerpt_more( $more ) {
	if (is_page(77)){
	$more = '... <a class="read-more" href="'.esc_url(get_permalink()).'"> '.__('Read more about the student...','fwd').' </a>';
	return $more;
	} else {

	
		$more = '... <a class="read-more" href="'.esc_url(get_permalink()).'"> '.__('Read more','fwd').' </a>';
		return $more;
	}
}
add_filter( 'excerpt_more', 'fwd_excerpt_more' );




//student
function fwd_block_editor_templates() {
    // Replace '14' with the Page ID
    if ( isset( $_GET['post'] ) && '77' == $_GET['post'] ) {
        $post_type_object = get_post_type_object( 'page' );
        $post_type_object->template = array(
			array( 
				'core/paragraph', 
				array( 
					'placeholder' => 'Add your introduction here...'
				) 
			),
			array(
				'core/buttons',
				array(
					'placeholder' => 'Add your introduction here...'
				)
        	)
			);
			$post_type_object->template_lock = 'all';
			}
}

add_action( 'init', 'fwd_block_editor_templates' );

//image size
add_image_size( 'student-featured', 200, 300, true );
add_image_size( 'all-student-featured', 300, 200, true );

