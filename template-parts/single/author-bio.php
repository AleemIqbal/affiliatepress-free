<div class="auhtor-bio vcard author">
    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="auhtor-bio__img-container">
        <img alt="<?php the_author(); ?>" src="<?php echo affiliatepress_get_my_avatar_url(get_the_author_meta("ID")) ?>" class="auhtor-bio__img" loading="lazy" width="100" height="100" />
    </a>
    <div class="auhtor-bio__text">
        <span class="auhtor-bio__title-container">By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="url fn auhtor-bio__title"><?php the_author() ?></a></span>
        <p class="auhtor-bio__description"><?php echo get_the_author_meta("description"); ?></p>
    </div>
</div>