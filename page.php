<?php get_header();

while (have_posts()) : the_post(); ?>
    <h1 class="entry-title"><?php the_title(); ?></h1>
    <div class="content entry-content">
    <?php 
        the_content(); 
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'affiliatepress' ),
            'after'  => '</div>',
        ) );
    ?>
</div>
<?php endwhile;

get_footer(); ?>