<?php

namespace Sunny\Ajax; // name of the theme, not mine :)

/**
 * Handles all ajax operations
 * 
 * @package  WordPress
 * @subpackage  Sunny
 * @author:  Sunny <sunny92geek@gmail.com>
 * @since Sunny 1.0
 */

class Ajax {

    private static $instance = null;

    /**
     * Yes, a blank private constructor, to implement singleton,
     * to keep the real essence of WordPress project, 
     * so that someone can easily unhook any of our method
     * 
     * @return void
     */
    private function __construct()
    {
        
    }

    /**
     * Singleton pattern
     * Method for creating the object
     * of this class
     * 
     * @return object, an object of this class
     */
    public static function get_instance()
    {
        if (self::$instance == null)
        {
          self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Registers the WP hooks
     * 
     * @return void
     */
    public static function register(){
        $plugin = self::get_instance();

        add_action('wp_ajax_nopriv_load_posts', array( $plugin, 'load_posts' )
        );
        add_action('wp_ajax_load_posts', array( $plugin, 'load_posts' )
        );
    }

    /**
     * loads posts based on offset
     * 
     * @return void
     */
    public function load_posts(){
        $offset  = isset($_GET['offset']) ? sanitize_text_field($_GET['offset']) : 0;

        $context = \Timber::context();
        $context['posts'] = \Timber::get_posts([
                            'post_type'         => 'post',
                            'posts_per_page'    => 3,
                            'orderby'           => 'date',
                            'order'             => 'DESC',
                            'offset'            => $offset,
                        ]);


        $posts_html = \Timber::compile( array('post_grid.twig') , $context);

        $response  = [
            "success"   => 1,
            "message"   => "Posts fetched",
            "posts"     => $posts_html,
            "count"     => count($context['posts']),
        ];

        wp_send_json( $response, 200 );

        wp_die();
    }

}

Ajax::register();