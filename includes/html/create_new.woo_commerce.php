<?php
/**
 * Page create new parallax type woocommerce product.
 *
 * @author SFThemes
 * @package AP Background
 * @version 1.0.0
 */
?>

<!--WP Post setting-->
<div class="group-content">
    <h2 class="title"><?php echo __('Woo Commerce Setting', 'ap-background'); ?></h2>
    <div class="content">
        <div class="control-group">
            <div class="label"><?php echo __('Widget title', 'ap-background'); ?></div>
            <div class="control">
                <input type="text" name="settings[content_source][title]" value="<?php echo isset($item->settings->content_source->title) ? esc_attr($item->settings->content_source->title) : ''; ?>"/>
                <span class="descript"><?php echo __('What text use as a widget title. Leave blank if no title is needed.', 'ap-background'); ?></span>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="control-group">
            <div class="label"><?php echo __('Product categories', 'ap-background'); ?></div>
            <div class="control">
                <?php
                $postCats = get_categories(array('type' => 'product', 'taxonomy' => 'product_cat'));
                $cats = array();
                if (!empty($postCats)) {
                    foreach ($postCats as $cat) {
                        $cats[] = array('value' => $cat->term_id, 'text' => $cat->name);
                    }
                } else {
                    $cats[] = array('value' => '', 'text' => __('No categories find', 'ap-background'));
                }
                echo $bt_utility->selectFieldRender('content_source_categories', 'settings[content_source][categories]', isset($item->settings->content_source->categories) ? $item->settings->content_source->categories : '', $cats, '', '', true);
                ?>
                <span class="descript"><?php echo __('Select product categories.', 'ap-background'); ?></span>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="control-group">
            <div class="label"><?php echo __('Product IDs', 'ap-background'); ?></div>
            <div class="control">
                <input type="text" name="settings[content_source][content_ids]" value="<?php echo isset($item->settings->content_source->content_ids) ? esc_attr($item->settings->content_source->content_ids) : ''; ?>"/>
                <span class="descript"><?php echo __('Fill this field with pages IDs separated by commas (,) to retrieve only them.', 'ap-background'); ?></span>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="control-group">
            <div class="label"><?php echo __('Exclude Products IDs', 'ap-background'); ?></div>
            <div class="control">
                <input type="text" name="settings[content_source][content_ex_ids]" value="<?php echo isset($item->settings->content_source->content_ex_ids) ? esc_attr($item->settings->content_source->content_ex_ids) : ''; ?>"/>
                <span class="descript"><?php echo __('Fill this field with products IDs separated by commas (,) to exclude them from query.', 'ap-background'); ?></span>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="control-group">
            <div class="label"><?php echo __('Product types', 'ap-background'); ?></div>
            <div class="control">
                <?php
                $posttype = array(
                    array('value' => 'none', 'text' => __('None', 'ap-background')),
                    array('value' => 'nomal', 'text' => __('Nomal Product', 'ap-background')),
                    array('value' => 'sale', 'text' => __('Sale Product', 'ap-background')),
                    array('value' => 'featured', 'text' => __('Featured Product', 'ap-background'))
                );
                echo $bt_utility->selectFieldRender('content_source_content_type', 'settings[content_source][product_content_type]', isset($item->settings->content_source->product_content_type)?$item->settings->content_source->product_content_type:'', $posttype, '', '', false);
                ?>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="control-group">
            <div class="label"><?php echo __('Order by', 'ap-background'); ?></div>
            <div class="control">
                <?php
                $orderdata = array(
                    array('value' => 'menu_order', 'text' => __('Ordering', 'ap-background')),
                    array('value' => 'title', 'text' => __('Title', 'ap-background')),
                    array('value' => 'date', 'text' => __('Date', 'ap-background')),
                    array('value' => 'popularity', 'text' => __('Popularity (sales)', 'ap-background')),
                    array('value' => 'rate', 'text' => __('Rating', 'ap-background')),
                    array('value' => 'price', 'text' => __('Price', 'ap-background')),
                    array('value' => 'rand', 'text' => __('Random', 'ap-background'))
                );
                if(get_option( 'woocommerce_enable_review_rating' ) === 'no'){
                    unset($orderdata[4]);
                }
                echo $bt_utility->selectFieldRender('content_source_content_settings_order', 'settings[content_source][content_settings][order]', isset($item->settings->content_source->content_settings->order)?$item->settings->content_source->content_settings->order:'', $orderdata, '', 'input-medium', false);
                ?>
                <span><?php echo __('Order way', 'ap-background'); ?></span>
                <?php
                $orderwaydata = array(
                    array('value' => 'DESC', 'text' => __('DESC', 'ap-background')),
                    array('value' => 'ASC', 'text' => __('ASC', 'ap-background'))
                );
                echo $bt_utility->selectFieldRender('content_source_content_settings_order', 'settings[content_source][content_settings][direction]', isset($item->settings->content_source->content_settings->direction)?$item->settings->content_source->content_settings->direction:'', $orderwaydata, '', 'input-medium', false);
                ?>
                <span><?php echo __('Limit', 'ap-background'); ?></span>
                <input class="input-medium" type="text" value="<?php echo isset($item->settings->content_source->content_settings->limit) ? esc_attr($item->settings->content_source->content_settings->limit) : '20'; ?>" name="settings[content_source][content_settings][limit]"/>
            </div>
            <div style="clear: both"></div>
        </div>
    </div>
</div>

<!--Layout setting-->
<div class="group-content">
    <h2 class="title"><?php echo __('Layout Setting', 'ap-background'); ?></h2>
    <div class="content">
        <div class="control-group">
            <div class="label" style="margin-bottom: 15px;"><?php echo __('Select our layout templates', 'ap-background'); ?></div>
            <div class="layout-list">
                <?php
                $layout = isset($item->settings->content_source->content_settings->layout)?$item->settings->content_source->content_settings->layout:'layout1';
                ?>
                <div class="item-layout layout1<?php echo ($layout == 'layout1' || !$layout) ? ' selected' : ''; ?>" data-layout="layout1">
                    <span class="item-selected"><i class="fa fa-check"></i></span>
                </div>
                <div class="item-layout layout2<?php echo ($layout == 'layout2') ? ' selected' : ''; ?>" data-layout="layout2">
                    <span class="item-selected"><i class="fa fa-check"></i></span>
                </div>
                <input type="hidden" value="<?php echo ($layout) ? esc_attr($layout) : 'layout1'; ?>" name="settings[content_source][content_settings][layout]"/>
                <div style="clear: both"></div>
            </div>
        </div>
        <div class="control-group">
            <div class="label"><?php echo __('Item width', 'ap-background'); ?></div>
            <div class="control">
                <input class="input-short" value="<?php echo isset($item->settings->content_source->content_settings->item_width) ? esc_attr($item->settings->content_source->content_settings->item_width) : '250'; ?>" type="text" name="settings[content_source][content_settings][item_width]"/> px
                <span><?php echo __('Height', 'ap-background'); ?></span>
                <input class="input-short" value="<?php echo isset($item->settings->content_source->content_settings->item_height) ? esc_attr($item->settings->content_source->content_settings->item_height) : '300'; ?>" type="text" name="settings[content_source][content_settings][item_height]"/> px
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="control-group">
            <div class="label"><?php echo __('Number of row', 'ap-background'); ?></div>
            <div class="control">
                <input class="input-short" type="text" value="<?php echo isset($item->settings->content_source->content_settings->rows) ? esc_attr($item->settings->content_source->content_settings->rows) : '2'; ?>" name="settings[content_source][content_settings][rows]"/>
                <span><?php echo __('Spacing', 'ap-background'); ?></span>
                <input class="input-short" value="<?php echo isset($item->settings->content_source->content_settings->spacing) ? esc_attr($item->settings->content_source->content_settings->spacing) : '15'; ?>" type="text" name="settings[content_source][content_settings][spacing]"/> px
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="control-group">
            <div class="label"><?php echo __('Show image', 'ap-background'); ?></div>
            <div class="control">
                <?php
                $show_imagedata = array(
                    array('value' => '1', 'text' => __('Yes', 'ap-background')),
                    array('value' => '0', 'text' => __('No', 'ap-background'))
                );
                echo $bt_utility->selectFieldRender('content_settings_show_image', 'settings[content_source][content_settings][show_image]', isset($item->settings->content_source->content_settings->show_image) ? $item->settings->content_source->content_settings->show_image:'', $show_imagedata, '', '', false);
                ?>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="control-group">
            <div class="label"><?php echo __('Show title', 'ap-background'); ?></div>
            <div class="control">
                <?php
                $show_titledata = array(
                    array('value' => '1', 'text' => __('Yes', 'ap-background')),
                    array('value' => '0', 'text' => __('No', 'ap-background'))
                );
                echo $bt_utility->selectFieldRender('content_settings_show_title', 'settings[content_source][content_settings][show_title]', isset($item->settings->content_source->content_settings->show_title) ? $item->settings->content_source->content_settings->show_title: '1', $show_titledata, '', '', false);
                ?>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="control-group">
            <div class="label"><?php echo __('Show product Information', 'ap-background'); ?></div>
            <div class="control">
                <?php
                $show_infodata = array(
                    array('value' => '1', 'text' => __('Yes', 'ap-background')),
                    array('value' => '0', 'text' => __('No', 'ap-background'))
                );
                echo $bt_utility->selectFieldRender('content_settings_show_info', 'settings[content_source][content_settings][show_info]', isset($item->settings->content_source->content_settings->show_info)?$item->settings->content_source->content_settings->show_info:1, $show_infodata, '', '', false);
                ?>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="control-group">
            <div class="label"><?php echo __('Show Product Description', 'ap-background'); ?></div>
            <div class="control">
                <?php
                $show_desdata = array(
                    array('value' => '1', 'text' => __('Yes', 'ap-background')),
                    array('value' => '0', 'text' => __('No', 'ap-background'))
                );
                echo $bt_utility->selectFieldRender('content_settings_show_des', 'settings[content_source][content_settings][show_des]', isset($item->settings->content_source->content_settings->show_des)?$item->settings->content_source->content_settings->show_des:'1', $show_desdata, '', 'input-medium', false);
                ?>
                <span><?php echo __('Number of word', 'ap-background'); ?></span>
                <input class="input-short" value="<?php echo isset($item->settings->content_source->content_settings->number_word) ? esc_attr($item->settings->content_source->content_settings->number_word) : '15'; ?>" type="text" name="settings[content_source][content_settings][number_word]"/>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="control-group">
            <div class="label"><?php echo __('Show Add to cart', 'ap-background'); ?></div>
            <div class="control">
                <?php
                $show_moredata = array(
                    array('value' => '1', 'text' => __('Yes', 'ap-background')),
                    array('value' => '0', 'text' => __('No', 'ap-background'))
                );
                echo $bt_utility->selectFieldRender('content_settings_show_add_to_cart', 'settings[content_source][content_settings][add_to_cart]', isset($item->settings->content_source->content_settings->add_to_cart)?$item->settings->content_source->content_settings->add_to_cart:'1', $show_moredata, '', '', false);
                ?>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="control-group">
            <div class="label"><?php echo __('Show Add to wishlist', 'ap-background'); ?></div>
            <div class="control">
                <?php
                $show_wishlistdata = array(
                    array('value' => '1', 'text' => __('Yes', 'ap-background')),
                    array('value' => '0', 'text' => __('No', 'ap-background'))
                );
                echo $bt_utility->selectFieldRender('content_settings_show_add_to_wishlist', 'settings[content_source][content_settings][add_to_wishlist]', isset($item->settings->content_source->content_settings->add_to_wishlist)?$item->settings->content_source->content_settings->add_to_wishlist:1, $show_wishlistdata, '', '', false);
                ?>
                <span class="descript"><?php echo __('This option only use when <strong>yith-woocommerce-wishlist</strong> installed.', 'ap-background'); ?></span>
            </div>
            <div style="clear: both"></div>
        </div>
    </div>
</div>

<!--Effect setting-->
<div class="group-content">
    <h2 class="title"><?php echo __('Effect setting', 'ap-background'); ?></h2>
    <div class="content">
        <div class="label" style="margin-bottom: 15px;"><?php echo __('Select effect for product list', 'ap-background'); ?></div>
        <div class="control-group">
            <div class="label"><?php echo __('Content appare', 'ap-background'); ?></div>
            <div class="control">
                <?php
                $data = array(
                    array('value' => 'fade_left', 'text' => __('Fade from left', 'ap-background')),
                    array('value' => 'fade_top', 'text' => __('Fade from top', 'ap-background')),
                    array('value' => 'fade_right', 'text' => __('Fade from right', 'ap-background')),
                    array('value' => 'fade_bottom', 'text' => __('Fade from bottom', 'ap-background'))
                );
                echo $bt_utility->selectFieldRender('item_source_effect_settings_effect_in', 'settings[content_source][content_settings][effect_settings][effect_in]', isset($item->settings->content_source->content_settings->effect_settings->effect_in)?$item->settings->content_source->content_settings->effect_settings->effect_in:'fade_left', $data, '', '', false);
                ?>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="control-group">
            <div class="label"><?php echo __('Content disappare', 'ap-background'); ?></div>
            <div class="control">
                <?php
                echo $bt_utility->selectFieldRender('item_source_effect_settings_effect_out', 'settings[content_source][content_settings][effect_settings][effect_out]', isset($item->settings->content_source->content_settings->effect_settings->effect_out)?$item->settings->content_source->content_settings->effect_settings->effect_out:'fade_right', $data, '', '', false);
                ?>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="label" style="margin-bottom: 15px;"><?php echo __('Custom content effect setting code', 'ap-background'); ?></div>
        <div class="custom-effect">
            <textarea id="content_settings_effect_settings_custom_effect_code" name="settings[content_source][content_settings][effect_settings][custom_effect_code]"><?php echo isset($item->settings->content_source->content_settings->effect_settings->custom_effect_code) ? wp_kses_post($item->settings->content_source->content_settings->effect_settings->custom_effect_code) : $bt_utility->loadContentEffectCss('out-fade_left','in-fade_left','item'); ?></textarea>
            <input type="hidden" value="woo_commerce" name="settings[content_source][content_type]"/>
        </div>
    </div>
</div>