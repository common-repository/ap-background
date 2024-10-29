<?php
/**
 * Front end: Parallax view kieu video
 *
 * @author SFThemes
 * @package AP Background
 * @version 1.0.0
 */
$items = $item->settings->media_source->items;
foreach ($items as $key => $media_item):
    $inputValue = '<div class="video-inner" style="display:none">';
    if ($media_item->media_source == 'from_media' || $media_item->media_source == 'external_source'):
        if ($media_item->media_source == 'from_media') {
            $media_item->video_url = site_url() . $media_item->video_url;
        }
        $inputValue .= '<video controls autoplay>';
        $inputValue .='<source src="' . esc_attr($media_item->video_url) . '"/>';
        $inputValue .='Your browser doesn\'t support this format';
        $inputValue .='</video>';
    endif;
    if ($media_item->media_source == 'youtube'):
        $inputValue .='<iframe width="100%" height="450" src="//www.youtube.com/embed/' . esc_attr($media_item->video_url) . '?autohide=1&fs=1&rel=0&hd=1&wmode=opaque&enablejsapi=1&autoplay=1" frameborder="0" allowfullscreen></iframe>';
    endif;

    if ($media_item->media_source == 'vimeo'):
        $inputValue .='<iframe src="//player.vimeo.com/video/' . esc_attr($media_item->video_url) . '?hd=1&show_title=1&show_byline=1&show_portrait=0&fullscreen=1&autoplay=1" width="100%" height="450" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
    endif;

    if ($media_item->media_source == 'embedcode'):
        $inputValue .= urldecode($media_item->video_url);
    endif;
    $inputValue .= '</div>';
    ?>
    <div class="video-wrap">
        <input class="video-contain hidden <?php if ($key == 0) echo 'show'; ?>" type="hidden" value="<?php echo htmlspecialchars($inputValue); ?>"/>
    </div>
    <?php
endforeach;

