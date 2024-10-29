/**
 * Script process actions for admin page
 *
 * @author SFThemes
 * @package AP Background
 * @version 1.0.0
 */

(function ($) {
    $(document).ready(function () {
        var frame, target;

        //Xu ly khi nut bam create parallax dc click
        $('.control-buttons .create-button span').click(function () {
            $('.bt-parallax-select-slide-type.hidden').appendTo('body').fadeIn(500, function () {
                $(this).removeClass('hidden');
            });
        });

        //
        $('.video-background .select-image .control-button .control-buttom').click(function () {
            $('.bt-parallax-select-bg-type.hidden').appendTo('body').fadeIn(500, function () {
                $(this).removeClass('hidden');
            });
        });

        //code xu ly khi click vao element de thuc hien get content (image, video) twf cacs nguon tuong ung
        $('.image .from-flickr, .image .from-facebook, .image .from-google, #video-background .from-youtube, #video-background .from-vimeo, #video-background .from-embed-code').click(function () {
            $('.bt-parallax-get-media-item.hidden').appendTo('body').fadeIn(500, function () {
                $(this).removeClass('hidden');
            });
            var list = $('.bt-parallax-get-media-item .get-from-wrap');
            var itemclick = this;
            list.each(function () {
                if ($(itemclick).hasClass('from-flickr') && $(this).hasClass('flickr')) {
                    $(this).show(0).addClass('active');
                } else if ($(itemclick).hasClass('from-youtube') && $(this).hasClass('youtube')) {
                    $(this).show(0).addClass('active');
                } else if ($(itemclick).hasClass('from-facebook') && $(this).hasClass('facebook')) {
                    $(this).show(0).addClass('active');
                } else if ($(itemclick).hasClass('from-google') && $(this).hasClass('picasa')) {
                    $(this).show(0).addClass('active');
                } else if ($(itemclick).hasClass('from-vimeo') && $(this).hasClass('vimeo')) {
                    $(this).show(0).addClass('active');
                } else if ($(itemclick).hasClass('from-embed-code') && $(this).hasClass('embedcode')) {
                    $(this).show(0).addClass('active');
                } else {
                    return;
                }
            });
        });

        //Select content slideshow type
        $('.bg-content-type-list .content-type-item').click(function () {
            if ($(this).hasClass('selected')) {
                return;
            }
            var list = $('.bg-content-type-list .content-type-item');
            $(this).addClass('selected');
            var url = btAdvParallaxBackgroundCfg.siteUrl + 'admin.php?page=bt-advance-parallax-background/create-new';
            if ($(this).hasClass('video-background')) {
                url = url += '&content_type=video-background';
            } else if ($(this).hasClass('image-gallery')) {
                url = url += '&content_type=image-gallery';
            } else if ($(this).hasClass('woo-commerce')) {
                url = url += '&content_type=woo-commerce';
            } else if ($(this).hasClass('wordpress-posts')) {
                url = url += '&content_type=wordpress-posts';
            } else {
                url = url += '&content_type=video-background';
            }

            $('.create-slideshow a').attr('href', url);
            var itemclick = this;
            list.each(function () {
                if (list.index(this) !== list.index(itemclick) && $(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
            });
        });

        //An khoi chon kieu content type khi tao moi parallax
        $('.bt-parallax-select-slide-type').click(function (event) {
            if ($(event.target).hasClass('bt-parallax-select-slide-type')) {
                $(this).fadeOut(500, function () {
                    $(this).addClass('hidden');
                });
            }
        });

        //Dong chon color, textured, opacity kho click chuot ra ngoai phap vi control
        $('body').click(function (event) {
            if ($(event.target).closest('.control-button, .input-slider, .input-color-bgcontent').length === 0) {
                var opacity = $('.opacity .control-button');
                var color = $('.colorbox .control-buttom');
                var textured = $('.colorbox .control-top');
                var content_bg_color = $('.input-color-bgcontent-box');
                if (opacity.hasClass('active')) {
                    opacity.removeClass('active');
                    opacity.parent().parent().find('.input-slider').slideUp();
                }
                if (color.hasClass('active')) {
                    color.removeClass('active');
                    var par = color.parents('.control');
                    $(par).find('.input-color-box').slideUp();
                    $('.input-color-bgcontent-box .wp-picker-holder').slideUp();
                }
                if (textured.hasClass('active')) {
                    textured.removeClass('active');
                    var par = textured.parents('.control');
                    $(par).find('.list-textured').slideUp();
                }
                if(content_bg_color.length > 0){
                    content_bg_color.find('.wp-picker-holder').slideUp();
                }
            }
        });

        //Dong popop chon background type khi click chuot ra ngoai pham vi popup
        $('.bt-parallax-select-bg-type').click(function (event) {
            if ($(event.target).hasClass('bt-parallax-select-bg-type')) {
                $(this).fadeOut(500, function () {
                    $(this).addClass('hidden');
                });
            }
        });
        $('.bt-parallax-get-media-item').click(function (event) {
            if ($(event.target).hasClass('bt-parallax-get-media-item')) {
                $(this).fadeOut(500, function () {
                    $(this).addClass('hidden');
                    $('.bt-parallax-get-media-item .get-from-wrap').hide().removeClass('active');
                });
            }
        });
        $('.bt-parallax-edit-media-gallery-item').click(function (event) {
            if ($(event.target).hasClass('bt-parallax-edit-media-gallery-item')) {
                $(this).fadeOut(500, function () {
                    $(this).addClass('hidden');
                    $('.bt-parallax-edit-media-gallery-item .get-from-wrap').hide().removeClass('active');
                });
            }
        });

//    Tabs control
        $('.tabs .tab-links a').on('click', function (e) {
            var currentAttrValue = $(this).attr('href');

            // Show/Hide Tabs
            $('.tabs ' + currentAttrValue).show().siblings().hide();

            // Change/remove current tab to active
            $(this).parent('li').addClass('active').siblings().removeClass('active');

            e.preventDefault();
        });

        //Select layout
        $('.layout-list .item-layout').click(function () {
            if ($(this).hasClass('selected')) {
                return;
            }
            var list = $('.layout-list .item-layout');
            $(this).addClass('selected');
            $(this).parent().find('input').val($(this).data('layout'));
            var itemclick = this;
            list.each(function () {
                if (list.index(this) !== list.index(itemclick) && $(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
            });
        });


//Su kien khi click vao nut selec item tron sanh sach media item (image, video) khi them moi hoac edit paralalx slider
        $('.list-items').on('click', '.inner-control span.select', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected').parent().parent().removeAttr('style').find('span.delete').show();
                $(this).removeClass('selected').parent().parent().removeAttr('style').find('span.edit').show();
            } else {
                $(this).addClass('selected').parent().parent().css({'background': 'transparent', 'opacity': '1'}).find('span.delete').hide();
                $(this).addClass('selected').parent().parent().css({'background': 'transparent', 'opacity': '1'}).find('span.edit').hide();
            }
        });

        //Su khi click vao nut delete item trong danh sach media item (image,video) khi them moi hoac edit parallax slider
        $('.list-items').on('click', '.inner-control span.delete', function () {
            $(this).parents('.media-item').fadeOut(200, function () {
                $(this).remove();
            });
        });

        //Su khi click vao nut edit item trong danh sach media item (image,video) khi them moi hoac edit parallax slider
        $('.list-items').on('click', '.inner-control span.edit', function () {
            $('.bt-parallax-edit-media-gallery-item').appendTo('body').fadeIn(500, function () {
                $(this).removeClass('hidden');
            });

            //Lay ve danh sach cac khoi noi dung tuong ung voi tung loai item
            var list = $('.bt-parallax-edit-media-gallery-item .get-from-wrap');
            target = $(this);

            //lay ve gia tri cua item duoc click
            var itemdata = $.parseJSON(target.parents('.media-item').find('input').val());

            //Duyet qua tung phan tu cua mamh va kem tra xem item duoc clock la item nao, tu do hien thi va fill gia tri tuong ung vao
            list.each(function () {
                if (itemdata.media_source === 'youtube' && $(this).hasClass('youtube')) {
                    $('#youtube_url_edit').val('https://www.youtube.com/watch?v=' + itemdata.video_url);
                    $(this).show(0).addClass('active');
                } else if ((itemdata.media_source === 'external_source' || itemdata.media_source === 'from_media') && $(this).hasClass('upload')) {
                    $('#video_upload_edit').val(itemdata.video_url);
                    $(this).show(0).addClass('active');
                } else if (itemdata.media_source === 'vimeo' && $(this).hasClass('vimeo')) {
                    $('#vimeo_url_edit').val('https://vimeo.com/' + itemdata.video_url);
                    $(this).show(0).addClass('active');
                } else if (itemdata.media_source === 'embedcode' && $(this).hasClass('embedcode')) {
                    $('#video_embedcode_edit').val(unescape(itemdata.video_url));
                    $(this).show(0).addClass('active');
                } else if ((itemdata.media_source === 'image_upload' || itemdata.media_source === 'flickr' ||
                        itemdata.media_source === 'facebook' || itemdata.media_source === 'picasa') && $(this).hasClass('image-edit')) {
                    $('#image_new_url').val(itemdata.large);
                    $(this).show(0).addClass('active');
                } else {
                    return;
                }
            });
        });

        //Su kien xu ly khi nut bam save edit item duoc click
        $('.create-slideshow .edit-update-item').click(function () {
            $('.bt-parallax-edit-media-gallery-item').fadeOut(500, function () {
                $(this).addClass('hidden');
                $('.bt-parallax-edit-media-gallery-item .get-from-wrap').hide().removeClass('active');
            });
            var e = $(this).parents('.bg-type-list-wrap').find('.active');
            if (e.hasClass('image-edit')) {
                var newImage = e.find('input').val();
                var img = new Image();
                $(img).load(function () {
                    var img_height = $(img)[0].height;
                    var img_width = $(img)[0].width;
                    if (img_height > img_width) {
                        var attr = {'src': newImage, height: 130};
                    } else {
                        var attr = {'src': newImage, width: 130};
                    }
                    var data = '{"large":"' + newImage + '","thumbnail":"' + newImage + '","media_source":"image_upload"}';
                    target.parents('.media-item').find('img').removeAttr('width height').attr(attr);
                    target.parents('.media-item').find('input').val(data);
                }).error(function () {
                    alert('Can\'t load image!');
                }).attr('src', newImage);
            }
            //Edit video upload
            if (e.hasClass('upload')) {
                var newVideo = e.find('input').val();
                var data = '{"large":"","thumbnail":"", "video_url":"' + newVideo + '", "media_source":"external_source"}';
                target.parents('.media-item').find('input').val(data);
            }
            //Edit video embed
            if (e.hasClass('embedcode')) {
                var newVideoCode = e.find('textarea').val();
                var data = '{"large":"","thumbnail":"", "video_url":"' + escape(newVideoCode) + '", "media_source":"embedcode"}';
                target.parents('.media-item').find('input').val(data);
            }
            //Edit video youtube
            if (e.hasClass('youtube') || e.hasClass('vimeo')) {
                var newVideoUrl = e.find('input').val();
                $.ajax({
                    url: btAdvParallaxBackgroundCfg.ajaxUrl,
                    data: {action: 'getVideobackground', url: newVideoUrl},
                    type: "post",
                    beforeSend: function () {
                    },
                    success: function (data) {
                        var a = $.parseJSON(data);
                        if (a.success) {
                            var b = $.parseJSON(a.data);
                            var img = new Image();
                            $(img).load(function () {
                                var img_height = $(img)[0].height;
                                var img_width = $(img)[0].width;
                                if (img_height > img_width) {
                                    var attr = {'src': b.large, height: 130};
                                } else {
                                    var attr = {'src': b.large, width: 130};
                                }
                                target.parents('.media-item').find('img').removeAttr('width height').attr(attr);
                                target.parents('.media-item').find('input').val(a.data);
                            }).error(function () {
                                alert('Can\'t load image!');
                            }).attr('src', b.large);
                        } else {
                            alert(a.message);
                        }
                    }
                });
            }
        });

        //Su kien khi opacity thay doi
        $('.change-opacity').on('input', function () {
            var ranVal = $(this).val();
            $(this).parent().parent().find('.inner-image .pattern').css('opacity', ranVal);
            $(this).parent().find('.change-opacity-text').val(parseInt(ranVal * 100));
        });

        //Su kien dong mo control opacity change
        $('.opacity .control-button').click(function () {
            $(this).toggleClass('active');
            $(this).parent().parent().find('.input-slider').slideToggle();
        });

        //Su kien dong mo color control
        $('.colorbox .control-buttom').click(function () {
            $(this).toggleClass('active');
            var par = $(this).parent().parent().parent();
            $(par).find('.input-color-box').slideToggle();
            if ($(this).parent().find('.control-top').hasClass('active')) {
                $(this).parent().find('.control-top').removeClass('active');
                $(par).find('.list-textured').slideUp();
            }
        });

        //Su kien dong mo textured control
        $('.colorbox .control-top').click(function () {
            $(this).toggleClass('active');
            var par = $(this).parent().parent().parent();
            $(par).find('.list-textured').slideToggle();
            if ($(this).parent().find('.control-buttom').hasClass('active')) {
                $(this).parent().find('.control-buttom').removeClass('active');
                $(par).find('.input-color-box').slideUp();
            }
        });

        //Su kien khi texttured duoc chon
        $('.list-textured .textured-item').click(function () {
            $(this).parent().find('input').val($('div', this).attr('class'));
            $(this).parent().parent().find('.inner-image').css('backgroundImage', $('div', this).css('backgroundImage'));
            $(this).parents('.control-group').find('.opacity .inner-image .pattern').css('backgroundImage', $('div', this).css('backgroundImage'));
            $(this).parents('.control').find('.control-top').removeClass('active');
            $(this).parent().slideUp();
        });

        //Su kien open popup de chon video tu wp madia de lam background
        $('.video-background .select-image .control-button .control-top').on('click', function (e) {
            e.preventDefault();
            var element = this;

            // Set options
            var options = {
                state: 'insert',
                frame: 'post',
                multiple: false,
                library: {
                    type: 'video'
                }
            };
            frame = wp.media(options).open();
            // Tweak views
            frame.menu.get('view').unset('gallery');
            frame.menu.get('view').unset('featured-image');

            frame.toolbar.get('view').set({
                insert: {
                    style: 'primary',
                    text: 'Insert',
                    click: function () {
                        var models = frame.state().get('selection'),
                                url = models.first().attributes.url;
                        var data = '{"large":"", "video_url":"' + url + '", "media_source":"direct"}';
                        $(element).parents('.background-act').find('.background_video').val(data);
                        $(element).parents('.background-act').find('.inner-image').html('<div class="video-file"><span><i  class="fa fa-file-video-o fa-3x"></i></span></div>');
                        $(element).parents('.video-background').find('.opacity .inner-image .image').html('<div class="video-file"><span><i  class="fa fa-file-video-o fa-3x"></i></span></div>');
                        frame.close();
                    }
                } // end insert
            });
        });

        //Su kien open popup de chon anh tu wp madia de lam background
        $('.img-background .select-image .control-button, .content-type-item.upload').on('click', function (e) {
            e.preventDefault();
            var element = this;

            // Set options
            var options = {
                state: 'insert',
                frame: 'post',
                multiple: false,
                library: {
                    type: 'image'
                }
            };
            frame = wp.media(options).open();
            // Tweak views
            frame.menu.get('view').unset('gallery');
            frame.menu.get('view').unset('featured-image');

            frame.toolbar.get('view').set({
                insert: {
                    style: 'primary',
                    text: 'Insert',
                    click: function () {
                        var models = frame.state().get('selection'),
                                url = models.first().attributes.url;

                        $(element).parent().find('.background_image').val(url);
                        $(element).parent().find('.inner-image').html('<img src="' + url + '" alt=""/>');
                        $(element).parents('.img-background').find('.opacity .inner-image .image').html('<img src="' + url + '" alt=""/>');
                        fixImagebackgroundView();
                        frame.close();
                    }
                } // end insert
            });
        });

        var colorPickerOptions = {
            // you can declare a default color here,
            // or in the data-default-color attribute on the input
            defaultColor: false,
            // a callback to fire whenever the color changes to a valid color
            change: function (event, ui) {
//            $(this).parents('.control').find('.inner-image').html('');
                $(this).parents('.control').find('.inner-image').css('backgroundColor', ui.color.toString());
                $(this).parents('.control-group').find('.opacity .inner-image .pattern').css('backgroundColor', ui.color.toString());
            },
            // a callback to fire when the input is emptied or an invalid color
            clear: function () {
                $(this).parent().parent().parent().parent().find('.inner-image').css('backgroundColor', 'transparent');
                $(this).parent().find('.input-color').val('');
                $(this).parents('.control-group').find('.opacity .inner-image .pattern').css('backgroundColor', 'transparent');
            },
            // hide the color picker controls on load
            hide: true,
            // show a group of common colors beneath the square
            // or, supply an array of colors to customize further
            palettes: true
        };

        //Tao color picker cho phep chon mau cho background
        $('.input-color').wpColorPicker(colorPickerOptions);
        //Open color picker box
        $('.input-color-bgcontent').click(function () {
            $('.input-color-bgcontent-box .wp-picker-holder').slideDown();
        });

        var colorPickerContentOptions = {
            // you can declare a default color here,
            // or in the data-default-color attribute on the input
            defaultColor: false,
            // a callback to fire whenever the color changes to a valid color
            change: function (event, ui) {
                $(this).css({'backgroundColor': ui.color.toString(), 'color': '#fff'});
            },
            // a callback to fire when the input is emptied or an invalid color
            clear: function () {
                $(this).parent().find('.input-color-bgcontent').css({'backgroundColor': 'transparent', 'color': '#7e7e7e'});
            },
            // hide the color picker controls on load
            hide: true,
            // show a group of common colors beneath the square
            // or, supply an array of colors to customize further
            palettes: true
        };
        //Tao colopickr cho phep chon mau cho background content
        $('.input-color-bgcontent').wpColorPicker(colorPickerContentOptions);

        //Su kien khi thay doi kieu gackground
        $('.bt-type').change(function () {
            var s = $(this).val();
            if (s === 'img') {
                $('.video-background').slideUp(500, function () {
                    $('.img-background').slideDown(500);
                });
            }
            if (s === 'video') {
                $('.img-background').slideUp(500, function () {
                    $('.video-background').slideDown(500);
                });
            }
        }).trigger('change');

        //Su kin khi thay doi kieu parallax
        $('#parallax_bg_type').change(function () {
            var value = $(this).val();
            if (value === 'static') {
                $('.tabs .dynamic-tab').addClass('hidden');
            }
            if (value === 'dynamic') {
                $('.tabs .dynamic-tab').removeClass('hidden');
            }
        }).trigger('change');

        //Su kien khi thay doi kieu kich thuoc width cua parallax: auto | fixed width | full width
        $('#slider_size_width-type').change(function () {
            var value = $(this).val();
            if (value === 'fixed') {
                $('.slider-size-width-size').show();
            } else {
                $('.slider-size-width-size').hide();
            }
        }).trigger('change');

        //parrallax effect content change
        $('#content_settings_effect_in, #content_settings_effect_out, #item_source_effect_settings_effect_in, #item_source_effect_settings_effect_out').change(function () {
            var itemtarget = $(this);
            var effect_in, effect_out, type;
            //CHuan bi du lieu khi effect ap dung cho noi dung
            if (itemtarget.attr('id') === 'content_settings_effect_in' || itemtarget.attr('id') === 'content_settings_effect_out') {
                effect_in = $('#content_settings_effect_in').val();
                effect_out = $('#content_settings_effect_out').val();
                type = 'content';
            }
            //CHuan bi du lieu khi effect ap dung cho content
            if (itemtarget.attr('id') === 'item_source_effect_settings_effect_in' || itemtarget.attr('id') === 'item_source_effect_settings_effect_out') {
                effect_in = $('#item_source_effect_settings_effect_in').val();
                effect_out = $('#item_source_effect_settings_effect_out').val();
                type = 'item';
            }
            //Xu ly ajax load css effect tuong ung voi tung kieu
            $.ajax({
                url: btAdvParallaxBackgroundCfg.ajaxUrl,
                data: {action: 'loadContentEffectCssAjax', effect_in: effect_in, effect_out: effect_out, type: type},
                type: "post",
                beforeSend: function () {
                },
                success: function (data) {
                    var a = $.parseJSON(data);
                    if (a.success) {
                        if (type === 'content') {
                            $('#content_settings_custom_effect_code').val('').fadeOut(100, function () {
                                $(this).val(a.data).fadeIn(100);
                            });
                        }
                        if (type === 'item') {
                            $('#content_settings_effect_settings_custom_effect_code').val('').fadeOut(100, function () {
                                $(this).val(a.data).fadeIn(100);
                            });
                        }
                    } else {
                    }
                }
            });
        });

        //Su kien khi thay doi noi dung text cua input opacity
        $('.change-opacity-text').on('input', function () {
            var val = parseInt($(this).val());
            if (val) {
                if (val > 100) {
                    val = 100;
                }
                if (val < 0) {
                    val = 0;
                }
                $(this).val(val);
                $(this).parent().find('.change-opacity').val(val / 100);
                $(this).parent().parent().find('.inner-image .pattern').css('opacity', val / 100);
            } else {
                $(this).parent().find('.change-opacity').val(0);
                $(this).parent().parent().find('.inner-image .pattern').css('opacity', 0);
                $(this).val(0);
            }
        }).trigger('input');

//set background for patten
//Chuan bi du lieu cho danh sach patten (textured)
        for (var i = 0; i <= 13; i++) {
            if (i === 0) {
                $('.list-textured .pattern-' + i).css('backgroundImage', 'none');
            } else {
                $('.list-textured .pattern-' + i).css('backgroundImage', 'url(' + btAdvParallaxBackgroundCfg.ap_url + 'assets/images/pattern-' + i + '.png)');
            }
        }

        //get video background cho parallax
        $('.create-slideshow .get-video-bg').click(function () {
            var target = $(this);
            var videoUrl = target.parents('.bg-type-list-wrap').find('input[name="video_url"]').val();
            $.ajax({
                url: btAdvParallaxBackgroundCfg.ajaxUrl,
                data: {action: 'getVideobackground', url: videoUrl},
                type: "post",
                beforeSend: function () {
                    $('.bt-ajax-loading.load-bgimage-ajax').show();
                    target.parents('.bt-parallax-select-bg-type').fadeOut(500, function () {
                        $(this).addClass('hidden');
                    });
                },
                success: function (data) {
                    var a = $.parseJSON(data);
                    if (a.success) {
                        $('.video-background .select-image .background_video').val(a.data);
                        var b = $.parseJSON(a.data);
                        if (b.large !== '') {
                            $('.video-background .select-image .inner-image').html('<img src="' + b.large + '" alt=""/>');
                            $('.video-background .opacity .inner-image .image').html('<img src="' + b.large + '" alt=""/>');
                        } else {
                            $('.video-background .select-image .inner-image').html('<div class="video-file"><span><i  class="fa fa-file-video-o fa-3x"></i></span></div>');
                            $('.video-background .opacity .inner-image .image').html('<div class="video-file"><span><i  class="fa fa-file-video-o fa-3x"></i></span></div>');
                        }
                    } else {
                        alert(a.message);
                    }
                    $('.bt-ajax-loading.load-bgimage-ajax').hide();
                }
            });
        });

//Select all/ unselect all item in list parallax slider
        $('#cb-select-all-1').click(function () {
            if ($(this).is(':checked')) {
                $('input[name="fields[]"]').prop("checked", true);
            } else {
                $('input[name="fields[]"]').prop("checked", false);
            }
        });

        //Get image from wp library
        $('.image .from-media').click(function () {
            // Set options
            var options = {
                state: 'insert',
                frame: 'post',
                multiple: true,
                library: {
                    type: 'image'
                }
            };

            frame = wp.media(options).open();

            // Tweak views
            frame.menu.get('view').unset('gallery');
            frame.menu.get('view').unset('featured-image');

            frame.on('insert', function (selection) {
                var state = frame.state();
                selection = selection || state.get('selection');
                if (!selection)
                    return;
                selection.each(function (e) {
                    var url = e.attributes.url,
                            item_control = getImageItemHtml(url, 'image_upload');
                    $('.image .list-items').append(item_control);
                });
            });
            frame.state('embed').on('select', function () {
                var state = frame.state(),
//                        type = state.get('type'),
                        embed = state.props.toJSON();

                embed.url = embed.url || '';
                if (embed.url) {
                    var item_control = getImageItemHtml(embed.url, 'external_source');
                    $('.image .list-items').append(item_control);
                }
            });
            frame.setState(frame.options.state);
        });

        function getImageItemHtml(url, source) {
            var data = '{"large":"' + url + '","thumbnail":"' + url + '","media_source":"' + source + '"}';
            var item_control = '<div class="media-item">';
            item_control += '<div class="item-control">';
            item_control += '<div class="inner-control">';
            item_control += '<span class="delete"><i  class="fa fa-times"></i></span>';
            item_control += '<span class="edit"><i  class="fa fa-pencil"></i></span>';
            item_control += '<span class="select"><i  class="fa fa-check"></i></span>';
            item_control += '</div>';
            item_control += '</div>';
            item_control += '<img src="' + url + '" width="130" alt=""/>';
            item_control += '<input type="hidden" value=\'' + data + '\' name="settings[media_source][items][]"/>';
            item_control += '</div>';
            return item_control;
        }

        //Get video tu wp library
        $('#video-background .from-media').click(function () {
            // Set options
            var options = {
                state: 'insert',
                frame: 'post',
                multiple: true,
                library: {
                    type: 'video'
                }
            };

            frame = wp.media(options).open();

            // Tweak views
            frame.menu.get('view').unset('gallery');
            frame.menu.get('view').unset('featured-image');

            frame.on('insert', function (selection) {
                var state = frame.state();
                selection = selection || state.get('selection');
                if (!selection)
                    return;
                selection.each(function (e) {
                    var url = e.attributes.url,
                            item_control = getVideoItemHtml(url, 'from_media');
                    $('#video-background .list-items').append(item_control);
                });
            });
            frame.state('embed').on('select', function () {
                var state = frame.state(),
//                        type = state.get('type'),
                        embed = state.props.toJSON();

                embed.url = embed.url || '';
                if (embed.url) {
                    var item_control = getVideoItemHtml(embed.url, 'external_source');
                    $('#video-background .list-items').append(item_control);
                }
            });
            frame.setState(frame.options.state);
        });

        function getVideoItemHtml(url, source) {
            var data = '{"large":"","thumbnail":"", "video_url":"' + url + '", "media_source":"' + source + '"}';
            var item_control = '<div class="media-item">';
            item_control += '<div class="item-control">';
            item_control += '<div class="inner-control">';
            item_control += '<span class="delete"><i  class="fa fa-times"></i></span>';
            item_control += '<span class="edit"><i  class="fa fa-pencil"></i></span>';
            item_control += '<span class="select"><i  class="fa fa-check"></i></span>';
            item_control += '</div>';
            item_control += '</div>';
            item_control += '<div class="thumb-img"><span><i class="fa fa-file-video-o fa-3x"></i></span></div>';
            item_control += '<input type="hidden" value=\'' + data + '\' name="settings[media_source][items][]"/>';
            item_control += '</div>';
            return item_control;
        }

        //Delete select item in list
        $('.control-buttons span.delete-selected').click(function () {
            $('.list-items .select.selected').parents('.media-item').fadeOut(200, function () {
                $(this).remove();
            });
        });
        //Delete all item in list
        $('.control-buttons span.delete-all').click(function () {
            $('.list-items .media-item').fadeOut(200, function () {
                $(this).remove();
            });
        });

        //Code xu ly khi flickr api field dc nhap
        $('#media_source_flickr_api').on('input', function () {
            $('#ap_background_flickr_api').val($(this).val());
        });
        $('#media_source_facebook_token').on('input', function () {
            $('#ap_background_facebook_token').val($(this).val());
        });
        $('#media_source_google_api').on('input', function () {
            $('#ap_background_google_api').val($(this).val());
        });


        //Lay ve media item
        $('.bg-type-list-wrap .get-video').click(function () {
            //Get thong tin cua element dang duoc active de kiem tra xem dang dc lay item tu nguon du lieu nao
            var e = $(this).parents('.bg-type-list-wrap').find('.active');
            //Lay du lieu tu flickr
            if ($(e).hasClass('flickr')) {
                var api = $('#media_source_flickr_api').val();
                var username = $(e).find('input[name="flickr_uname"]').val();
                var albumid = $(e).find('select[name="flickr_album"]').val();
                if (username === '') {
                    alert('Please input Flickr username');
                } else if (api === '') {
                    alert('Please input Flickr API');
                } else if (albumid === '') {
                    alert('Please select Flickr Album');
                } else {
                    getImages('flickr', username, albumid, api);
                }
            }
            //Facebook
            if ($(e).hasClass('facebook')) {
                var username = $(e).find('input[name="facebook_uname"]').val();
                var albumid = $(e).find('select[name="facebook_album"]').val();
                var token = $('#media_source_facebook_token').val();
                if (username === '') {
                    alert('Please input facebook page');
                } else if (albumid === '') {
                    alert('Please select album to get image');
                } else if (token === '') {
                    alert('Please input facebook access token');
                } else {
                    getImages('facebook', username, albumid, token);
                }
            }
            //Picasa
            if ($(e).hasClass('picasa')) {
                var albumid = $(e).find('select[name="picasa_album"]').val();
                var username = $(e).find('input[name="picasa_uname"]').val();
                if (username === '') {
                    alert('Please input google username');
                } else if (albumid === '') {
                    alert('Please select album to get image');
                } else {
                    getImages('picasa', username, albumid, '');
                }
            }
            //Youtube
            if ($(e).hasClass('youtube')) {
                var api = $('#media_source_google_api').val();
                var url = $(e).find('input[name="youtube_url"]').val();
                if (url === '') {
                    alert('Please input youtube url');
                } else {
                    getVideoFromUrl('youtube', url, api);
                }
            }
            //Vimeo
            if ($(e).hasClass('vimeo')) {
                var url = $(e).find('input[name="vimeo_url"]').val();
                if (url === '') {
                    alert('Please input vimeo url');
                } else {
                    getVideoFromUrl('vimeo', url, '');
                }
            }
            //Embed code
            if ($(e).hasClass('embedcode')) {
                var embcode = $(e).find('textarea[name="video_embedcode"]').val();
                if (embcode === '') {
                    alert('Please input embed code');
                } else {
                    var data = '{"large":"","thumbnail":"", "video_url":"' + escape(embcode) + '", "media_source":"embedcode"}';
                    var item_control = '<div class="media-item">';
                    item_control += '<div class="item-control">';
                    item_control += '<div class="inner-control">';
                    item_control += '<span class="delete"><i  class="fa fa-times"></i></span>';
                    item_control += '<span class="edit"><i  class="fa fa-pencil"></i></span>';
                    item_control += '<span class="select"><i  class="fa fa-check"></i></span>';
                    item_control += '</div>';
                    item_control += '</div>';
                    item_control += '<div class="thumb-img"><span><i class="fa fa-file-video-o fa-3x"></i></span></div>';
                    item_control += '<input type="hidden" value=\'' + data + '\' name="settings[media_source][items][]"/>';
                    item_control += '</div>';
                    $('#video-background .list-items').append(item_control);
                    $('.bt-parallax-get-media-item').fadeOut(500, function () {
                        $(this).addClass('hidden');
                        $(this).find('.get-from-wrap').hide().removeClass('active');
                    });
                }
            }
        });

        //Lay ve danh sach album anh tu flickr
        $("#flickr_uname").change(function () {
            var uname = $(this).val();
            var flickr_api = $('#media_source_flickr_api').val();
            if (flickr_api === '') {
                //alert('Please input flickr api');
            } else {
                getImageAlbums('flickr', uname, flickr_api);
            }
        }).trigger('change');

        //Lay ve danh sach album anh tu picasa
        $("#picasa_uname").change(function () {
            var uname = $(this).val();
            getImageAlbums('picasa', uname, '');
        }).trigger('change');

        //Lay ve danh sach album anh tu facebook
        $("#facebook_uname").change(function () {
            var fname = $(this).val(),
                    token = $('#media_source_facebook_token').val();
            if (token === '' || fname === '') {
                if (token === '') {
                    $('#media_source_facebook_token').addClass('input-error');
                }else{
                    $('#media_source_facebook_token').removeClass('input-error');
                }
                if (fname === '') {
                    $('#facebook_uname').addClass('input-error');
                }else{
                    $('#facebook_uname').removeClass('input-error');
                }
            } else {
                getImageAlbums('facebook', fname, token);
            }
        }).trigger('change');

        //Xoa 1 item tu danh sach
        $('.row-action .delete').on('click', function () {
            //Xac nhan hanh dong xoa cua nguoi dung
            var confirm = window.confirm('You are sure delete it?');
            if (confirm) {//Neu xac nhan laf xoa thi thuc hien xoa item khoi danh sach va xoa khoi database
                var target = $(this);
                var e = target.parents('.item');
                var id = e.find('.row-id').text();
                $.ajax({
                    url: btAdvParallaxBackgroundCfg.ajaxUrl,
                    data: {action: 'listDeleteSingleItem', id: id},
                    type: "post",
                    beforeSend: function () {
                        target.parent().find('.bt-ajax-loading.list-item-ajax').show();
                    },
                    success: function (data) {
                        var a = $.parseJSON(data);
                        if (a.success) {
                            e.remove();
                        } else {
                            alert(a.message);
                        }
                        target.parent().find('.bt-ajax-loading.list-item-ajax').hide();
                    }
                });
            }
        });


        //Preview item tu danh sach
        $('.row-action .preview').on('click', function () {
//        Xu ly khi nut bam preview parallax dc click
            var previewWrap = $('#btp-item-preview');
            if (previewWrap.hasClass('hidden')) {
                previewWrap.appendTo('body').fadeIn(500, function () {
                    $(this).removeClass('hidden');
                });
            }
            $('body').addClass('no-scroll-adm');
            $('html').addClass('no-scroll-adm');
            var target = $(this);
            var e = target.parents('.item');
            var id = e.find('.row-id').text();
            $.ajax({
                url: btAdvParallaxBackgroundCfg.ajaxUrl,
                data: {action: 'parallaxItemPreview', id: id},
                type: "post",
                beforeSend: function () {
                    previewWrap.find('.overlay-loading').fadeIn(100);
                },
                success: function (data) {
                    var a = $.parseJSON(data);
                    if (a.success) {
                        previewWrap.find('.overlay-loading').fadeOut(100);
                        previewWrap.find('.preview-content .preview-content-in').html(a.data);
                        previewWrap.find('.preview-content .parallax-block-wrap-module').css('marginTop', (($(window).height() - previewWrap.find('.preview-content .parallax-block-wrap-module').height()) / 3) + 'px');
                        previewWrap.find('.preview-content').css({'opacity': 1});
                    } else {
                        alert(a.message);
                    }
                }
            });
        });

        //Dong preview
        $('.preview-close .button').click(function () {
            var previewWrap = $('#btp-item-preview');
            previewWrap.fadeOut(500, function () {
                previewWrap.addClass('hidden');
                previewWrap.find('.preview-content').css({'opacity': 0});
                previewWrap.find('.preview-content .preview-content-in').html('');
                $('body').removeClass('no-scroll-adm');
                $('html').removeClass('no-scroll-adm');
                $('body').removeClass('no-scroll');
                $('html').removeClass('no-scroll');
            });
        });

        //Copy 1 item tu danh sach
        $('.row-action .copy').on('click', function () {
            var target = $(this);
            var e = target.parents('.item');
            var id = e.find('.row-id').text();
            $.ajax({
                url: btAdvParallaxBackgroundCfg.ajaxUrl,
                data: {action: 'listCopyItem', id: id},
                type: "post",
                beforeSend: function () {
                    target.parent().find('.bt-ajax-loading.list-item-ajax').show();
                },
                success: function (data) {
                    var a = $.parseJSON(data);
                    if (a.success) {
                        $(a.data).insertAfter(e);
                    } else {
                        alert(a.message);
                    }
                    target.parent().find('.bt-ajax-loading.list-item-ajax').hide();
                }
            });
        });

        //Xoa cac parallax slider item duoc chon tu dnah sach
        $('.delete-button span.delete-items-list').click(function () {
            //Lay ve danh sach cac item duoc chon
            var idcheck = $(this).parents('.bt-parallax-wrap').find('input[name="fields[]"]:checked');
            //Kiem tra neu danh sach duoc chon <= 0 thi thong bao
            if (idcheck.length <= 0) {
                alert('Please select item(s) to delete');
                return;
            } else {//Neu danh sach duoc chonj > 0 thi thuc hien xoa cac item da dc chon
                var ajaxLoading = $(this).parents('.control-buttons').find('.bt-ajax-loading');
                var ids = [];
                for (var i = 0; i < idcheck.length; i++) {
                    ids[i] = $(idcheck[i]).val();
                }

                $.ajax({
                    url: btAdvParallaxBackgroundCfg.ajaxUrl,
                    data: {action: 'listDeleteSelectedItem', ids: ids},
                    type: "post",
                    beforeSend: function () {
                        ajaxLoading.show();
                    },
                    success: function (data) {
                        var a = $.parseJSON(data);
                        if (a.success) {
                            idcheck.parents('.item').remove();
                        } else {
                            idcheck.parents('.item').remove();
                        }
                        ajaxLoading.hide();
                    }
                });
            }
        });

        //Ham lay ve danh sach album
        function getImageAlbums(source, username, api) {
            $.ajax({
                url: btAdvParallaxBackgroundCfg.ajaxUrl,
                data: {action: 'getImageAlbums', source: source, username: username, api: api},
                type: "post",
                beforeSend: function () {
                    $('.' + source + ' .bt-ajax-loading.load-album-item-ajax').show();
                },
                success: function (data) {
                    var a = $.parseJSON(data);
                    if (a.success) {
                        $("#" + source + "_album").html(a.data);
                    } else {
                        alert(a.message);
                    }
                    $('.' + source + ' .bt-ajax-loading.load-album-item-ajax').hide();
                }
            });
        }

        //Ham lay ve danh sach image
        function getImages(source, username, albumid, api) {
            $.ajax({
                url: btAdvParallaxBackgroundCfg.ajaxUrl,
                data: {action: 'getImages', source: source, username: username, albumid: albumid, api: api},
                type: "post",
                beforeSend: function () {
                    $('.image .bt-ajax-loading.add-item-ajax').show();
                    $('.bt-parallax-get-media-item').fadeOut(500, function () {
                        $(this).addClass('hidden');
                        $(this).find('.get-from-wrap').hide().removeClass('active');
                    });
                },
                success: function (data) {
                    var a = $.parseJSON(data);
                    if (a.success) {
                        parallaxGetItem(source, a.data, 0, a.data.length - 1, false);
                    } else {
                        alert(a.message);
                    }
                    $('.image .bt-ajax-loading.add-item-ajax').hide();
                }
            });
        }

        //Ham lay video tu url
        function getVideoFromUrl(source, url, api) {
            $.ajax({
                url: btAdvParallaxBackgroundCfg.ajaxUrl,
                data: {action: 'getVideoFromUrl', source: source, url: url, api: api},
                type: "post",
                beforeSend: function () {
                    $('.video .bt-ajax-loading.add-item-ajax').show();
                    $('.bt-parallax-get-media-item').fadeOut(500, function () {
                        $(this).addClass('hidden');
                        $(this).find('.get-from-wrap').hide().removeClass('active');
                    });
                },
                success: function (data) {
                    var a = $.parseJSON(data);
                    if (a.success) {
                        parallaxGetItem(source, a.data, 0, a.data.length - 1, false);
                    } else {
                        alert(a.message);
                    }
                    $('.video .bt-ajax-loading.add-item-ajax').hide();
                }
            });
        }

        //Ham lay ve item cho dnah sach,
        function parallaxGetItem(source, data, from, to, complete) {
            var dataPost = '';
            if (source === 'picasa' || source === 'flickr' || source === 'facebook') {
                dataPost = {action: 'getImage', source: source, imageid: data[from]};
            }
            if (source === 'youtube' || source === 'vimeo') {
                dataPost = {action: 'getVideo', source: source, videoid: data[from]};
                if (source == 'youtube') {
                    var api = $('#media_source_google_api').val();
                    dataPost.api = api;
                }
            }
            if (complete) {
                if (source === 'picasa' || source === 'flickr' || source === 'facebook') {
                    $('.image .bt-ajax-loading.add-item-ajax').hide();
                }
                if (source === 'youtube' || source === 'vimeo') {
                    $('.video .bt-ajax-loading.add-item-ajax').hide();
                }
            } else {
                $.ajax({
                    url: btAdvParallaxBackgroundCfg.ajaxUrl,
                    data: dataPost,
                    type: "post",
                    beforeSend: function () {
                        if (source === 'picasa' || source === 'flickr' || source === 'facebook') {
                            $('.image .bt-ajax-loading.add-item-ajax').show();
                        }
                        if (source === 'youtube' || source === 'vimeo') {
                            $('.video .bt-ajax-loading.add-item-ajax').show();
                        }
                    },
                    success: function (response) {
                        var a = $.parseJSON(response);
                        if (a.success) {
                            if (source === 'picasa' || source === 'flickr' || source === 'facebook') {
                                $('.image .list-items').append(a.data);
                            }
                            if (source === 'youtube' || source === 'vimeo') {
                                $('#video-background .list-items').append(a.data);
                            }
                        }
                        from++;
                        if (from <= to) {
                            parallaxGetItem(source, data, from, to, false);
                        } else {
                            parallaxGetItem(source, data, from, to, true);
                        }
                    }
                });
            }
        }

        //Ham set lai kich thuoc cua anh background view
        function fixImagebackgroundView() {
            var bgviewimg = $('.image-preview .inner-image');
            if (bgviewimg.width() / bgviewimg.height() > bgviewimg.find('img').width() / bgviewimg.find('img').height()) {
                bgviewimg.find('img').css({'width': '100%'});
            } else {
                bgviewimg.find('img').css({'height': '100%'});
            }
        }
        
        //Fixed color select in background settings
        $('.input-color-box .wp-picker-input-wrap').removeClass('hidden');
    });

})(jQuery);
