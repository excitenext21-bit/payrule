<?php
namespace UiCore;
defined('ABSPATH') || exit();

/**
 * Here we generate the header
 */
class Posts
{
    function __construct()
    {
        // if ((is_category() || is_day() || is_month() || is_author() || is_year() || is_tag() || is_home() || is_singular('post'))
        // Pagination Template
        if (!class_exists('Uicore\Pagination')) {
            require UICORE_INCLUDES . '/templates/pagination.php';
        }
        $is_theme_builder_template = apply_filters('uicore_single_tb', false);
        if($is_theme_builder_template){
            do_action('do_uicore_single_tb');
        }else{
            if ((is_singular('portfolio') || is_post_type_archive('portfolio') || is_tax('portfolio_category')) && Helper::get_option('disable_portfolio') === 'false' ) {
                new Portfolio\Template();
            } else if( (Helper::get_option('disable_blog') === 'false') && Blog\Frontend::is_blog()) {
                new Blog\Template();
            }else {
                new Pages();
            }
        }

    }
}
