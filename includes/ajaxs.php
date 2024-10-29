<?php

//add ajax action
add_action('wp_ajax_nopriv_getFlickrAlbums', 'getFlickrAlbums');
add_action('wp_ajax_getFlickrAlbums', 'getFlickrAlbums');

//add ajax action get video ids from url
add_action('wp_ajax_nopriv_getVideoFromUrl', 'getVideoFromUrl');
add_action('wp_ajax_getVideoFromUrl', 'getVideoFromUrl');

//add ajax action get video from url
add_action('wp_ajax_nopriv_getVideo', 'getVideo');
add_action('wp_ajax_getVideo', 'getVideo');

//add ajax action get Images from username
add_action('wp_ajax_nopriv_getImages', 'getImages');
add_action('wp_ajax_getImages', 'getImages');

//add ajax action get Image by id
add_action('wp_ajax_nopriv_getImage', 'getImage');
add_action('wp_ajax_getImage', 'getImage');

//add ajax action get Image Albums by id
add_action('wp_ajax_nopriv_getImageAlbums', 'getImageAlbums');
add_action('wp_ajax_getImageAlbums', 'getImageAlbums');

//add ajax action listDeleteSingleItem
add_action('wp_ajax_nopriv_listDeleteSingleItem', 'listDeleteSingleItem');
add_action('wp_ajax_listDeleteSingleItem', 'listDeleteSingleItem');

//add ajax action listDeleteSelectedItem
add_action('wp_ajax_nopriv_listDeleteSelectedItem', 'listDeleteSelectedItem');
add_action('wp_ajax_listDeleteSelectedItem', 'listDeleteSelectedItem');

//add ajax action listCopyItem
add_action('wp_ajax_nopriv_listCopyItem', 'listCopyItem');
add_action('wp_ajax_listCopyItem', 'listCopyItem');

//add ajax action getVideobackground
add_action('wp_ajax_nopriv_getVideobackground', 'getVideobackground');
add_action('wp_ajax_getVideobackground', 'getVideobackground');

//add ajax action getVideobackground
//add_action('wp_ajax_nopriv_editVideoAjax', 'editVideoAjax');
//add_action('wp_ajax_editVideoAjax', 'editVideoAjax');

//add ajax action loadContentEffectCssAjax
add_action('wp_ajax_nopriv_loadContentEffectCssAjax', 'loadContentEffectCssAjax');
add_action('wp_ajax_loadContentEffectCssAjax', 'loadContentEffectCssAjax');

//add ajax action parallaxItemPreview
add_action('wp_ajax_nopriv_parallaxItemPreview', 'parallaxItemPreview');
add_action('wp_ajax_parallaxItemPreview', 'parallaxItemPreview');

//add ajax action loadContentEffectCssAjax
add_action('wp_ajax_nopriv_loadParallaxFrameContent', 'loadParallaxFrameContent');
add_action('wp_ajax_loadParallaxFrameContent', 'loadParallaxFrameContent');