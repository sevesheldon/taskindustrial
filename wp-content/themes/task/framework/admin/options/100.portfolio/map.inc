<?php

$portfolioPage = new EdgeAdminPage("9", "Portfolio", "fa fa-camera-retro");
$edgtFramework->edgtOptions->addAdminPage("portfolioPage",$portfolioPage);

//Portfolio List

$panel1 = new EdgePanel("Portfolio List", "porfolio_list");
$portfolioPage->addChild("panel1",$panel1);

    $portfolio_edgt_like = new EdgeField("onoff","portfolio_edgt_like","on","Likes",'Enabling this option will turn on "Likes"');
    $panel1->addChild("portfolio_edgt_like",$portfolio_edgt_like);

	$portfolio_disable_text_box = new EdgeField("yesno","portfolio_disable_text_box","yes","Disable Boxed Style Project Description","Disabling boxed styled project description", array(), array("dependence" => true, "dependence_hide_on_yes" => "#edgtf_enable_portfolio_list_box_container", "dependence_show_on_yes" => ""));
	$panel1->addChild("portfolio_disable_text_box",$portfolio_disable_text_box);

	$enable_portfolio_list_box_container = new EdgeContainer("enable_portfolio_list_box_container","portfolio_disable_text_box","yes");
	$panel1->addChild("enable_portfolio_list_box_container",$enable_portfolio_list_box_container);

		$portfolio_list_box_background_color = new EdgeField("color","portfolio_list_box_background_color","","Portfolio Box Background Color","Default color is #ffffff");
		$enable_portfolio_list_box_container->addChild("portfolio_list_box_background_color",$portfolio_list_box_background_color);

    $group1 = new EdgeGroup("Image Hover Overlay Color","Define icons styles on project hover. Default hover color is #279eff.");
    $panel1->addChild("group1",$group1);

        $row1 = new EdgeRow();
        $group1->addChild("row1",$row1);

            $portfolio_shader_color = new EdgeField("colorsimple","portfolio_shader_color","","Color","This is some description");
            $row1->addChild("portfolio_shader_color",$portfolio_shader_color);

            $portfolio_shader_transparency = new EdgeField("textsimple","portfolio_shader_transparency","","Transparency (0=full - 1=opaque)","This is some description", array(), array("col_width" => 3));
            $row1->addChild("portfolio_shader_transparency",$portfolio_shader_transparency);
			
		$group25 = new EdgeGroup("Load More Button Background","Define load more pattern background");
        $panel1->addChild("group25",$group25);

                $row2 = new EdgeRow();
                $group25->addChild("row2",$row2);                        
						
						$portfolio_list_button_background_pattern_image = new EdgeField("imagesimple","portfolio_list_button_background_pattern_image","","Pattern image","");
						$row2->addChild("portfolio_list_button_background_pattern_image",$portfolio_list_button_background_pattern_image);


// Portfolio List TEXT STYLES

$title_text_styles = new EdgeTitle("title_text_styles","Title Text Styles");
$panel1->addChild("title_text_styles",$title_text_styles);

    $group7 = new EdgeGroup("Title Style for Standard and Pinterest Lists","Define title styles for standard and pinterest portfolio lists.");
    $panel1->addChild("group7",$group7);

        $row1 = new EdgeRow();
        $group7->addChild("row1",$row1);
            $portfolio_title_standard_list_color = new EdgeField("colorsimple","portfolio_title_standard_list_color","","Text Color","This is some description");
            $row1->addChild("portfolio_title_standard_list_color",$portfolio_title_standard_list_color);
            $portfolio_title_standard_list_hover_color = new EdgeField("colorsimple","portfolio_title_standard_list_hover_color","","Text Hover Color","This is some description");
            $row1->addChild("portfolio_title_standard_list_hover_color",$portfolio_title_standard_list_hover_color);
            $portfolio_title_standard_list_font_size = new EdgeField("textsimple","portfolio_title_standard_list_font_size","","Font Size (px)","This is some description");
            $row1->addChild("portfolio_title_standard_list_font_size",$portfolio_title_standard_list_font_size);
            $portfolio_title_standard_list_line_height = new EdgeField("textsimple","portfolio_title_standard_list_line_height","","Line Height (px)","This is some description");
            $row1->addChild("portfolio_title_standard_list_line_height",$portfolio_title_standard_list_line_height);

        $row2 = new EdgeRow(true);
        $group7->addChild("row2",$row2);
            $portfolio_title_standard_list_text_transform = new EdgeField("selectblanksimple","portfolio_title_standard_list_text_transform","","Text Transform","This is some description",$edgt_options_texttransform);
            $row2->addChild("portfolio_title_standard_list_text_transform",$portfolio_title_standard_list_text_transform);
            $portfolio_title_standard_list_font_family = new EdgeField("fontsimple","portfolio_title_standard_list_font_family","-1","Font Family","This is some description");
            $row2->addChild("portfolio_title_standard_list_font_family",$portfolio_title_standard_list_font_family);
            $portfolio_title_standard_list_font_style = new EdgeField("selectblanksimple","portfolio_title_standard_list_font_style","","Font Style","This is some description",$edgt_options_fontstyle);
            $row2->addChild("portfolio_title_standard_list_font_style",$portfolio_title_standard_list_font_style);
            $portfolio_title_standard_list_font_weight = new EdgeField("selectblanksimple","portfolio_title_standard_list_font_weight","","Font Weight","This is some description",$edgt_options_fontweight);
            $row2->addChild("portfolio_title_standard_list_font_weight",$portfolio_title_standard_list_font_weight);

        $row3 = new EdgeRow(true);
        $group7->addChild("row3",$row3);
            $portfolio_title_standard_list_letter_spacing = new EdgeField("textsimple","portfolio_title_standard_list_letter_spacing","","Letter Spacing (px)","This is some description");
            $row3->addChild("portfolio_title_standard_list_letter_spacing",$portfolio_title_standard_list_letter_spacing);

    $group9 = new EdgeGroup("Title Style for Text on Hover Image and Text before Hover Lists","Define title styles for text on hover image and text before hover portfolio lists.");
    $panel1->addChild("group9",$group9);

        $row1 = new EdgeRow();
        $group9->addChild("row1",$row1);
            $portfolio_title_hover_box_list_color = new EdgeField("colorsimple","portfolio_title_hover_box_list_color","","Text Color","This is some description");
            $row1->addChild("portfolio_title_hover_box_list_color",$portfolio_title_hover_box_list_color);
            $portfolio_title_hover_box_list_hover_color = new EdgeField("colorsimple","portfolio_title_hover_box_list_hover_color","","Text Hover Color","This is some description");
            $row1->addChild("portfolio_title_hover_box_list_hover_color",$portfolio_title_hover_box_list_hover_color);
            $portfolio_title_hover_box_list_font_size = new EdgeField("textsimple","portfolio_title_hover_box_list_font_size","","Font Size (px)","This is some description");
            $row1->addChild("portfolio_title_hover_box_list_font_size",$portfolio_title_hover_box_list_font_size);
            $portfolio_title_hover_box_list_line_height = new EdgeField("textsimple","portfolio_title_hover_box_list_line_height","","Line Height (px)","This is some description");
            $row1->addChild("portfolio_title_hover_box_list_line_height",$portfolio_title_hover_box_list_line_height);

        $row2 = new EdgeRow(true);
        $group9->addChild("row2",$row2);
            $portfolio_title_hover_box_list_font_family = new EdgeField("fontsimple","portfolio_title_hover_box_list_font_family","-1","Font Family","This is some description");
            $row2->addChild("portfolio_title_hover_box_list_font_family",$portfolio_title_hover_box_list_font_family);
            $portfolio_title_hover_box_list_text_transform = new EdgeField("selectblanksimple","portfolio_title_hover_box_list_text_transform","","Text Transform","This is some description",$edgt_options_texttransform);
            $row2->addChild("portfolio_title_hover_box_list_text_transform",$portfolio_title_hover_box_list_text_transform);
            $portfolio_title_hover_box_list_font_style = new EdgeField("selectblanksimple","portfolio_title_hover_box_list_font_style","","Font Style","This is some description",$edgt_options_fontstyle);
            $row2->addChild("portfolio_title_hover_box_list_font_style",$portfolio_title_hover_box_list_font_style);
            $portfolio_title_hover_box_list_font_weight = new EdgeField("selectblanksimple","portfolio_title_hover_box_list_font_weight","","Font Weight","This is some description",$edgt_options_fontweight);
            $row2->addChild("portfolio_title_hover_box_list_font_weight",$portfolio_title_hover_box_list_font_weight);

        $row3 = new EdgeRow(true);
        $group9->addChild("row3",$row3);
            $portfolio_title_hover_box_list_letter_spacing = new EdgeField("textsimple","portfolio_title_hover_box_list_letter_spacing","","Letter Spacing (px)","This is some description");
            $row3->addChild("portfolio_title_hover_box_list_letter_spacing",$portfolio_title_hover_box_list_letter_spacing);

    $group11 = new EdgeGroup("Title Style for Portfolio Slider and Masonry Lists","Define title styles for slider and masonry portfolio lists.");
    $panel1->addChild("group11",$group11);

        $row1 = new EdgeRow();
        $group11->addChild("row1",$row1);
            $portfolio_title_list_color = new EdgeField("colorsimple","portfolio_title_list_color","","Text Color","This is some description");
            $row1->addChild("portfolio_title_list_color",$portfolio_title_list_color);
            $portfolio_title_list_hover_color = new EdgeField("colorsimple","portfolio_title_list_hover_color","","Text Hover Color","This is some description");
            $row1->addChild("portfolio_title_list_hover_color",$portfolio_title_list_hover_color);
            $portfolio_title_list_font_size = new EdgeField("textsimple","portfolio_title_list_font_size","","Font Size (px)","This is some description");
            $row1->addChild("portfolio_title_list_font_size",$portfolio_title_list_font_size);
            $portfolio_title_list_line_height = new EdgeField("textsimple","portfolio_title_list_line_height","","Line Height (px)","This is some description");
            $row1->addChild("portfolio_title_list_line_height",$portfolio_title_list_line_height);

        $row2 = new EdgeRow(true);
        $group11->addChild("row2",$row2);
            $portfolio_title_list_text_transform = new EdgeField("selectblanksimple","portfolio_title_list_text_transform","","Text Transform","This is some description",$edgt_options_texttransform);
            $row2->addChild("portfolio_title_list_text_transform",$portfolio_title_list_text_transform);
            $portfolio_title_list_font_family = new EdgeField("fontsimple","portfolio_title_list_font_family","-1","Font Family","This is some description");
            $row2->addChild("portfolio_title_list_font_family",$portfolio_title_list_font_family);
            $portfolio_title_list_font_style = new EdgeField("selectblanksimple","portfolio_title_list_font_style","","Font Style","This is some description",$edgt_options_fontstyle);
            $row2->addChild("portfolio_title_list_font_style",$portfolio_title_list_font_style);
            $portfolio_title_list_font_weight = new EdgeField("selectblanksimple","portfolio_title_list_font_weight","","Font Weight","This is some description",$edgt_options_fontweight);
            $row2->addChild("portfolio_title_list_font_weight",$portfolio_title_list_font_weight);

            $row3 = new EdgeRow(true);
            $group11->addChild("row3",$row3);
            $portfolio_title_list_letter_spacing = new EdgeField("textsimple","portfolio_title_list_letter_spacing","","Letter Spacing (px)","This is some description");
            $row3->addChild("portfolio_title_list_letter_spacing",$portfolio_title_list_letter_spacing);

$category_text_styles = new EdgeTitle("category_text_styles","Category Text Styles");
$panel1->addChild("category_text_styles",$category_text_styles);

    $group8 = new EdgeGroup("Category Style for Standard and Pinterest Lists","Define category styles for standard and pinterest portfolio lists.");
    $panel1->addChild("group8",$group8);

         $row1 = new EdgeRow();
         $group8->addChild("row1",$row1);
            $portfolio_category_standard_list_color = new EdgeField("colorsimple","portfolio_category_standard_list_color","","Text Color","This is some description");
            $row1->addChild("portfolio_category_standard_list_color",$portfolio_category_standard_list_color);
            $portfolio_category_standard_list_font_size = new EdgeField("textsimple","portfolio_category_standard_list_font_size","","Font Size (px)","This is some description");
            $row1->addChild("portfolio_category_standard_list_font_size",$portfolio_category_standard_list_font_size);
            $portfolio_category_standard_list_line_height = new EdgeField("textsimple","portfolio_category_standard_list_line_height","","Line Height (px)","This is some description");
            $row1->addChild("portfolio_category_standard_list_line_height",$portfolio_category_standard_list_line_height);
            $portfolio_category_standard_list_text_transform = new EdgeField("selectblanksimple","portfolio_category_standard_list_text_transform","","Text Transform","This is some description",$edgt_options_texttransform);
            $row1->addChild("portfolio_category_standard_list_text_transform",$portfolio_category_standard_list_text_transform);

        $row2 = new EdgeRow(true);
        $group8->addChild("row2",$row2);
            $portfolio_category_standard_list_font_family = new EdgeField("fontsimple","portfolio_category_standard_list_font_family","-1","Font Family","This is some description");
            $row2->addChild("portfolio_category_standard_list_font_family",$portfolio_category_standard_list_font_family);
            $portfolio_category_standard_list_font_style = new EdgeField("selectblanksimple","portfolio_category_standard_list_font_style","","Font Style","This is some description",$edgt_options_fontstyle);
            $row2->addChild("portfolio_category_standard_list_font_style",$portfolio_category_standard_list_font_style);
            $portfolio_category_standard_list_font_weight = new EdgeField("selectblanksimple","portfolio_category_standard_list_font_weight","","Font Weight","This is some description",$edgt_options_fontweight);
            $row2->addChild("portfolio_category_standard_list_font_weight",$portfolio_category_standard_list_font_weight);
            $portfolio_category_standard_list_letter_spacing = new EdgeField("textsimple","portfolio_category_standard_list_letter_spacing","","Letter Spacing (px)","This is some description");
            $row2->addChild("portfolio_category_standard_list_letter_spacing",$portfolio_category_standard_list_letter_spacing);

    $group10 = new EdgeGroup("Category Style for Text on Hover Image and Text before Hover Lists","Define category styles for standard and pinterest portfolio lists.");
    $panel1->addChild("group10",$group10);

        $row1 = new EdgeRow();
        $group10->addChild("row1",$row1);
            $portfolio_category_hover_box_list_color = new EdgeField("colorsimple","portfolio_category_hover_box_list_color","","Text Color","This is some description");
            $row1->addChild("portfolio_category_hover_box_list_color",$portfolio_category_hover_box_list_color);
            $portfolio_category_hover_box_list_font_size = new EdgeField("textsimple","portfolio_category_hover_box_list_font_size","","Font Size (px)","This is some description");
            $row1->addChild("portfolio_category_hover_box_list_font_size",$portfolio_category_hover_box_list_font_size);
            $portfolio_category_hover_box_list_line_height = new EdgeField("textsimple","portfolio_category_hover_box_list_line_height","","Line Height (px)","This is some description");
            $row1->addChild("portfolio_category_hover_box_list_line_height",$portfolio_category_hover_box_list_line_height);
            $portfolio_category_hover_box_list_text_transform = new EdgeField("selectblanksimple","portfolio_category_hover_box_list_text_transform","","Text Transform","This is some description",$edgt_options_texttransform);
            $row1->addChild("portfolio_category_hover_box_list_text_transform",$portfolio_category_hover_box_list_text_transform);

        $row2 = new EdgeRow(true);
        $group10->addChild("row2",$row2);
            $portfolio_category_hover_box_list_font_family = new EdgeField("fontsimple","portfolio_category_hover_box_list_font_family","-1","Font Family","This is some description");
            $row2->addChild("portfolio_category_hover_box_list_font_family",$portfolio_category_hover_box_list_font_family);
            $portfolio_category_hover_box_list_font_style = new EdgeField("selectblanksimple","portfolio_category_hover_box_list_font_style","","Font Style","This is some description",$edgt_options_fontstyle);
            $row2->addChild("portfolio_category_hover_box_list_font_style",$portfolio_category_hover_box_list_font_style);
            $portfolio_category_hover_box_list_font_weight = new EdgeField("selectblanksimple","portfolio_category_hover_box_list_font_weight","","Font Weight","This is some description",$edgt_options_fontweight);
            $row2->addChild("portfolio_category_hover_box_list_font_weight",$portfolio_category_hover_box_list_font_weight);
            $portfolio_category_hover_box_list_letter_spacing = new EdgeField("textsimple","portfolio_category_hover_box_list_letter_spacing","","Letter Spacing (px)","This is some description");
            $row2->addChild("portfolio_category_hover_box_list_letter_spacing",$portfolio_category_hover_box_list_letter_spacing);



    $group12 = new EdgeGroup("Category Style for Portfolio Slider and Masonry Lists","Define category styles for slider and masonry portfolio lists.");
    $panel1->addChild("group12",$group12);

        $row1 = new EdgeRow();
        $group12->addChild("row1",$row1);
            $portfolio_category_list_color = new EdgeField("colorsimple","portfolio_category_list_color","","Text Color","This is some description");
            $row1->addChild("portfolio_category_list_color",$portfolio_category_list_color);
            $portfolio_category_list_font_size = new EdgeField("textsimple","portfolio_category_list_font_size","","Font Size (px)","This is some description");
            $row1->addChild("portfolio_category_list_font_size",$portfolio_category_list_font_size);
            $portfolio_category_list_line_height = new EdgeField("textsimple","portfolio_category_list_line_height","","Line Height (px)","This is some description");
            $row1->addChild("portfolio_category_list_line_height",$portfolio_category_list_line_height);
            $portfolio_category_list_text_transform = new EdgeField("selectblanksimple","portfolio_category_list_text_transform","","Text Transform","This is some description",$edgt_options_texttransform);
            $row1->addChild("portfolio_category_list_text_transform",$portfolio_category_list_text_transform);

        $row2 = new EdgeRow(true);
        $group12->addChild("row2",$row2);
            $portfolio_category_list_font_family = new EdgeField("fontsimple","portfolio_category_list_font_family","-1","Font Family","This is some description");
            $row2->addChild("portfolio_category_list_font_family",$portfolio_category_list_font_family);
            $portfolio_category_list_font_style = new EdgeField("selectblanksimple","portfolio_category_list_font_style","","Font Style","This is some description",$edgt_options_fontstyle);
            $row2->addChild("portfolio_category_list_font_style",$portfolio_category_list_font_style);
            $portfolio_category_list_font_weight = new EdgeField("selectblanksimple","portfolio_category_list_font_weight","","Font Weight","This is some description",$edgt_options_fontweight);
            $row2->addChild("portfolio_category_list_font_weight",$portfolio_category_list_font_weight);
            $portfolio_category_list_letter_spacing = new EdgeField("textsimple","portfolio_category_list_letter_spacing","","Letter Spacing (px)","This is some description");
            $row2->addChild("portfolio_category_list_letter_spacing",$portfolio_category_list_letter_spacing);


// Portfolio Filter
    $portfolio_filter = new EdgeTitle("portfolio_filter","Category Filter");
    $panel1->addChild("portfolio_filter",$portfolio_filter);

    $portfolio_list_filter_background_color = new EdgeField("color","portfolio_list_filter_background_color","","Background Color","Choose color for background of filter area",array(), array("col_width" => 3));
    $panel1->addChild("portfolio_list_filter_background_color",$portfolio_list_filter_background_color);

    $portfolio_list_filter_height = new EdgeField("text","portfolio_list_filter_height","","Height (px)","Enter height for filter area",array(), array("col_width" => 3));
    $panel1->addChild("portfolio_list_filter_height",$portfolio_list_filter_height);

    $portfolio_filter_margin_bottom = new EdgeField("text","portfolio_filter_margin_bottom","","Bottom Margin (px)","Enter bottom margin for filter area. Default value is 36",array(), array("col_width" => 3));
    $panel1->addChild("portfolio_filter_margin_bottom",$portfolio_filter_margin_bottom);

        $group2 = new EdgeGroup("Title","Define text styles for filter title");
        $panel1->addChild("group2",$group2);

            $row1 = new EdgeRow();
            $group2->addChild("row1",$row1);
                $portfolio_filter_title_color = new EdgeField("colorsimple","portfolio_filter_title_color","","Text Color","This is some description");
                $row1->addChild("portfolio_filter_title_color",$portfolio_filter_title_color);
                $portfolio_filter_title_font_size = new EdgeField("textsimple","portfolio_filter_title_font_size","","Font Size (px)","This is some description");
                $row1->addChild("portfolio_filter_title_font_size",$portfolio_filter_title_font_size);
                $portfolio_filter_title_line_height = new EdgeField("textsimple","portfolio_filter_title_line_height","","Line Height (px)","This is some description");
                $row1->addChild("portfolio_filter_title_line_height",$portfolio_filter_title_line_height);
                $portfolio_filter_title_text_transform = new EdgeField("selectblanksimple","portfolio_filter_title_text_transform","","Text Transform","This is some description",$edgt_options_texttransform);
                $row1->addChild("portfolio_filter_title_text_transform",$portfolio_filter_title_text_transform);

                $row2 = new EdgeRow(true);
                $group2->addChild("row2",$row2);
                $portfolio_filter_title_font_family = new EdgeField("fontsimple","portfolio_filter_title_font_family","-1","Font Family","This is some description");
                $row2->addChild("portfolio_filter_title_font_family",$portfolio_filter_title_font_family);
                $portfolio_filter_title_font_style = new EdgeField("selectblanksimple","portfolio_filter_title_font_style","","Font Style","This is some description",$edgt_options_fontstyle);
                $row2->addChild("portfolio_filter_title_font_style",$portfolio_filter_title_font_style);
                $portfolio_filter_title_font_weight = new EdgeField("selectblanksimple","portfolio_filter_title_font_weight","","Font Weight","This is some description",$edgt_options_fontweight);
                $row2->addChild("portfolio_filter_title_font_weight",$portfolio_filter_title_font_weight);
                $portfolio_filter_title_letter_spacing = new EdgeField("textsimple","portfolio_filter_title_letter_spacing","","Letter Spacing (px)","This is some description");
                $row2->addChild("portfolio_filter_title_letter_spacing",$portfolio_filter_title_letter_spacing);

        $group3 = new EdgeGroup("Categories","Define text styles for filter categories");
        $panel1->addChild("group3",$group3);

            $row1 = new EdgeRow();
            $group3->addChild("row1",$row1);
            $portfolio_filter_color = new EdgeField("colorsimple","portfolio_filter_color","","Text Color","This is some description");
            $row1->addChild("portfolio_filter_color",$portfolio_filter_color);
            $portfolio_filter_hovercolor = new EdgeField("colorsimple","portfolio_filter_hovercolor","","Hover/Active Color","This is some description");
            $row1->addChild("portfolio_filter_hovercolor",$portfolio_filter_hovercolor);
            $portfolio_filter_font_size = new EdgeField("textsimple","portfolio_filter_font_size","","Font Size (px)","This is some description");
            $row1->addChild("portfolio_filter_font_size",$portfolio_filter_font_size);
            $portfolio_filter_line_height = new EdgeField("textsimple","portfolio_filter_line_height","","Line Height (px)","This is some description");
            $row1->addChild("portfolio_filter_line_height",$portfolio_filter_line_height);

            $row2 = new EdgeRow(true);
            $group3->addChild("row2",$row2);
            $portfolio_filter_font_family = new EdgeField("fontsimple","portfolio_filter_font_family","-1","Font Family","This is some description");
            $row2->addChild("portfolio_filter_font_family",$portfolio_filter_font_family);
            $portfolio_filter_font_style = new EdgeField("selectblanksimple","portfolio_filter_font_style","","Font Style","This is some description",$edgt_options_fontstyle);
            $row2->addChild("portfolio_filter_font_style",$portfolio_filter_font_style);
            $portfolio_filter_font_weight = new EdgeField("selectblanksimple","portfolio_filter_font_weight","","Font Weight","This is some description",$edgt_options_fontweight);
            $row2->addChild("portfolio_filter_font_weight",$portfolio_filter_font_weight);
            $portfolio_filter_text_transform = new EdgeField("selectblanksimple","portfolio_filter_text_transform","","Text Transform","This is some description",$edgt_options_texttransform);
            $row2->addChild("portfolio_filter_text_transform",$portfolio_filter_text_transform);

            $row3 = new EdgeRow(true);
            $group3->addChild("row3",$row3);
            $portfolio_filter_letter_spacing = new EdgeField("textsimple","portfolio_filter_letter_spacing","","Letter Spacing (px)","This is some description");
            $row3->addChild("portfolio_filter_letter_spacing",$portfolio_filter_letter_spacing);

    $portfolio_filter_disable_separator = new EdgeField("yesno","portfolio_filter_disable_separator","yes","Disable Separator Between Categories","Disabling this option will remove separator between filter categories.",array(),array(
        "dependence" => true,
        "dependence_hide_on_yes" => "#edgtf_portfolio_filter_separator_container",
        "dependence_show_on_yes" => "",
        ));
    $panel1->addChild("portfolio_filter_disable_separator",$portfolio_filter_disable_separator);

    $portfolio_filter_separator_container = new EdgeContainer("portfolio_filter_separator_container","portfolio_filter_disable_separator","yes");
    $panel1->addChild("portfolio_filter_separator_container",$portfolio_filter_separator_container);

        $portfolio_filter_separator_color = new EdgeField("color","portfolio_filter_separator_color","","Separator Between Categories Color","Choose a color for separator between categories in filter");
        $portfolio_filter_separator_container->addChild("portfolio_filter_separator_color",$portfolio_filter_separator_color);


//ICONS STYLE
    $icons_style = new EdgeTitle("icons_style", "Icons");
    $panel1->addChild("icons_style", $icons_style);

    $portfolio_list_icons_pack = new EdgeField("select","portfolio_list_icons_pack","font-awesome","Font Family",'Choose font family for hover icons on portfolio', array(
        "font-awesome" => "Font Awesome",
        "font-elegant" => "Font Elegant"
    ));
    $panel1->addChild("portfolio_list_icons_pack",$portfolio_list_icons_pack);

    $portfolio_list_icons_size = new EdgeField("text","portfolio_list_icons_size","","Size (px)","Enter size for icons in portfolio list. Default value is 16",array(), array("col_width" => 3));
    $panel1->addChild("portfolio_list_icons_size",$portfolio_list_icons_size);

	$group4 = new EdgeGroup("Color","Choose color of the icons on project hover");
	$panel1->addChild("group4",$group4);

		$row1 = new EdgeRow();
		$group4->addChild("row1",$row1);
			$portfolio_list_icons_color = new EdgeField("colorsimple","portfolio_list_icons_color","","Color","This is some description");
			$row1->addChild("portfolio_list_icons_color",$portfolio_list_icons_color);
			$portfolio_list_icons_hover_color = new EdgeField("colorsimple","portfolio_list_icons_hover_color","","Hover Color","This is some description");
			$row1->addChild("portfolio_list_icons_hover_color",$portfolio_list_icons_hover_color);

    $group5 = new EdgeGroup("Background Color","Define icons background color styles on project hover");
    $panel1->addChild("group5",$group5);

        $row1 = new EdgeRow();
        $group5->addChild("row1",$row1);
			$portfolio_list_icons_background_color = new EdgeField("colorsimple","portfolio_list_icons_background_color","","Background Color","This is some description");
			$row1->addChild("portfolio_list_icons_background_color",$portfolio_list_icons_background_color);
			$portfolio_list_icons_background_hover_color = new EdgeField("colorsimple","portfolio_list_icons_background_hover_color","","Background Hover Color","This is some description");
			$row1->addChild("portfolio_list_icons_background_hover_color",$portfolio_list_icons_background_hover_color);

    $group6 = new EdgeGroup("Border","Define icons border styles on project hover");
    $panel1->addChild("group6",$group6);

		$row1 = new EdgeRow(true);
		$group6->addChild("row1",$row1);

			$portfolio_list_icons_border_color = new EdgeField("colorsimple","portfolio_list_icons_border_color","","Border Color","This is some description");
			$row1->addChild("portfolio_list_icons_border_color",$portfolio_list_icons_border_color);
			$portfolio_list_icons_border_hover_color = new EdgeField("colorsimple","portfolio_list_icons_border_hover_color","","Border Hover Color","This is some description");
			$row1->addChild("portfolio_list_icons_border_hover_color",$portfolio_list_icons_border_hover_color);
			$portfolio_list_icons_border_width = new EdgeField("textsimple","portfolio_list_icons_border_width","","Border Width (px)","This is some description");
			$row1->addChild("portfolio_list_icons_border_width",$portfolio_list_icons_border_width);
            $portfolio_list_icons_border_radius = new EdgeField("textsimple","portfolio_list_icons_border_radius","","Border Radius (px)","This is some description");
            $row1->addChild("portfolio_list_icons_border_radius",$portfolio_list_icons_border_radius);

    $portfolio_pinterest_style = new EdgeTitle("portfolio_pinterest_style", "Pinterest");
    $panel1->addChild("portfolio_pinterest_style", $portfolio_pinterest_style);

    $group24 = new EdgeGroup("Pinterest Padding","Define pinterest padding");
    $panel1->addChild("group24",$group24);

        $row1 = new EdgeRow(true);
        $group24->addChild("row1",$row1);

        $pinterest_padding_left = new EdgeField("textsimple","pinterest_padding_left","","Padding Left (px)","This is some description");
        $row1->addChild("pinterest_padding_left",$pinterest_padding_left);

        $pinterest_padding_right = new EdgeField("textsimple","pinterest_padding_right","","Padding Right (px)","This is some description");
        $row1->addChild("pinterest_padding_right",$pinterest_padding_right);

        $pinterest_padding_top = new EdgeField("textsimple","pinterest_padding_top","","Padding Top (px)","This is some description");
        $row1->addChild("pinterest_padding_top",$pinterest_padding_top);

        $pinterest_padding_bottom = new EdgeField("textsimple","pinterest_padding_bottom","","Padding Bottom (px)","This is some description");
        $row1->addChild("pinterest_padding_bottom",$pinterest_padding_bottom);

    $portfolio_masonry_style = new EdgeTitle("portfolio_masonry_style", "Masonry");
    $panel1->addChild("portfolio_masonry_style", $portfolio_masonry_style);

    $portfolio_masonry_with_padding_width = new EdgeField("text","portfolio_masonry_with_padding_width","","Space Width (px)","Enter space width for Masonry if space is enabled. Default value is 10",array(), array("col_width" => 3));
    $panel1->addChild("portfolio_masonry_with_padding_width",$portfolio_masonry_with_padding_width);

    $thin_plus_only_style = new EdgeTitle("thin_plus_only_style", "Thin Plus Only");
    $panel1->addChild("thin_plus_only_style", $thin_plus_only_style);

    $group13 = new EdgeGroup("Cursor","Define styles for Cursor on Thin Plus Only hover type");
    $panel1->addChild("group13",$group13);

        $row1 = new EdgeRow();
        $group13->addChild("row1",$row1);
            $thin_plus_only_style_color = new EdgeField("colorsimple","thin_plus_only_style_color","","Color","This is some description");
            $row1->addChild("thin_plus_only_style_color",$thin_plus_only_style_color);
            $thin_plus_only_style_size = new EdgeField("textsimple","thin_plus_only_style_size","","Font Size (px)","This is some description");
            $row1->addChild("thin_plus_only_style_size",$thin_plus_only_style_size);
            $thin_plus_only_style_weight = new EdgeField("selectblanksimple","thin_plus_only_style_weight","","Font Weight","This is some description",$edgt_options_fontweight);
            $row1->addChild("thin_plus_only_style_weight",$thin_plus_only_style_weight);

    $animated_border_hover_style = new EdgeTitle("animated_border_hover_style", "Animated Border");
    $panel1->addChild("animated_border_hover_style", $animated_border_hover_style);

    $group23 = new EdgeGroup("Border Hover","Define styles for border on Animated Border hover type");
    $panel1->addChild("group23",$group23);

        $row1 = new EdgeRow();
        $group23->addChild("row1",$row1);
            $animated_border_hover_color = new EdgeField("colorsimple","animated_border_hover_color","","Color","This is some description");
            $row1->addChild("animated_border_hover_color",$animated_border_hover_color);
            $animated_border_hover_width = new EdgeField("textsimple","animated_border_hover_width","","Width (px)","This is some description");
            $row1->addChild("animated_border_hover_width",$animated_border_hover_width);

    $group27 = new EdgeGroup("Border Padding","Define padding for border on Animated Border hover type");
    $panel1->addChild("group27",$group27);

        $row1 = new EdgeRow();
        $group27->addChild("row1",$row1);
            $animated_border_hover_padding_top_bottom = new EdgeField("textsimple","animated_border_hover_padding_top_bottom","","Top - Bottom ('px' or '%')","This is some description");
            $row1->addChild("animated_border_hover_padding_top_bottom",$animated_border_hover_padding_top_bottom);
            $animated_border_hover_padding_left_right = new EdgeField("textsimple","animated_border_hover_padding_left_right","","Left - Right ('px' or '%')","This is some description");
            $row1->addChild("animated_border_hover_padding_left_right",$animated_border_hover_padding_left_right);


    $animated_border_disable_animation = new EdgeField("yesno","animated_border_disable_animation","no","Disable Animation","Enabling this option will turn off border animation on hover");
    $panel1->addChild("animated_border_disable_animation",$animated_border_disable_animation);

    $border_with_pattern_style = new EdgeTitle("border_with_pattern_style", "Border With Pattern");
    $panel1->addChild("border_with_pattern_style", $border_with_pattern_style);

    $group26 = new EdgeGroup('Pattern style', 'Define Pattern Image Overlay Style');
    $panel1->addChild('$group26', $group26);

        $row1 = new EdgeRow();
        $group26->addChild('row1', $row1);
            $border_with_pattern_color = new EdgeField('colorsimple', 'border_with_pattern_color', '', 'Color');
            $row1->addChild('border_with_pattern_color', $border_with_pattern_color);
            $border_with_pattern_border_pattern = new EdgeField("imagesimple","border_with_pattern_border_pattern","","Border Pattern","This is some description");
            $row1->addChild("border_with_pattern_border_pattern",$border_with_pattern_border_pattern);
            $border_with_pattern_border_width = new EdgeField("textsimple","border_with_pattern_border_width","","Border Width (px)","This is some description");
            $row1->addChild("border_with_pattern_border_width",$border_with_pattern_border_width);

//Portfolio Single Project

$panel2 = new EdgePanel("Portfolio Single", "porfolio_single_project");
$portfolioPage->addChild("panel2",$panel2);

	$portfolio_style = new EdgeField("select","portfolio_style","small-images","Portfolio Type",'Choose a default type for Single Project pages', array(
		"small-images" => "Portfolio small images",
		"small-slider" => "Portfolio small slider",
		"big-images" => "Portfolio big images",
		"big-slider" => "Portfolio big slider",
		"custom" => "Portfolio custom",
		"full-width-custom" => "Portfolio full width custom",
		"gallery" => "Portfolio gallery"
      ));
	$panel2->addChild("portfolio_style",$portfolio_style);

    $group3 = new EdgeGroup("Portfolio Overlay Color","Define color and opacity for overlay color");
    $panel2->addChild("group3",$group3);

        $row1 = new EdgeRow();
        $group3->addChild("row1",$row1);

            $portfolio_gallery_overlay_color = new EdgeField("colorsimple","portfolio_gallery_overlay_color","","Color","This is some description");
            $row1->addChild("portfolio_gallery_overlay_color",$portfolio_gallery_overlay_color);

            $portfolio_gallery_overlay_transparency = new EdgeField("textsimple","portfolio_gallery_overlay_transparency","","Transparency (px)","This is some description");
            $row1->addChild("portfolio_gallery_overlay_transparency",$portfolio_gallery_overlay_transparency);


    $portfolio_gallery_image_hover_style = new EdgeField("select","portfolio_gallery_image_hover_style","magnifier","Portfolio Image Hover",'Choose a default hover type for Single Project pages', array(
        "disable" => "None",
        "magnifier" => "Magnifier",
        "icon" => "Icon",
        "text" => "Image Title"
    ),
        array("dependence" => true,
            "hide" => array(
                "disable"=>"#edgtf_portfolio_gallery_image_hover_separator_container,#edgtf_portfolio_gallery_image_hover_icon_container",
                "magnifier"=>"#edgtf_portfolio_gallery_image_hover_separator_container,#edgtf_portfolio_gallery_image_hover_icon_container",
                "icon"=>"#edgtf_portfolio_gallery_image_hover_separator_container",
                "text"=>"#edgtf_portfolio_gallery_image_hover_icon_container"),
            "show" => array(
                "disable"=>"",
                "magnifier"=>"",
                "icon"=>"#edgtf_portfolio_gallery_image_hover_icon_container",
                "text"=>"#edgtf_portfolio_gallery_image_hover_separator_container")
        ));
    $panel2->addChild("portfolio_gallery_image_hover_style",$portfolio_gallery_image_hover_style);

        $portfolio_gallery_image_hover_separator_container = new EdgeContainer("portfolio_gallery_image_hover_separator_container","portfolio_gallery_image_hover_style","magnifier",array("disable","magnifier","icon"));
        $panel2->addChild("portfolio_gallery_image_hover_separator_container",$portfolio_gallery_image_hover_separator_container);

            $portfolio_gallery_image_hover_separator = new EdgeField("select","portfolio_gallery_image_hover_separator","","Separator below image title","This option will place separator below text", array(
                "yes" => "Yes",
                "no" => "No"
            ), array("col_width" => 3));
            $portfolio_gallery_image_hover_separator_container->addChild("portfolio_gallery_image_hover_separator",$portfolio_gallery_image_hover_separator);

            $portfolio_gallery_overlay_text_color = new EdgeField("color","portfolio_gallery_overlay_text_color","","Text Color","Choose a color for overlay text in Single Project pages");
            $portfolio_gallery_image_hover_separator_container->addChild("portfolio_gallery_overlay_text_color",$portfolio_gallery_overlay_text_color);

        $portfolio_gallery_image_hover_icon_container = new EdgeContainer("portfolio_gallery_image_hover_icon_container","portfolio_gallery_image_hover_style","magnifier",array("disable","magnifier","text"));
        $panel2->addChild("portfolio_gallery_image_hover_icon_container",$portfolio_gallery_image_hover_icon_container);

            $group4 = new EdgeGroup("Portfolio Image Hover Icon","Define style for Portfolio Image Hover Icon");
            $portfolio_gallery_image_hover_icon_container->addChild("group4",$group4);

            $row1 = new EdgeRow();
            $group4->addChild("row1",$row1);

                $portfolio_gallery_icon_pack = new EdgeField("selectsimple","portfolio_gallery_icon_pack","font-awesome","Font Family",'This is some description', array(
                    "font-awesome" => "Font Awesome",
                    "font-elegant" => "Font Elegant"
                ));
                $group4->addChild("portfolio_gallery_icon_pack",$portfolio_gallery_icon_pack);

                    $portfolio_gallery_icon_size = new EdgeField("textsimple","portfolio_gallery_icon_size","","Size","This is some description");
                $group4->addChild("portfolio_gallery_icon_size",$portfolio_gallery_icon_size);

                $portfolio_gallery_icon_color = new EdgeField("colorsimple","portfolio_gallery_icon_color","","Color","This is some description");
                $group4->addChild("portfolio_gallery_icon_color",$portfolio_gallery_icon_color);

    $group1 = new EdgeGroup("Title Style","Define title styles on project.");
    $panel2->addChild("group1",$group1);

        $row1 = new EdgeRow();
        $group1->addChild("row1",$row1);

            $portfolio_title_tag = new EdgeField("selectsimple","portfolio_title_tag","h3","Tag element",'This is some description', array(
                "h2" => "h2",
                "h3" => "h3",
                "h4" => "h4",
                "h5" => "h5"
            ));
            $row1->addChild("portfolio_title_tag",$portfolio_title_tag);

            $portfolio_title_margin_bottom = new EdgeField("textsimple","portfolio_title_margin_bottom","","Margin Bottom (px)","This is some description");
            $row1->addChild("portfolio_title_margin_bottom",$portfolio_title_margin_bottom);

            $portfolio_title_color = new EdgeField("colorsimple","portfolio_title_color","","Text Color","This is some description");
            $row1->addChild("portfolio_title_color",$portfolio_title_color);

    $group2 = new EdgeGroup("Additional Portfolio Titles","Define additional portfolio titles styles on project.");
    $panel2->addChild("group2",$group2);

        $row1 = new EdgeRow();
        $group2->addChild("row1",$row1);

            $portfolio_info_tag = new EdgeField("selectsimple","portfolio_info_tag","h6","Tag element",'This is some description', array(
                "h4" => "h4",
                "h5" => "h5",
                "h6" => "h6"
            ));
            $row1->addChild("portfolio_info_tag",$portfolio_info_tag);

            $portfolio_info_margin_bottom = new EdgeField("textsimple","portfolio_info_margin_bottom","","Margin Bottom (px)","This is some description");
            $row1->addChild("portfolio_info_margin_bottom",$portfolio_info_margin_bottom);

            $portfolio_info_color = new EdgeField("colorsimple","portfolio_info_color","","Text Color","This is some description");
            $row1->addChild("portfolio_info_color",$portfolio_info_color);

	$lightbox_single_project = new EdgeField("yesno","lightbox_single_project","yes","Lightbox for Images","Enabling this option will turn on lightbox functionality for projects with images.");
	$panel2->addChild("lightbox_single_project",$lightbox_single_project);

	$lightbox_video_single_project = new EdgeField("yesno","lightbox_video_single_project","no","Lightbox for Videos","Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects.");
	$panel2->addChild("lightbox_video_single_project",$lightbox_video_single_project);

	$portfolio_hide_categories = new EdgeField("yesno","portfolio_hide_categories","no","Hide Categories","Enabling this option will disable category meta description on Single Projects.");
	$panel2->addChild("portfolio_hide_categories",$portfolio_hide_categories);

	$portfolio_hide_date = new EdgeField("yesno","portfolio_hide_date","no","Hide Date","Enabling this option will disable date meta on Single Projects.");
	$panel2->addChild("portfolio_hide_date",$portfolio_hide_date);

	$portfolio_hide_comments = new EdgeField("yesno","portfolio_hide_comments","yes","Hide Comments","Enabling this option will turn off comments functionality.");
	$panel2->addChild("portfolio_hide_comments",$portfolio_hide_comments);

	$portfolio_hide_share = new EdgeField("yesno","portfolio_hide_share","no","Hide Share","Enabling this option will turn off share functionality.");
	$panel2->addChild("portfolio_hide_share",$portfolio_hide_share);

	$portfolio_hide_like = new EdgeField("yesno","portfolio_hide_like","no","Hide Like","Enabling this option will turn off like functionality.");
	$panel2->addChild("portfolio_hide_like",$portfolio_hide_like);

	$portfolio_enable_pattern = new EdgeField("yesno","portfolio_enable_pattern","yes","Enable Pattern","Enabling pattern on Like and Share holder",array(),array(
		"dependence" => true,
		"dependence_hide_on_yes" => "",
		"dependence_show_on_yes" => "#edgtf_portfolio_info_pattern_holder",
		));
	$panel2->addChild("portfolio_enable_pattern",$portfolio_enable_pattern);

	$portfolio_info_pattern_holder = new EdgeContainer("portfolio_info_pattern_holder","portfolio_enable_pattern","no");
	$panel2->addChild("portfolio_info_pattern_holder",$portfolio_info_pattern_holder);

		$portfolio_info_pattern = new EdgeField("image","portfolio_info_pattern","","Pattern","Choose pattern for Like and Share holder");
		$portfolio_info_pattern_holder->addChild("portfolio_info_pattern",$portfolio_info_pattern);

	$portfolio_text_follow = new EdgeField("portfoliofollow","portfolio_text_follow","portfolio_single_follow","Sticky Side Text ","Enabling this option will make side text sticky on Single Project pages");
	$panel2->addChild("portfolio_text_follow",$portfolio_text_follow);

	$portfolio_hide_pagination = new EdgeField("yesno","portfolio_hide_pagination","no","Hide Pagination","Enabling this option will turn off portfolio pagination functionality.", array(), array("dependence" => true, "dependence_hide_on_yes" => "#edgtf_portfolio_hide_pagination_container", "dependence_show_on_yes" => ""));
	$panel2->addChild("portfolio_hide_pagination",$portfolio_hide_pagination);

	$portfolio_hide_pagination_container = new EdgeContainer("portfolio_hide_pagination_container","portfolio_hide_pagination","yes");
	$panel2->addChild("portfolio_hide_pagination_container",$portfolio_hide_pagination_container);

		$portfolio_navigation_through_same_category = new EdgeField("yesno","portfolio_navigation_through_same_category","no","Enable Pagination Through Same Category","Enabling this option will make portfolio pagination sort through current category.");
		$portfolio_hide_pagination_container->addChild("portfolio_navigation_through_same_category",$portfolio_navigation_through_same_category);

		$portfolio_navigation_border_color = new EdgeField("color","portfolio_navigation_border_color","","Border Top Color","Choose border top color for navigation");
		$portfolio_hide_pagination_container->addChild("portfolio_navigation_border_color",$portfolio_navigation_border_color);

		$portfolio_navigation_border_width = new EdgeField("text","portfolio_navigation_border_width","","Border Top Width (px)","Choose border top width for navigation",array(),array("col_width" => 3));
		$portfolio_hide_pagination_container->addChild("portfolio_navigation_border_width",$portfolio_navigation_border_width);


    $portfolio_box = new EdgeField("yesno","portfolio_box","yes","Enable Box Holder","Enabling this option will place box holder on project. This option works only if Portfolio style is Big Images, Big Slider or Gallery", array(), array("dependence" => true, "dependence_hide_on_yes" => "#edgtf_portfolio_without_box_container", "dependence_show_on_yes" => "#edgtf_portfolio_box_container"));
    $panel2->addChild("portfolio_box",$portfolio_box);

    $portfolio_box_container = new EdgeContainer("portfolio_box_container","portfolio_box","no");
    $panel2->addChild("portfolio_box_container",$portfolio_box_container);

        $portfolio_box_background_color = new EdgeField("color","portfolio_box_background_color","","Background Color","Default color is #ffffff");
        $portfolio_box_container->addChild("portfolio_box_background_color",$portfolio_box_background_color);

        $portfolio_box_lr_padding = new EdgeField("text","portfolio_box_lr_padding","","Padding(px)","Format: 10px 5px 10px 8px (Default value is 46px 26px 45px 26px)", array(), array("col_width" => 3));
        $portfolio_box_container->addChild("portfolio_box_lr_padding",$portfolio_box_lr_padding);

    $portfolio_without_box_container = new EdgeContainer("portfolio_without_box_container","portfolio_box","yes");
    $panel2->addChild("portfolio_without_box_container",$portfolio_without_box_container);

        $portfolio_box_top_padding = new EdgeField("text","portfolio_box_top_padding","","Top Padding(px)","Default value is 46", array(), array("col_width" => 3));
        $portfolio_without_box_container->addChild("portfolio_box_top_padding",$portfolio_box_top_padding);

	$portfolio_columns_number = new EdgeField("select","portfolio_columns_number","2","Number of Columns",'Enter the number of columns for Portfolio Gallery type', array( "2" => "2 columns",
       "3" => "3 columns",
       "4" => "4 columns"
      ));
	$panel2->addChild("portfolio_columns_number",$portfolio_columns_number);

	$portfolio_single_slug = new EdgeField("text","portfolio_single_slug","","Portfolio Single Slug",'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect) ', array(), array("col_width" => 3));
	$panel2->addChild("portfolio_single_slug",$portfolio_single_slug);

    /*Navigation*/

$portfolio_navigation_title = new EdgeTitle("portfolio_navigation_title","Navigation");
    $panel2->addChild("portfolio_navigation_title",$portfolio_navigation_title);
    
        $group16 = new EdgeGroup("Icon Arrow Style","Define navigation arrow style");
        $panel2->addChild("group16",$group16);

            $row1 = new EdgeRow();
            $group16->addChild("row1",$row1);               

                $portfolio_single_navigation_arrow_color = new EdgeField("colorsimple","portfolio_single_navigation_arrow_color","","Arrow Color","This is some description");
                $row1->addChild("portfolio_single_navigation_arrow_color",$portfolio_single_navigation_arrow_color);     

                $portfolio_single_navigation_arrow_hover_color = new EdgeField("colorsimple","portfolio_single_navigation_arrow_hover_color","","Arrow Hover Color","This is some description");
                $row1->addChild("portfolio_single_navigation_arrow_hover_color",$portfolio_single_navigation_arrow_hover_color);

        $group22 = new EdgeGroup("Back To Button style", "Choose color and hover color");
        $panel2->addChild("group22",$group22);

            $row1 = new EdgeRow();
            $group22->addChild("row1",$row1);

                $portfolio_back_to_button_icon_color = new EdgeField("colorsimple","portfolio_back_to_button_icon_color","","Color","This is some description");
                $row1->addChild("portfolio_back_to_button_icon_color",$portfolio_back_to_button_icon_color);

                $portfolio_back_to_button_icon_hover_color = new EdgeField("colorsimple","portfolio_back_to_button_icon_hover_color","","Hover Color","This is some description");
                $row1->addChild("portfolio_back_to_button_icon_hover_color",$portfolio_back_to_button_icon_hover_color);