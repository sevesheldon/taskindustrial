<?php
/*
Template Name: Blog: Vertical Loop
*/
?>
<?php get_header(); ?>
<?php
global $wp_query;
global $edgt_template_name;
$id = $wp_query->get_queried_object_id();
$edgt_template_name = get_page_template_slug($id);

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }
$page_object = get_post( $id );

$sidebar = get_post_meta($id, "edgt_show-sidebar", true);

if(get_post_meta($id, "edgt_page_background_color", true) != ""){
    $background_color = 'background-color: '.esc_attr(get_post_meta($id, "edgt_page_background_color", true));
}else{
    $background_color = "";
}

$content_style = "";
if(get_post_meta($id, "edgt_content-top-padding", true) != ""){
    if(get_post_meta($id, "edgt_content-top-padding-mobile", true) == 'yes'){
        $content_style = "padding-top:".esc_attr(get_post_meta($id, "edgt_content-top-padding", true))."px !important";
    }else{
        $content_style = "padding-top:".esc_attr(get_post_meta($id, "edgt_content-top-padding", true))."px";
    }
}

if(isset($edgt_options['blog_vertical_loop_type_number_of_chars']) && $edgt_options['blog_vertical_loop_type_number_of_chars'] != "") {
    edgt_set_blog_word_count(esc_attr($edgt_options['blog_vertical_loop_type_number_of_chars']));
}

?>
<script>
	<?php if(get_post_meta($id, "edgt_page_scroll_amount_for_sticky", true)) { ?>
		page_scroll_amount_for_sticky = <?php echo esc_attr(get_post_meta($id, "edgt_page_scroll_amount_for_sticky", true)); ?>;
	<?php }else{ ?>
		page_scroll_amount_for_sticky = undefined
	<?php } ?>
</script>


    <div class="full_width blog_vertical_loop" <?php edgt_inline_style($background_color); ?>>
        <div class="full_width_inner" <?php edgt_inline_style($content_style); ?>>
            <div class="blog_holder blog_vertical_loop_type">
                    <?php get_template_part('templates/blog/blog_vertical', 'loop'); ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>