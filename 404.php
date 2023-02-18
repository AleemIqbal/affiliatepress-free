<?php get_header(); ?>
<h1 class="entry-title"><?php _e("Page Not Found" , "affiliatepress"); ?></h1>
<p class="not-found">You just hit a route that doesn't exist... the sadness.</p>
<div class="widget widget_block widget_search">
    <?php get_search_form(); ?>
</div>
<div class="latest-section">
    <h2>Latest Posts</h2>
    <div class="latest-posts">
        <?php $args = array('posts_per_page' => 8, 'post_type' => 'post');
        $latest_posts = new WP_Query($args);
        if ($latest_posts->have_posts()) : while ($latest_posts->have_posts()) : $latest_posts->the_post() ?>
                <article class="latest-post hentry">
                    <a class="latest-post__link" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute() ?>"></a>
                    <img class="latest-post__img" alt="<?php the_title() ?>" src="<?php the_post_thumbnail_url() ?>" />
                    <div class="latest-post__info">
                        <a class="latest-post__category" href="<?php echo get_category_link(get_the_category()[0]->term_id) ?>"><?php echo get_the_category()[0]->name ?></a>
                        <h2 class="latest-post__tile entry-title"><?php the_title() ?></h2>
                        <p class="latest-post__excerpt entry-summary"><?php the_custom_excerpt() ?></p>
                        <div class="latest-post__data">
                            <span>Updated <?php echo human_time_diff(get_the_updated_time("U")) ?> ago</span>
                            <span class="latest-post__divider"> • </span>
                            <span>By <a class="latest-post__author" href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>"><?php the_author() ?></a></span>
                        </div>
                    </div>
                </article>
        <?php endwhile;
        endif; ?>
    </div>
</div>
<?php
get_footer(); ?>