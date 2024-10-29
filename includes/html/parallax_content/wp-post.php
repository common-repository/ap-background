<?php
/**
 * Front end: Parallax view kieu wordpredd post
 *
 * @author SFThemes
 * @package AP Background
 * @version 1.0.0
 */
?>

<?php
//global $wpdb;
$contentSource = $item->settings->content_source;
$index = 0;
$args = array();
$args['post_type'] = 'post';
if ($contentSource->content_ids) {
    $args['post__in'] = explode(',', $contentSource->content_ids);
} elseif ($contentSource->categories) {
    $args['post__not_in'] = explode(',', $contentSource->content_ex_ids);
    $args['category__in'] = $contentSource->categories;
}
$args['posts_per_page'] = $contentSource->content_settings->limit;
$args['order'] = $contentSource->content_settings->direction;
$args['orderby'] = $contentSource->content_settings->order;
//var_dump($args);die;
$query = new WP_Query($args);
?>
<?php if ($query->have_posts()) : ?>
    <div class="<?php echo esc_attr($contentSource->content_settings->layout); ?>">
        <?php include_once SFAPB_PLUGIN_DIR. 'includes/html/parallax_content/wp-content-layout/' . esc_attr($contentSource->content_settings->layout) . '.php'; ?>
    </div>
<?php else : ?>
    <div class="nodata">
        <div class="title"><?php echo __('Message','ap-background'); ?></div>
        <div class="msg-content">
            <?php _e('Sorry, no posts matched your criteria.','ap-background'); ?>
        </div>
    </div>
<?php endif; 
