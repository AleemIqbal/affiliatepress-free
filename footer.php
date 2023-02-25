<?php do_action("after_page"); ?>
</div>
</div>
</div>
<footer class="footer" id="colophon" itemtype="https://schema.org/WPFooter" itemscope itemid="#colophon" tabindex="-1">
    <div class="container">
        <div class="footer__inner">
            <?php
            $footer_logo = get_theme_mod("setting_footer_logo", '');
            if (!empty($footer_logo)) {
                echo '<div class="footer__logo-container">';
                echo '<a href="/">';
                echo '<img class="footer__logo" src="' . $footer_logo . '" alt="' . get_bloginfo("name") . '" loading="lazy" />';
                echo '</a>';
                echo '</div>';
            }
            $footer_text = get_theme_mod("setting_company_text", '');
            if (!empty($footer_text)) {
                echo '<p class="footer__company-text">' . $footer_text . '</p>';
            } ?>

            <div class="footer__social">
                <?php
                $youtube_link = get_theme_mod("setting_social_youtube", "#");
                $facebook_link = get_theme_mod("setting_social_facebook", "#");
                $twitter_link = get_theme_mod("setting_social_twitter", "#");
                $tumblr_link = get_theme_mod("setting_social_tumblr", "#");
                $linkedin_link = get_theme_mod("setting_social_linkedin", "#");

                if (!empty($youtube_link)) { ?>
                    <a href="<?php echo $youtube_link ?>" class="footer__social-icon youtube" target="_blank" rel="follow external noopener noreferrer">
                        <?php affiliatepress_the_svg("youtube") ?>
                    </a>
                <?php }
                if (!empty($facebook_link)) { ?>
                    <a href="<?php echo $facebook_link ?>" class="footer__social-icon facebook" target="_blank" rel="follow external noopener noreferrer">
                        <?php affiliatepress_the_svg("facebook") ?>
                    </a>
                <?php }
                if (!empty($twitter_link)) { ?>
                    <a href="<?php echo $twitter_link ?>" class="footer__social-icon twitter" target="_blank" rel="follow external noopener noreferrer">
                        <?php affiliatepress_the_svg("twitter") ?>
                    </a>
                <?php }
                if (!empty($tumblr_link)) { ?>
                    <a href="<?php echo $tumblr_link ?>" class="footer__social-icon tumblr" target="_blank" rel="follow external noopener noreferrer">
                        <?php affiliatepress_the_svg("tumblr") ?>
                    </a>
                <?php }
                if (!empty($linkedin_link)) { ?>
                    <a href="<?php echo $linkedin_link ?>" class="footer__social-icon linkedin" target="_blank" rel="follow external noopener noreferrer">
                        <?php affiliatepress_the_svg("linkedin") ?>
                    </a>
                <?php } ?>
            </div>
            <div class="footer__menu">
            <?php if (has_nav_menu("footer_menu")): ?>
                <?php wp_nav_menu(array('theme_location' => "footer_menu")) ?>
            <?php endif; ?>
            </div>
            <div class="footer__copyright">
                <?php
                $dmca_link = get_theme_mod("setting_dmca_link", "#");
                if (!empty($dmca_link)) { ?>
                    <div class="footer__copyright__dmca">
                        <a href="<?php echo $dmca_link ?>" target="_blank" rel="follow external noopener noreferrer">
                            <img src="<?php echo esc_url( get_template_directory_uri() ) ?>/assets/img/dmca.png" alt="DMCA.com Protection Status" loading="lazy" width="121" height="24">
                        </a>
                    </div>
                <?php }

$theme = wp_get_theme();
$author_url = $theme->get( 'AuthorURI' );
$author = $theme->get( 'Author' );
$current_year = date( 'Y' );
$site_title = get_bloginfo( 'name' );
$copyright_text = get_theme_mod( 'setting_copyright_text', sprintf( '%s © %s. All rights reserved. Designed By <a href="%s" target="_blank">%s</a>.', $site_title, $current_year, $author_url, $author ) );
                $searchVal = array("%%site_title%%", "%%current_year%%");
                $replaceVal = array(get_bloginfo('name'), date("Y"));
                $result = str_replace($searchVal, $replaceVal, $copyright_text); ?>
                <p class="footer__copyright__text"><?php echo $result ?></p>
            </div>
        </div>
    </div>
</footer>
<?php
$cookie_consent = get_theme_mod("setting_cookie_consent", false);
$cookie_consent_text = get_theme_mod("setting_cookie_consent_text", 'This website uses cookies in order to offer you the most relavant information.');
if ($cookie_consent != false) { ?>
    <div class="cookie-consent">
        <div class="cookie-consent__container">
            <p><?php echo $cookie_consent_text ?></p>
            <button class="button-cookie" id="rcc-confirm-button" aria-label="<?php echo esc_attr__( 'Accept cookies', 'affiliatepress' ); ?>">
    <?php esc_html_e( 'I understand', 'affiliatepress' ); ?>
</button>
        </div>
    </div>
<?php }
?>

<style>
    @import "//fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap";
</style>
<?php wp_footer(); ?>
</body>

</html>