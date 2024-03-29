<?php /* Define the custom box */

if (!defined('ABSPATH')) exit;

// WP 3.0+
add_action('add_meta_boxes', 'affiliatepress_post_options_metabox');

// backwards compatible
add_action('admin_init', 'affiliatepress_post_options_metabox', 1);

/* Do something with the data entered */
add_action('save_post', 'affiliatepress_save_post_options');

/**
 *  Adds a box to the main column on the Post edit screen
 * 
 */
function affiliatepress_post_options_metabox()
{
    add_meta_box('post_options', __('Post Options' , 'affiliatepress'), 'affiliatepress_post_options_code', 'post', 'normal', 'high');
}

/**
 *  Prints the box content
 */

function affiliatepress_post_options_code($post)
{
    wp_nonce_field(plugin_basename(__FILE__), $post->post_type . '_post_options_noncename');

    $visibility_comments = affiliatepress_get_post_meta_default($post->ID, '_visibility_comments');
    $visibility_featured_image = affiliatepress_get_post_meta_default($post->ID, '_visibility_featured_image');
    $visibility_title = affiliatepress_get_post_meta_default($post->ID, '_visibility_title');
    $sidebar_popular_posts = affiliatepress_get_post_meta_default($post->ID, '_visibility_sidebar_popular_posts');
?>

    <div class="custom-meta-boxes">
        <div class="custom-meta-box">
            <label for="show_comments" class="selectit"><?php _e('Comments', 'affiliatepress'); ?></label>
            <select name="_visibility_comments" id="show_comments" class="selectit">
                <option value="default" <?php selected($visibility_comments, 'default'); ?>>Default (<?php  esc_attr_e(get_theme_mod("setting_visibility_comments", "Show")); ?>)</option>
                <option value="show" <?php selected($visibility_comments, 'show'); ?>>Show</option>
                <option value="hide" <?php selected($visibility_comments, 'hide'); ?>>Hide</option>
            </select>
        </div>
        <div class="custom-meta-box">
            <label for="show_featured_image" class="selectit"><?php _e('Featured Image', 'affiliatepress'); ?></label>
            <select name="_visibility_featured_image" id="show_featured_image" class="selectit">
                <option value="default" <?php selected($visibility_featured_image, 'default'); ?>>Default (<?php esc_attr_e(get_theme_mod("setting_visibility_featured_image", "Show")); ?>)</option>
                <option value="show" <?php selected($visibility_featured_image, 'show'); ?>>Show</option>
                <option value="hide" <?php selected($visibility_featured_image, 'hide'); ?>>Hide</option>
            </select>
        </div>
        <div class="custom-meta-box">
            <label for="show_title" class="selectit"><?php _e('Post Title', 'affiliatepress'); ?></label>
            <select name="_visibility_title" id="show_title" class="selectit">
                <option value="default" <?php selected($visibility_title, 'default'); ?>>Default (<?php esc_attr_e(get_theme_mod("setting_visibility_title", "Show")); ?>)</option>
                <option value="show" <?php selected($visibility_title, 'show'); ?>>Show</option>
                <option value="hide" <?php selected($visibility_title, 'hide'); ?>>Hide</option>
            </select>
        </div>
        <div class="custom-meta-box">
            <label for="sidebar_popular_posts" class="selectit"><?php _e('Sidebar Popular Posts', 'affiliatepress'); ?></label>
            <select name="_visibility_sidebar_popular_posts" id="sidebar_popular_posts" class="selectit">
                <option value="default" <?php selected($sidebar_popular_posts, 'default'); ?>>Default (<?php esc_attr_e(get_theme_mod("setting_visibility_sidebar_popular_posts", "Show")); ?>)</option>
                <option value="show" <?php selected($sidebar_popular_posts, 'show'); ?>>Show</option>
                <option value="hide" <?php selected($sidebar_popular_posts, 'hide') ?>>Hide</option>
            </select>
        </div>
    </div>
    <style>
        .custom-meta-boxes {
            border: 1px solid rgba(0, 0, 0, .2);
            padding-top: 15px;
            width: 100%;
            max-width: 400px;
        }

        .custom-meta-box {
            padding-right: 15px;
            padding-left: 15px;
            box-sizing: border-box;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .custom-meta-boxes .custom-meta-box select {
            width: 240px;
        }

        .custom-meta-box label {
            font-size: 15px;
            margin-bottom: 7px;
            margin-top: 0;
            line-height: 1;
            font-weight: 500;
            display: block;
        }
    </style>
<?php
}

/** 
 * When the post is saved, saves our custom data 
 */
function affiliatepress_save_post_options($post_id)
{
    // verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if (!wp_verify_nonce(@$_POST[$_POST['post_type'] . '_post_options_noncename'], plugin_basename(__FILE__)))
        return;

    // Check permissions
    if (!current_user_can('edit_post', $post_id))
        return;

    // OK, we're authenticated: we need to find and save the data
    if ('post' == $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        } else {
            update_post_meta($post_id, '_visibility_comments', $_POST['_visibility_comments']);
            update_post_meta($post_id, '_visibility_featured_image', $_POST['_visibility_featured_image']);
            update_post_meta($post_id, '_visibility_title', $_POST['_visibility_title']);
            update_post_meta($post_id, '_visibility_sidebar_popular_posts', $_POST['_visibility_sidebar_popular_posts']);
        }
    }
}
