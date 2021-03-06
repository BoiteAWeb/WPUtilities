<?php

/* ----------------------------------------------------------
  [columns]Text on multiple columns[/columns]
---------------------------------------------------------- */

function wpu_columns_shortcode( $atts, $content = null ) {
    return '<div class="post-content-columns">' . $content . '</div>';
}
add_shortcode( 'columns', 'wpu_columns_shortcode' );

/* ----------------------------------------------------------
  [googlemap]8 Rue de Londres, 75009 Paris, France[/googlemap]
---------------------------------------------------------- */

function wpu_googlemap_shortcode( $atts, $content = null ) {
    $width = isset( $atts['width'] ) ? $atts['width'] : 640;
    $height = isset( $atts['height'] ) ? $atts['height'] : 480;
    return '<iframe width="'.$width.'" height="'.$height.'" src="http://maps.google.com/maps?q='.urlencode( $content ).'&output=embed"></iframe>';
}
add_shortcode( "googlemap", "wpu_googlemap_shortcode" );

/* ----------------------------------------------------------
  [widget type="WP_Widget_Recent_Posts"]
---------------------------------------------------------- */

/* Thx http://wp.smashingmagazine.com/2012/12/11/inserting-widgets-with-shortcodes/ */

add_shortcode( 'widget', 'wpu_widget_shortcode' );
function wpu_widget_shortcode( $atts ) {

    // Configure defaults and extract the attributes into variables
    extract( shortcode_atts(
            array(
                'type'  => '',
                'title' => '',
            ),
            $atts
        ) );

    $args = array(
        'before_widget' => '<div class="box widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    );

    ob_start();
    the_widget( $type, $atts, $args );
    return ob_get_clean();
}
