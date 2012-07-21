<?php 
// This file sets up the theme and provides some helper functions. Some helper functions
// are used in the theme as custom template tags. Others are attached to action and
// filter hooks in WordPress to change core functionality.

// A constant version number used for cache-busting.
// Update this when you make changes to styles or scripts.
// See <http://html5boilerplate.com/docs/Version-Control-with-Cachebusting/>
// for more info.
define('EUSF_VER', '0.1');

// Set template dir as a constant so we only have to access it once.
define('EUSF_DIR', trailingslashit(get_template_directory()));
// Set template url as a constant so we only have to access it once.
define('EUSF_URL', trailingslashit(get_template_directory_uri()));

// Set the $content_width global variable. This will make sure that videos
// and images will fit into the content area by default.
if ( !isset( $content_width ) ) {
    $content_width = 620;    
}


// eusf_setup() sets up the theme by registering support
// for various features in WordPress, such as post thumbnails, navigation menus.
function eusf_setup() {
    // Pull in external library files.
    require_once(EUSF_DIR . 'inc/template-tags.php' );
    // Pull in external library files.
    require_once(EUSF_DIR . 'inc/carousel.php' );
    require_once(EUSF_DIR . 'inc/attachment-custom-fields.php' );

    $attachment_url_field = new EUSF_Attachment_Custom_Field('eusf_url', array(
        'label' => __('Carousel URL', 'eusf'),
        'helps' => __('Entering a URL here will cause the attachment to be linked when displayed in the carousel.', 'eusf'),
        'input' => 'text'
    ), 'esc_url');

    $attachment_url_field->attach_hooks();

    // Add default posts and comments RSS feed links to <head>.
    add_theme_support( 'automatic-feed-links' );

    // Register a nav menu for the primary nav.
    register_nav_menu( 'primary', __('Primary Navigation', 'eusf') );

    // This theme uses Featured Images (also known as post thumbnails)
    // for per-post/per-page Custom Header images
    add_theme_support( 'post-thumbnails' );

    // Larger images will be auto-cropped to fit, smaller ones will be ignored.
    set_post_thumbnail_size( 250, 100, true );

    // Hero size is used for the home page carousel.
    add_image_size( 'hero', 976, 518, true );
    // Widescreen hero is used for single page banners.
    add_image_size( 'hero-widescreen', 976, 240, true );
}
add_action('after_setup_theme', 'eusf_setup');

// Register sidebar areas for the theme.
function eusf_widgets_init() {
    $sidebar_defaults = array(
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="title">',
        'after_title'   => '</h1>'
    );

    register_sidebar(array_merge($sidebar_defaults, array(
        'name' => __('Footer 1'),
        'id' => 'footer-1',
        'description' => 'The left-most widget area in the footer area'
    )));

    register_sidebar(array_merge($sidebar_defaults, array(
        'name' => __('Footer 2'),
        'id' => 'footer-2',
        'description' => 'The middle widget area in the footer area'
    )));

    register_sidebar(array_merge($sidebar_defaults, array(
        'name' => __('Footer 3'),
        'id' => 'footer-3',
        'description' => 'The right-most widget area in the footer area'
    )));
}
add_action('widgets_init', 'eusf_widgets_init');

// Enqueueu CSS and JS for the theme. If you want to add a stylesheet or script,
// this is the place to do it.
// 
// At the point this function is run, contextual functions like `is_home` are
// available.
function eusf_enqueue_assets() {
    $style_css = get_bloginfo('stylesheet_url');
    $assets = EUSF_URL . 'assets/';

    wp_enqueue_script(
        // Give this script a handle.
        'bootstrap-carousel',
        // Tell WordPress where to find it.
        $assets . 'bootstrap-transition-carousel.js',
        // Tell WordPress what other scripts it requires (by specifying
        // an array of handles).
        array('jquery'),
        // Finally, give it a cache-busting number.
        EUSF_VER
    );

    wp_enqueue_script(
        'eusf',
        $assets . 'main.js',
        array('bootstrap-carousel'),
        EUSF_VER
    );

    wp_enqueue_style('normalize', $assets . 'normalize.css', array(), EUSF_VER);

    wp_enqueue_style('grid-12-col', $assets . 'grid-12-col.css', array(), EUSF_VER);

    // Add the default stylesheet (style.css).
    wp_enqueue_style('eucharist', $style_css, array(
        'normalize',
        'grid-12-col'
    ), EUSF_VER);
}
add_action('wp_enqueue_scripts', 'eusf_enqueue_assets');

// Print the <title> tag based on what is being viewed.
function eusf_the_page_title() {
    global $page, $paged;

    wp_title( '|', true, 'right' );

    // Add the blog name.
    bloginfo( 'name' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
}

function eusf_js_class() { ?>
<script type="text/javascript">
  // Replace `no-js` class with `js` class. Useful for preventing flash
  // of unscripted content accessibly.
  var h = document.getElementsByTagName('html')[0];
  h.className = h.className.replace('no-js', 'js');
</script>
<?php
}
add_action('wp_head', 'eusf_js_class', 8);

// Output Google Analytics script.
function eusf_google_analytics() { ?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-16724685-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php
}
add_action('wp_footer', 'eusf_google_analytics');
?>