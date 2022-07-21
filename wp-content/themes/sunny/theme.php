<?php

/**
 * Bootstrap file of the theme
 * Loads the basic settings and assets
 * of the theme
 * 
 * @package  WordPress
 * @subpackage  Sunny
 * @author:  Sunny <sunny92geek@gmail.com>
 * @since Sunny 1.0
 */

namespace Sunny; // name of the theme, not mine :)

class Theme extends \Timber\Site {

    protected $script_ver = '1.0';
    protected $theme_name = 'sunny';

    /** Add timber support. */
    public function __construct() {
        add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
        add_filter( 'timber/context', array( $this, 'add_to_context' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );

        parent::__construct();
    }


    /**
     * This is where you add some context
     * 
     * @param string $context context['this'] Being the Twig's {{ this }}.
     */
    public function add_to_context( $context ) {
        // $context['menu']  = new \Timber\Menu();
        $context['site']  = $this;

        return $context;
    }

    public function theme_supports() {
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        add_theme_support( 'menus' );
    }

    public function scripts(){
        $this->css();
        $this->js();
    }

    protected function css(){
        wp_enqueue_style(
            "{$this->theme_name}-bootstrap",
            "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css",
            array(),
            $this->script_ver
        );
    }

    protected function js(){
        $theme_url = get_template_directory_uri();

        wp_enqueue_script( "{$this->theme_name}-main", "{$theme_url}/assets/js/main.js", array('jquery'), $this->script_ver, true );
    }

}

new Theme();