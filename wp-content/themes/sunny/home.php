<?php

/**
 * Template Name: Home
 * 
 * @package  WordPress
 * @subpackage  Sunny
 * @author:  Sunny <sunny92geek@gmail.com>
 * @since Sunny 1.0
 */

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;

$context['recent_posts'] = Timber::get_posts([
							'post_type' 		=> 'post',
							'posts_per_page'	=> 3,
							'orderby'			=> 'date',
							'order'				=> 'DESC'	
						]);

Timber::render( array( 'home.twig', 'page.twig' ), $context );