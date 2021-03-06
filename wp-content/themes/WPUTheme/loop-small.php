<?php
include dirname( __FILE__ ) . '/z-protect.php';
$has_thumb = has_post_thumbnail();
?><article <?php post_class( 'loop-small' ); ?>>
    <div class="<?php echo $has_thumb ? 'bmedia':''; ?>">
        <?php if ( $has_thumb ): ?>
        <div>
            <?php echo the_post_thumbnail( 'thumbnail' ); ?>
        </div>
        <?php endif; ?>
        <div class="bm-cont">
            <?php include get_template_directory() . '/tpl/loops/header-loop-small.php'; ?>
            <?php the_excerpt(); ?>
            <footer class="lpsm-metas">
                <?php the_category( ', ' ); ?>
            </footer>
        </div>
    </div>
</article>
