<?php
/**
 * List AP Background item's layout.
 *
 * @author SFThemes
 * @package AP Background
 * @version 1.0.0
 */
?>

<div class="bt-parallax-wrap">
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
        echo wp_kses_post(get_transient('ap_message'));
        delete_transient('ap_message');
    }
    ?>
    <div class="control-buttons">
        <div class="create-button">
            <span class="button blue"><i class="fa fa-plus"></i> <?php echo __('CREATE NEW', 'ap-background'); ?></span>
        </div>
        <div class="delete-button">
            <span class="button red delete-items-list"><i class="fa fa-times"></i> <?php echo __('DELETE', 'ap-background'); ?></span>
        </div>
        <div style="position: relative; float: left;"><span class="bt-ajax-loading list-item-ajax-delete-select"><i class="fa fa-spinner fa-spin fa-2x"></i></span></div>
    </div>
    <div class="clear"></div>
    <div class="list-item">
        <div class="header">
            <div scope="col" id="cb" class="column manage-column column-cb check-column" style="">
                <label class="screen-reader-text" for="cb-select-all-1"><?php __('Select All', 'ap-background'); ?></label>
                <input id="cb-select-all-1" type="checkbox">
            </div>
            <div scope="col" class="column manage-column column-id" style=""><?php echo __('ID', 'ap-background'); ?></div>
            <div scope="col" class="column manage-column column-title" style=""><?php echo __('Name', 'ap-background'); ?></div>
            <div scope="col" class="column manage-column column-short-code" style=""><?php echo __('ShortCode', 'ap-background'); ?></div>
            <div scope="col" class="column manage-column column-type" style=""><?php echo __('Type', 'ap-background'); ?></div>
            <div scope="col" class="column manage-column column-last-modify" style="">
                <span><?php echo __('Last Modify', 'ap-background'); ?></span>
            </div>
            <div scope="col" class="column manage-column column-published" style="">
                <span><?php echo __('Published', 'ap-background'); ?></span>
            </div>	
            <div scope="col" class="column manage-column column-action" style="">
                <span><?php echo __('Action', 'ap-background'); ?></span>
            </div>
            <div class="clear"></div>
        </div>
        <?php
        global $wpdb;
        $items = $wpdb->get_results('SELECT id, name, alias, settings, modified, status FROM ' . $wpdb->prefix . 'ap_background');
        if (!empty($items)):
            foreach ($items as $item):
                $itemSettings = json_decode($item->settings);
                $item_type = '';
                switch ($itemSettings->content_type) {
                    case 'image-gallery':
                        $item_type = 'Image Gallery';
                        break;
                    case 'video-background':
                        $item_type = 'Video Background';
                        break;
                    case 'woo-commerce':
                        $item_type = 'Woo Commerce';
                        break;
                    default:
                        $item_type = 'Wordpress Posts';
                        break;
                }
                ?>
                <div class="item">
                    <div class="row row-checkbox" style="">
                        <input type="checkbox" name="fields[]" value="<?php echo esc_attr($item->id); ?>"/>
                    </div>
                    <div scope="row" class="row row-id" style=""><?php echo esc_attr($item->id); ?></div>
                    <div scope="row" class="row row-title" style="">
                        <a href="<?php echo admin_url('admin.php?page=bt-advance-parallax-background/create-new&content_type=' . esc_attr($itemSettings->content_type) . '&id=' . esc_attr($item->id)); ?>">
                            <?php echo esc_attr($item->name); ?>
                        </a>
                    </div>
                    <div scope="row" class="row row-short-code" style=""><input type="text" value="<?php echo '[adv_parallax_back alias=\'' . esc_attr($item->alias) . '\']'; ?>" onclick="this.select();" readonly="true"/></div>
                    <div scope="row" class="row row-type" style=""><?php echo esc_attr($item_type); ?></div>
                    <div scope="row" class="row row-last-modify" style="">
                        <span><?php echo date('m/d/Y', $item->modified); ?></span>
                    </div>
                    <div scope="row" class="row row-published" style="">
                        <span><?php echo ($item->status == 1) ? 'Yes' : 'No'; ?></span>
                    </div>	
                    <div scope="row" class="row row-action" style="">
                        <a href="<?php echo admin_url('admin.php?page=bt-advance-parallax-background/create-new&content_type=' . esc_attr($itemSettings->content_type) . '&id=' . esc_attr($item->id)); ?>">
                            <span class="button green" title="<?php echo __('Edit', 'ap-background'); ?>"><i class="fa fa-pencil"></i></span>
                        </a>
                        <span class="button red delete" title="<?php echo __('Delete', 'ap-background'); ?>"><i class="fa fa-times"></i></span>
                        <span class="button blue copy" title="<?php echo __('Copy', 'ap-background'); ?>"><i class="fa fa-copy"></i></span>
                        <span class="button original preview" title="<?php echo __('Preview', 'ap-background'); ?>"><i class="fa fa-desktop"></i></span>
                        <span class="bt-ajax-loading list-item-ajax"><i class="fa fa-circle-o-notch fa-spin"></i></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php
            endforeach;
        else:
            ?>
            <?php echo __('No slider created', 'ap-background'); ?>
        <?php endif; ?>
    </div>
    <div class="control-buttons">
        <div class="create-button">
            <span class="button blue"><i class="fa fa-plus"></i> <?php echo __('CREATE NEW', 'ap-background'); ?></span>
        </div>
        <div class="delete-button">
            <span class="button red delete-items-list"><i class="fa fa-times"></i> <?php echo __('DELETE', 'ap-background'); ?></span>
        </div>
        <div style="position: relative; float: left;"><span class="bt-ajax-loading list-item-ajax-delete-select"><i class="fa fa-spinner fa-spin fa-2x"></i></span></div>
    </div>
</div>
<div class="bt-parallax-select-slide-type hidden">
    <div class="bg-type-list-wrap">
        <div class="header-title"><?php echo __('BACKGROUND CONTENT TYPES', 'ap-background'); ?></div>
        <div class="bg-content-type-list">
            <?php $content_types = apply_filters('sfapb_get_content_types', sfapb_get_content_types()); ?>
            <?php if (!empty($content_types)): $i = 1; ?>
                <?php foreach ($content_types as $slug => $ctype): ?>
                    <?php
                    $class = 'content-type-item ' . $slug;
                    if ($slug == 'video-background') {
                        $class .= ' selected';
                    }
                    if ($i % 2 == 0) {
                        $class .= ' end-row';
                    }
                    ?>
                    <div class="<?php echo esc_attr($class); ?>">
                        <div class="item-image">
                            <span class="item-selected" style="display:none;"><i class="fa fa-check"></i></span>
                            <span class="item-icon"><?php echo $ctype['icon_type'] == 'font' ? '<i class="' . esc_attr($ctype['icon']) . '"></i>' : '<img src="' . esc_url_raw($ctype['icon']) . '" style="max-width:50px;" alt="icon"/>'; ?></span>
                        </div>
                        <div class="item-title"><span><?php echo esc_attr($ctype['title']); ?></span></div>
                    </div>
                    <?php
                    $i++;
                endforeach;
                ?>
            <?php endif; ?>
            <div class="clear"></div>
        </div>
        <div class="create-slideshow">
            <a href="<?php echo admin_url('admin.php?page=bt-advance-parallax-background/create-new&content_type=video-background'); ?>"><span class="button blue"><?php echo __('CREATE NEW SLIDESHOW', 'ap-background'); ?></span></a>
        </div>
    </div>
</div>
<div id="btp-item-preview" class="hidden">
    <div class="preview-close">
        <span class="button btn-none" title="<?php echo __('Close', 'ap-background'); ?>"><i class="fa fa-times"></i></span>
    </div>
    <div class="overlay-loading"><span class="loading"><img src="<?php echo SFAPB_PLUGIN_URL . "assets/images/loading-black.gif"; ?>"  alt="<?php echo __('Loading...','ap-background'); ?>"/></span></div>
    <div class="preview-content">
        <div class="preview-content-in"></div>
    </div>

</div>