<?php
include dirname( __FILE__ ) . '/z-protect.php';
include get_template_directory() . '/tpl/search/header-results.php';
get_header();

echo '<div class="main-content">';
echo '<h1>'.sprintf( __( '%s for &ldquo;%s&rdquo;', 'wputh' ), $search_results, get_search_query() ).'</h1>';
echo get_the_loop();
echo '</div>';
get_footer();
