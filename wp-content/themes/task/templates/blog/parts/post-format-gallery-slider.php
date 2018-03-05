<?php
global $edgt_options;
global $edgt_template_name;
?>

<div class="flexslider">
	<ul class="slides">
		<?php
		$array_id = edgt_gallery_post_format_ids_images(get_the_content());

        $blog_image_size = 'full';
        $blog_type = '';
        $image_height = '';
        $image_width = '';

        if(is_single()) {
            $blog_type = 'blog_single';
        }
        elseif($edgt_template_name == "blog-standard.php" || $edgt_template_name == "blog-standard-whole-post.php") {
            $blog_type = 'blog_standard_type';
        }

        if($blog_type !== ''){
            if( isset($edgt_options[$blog_type.'_image_size']) && $edgt_options[$blog_type.'_image_size'] !== '') {
                $blog_image_size = $edgt_options[$blog_type.'_image_size'];

            }

            if( $blog_image_size == 'custom'
                && isset($edgt_options[$blog_type.'_image_size_height']) && $edgt_options[$blog_type.'_image_size_height'] !== ''
                && isset($edgt_options[$blog_type.'_image_size_width']) && $edgt_options[$blog_type.'_image_size_width'] !== '') {

                $image_height = $edgt_options[$blog_type.'_image_size_height'];
                $image_width = $edgt_options[$blog_type.'_image_size_width'];
            }

        }

        if($array_id !==false){
			foreach($array_id as $img_id){ ?>
				<li><a href="<?php the_permalink(); ?>">
                        <?php if( $blog_image_size == 'custom' && $image_height !== '' && $image_height !== ''){
                            echo edgt_generate_thumbnail($img_id,null,$image_width,$image_height);
                        }
                        else{
                            echo wp_get_attachment_image($img_id, $blog_image_size);
                        }
                        ?>
                    </a></li>
			<?php }

		}
		?>
	</ul>
</div>
