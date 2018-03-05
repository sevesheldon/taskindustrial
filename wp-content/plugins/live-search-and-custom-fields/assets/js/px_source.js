
if ( getCookie('px_new_custom_post') ) {
	var cookieAddedNewCustomPost = getCookie('px_new_custom_post');
	if ( cookieAddedNewCustomPost == 1 ) {
		alert("A new Custom Post Type was added!\nPlease reset your Permalinks to avoid 404 on new created custom post type");
	}
	document.cookie = 'px_new_custom_post=0';

}

var $j = jQuery;
$j(document).ready(function(){
    
	var filterCallbacks = new ajaxCallbacks();
		
    var adminPanel = new PX_pluginLF();
	
    	filterCallbacks.template = adminPanel.template;
		adminPanel.callbacks = filterCallbacks;
		adminPanel.init();
    
	var wpMedia = new mediaLibrary();

    var customFields = new PX_customFields();
		customFields.wpMediaLibrary = wpMedia;
		customFields.init();

    
    
	var GeneralSettings = new LscfSettings();
		GeneralSettings.init();
		GeneralSettings.saveSettings();

		LscfWooCommerce.prototype.init_tax_subcategories = function(){			
			return filterCallbacks.init_tax_subcategories();
		}

    $j(".initCalendar").datepicker();
	$j(".lscf-colorpick").colorPicker();

    
});

var isStep2Active = new is_step2_active();
function is_step2_active() {
    
    var $j = jQuery,
        called = false;
    
    return function () {
        
        if (!called) {

            called = true;
            
            $j('.step2 input[type="checkbox"]').each(function () {
        
                $j(this).click(function () {

                    $j('.step2 input[type="checkbox"]').each(function () {
                        
                        var isChecked = ($j(this).attr("checked") ? 1 : 0);
                        
                        $j(".step2").addClass("active");

                        if (isChecked == 1) return false;
                        
                    })
                })
            });    
        }
        
    }
    
}

var LscfWooComm = new LscfWooCommerce();

function LscfWooCommerce(){

	var $j =jQuery,
		self = this,
		plugin_url = adminData.lscf_url

	this.template = {
		"type":"woocommerce",
		"tax":{
			"headline":"WooCommerce data filter",
			"items":[],
			"templateUrl":plugin_url + 'assets/js/templates/filter/tax-woocommerce-template.html'

		}
	}

	this.init_tax_subcategories;

	this.callbacks = {};

	this.callbacks.getPostTaxonomies = function( data ){

		var categsTemplate = '<h4>WooCommerce data filter </h4>';
        var count = 0;

		self.template.tax.items = [];

        $j("#px_post_categories").html(categsTemplate);
        
        data.forEach(function (tax) {
			
			var skip = true;
			
			if ( 'undefined' !== typeof tax.parent_categs ) {
			
				var taxTemplate = {};
				taxTemplate.index = count;
				taxTemplate.name = tax.taxonomy.replace('pa_', '').replace( '_', ' ' );
				taxTemplate.taxonomy = tax.taxonomy;
				taxTemplate.unsorted_subcategories = tax.unsorted_subcategs;
				taxTemplate.hasThumb = 0;

				switch ( tax.taxonomy ) {

					default:

						taxTemplate.type = 'attribute';

						if ( tax.taxonomy.match(/^pa_(.*)/) ) {
							
							skip = false;
							taxTemplate.hasThumb = 1;

							var attributeType = tax.taxonomy.match(/^pa_(.*)/);
							var title = attributeType[1].replace( /\b\w/g, function(l){ return l.toUpperCase() } );
							var headline = '<label>Filter by</label> Product Attributes - <strong>' + title + '</strong></span><br/>';

						}
						
						break;

					case 'product_type':
						skip = false;
						var title = 'Product Types';
						var headline = '<label>Filter by</label> <strong>Product Type</strong></span><br/>';

					break;

					case 'product_cat':
						skip = false;
						var title = 'Product Categories';
						var headline = '<label>Filter by</label> <strong>Product Categories</strong></span><br/>';

					break;

					case 'product_tag':
						skip = false;
						var title = 'Product Tags';
						var headline = '<label>Filter by</label> <strong>Product Tags</strong></span><br/>';

					break;

				}

				if ( false == skip  ) {
					
					taxTemplate.headline = headline;
					taxTemplate.title = title;
					taxTemplate.categs = [];
					
					if ( 'undefined' !== typeof tax.parent_categs && null !== tax.parent_categs  ) {

					
						
						tax.parent_categs.forEach(function(categ, index){
						
							var className = '';
							
							if ( 'undefined' !== typeof categ.has_subcategories && 1 === categ.has_subcategories && 'undefined' !== typeof categ.data ) {
								
								className = 'has-subcategs';
								categ.subcategs = {
									"parent_name": categ.data.name,
									"parent_id":categ.data.term_id,
									"list":"",
									"items":[]
								};

								var j = 0;
								tax.subcategs[categ.data.term_id].forEach(function(subcateg){
									
									if ( j <= 5 ) {
										categ.subcategs.list += subcateg.name + ', ';
									}
									categ.subcategs.items.push( subcateg );

									j++;
								});

								categ.subcategs.list = categ.subcategs.list.substring( 0, categ.subcategs.list.length -2  ) + '..';

							} else {
								categ.subcategs = false;
							};

							categ.className = className;
							taxTemplate.categs.push(categ);
						});


						taxTemplate.has_subcategories = ( 'undefined' !== typeof tax.has_subcategories ? tax.has_subcategories : 0 );

						taxTemplate.subcategs = ( 'undefined' !== typeof tax.subcategs ? tax.subcategs : '' );

						self.template.tax.items.push( taxTemplate );
						
						count++;
					}
				}
				
			}

        });

		$j.get( self.template.tax.templateUrl, function( template ) {

			var renderedTemplate = Mustache.render( $j( template ).filter('#template-tax-woocommerce').html(), self.template.tax );

			$j("#px_post_categories").html( renderedTemplate );

			for ( var i = 0; i < count; i++ ) {
				checkAllCheckboxes( $j( '.px-post-tax' + i + ' .tax-categories-container' ) );
				checkAllCheckboxes( $j( '.px-post-tax' + i + ' .tax-subcategories-display' ), true );
			}
			
			setTimeout(function(){
				isStep2Active();
			}, 400);

			init_custom_dropdown( $j('.post-categories-group') );
			
			setTimeout(function(){
				self.init_tax_subcategories();
				lscf_taxonomies_subcategories_view_type();
			}, 400);

		});

		
		if (count == 0)
            $j(".post-categories-group .expandable-container-headline").addClass("inactive");
        else 
            $j(".post-categories-group .expandable-container-headline").removeClass("inactive");

	}
	
	return {
		"callbacks":self.callbacks
	}

}

function PX_pluginLF(){
    
    var self = this,
        action = "px-plugin-ajax",
        ajaxURL = adminData.ajaxURL;

	this.postType = '';

	this.callbacks;

	this.template = {
		"tax":{
			"items":[],
			"templateUrl" : adminData.lscf_url + 'assets/js/templates/filter/tax-template.html'
		},
		"tax_subcategs":{
			"items":{},
			"templateUrl" : adminData.lscf_url + 'assets/js/templates/filter/tax-subcategs-template.html'
		},
		"custom_fields":{
			"items":{},
			"templateUrl" : adminData.lscf_url + 'assets/js/templates/filter/custom-fields-template.html'

		},
		"additional_fields":{
			items:[]
		}
	}

	this.isWooCommerce = false;

    this.init = function(){

        self.removeAdditionalFilterFields(); 
        self.sanitizeAdditionalFilterFieldsName();

        // Bind Function for Filter's additional fields 
        self.addAdditionalFields();   

		$j('#px_filter-name-shorcode-generator').keydown(function(event){
			if(event.keyCode == 13) {
				event.preventDefault();
			return false;
			}
		});

		var filterNameInputElement = document.getElementById("px_filter-name-shorcode-generator");

		if( null !== filterNameInputElement && filterNameInputElement.length > 0 ) {
		 
			document.getElementById("px_filter-name-shorcode-generator").onkeydown = function(event){
				
				if ( 13 == event.keyCode ) {
					
					if ( $j("#px_filter-name-shorcode-generator").val() === '' ) {
					
						$j("#px_filter_name_error").fadeIn();

						return false;
					}
					$j("#goToFilterFields").hide();
					$j("#px_filter_name_error").hide();
					$j(".lscf-step-2").fadeIn();
					$j('#active-shortcodes-list').hide();
				}
			}
		}

        $j("#goToFilterFields").click(function () {
            
			if ($j("#px_filter-name-shorcode-generator").val() === '') {
                
                $j("#px_filter_name_error").fadeIn();

                return false;
            }

			$j("#px_filter_name_error").hide();
            $j(this).hide();
            $j(".lscf-step-2").fadeIn();
            $j('#active-shortcodes-list').hide();
                
        });

		$j('.cf-remove-custom-post').each(function(){
	
			$j(this).click(function(event){

				event.stopPropagation();
				event.preventDefault();

				var parentRow = $j(this).closest(".px-post-type-row");
				var customPost_key = $j(this).closest(".px-post-type-row").data("key");
				var confirmDelete = confirm("Are you sure you want to remove the custom post type?");

				if( true === confirmDelete ) {

					self.removeCustomPostType_ajaxRequest( customPost_key, function(){
						parentRow.remove();
					});

				}


			});

		});

        $j(".remove-custom-post").each(function (index){
            
           $j(this).click(function (){
               
               var data = $j(this).parent().data("key");
               
               self.removeCustomPostType_ajaxRequest( data, function(){
				   window.location.reload();
			   });
               
           })
            
        });
        
        
        $j("#create-new-custom-post").click(function () {
            
            var name = $j("#customPostName").val();
            
            if (typeof name !== 'undefined' && name!='') {
                
                self.addNewCustomPostType_ajaxRequest(name);    
                
            }
            
        });

        $j(".expandable-container-headline").each(function (c) {
            
            $j(this).click(function () {
                
                if ($j(this).hasClass("inactive")) return;
                
                
                if ($j(this).hasClass("active"))
                    $j(this).removeClass("active");

                else
                    $j(this).addClass("active");

                
                if ($j(".expandable-container").eq(c).hasClass("active")) {
                    
                    $j(".expandable-container").eq(c).css({ 'min-height': '0px'});
                    
                    $j(".expandable-container").eq(c).animate({
                        height: "0px"
                    }, 300, function () {
                        $j(".expandable-container").eq(c).removeClass("active");    
                    });

                }
                    
                else {

                    $j(".expandable-container").eq(c).addClass("active");
                    
                    var heightToAnimate = $j(".expandable-container").eq(c).find(".data-container").height();

					heightToAnimate = ( heightToAnimate < 170 ? '180' : heightToAnimate );

                    $j(".expandable-container").eq(c).animate({
                        height: Math.round(heightToAnimate)
                    }, 300, function () {
                        
						$j(".expandable-container").eq(c).css({"min-height":heightToAnimate+"px", "height":"auto"});
						
						if ( $j('.expandable-container').eq(c).hasClass('filter-display-settings') && ! $j('.expandable-container').eq(c).hasClass('slick-active') ) {
							
							$j('.expandable-container').eq(c).addClass('slick-active')
							
							setTimeout(function(){
								$j(".theme-options-slider").slick({
									infinite:false
								});
							}, 200);	
							
						}

                    });

                }


            });
        })
        
        setTimeout(function () {
            
            $j(".px_lf_post-type").find('.pxselect-options li').each(function () {
            
                $j(this).click(function () {
                    
                    var val = $j(this).attr("rel");
					var postName = $j(this).text();
					
					if( 'Products(WooCommerce)' === postName ) {
						$j('#px-filter-for').val('woocommerce');
						self.isWooCommerce = true;
					} else {
						$j('#px-filter-for').val('custom-posts');
						self.isWooCommerce = false;
					}
                    
					self.callbacks.isWooCommerce = self.isWooCommerce;

					$j("#px_additional-fields-container").empty();
                    
                    if (val != 0)
                        $j(".step1").addClass("active");
                    else
                        $j(".step1").removeClass("active");

					self.postType = val;

                    // get custom fields
                    self.getCustomFieldsByPostType(val, null, self.callbacks.getCustomFieldsByPostType);
                    
                    if ( true === self.isWooCommerce ) {
						$j( '.post-categories-group .expandable-container-headline' ).html('WooCommerce');
						// get post taxonomies and categories
                    	self.getPostCategories( val, LscfWooComm.callbacks.getPostTaxonomies );

					} else {
						$j( '.post-categories-group .expandable-container-headline' ).html('Categories');

						// get post taxonomies and categories
                    	self.getPostCategories(val, self.callbacks.get_post_categories_callback);

					}
				    
                    // get featured labels
                    self.getCustomFieldsByPostType(val, ["date", "text"], function (data) {
						
						var customFields = "";

                        if (typeof data.success !== 'undefined' && data.success == 1) {
                        
                            var data = data.data.data;
							data.success = 1;
							
                            data.fields.forEach(function (field) {
                            
                                if (field.slug == 'px-theme-price') {
                                    customFields += '<li><input type="radio" id="'+field.slug.toLowerCase()+'_radio"  class="px_radiobox-input " name="px_filter-featured-posts-label" value="' + field.slug + '"><label class="px_radiobox" for="'+field.slug.toLowerCase()+'_radio"></label>Price <i>(theme featured fields)</i></li>';
                                }
                                else {
                                    customFields += '<li><input type="radio" id="'+field.value.toLowerCase()+'_radio" class="px_radiobox-input " name="px_filter-featured-posts-label" value="' + field.value + '"><label class="px_radiobox" for="'+field.value.toLowerCase()+'_radio"></label>' + field.name + '</li>';
                                }
                            
                            });
                        
						};

						if ( (typeof data.success !== 'undefined' && data.success == 1) || self.isWooCommerce ) {

							if ( self.isWooCommerce ) {
								customFields += '<li><input type="radio" id="px-woocommerce-featured-price" class="px_radiobox-input " name="px_filter-featured-posts-label" value="woocommerce-featured-price"><label class="px_radiobox" for="px-woocommerce-featured-price"></label>Price(WooCommerce)</li>';
							}

							$j(".px_featured-field").find("h4").show();
                            $j("#setAsFeaturedField").html(customFields);
                            $j(".featured-fields-group .expandable-container-headline").removeClass("inactive");

							$j('#setAsFeaturedField .px_radiobox').each(function(){
								$j(this).click(function(){
									$j('.featured-fields-group.step3').addClass('active');
								})
							})
                        
                        }
                        else {
                            $j(".featured-fields-group .expandable-container-headline").addClass("inactive");
                            $j(".px_featured-field").find("h4").hide();
                            $j("#setAsFeaturedField").html("");
                        
                        }
                    });
                
                });
            });
        }, 700);

        $j("#pxcf_generate-shortcode").click(function () {
            
            var dataFields = $j("#generateshortcode-form").serializeArray();
			
			if ( $j('.lscf-custom-theme:checked').length > 0 ){
				
				var customTemplateUrl = $j('.lscf-custom-theme:checked').attr('data-url'),
					name = $j('.lscf-custom-theme:checked').attr('data-name');

				dataFields.push({
					"name":"filter-custom-theme-url",
					"value":customTemplateUrl
				});
				
				dataFields.push({
					"name":"filter-custom-theme-name",
					"value":name
				});
			}

            // var postType = $j("#px_post_fields").data("post");
            var postType = self.postType;

			var attr = $j('.colorpick-rgba').attr('style');

			var matches = attr.match(/background-color\:(.+?);/);
			var mainRgbColor = matches[1].replace(/rgb\(|\)/g, '');

			
            if (dataFields.length > 0) {
                
                if (dataFields[0].value == null || dataFields[0].value == '') {
                    
                    $j("#px_filter_name_error").fadeIn();
                    return;
                    
                }    
                
				dataFields.push( {"name":"filter-main-color-rgb", "value":mainRgbColor} );

                self.generateShortCode(dataFields, postType, function (data) {
										
                    self.callbacks.generateShortCode_callback(data);
                    self.removeFilterShortcode();      

					$j('.step4').addClass('active');
                    
                });
                    
            }
                
        });
        
        self.removeFilterShortcode();
    };
    
    this.sanitizeAdditionalFilterFieldsName = function(){
        
        $j("#px_additional-fields-container").on("blur", ".px_sanitize-OnBlur", function(){
            
            var parent = $j(this).parent();
            var value = $j(this).val();
            
            if (value!='') {
                
                value = pxSanitize(value);
                
                parent.find(".px_sanitized-key").val(value);    
            };
            
                
        });    
        
    };
    
    this.addAdditionalFields = function(){ 
        
        $j("#px_add-additional-field").click(function(){
            
            var option = $j("#px_additional-fields").val();
            
            if( option == '' || option == null ) {
                
                alert("Please select an option");
                return;    
                
            }
            
            var postType = $j("#px-filter-selected-post-type").val();
            
            switch(option){
                
                case "search":
                    
                    var searchLength = $j(".px_additional-fields-row.px_search").length;

					if ( true === self.isWooCommerce ) {

						if ( searchLength > 1 ) {
                        
							alert("The filter with WooCommerce can have only 2 fields of this type");
							return;

                    	}

					} else {

						if ( searchLength > 0 ) {
                        
							alert("The filter can have only 1 field of this type");
							return;

                    	}

					}
                    if ( self.isWooCommerce ) {
                    
						var fieldTypeLength = ($j(".px_search")? $j(".px_search").length : 0 );
						var template = '<div class="px_additional-fields-row px_search">';
						
						template += '<div class="left-side">';
						template += '<label>Type:</label><strong>Search</strong><br/>';
						template += '<span class="px_remove px_remove-additional-field">Remove</span>';
						template += '</div>';
						
						template += '<div class="right-side">'
						template += '<label>Field Name:</label><input type="text" name="px_search_field_name_' + fieldTypeLength + '" value="">';

						template += '<div class="clear"></div><div class="px-woocommerce-search-fields"><input class="px_radiobox-input" name="px_search_by_' + fieldTypeLength + '" checked="checked" type="radio" id="px_search_by_default_' + fieldTypeLength + '" value="default">';
						template += '<label class="px_radiobox theme-field" for="px_search_by_default_' + fieldTypeLength + '"></label><span>Default</span>';

						template += '<input class="px_radiobox-input" name="px_search_by_' + fieldTypeLength + '" type="radio" id="px_search_by_sku_' + fieldTypeLength + '" value="sku">';
						template += '<label class="px_radiobox theme-field" for="px_search_by_sku_' + fieldTypeLength + '"></label><span>Product SKU</span>';

						template += '</div>';

						template += '</div><!---End right-side-->';
						template += '</div>';

					} else {

						var template = '<div class="px_additional-fields-row px_search">';
						
						template += '<div class="left-side">';
						template += '<label>Type:</label><strong>Search</strong><br/>';
						template += '<span class="px_remove px_remove-additional-field">Remove</span>';
						template += '</div>';
						
						template += '<div class="right-side">'
						template += '<label>Field Name:</label><input type="text" name="px_search_field_name" value="">';

						template += '</div><!---End right-side-->';
						template += '</div>';
					}

                    $j("#px_additional-fields-container").prepend(template);
                    
                    break;
                
                case "range":
                    
                    self.getCustomFieldsByPostType(postType, ["number"], function(data){
						
                        if ( data.success == 1 && typeof data.data.data.fields !== "undefined" || true === self.isWooCommerce ) {
                            
                            var fieldTypeLength = ($j(".px_range")? $j(".px_range").length : 0 );
                            var fieldsTemplate = '';
                            var template = '<div class="px_additional-fields-row px_range">';
                            
							if ( data.success == 1 && typeof data.data.data.fields !== "undefined" ) {

							
								var fieldsData = data.data.data.fields;

								fieldsData.forEach(function(field){

									if (field.slug == 'px-theme-price') {
										
										fieldsTemplate += '<input class="px_radiobox-input" name="px_range-fieldID-' + fieldTypeLength + '" type="radio" id="px-theme-price" value="px-theme-price">';
										fieldsTemplate += '<label class="px_radiobox theme-field" for="px-theme-price"></label><span>Price <i>(theme featured fields)</i></span>';

									}
									else {
										
										fieldsTemplate += '<input class="px_radiobox-input" name="px_range-fieldID-' + fieldTypeLength + '" type="radio" id="' + field.ID + '-' + fieldTypeLength + '_radio" value="' + field.value + '">';
										fieldsTemplate += '<label class="px_radiobox" for="'+field.ID+'-'+fieldTypeLength+'_radio"></label><span>' + field.name + '</span>';

									}

								});

							}

							if ( true === self.isWooCommerce ) {
										
								fieldsTemplate += '<div class="clear"></div><div class="px-woocommerce-range-fields">';	
								
								fieldsTemplate += '<input class="px_radiobox-input" name="px_range-fieldID-' + 
								fieldTypeLength + '" type="radio" id="px-woocommerce-price" value="px-woocommerce-price">';
								fieldsTemplate += '<label class="px_radiobox theme-field" for="px-woocommerce-price"></label><span>Price <i>(WooCommerce)</i></span>';

								fieldsTemplate += '<input class="px_radiobox-input" name="px_range-fieldID-' + 
								fieldTypeLength + '" type="radio" id="px-woocommerce-inventory" value="px-woocommerce-inventory">';

								fieldsTemplate += '<label class="px_radiobox theme-field" for="px-woocommerce-inventory"></label><span>Stock quantity <i>(WooCommerce)</i></span>';

								fieldsTemplate += '</div>';

							}

                            template += '<div class="left-side">';        
                            template += '<label>Type:</label><strong>Range</strong><br/>';
                            template += '<span class="px_remove px_remove-additional-field">Remove</span>';
                            template += '</div>';
                            
                            template += '<div class="right-side">';
                            
                            template += '<div class="px-frow">';
                            template += '<label>Field Name:</label><input class="px_sanitize-OnBlur" type="text" name="px_range-name-' + fieldTypeLength + '" value=""/>';
                            template += '</div>';
                            
                            template += '<div class="px-frow min-max">'; 
                            template += '<input class="px_sanitized-key" type="hidden" name="px_range-key-'+fieldTypeLength+'" value=""/>';
                            template += '<label>Min Value:</label><input type="number" name="px_range-max-' + fieldTypeLength + '" value=""/>';
                            template += '<label class="float-right center">Max Value:</label><input type="number" name="px_range-min-'+fieldTypeLength+'" value=""/>';
                            template += '</div>';

                            template += '<div class="px-frow">';
                            template += '<label class="wide">Range value\'s label(optional; ex:$,€,£)</label><input type="text" name="px_range-label-' + fieldTypeLength + '" value=""/>';
                            template += '</div>';

                            template += '<div class="px-frow">'
                            template += '<label class="wide">Show range for:</label>';
                            template += '<div class="px_custom-fields-range float-right">' + fieldsTemplate + '</div>';
                            template += '</div>';

                            template += '</div><!---End .right-side';    
                            template += '</div>';    
                            
                            $j("#px_additional-fields-container").prepend(template);
                            
                        }
                        else {
                            
                            alert("There is no any number/text field type for selected Post Type. Go to post\'s fields to add a number/text field type'")
                            
                        }
                    
                    });
                    
                    break;
                
                case "date-interval":
                    
                    self.getCustomFieldsByPostType(postType, ["date"], function(data){
                        
                        if ( data.success == 1 && typeof data.data.data.fields !== "undefined") {
                            var fieldTypeLength = ($j(".px_date-interval")? $j(".px_date-interval").length : 0 );
                            var fieldsData = data.data.data.fields;
                            var fieldsTemplate = '';
                            var template = '<div class="px_additional-fields-row px_date-interval">';
                            
                            fieldsData.forEach(function(field){
                            
                                fieldsTemplate += '<input class="px_radiobox-input" name="px_date-interval-fieldID-' + fieldTypeLength + '" type="radio" id="' + field.ID + '" value="' + field.value + '">';
                                fieldsTemplate += '<label class="px_radiobox" for="'+field.ID+'"></label><span>' + field.name + '</span>';
                                
                            });

                            template += '<div class="left-side">';
                            template += '<label>Type:</label><strong>Date Interval</strong><br/>';
                            template += '<span class="px_remove px_remove-additional-field">Remove</span>';
                            template += '</div>';

                            template += '<div class="right-side">';

                            template += '<div class="px-frow">';
                            template += '<label>Field Name</label>';
                            template += '<input class="px_sanitize-OnBlur" type="text" name="px_date-interval-name-' + fieldTypeLength + '" value=""/>';
                            template += '</div>';

                            template += '<div class="px-frow">';
                            template += '<input class="px_sanitized-key" type="hidden" name="px_date-interval-key-' + fieldTypeLength + '" value=""/>';
                            template += '<label class="wide">Show Date Interval for:</label>';
                            template += '<div class="px_custom-fields-date-interval float-right">' + fieldsTemplate + '</div>';
                            template += '</div>'
                            
                            template += '</div>';    
                            template += '</div>';    
                            
                            $j("#px_additional-fields-container").prepend(template);
                            
                        }
                        else {
                          
                            alert('There is no any "Date" field type for current Post Type. Go to Post\'s field to add a "Date" field ')
                            
                        };
                        
                    });
                    
                    break;
                
            };
            
        });
    }
    
    this.removeAdditionalFilterFields = function(){
        
        $j("#px_additional-fields-container").on("click", ".px_remove-additional-field", function(){
            
            var parent = $j(this).closest(".px_additional-fields-row");
            
            parent.remove();
        });
        
    }
    
    this.removeFilterShortcode = function(){
            
        $j(".px_remove-shortcode").on("click", function(){
            
            var filterID = $j(this).data("id");
            var postType = $j(this).data("post");
            
            self.removeShortcode(filterID, $j(this).closest(".single-shortcode"), self.callbacks.removeShortcode_callback);
            
        });
    };
    
    this.removeCustomPostType_ajaxRequest = function( customPostKey, callback ){
        
        $j.ajax({
            type:"POST",
            url:ajaxURL,
            data:{
                action:action,
                section:"removeCustomPostType",
                key:customPostKey
            },
            success:function(data){

				if( null != callback ) { callback( data ); }
                
            },
            dataType:"html"
        })
        
    };
    
    this.getPostCategories = function( postType, callback ) {
        
        $j.ajax({
            type:"POST",
            url:ajaxURL,
            data:{
                action:action,
                section:"getPostCategories",
                post_type:postType
            },
            success:function(data){
				callback(data);
            },
            dataType:"json"
        
            
        })
        
    }
    
    this.addNewCustomPostType_ajaxRequest = function(postName){
        
        $j.ajax({
            type:"POST",
            url:ajaxURL,
            data:{
                action:action,
                section:"addNewCustomPostType",
                name:postName
            },
            success:function(data){
				document.cookie = 'px_new_custom_post=1';
                window.location.reload();
            },
            dataType:"html"
        })
        
    };
    
    
    
    this.getCustomFieldsByPostType = function(postType, fieldType, callback){
        
        $j.ajax({
            type:"POST",
            url:ajaxURL,
            data:{
                action:action,
                section:"getPostType_customFields",
                fieldType:fieldType,
                post_type:postType
            },
            success: function (data) {
                
                callback(data);
            },
            dataType:"json"
        });
    };
    
    
    this.generateShortCode = function(data, postType, callback){

        $j.ajax({
            type:"POST",
            url:ajaxURL,
            data:{
                action:action,
                section:"generateShortcode",
                fieldsData:data,
                postType:postType
            },
            success:function(data){
                callback(data);    
            },
            dataType:"json"
        });
        
    };
    
    this.removeShortcode = function(filterID, jq_firedElement, callback){
        
        $j.ajax({
            type:"POST",
            url:ajaxURL,
            data:{
                action:action,
                section:"removeShortcode",
                filterID:filterID
            },
            success:function(data){
                callback(jq_firedElement, data);
            },
            dataType:"json"
        });
        
    };
    
    
};

function ajaxCallbacks(){
    
    var self = this;

	this.isWooCommerce = false;

	this.template = PX_pluginLF.template;
	
	this.initCustomFields = function(){
		
		$j('.post-custom-fields-group').each(function(){

			$j(this).find('.px-inline').each(function(){

				var parentLine = $j(this);

				$j(this).find('.px-checkbox-label').click(function(){
	
					var isChecked = ( parentLine.find('input[type="checkbox"]:checked').length > 0 ? 1 : 0 );

					if ( 1 === isChecked ) {
						parentLine.find('.select').addClass('inactive');	
					} else {
						parentLine.find('.select').removeClass('inactive');
					}

				});

			});
		});	
	}

    this.getCustomFieldsByPostType = function( data ) {

        if ( data.success == 1 || true === self.isWooCommerce ) {
			
			var hasCustomFields = data.success;
            
            var customFields = {
				"fields":[],
				"woo_fields":false
			};

			if ( 1 == hasCustomFields ) {

				var data = data.data.data;

				data.fields.forEach(function(field){
					
					switch ( field.slug ) {
						
						case "px_radio_box":
							field.display_as = [
								{
									"value":"default",
									"name":"Display as"
								},
								{
									"value":"px_radio_box",
									"name":"Radio"
								},
								{
									"value":"px_select_box",
									"name":"Dropdown"
								},
							]
							field.multiple_display = true;
						break;
						
						case "px_select_box":
							field.display_as = [
								{
									"value":"default",
									"name":"Display as"
								},
								{
									"value":"px_radio_box",
									"name":"Radio"
								},
								{
									"value":"px_select_box",
									"name":"Dropdown"
								},
							]
							field.multiple_display = true;
						break;
						
						case "px_check_box":
							field.display_as = [
								{
									"value":"default",
									"name":"Display as"
								},
								{
									"value":"px_radio_box",
									"name":"Radio"
								},
								{
									"value":"px_select_box",
									"name":"Dropdown"
								},
								{
									"value":"px_check_box",
									"name":"Checkbox"
								},
							]
							field.multiple_display = true;
						break;
						
						case "px_icon_check_box":

							field.display_as = [
								{
									"value":"default",
									"name":"Display as"
								},
								{
									"value":"px_radio_box",
									"name":"Radio"
								},
								{
									"value":"px_select_box",
									"name":"Dropdown"
								},
								{
									"value":"px_check_box",
									"name":"Checkbox"
								},
								{
									"value":"px_check_icon-text_box",
									"name":"Icon \w text"
								},
								{
									"value":"px_check_icon-only_box",
									"name":"Icon only"
								}
							]
							field.multiple_display = true;
						break;

						default:
						case "px_date":
							field.display_as = false;
							field.multiple_display = false;
						break;
					}
				});

				customFields.fields = data;
			}


			if ( true === self.isWooCommerce ) {
				
				customFields.woo_fields = [];

				var woo_fields = [
					{
						"ID":"px-woocommerce-instock-field",
						"field_form_id":"",
						"name":"In stock/out of stock (WooCommerce)",
						"slug":"px-woocommerce-instock",
						"value":"woocommerce-instock"
					}
				]
				customFields.woo_fields = woo_fields;
				
			}

			self.template.custom_fields.items = customFields;

			$j.get( self.template.custom_fields.templateUrl, function( template ) {

				var renderedTemplate = Mustache.render( $j( template ).filter('#px-filter-custom-fields-template').html(), self.template.custom_fields.items );

				document.getElementById("px_post_fields").innerHTML = renderedTemplate;         
				document.getElementById("px_post_fields").setAttribute("data-post", data.post_type);         

				checkAllCheckboxes( $j("#px_post_fields"), true );
				
				$j(".post-custom-fields-group .expandable-container-headline").removeClass("inactive");
				
				$j(".px_dynamic-field").each(function () {
                	$j(this).show();
            	});

				setTimeout(function(){
					
					isStep2Active();
					
					init_custom_dropdown( $j('.post-custom-fields-group') );
					
					self.initCustomFields();

				}, 400);
				
			});

        }

		$j(".post-custom-fields-group .expandable-container-headline").each(function () {

			if ( ! $j(this).hasClass('always-active') ) {

				$j(this).addClass('inactive');						

			}

		});

        document.getElementById("px_post_fields").innerHTML = "";
        
        
        $j(".px_dynamic-field").each(function () {
            $j(this).show();
        });
        
        
    };
    
    this.generateShortCode_callback = function(data){
        
        var templateData = '<li>Filter name:<strong>'+data.name+'</strong><span data-id="'+data.filterID+'" data-post="'+data.post_type+'" class="px_remove-shortcode px_removeOption" >Remove</span><br/><textarea style="width:100%; text-align:left" rows="5" readonly="readonly">[px_filter id="'+data.filterID+'" post_type="'+data.post_type+'" featured_label="'+data.featuredLabel+'"]</textarea><br/><i>Filter shortcode - copy shortcode to page editor for filter to show</i><hr/></li>';
        
        $j("ul#pxGenerateShortcodesContainer").prepend(templateData);
        
    }
    
    this.removeShortcode_callback = function(jq_firedElement, data){
        
        if(data.success==1){
            jq_firedElement.hide();
            return;    
        }
              
    }

    this.get_post_categories_callback = function (data) {

        var count = 0;
		self.template.tax.items = [];
        
        data.forEach(function (tax) {

			if ( 'undefined' !== typeof tax.parent_categs ){

				var taxTemplate = {};
				taxTemplate.index = count;
				taxTemplate.title = tax.taxonomy;
				taxTemplate.taxonomy = tax.taxonomy;

				taxTemplate.unsorted_subcategories = tax.unsorted_subcategs;
				taxTemplate.categs = [];
				tax.parent_categs.forEach(function(categ, index){
					
					var className = '';
					
					if ( 'undefined' !== typeof categ.has_subcategories && 1 === categ.has_subcategories ) {
						
						className = 'has-subcategs';
						categ.subcategs = {
							"parent_name": categ.data.name,
							"parent_id":categ.data.term_id,
							"list":"",
							"items":[]
						};

						var j = 0;
						tax.subcategs[categ.data.term_id].forEach(function(subcateg){
							
							if ( j <= 5 ) {
								categ.subcategs.list += subcateg.name + ', ';
							}
							categ.subcategs.items.push( subcateg );

							j++;
						});

						categ.subcategs.list = categ.subcategs.list.substring( 0, categ.subcategs.list.length -2  ) + '..';

					} else {
						categ.subcategs = false;
					};

					categ.className = className;
					taxTemplate.categs.push(categ);
				});

				taxTemplate.has_subcategories = ( 'undefined' !== typeof tax.has_subcategories ? tax.has_subcategories : 0 );

				taxTemplate.subcategs = ( 'undefined' !== typeof tax.subcategs ? tax.subcategs : '' );

				self.template.tax.items.push( taxTemplate );
				
				count++;
			}

        }); 

		$j.get( self.template.tax.templateUrl, function( template ) {
		
			
			var renderedTemplate = Mustache.render( $j( template ).filter('#template-tax-posts').html(), self.template.tax );
			
			$j("#px_post_categories").html( renderedTemplate );

			for ( var i = 0; i < count; i++ ) {
				checkAllCheckboxes( $j( '.px-post-tax' + i + ' .tax-categories-container' ) );
				checkAllCheckboxes( $j( '.px-post-tax' + i + ' .tax-subcategories-display' ), true );
			}
			
			setTimeout(function(){

				isStep2Active();
				init_custom_dropdown( $j('.post-categories-group') );

			}, 400);

			setTimeout(function(){
				self.init_tax_subcategories();
				lscf_taxonomies_subcategories_view_type();
			}, 400)
			
		});

        if (count == 0)
            $j(".post-categories-group .expandable-container-headline").addClass("inactive");
        else 
            $j(".post-categories-group .expandable-container-headline").removeClass("inactive");

    }



	this.init_tax_subcategories = function(){
		
		$j( '.taxonomies-block .px-post-categories' ).each(function( taxIndex ){
			
			var parentContainer = $j(this);
			
			parentContainer.closest('.tax-categories-container').find('.tax-list-check-all').click(function(){
				
				var countParentCategs = parentContainer.find('li.has-subcategs').length;

				var isCheckedAllCategs = ( parentContainer.closest('.tax-categories-container').find('.tax-list-check-all-checkbox:checked').length > 0 ? 1 : 0 );

				if ( 1 === isCheckedAllCategs && countParentCategs > 0 ) {
					
					$j('.tax-subcategories-display').eq(taxIndex).hide();	
					$j('.tax-subcategories-display').eq(taxIndex).find('.px-inline').hide();
					parentContainer.attr('data-active-parent-count', 0);

				} else if( countParentCategs > 0 ) {

					$j('.tax-subcategories-display').eq(taxIndex).fadeIn();	
					$j('.tax-subcategories-display').eq(taxIndex).find('.px-inline').fadeIn();
					parentContainer.attr('data-active-parent-count', countParentCategs);

				}
			});

			$j(this).find('.has-subcategs').find('.px-checkbox-label').each(function(){
				
				$j(this).click(function(){

					var countActiveParentChilds = parseInt( parentContainer.attr('data-active-parent-count') );
					var parent = $j(this).parent('li');
					var isChecked = ( parent.find('input[type="checkbox"]:checked').length > 0 ? 1 : 0 );
					var value = parent.find('input[type="checkbox"]').val().split('!#');
					var ID = value[0];

					if ( 1 === isChecked ){

						countActiveParentChilds--;
						
						if ( countActiveParentChilds < 1 ) {
							$j('.tax-subcategories-display').eq(taxIndex).hide();
						}

						parentContainer.attr('data-active-parent-count', countActiveParentChilds);
						$j('.subcateg-view-' + ID ).hide();

					} else{
						
						if ( countActiveParentChilds < 1 ) {
							$j('.tax-subcategories-display').eq(taxIndex).fadeIn();
						}

						countActiveParentChilds++;
						parentContainer.attr('data-active-parent-count', countActiveParentChilds);
						$j('.subcateg-view-' + ID ).fadeIn();

					}
				})
			})
		})

		$j('.tax-subcategories-display').each(function(){

			$j(this).find('.px-inline').each(function(){

				var parentLine = $j(this);

				$j(this).find('.px-checkbox-label').click(function(){
	
					var isChecked = ( parentLine.find('input[type="checkbox"]:checked').length > 0 ? 1 : 0 );

					if ( 1 === isChecked ) {
						parentLine.find('.select').addClass('inactive');	
					} else {
						parentLine.find('.select').removeClass('inactive');
					}

				});

			})
		})	
	};
}


function pxSanitize(string){
    return string.trim().toLowerCase().replace(/([\!\@\#\$\%\^\&\*\(\[\)\]\{\-\}\\\/\:\;\+\=\.\<\,\>\?\~\`\'\" ]+)/g, '_');
};

function lscf_taxonomies_subcategories_view_type(){
	var $j = jQuery;

	var parentContainer,
			checkbox
			is_checked = false;

		$j('.lscf-hierarchy-subcategories-display').each(function( index ){

			$j(this).click(function(){

				$j('.lscf-subcategories-independent-display').eq(index).removeAttr('checked');

				is_checked = ( $j(this).is(':checked') ? true : false );
				parentContainer = $j(this).closest('.taxonomies-block');

				if ( true === is_checked ) {
					
					parentContainer.find('.lscf-tax-all-subcategories').hide();
					
					parentContainer.find('.lscf-tax-all-subcategories').find('input[type="checkbox"]').each(function(){
						$j(this).removeAttr('checked');
					});

					parentContainer.find('.lscf-hierarchy-subcategories-container').fadeIn();

				} else {
					parentContainer.find('.lscf-tax-all-subcategories').fadeIn();
					parentContainer.find('.lscf-hierarchy-subcategories-container').hide();

				}
				
			});
		});

		$j('.lscf-subcategories-independent-display').each(function( index ){

			$j(this).click(function(){

				$j('.lscf-hierarchy-subcategories-display').eq(index).removeAttr('checked');

				is_checked = ( $j(this).is(':checked') ? true : false );
				parentContainer = $j(this).closest('.taxonomies-block');

				if ( true === is_checked ) {
					
					parentContainer.find('.lscf-tax-all-subcategories').hide();
					
					parentContainer.find('.lscf-tax-all-subcategories').find('input[type="checkbox"]').each(function(){
						$j(this).removeAttr('checked');
					});

					parentContainer.find('.lscf-hierarchy-subcategories-container').fadeIn();

				} else {
					parentContainer.find('.lscf-tax-all-subcategories').fadeIn();
					parentContainer.find('.lscf-hierarchy-subcategories-container').hide();

				}
				
			});
		});
}

function checkAllCheckboxes( parentContainer, taxSubcategs ) {
    
    var $ = jQuery;
        

    parentContainer.find(".tax-list-check-all").click(function () {
        
        var checkboxInputID = parentContainer.find(".tax-list-check-all").attr("for");

        var isChecked = (( $j('#'+checkboxInputID+":checked").length > 0 ) ? 1 : 0);
        
        parentContainer.find('input[type="checkbox"]').each(function () {
            
            if ( ! $j(this).hasClass('tax-list-check-all-checkbox') ) {
                
                if (isChecked == 1) {
                    if ( true === taxSubcategs ) {
						$j(this).closest('.px-inline').find('.select').addClass('inactive');
					}
                    $j(this).removeAttr("checked");    
                }
                else {
					if ( true === taxSubcategs ) {
						$j(this).closest('.px-inline').find('.select').removeClass('inactive');
					}
                    $j(this).attr({ "checked": "checked" });
                }
                
            }
            
        })
        
    });

}



function LscfSettings(){

	var $j = jQuery,
		self = this,
		action = "px-plugin-ajax",
		ajaxURL = adminData.ajaxURL;

	this.init = function(){
		self.reset_button_on_check();
	};

	this.reset_button_on_check = function(){

		$j('#reset-button-checkbox').click(function(){
			var isChecked = ( $j( '#px-reset-button:checked' ).length > 0 ? 1 : 0 );
			
			if ( 1 == isChecked ) {
				$j(this).closest('.lscf-opt').find('.lscf-extra-opt').removeClass('active');
			} else {
				$j(this).closest('.lscf-opt').find('.lscf-extra-opt').addClass('active');
			}
		});
		
	}

	this.saveSettings = function(){

		$j("#lscf-save-settings").click(function(){
			
			$j('.saving-status').removeClass('saved');
			$j('.saving-status').addClass('loading');

			var attr = $j('.colorpick-rgba').attr('style');

			var matches = attr.match(/background-color\:(.+?);/);
			var mainRgbColor = matches[1].replace(/rgb\(|\)/g, '');
			var mainColor = $j('.colorpick-rgba').val();

			var filterPostsPerPage = $j( '#px-filter-posts-count' ).val();
			var postsPagePostsPerPage = $j( '#px-posts-page-count' ).val();
			var resetButton  = {
				"status" : ( $j( "#px-reset-button:checked" ).length > 0 ? $j( '#px-reset-button' ).val() : 0 ),
				"name" : $j('#reset-button-extra-options').find('input[name="reset-button-name"]').val(),
				"position" : $j('#reset-button-extra-options').find('input[name="reset-button-possition"]:checked').val()
			}

			var gridViewAsDefault = ( $j( "#px-grid-view:checked" ).length > 0 ? $j( '#px-grid-view' ).val() : 0 );

			var seeMoreWriting = $j('#lscf-see-more-writing').val(),
				seeLessWriting = $j('#lscf-see-less-writing').val(),
				loadMoreWriting = $j('#lscf-load-more-writing').val(),
				selectWriting = $j('#lscf-select-writing').val(),
				anyWriting = $j('#lscf-any-writing').val(),
				viewWriting = $j('#lscf-view-writing').val(),
				filterWriting = $j('#lscf-filter-mobile-writing').val(),
				addToCart = $j('#lscf-add-to-cart-writing').val();


			var dataToSave = {
				"color":{
					"color":mainColor, 
					"rgb":mainRgbColor
				},
				"posts_per_page":{
					"posts_only":postsPagePostsPerPage,
					"filter":filterPostsPerPage
				},
				"reset_button":resetButton,
				"block_view":gridViewAsDefault,
				"see_more_writing":seeMoreWriting,
				"see_less_writing":seeLessWriting,
				"load_more_writing":loadMoreWriting,
				"any_writing":anyWriting,
				"select_writing":selectWriting,
				"view_writing":viewWriting,
				"filter_writing":filterWriting,
				"add_to_cart":addToCart
			}

			self.saveSettingsAjaxRequest( dataToSave, function(data){

				$j('.saving-status').removeClass('loading');
				$j('.saving-status').addClass('saved');

			})

		});

	};

	this.saveSettingsAjaxRequest = function( data, callback ){

		$j.ajax({
            type:"POST",
            url:ajaxURL,
            data:{
                action:action,
                section:"save-general-settings",
				settings:data
            },
            success:function(data){
                callback(data);    
            },
            dataType:"html"
        });
	}

}

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
  return false;
}

function init_custom_dropdown( parent ){
	var $ = jQuery;

	parent.find('.custom-select-type-1').each(function() {
		
		var dataClass=$j(this).attr('data-class');
		var $this=$j(this),
			numberOfOptions=$j(this).children('option').length;
		
		$this.addClass('s-hidden');
		
		$this.wrap('<div class="select '+dataClass+'"></div>');
		
		$this.after('<div class="styledSelect"></div>');
		
		var $styledSelect=$this.next('div.styledSelect');
		$styledSelect.text($this.children('option').eq(0).text());
		
		var $list=$j('<ul />',{'class':'options'}).insertAfter($styledSelect);
		
		for ( var i=0; i < numberOfOptions; i++ ) {
			$j('<li />',{ text:$this.children('option').eq(i).text(), rel:$this.children('option').eq(i).val() } ).appendTo($list);
		}
		var $listItems = $list.children('li');
		$styledSelect.click(function(e){
			
			if( ! $j(this).closest('.select').hasClass('inactive') && ! $j(this).closest('.select').hasClass('not-available') ) {

				e.stopPropagation();
				$j('div.styledSelect.active').each(function(){
					$j(this).removeClass('active').next('ul.options').hide();
				});
				$j(this).toggleClass('active').next('ul.options').toggle();

			}
		});

		$listItems.click(function(e){
			e.stopPropagation();
			$styledSelect.text($j(this).text()).removeClass('active');
			$this.val($j(this).attr('rel'));
			$list.hide();
		});
		
		$j(document).click(function(){
			$styledSelect.removeClass('active');
			$list.hide();
		});
	});
}