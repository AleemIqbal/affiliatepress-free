<div class="post-social">
    <div class="post-social__title">Share post on</div>
    <div class="post-social__links">
        <a target="_blank" rel="noreferrer" title="Share on Facebook" class="btn post-social__btn facebook" href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()) ?>">
            <?php affiliatepress_the_svg('facebook') ?>
        </a>
        <a target="_blank" rel="noreferrer" title="Share on Twitter" class="btn post-social__btn twitter" href="https://twitter.com/share?url=<?php echo urlencode(get_permalink()) ?>&text=<?php echo rawurlencode(get_the_title()) ?>">
            <?php affiliatepress_the_svg('twitter') ?>
        </a>
        <a target="_blank" rel="noreferrer" title="Share on Pinterest" class="btn post-social__btn pinterest" href="https://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()) ?>&media=<?php echo urlencode(get_the_post_thumbnail_url()) ?>&description=<?php echo rawurlencode(get_the_title()) ?>">
            <?php affiliatepress_the_svg('pinterest') ?>
        </a>
        <a target="_blank" rel="noreferrer" title="Download as PDF" class="btn post-social__btn download" href="#" onclick="void( window.print() );">
            <?php affiliatepress_the_svg('download') ?>
        </a>
    </div>
</div>