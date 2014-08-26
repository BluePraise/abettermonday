<?php
/* Functions build by Mayconnect.
*  This is an adaptation to your site
*/

add_action('after_setup_theme','mayconnect_launch', 16);

// Setup contet
if ( ! isset( $content_width ) )
  $content_width = 960;


function mayconnect_launch() {
  mayconnect_theme_support();
  remove_action('wp_enqueue_scripts', 'scripts_and_styles', 999);
  add_action('wp_enqueue_scripts', 'scripts_and_styles', 999);
  add_action('init', 'mayconnect_header_cleanup');
  add_action( 'init', 'register_mayconnect_menu' );
  remove_action( 'init', 'webfont_google_fonts', 10 );
  add_action( 'init', 'webfont_google_fonts', 10 );
  add_action( 'widgets_init', 'mayconnect_widgets_init' ); //adds widgets on the frontend
  add_action( 'wp_dashboard_setup', 'mayconnect_setup_dashboard_widgets' );
  remove_filter( 'excerpt_length', 'custom_excerpt_length', 999);
  add_filter( 'excerpt_length', 'custom_excerpt_length', 999);
  remove_filter( 'excerpt_more', 'new_excerpt_more');
  // add_action( 'pre_get_posts', 'get_my_work' );
  add_filter( 'excerpt_more', 'new_excerpt_more');
  // add_filter('post_class', 'category_id_class');
  // add_filter('body_class', 'category_id_class');

} /* end */

///=============================================
// CLEANING UP THE HEADER
//=============================================


function mayconnect_header_cleanup() {

  remove_action( 'wp_head', 'feed_links_extra'); // Display the links to the extra feeds such as category feeds
  remove_action( 'wp_head', 'feed_links'); // Display the links to the general feeds: Post and Comment Feed
  remove_action( 'wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
  remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
  remove_action( 'wp_head', 'index_rel_link' ); // index link
  remove_action( 'wp_head', 'parent_post_rel_link', 10); // prev link
  remove_action( 'wp_head', 'start_post_rel_link', 10); // start link
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10); // Display relational links for the posts adjacent to the current post.
  remove_action( 'wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
  add_filter( 'style_loader_src', 'remove_wp_ver_css_js', 9999 ); // remove WP version from css
  add_filter( 'script_loader_src', 'remove_wp_ver_css_js', 9999 ); // remove Wp version from scripts

} /* end of cleanup */

// remove WP version from scripts
function remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

///=============================================
// SCRIPTS AND STYLES ENQUEUING
//=============================================


// Deregistering styles and scripts that might be in the wp core.
// Registering all kinds of cool styles and scripts. Including Genericons
function scripts_and_styles() {
  global $wp_styles;
  if (!is_admin()) {

    wp_deregister_script('jquery');
    wp_deregister_style( 'genericons', get_stylesheet_directory_uri() . '/genericons/genericons.css', array(), '2.09' );
    wp_deregister_style( 'twentythirteen-style-css');

    // register main stylesheets
    wp_register_style( 'stylesheet', get_stylesheet_directory_uri() . '/stylesheets/style.css', array(), '', 'all' );
    wp_register_style( 'genericons', get_stylesheet_directory_uri() . '/stylesheets/genericons/genericons.css', array(), '', 'all' );

    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
    wp_register_script( 'jquery', get_stylesheet_directory_uri() . '/js/jquery.min.js', array(), '', false );
    wp_register_script( 'html5-script', get_stylesheet_directory_uri() . '/js/html5.js', array( 'jquery' ), '', false );
    wp_register_script( 'my-script', get_stylesheet_directory_uri() . '/js/mayconnectscript.js', array( 'jquery' ), '', false );
    // wp_register_script( 'stellar', get_stylesheet_directory_uri() . '/js/stellar/jquery.stellar.min.js', array( 'jquery' ), '', true );

    // enqueue styles and scripts
    wp_enqueue_style( 'stylesheet' );
    wp_enqueue_style( 'genericons' );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'html5-script' );
    wp_enqueue_script( 'my-script' );
    // wp_enqueue_script( 'stellar' );
  }
}


///=============================================
// LOAD GOOGLE WEBFONTS
//=============================================

  function webfont_google_fonts() {
  if ( !is_admin() ) {
    wp_register_style( 'webfont_sourcesanspro', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900', '', null, 'screen' );
    wp_register_style( 'webfont_sourcesanspro', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900', '', null, 'screen' );
    wp_enqueue_style( 'webfont_sourcesanspro' );
  }
}

///=============================================
// THEME SUPPORT
//=============================================

function mayconnect_theme_support() {
  add_theme_support( 'custom-background',
      array(
      'default-image' => '',  // background image default
      'default-color' => 'FAFAFA', // background color default (dont add the #)
      'wp-head-callback' => '_custom_background_cb',
      'admin-head-callback' => '',
      'admin-preview-callback' => ''
      )
  );

  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 150, 150);

	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

}
///=============================================
// MENUS AND NAVIGATION
//=============================================

// the main menu
function mayconnect_main_menu(){

    wp_nav_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => '',           				      // class of container (should you choose to use it)
    	'menu' => __( 'Main Menu', 'abm' ),       		  // nav name
      'menu_class' => 'nav-menu',         			      // adding custom nav class
    	'theme_location' => 'Main Menu',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
      'after' => '',                                  // after the menu
      'link_before' => '',                            // before each link
      'link_after' => '',                             // after each link
      'depth' => 0                                    // limit the depth of the nav 'fallback_cb'=> ''
	));
} /* end mayconnect main nav */

function register_mayconnect_menu() {
  register_nav_menus(
    array(
      'main-menu' => __( 'Main Menu' )
    )
  );
}

///=============================================
// SIDEBARS AND WIDGETS
//=============================================

function mayconnect_widgets_init() {

  register_sidebar( array(
    'name'          => 'Main left sidebar',
    'id'            => 'left-archive',
    'description'   => __( 'wordt zichtbaar bovenaan in de linkerzijde van je pagina', 'abm'),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'));

  register_sidebar( array(
    'name'          => __( 'Secondary Widget Area', 'abm' ),
    'id'            => 'sidebar-2',
    'description'   => __( 'Appears on posts and pages in the sidebar.', 'mayconnect-theme' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
) );
}

//=============================================
// META INFORMATION
//=============================================
// This was taken from the twentythirteen theme. I adapted it.
if ( ! function_exists( 'mayconnect_entry_meta' ) ) :

  function mayconnect_entry_meta() {
    if ( is_sticky() && is_home() && ! is_paged() )
      echo '<span class="featured-post">' . __( 'Sticky', 'mayconnect' ) . '</span>';
    if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
        mayconnect_entry_date();

      // Translators: used between list items, there is a space after the comma.
      $categories_list = get_the_category_list( __( ', ', 'mayconnect' ) );
      if ( $categories_list ) {
        echo '<span class="categories-links">' . $categories_list . '</span>';
      }

      // Translators: used between list items, there is a space after the comma.
      // $tag_list = get_the_tag_list( '', __( ', ', 'mayconnect' ) );
      // if ( $tag_list ) {
      //   echo '<span class="tags-links">' . $tag_list . '</span>';
      // }

      // Post author
      if ( 'post' == get_post_type() ) {
        printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
          esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
          esc_attr( sprintf( __( 'View all posts by %s', 'mayconnect' ), get_the_author() ) ),
          get_the_author()
        );
      }
    }
  endif;

if ( ! function_exists( 'mayconnect_entry_date' ) ) :

  function mayconnect_entry_date( $echo = true ) {
    if ( has_post_format( array( 'chat', 'status' ) ) )
      $format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'mayconnect' );
    else
      $format_prefix = '%2$s';

    $date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
      esc_url( get_permalink() ),
      esc_attr( sprintf( __( 'Permalink to %s', 'mayconnect' ), the_title_attribute( 'echo=0' ) ) ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
    );

    if ( $echo )
      echo $date;
    return $date;

  }

endif;

function new_excerpt_length($length) {
  return 100;
}

// Change excerpt length
function custom_excerpt_length($length) {
  return 70;
}
// Changing excerpt more
function custom_excerpt_more($more) {
  return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">More ...</a>';
}

//=============================================
// DASHBOARD STYLING
//=============================================

function mayconnect_setup_dashboard_widgets()
{
  remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // Right Now
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // Incoming Links
  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // Plugins
  remove_meta_box('dashboard_quick_press', 'dashboard', 'side');  // Quick Press
  remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');  // Recent Drafts
  remove_meta_box('dashboard_primary', 'dashboard', 'side');   // WordPress blog
  // remove_meta_box('dashboard_secondary', 'dashboard', 'side');   // Other WordPress News
  // use 'dashboard-network' as the second parameter to remove widgets from a network dashboard.

  // removing plugin dashboard boxes
  remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Yoast's SEO Plugin Widget
  add_meta_box( 'id', 'Welkom box!', 'Mayconnect_dashboard_widget_function', 'dashboard', 'side');
}

function mayconnect_dashboard_widget_function() {

    // Display whatever it is you want to show.
    if (is_user_logged_in()){
    global $current_user;
        get_currentuserinfo();
        echo('Hallo ' . $current_user->user_firstname .' welkom op deze website.
              <p>Hulp nodig? Neem contact op met <a href="mailto:mail@mayconnect.org">Mayconnect</a> Ik probeer zo snel mogelijk je te hulp te schieten!</p> ');
    }
    else {
        echo "Welkom | ";
    };
}

?>
