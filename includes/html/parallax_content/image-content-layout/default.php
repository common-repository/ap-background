<?php
/**
 * Front end: layout display for type image gallery
 *
 * @author SFThemes
 * @package AP Background
 * @version 1.0.0
 */
?>

<?php
list($thumb_width, $thumb_height, $row_number) = array($item->settings->layout_setting->thumb_width, $item->settings->layout_setting->thumb_height, $item->settings->layout_setting->rows);
$cols = ceil(count($media_items) / $row_number);
$item_index = 0;
?>
<?php for ($i = 0; $i < $cols; $i++): ?>
    <div class="parallax-col">
        <?php
        for ($j = 0; $j < $row_number; $j++):
            $media_item = $media_items[$item_index];
            if ($media_item) {
                $bt_utility->checkMediaItem($item->id, $media_item);
                $upload_dir = wp_upload_dir();
                list($width, $height) = getimagesize($upload_dir['basedir'].'/ap_background/thumb/' . $item->id . '/' . $media_item->thumbnail);
                if ($width > $height) {
                    $attr = 'style="width:100%"';
                } else {
                    $attr = 'style="height:100%"';
                }
                echo '<div class="parallax-row in-pos" ' . (($j > 0) ? 'style="margin-top:' . esc_attr($item->settings->layout_setting->spacing) . 'px;"' : '') . '>';
                echo '<div class="thumb" style="width:' . esc_attr($thumb_width) . 'px; height:' . esc_attr($thumb_height) . 'px;"><img ' . wp_kses_post($attr) . ' src="' . ($upload_dir['baseurl'].'/ap_background/thumb/' . esc_attr($item->id) . '/' . esc_attr($media_item->thumbnail)) . '" alt="' . __('Image thumbnail','ap-background') . '"/></div>';
                echo '<div class="show_box hidden"><img class="image-show" src="' . (($media_item->media_source == 'image_upload') ? site_url() . esc_attr($media_item->large) : esc_url_raw($media_item->large)) . '"  alt="' . __('Image large view') . '"/></div>';
                echo '</div>';
                $item_index++;
            }
        endfor;
        ?>
    </div>
<?php
endfor;
