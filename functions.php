<?php
    require_once get_theme_file_path("/lib/csf/cs-framework.php");
    require_once get_theme_file_path("/inc/metaboxes/section.php");
    require_once get_theme_file_path("/inc/metaboxes/page.php");
    require_once get_theme_file_path("/inc/metaboxes/section-banner.php");
    require_once get_theme_file_path("/inc/metaboxes/section-featured.php");
    require_once get_theme_file_path("/inc/metaboxes/section-gallery.php");
    
    if (site_url() == "http://hasinwith.wp.com/") {
        define("VERSION", time());
    } else {
        define("VERSION", wp_get_theme()->get("Version"));
    }
// Codestar Framework Activation
    define('CS_ACTIVE_FRAMEWORK', false); // default true
    define('CS_ACTIVE_METABOX', true); // default true
    define('CS_ACTIVE_TAXONOMY', false); // default true
    define('CS_ACTIVE_SHORTCODE', false); // default true
    define('CS_ACTIVE_CUSTOMIZE', false); // default true
// Meal After Setup Theme Functions
    function meal_after_setup_theme()
    {
        load_theme_textdomain('meal', get_template_directory() . "/languages");
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('automatic-feed-links');
        add_theme_support('custom-logo');
        add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
    }
    
    add_action('after_setup_theme', 'meal_after_setup_theme');

// Enqueue Styles And Scripts
    
    function meal_assets()
    {
        wp_enqueue_style('meal-fonts', '//fonts.googleapis.com/css?family=Playfair+Display:300,400,700,800|Open+Sans:300,400,700');
        wp_enqueue_style('bootstrap-css', get_theme_file_uri('/assets/css/bootstrap.css'), null, VERSION);
        wp_enqueue_style('animate-css', get_theme_file_uri('/assets/css/animate.css'), null, VERSION);
        wp_enqueue_style('owl-carousel-css', get_theme_file_uri('/assets/css/owl.carousel.min.css'), null, VERSION);
        wp_enqueue_style('magnific-popup-css', get_theme_file_uri('/assets/css/magnific-popup.css'), null, VERSION);
        wp_enqueue_style('aos-css', get_theme_file_uri('/assets/css/aos.css'), null, VERSION);
        wp_enqueue_style('bootstrap-datepicker-css', get_theme_file_uri('/assets/css/bootstrap-datepicker.css'), null, VERSION);
        wp_enqueue_style('jquery-timepicker-css', get_theme_file_uri('/assets/css/jquery.timepicker.css'), null, VERSION);
        wp_enqueue_style('ionicons-css', get_theme_file_uri('/assets/fonts/ionicons/css/ionicons.min.css'), null, VERSION);
        wp_enqueue_style('font-awesome-css', get_theme_file_uri('/assets/fonts/fontawesome/css/font-awesome.min.css'), null, VERSION);
        wp_enqueue_style('flaticon-css', get_theme_file_uri('/assets/fonts/flaticon/font/flaticon.css'), null, VERSION);
        wp_enqueue_style('meal-portfolio-css', get_theme_file_uri('/assets/css/portfolio.css'), null, VERSION);
        wp_enqueue_style('meal-style-css', get_theme_file_uri('/assets/css/style.css'), null, VERSION);
        wp_enqueue_style('meal-stylesheet', get_stylesheet_uri());
        
        wp_enqueue_script('propper-js', get_theme_file_uri('/assets/js/popper.min.js'), array('jquery'), VERSION, true);
        wp_enqueue_script('bootstrap-js', get_theme_file_uri('/assets/js/bootstrap.min.js'), array('jquery'), VERSION, true);
        wp_enqueue_script('owl-carousel-js', get_theme_file_uri('/assets/js/owl.carousel.min.js'), array('jquery'), VERSION, true);
        wp_enqueue_script('jquery-waypoints-js', get_theme_file_uri('/assets/js/jquery.waypoints.min.js'), array('jquery'), VERSION, true);
        wp_enqueue_script('jquery-magnific-popup-js', get_theme_file_uri('/assets/js/jquery.magnific-popup.min.js'), array('jquery'), VERSION, true);
        wp_enqueue_script('bootstrap-datepicker-js', get_theme_file_uri('/assets/js/bootstrap-datepicker.js'), array('jquery'), VERSION, true);
        wp_enqueue_script('jquery-timepicker-js', get_theme_file_uri('/assets/js/jquery.timepicker.min.js'), array('jquery'), VERSION, true);
        wp_enqueue_script('jquery-stellar-js', get_theme_file_uri('/assets/js/jquery.stellar.min.js'), array('jquery'), VERSION, true);
        wp_enqueue_script('jquery-easing-js', get_theme_file_uri('/assets/js/jquery.easing.1.3.js'), array('jquery'), VERSION, true);
        wp_enqueue_script('aos-js', get_theme_file_uri('/assets/js/aos.js'), array('jquery'), VERSION, true);
        wp_enqueue_script('imagesloaded-js', get_theme_file_uri('/assets/js/imagesloaded.js'), array('jquery'), VERSION, true);
        wp_enqueue_script('isotope-js', get_theme_file_uri('/assets/js/isotope.pkgd.min.js'), array('jquery'), VERSION, true);
        wp_enqueue_script('meal-googlemap-api', '//maps.googleapis.com/maps/api/js?key=AIzaSyDzTtIOVy0BJ8L4tvavdx2AAAdB78vQRUk', null, 1.0, true);
        wp_enqueue_script('meal-portfolio-js', get_theme_file_uri('/assets/js/portfolio.js'), array('jquery', 'jquery-magnific-popup-js', 'isotope-js', 'imagesloaded-js'), VERSION, true);
        wp_enqueue_script('meal-main-js', get_theme_file_uri('/assets/js/main.js'), array('jquery'), VERSION, true);
    }
    
    add_action('wp_enqueue_scripts', 'meal_assets');
    
    function meal_codestar_init()
    {
        CSFramework_Metabox::instance(array());
    }
    
    add_action('init', 'meal_codestar_init');
    
    
    function get_recipe_category($recipe_id)
    {
        $terms = wp_get_post_terms($recipe_id, 'category');
        if ($terms) {
            $first_term = array_shift($terms);
            return $first_term->name;
        }
        return "Food";
        
    }
