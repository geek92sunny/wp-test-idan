<?php

namespace Sunny; // name of the theme, not mine :)

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


class Theme extends \Timber\Site {

    protected $script_ver = '1.6';
    protected $theme_name = 'sunny';

    /** Add timber support. */
    public function __construct() {
        add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
        add_filter( 'timber/context', array( $this, 'add_to_context' ) );
        add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );

        parent::__construct();
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

    /**
     * This is where you add some context
     * 
     * @param string $context context['this'] Being the Twig's {{ this }}.
     */
    public function add_to_context( $context ) {
        // $context['menu']  = new \Timber\Menu();
        $context['site']  = $this;
        $context['default_post_thumb'] = $this->theme->link . '/images/placeholder.jpg';

        return $context;
    }

    /**
     * Custom functions to twig
     * 
     * @param object the twig object
     * @return object the twig object
     */
    public function add_to_twig($twig){
        $twig->addFunction( new \Timber\Twig_Function( 'carbon_get_theme_option', 'carbon_get_theme_option' ) );

        return $twig;
    }    

    public function scripts(){
        $this->css();
        $this->js();
    }

    protected function css(){
        $theme_url = get_template_directory_uri();

        wp_enqueue_style(
            "{$this->theme_name}-bootstrap",
            "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css",
            array()
        );

        wp_enqueue_style(
            "{$this->theme_name}-main",
            "{$theme_url}/assets/css/main.css",
            array(),
            $this->script_ver
        );        
    }

    protected function js(){
        $theme_url = get_template_directory_uri();

        wp_register_script( "{$this->theme_name}-main", "{$theme_url}/assets/js/main.js", array('jquery'), $this->script_ver, true );

        $theme_vars = [
            'ajax_endpoint' => admin_url( 'admin-ajax.php' ),
        ];

        wp_localize_script( "{$this->theme_name}-main", 'theme_vars', $theme_vars );

        wp_enqueue_script( "{$this->theme_name}-main" );
    }

}

new Theme();