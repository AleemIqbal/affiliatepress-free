<?php get_header();
wpb_set_post_views(get_the_ID()); ?>

<div class="columns">
    <div class="column is-9 hfeed">
        <?php while (have_posts()) : the_post();
            $author_img = get_my_avatar_url(get_the_author_meta("ID"));
            $featured_img = wp_get_attachment_image_src(get_post_thumbnail_id(), "featured");

            $visibility_title = get_post_meta_default(get_the_ID(), "_visibility_title");
            $visibility_title = $visibility_title === "default" ? (get_theme_mod("setting_visibility_title", true) ? "show" : "hide") : $visibility_title;

            $visibility_featured_image = get_post_meta_default(get_the_ID(), "_visibility_featured_image");
            $visibility_featured_image = $visibility_featured_image === "default" ? (get_theme_mod("setting_visibility_featured_image", true) ? "show" : "hide") : $visibility_featured_image;

            $visibility_comments = get_post_meta_default(get_the_ID(), "_visibility_comments");
            $visibility_comments = $visibility_comments === "default" ? (get_theme_mod("setting_visibility_comments", true) ? "show" : "hide") : $visibility_comments; ?>
            <article class="hentry">
                <a class="post-cat" href="<?php echo get_category_link(get_the_category()[0]->term_id) ?>" rel="tag"><?php echo get_the_category()[0]->name ?></a>
                <?php
                if ($visibility_title != "hide") echo  '<h1 class="entry-title">' . get_the_title() . '</h1>' ?>
                <div class="post-meta">
                    <a class="author" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                        <img alt="<?php the_author(); ?>" src="<?php echo $author_img ?>" class="post-meta__img" loading="lazy" width="40" height="40" />
                        <span><?php the_author(); ?></span>
                    </a>
                    <span class="separator">|</span>
                    <time class="updated"><?php the_svg('calender') ?>Updated <?php echo human_time_diff(get_the_updated_time("U")) ?> ago</time>
                    <time class="published"><?php the_date() ?></time>
                    <?php if ($visibility_comments != "hide") { ?>
                        <span class="separator">|</span>
                        <span class="comments"><?php the_svg('comments') ?><a class="comments" href="#disqus_thread">Comments</a></span>
                    <?php } ?>
                </div>
                <?php
                if ($visibility_featured_image != "hide") { ?>
                    <picture>
                        <source srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), "mobile-featured") ?>" media="(max-width: 767px)">
                        <img src="<?php echo $featured_img[0] ?>" alt="<?php echo get_the_title() ?>" width="<?php echo $featured_img[1] ?>" height="<?php echo $featured_img[2] ?>" />
                    </picture>
                <?php } ?>
                <div class="content entry-content">
                    <?php 
                        the_content(); 
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'your-theme-name' ),
                            'after'  => '</div>',
                        ) );
                    ?>
                </div>
                <hr class="wp-block-separator" />
                <?php
                get_template_part("template-parts/single/share-social");
                get_template_part("template-parts/single/author-bio");
                if ($visibility_comments != "hide") get_template_part("template-parts/single/comments"); ?>
            </article>
        <?php endwhile ?>
    </div>
    <?php get_sidebar() ?>
</div>
<?php
get_template_part("template-parts/single/latest-posts"); ?>
<?php get_footer(); ?>