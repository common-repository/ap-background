<?php
/**
 * Front end: layout display for type wordpress post
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
            <?php $images = $bt_utility->getFirstImageFromContent(get_the_content()); ?>
            <?php if ($contentSource->content_settings->show_image && (has_post_thumbnail() || !empty($images))): ?>
                <?php
                $thumbnail_image = get_the_post_thumbnail_url(get_the_ID());
                if (!$thumbnail_image) {
                    preg_match_all('/(http|https):\/\/[^ ]+(\.gif|\.jpg|\.jpeg|\.png)/', $images, $imgs);
                    if (!empty($imgs)) {
                        $thumbnail_image = $imgs[0];
                    }
                }
                ?>
                <div class="feature-image" style="width:35%; ?>px; height:<?php echo esc_attr($contentSource->content_settings->item_height); ?>px;">
                    <a style="background-image: url(<?php echo esc_attr($thumbnail_image); ?>);" href="<?php the_permalink(); ?>"> </a>
                </div>
            <?php endif; ?>
            <div class="post-content-info" style="width:65%;">
                <?php if ($contentSource->content_settings->show_title): ?>
                    <a href="<?php the_permalink(); ?>">
                        <h3 class="title"><?php the_title(); ?></h3>
                    </a>
                    <div style="clear: both;"></div>
                <?php endif; ?>
                <?php if ($contentSource->content_settings->show_info): ?>
                    <div class="post-info">
                        <?php
                        echo '<span class="icon"><i class="fa fa-calendar"></i> ' . get_the_date('d, F') . '</span>';
                        echo '<span class="icon suffix"><i class="fa ' . ((get_comments_number(get_the_id()) < 2) ? 'fa-comment' : 'fa-comments') . '"></i> ' . get_comments_number(get_the_id()) . ((get_comments_number(get_the_id()) < 2) ? __(' comment', 'ap-background') : __(' comments', 'ap-background')) . '</span>';
                        ?>
                    </div>
                <?php endif; ?>
                <?php if ($contentSource->content_settings->show_des): ?>
                    <div class="post-content">
                        <?php
                        echo wp_trim_words(strip_tags(get_the_excerpt()), $contentSource->content_settings->number_word);
                        ?>
                    </div>
                <?php endif; ?>
                <?php if ($contentSource->content_settings->show_readmore): ?>
                    <div class="link readmore">
                        <a href="<?php the_permalink(); ?>"><?php echo __('Read more', 'ap-background'); ?><i class="fa fa-chevron-circle-right"></i> </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if (($index + 1) % $contentSource->content_settings->rows == 0 || $index == $query->post_count - 1): ?>
        </div>
    <?php endif; ?>
    <?php $index++; ?>
<?php endwhile; ?>
<div style="clear: both;"></div>
<?php
wp_reset_postdata();
