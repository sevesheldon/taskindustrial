<?php
//get global variables
global $wp_query;
global $edgt_options;
global $wpdb;

//init variables
$portfolio_images 			    = get_post_meta(get_the_ID(), "edgt_portfolio_images", true);
$lightbox_single_project 	    = 'no';
$lightbox_video_single_project  = 'no';
$portfolio_title_tag            = 'h3';
$portfolio_title_style          = '';



//is lightbox turned on for image single project?
if (isset($edgt_options['lightbox_single_project'])) {
	$lightbox_single_project = $edgt_options['lightbox_single_project'];
}

//is lightbox turned on for video single project?
if (isset($edgt_options['lightbox_video_single_project'])) {
	$lightbox_video_single_project = $edgt_options['lightbox_video_single_project'];
}

//set title tag
if (isset($edgt_options['portfolio_title_tag'])) {
    $portfolio_title_tag = $edgt_options['portfolio_title_tag'];
}

$hide_share = "no";
if(isset($edgt_options['portfolio_hide_share'])) {
	$hide_share = $edgt_options['portfolio_hide_share'];
}

$hide_like = "no";
if(isset($edgt_options['portfolio_hide_like'])) {
	$hide_like = $edgt_options['portfolio_hide_like'];
}

//set style for title
if ((isset($edgt_options['portfolio_title_margin_bottom']) && $edgt_options['portfolio_title_margin_bottom'] != '')
    || (isset($edgt_options['portfolio_title_color']) && !empty($edgt_options['portfolio_title_color']))){

    if (isset($edgt_options['portfolio_title_margin_bottom']) && $edgt_options['portfolio_title_margin_bottom'] != '') {
        $portfolio_title_style .= 'margin-bottom:'.esc_attr($edgt_options['portfolio_title_margin_bottom']).'px;';
    }

    if (isset($edgt_options['portfolio_title_color']) && !empty($edgt_options['portfolio_title_color'])) {
        $portfolio_title_style .= 'color:'.esc_attr($edgt_options['portfolio_title_color']).';';
    }

}

//sort portfolio images by user defined input
if (is_array($portfolio_images)){
	usort($portfolio_images, "edgtComparePortfolioImages");
}
?>

<div class="portfolio_images">
	<?php
    $portfolio_m_images = get_post_meta(get_the_ID(), "edgt_portfolio-image-gallery", true);
    if ($portfolio_m_images){
        $portfolio_image_gallery_array=explode(',',$portfolio_m_images);
        foreach($portfolio_image_gallery_array as $gimg_id){
            $title = get_the_title($gimg_id);
            $alt = get_post_meta($gimg_id, '_wp_attachment_image_alt', true);
            $image_src = wp_get_attachment_image_src( $gimg_id, 'full' );
            if (is_array($image_src)) $image_src = $image_src[0];
            ?>
            <?php if($lightbox_single_project == "yes"){ ?>
                <a class="lightbox_single_portfolio" title="<?php echo esc_attr($title); ?>" href="<?php echo esc_url($image_src); ?>" data-rel="prettyPhoto[single_pretty_photo]">
                    <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($alt); ?>" />
                </a>
            <?php } else { ?>
                <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($alt); ?>" />
            <?php }
        }
    }

    if (is_array($portfolio_images) && count($portfolio_images)){
		foreach($portfolio_images as $portfolio_image){
			?>

			<?php if($portfolio_image['portfolioimg'] != ""){ ?>

				<?php

				list($id, $title, $alt) = edgt_get_portfolio_image_meta($portfolio_image['portfolioimg']);

				?>

				<?php if($lightbox_single_project == "yes"){ ?>
					<a class="lightbox_single_portfolio" title="<?php echo esc_attr($title); ?>" href="<?php echo esc_url($portfolio_image['portfolioimg']); ?>" data-rel="prettyPhoto[single_pretty_photo]">
						<img src="<?php echo esc_url($portfolio_image['portfolioimg']); ?>" alt="<?php echo esc_attr($alt); ?>" />
					</a>
				<?php } else { ?>
					<img src="<?php echo esc_url($portfolio_image['portfolioimg']); ?>" alt="<?php echo esc_attr($alt); ?>" />
				<?php } ?>

			<?php }else{ ?>

				<?php
				$portfolio_video_type = "";
				if (isset($portfolio_image['portfoliovideotype'])) $portfolio_video_type = $portfolio_image['portfoliovideotype'];
				switch ($portfolio_video_type){
					case "youtube": ?>
						<?php if($lightbox_video_single_project == "yes"){ ?>
							<?php
								$vidID = esc_attr($portfolio_image['portfoliovideoid']);
                                $url = "http://gdata.youtube.com/feeds/api/videos/".$vidID."?alt=json";
                                $xml = json_decode(@file_get_contents($url), true);

                                if(is_array($xml['entry']['title'])){
                                    $video_title = array_shift($xml['entry']['title']);
                                } else {
                                    $video_title = "";
                                }

                                $thumbnail = "//img.youtube.com/vi/".$vidID."/maxresdefault.jpg";
							?>
                            <a class="lightbox_single_portfolio" title="<?php echo esc_attr($video_title); ?>" href="//www.youtube.com/watch?feature=player_embedded&v=<?php echo esc_attr($vidID); ?>" data-rel="prettyPhoto[single_pretty_photo]">
								<i class="fa fa-play"></i>
                                <img width="100%" src="<?php echo esc_url($thumbnail); ?>"/>
							</a>
						<?php } else { ?>
							<iframe width="100%" src="//www.youtube.com/embed/<?php echo esc_attr($portfolio_image['portfoliovideoid']);  ?>?wmode=transparent" wmode="Opaque" allowfullscreen></iframe>
						<?php } ?>
						<?php	break;
					case "vimeo": ?>
						<?php if($lightbox_video_single_project == "yes"){ ?>
							<?php
								$vidID = esc_attr($portfolio_image['portfoliovideoid']);
                                $xml = unserialize(@file_get_contents("http://vimeo.com/api/v2/video/$vidID.php"));
							    $thumbnail = $xml[0]['thumbnail_large'];  
							    $video_title = $xml[0]['title'];
							?>
							<a class="lightbox_single_portfolio" title="<?php echo esc_attr($video_title); ?>" href="//vimeo.com/<?php echo esc_attr($portfolio_image['portfoliovideoid']); ?>" data-rel="prettyPhoto[single_pretty_photo]">
								<i class="fa fa-play"></i>
								<img width="100%" src="<?php echo esc_url($thumbnail); ?>" />
							</a>
						<?php } else { ?>
							<iframe src="//player.vimeo.com/video/<?php echo esc_attr($portfolio_image['portfoliovideoid']); ?>?title=0&amp;byline=0&amp;portrait=0" allowFullScreen></iframe>
						<?php } ?>
						<?php break;
					case "self": ?>
						<div class="video">
							<div class="mobile-video-image" style="background-image: url(<?php echo esc_url($portfolio_image['portfoliovideoimage']); ?>);"></div>
							<div class="video-wrap"  >
								<video class="video" poster="<?php echo esc_url($portfolio_image['portfoliovideoimage']); ?>" preload="auto">
									<?php if(!empty($portfolio_image['portfoliovideowebm'])) { ?> <source type="video/webm" src="<?php echo esc_url($portfolio_image['portfoliovideowebm']); ?>"> <?php } ?>
									<?php if(!empty($portfolio_image['portfoliovideomp4'])) { ?> <source type="video/mp4" src="<?php echo esc_url($portfolio_image['portfoliovideomp4']); ?>"> <?php } ?>
									<?php if(!empty($portfolio_image['portfoliovideoogv'])) { ?> <source type="video/ogg" src="<?php echo esc_url($portfolio_image['portfoliovideoogv']); ?>"> <?php } ?>
									<object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo esc_url(get_template_directory_uri().'/js/flashmediaelement.swf'); ?>">
										<param name="movie" value="<?php echo esc_url(get_template_directory_uri().'/js/flashmediaelement.swf'); ?>" />
										<param name="flashvars" value="controls=true&file=<?php echo esc_url($portfolio_image['portfoliovideomp4']); ?>" />
										<img src="<?php echo esc_url($portfolio_image['portfoliovideoimage']); ?>" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" />
									</object>
								</video>
							</div></div>
					<?php break;
				}
			}
		}
	}
	?>
</div>
<div class="two_columns_75_25 clearfix portfolio_container">
	<div class="column1">
		<div class="column_inner">
			<div class="portfolio_single_text_holder">
				<<?php echo esc_attr($portfolio_title_tag); ?> class="portfolio_single_text_title" <?php edgt_inline_style($portfolio_title_style); ?>><span><?php the_title(); ?></span></<?php echo esc_attr($portfolio_title_tag); ?>>
				<?php the_content(); ?>
				<?php if ($hide_like == "no" || $hide_share == "no"){ ?>
					<div class="portfolio_single_like_share_holder">
						<span class="portfolio_single_like_share_pattern"></span>
					<?php if ($hide_like == "no"){ ?>
						<div class="portfolio_single_like">
							<?php echo edgt_like_portfolio_post(get_the_ID());?>
						</div>
					<?php } ?>
					<?php if($hide_share == "no") { ?>
						<div class="portfolio_single_social_share_holder">
							<div class="portfolio_social_share_holder_inner">
								<span class="portfolio_social_share_text"><?php echo __("Share", "edgt"); ?></span>
								<?php echo do_shortcode('[no_social_share_list]'); // XSS OK ?>
							</div>
						</div>
					<?php }; ?>
					</div>
				<?php }
				?>
			</div>
		</div>
	</div>
	<div class="column2">
		<div class="column_inner">
			<div class="portfolio_detail portfolio_single_follow">
				<?php
					//get portfolio custom fields section
					get_template_part('templates/portfolio/parts/portfolio-custom-fields');

					//get portfolio date section
					get_template_part('templates/portfolio/parts/portfolio-date');

					//get portfolio categories section
					get_template_part('templates/portfolio/parts/portfolio-categories');

					//get portfolio tags section
					get_template_part('templates/portfolio/parts/portfolio-tags');
				?>
			</div>
		</div>
	</div>
</div>