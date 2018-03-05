<?php
global $edgt_options;

$enable_navigation = true;
if (isset($edgt_options['portfolio_hide_pagination']) && $edgt_options['portfolio_hide_pagination'] == "yes"){
    $enable_navigation = false;
}

$navigation_through_category = false;
if (isset($edgt_options['portfolio_navigation_through_same_category']) && $edgt_options['portfolio_navigation_through_same_category'] == "yes")
    $navigation_through_category = true;
?>

<?php

$back_to_button_code = '<span><i class="row1 col1"></i><i class="row1 col2"></i><i class="row1 col3"></i><i class="row2 col1"></i><i class="row2 col2"></i><i class="row2 col3"></i><i class="row3 col1"></i><i class="row3 col2"></i><i class="row3 col3"></i></span>';

?>

<?php if($enable_navigation){ ?>
    <div class="portfolio_navigation">
        <div class="portfolio_navigation_inner">
            <?php if(get_previous_post() != ""){ ?>
                <div class="portfolio_prev">
                    <?php
                    if($navigation_through_category){
                        previous_post_link('%link','<span>%title</span>', true,'','portfolio_category');
                    } else {
                        previous_post_link('%link','<span>%title</span>');
                    }
                    ?>
                </div> <!-- close div.portfolio_prev -->
            <?php } ?>
            <?php if(get_post_meta(get_the_ID(), "edgt_choose-portfolio-list-page", true) != "") { ?>
                <div class="portfolio_button">
                    <a href="<?php echo esc_url(get_permalink(get_post_meta(get_the_ID(), "edgt_choose-portfolio-list-page", true))); ?>"><?php echo wp_kses($back_to_button_code,array(
                        'span' => array("class" => true),
                        'i' => array("class"=> true)
                    ));?></a>
                </div> <!-- close div.portfolio_button -->
            <?php } ?>
            <?php if(get_next_post() != ""){ ?>
                <div class="portfolio_next">
                    <?php
                    if($navigation_through_category){
                        next_post_link('%link','<span>%title</span>', true,'','portfolio_category');
                    } else {
                        next_post_link('%link','<span>%title</span>');
                    }
                    ?>
                </div> <!-- close div.portfolio_next -->
            <?php } ?>
        </div>
    </div> <!-- close div.portfolio_navigation -->
<?php } ?>	