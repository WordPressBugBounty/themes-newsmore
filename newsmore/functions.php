<?php
/* Child theme generated with WPS Child Theme Generator */

if (!function_exists('newsmore_theme_enqueue_styles')) {
    add_action('wp_enqueue_scripts', 'newsmore_theme_enqueue_styles');

    function newsmore_theme_enqueue_styles()
    {
        $newsmore_version = wp_get_theme()->get('Version');
        $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
        $parent_style = 'morenews-style';
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap' . $min . '.css');
        wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
        wp_enqueue_style(
            'newsmore',
            get_stylesheet_directory_uri() . '/style.css',
            array('bootstrap', $parent_style),
            wp_get_theme()->get('Version')
        );

        // Enqueue RTL Styles if the site is in RTL mode
        if (is_rtl()) {
            wp_enqueue_style(
                'morenews-rtl',
                get_template_directory_uri() . '/rtl.css',
                array($parent_style),
                $newsmore_version
            );
        }
    }
}

// Set up the WordPress core custom background feature.
add_theme_support('custom-background', apply_filters('morenews_custom_background_args', array(
    'default-color' => 'f5f5f5',
    'default-image' => '',
)));



function newsmore_override_morenews_header_section()
{
    remove_action('morenews_action_header_section', 'morenews_header_section', 40);
}

add_action('wp_loaded', 'newsmore_override_morenews_header_section');

function newsmore_header_section()
{

    $morenews_header_layout = morenews_get_option('header_layout');


?>

    <header id="masthead" class="<?php echo esc_attr($morenews_header_layout); ?> morenews-header">
        <?php morenews_get_block('layout-centered', 'header');  ?>
    </header>

    <!-- end slider-section -->
<?php
}

add_action('morenews_action_header_section', 'newsmore_header_section', 40);

function newsmore_filter_default_theme_options($defaults)
{
    $defaults['site_title_font_size'] = 80;
    $defaults['site_title_uppercase']  = 0;
    $defaults['show_primary_menu_desc']  = 0;
    $defaults['header_layout'] = 'header-layout-centered';
    $defaults['disable_header_image_tint_overlay']  = 1;
    $defaults['flash_news_title'] = __('Breaking News', 'newsmore');
    $defaults['aft_custom_title']           = __('Watch', 'newsmore');
    $defaults['select_main_banner_layout_section'] = 'layout-1';
    $defaults['select_main_banner_order'] = 'order-3';
    $defaults['select_update_post_filterby'] = 'cat'; 
    $defaults['secondary_color'] = '#002868';
    $defaults['global_show_min_read'] = 'no';
    $defaults['frontpage_content_type']  = 'frontpage-widgets-and-content';
    $defaults['featured_news_section_title'] = __('Featured', 'newsmore');
    $defaults['show_featured_post_list_section']  = 1;
    $defaults['featured_post_list_section_title_1']           = __('General', 'newsmore');
    $defaults['featured_post_list_section_title_2']           = __('Update', 'newsmore');
    $defaults['featured_post_list_section_title_3']           = __('More', 'newsmore');


    return $defaults;
}
add_filter('morenews_filter_default_theme_options', 'newsmore_filter_default_theme_options', 1);
