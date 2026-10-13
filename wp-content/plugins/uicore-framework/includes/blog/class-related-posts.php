<?php
namespace UiCore\Blog;

use UiCore\Helper;

defined('ABSPATH') || exit();

/**
 * Related Post Component
 */
class RelatedPost
{
	private $col;
	private $type;

    function __construct($filter = false, $style = false)
    {

        // 'blogs_related'				=> 'true',
        // 'blogs_related_filter'		=> 'random', (category, tag, random)
        // 'blogs_related_style'		=> 'grid', (grid, list)

        $filter = $filter ? $filter : Helper::get_option('blogs_related_filter');
        $style = $style ? $style : Helper::get_option('blogs_related_style');



        if ($style === 'grid') {
			$this->type = Helper::get_option('blog_layout');
			$this->type = ($this->type != 'horizontal') ? 'grid' : $this->type;
            $post_to_get = (int) Helper::get_option('blog_col');
			if ($this->type == 'horizontal') {
				$post_to_get = 2;
			} else if ($post_to_get <= 2) {
				$post_to_get = 3;
			}


        } else {
            $post_to_get = 4;
        }
		$this->col = $post_to_get;

        $related = $this->get_related($filter, $post_to_get);

        if ($filter == 'category' && $related) {
            $this->display_related($style, $related);
        } elseif ($filter == 'tag' && $related) {
            $this->display_related($style, $related);
        } else {
            $this->display_related($style, $this->get_related('random', $post_to_get));
        }
    }

    public function get_related($filter, $number)
    {
        global $post;

        if ($filter == 'category') {
            $categories = get_the_category($post->ID);

            if ($categories) {
                $category_ids = [];
                foreach ($categories as $individual_category) {
                    $category_ids[] = $individual_category->term_id;
                }

                $args = [
                    'category__in' => $category_ids,
                    'post__not_in' => [$post->ID],
                    'posts_per_page' => $number,
                    'ignore_sticky_posts' => 1,
                ];
            }
        } elseif ($filter == 'tag') {
            $tags = wp_get_post_tags($post->ID);

            if ($tags) {
                $tag_ids = [];
                foreach ($tags as $individual_tag) {
                    $tag_ids[] = $individual_tag->term_id;
                }
                $args = [
                    'tag__in' => $tag_ids,
                    'post__not_in' => [$post->ID],
                    'posts_per_page' => $number,
                    'ignore_sticky_posts' => 1,
                ];
            }
        } else {
            $args = [
                'post__not_in' => [$post->ID],
                'posts_per_page' => $number,
                'orderby' => 'rand',
            ];
        }

        $related_query = new \wp_query($args);

        if ($related_query->have_posts()) {
            return $related_query;
        } else {
            return false;
        }
    }

    function display_related($style, $wp_query)
    {

        if ($style === 'grid'){
            Frontend::frontend_css(true);
            $blog = new Template('display',get_post_type());
            $blog->blog_layout($wp_query, $this->type, $this->col);
        }else{
            self::display_blog_list($wp_query);
        }

    }

    public static function display_blog_list($related)
    {
        if($related){
            while ($related->have_posts()) {
                $related->the_post();
                ?>
                <h4> <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><span><?php the_title(); ?></span></a> </h4>
                <?php
            }
        }

        wp_reset_query();
    }

}
