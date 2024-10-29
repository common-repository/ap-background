<?php
/**
 * Front end: Parallax view kieu image
 *
 * @author SFThemes
 * @package AP Background
 * @version 1.0.0
 */


$media_items = $item->settings->media_source->items;
?>

<div class="<?php echo esc_attr($item->settings->layout_setting->layout); ?> layout">
    <?php include_once 'image-content-layout/' . esc_attr($item->settings->layout_setting->layout) . '.php'; ?>
</div>
