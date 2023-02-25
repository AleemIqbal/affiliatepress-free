<?php

if (!defined('ABSPATH')) exit;

function affiliatepress_add_featured_category_field($term)
{
    wp_nonce_field('category_meta_edit', 'category_meta_edit_nonce');
?>
    <div class="form-field form-required">
        <label for="_home_featured"><?php _e('Home Featured', 'affiliatepress'); ?></label>
        <input name="_home_featured" id="home_featured" class="selectit" type="checkbox" />
        <p><?php _e('Enable to show in Homepage category section', 'affiliatepress'); ?></p>
    </div>
    <div class="form-field">
        <label for="_featured_image"><?php _e('Featured Image Link', 'affiliatepress'); ?></label>
        <input name="_featured_image" id="featured_image" class="selectit" type="url" />
        <p><?php _e('Image to show Homepage category section', 'affiliatepress'); ?></p>
    </div>
<?php
}

add_action('category_add_form_fields', 'affiliatepress_add_featured_category_field');

function affiliatepress_edit_featured_category_field($term)
{
    wp_nonce_field('category_meta_edit', 'category_meta_edit_nonce');
    $home_featured = get_term_meta($term->term_id, '_home_featured', true);
    $featured_image = get_term_meta($term->term_id, '_featured_image', true);
?>

    <tr class="form-field form-required">
        <th scope="row">
            <label for="_home_featured"><?php _e('Home Featured', 'affiliatepress'); ?></label>
        </th>
        <td>
            <input name="_home_featured" id="home_featured" class="selectit" <?php checked($home_featured, "on"); ?> type="checkbox" />
            <p class="description"><?php _e('Enable to show in Homepage category section', 'affiliatepress'); ?></p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row">
            <label for="_featured_image"><?php _e('Featured Image Link', 'affiliatepress'); ?></label>
        </th>
        <td>
            <input name="_featured_image" id="featured_image" class="selectit" value="<?php echo $featured_image ?>" type="url" />
            <p class="description"><?php _e('Image to show Homepage category section', 'affiliatepress'); ?></p>
        </td>
    </tr>
<?php
}

add_action('category_edit_form_fields', 'affiliatepress_edit_featured_category_field');

// Save the field
function affiliatepress_save_tax_meta($term_id)
{
    if (!wp_verify_nonce($_POST['category_meta_edit_nonce'], 'category_meta_edit')) return;

    update_term_meta($term_id, '_home_featured', $_POST['_home_featured']);
    update_term_meta($term_id, '_featured_image', $_POST['_featured_image']);
}

// save_tax_meta
add_action('created_category', 'affiliatepress_save_tax_meta', 10, 2);
add_action('edited_category', 'affiliatepress_save_tax_meta', 10, 2);


// Add column to Category list
function affiliatepress_featured_category_columns($columns)
{
    return array_merge($columns, array('featured' =>  __('Home Featured' , 'affiliatepress')));
}

add_filter('manage_edit-category_columns', 'affiliatepress_featured_category_columns');

// Add the value to the column
function affiliatepress_featured_category_columns_values($deprecated, $column_name, $term_id)
{
    if ($column_name === 'featured') {
        $home_featured = get_term_meta($term_id, '_home_featured', true);
        if ($home_featured === "on") {
            echo _e('Yes', 'affiliatepress');
        } else {
            echo _e('No', 'affiliatepress');
        }
    }
}
add_action('manage_category_custom_column', 'affiliatepress_featured_category_columns_values', 10, 3);
