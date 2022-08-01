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

$context['recent_posts'] = Timber::get_posts(
	array(
		'post_type'         => 'post',
		'posts_per_page'    => NATIVE_POSTS_PER_PAGE,
		'orderby'           => 'date',
		'order'             => 'DESC',
	)
);
$context['recent_posts'] = array_chunk( $context['recent_posts'], 3 );

Timber::render( array( 'home.twig', 'page.twig' ), $context );
