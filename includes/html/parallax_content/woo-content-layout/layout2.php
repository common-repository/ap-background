<?php
/**
 * Front end: layout display for type woocommerce product
 *
 * @author SFThemes
 * @package AP Background
 * @version 1.0.0
 */
?>

<?php while ($query->have_posts()) : $query->the_post(); ?>
    <?php if ($index % $contentSource->content_settings->rows == 0): ?>
        <div class="parallax-col">
        <?php endif; ?>
        <div class="parallax-row in-pos" <?php echo ($index % $contentSource->content_settings->rows == 0) ? '' : 'style="margin-top:' . esc_attr($contentSource->content_settings->spacing) . 'px;"'; ?>>
            <?php if (in_array(get_the_ID(), wc_get_product_ids_on_sale())): ?>
                <div class="sale">
                    <img src="<?php echo SFAPB_PLUGIN_URL.'assets/images/sale.png'; ?>"  alt="<?php echo __('Sale icon','ap-backgground');?>"/>
                </div>
            <?php endif; ?>
            <?php $images = $bt_utility->getFirstImageFromContent(get_the_content());?>
            <?php if ($contentSource->content_settings->show_image  && (has_post_thumbnail()||!empty($images))): ?>
                <div class="feature-image" style="<?php echo 'height:'.esc_attr($contentSource->content_settings->item_height).'px;';?>">
                    <a href="<?php the_permalink(); ?>">
                        <?php if(has_post_thumbnail()):?>
                        <?php the_post_thumbnail('medium'); ?>
                        <?php else:?>
                        <?php echo wp_kses_post($images);?>
                        <?php endif;?>
                    </a>
                </div>
            <?php endif; ?>
            <div class="post-content-info">
                <?php if ($contentSource->content_settings->show_info): ?>
                    <div class="post-info">
                        <?php
                        $post_categories = wp_get_post_terms(get_the_ID(), 'product_cat');
                        if (!empty($post_categories)) {
                            $pcat = $post_categories[0];
                            echo '<a href="' . get_term_link($pcat) . '"><span>' . esc_attr($pcat->name) . '</span> </a>';
                        }
                        ?>
                    </div>
                <?php endif; ?>
                <?php if ($contentSource->content_settings->show_title): ?>
                    <a href="<?php echo the_permalink(); ?>"><h3 class="title"><?php the_title(); ?></h3></a>
                    <div style="clear: both;"></div>
                <?php endif; ?>
                <?php if ($contentSource->content_settings->show_des): ?>
                    <div class="post-content">
                        <?php
                        echo wp_trim_words(strip_tags(get_the_excerpt()), esc_attr($contentSource->content_settings->number_word));
                        ?>
                    </div>
                <?php endif; ?>
                <div class="cart-price">
                    <div class="price">
                        <span>
                            <?php
                            $c_pos = get_option('woocommerce_currency_pos');
                            $price = get_post_meta(get_the_ID(), '_price', true);
                            $c_symbol = get_woocommerce_currency_symbol();
                            switch ($c_pos) {
                                case 'left':
                                    echo esc_attr($c_symbol) . esc_attr($price);
                                    break;
                                case 'right':
                                    echo esc_attr($price) . esc_attr($c_symbol);
                                    break;
                                case 'left_space':
                                    echo esc_attr($c_symbol) . ' ' . esc_attr($price);
                                    break;
                                default:
                                    echo esc_attr($price) . ' ' . esc_attr($c_symbol);
                                    break;
                            }
                            ?>
                        </span>
                    </div>
                    <?php if ($contentSource->content_settings->add_to_cart || $contentSource->content_settings->add_to_wishlist): ?>
                        <div class="cart">
                            <span class="loading"><img src="<?php echo SFAPB_PLUGIN_URL.'assets/images/loading.gif'; ?>" alt="<?php echo __('Loading...','ap-background');?>"/></span>
                            <span class="card-success"><i class="fa fa-check"></i></span>
                            <?php
                            if ($contentSource->content_settings->add_to_cart):
                                $product_type = wp_get_post_terms(get_the_ID(), 'product_type');
                                if ($product_type[0]->name == 'simple'):
                                    ?>
                                    <span class="addcart" data-pid="<?php echo get_the_ID(); ?>"><i class="fa fa-shopping-cart"></i><?php echo __('Add cart','ap-background'); ?></span>
                                <?php else: ?>
                                    <span class="viewproduct" data-link="<?php echo the_permalink(); ?>"><?php echo ($product_type[0]->name == 'variable') ? '<i class="fa fa-bars"></i>' . __('Select option','ap-background') : '<i class="fa fa-info"></i>' . __('View product','ap-background'); ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ($contentSource->content_settings->add_to_wishlist && defined('YITH_WCWL_TABLE')): ?>
                                <?php if ($bt_utility->is_product_in_wishlist(get_the_ID())): ?>
                                    <span class="view-wishlist" data-link="<?php echo get_permalink(esc_attr(get_option('yith_wcwl_wishlist_page_id'))); ?>"><i class="fa fa-heart"></i><?php echo __('View Wishlist','ap-background'); ?></span>
                                <?php else: ?>
                                    <span class="wishlist" data-pid="<?php echo get_the_ID(); ?>"><i class="fa fa-heart"></i><?php echo __('Add wishlist','ap-background'); ?></span>
                                    <span class="view-wishlist hidden" data-link="<?php echo get_permalink(esc_attr(get_option('yith_wcwl_wishlist_page_id'))); ?>"><i class="fa fa-heart"></i><?php echo __('View Wishlist','ap-background'); ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if (($index + 1) % $contentSource->content_settings->rows == 0 || $index == $query->post_count - 1): ?>
        </div>
    <?php endif; ?>
    <?php $index++; ?>
<?php endwhile; ?>
<div style="clear: both;"></div>
<?php wp_reset_postdata(); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('span.wishlist').click(function () {
<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('yith-woocommerce-wishlist/init.php')) :
    ?>
                var id = jQuery(this).data('pid');
                var itemtarget = jQuery(this);
                jQuery.ajax({
                    url: btAdvParallaxBackgroundCfg.ajaxUrl,
                    data: {action: 'add_to_wishlist', add_to_wishlist: id},
                    type: 'post',
                    beforeSend: function () {
                        itemtarget.parent().find('.card-success').fadeOut(100, function () {
                            itemtarget.parent().find('.loading').fadeIn(0);
                        });
                    },
                    success: function () {
                        itemtarget.parent().find('.loading').fadeOut(100, function () {
                            itemtarget.addClass('hidden');
                            itemtarget.parent().find('.view-wishlist').removeClass('hidden');
                            itemtarget.parent().find('.card-success').fadeIn(0);
                        });
                    }
                });
<?php else: ?>
                alert("<?php echo __('Please install or active yith woocommerce wishlist plugin', 'ap-background'); ?>");
<?php endif; ?>
        });
        jQuery('span.addcart').click(function () {
            var id = jQuery(this).data('pid');
            var itemtarget = jQuery(this);
            jQuery.ajax({
                url: btAdvParallaxBackgroundCfg.ajaxUrl,
                data: {action: 'woocommerce_add_to_cart', quantity: 1, product_id: id},
                type: "post",
                beforeSend: function () {
                    itemtarget.parent().find('.card-success').fadeOut(100, function () {
                        itemtarget.parent().find('.loading').fadeIn(0);
                    });
                },
                success: function () {
                    itemtarget.parent().find('.loading').fadeOut(100, function () {
                        itemtarget.parent().find('.card-success').fadeIn(0);
                    });
                }
            });
        });
        jQuery('span.viewproduct').click(function () {
            var link = jQuery(this).data('link');
            window.location.assign(link);
        });
        jQuery('span.view-wishlist').click(function () {
            var link = jQuery(this).data('link');
            window.location.assign(link);
        });
    });
</script>
