<?php get_header();

$first_post = new WP_Query(array("posts_per_page" => 1));
$other_posts = new WP_Query(array("posts_per_page" => 2, "offset" => 1));
?>
<div class="front-section">
    <div class="first-section">
        <?php $first_post->the_post() ?>
        <div class="first-post">
        <a class="first-post__link" aria-label="<?php echo esc_attr__( get_the_title(), 'affiliatepress' ); ?>" href="<?php the_permalink(); ?>"></a>
            <?php the_post_thumbnail("", ['class' => "first-post__thumbnail"]) ?>
            <div class="first-post__data">
                <a class="first-post__category" href="<?php echo get_category_link(get_the_category()[0]->term_id) ?>"><?php echo get_the_category()[0]->name ?></a>
                <h2 class="first-post__title">
                    <span><?php the_title() ?></span>
                </h2>
                <div class="first-post__excerpt"><?php affiliatepress_the_custom_excerpt() ?></div>
                <div class="first-post__info">
                    <span>Updated <?php echo human_time_diff(affiliatepress_get_the_updated_time("U")) ?> ago</span>
                    <span class="first-post__divider"> • </span>
                    <span>
                        By <a class="first-post__author" href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>"><?php the_author() ?></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <?php wp_reset_postdata() ?>
    <div class="other-section">
        <?php while ($other_posts->have_posts()) : $other_posts->the_post() ?>
            <div class="other-post">
            <a class="other-post__link" aria-label="<?php echo esc_attr__( get_the_title(), 'affiliatepress' ); ?>" href="<?php the_permalink(); ?>"></a>
                <?php the_post_thumbnail("", ['class' => "other-post__thumbnail"]) ?>
                <div class="other-post__data">
                    <a class="other-post__category" href="<?php echo get_category_link(get_the_category()[0]->term_id) ?>"><?php echo get_the_category()[0]->name ?></a>
                    <h3 class="other-post__title"><span itemprop="name"><?php the_title() ?></span></h3>
                    <div class="other-post__info">
                        <span>Updated <?php echo human_time_diff(affiliatepress_get_the_updated_time("U")) ?> ago</span>
                        <span class="other-post__divider"> • </span>
                        By <a class="other-post__author" href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>"><?php the_author() ?></a>
                    </div>
                </div>
            </div>
        <?php endwhile ?>
    </div>
</div>
<?php wp_reset_postdata(); ?>
<hr class="popular-separator" />
<div class="popular-section">
    <h2>Popular Posts</h2>
    <div class="popular-posts">
        <?php $args = array(
            'post_type' => 'post',
            'meta_key' => 'wpb_post_views_count',
            'orderby'   => 'meta_value_num',
            'order' => 'DESC',
            'posts_per_page' => 4,
            'paged' => 1,
        );
        $popular_posts = new WP_Query($args);
        if ($popular_posts->have_posts()) : while ($popular_posts->have_posts()) : $popular_posts->the_post(); ?>
                <div class="popular-post">
                <a class="popular-post__link" aria-label="<?php echo esc_attr__( get_the_title(), 'affiliatepress' ); ?>" href="<?php the_permalink(); ?>"></a>
                    <?php the_post_thumbnail("", ['class' => "popular-post__thumbnail"]); ?>
                    <div class="popular-post__info">
                        <a class="popular-post__category" href="<?php echo get_category_link(get_the_category()[0]->term_id) ?>"><?php echo get_the_category()[0]->name ?></a>
                        <h3 class="popular-post__title">
                            <?php the_title() ?>
                        </h3>
                    </div>
                </div>
        <?php endwhile;
        endif; ?>
    </div>
</div>
<?php wp_reset_postdata() ?>
<hr class="latest-separator" />
<div class="latest-section">
    <h2>Latest Posts</h2>
    <div class="latest-posts">
        <?php $args = array('posts_per_page' => 8, 'post_type' => 'post');
        $latest_posts = new WP_Query($args);
        if ($latest_posts->have_posts()) : while ($latest_posts->have_posts()) : $latest_posts->the_post() ?>
                <article class="latest-post hentry">
                <a class="latest-post__link" aria-label='<?php echo esc_attr__( get_the_title(), 'affiliatepress' ); ?>' href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr__( 'Permanent Link to', 'affiliatepress' ); ?> <?php the_title_attribute(); ?>"></a>
                    <img class="latest-post__img" alt="<?php the_title() ?>" src="<?php the_post_thumbnail_url() ?>" loading="lazy" />
                    <div class="latest-post__info">
                        <a class="latest-post__category" href="<?php echo get_category_link(get_the_category()[0]->term_id) ?>"><?php echo get_the_category()[0]->name ?></a>
                        <h2 class="latest-post__tile entry-title"><?php the_title() ?></h2>
                        <p class="latest-post__excerpt entry-summary"><?php affiliatepress_the_custom_excerpt() ?></p>
                        <div class="latest-post__data">
                            <span>Updated <?php echo human_time_diff(affiliatepress_get_the_updated_time("U")) ?> ago</span>
                            <span class="latest-post__divider"> • </span>
                            <span>By <a class="latest-post__author" href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>"><?php the_author() ?></a></span>
                        </div>
                    </div>
                </article>
        <?php endwhile;
        endif; ?>
    </div>
</div>
<?php wp_reset_postdata() ?>

<?php get_footer() ?>