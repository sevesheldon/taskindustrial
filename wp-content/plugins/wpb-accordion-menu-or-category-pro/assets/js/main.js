jQuery(function($){ 

	/**
	 * Auto Open Parent with Sub Menu 
	 */
	
	$('.wpb_category_n_menu_accordion.wpb_wcma_manu_parent_open_on > ul > li.wpb-wmca-menu-item-has-children > ul').show();
	$('.wpb_category_n_menu_accordion.wpb_wcma_manu_parent_open_on > ul > li.wpb-wmca-menu-item-has-children').addClass('wpb-submenu-indicator-minus');


	/**
	 * Auto Open All the Parent Cats with Sub Cat
	 */
	
	$('.wpb_category_n_menu_accordion.wpb_wcma_cat_parent_open_on > ul > li.cat-item-have-child > ul').show();
	$('.wpb_category_n_menu_accordion.wpb_wcma_cat_parent_open_on > ul > li.cat-item-have-child').addClass('wpb-submenu-indicator-minus');


	/**
	 * Keep Current Menu Open
	 */

	$('.wpb_category_n_menu_accordion.wpb_wmca_current_menu_open_on .current-menu-item').parents('ul.sub-menu').show();
	$('.wpb_category_n_menu_accordion.wpb_wmca_current_menu_open_on .current-menu-item').parents('li.menu-item-has-children').addClass('wpb-submenu-indicator-minus');

	/**
	 * Keep Current Menu Close
	 */

	$('.wpb_category_n_menu_accordion.wpb_wmca_current_menu_open_off .current-menu-item').parents('ul.sub-menu').hide();
	$('.wpb_category_n_menu_accordion.wpb_wmca_current_menu_open_off .current-menu-item').parents('li.menu-item-has-children').removeClass('wpb-submenu-indicator-minus');


	/**
	 * Keep Selected Menu Open
	 */
	$('.wpb_category_n_menu_accordion.wpb_wmca_current_menu_open_on > ul li.wpb-wmca-menu-item-has-children.wpb_wmca_menu_item_keep_open > ul').show();
	$('.wpb_category_n_menu_accordion.wpb_wmca_current_menu_open_on > ul li.wpb-wmca-menu-item-has-children.wpb_wmca_menu_item_keep_open').addClass('wpb-submenu-indicator-minus');


	/**
	 * Keep Current Category Open
	 */
	
	$('.wpb_category_n_menu_accordion.wpb_wmca_current_cat_open_on .current-cat').parents('ul.children').show();
	$('.wpb_category_n_menu_accordion.wpb_wmca_current_cat_open_on .current-cat').parents('li.cat-item-have-child').addClass('wpb-submenu-indicator-minus');

	/**
	 * Keep Current Category close
	 */
	
	$('.wpb_category_n_menu_accordion.wpb_wmca_current_cat_open_off .current-cat').parents('ul.children').hide();
	$('.wpb_category_n_menu_accordion.wpb_wmca_current_cat_open_off .current-cat').parents('li.cat-item-have-child').removeClass('wpb-submenu-indicator-minus');
	
});