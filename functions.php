<?php
function scripts1() {

// Load stylesheets.
    wp_enqueue_style('style-bootstrap', get_stylesheet_directory_uri() . '/dist/css/bootstrap.min.css', false, '5.0', 'all');
    wp_enqueue_style('style', get_stylesheet_uri() . '');
    wp_enqueue_style( 'styles', get_stylesheet_directory_uri() .'/dist/css/styles.css', [], time(), 'all');

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/dist/js/bootstrap.bundle.min.js', array(), false, true);
}

add_action('wp_enqueue_scripts', 'scripts1');


//add theme support
$defaults = array(
	'default-image'          => '',
	'width'                  => 0,
	'height'                 => 300,
	'flex-height'            => true,
	'flex-width'             => true,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => true,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);

function theme_prefix_setup() {
	
  add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
  ) );
  
  }
  add_action( 'after_setup_theme', 'theme_prefix_setup' );
  
add_theme_support( 'title-tag' );
add_theme_support('thumbnails');
add_theme_support('post-format',['gallery', 'link', 'image', 'quote', 'status', 'video', 'audio']);
add_theme_support('html5');
add_theme_support('automatic-feed-links');
add_theme_support('custom-background');
add_theme_support('custom-header', $defaults);
add_theme_support('custom-logo');
add_theme_support('customize-selective-refresh-widgets');
add_theme_support('starter-content');

//nav menu

function wpk_bootstrap_menus() {
    register_nav_menus(array(
        'bootstrap-menu' => __( 'Bootstrap 5 Menu' ),
        'extra-menu' => __( 'Extra Menu' )
      )
      );
  }
  add_action( 'init', 'wpk_bootstrap_menus' );

  //add class to li elements in nav
  function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

//add class to a nav link 
function _namespace_modify_menuclass($ulclass) {
    return preg_replace('/<a /', '<a class="nav-link px-4"', $ulclass);
}

add_filter('wp_nav_menu', '_namespace_modify_menuclass');


// custom post type function
function create_posttype() {
 
    register_post_type( 'news',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'News' ),
                'singular_name' => __( 'News' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'news'),
            'show_in_rest' => true,
            'taxonomies'          => array( 'category' )
        )
    );
}

add_action( 'init', 'create_posttype' );


add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if( is_category() ) {
    $post_type = get_query_var('post_type');
    if($post_type)
        $post_type = $post_type;
    else
        $post_type = array('nav_menu_item', 'post', 'news'); // don't forget nav_menu_item to allow menus to work!
    $query->set('post_type',$post_type);
    return $query;
    }
}


















  // bootstrap 5 wp_nav_menu walker
  class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
  {
    private $current_item;
    private $dropdown_menu_alignment_values = [
      'dropdown-menu-start',
      'dropdown-menu-end',
      'dropdown-menu-sm-start',
      'dropdown-menu-sm-end',
      'dropdown-menu-md-start',
      'dropdown-menu-md-end',
      'dropdown-menu-lg-start',
      'dropdown-menu-lg-end',
      'dropdown-menu-xl-start',
      'dropdown-menu-xl-end',
      'dropdown-menu-xxl-start',
      'dropdown-menu-xxl-end'
    ];
  
    function start_lvl(&$output, $depth = 0, $args = null)
    {
      $dropdown_menu_class[] = '';
      foreach($this->current_item->classes as $class) {
        if(in_array($class, $this->dropdown_menu_alignment_values)) {
          $dropdown_menu_class[] = $class;
        }
      }
      $indent = str_repeat("\t", $depth);
      $submenu = ($depth > 0) ? ' sub-menu' : '';
      $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
    }
  
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
      $this->current_item = $item;
  
      $indent = ($depth) ? str_repeat("\t", $depth) : '';
  
      $li_attributes = '';
      $class_names = $value = '';
  
      $classes = empty($item->classes) ? array() : (array) $item->classes;
  
      $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
      $classes[] = 'nav-item';
      $classes[] = 'nav-item-' . $item->ID;
      if ($depth && $args->walker->has_children) {
        $classes[] = 'dropdown-menu dropdown-menu-end';
      }
  
      $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
      $class_names = ' class="' . esc_attr($class_names) . '"';
  
      $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
      $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';
  
      $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';
  
      $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
      $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
      $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
      $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
  
      $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
      $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
      $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';
  
      $item_output = $args->before;
      $item_output .= '<a' . $attributes . '>';
      $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
      $item_output .= '</a>';
      $item_output .= $args->after;
  
      $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
  }

?>