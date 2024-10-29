<?php

/**
 * Cac ham xu ly phia front end.
 *
 * @author SFThemes
 * @package AP Background
 * @version 1.0.0
 */
require_once SFAPB_PLUGIN_DIR . 'includes/utility.php';

/**
 * Function add sctipt to page
 */
function adv_parallax_add_site_script() {
    /* Scripts */
    wp_enqueue_script('jquery');
    wp_enqueue_style('ap-paralax-css', SFAPB_PLUGIN_URL . 'assets/css/adv_parallax_styles.css');
    wp_enqueue_style('custombox', SFAPB_PLUGIN_URL . 'assets/css/custombox.min.css');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
    wp_enqueue_script('ap-jquery-parallax', SFAPB_PLUGIN_URL . 'assets/js/jquery.parallax-1.1.3.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('jquery-easing', SFAPB_PLUGIN_URL . 'assets/js/jquery.easing.1.3.js', array('jquery'), '1.0.0', true);
    wp_register_script('ap-parallax-js', SFAPB_PLUGIN_URL . 'assets/js/jquery.apparallax.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('custombox', SFAPB_PLUGIN_URL . 'assets/js/custombox.min.js', array('jquery'), '1.0.0', true);
    wp_localize_script('ap-parallax-js', 'btAdvParallaxBackgroundCfg', array('siteUrl' => admin_url(), 'baseUrl' => site_url(), 'ajaxUrl' => admin_url('admin-ajax.php')));
    wp_enqueue_script('ap-parallax-js');
}

/**
 * Function load content of parallax block when open parallax button is click
 */
function loadParallaxFrameContent() {
    //Khai bao va gan gia tri cho cac bien can thiet
    $bt_utility = new btParallaxBackgroundUtility();
    $result = array('success' => false, 'message' => '', 'data' => null);
    $alias = sanitize_text_field($_POST['item']);

    //Lay ve thong tin cua parallax theo alias
    $item = $bt_utility->getSliderByAlias($alias);

    //Kiem tra xem co lay duoc thong tin cua parallax slider ko
    if (!$item) {//Neu khong lay duoc thong tin cua parallax thi hien thi text thay the
        $result['message'] = __('No Parallax Background with alias: ', 'ap-background') . '<strong>' . $alias . '</strong>';
    } else {//Neu thong tin cua parallax slider lay duoc thi thuc hien load noi dung cua parallax content
        $item->settings = json_decode($item->settings);
        ob_start();
        //Kiem tra kieu noi dung cua parallax
        $content_types = apply_filters('sfapb_get_content_types', sfapb_get_content_types());
        foreach ($content_types as $slug => $ctype) {
            //Load content follow content type
            if ($item->settings->content_type == $slug):
                include_once $ctype['front_content_file'];
            endif;
        }

        $html = ob_get_contents();
        ob_end_clean();
        $result['success'] = true;
        $result['message'] = __('Content has been loaded', 'ap-background');
        $result['data'] = $html;
    }
    $bt_utility->obEndClear();
    echo json_encode($result);
    exit();
}
