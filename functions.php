<?php
require_once get_theme_file_path("/lib/csf/cs-framework.php");
require_once get_theme_file_path("/inc/metaboxes/section.php");
require_once get_theme_file_path("/inc/metaboxes/recipe.php");
require_once get_theme_file_path("/inc/metaboxes/taxonomy-featured.php");
require_once get_theme_file_path("/inc/metaboxes/page.php");
require_once get_theme_file_path("/inc/metaboxes/section-banner.php");
require_once get_theme_file_path("/inc/metaboxes/section-featured.php");
require_once get_theme_file_path("/inc/metaboxes/section-gallery.php");
require_once get_theme_file_path("/inc/metaboxes/section-chef.php");
require_once get_theme_file_path("/inc/metaboxes/section-service.php");

if (site_url() == "http://hasinwith.wp.com/") {
    define("VERSION", time());
} else {
    define("VERSION", wp_get_theme()->get("Version"));
}
// Codestar Framework Activation
define('CS_ACTIVE_FRAMEWORK', true); // default true
define('CS_ACTIVE_METABOX', true); // default true
define('CS_ACTIVE_TAXONOMY', true); // default true
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

    register_nav_menu('primary', __('Main Menu', 'meal'));
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

    if (is_page_template('page-templates/landing.php')) {
        wp_enqueue_script('meal-reservation-js', get_theme_file_uri('/assets/js/reservation.js'), array('jquery'), VERSION, true);
        wp_enqueue_script('meal-contact-js', get_theme_file_uri('/assets/js/contact.js'), array('jquery'), VERSION, true);

        $ajaxurl = admin_url('admin-ajax.php');
        wp_localize_script('meal-reservation-js', 'mealurl',
            array(
                'url' => $ajaxurl
            )
        );
        wp_localize_script('meal-contact-js', 'mealurl',
            array(
                'url' => $ajaxurl
            )
        );
    }


}

add_action('wp_enqueue_scripts', 'meal_assets');

function meal_codestar_init()
{
    CSFramework_Metabox::instance(array());
    CSFramework_Taxonomy::instance(array());


    $settings = array(
        'menu_title' => __('Meal Option'),
        'menu_type' => 'submenu', // menu, submenu, options, theme, etc.
        'menu_parent' => 'themes.php',
        'menu_slug' => 'meal-options-panel',
        'ajax_save' => false,
        'show_reset_all' => false,
        'framework_title' => __('Meal Option', 'meal'),
        'ajax_save' => false,
        'show_reset_all' => true
    );
    new CSFramework($settings, meal_get_theme_options());
}

add_action('init', 'meal_codestar_init');

function meal_get_theme_options()
{
    $options   = array();
    $options[] = array(
        'name' => 'meal_theme_activation',
        'title' => __('Theme Activation', 'meal'),
        'icon' => 'fa fa-heart',
        'fields' => array(
            array(
                'id' => 'meal_username',
                'type' => 'text',
                'title' => __('Username', 'meal'),
            ),
            array(
                'id' => 'meal_purchase_code',
                'type' => 'text',
                'title' => __('Purchase Code', 'meal'),
            )
        )
    );
        return $options;
}


function get_recipe_category($recipe_id)
{
    $terms = wp_get_post_terms($recipe_id, 'category');
    if ($terms) {
        $first_term = array_shift($terms);
        return $first_term->name;
    }
    return "Food";

}

function meal_reservation_ajax_request()
{
    if (check_ajax_referer('reservation', 'rn')) {
        $name    = sanitize_text_field($_POST['name']);
        $email   = sanitize_text_field($_POST['email']);
        $phone   = sanitize_text_field($_POST['phone']);
        $persons = sanitize_text_field($_POST['persons']);
        $date    = sanitize_text_field($_POST['date']);
        $time    = sanitize_text_field($_POST['time']);

        $data = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'persons' => $persons,
            'date' => $date,
            'time' => $time,
        );

        $reservation_arguments = array(
            'post_type' => 'reservation',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_date' => date('Y-m-d H:i:s'),
            'post_title' => sprintf('%s Reservation for %s persons on %s - %s', $name, $persons, $date . " : " . $time, $email),
            'meta_input' => $data
        );

        $reservation = new WP_Query(array(
            'post_type' => 'reservation',
            'post_status' => 'publish',
            'meta_query' => array(
                'relation' => 'AND',
                'check_email' => array(
                    'key' => 'email',
                    'value' => $email
                ),
                'check_date' => array(
                    'key' => 'date',
                    'value' => $date
                ),
                'check_time' => array(
                    'key' => 'time',
                    'value' => $time
                ),
            )
        ));

        if ($reservation->found_posts > 0) {
            echo 'Duplicate';
        } else {
            $wp_error       = '';
            $reservation_id = wp_insert_post($reservation_arguments, $wp_error);
            //Transient check
            $reservation_count = get_transient('res_count') ? get_transient('res_count') : 0;
            //Transient check end
            if (!$wp_error) {
                $reservation_count++;
                set_transient('res_count', $reservation_count, 0);


                $_name      = explode(' ', $name);
                $order_data = array(
                    'first_name' => $_name[0],
                    'last_name' => isset($_name[1]) ? $_name[1] : '',
                    'email' => $email,
                    'phone' => $phone
                );

                $order = wc_create_order();
                $order->set_address($order_data);
                $order->add_product(wc_get_product(119));
                $order->set_customer_note($reservation_id);
                $order->calculate_totals();
                add_post_meta($reservation_id, 'order_id', $order->get_id());

                echo $order->get_checkout_payment_url();
            }
        }


    } else {
        _e('Not Allowed Your Request');
    }
    die();

}

add_action('wp_ajax_reservation', 'meal_reservation_ajax_request');
add_action('wp_ajax_nopriv_reservation', 'meal_reservation_ajax_request');


function meal_order_status_processing($order_id)
{
    $order          = wc_get_order($order_id);
    $reservation_id = $order->get_customer_note();
    if ($reservation_id) {
        $reservation = get_post($reservation_id);
        wp_update_post(array(
            'ID' => $reservation_id,
            'post_title' => '[Paid] - ' . $reservation->post_title
        ));
        add_post_meta($reservation_id, 'paid', 1);
    }
}

add_filter('woocommerce_order_status_processing', 'meal_order_status_processing');


function meal_menu_class($menus)
{

    $reservation_count = get_transient('res_count') ? get_transient('res_count') : 0;

    if ($reservation_count > 0) {
        $menus[4][0] = "Reservations <span class='awaiting-mod'>{$reservation_count}</span>";
    }
    return $menus;


}

add_filter('add_menu_classes', 'meal_menu_class');

function meal_admin_script($screen)
{
    $_screen = get_current_screen();
    if ('edit.php' == $screen && $_screen->post_type == 'reservation') {
        delete_transient('res_count');
    }
}

add_action('admin_enqueue_scripts', 'meal_admin_script');


//contact section ajax request
function meal_contact_email()
{
    if (check_ajax_referer('contact', 'cn')) {

        $name    = sanitize_text_field($_POST['name']);
        $email   = sanitize_text_field($_POST['email']);
        $phone   = sanitize_text_field($_POST['phone']);
        $message = sanitize_text_field($_POST['message']);

        $_message    = sprintf("%s\r\nFrom: %s\r\nEmail: %s\r\nPhone: %s", $message, $name, $email, $phone);
        $admin_email = get_option('admin_email');
        wp_mail($admin_email, __('Someone tired to contact you', 'meal'), $_message, "From: {$admin_email}\r\n");
        die('Successful');
    }


}

add_action('wp_ajax_contact', 'meal_contact_email');
add_action('wp_ajax_nopriv_contact', 'meal_contact_email');


// section type menu fixed


function meal_change_nav_menu($menus)
{
    $string_to_replace = home_url("/") . "section/";
    if (is_front_page()) {
        foreach ($menus as $menu) {
            $new_url = str_replace($string_to_replace, "#", $menu->url);
            if ($new_url != $menu->url) {
                $new_url = rtrim($new_url, "/");
            }
            $menu->url = $new_url;
        }

    }

    return $menus;

}

add_filter('wp_nav_menu_objects', 'meal_change_nav_menu');



