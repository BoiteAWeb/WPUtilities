<?php
/*
Plugin Name: WPU Meta tags
Description: Adds meta tags to the theme header
Version: 0.3
Author: Darklg
Author URI: http://darklg.me/
License: MIT License
License URI: http://opensource.org/licenses/MIT
Contributor: @boiteaweb
Last Update: 07 dec. 2013
*/

/* ----------------------------------------------------------
  Meta content & open graph
---------------------------------------------------------- */

add_action( 'wp_head', 'wpu_user_metas', 0 );
function wpu_user_metas() {
    $metas = array();

    $metas['og_sitename'] = array(
        'property' => 'og:site_name',
        'content' => get_bloginfo( 'name' )
    );

    $metas['og_type'] = array(
        'property' => 'og:type',
        'content' => 'blog'
    );

    if ( is_single() ) {
        global $post;

        // Meta description
        $meta_description = preg_replace( "/\s+/", ' ', strip_tags( strip_shortcodes( $post->post_content ) ) );
        if ( strlen( $meta_description ) > 195 ) {
            $meta_description = substr( $meta_description, 0, 190 ) . ' &hellip;';
        }

        $metas['description'] = array(
            'name' => 'description',
            'content' => $meta_description
        );
        $metas['og_title'] = array(
            'property' => 'og:title',
            'content' => get_the_title()
        );
        $metas['og_url'] = array(
            'property' => 'og:url',
            'content' => get_permalink()
        );
        $thumb_id = get_post_thumbnail_id();
        $thumb_url = wp_get_attachment_image_src( $thumb_id, 'thumbnail', true );
        if ( isset( $thumb_url[0] ) ) {
            $metas['og_image'] = array(
                'property' => 'og:image',
                'content' => $thumb_url[0]
            );
        }
    }

    if ( is_home() || is_front_page() ) {
        $meta_description = get_bloginfo( 'description' );
        if ( strlen( $meta_description ) > 195 ) {
            $meta_description = substr( $meta_description, 0, 190 ) . ' &hellip;';
        }
        $metas['description'] = array(
            'name' => 'description',
            'content' => $meta_description
        );
        $metas['og_title'] = array(
            'property' => 'og:title',
            'content' => get_bloginfo( 'name' )
        );
        $metas['og_url'] = array(
            'property' => 'og:url',
            'content' => home_url()
        );
        $metas['og_image'] = array(
            'property' => 'og:image',
            'content' => 'http://s.wordpress.com/mshots/v1/' . home_url()
        );
    }

    $return = '';
    foreach ( $metas as $values ) {
        $return .= '<meta';
        foreach ( $values as $name => $value ) {
            $return .= sprintf( ' %s="%s"', $name, esc_attr( $value ) );
        }
        $return .= ' />'."\n";
    }
    echo $return;
}

/* ----------------------------------------------------------
  Robots tag
---------------------------------------------------------- */

add_action( 'wp_head', 'wpu_user_metas_robots', 1 );
function wpu_user_metas_robots() {
    $metas = array();

    // Disable indexation for paginated archives OR 404 page
    if ( ( is_paged() && ( is_category() || is_tag() || is_author() || is_tax() ) ) || 
        is_404() ||
        ( comments_open() && (int)get_query_var( 'cpage' )>0 )
        ) {
        $metas['robots'] = array(
            'name' => 'robots',
            'content' => 'noindex, follow'
        );
    }
    if ( count( $metas ) ) {
        $return = '';
        foreach ( $metas as $values ) {
            $return .= '<meta';
            foreach ( $values as $name => $value ) {
                $return .= sprintf( ' %s="%s"', $name, esc_attr( $value ) );
            }
            $return .= ' />'."\n";
        }
        echo $return;
    }
}
