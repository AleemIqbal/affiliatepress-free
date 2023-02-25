<?php

// for account owner
add_action('show_user_profile', 'affiliatepress_add_custom_user_profile_fields');
add_action('personal_options_update', 'affiliatepress_save_custom_user_profile_fields');

// for admins
add_action('edit_user_profile', 'affiliatepress_add_custom_user_profile_fields');
add_action('edit_user_profile_update', 'affiliatepress_save_custom_user_profile_fields');

function affiliatepress_add_custom_user_profile_fields($user)
{
    wp_nonce_field('user_meta_edit', 'user_meta_edit_nonce');

    printf(
        '<h3>%1$s</h3>
        <table class="form-table">
            <tr>
                <th><label for="custom_avatar_url">%2$s</label></th>
                <td>
                    <input type="url" name="custom_avatar_url" id="custom_avatar_url" value="%3$s" class="regular-text" />
                </td>
            </tr>
        </table>',
        __('Custom Avatar' , 'affiliatepress'),
        __('Custom Avatar URL' , 'affiliatepress'),
        esc_attr(get_user_meta($user->ID, 'custom_avatar_url', true))
    );
}

function affiliatepress_save_custom_user_profile_fields($user_id)
{
    if (!isset($_POST['user_meta_edit_nonce']) || !wp_verify_nonce($_POST['user_meta_edit_nonce'], 'user_meta_edit'))  exit;

    if (!current_user_can('edit_user', $user_id)) return FALSE;

    $custom_avatar = (isset($_POST['custom_avatar_url'])) ? $_POST['custom_avatar_url'] : '';

    update_user_meta($user_id, 'custom_avatar_url', $custom_avatar);
}
