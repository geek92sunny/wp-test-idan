<?php

namespace Sunny\Custom_Fields; // name of the theme, not mine :)

/**
 * Registers carbon custom fields
 * 
 * @package  WordPress
 * @subpackage  Sunny
 * @author:  Sunny <sunny92geek@gmail.com>
 * @since Sunny 1.0
 */

use \Carbon_Fields\Container;
use \Carbon_Fields\Field;

class Custom_Fields {

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

        add_action( 
            'carbon_fields_register_fields',
            array( $plugin, 'blog_global_fields' ) 
        );
    }

    public function blog_global_fields(){
       Container::make( 'theme_options', __( 'Theme Options' ) )
            ->add_fields( array(
                Field::make( 'image', 'global_cover_image', 'Blog Cover' ),
            ) );        
    }

}

Custom_Fields::register();