<?php

/**
 * Declare class shortCodeClass
 *
 * @author  SFThemes
 * @package AP Background
 * @version 1.0.0
 */
class shortCodeClass {

    /**
     * If you should add the script or not
     *
     * @var bool
     */
    private $inlineCss = '';

    public function __construct() {
        add_shortcode('adv_parallax_back', array($this, 'generateParallaxBackground'));

        // wp_enqueue_scripts
        // If you use the below the CSS and JS file will be added on everypage
        // add_action( 'wp_enqueue_scripts', array($this, 'add_shortcode_scripts'));
        // Add styles and scripts to the page
        add_action('wp_footer', array($this, 'add_shortcode_scripts'));
    }

    /**
     * Function create parallax
     * @param type $atts
     * @return type
     */
    function generateParallaxBackground($atts) {

        // Attributes
        extract(shortcode_atts(
                        array(
                            'alias' => '',
                        ), $atts)
        );

        // Code
        return $this->generateParallaxBackgroundHTML($alias);
    }

    public function add_shortcode_scripts() {
        echo '<div class="style-addition"><style scoped>' . wp_kses_post($this->inlineCss) . '</style></div>';
    }

    /**
     * Function create parallax block content
     * @param type $alias
     * @return type
     */
    private function generateParallaxBackgroundHTML($alias) {
        require_once SFAPB_PLUGIN_DIR . 'includes/utility.php';
        $bt_utility = new btParallaxBackgroundUtility();
        //Lay thong tin cua parallax theo alias
        $item = $bt_utility->getSliderByAlias($alias);
        //Kiem tra xem thong tin cua parallax co lay duoc khong
        if (!$item) {//neu khong lay duoc thong tin thi hien thi text thay the
            return __('No Parallax Background:') . $alias;
        }
        //Xu ly neu thong tin cua parallax lay duoc.
        $item->settings = json_decode($item->settings);
        //Tao bien identify cho khoi parallax
        $parallax_id = rand(1, 10000);
        //Khoi tao va xu ly kieu cua khoi parallax
        $claass = 'fixed-width';
        if ($item->settings->slider_size->width->type == 'auto') {
            $claass = 'auto-width';
        }
        if ($item->settings->slider_size->width->type == 'full') {
            $claass = 'full-width';
        }

        //Tao HTML va js cho khoi paralalx
        ob_start();
        ?>
        <div class="parallax-block-wrap-module <?php echo esc_attr($claass); ?>" style="<?php echo ($item->settings->slider_size->height) ? 'height:' . esc_attr($item->settings->slider_size->height) . 'px;' : 'height:300px;'; ?> <?php echo ($item->settings->slider_size->width->type == 'fixed' && $item->settings->slider_size->width->size) ? 'width:' . esc_attr($item->settings->slider_size->width->size) . 'px;' : 'width:100%;'; ?>">
            <div id="parallax-block-<?php echo esc_attr($parallax_id); ?>" class="parallax-block bt-advance-parallax">
                <style type="text/css" scoped="">
        <?php
        if ($item->settings->content_type == 'image-gallery'):
            echo $bt_utility->getParallaxCss($item->settings->media_source->effect_settings->custom_effect_code, '#parallax-block-' . $parallax_id);
        endif;
        if ($item->settings->content_type == 'woo-commerce' || $item->settings->content_type == 'wordpress-posts'):
            echo $bt_utility->getParallaxCss($item->settings->content_source->content_settings->effect_settings->custom_effect_code, '#parallax-block-' . $parallax_id);
        endif;
        echo $bt_utility->getParallaxCss($item->settings->content_settings->custom_effect_code, '#parallax-block-' . $parallax_id);
        do_action('sfapb_parallax_custom_css', $item);
        ?>
                </style>
                <?php if ($item->settings->parallax_bg_type == 'dynamic'): ?>
                    <div class="control-button">
                        <div class="nav-wrap hidden">
                            <div class="nav-wrap-in next">
                                <span class="nav-next"></span>
                            </div>
                            <div class="nav-wrap-in prev">
                                <span class="nav-prev"></span>
                            </div>
                        </div>
                        <div class="button-wrap" style="display: none;">
                            <span class="button close-btn"></span>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="parallax-background">
                    <!--Textured and color-->
                    <?php
                    $overlayStyle = '';
                    if ($item->settings->bg_type == 'img') {
                        if ($item->settings->background_settings->image->textured && $item->settings->background_settings->image->textured != 'pattern-0') {
                            $overlayStyle = 'background-image: url(' . SFAPB_PLUGIN_URL . 'assets/images/' . $item->settings->background_settings->image->textured . '.png);';
                        }
                        if ($item->settings->background_settings->image->color) {
                            if ($overlayStyle) {
                                $overlayStyle .= 'background-color: ' . $item->settings->background_settings->image->color . ';';
                            } else {
                                $overlayStyle = 'background-color: ' . $item->settings->background_settings->image->color . ';';
                            }
                        }
                        //if ($overlayStyle) {
                        $overlayStyle = 'style="' . $overlayStyle . ' opacity: ' . $item->settings->background_settings->image->opacity . '"';
                        // }
                    } else {
                        if ($item->settings->background_settings->video->textured && $item->settings->background_settings->video->textured != 'pattern-0') {
                            $overlayStyle = 'background-image: url(' . SFAPB_PLUGIN_URL . 'assets/images/' . $item->settings->background_settings->video->textured . '.png);';
                        }
                        if ($item->settings->background_settings->video->color) {
                            if ($overlayStyle) {
                                $overlayStyle .= 'background-color: ' . $item->settings->background_settings->video->color . ';';
                            } else {
                                $overlayStyle = 'background-color: ' . $item->settings->background_settings->video->color . ';';
                            }
                        }
                        //if ($overlayStyle) {
                        $overlayStyle = 'style="' . $overlayStyle . ' opacity: ' . $item->settings->background_settings->video->opacity . '"';
                        //}
                    }
                    ?>

                    <?php if ($item->settings->bg_type == 'img' && $item->settings->background_settings->image->background_image) : ?>
                        <?php
                        $background_url = $item->settings->background_settings->image->background_image;
                        if (!substr_count($background_url, 'http://') && !substr_count($background_url, 'https://')) {
                            $background_url = site_url() . $background_url;
                        }
                        ?>
                        <img src="<?php echo esc_url($background_url) ?>" alt="<?php echo __('Image background', 'ap-background'); ?>"/>
                        <?php
                    elseif ($item->settings->bg_type == 'video' && $item->settings->background_settings->video->video_url->video_url) :
                        ?>
                        <div class="video-embed">
                            <?php
                            $video_url = $item->settings->background_settings->video->video_url;
                            ?>
                            <div class="video-wrap  <?php echo $video_url->media_source == 'direct' ? 'video-upload' : ''; ?>">
                                <?php
                                if ($video_url->media_source == 'vimeo'):
                                    ?>
                                    <iframe id="iframe-<?php echo esc_attr($parallax_id); ?>" src="//player.vimeo.com/video/<?php echo esc_attr($video_url->video_url); ?>?hd=1&show_title=0&show_byline=0&show_portrait=0&fullscreen=1&autoplay=1&show_badge=0&loop=1&api=1" width="100%" height="<?php echo ($item->settings->slider_size->height) ? esc_attr($item->settings->slider_size->height) + esc_attr($item->settings->slider_size->height) / 2 : '450'; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                                    <?php
                                    if ($item->settings->background_settings->video->mute == 1):
                                        wp_enqueue_script('vimeo-api', '//f.vimeocdn.com/js/froogaloop2.min.js');
                                        ?>
                                        <script type="text/javascript">
                                            ; (function($) {

                                            var $f = $('#iframe-<?php echo esc_attr($parallax_id); ?>'),
                                                    url = $f.attr('src').split(';')[0];
                                            if (window.addEventListener){
                                            window.addEventListener('message', onMessageReceived, false);
                                            } else{
                                            window.attachEvent('onmessage', onMessageReceived, false);
                                            }
                                            function onMessageReceived(e) {

                                            var data = JSON.parse(e.data);
                                            switch (data.event) {
                                            case 'ready':
                                                    var data = { method: 'setVolume', value: '0' };
                                            $f[0].contentWindow.postMessage(JSON.stringify(data), url);
                                            break;
                                            }

                                            }

                                            })(jQuery);</script>
                                    <?php endif; ?>
                                    <?php
                                elseif ($video_url->media_source == 'youtube'):
                                    ?>
                                    <iframe  id="iframe-<?php echo esc_attr($parallax_id); ?>" width="100%" height="450" src="//www.youtube.com/embed/<?php echo esc_attr($video_url->video_url); ?>?autoplay=1&controls=0&enablejsapi=1&fs=0&loop=1&rel=0&showinfo=0&version=3" frameborder="0" allowfullscreen></iframe>
                                    <?php
                                    if ($item->settings->background_settings->video->mute == 1):
                                        wp_enqueue_script('youtube-api', 'https://www.youtube.com/iframe_api');
                                        ?>
                                        <script type="text/javascript">
                                            function onYouTubeIframeAPIReady() {
                                            var player = new YT.Player('iframe-<?php echo esc_attr($parallax_id); ?>', {
                                            events: {
                                            'onReady': function(){
                                            player.mute();
                                            }
                                            }
                                            });
                                            }
                                        </script>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <video autoplay loop <?php echo $item->settings->background_settings->video->mute == 1 ? 'muted' : ''; ?>>
                                        <source src="<?php echo site_url() . esc_attr($video_url->video_url); ?>"/>
                                        Your browser doesn't support this format
                                    </video>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else: ?>
                    <?php endif; ?>
                    <div class="parallax-background-overlay" <?php echo wp_kses_post($overlayStyle); ?>></div>
                </div>
                <div class="parallax-block-content" style="width: <?php echo ($item->settings->content_settings->content_width) ? esc_attr($item->settings->content_settings->content_width) . 'px' : '100%'; ?>">
                    <?php
                    if ($item->content) {
                        echo apply_filters('the_content',html_entity_decode(stripslashes($item->content)));
                    }
                    ?>
                </div>

                <?php if ($item->settings->parallax_bg_type == 'dynamic'): ?>
                    <div class="parallax-content-wrap" style="display: none;">
                        <?php
                        $p_content_css_class = 'parallax-content hidden '.$item->settings->content_type;
                        $p_content_css_class .= $item->settings->content_type == 'woo-commerce' ? ' woo-product' : '';
                        $p_content_css_class .= $item->settings->content_type == 'wordpress-posts' ? ' wp-post' : ''
                        ?>
                        <div class="<?php echo esc_attr($p_content_css_class);?>">
                             <?php if (isset($item->settings->content_source->title) && $item->settings->content_source->title): ?>
                                <div class="widget-title">
                                    <?php echo esc_attr($item->settings->content_source->title); ?>
                                    <hr class="line"/>
                                </div>
                            <?php endif; ?>
                            <div class="parallax-content-in">
                            </div>
                        </div>
                        <div class="content-show-large hidden" style="display:none;">
                            <div class="item-contain">
                            </div>
                            <div class="loading"><img src="<?php echo SFAPB_PLUGIN_URL . "assets/images/loading-black.gif"; ?>" alt="<?php echo __('Loading...', 'ap-background'); ?>"/></div>
                        </div>
                    </div>
                    <div class="overlay-loading"><span class="loading"><img src="<?php echo SFAPB_PLUGIN_URL . "assets/images/loading-black.gif"; ?>" alt="<?php echo __('Loading...', 'ap-background'); ?>"/></span></div>

                <?php endif; ?>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function () {
        <?php if ($item->settings->enable_parallax_effect == 1): ?>
                jQuery('#parallax-block-<?php echo esc_attr($parallax_id); ?>').btparallaxfix("50%", 0.5);
        <?php endif; ?>
            var options = {
            slideSize: {'type':'<?php echo esc_attr($item->settings->slider_size->width->type); ?>', 'size':'<?php echo esc_attr($item->settings->slider_size->width->size); ?>'},
                    parallaxType: '<?php echo esc_attr($item->settings->parallax_bg_type); ?>',
                    parallaxOpenEffect: '<?php echo isset($item->settings->parallax_open_effect) ? esc_attr($item->settings->parallax_open_effect) : 'fancy'; ?>',
                    parallaxItem: '<?php echo isset($alias) ? esc_attr($alias) : ''; ?>',
                    speed: 2,
                    minWidthAllow: <?php echo ($item->settings->min_width_allow) ? esc_attr($item->settings->min_width_allow) : 400; ?>,
                    backgroundColor: '<?php echo ($item->settings->background_settings->bg_content_color) ? esc_attr($item->settings->background_settings->bg_content_color) : ''; ?>',
        <?php if ($item->settings->content_type == 'image-gallery'): ?>
                item_width: <?php echo ($item->settings->layout_setting->layout == 'default') ? esc_attr($item->settings->layout_setting->thumb_width) : (esc_attr($item->settings->layout_setting->thumb_width) + esc_attr($item->settings->layout_setting->spacing)) * 5 - esc_attr($item->settings->layout_setting->spacing); ?>,
                        item_height: <?php echo esc_attr($item->settings->layout_setting->thumb_height); ?>,
                        layout: '<?php echo esc_attr($item->settings->layout_setting->layout); ?>',
                        rows: <?php echo ($item->settings->layout_setting->layout == 'default') ? esc_attr($item->settings->layout_setting->rows) : '3'; ?>,
                        spacing: <?php echo esc_attr($item->settings->layout_setting->spacing); ?>,
                        scroll_direction: '<?php echo esc_attr($item->settings->media_source->effect_settings->scroll_direction); ?>',
                        autoResizeGallery: '<?php echo esc_attr($item->settings->layout_setting->auto_resize_gallery); ?>',
                        next_prev_s: 200,
                        contentType: 'image'
        <?php endif; ?>
        <?php if ($item->settings->content_type == 'video-background'): ?>
                contentType: 'video'
        <?php endif; ?>
        <?php if ($item->settings->content_type == 'woo-commerce' || $item->settings->content_type == 'wordpress-posts'): ?>
                layout: '<?php echo esc_attr($contentSource->content_settings->layout); ?>',
                        contentType: 'postContent',
                        item_width: <?php echo esc_attr($item->settings->content_source->content_settings->item_width); ?>,
                        item_height: <?php echo esc_attr($item->settings->content_source->content_settings->item_height); ?>,
                        rows: <?php echo esc_attr($item->settings->content_source->content_settings->rows); ?>,
                        spacing: <?php echo esc_attr($item->settings->content_source->content_settings->spacing); ?>,
                        next_prev_s: <?php echo esc_attr($item->settings->content_source->content_settings->item_width) + esc_attr($item->settings->content_source->content_settings->spacing); ?>
        <?php endif; ?>
            <?php do_action('sfapb_paralalx_js_options', $item);?>
            };
            jQuery('#parallax-block-<?php echo esc_attr($parallax_id); ?>').btParallax(options);
        <?php if ($item->settings->slider_size->width->type == 'full'): ?>
                var w = window,
                        d = document,
                        g = d.getElementsByTagName('body')[0],
                        x = g.clientWidth;
                var para = d.getElementById('parallax-block-<?php echo esc_attr($parallax_id); ?>');
                var fcss = "width: " + x + "px; height:<?php echo ($item->settings->slider_size->height) ? esc_attr($item->settings->slider_size->height) . 'px' : '300px'; ?>; margin-left:-" + para.getBoundingClientRect().left + "px";
                para.parentNode.setAttribute('style', fcss);
        <?php endif; ?>
            });
        </script>
        <?php
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

}

new shortCodeClass();
