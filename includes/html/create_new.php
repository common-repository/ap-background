<?php
/**
 * Page create new parallax.
 *
 * @author SFThemes
 * @package AP Background
 * @version 1.0.0
 */
require_once SFAPB_PLUGIN_DIR . 'includes/utility.php';
$bt_utility = new btParallaxBackgroundUtility();
?>

<div class="bt-parallax-wrap">
    <form id="parallax-create" method="post" action="<?php echo admin_url(); ?>admin-post.php">
        <div class="header">
            <div class="title">
                <?php echo __('Advanced Parallax Background', 'ap-background'); ?>
            </div>
            <div class="helper">
                <?php
            $helper_links = apply_filters('sfapb_get_helper_links', sfapb_get_helper_links());
            foreach ($helper_links as $slug => $link):
                ?>
                <a href="<?php echo esc_url_raw($link['link']); ?>" <?php echo isset($link['open_in']) && $link['open_in'] == 'new_tab' ? 'target="_blank"' : ''; ?>><span class="button blue <?php echo esc_attr($slug); ?>" title="<?php echo esc_attr($link['title']); ?>"><?php echo $link['icon_type'] == 'font' ? '<i class="' . esc_attr($link['icon']) . '"></i>' : '<img src="' . esc_url_raw($link['icon']) . '" style="max-width:15px;" alt="icon"/>'; ?></span></a>
            <?php endforeach; ?>
            </div>
            <div class="clear"></div>
        </div>
        <?php
        if (get_transient('ap_message')) {
            echo get_transient('ap_message');
            delete_transient('ap_message');
        }
        if (isset($_GET['id'])) {
            global $wpdb;
            $itemQuery = $wpdb->get_results($wpdb->prepare('SELECT id, name, alias, content, settings, modified, status FROM ' . $wpdb->prefix . 'ap_background WHERE id=%d', $_GET['id']));
            if (!empty($itemQuery)) {
                $item = $itemQuery[0];
                $item->settings = json_decode($item->settings);
            } else {
                echo $bt_utility->getMessage(sprintf(__('No item with id (%s) found. Please add new slider', 'ap-background'), sanitize_text_field($_GET['id'])), 'notice');
            }
        }
        ?>
        <div class="create-new-wrap">
            <?php
            if (isset($_GET['content_type'])):
                $content_type = sanitize_text_field($_GET['content_type']);
                $content_types = apply_filters('sfapb_get_content_types', sfapb_get_content_types());
                if (in_array($content_type, array_keys($content_types))):
                    ?>
                    <div class="tabs">
                        <ul class="tab-links">
                            <li class="active"><a href="#parallax-slide"><i class="fa fa-picture-o"></i>&nbsp;&nbsp;&nbsp;<?php echo __('PARALLAX SLIDER', 'ap-background'); ?></a></li>
                            <?php foreach ($content_types as $slug => $ctype): ?>
                                <?php if ($content_type == $slug): ?>
                                    <li class="dynamic-tab <?php echo (isset($item->settings->parallax_bg_type) && $item->settings->parallax_bg_type != 'dynamic' ) ? 'hidden' : ''; ?>"><a href="#<?php echo esc_attr($slug); ?>"><?php echo $ctype['tab_icon_type'] == 'font' ? '<i class="' . esc_attr($ctype['tab_icon']) . '"></i>' : '<img src="' . esc_url_raw($ctype['tab_icon']) . '" style="max-width:25px;" alt="icon"/>'; ?>&nbsp;&nbsp;&nbsp;<?php echo esc_attr($ctype['tab_title']); ?></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>

                        <div class="tab-content">
                            <div id="parallax-slide" class="tab active">
                                <?php include_once 'create_new.parallax_slide.php'; ?>
                            </div>
                            <?php foreach ($content_types as $slug => $ctype): ?>
                                <?php if ($content_type == $slug): ?>
                                    <div id="<?php echo esc_attr($slug); ?>" class="tab">
                                        <?php include_once $ctype['setting_file']; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <?php echo 'Please select content type correct'; ?>
                <?php endif; ?>
            <?php else: ?>
                <?php echo 'Please select content type'; ?>
            <?php endif; ?>
        </div>
        <?php if (isset($_GET['content_type']) && in_array($_GET['content_type'], array_keys($content_types))): ?>
            <div class="control-buttons">
                <input type="hidden" name="settings[content_type]" value="<?php echo esc_attr($_GET['content_type']); ?>"/>
                <?php if (isset($_GET['id'])): ?>
                    <input type="hidden" name="edit_id" value="<?php echo esc_attr($_GET['id']); ?>"/>
                <?php endif; ?>
                <div class="create-button">
                    <input type="hidden" name="after_save" value=""/>
                    <input type="hidden" name="action" value="bt_advParallaxBackAdminSaveSlider"/>
                    <span class="button blue" onclick="javascript:document.getElementsByName('after_save')[0].value = '';document.forms['parallax-create'].submit();"><i class="fa fa-plus"></i> <?php echo __('SAVE SLIDESHOW', 'ap-background'); ?></span>
                    <span class="button blue" onclick="javascript:document.getElementsByName('after_save')[0].value = 'return'; document.forms['parallax-create'].submit();"><i class="fa fa-plus"></i> <?php echo __('SAVE & CLOSE', 'ap-background'); ?></span>
                    <span class="button red" onclick="javascript:window.location.href = btAdvParallaxBackgroundCfg.siteUrl + 'admin.php?page=bt-advance-parallax-background'"><i class="fa fa-times"></i> <?php echo __('CANCEL', 'ap-background'); ?></span>
                </div>
                <!--                <div class="delete-button">
                                </div>-->
            </div>
        <?php endif; ?>
    </form>
</div>