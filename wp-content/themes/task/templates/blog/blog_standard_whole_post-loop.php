<?php
global $edgt_options;
global $more;
$more = 0;


$blog_show_categories = "no";
if (isset($edgt_options['blog_standard_type_show_categories'])){
	$blog_show_categories = $edgt_options['blog_standard_type_show_categories'];
}

$blog_show_comments = "yes";
if (isset($edgt_options['blog_standard_type_show_comments'])){
    $blog_show_comments = $edgt_options['blog_standard_type_show_comments'];
}
$blog_show_author = "yes";
if (isset($edgt_options['blog_standard_type_show_author'])){
    $blog_show_author = $edgt_options['blog_standard_type_show_author'];
}
$blog_show_like = "yes";
if (isset($edgt_options['blog_standard_type_show_like'])) {
    $blog_show_like = $edgt_options['blog_standard_type_show_like'];
}
$blog_show_ql_icon_mark = "yes";
$blog_title_holder_icon_class = "";
if (isset($edgt_options['blog_standard_type_show_ql_mark'])) {
    $blog_show_ql_icon_mark = $edgt_options['blog_standard_type_show_ql_mark'];
}
if($blog_show_ql_icon_mark == "yes"){
	$blog_title_holder_icon_class = " with_icon_right";
}

$blog_show_date = "yes";
if (isset($edgt_options['blog_standard_type_show_date'])) {
    $blog_show_date = $edgt_options['blog_standard_type_show_date'];
}
$blog_show_social_share = "yes";
if (isset($edgt_options['enable_social_share'])&& ($edgt_options['enable_social_share']) =="yes"){
    if (isset($edgt_options['post_types_names_post'])&& $edgt_options['post_types_names_post'] =="post"){
        if (isset($edgt_options['blog_standard_type_show_share'])) {
            $blog_show_social_share = $edgt_options['blog_standard_type_show_share'];
        }
    }
}

$blog_read_more_button_classes = '';
if (isset($edgt_options['blog_standard_type_read_more_button_icon']) && $edgt_options['blog_standard_type_read_more_button_icon'] == 'yes'){
    $blog_read_more_button_classes .= 'with_icon';
}

$blog_ql_background_image = "no";
if(isset($edgt_options['blog_standard_type_ql_background_image'])){
	$blog_ql_background_image = $edgt_options['blog_standard_type_ql_background_image'];
}

$background_image_object = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID()), 'blog_image_format_link_quote');
$background_image_src = $background_image_object[0];
$gallery_type = "standard";
if(get_post_meta(get_the_ID(), "gallery_type", true) !== ""){
	$gallery_type = get_post_meta(get_the_ID(), "gallery_type", true);
}

$blog_image_size = 'full';
if( isset($edgt_options['blog_standard_type_image_size']) && $edgt_options['blog_standard_type_image_size'] !== '') {
    $blog_image_size = $edgt_options['blog_standard_type_image_size'];

}

if( $blog_image_size == 'custom'
    && isset($edgt_options['blog_standard_type_image_size_height']) && $edgt_options['blog_standard_type_image_size_height'] !== ''
    && isset($edgt_options['blog_standard_type_image_size_width']) && $edgt_options['blog_standard_type_image_size_width'] !== '') {

    $image_height = $edgt_options['blog_standard_type_image_size_height'];
    $image_width = $edgt_options['blog_standard_type_image_size_width'];

    $image_html = edgt_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,$image_width,$image_height);
}
else{
    $image_html = get_the_post_thumbnail(get_the_ID(), $blog_image_size);
}



$_post_format = get_post_format();
?>
<?php
	switch ($_post_format) {
		case "video":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
				 <div class="post_image">
					<?php $_video_type = get_post_meta(get_the_ID(), "video_format_choose", true);?>
					<?php if($_video_type == "youtube") { ?>
						<iframe  src="//www.youtube.com/embed/<?php echo esc_attr(get_post_meta(get_the_ID(), "video_format_link", true));  ?>?wmode=transparent" wmode="Opaque" allowfullscreen></iframe>
					<?php } elseif ($_video_type == "vimeo"){ ?>
						<iframe src="//player.vimeo.com/video/<?php echo esc_attr(get_post_meta(get_the_ID(), "video_format_link", true));  ?>?title=0&amp;byline=0&amp;portrait=0" allowFullScreen></iframe>
					<?php } elseif ($_video_type == "self"){ ?>
						<div class="video">
						    <div class="mobile-video-image" style="background-image: url(<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_image", true));  ?>);"></div>
					    	<div class="video-wrap"  >
							    <video class="video" poster="<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_image", true));  ?>" preload="auto">
								    <?php if(get_post_meta(get_the_ID(), "video_format_webm", true) != "") { ?> <source type="video/webm" src="<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_webm", true));  ?>"> <?php } ?>
								    <?php if(get_post_meta(get_the_ID(), "video_format_mp4", true) != "") { ?> <source type="video/mp4" src="<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_mp4", true));  ?>"> <?php } ?>
								    <?php if(get_post_meta(get_the_ID(), "video_format_ogv", true) != "") { ?> <source type="video/ogg" src="<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_ogv", true));  ?>"> <?php } ?>
								    <object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo esc_url(get_template_directory_uri().'/js/flashmediaelement.swf'); ?>">
								    	<param name="movie" value="<?php echo esc_url(get_template_directory_uri().'/js/flashmediaelement.swf'); ?>" />
									    <param name="flashvars" value="controls=true&file=<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_mp4", true));  ?>" />
									    <img src="<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_image", true));  ?>" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" />
								    </object>
							    </video>
						    </div>
                        </div>
					<?php } ?>
					<?php if ($blog_show_date == "yes"){ ?>
					<div class="standard_date_holder">
						<span class="standard_date_pattern"></span>
						<div class="standard_date_holder_inner">
							<span class="date_month"><?php the_time('M')?></span>
							<span class="date_day"><?php the_time('d')?></span>
							<span class="date_year"><?php the_time('Y')?></span>
						</div>
					</div>
					<?php } ?>
				 </div>
                 <div class="post_text">
                    <div class="post_text_inner">
						<h2>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h2>
						<?php if($blog_show_author == "yes" || $blog_show_categories == "yes" || $blog_show_like == "yes") { ?>
							<div class="post_info">
								<?php edgt_post_info(array('author' => $blog_show_author, 'category' => $blog_show_categories, 'like' => $blog_show_like)); ?>
							</div>
						<?php } ?>
						<div class="blog_content">
						<?php
							the_content();
						?>
						</div>
						<?php if ($blog_show_comments == "yes" || $blog_show_social_share == "yes"){ ?>
							<div class="standard_comm_social_holder">
                                <span class="blog_comm_social_share_pattern"></span>
							<?php if ($blog_show_comments == "yes"){ ?>
								<div class="post_comments_holder">
									<span class="standard_icons icon_comment_alt"></span>
									<a class="post_comments" href="<?php comments_link(); ?>" target="_self">
										<?php comments_number('0 ' . __('Comments','edgt'), '1 '.__('Comment','edgt'), '% '.__('Comments','edgt') ); ?>
									</a>
								</div>
							<?php } ?>
	                        <?php if($blog_show_social_share == "yes") { ?>
	                            <div class="blog_social_share_holder">
	                                <div class="blog_social_share_holder_inner">
										<span class="standard_icons social_share"></span>
	                                    <span class="blog_social_share_text"><?php echo __("Share Post", "edgt"); ?></span>
	                                    <?php echo do_shortcode('[no_social_share_list]'); // XSS OK ?>
	                                </div>
	                            </div>
	                        <?php }; ?>
							</div>
						<?php }
						?>
						<?php
                            edgt_read_more_button('blog_standard_type_read_more_button',$blog_read_more_button_classes);
						?>
                    </div>
                </div>
			</div>
		</article>
<?php
		break;
		case "audio":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
                <?php if ( has_post_thumbnail() ) { ?>
					<div class="post_image">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php echo wp_kses($image_html, array(
                                'img' => array(
                                    'src' => true,
                                    'alt' => true,
                                    'width' => true,
                                    'height' => true,
                                    'draggable' => true
                                )
                            )); ?>
							<div class="blog_standard_overlay"></div>
						</a>
						<?php if ($blog_show_date == "yes"){ ?>
						<div class="standard_date_holder">
							<span class="standard_date_pattern"></span>
							<div class="standard_date_holder_inner">
								<span class="date_month"><?php the_time('M')?></span>
								<span class="date_day"><?php the_time('d')?></span>
								<span class="date_year"><?php the_time('Y')?></span>
							</div>
						</div>
						<?php } ?>
					</div>
                <?php } ?>
				<div class="audio_image">
					<audio class="blog_audio" src="<?php echo esc_url(get_post_meta(get_the_ID(), "audio_link", true)) ?>" controls="controls">
						<?php _e("Your browser don't support audio player","edgt"); ?>
					</audio>
				</div>
                <div class="post_text">
                    <div class="post_text_inner">
						<h2>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h2>
						<?php if($blog_show_author == "yes" || $blog_show_categories == "yes" || $blog_show_like == "yes") { ?>
							<div class="post_info">
								<?php edgt_post_info(array('author' => $blog_show_author, 'category' => $blog_show_categories, 'like' => $blog_show_like)); ?>
							</div>
						<?php } ?>
						<div class="blog_content">
						<?php
							the_content();
						?>
						</div>
						<?php if ($blog_show_comments == "yes" || $blog_show_social_share == "yes"){ ?>
							<div class="standard_comm_social_holder">
                                <span class="blog_comm_social_share_pattern"></span>
							<?php if ($blog_show_comments == "yes"){ ?>
								<div class="post_comments_holder">
									<span class="standard_icons icon_comment_alt"></span>
									<a class="post_comments" href="<?php comments_link(); ?>" target="_self">
										<?php comments_number('0 ' . __('Comments','edgt'), '1 '.__('Comment','edgt'), '% '.__('Comments','edgt') ); ?>
									</a>
								</div>
							<?php } ?>
	                        <?php if($blog_show_social_share == "yes") { ?>
	                            <div class="blog_social_share_holder">
	                                <div class="blog_social_share_holder_inner">
										<span class="standard_icons social_share"></span>
	                                    <span class="blog_social_share_text"><?php echo __("Share Post", "edgt"); ?></span>
	                                    <?php echo do_shortcode('[no_social_share_list]'); // XSS OK ?>
	                                </div>
	                            </div>
	                        <?php }; ?>
							</div>
						<?php }
						?>
						<?php
                            edgt_read_more_button('blog_standard_type_read_more_button',$blog_read_more_button_classes);
						?>
                    </div>
                </div>
			</div>
		</article>
<?php
		break;
		case "link":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="post_content_holder">
                <div class="post_text_columns">
					<div class="post_text  <?php if($blog_ql_background_image == "yes") {if ( has_post_thumbnail() ) { ?> link_image" style="background:url(<?php echo esc_url($background_image_src); ?>); <?php } } ?>">
						<div class="post_text_inner">
							<?php if ($blog_show_ql_icon_mark == "yes") { ?>
								<div class="post_info_link_mark">
									<span class="icon_link link_mark"></span>
								</div>
							<?php } ?>
							<?php if ($blog_show_date == "yes"){ ?>
							<div class="standard_date_holder">
								<span class="standard_date_pattern"></span>
								<div class="standard_date_holder_inner">
									<span class="date_month"><?php the_time('M')?></span>
									<span class="date_day"><?php the_time('d')?></span>
									<span class="date_year"><?php the_time('Y')?></span>
								</div>
							</div>
							<?php } ?>
							<div class="post_title<?php echo esc_attr($blog_title_holder_icon_class); ?>">
								<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							</div>
							<?php if($blog_show_author == "yes" || $blog_show_categories == "yes" || $blog_show_like == "yes") { ?>
								<div class="post_info">
									<?php edgt_post_info(array('author' => $blog_show_author, 'category' => $blog_show_categories, 'like' => $blog_show_like)); ?>
								</div>
							<?php } ?>
							<?php if ($blog_show_comments == "yes" || $blog_show_social_share == "yes"){ ?>
								<div class="standard_comm_social_holder">
	                                <span class="blog_comm_social_share_pattern"></span>
								<?php if ($blog_show_comments == "yes"){ ?>
									<div class="post_comments_holder">
										<span class="standard_icons icon_comment_alt"></span>
										<a class="post_comments" href="<?php comments_link(); ?>" target="_self">
											<?php comments_number('0 ' . __('Comments','edgt'), '1 '.__('Comment','edgt'), '% '.__('Comments','edgt') ); ?>
										</a>
									</div>
								<?php } ?>
		                        <?php if($blog_show_social_share == "yes") { ?>
		                            <div class="blog_social_share_holder">
		                                <div class="blog_social_share_holder_inner">
		                                    <?php echo do_shortcode('[no_social_share]'); // XSS OK ?>
		                                </div>
		                            </div>
		                        <?php }; ?>
								</div>
							<?php }
							?>
						</div>
					</div>
                </div>
            </div>
        </article>
<?php
		break;
		case "gallery":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="post_content_holder">
				<div class="post_image">
					<?php get_template_part('templates/blog/parts/post-format-gallery-slider');	?>
					<?php if ($blog_show_date == "yes"){ ?>
					<div class="standard_date_holder">
						<span class="standard_date_pattern"></span>
						<div class="standard_date_holder_inner">
							<span class="date_month"><?php the_time('M')?></span>
							<span class="date_day"><?php the_time('d')?></span>
							<span class="date_year"><?php the_time('Y')?></span>
						</div>
					</div>
					<?php } ?>
				</div>
                <div class="post_text">
                    <div class="post_text_inner">
						<h2>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h2>
						<?php if($blog_show_author == "yes" || $blog_show_categories == "yes" || $blog_show_like == "yes") { ?>
							<div class="post_info">
								<?php edgt_post_info(array('author' => $blog_show_author, 'category' => $blog_show_categories, 'like' => $blog_show_like)); ?>
							</div>
						<?php } ?>
						<div class="blog_content">
						<?php
							the_content();
						?>
						</div>
						<?php if ($blog_show_comments == "yes" || $blog_show_social_share == "yes"){ ?>
							<div class="standard_comm_social_holder">
                                <span class="blog_comm_social_share_pattern"></span>
							<?php if ($blog_show_comments == "yes"){ ?>
								<div class="post_comments_holder">
									<span class="standard_icons icon_comment_alt"></span>
									<a class="post_comments" href="<?php comments_link(); ?>" target="_self">
										<?php comments_number('0 ' . __('Comments','edgt'), '1 '.__('Comment','edgt'), '% '.__('Comments','edgt') ); ?>
									</a>
								</div>
							<?php } ?>
	                        <?php if($blog_show_social_share == "yes") { ?>
	                            <div class="blog_social_share_holder">
	                                <div class="blog_social_share_holder_inner">
										<span class="standard_icons social_share"></span>
	                                    <span class="blog_social_share_text"><?php echo __("Share Post", "edgt"); ?></span>
	                                    <?php echo do_shortcode('[no_social_share_list]'); // XSS OK ?>
	                                </div>
	                            </div>
	                        <?php }; ?>
							</div>
						<?php }
						?>
						<?php
                            edgt_read_more_button('blog_standard_type_read_more_button',$blog_read_more_button_classes);
						?>
                    </div>
                </div>
            </div>
		</article>
<?php
		break;
		case "quote":
?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="post_content_holder">
                    <div class="post_text_columns">
                         <div class="post_text  <?php if($blog_ql_background_image == "yes") {if ( has_post_thumbnail() ) { ?> quote_image" style="background:url(<?php echo esc_url($background_image_src); ?>); <?php } } ?>">
                            <div class="post_text_inner">
								<?php if ($blog_show_ql_icon_mark == "yes") { ?>
									<div class="post_info_quote_mark">
										<span class="icon_quotations quote_mark"></span>
									</div>
								<?php } ?>
								<?php if ($blog_show_date == "yes"){ ?>
								<div class="standard_date_holder">
									<span class="standard_date_pattern"></span>
									<div class="standard_date_holder_inner">
										<span class="date_month"><?php the_time('M')?></span>
										<span class="date_day"><?php the_time('d')?></span>
										<span class="date_year"><?php the_time('Y')?></span>
									</div>
								</div>
								<?php } ?>
								<div class="post_title<?php echo esc_attr($blog_title_holder_icon_class); ?>">
									<h3>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), "quote_format", true)); ?></a>
									</h3>
									<span class="quote_author">&mdash; <?php the_title(); ?></span>
								</div>
                                <?php if($blog_show_author == "yes" || $blog_show_categories == "yes" || $blog_show_like == "yes") { ?>
									<div class="post_info">
										<?php edgt_post_info(array('author' => $blog_show_author, 'category' => $blog_show_categories, 'like' => $blog_show_like)); ?>
									</div>
								<?php } ?>
								<?php if ($blog_show_comments == "yes" || $blog_show_social_share == "yes"){ ?>
									<div class="standard_comm_social_holder">
		                                <span class="blog_comm_social_share_pattern"></span>
									<?php if ($blog_show_comments == "yes"){ ?>
										<div class="post_comments_holder">
											<span class="standard_icons icon_comment_alt"></span>
											<a class="post_comments" href="<?php comments_link(); ?>" target="_self">
												<?php comments_number('0 ' . __('Comments','edgt'), '1 '.__('Comment','edgt'), '% '.__('Comments','edgt') ); ?>
											</a>
										</div>
									<?php } ?>
			                        <?php if($blog_show_social_share == "yes") { ?>
			                            <div class="blog_social_share_holder">
			                                <div class="blog_social_share_holder_inner">
			                                    <?php echo do_shortcode('[no_social_share]'); // XSS OK ?>
			                                </div>
			                            </div>
			                        <?php }; ?>
									</div>
								<?php }
								?>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
<?php
		break;
		default:
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
                <?php if ( has_post_thumbnail() ) { ?>
                        <div class="post_image">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php echo wp_kses($image_html, array(
                                    'img' => array(
                                        'src' => true,
                                        'alt' => true,
                                        'width' => true,
                                        'height' => true,
                                        'draggable' => true
                                    )
                                )); ?>
								<div class="blog_standard_overlay"></div>
                            </a>
							<?php if ($blog_show_date == "yes"){ ?>
							<div class="standard_date_holder">
								<span class="standard_date_pattern"></span>
								<div class="standard_date_holder_inner">
									<span class="date_month"><?php the_time('M')?></span>
									<span class="date_day"><?php the_time('d')?></span>
									<span class="date_year"><?php the_time('Y')?></span>
								</div>
							</div>
							<?php } ?>
                        </div>
				<?php } ?>
				<div class="post_text">
					<div class="post_text_inner">
                            <h2>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                            </h2>
							<?php if($blog_show_author == "yes" || $blog_show_categories == "yes" || $blog_show_like == "yes") { ?>
								<div class="post_info">
									<?php edgt_post_info(array('author' => $blog_show_author, 'category' => $blog_show_categories, 'like' => $blog_show_like)); ?>
								</div>
							<?php } ?>
							<div class="blog_content">
							<?php
                                the_content();
							?>
							</div>
						<?php if ($blog_show_comments == "yes" || $blog_show_social_share == "yes"){ ?>
							<div class="standard_comm_social_holder">
                                <span class="blog_comm_social_share_pattern"></span>
							<?php if ($blog_show_comments == "yes"){ ?>
								<div class="post_comments_holder">
									<span class="standard_icons icon_comment_alt"></span>
									<a class="post_comments" href="<?php comments_link(); ?>" target="_self">
										<?php comments_number('0 ' . __('Comments','edgt'), '1 '.__('Comment','edgt'), '% '.__('Comments','edgt') ); ?>
									</a>
								</div>
							<?php } ?>
	                        <?php if($blog_show_social_share == "yes") { ?>
	                            <div class="blog_social_share_holder">
	                                <div class="blog_social_share_holder_inner">
										<span class="standard_icons social_share"></span>
	                                    <span class="blog_social_share_text"><?php echo __("Share Post", "edgt"); ?></span>
	                                    <?php echo do_shortcode('[no_social_share_list]'); // XSS OK ?>
	                                </div>
	                            </div>
	                        <?php }; ?>
							</div>
						<?php }
						?>
						<?php
                            edgt_read_more_button('blog_standard_type_read_more_button',$blog_read_more_button_classes);
						?>
                    </div>
				</div>
			</div>
		</article>
<?php
}
?>

