var $j = jQuery.noConflict();

$j(document).ready(function() {
    "use strict";

    fitAudio();
    initLoadNextPostOnBottom();
    initMasonryBlogList();
});

$j(window).load(function() {
    "use strict";

    initBlog();
    initBlogMasonryFullWidth();
    initBlogMasonryGallery();
    initBlogSlider();
    initBlogSimpleSlider();
});

$j(window).resize(function() {
    "use strict";

    fitAudio();
    initBlog();
    initBlogMasonryFullWidth();
    initBlogMasonryGallery();
    initBlogSlider();
    initMasonryBlogList();
});

/*
 **	Init audio player for blog layout
 */
function fitAudio() {
    "use strict";

    $j('audio.blog_audio').mediaelementplayer({
        audioWidth: '100%'
    });
}
/*
 **	Init masonry layout for blog template
 */
function initBlog() {
    "use strict";

    if($j('.blog_holder.masonry').length) {

        var $container = $j('.blog_holder.masonry');

        $container.isotope({
            itemSelector: 'article',
            resizable: false,
            masonry: {
                columnWidth: '.blog_holder_grid_sizer',
                gutter: '.blog_holder_grid_gutter'
            }
        });

        $j('.filter').click(function() {
            var selector = $j(this).attr('data-filter');
            $container.isotope({filter: selector});
            return false;
        });

        if($container.hasClass('masonry_infinite_scroll')) {

            $container.infinitescroll({

                    navSelector: '.blog_infinite_scroll_button span',
                    nextSelector: '.blog_infinite_scroll_button span a',
                    itemSelector: 'article',
                    loading: {
                        finishedMsg: finished_text,
                        msgText: loading_text
                    }
                },
                // call Isotope as a callback
                function(newElements) {
                    $container.append(newElements).isotope('appended', $j(newElements));
                    fitVideo();
                    fitAudio();
                    initFlexSlider();
                    setTimeout(function() {
                        $j('.blog_holder.masonry').isotope('layout');
                    }, 400);
                }
            );
        } else if($container.hasClass('masonry_load_more')) {

            var i = 1;
            $j('.blog_load_more_button a').on('click', function(e) {
                e.preventDefault();

                var link = $j(this).attr('href');
                var $content = '.masonry_load_more';
                var $anchor = '.blog_load_more_button a';
                var $next_href = $j($anchor).attr('href');
                $j.get(link + '', function(data) {
                    var $new_content = $j($content, data).wrapInner('').html();
                    $next_href = $j($anchor, data).attr('href');
                    $container.append($j($new_content)).isotope('reloadItems').isotope({sortBy: 'original-order'});
                    fitVideo();
                    fitAudio();
                    initFlexSlider();
                    setTimeout(function() {
                        $j('.blog_holder.masonry').isotope('layout');
                    }, 400);
                    if($j('.blog_load_more_button span').data('rel') > i) {
                        $j('.blog_load_more_button a').attr('href', $next_href); // Change the next URL
                    } else {
                        $j('.blog_load_more_button').remove();
                    }
                });
                i++;
            });
        }

        $j('.blog_holder.masonry, .blog_load_more_button_holder').animate({opacity: "1"}, 400, function() {
            $j('.blog_holder.masonry').isotope('layout');
        });
    }
}


/**
 * Blog Masonry gallery, init masonry and resize pictures in grid
 */
function initBlogMasonryGallery() {
    "use strict";

    resizeBlogMasonryGallery($j('.blog_holder_grid_sizer').width());

    if($j('.blog_holder.blog_masonry_gallery').length) {

        $j('.blog_holder.blog_masonry_gallery').each(function() {
            var $this = $j(this);
            $this.waitForImages(function() {
                $this.animate({opacity: 1});
                $this.isotope({
                    itemSelector: 'article',
                    masonry: {
                        columnWidth: '.blog_holder_grid_sizer'
                    }
                });
            });
        });
        var $container = $j('.blog_holder.blog_masonry_gallery');
        if($container.hasClass('masonry_infinite_scroll')) {
            $container.infinitescroll({
                    navSelector: '.blog_infinite_scroll_button span',
                    nextSelector: '.blog_infinite_scroll_button span a',
                    itemSelector: 'article',
                    loading: {
                        finishedMsg: finished_text,
                        msgText: loading_text
                    }
                },
                // call Isotope as a callback
                function(newElements) {
                    $container.isotope('appended', $j(newElements));
                    fitVideo();
                    fitAudio();
                    initFlexSlider();
                    resizeBlogMasonryGallery($j('.blog_holder_grid_sizer').width());
                    setTimeout(function() {
                        $j('.blog_holder.blog_masonry_gallery').isotope('layout');
                    }, 400);
                }
            );
        } else if($container.hasClass('masonry_load_more')) {

            var i = 1;
            $j('.blog_load_more_button a').on('click', function(e) {
                e.preventDefault();

                var link = $j(this).attr('href');
                var $content = '.masonry_load_more';
                var $anchor = '.blog_load_more_button a';
                var $next_href = $j($anchor).attr('href');
                $j.get(link + '', function(data) {
                    var $new_content = $j($content, data).wrapInner('').html();
                    $next_href = $j($anchor, data).attr('href');
                    $container.append($j($new_content)).isotope('reloadItems').isotope({sortBy: 'original-order'});
                    fitVideo();
                    fitAudio();
                    initFlexSlider();
                    resizeBlogMasonryGallery($j('.blog_holder_grid_sizer').width());
                    setTimeout(function() {
                        $j('.blog_holder.blog_masonry_gallery').isotope('layout');
                    }, 400);
                    if($j('.blog_load_more_button span').data('rel') > i) {
                        $j('.blog_load_more_button a').attr('href', $next_href); // Change the next URL
                    } else {
                        $j('.blog_load_more_button').remove();
                    }
                });
                i++;
            });
        }
        $j(window).resize(function() {
            resizeBlogMasonryGallery($j('.blog_holder_grid_sizer').width());
            $j('.blog_holder.blog_masonry_gallery').isotope('reloadItems');
        });
    }
}

function resizeBlogMasonryGallery(size) {
    "use strict";

    var rectangle_portrait = $j('.blog_holder.blog_masonry_gallery .rectangle_portrait');
    var rectangle_landscape = $j('.blog_holder.blog_masonry_gallery .rectangle_landscape');
    var square_big = $j('.blog_holder.blog_masonry_gallery .square_big');
    var square_small = $j('.blog_holder.blog_masonry_gallery .square_small');

    rectangle_portrait.css('height', 2 * size);
    rectangle_landscape.css('height', size);
    square_big.css('height', 2 * size);
    if(square_big.width() < 350) {
        square_big.css('height', square_big.width());
    }
    square_small.css('height', size);
}
/*
 * Masonry Blog List shortcode
 */
function initMasonryBlogList() {
    'use strict';

    if($j('.latest_post_holder.masonry .post_list').length) {

        $j('.latest_post_holder.masonry .post_list').each(function() {
            var $this = $j(this);
            $this.waitForImages(function() {
                $this.animate({opacity: 1});
                $this.isotope({
                    itemSelector: '.blog-list-masonry-item',
                    masonry: {
                        columnWidth: '.blog-list-masonry-grid-sizer',
                        gutter: '.blog-list-masonry-grid-sizer-gutter'
                    }
                });
            });
        });

    }
}

/*
 **	Init full width masonry layout for blog template
 */
function initBlogMasonryFullWidth() {
    "use strict";

    if($j('.masonry_full_width').length) {

        var $container = $j('.masonry_full_width');

        $j('.filter').click(function() {
            var selector = $j(this).attr('data-filter');
            $container.isotope({filter: selector});
            return false;
        });

        if($container.hasClass('masonry_infinite_scroll')) {
            $container.infinitescroll({
                    navSelector: '.blog_infinite_scroll_button span',
                    nextSelector: '.blog_infinite_scroll_button span a',
                    itemSelector: 'article',
                    loading: {
                        finishedMsg: finished_text,
                        msgText: loading_text
                    }
                },
                // call Isotope as a callback
                function(newElements) {
                    $container.isotope('appended', $j(newElements));
                    fitVideo();
                    fitAudio();
                    initFlexSlider();
                    setTimeout(function() {
                        $j('.blog_holder.masonry_full_width').isotope('layout');
                    }, 400);
                }
            );
        } else if($container.hasClass('masonry_load_more')) {

            var i = 1;
            $j('.blog_load_more_button a').on('click', function(e) {
                e.preventDefault();

                var link = $j(this).attr('href');
                var $content = '.masonry_load_more';
                var $anchor = '.blog_load_more_button a';
                var $next_href = $j($anchor).attr('href');
                $j.get(link + '', function(data) {
                    var $new_content = $j($content, data).wrapInner('').html();
                    $next_href = $j($anchor, data).attr('href');
                    $container.append($j($new_content)).isotope('reloadItems').isotope({sortBy: 'original-order'});
                    fitVideo();
                    fitAudio();
                    initFlexSlider();
                    setTimeout(function() {
                        $j('.blog_holder.masonry_full_width').isotope('layout');
                    }, 400);
                    if($j('.blog_load_more_button span').data('rel') > i) {
                        $j('.blog_load_more_button a').attr('href', $next_href); // Change the next URL
                    } else {
                        $j('.blog_load_more_button').remove();
                    }
                });
                i++;
            });
        }

        $container.isotope({
            itemSelector: 'article',
            resizable: false,
            masonry: {
                columnWidth: '.blog_holder_grid_sizer',
                gutter: '.blog_holder_grid_gutter'
            }
        });

        $j('.masonry_full_width, .blog_load_more_button_holder').animate({opacity: "1"}, 400, function() {
            $j('.blog_holder.masonry_full_width').isotope('layout');
        });
    }
}

/*
 ** Init Blog Slider
 */
function initBlogSlider() {
    "use strict";

    if($j('.blog_slider').length) {

        $j('.blog_slider').each(function() {


            var blogs_shown;
            if(typeof $j(this).data('blogs_shown') !== 'undefined') {
                blogs_shown = $j(this).data('blogs_shown');
            }
            else {
                blogs_shown = 'auto';
            }

            var maxItems = ($j(this).parents('.grid_section').length == 1) ? 3 : blogs_shown;
            var itemWidthTemp;

            switch(blogs_shown) {
                case 3:
                    itemWidthTemp = 667;
                    break;
                case 4:
                    itemWidthTemp = 500;
                    break;
                case 5:
                    itemWidthTemp = 400;
                    break;
                case 6:
                    itemWidthTemp = 334;
                    break;
                default:
                    itemWidthTemp = 500;

                    break;
            }

            var itemWidth = ($j(this).parents('.grid_section').length == 1) ? 353 : itemWidthTemp;


            $j(this).find('.blog_slides').carouFredSel({
                circular: true,
                responsive: true,
                scroll: 1,
                prev: {
                    button: function() {
                        return $j(this).parent().siblings('.caroufredsel-direction-nav').find('.caroufredsel-prev');
                    }
                },
                next: {
                    button: function() {
                        return $j(this).parent().siblings('.caroufredsel-direction-nav').find('.caroufredsel-next');
                    }
                },
                pagination: function() {
                    return $j(this).parent().siblings('.blog_slider_pager');
                },
                items: {
                    width: itemWidth,
                    visible: {
                        min: responsiveNumberSlides(maxItems),
                        max: maxItems
                    }
                },
                auto: false,
                mousewheel: false,
                swipe: {
                    onMouse: true,
                    onTouch: true
                },
                onCreate: function() {
                    $j(this).css('display','block').animate({'opacity': 1}, 1000, function(){
                        if($j('.widget_sticky-sidebar').length) {
                            widgetTopOffset = $j('.widget_sticky-sidebar').offset().top;
                            widgetParentOffset = $j('.widget_sticky-sidebar').position().top;
                            stickySidebarHeight = $j('aside.sidebar').height();
                        }
                        if($j(window).width() > 600) {
                            stickySidebar($scroll, widgetTopOffset, widgetParentOffset, stickySidebarHeight);
                        }
                    });
                }
            });
        });

        calculateHeights();

        $j('.blog_slider .flex-direction-nav a').click(function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            e.stopPropagation();
        });
    }
}


/*
 ** Calculate responsiveness for Blog Slider
 */
function responsiveNumberSlides(maxItems) {
    "use strict";

    var windowWidth = window.innerWidth;

    if(windowWidth > 1200) {
        return maxItems;
    }
    else if(windowWidth < 1200 && windowWidth >= 800) {
        return 3;
    }
    else if(windowWidth < 800 && windowWidth > 500) {
        return 2;
    }
    else if(windowWidth <= 500) {
        return 1;
    }
}


/*
 **	Init flexslider for blog slider simple shortcode
 */
function initBlogSimpleSlider() {
    "use strict";
    $j('.blog_slider_simple_holder').each(function() {
        var interval = 8000;

        var iconClasses = getIconClassesForNavigation(directionNavArrows);

        $j(this).flexslider({
            animationLoop: true,
            controlNav: true,
            directionNav: false,
            useCSS: false,
            pauseOnAction: true,
            pauseOnHover: true,
            slideshow: true,
            animation: 'fade',
            prevText: '<span class="' + iconClasses.leftIconClass + '"></span>',
            nextText: '<span class="' + iconClasses.rightIconClass + '"></span>',
            animationSpeed: 600,
            slideshowSpeed: interval,
            start: function() {
                setTimeout(function() {
                    $j(".blog_slider_simple_holder").fitVids();
                }, 100);
            }
        });

        $j('.blog_slider_simple_holder .flex-direction-nav a').click(function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            e.stopPropagation();
        });
    });
}

function initLoadNextPostOnBottom() {
    "use strict";
    if($j('.blog_vertical_loop').length) {
        var header_addition;
        var normal_header_addition;
        var paspartu_add = $j('body').hasClass('paspartu_enabled') ? Math.round($window_width * paspartu_width) : 0;

        if($j('header.page_header').hasClass('transparent')) {
            normal_header_addition = 0;
        } else {
            normal_header_addition = header_height;
        }

        var click = false;
        $j('.blog_vertical_loop_back_button').addClass('disabled'); //add class to make button transparent until new content is loaded

        var $container = $j('.blog_vertical_loop .blog_holder');
        $j(document).on('click', '.blog_vertical_loop_button a', function(e) {
            e.preventDefault();
            if(click) {
                click = false;
                var $this = $j(this);

                var link = $this.attr('href');
                var $anchor = '.blog_vertical_loop_button_holder a';
                var $next_href = $j($anchor).attr('href');

                //check for mobile header
                if($window_width < 1000) {
                    header_addition = $j('header.page_header').height();
                } else {
                    header_addition = normal_header_addition;
                }

                var scrollTop = $j(window).scrollTop(),
                    elementOffset = $this.closest('article').offset().top,
                    distance = (elementOffset - scrollTop) - header_addition - paspartu_add;

                $container.find('article:eq(1)').addClass('fade_out');
                $this.closest('article').addClass('move_up').removeClass('next_post').css('transform', 'translateY(-' + distance + 'px)');
                setTimeout(function() {
                    $j(window).scrollTop(0);
                    $container.find('article:eq(0)').remove();
                    $container.find('article:eq(0)').addClass('previous_post');
                    $this.closest('article').removeAttr('style').removeClass('move_up');
                }, 450);


                $j.get(link + '', function(data) {
                    var $new_content = $j(data).find('article').addClass('next_post');
                    $j($new_content).find('.preload_background').removeClass('preload_background'); //remove preload_background class from first post
                    $next_href = $j($anchor, data).attr('href');
                    $container.append($j($new_content));
                    click = true;
                });
            }
            else {
                return false;
            }
        });

        $j(document).on('click', '.blog_vertical_loop_back_button a', function(e) {
            e.preventDefault();
            if(click) {
                click = false;
                var $this = $j(this);
                $j('.blog_vertical_loop_back_button').addClass('disabled'); //add class to make button transparent until new content is loaded

                var link = $this.attr('href');
                var $anchor = '.blog_vertical_loop_button_holder.prev_post a';
                var $prev_href = $j($anchor).attr('href');

                $container.find('article:eq(0)').removeClass('fade_out').addClass('fade_in');
                $this.closest('article').addClass('move_up').css('transform', 'translateY(' + $window_height + 'px)');
                setTimeout(function() {
                    $container.find('article:last-child').remove();
                    $container.find('article:eq(0)').removeClass('previous_post fade_in');
                    $this.closest('article').addClass('next_post').removeAttr('style').removeClass('move_up');

                    $j.get(link + '', function(data) {
                        var $new_content = $j(data).find('article').removeClass('next_post').addClass('previous_post'); //by default, posts have next_post class
                        $j($new_content).find('.preload_background').removeClass('preload_background'); //remove preload_background class from first post
                        $prev_href = $j($anchor, data).attr('href');
                        $container.prepend($j($new_content));
                        click = true;
                        $j('.blog_vertical_loop_back_button').removeClass('disabled'); //remove transparent class since new content is loaded
                    });

                }, 450);

            } else {
                return false;
            }

        });

        //load previous post on page load
        $j.get($j('.blog_vertical_loop_button_holder .last_page a').attr('href') + '', function(data) {
            var $new_content = $j(data).find('article').removeClass('next_post').addClass('previous_post'); //by default, posts have next_post class
            $container.prepend($j($new_content));
            click = true;
            $j('.blog_vertical_loop_back_button').removeClass('disabled'); //remove transparent class since new content is loaded
        });
        //load next post on page load
        $j.get($j('.blog_vertical_loop_button a').attr('href') + '', function(data) {
            var $new_content = $j(data).find('article').addClass('next_post');
            $container.append($j($new_content));
            click = true;
        });
    }
}

