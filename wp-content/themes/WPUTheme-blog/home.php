<?php
include dirname( __FILE__ ) . '/../WPUTheme/z-protect.php';
get_header();

echo '<div class="main">';
echo get_the_loop();
echo '</div>';
get_sidebar();
get_footer();
