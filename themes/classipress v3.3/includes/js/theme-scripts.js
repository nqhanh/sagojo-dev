/*
 * ClassiPress theme jQuery functions
 * Written by AppThemes
 * http://www.appthemes.com
 *
 * Left .js uncompressed so it's easier to customize
 */



jQuery(document).ready(function($) {

	/* style the select dropdown menus */
	if ( jQuery.isFunction( jQuery.fn.selectBox ) ) {
		jQuery('select').selectBox({
			menuTransition: 'fade', // default, slide, fade
			menuSpeed: 'fast'
		});

		/* do not apply in step1 of add new listing form */
		jQuery('.form_step #ad-categories select').selectBox('destroy');
	}

	/* convert header menu into select list on mobile devices */
	if ( jQuery.isFunction( jQuery.fn.tinyNav ) ) {
		jQuery('.header_menu_res .menu').tinyNav({
			active: 'current-menu-item',
			header: classipress_params.text_mobile_navigation,
			header_href: classipress_params.home_url,
			indent: '-',
			excluded: ['#adv_categories']
		});
	}

	/* mouse over main image fade */
	jQuery('.img-main, .post-gallery img').mouseover(function() {
		jQuery(this).stop().animate( { opacity:0.6 }, 200 );
	}).mouseout(function() {
		jQuery(this).stop().animate( { opacity:1 }, 200 );
	});

	/* initialize the category selection on add-new page */
	if ( jQuery('#step1 .form_step').length > 0 )
		cp_handle_form_category_select();

	/* initialize the image previewer */
	imagePreview();

	/* initialize tabs control of sidebar */
	tabControlSidebar();

	/* initialize tabs control of home page */
	tabControlHome();

	/* auto complete the search field with tags */
	jQuery('#s').autocomplete({
		source: function( request, response ) {
			jQuery.ajax({
				url: classipress_params.ajax_url + '?action=ajax-tag-search-front&tax=' + classipress_params.appTaxTag,
				dataType: 'json',
				data: {
					term: request.term
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					//alert('Error: ' + errorThrown + ' - ' + textStatus + ' - ' + XMLHttpRequest);
				},
				success: function( data ) {
					response( jQuery.map( data, function( item ) {
						return {
							term: item,
							value: unescapeHtml(item.name)
						};
					}));
				}
			});
		},
		minLength: 2
	});


	/* assign the ColorBox event to elements */
	if ( jQuery.isFunction(jQuery.colorbox) ) {
		jQuery("a[data-rel='colorbox']").colorbox({
			transition: 'fade',
			rel: 'colorbox',
			current: '',
			scrolling: false,
			slideshow: false,
			maxWidth: '100%',
			maxHeight: '100%',
			slideshowAuto: false
		});
		jQuery("#mainImageLink").click(function() {
			jQuery("#thumb1").click();
		});
	}


	/* hide flash elements on ColorBox load */
	jQuery(document).bind("cbox_open", function() {
		jQuery('object, embed, iframe').css({'visibility':'hidden'});
	});
	jQuery(document).bind("cbox_closed", function() {
		jQuery('object, embed, iframe').css({'visibility':'inherit'});
	});


	/* initialize the form validation */
	if ( jQuery.isFunction(jQuery.fn.validate) ) {
		// validate profile fields
		jQuery("#your-profile").validate({errorClass: 'invalid'});

		// sidebar contact form validation
		jQuery('.form_contact').validate({errorClass: 'invalid'});

		// 'add new' form validation
		jQuery('.form_step').validate({
			ignore: '.ignore',
			errorClass: 'invalid',
			errorPlacement: function(error, element) {
				if (element.attr('type') == 'checkbox' || element.attr('type') == 'radio') {
					element.closest('ol').after(error);
				} else if ( jQuery.isFunction( jQuery.fn.selectBox ) && element.is('select') ) {
					error.insertBefore(element);
					error.css('display', 'inline-block');
				} else {
					offset = element.offset();
					error.insertBefore(element);
					if ( jQuery(window).width() > 600 ) {
						error.addClass('message'); // add a class to the wrapper
						error.css('position', 'absolute');
						error.css('left', offset.left + element.outerWidth());
						error.css('top', offset.top);
					}
				}
			},
			highlight: function(element, errorClass, validClass) {
				jQuery(element).addClass(errorClass).removeClass(validClass);
				jQuery(element).parent().find('a.selectBox').addClass(errorClass).removeClass(validClass);
			},
			unhighlight: function(element, errorClass, validClass) {
				jQuery(element).removeClass(errorClass).addClass(validClass);
				jQuery(element).parent().find('a.selectBox').removeClass(errorClass).addClass(validClass);
			}

		});

		// 'edit ad' form validation
		jQuery(".form_edit").validate({
			ignore: '.ignore',
			errorClass: 'invalid',
			errorPlacement: function(error, element) {
				if (element.attr('type') == 'checkbox' || element.attr('type') == 'radio') {
					element.closest('ol').before(error);
				} else {
					error.insertBefore(element);
				}
				error.css('display', 'block');
			},
			highlight: function(element, errorClass, validClass) {
				jQuery(element).addClass(errorClass).removeClass(validClass);
				jQuery(element).parent().find('a.selectBox').addClass(errorClass).removeClass(validClass);
			},
			unhighlight: function(element, errorClass, validClass) {
				jQuery(element).removeClass(errorClass).addClass(validClass);
				jQuery(element).parent().find('a.selectBox').removeClass(errorClass).addClass(validClass);
			}
			
		});

		// comment form validation
		jQuery("#commentform").validate({
			errorClass: "invalid",
			errorElement: "div",
			errorPlacement: function(error, element) {
				error.insertAfter(element);
			}
		});
		jQuery("#commentform").fadeIn();

	}


	/* initialize the tooltip */
	if ( jQuery.isFunction(jQuery.fn.easyTooltip) ) {
		// tooltip on 'membership' and 'add new' pages
		jQuery("#mainform a").easyTooltip();
	}

	/* makes the tables responsive */
	if ( jQuery.isFunction( jQuery.fn.footable ) ) {
		jQuery('.footable').footable();
	}
});


/* Tab Control home page */
function tabControlHome() {
	var tabContainers = jQuery('div.tabcontrol > div');
	tabContainers.hide().filter(':first').show();
	jQuery('div.tabcontrol ul.tabnavig a').click(function() {
		tabContainers.hide();
		tabContainers.filter(this.hash).fadeIn(100);
		jQuery('div.tabcontrol ul.tabnavig a').removeClass('selected');
		jQuery(this).addClass('selected');
		return false;
	}).filter(':first').click();
}


/* Tab Control sidebar */
function tabControlSidebar() {
	var tabs = [];
	var tabContainers = [];
	jQuery('ul.tabnavig a').each(function() {
		if ( window.location.pathname.match(this.pathname) ) {
			tabs.push(this);
			tabContainers.push( jQuery(this.hash).get(0) );
		}
	});

	//hide all contrainers except execpt for the one from the URL hash or the first container
	if ( window.location.hash !== "" && window.location.hash.search('priceblock') >= 0 ) {
		jQuery(tabContainers).hide().filter(window.location.hash).show();
		//detecting <a> tab using its "href" which should always equal the hash
		jQuery(tabs).filter( function(index) {
			return ( jQuery(this).attr('href') === window.location.hash );
		}).addClass('selected');
		jQuery('html').scrollTop( jQuery('.tabprice').position().top );
	} else {
		jQuery(tabContainers).hide().filter(':first').show();
		jQuery(tabs).filter(':first').addClass('selected');
	}

	jQuery(tabs).click(function() {
		// hide all tabs
		jQuery(tabContainers).hide().filter(this.hash).fadeIn(500);
		jQuery(tabs).removeClass('selected');
		jQuery(this).addClass('selected');
		return false;
	});
}


// creates previews of images
function imagePreview() {
	var xOffset = 10;
	var yOffset = 30;

	jQuery('a.preview').hover(function(e) {
		var adTitle = jQuery(this).find('img').attr('alt');
		jQuery('body').append("<div id='preview'><img src='" + jQuery(this).data('rel') + "' alt='' /><p>" + adTitle + "</p></div>");
		jQuery('#preview').css('top', (e.pageY - xOffset) + 'px').css('left', (e.pageX + yOffset) + 'px').fadeIn('fast');
	}, function() {
		jQuery('#preview').remove();
	});

	jQuery('a.preview').mousemove(function(e) {
		jQuery('#preview').css('top', (e.pageY - xOffset) + 'px').css('left', (e.pageX + yOffset) + 'px');
	});
}


// used to unescape any encoded html passed from ajax json_encode (i.e. &amp;)
function unescapeHtml(html) {
	var temp = document.createElement("div");
	temp.innerHTML = html;
	var result = temp.childNodes[0].nodeValue;
	temp.removeChild(temp.firstChild);
	return result;
}


// highlight search results
jQuery.fn.extend({
	highlight: function(search, insensitive, hclass) {
		var regex = new RegExp("(<[^>]*>)|(\\b"+ search.replace(/([-.*+?^${}()|[\]\/\\])/g,"\\$1") +")", insensitive ? "ig" : "g");
		return this.html(this.html().replace(regex, function(a, b, c) {
			return ( ( a.charAt(0) === "<" ) ? a : "<span class=\""+ hclass +"\">" + c + "</span>" );
		}));
	}
});


/* Form Checkboxes Values Function */
function addRemoveCheckboxValues(cbval, cbGroupVals) {
	var a;
	if ( cbval.checked === true ) {
		a = document.getElementById(cbGroupVals);
		a.value += ',' + cbval.value;
		a.value = a.value.replace(/^\,/, '');
	} else {
		a = document.getElementById(cbGroupVals);
		a.value = a.value.replace(cbval.value + ',', '');
		a.value = a.value.replace(cbval.value, '');
		a.value = a.value.replace(/\,$/, '');
	}
}


/* General Trim Function  */
function trim(str) {
	var	str = str.replace(/^\s\s*/, '');
	var	ws = /\s/;
	var	i = str.length;

	while (ws.test(str.charAt(--i)));
	return str.slice(0, i + 1);
}


/* Used for enabling the image for uploads */
function enableNextImage(a, i) {
	jQuery('#upload' + i).removeAttr('disabled');
}


/* Position price currency */
function cp_currency_position( price ) {
	var position = classipress_params.currency_position;
	var currency = classipress_params.ad_currency;

	switch ( position ) {
		case 'left':
			return currency + price;
		case 'left_space':
			return currency + ' ' + price;
		case 'right':
			return price + currency;
		default: // right_space
			return price + ' ' + currency;
	}

}


/* Handle price slider in refine results widget */
function cp_show_price_slider(min_price, max_price, min_value, max_value, thousands) {
	min_value = ( (thousands && min_value <= 1000) ? 1000 : ( (!thousands && min_value >= 1000) ? 0 : min_value ) );
	max_value = ( (thousands && max_value <= 1000) ? max_price : ( (!thousands && max_value >= 1000) ? 1000 : max_value ) );

	jQuery('#slider-range').slider( {
		range: true,
		min: ( (thousands) ? 1000 : min_price ),
		max: ( (thousands) ? max_price : 1000 ),
		step: 1,
		values: [ min_value, max_value ],
		slide: function(event, ui) {
			jQuery('#amount').val( cp_currency_position( ui.values[0] ) + ' - ' + cp_currency_position( ui.values[1] ) );
		}
	});

	jQuery('#amount').val( cp_currency_position( jQuery('#slider-range').slider('values', 0) ) + ' - ' + cp_currency_position( jQuery('#slider-range').slider('values', 1) ) );

}


/* Used for deleting ad on customer dashboard */
function confirmBeforeDeleteAd() {
	return confirm(classipress_params.text_before_delete_ad);
}


/* Used for selecting category on add-new form */
function cp_handle_form_category_select() {
	//if on page load the parent category is already selected, load up the child categories
	jQuery('#catlvl0').attr('level', 0);
	if ( jQuery('#catlvl0 #cat').val() > 0 ) {
		cp_get_subcategories(jQuery(this),'catlvl-', 1, classipress_params.ad_parent_posting);
	}

	//bind the ajax lookup event to #cat object
	jQuery(document).on('change', '#cat', function() {
		currentLevel = parseInt(jQuery(this).parent().attr('level'), 10);
		cp_get_subcategories(jQuery(this), 'catlvl', currentLevel + 1, classipress_params.ad_parent_posting);

		//rebuild the entire set of dropdowns based on which dropdown was changed
		jQuery.each(jQuery(this).parent().parent().children(), function(childLevel, childElement) {
			if ( currentLevel + 1 < childLevel )
				jQuery(childElement).remove();

			if ( currentLevel + 1 === childLevel )
				jQuery(childElement).removeClass('hasChild');
		});

		//find the deepest selected category and assign the value to the "chosenCateory" field
		if ( jQuery(this).val() > 0 ) {
			jQuery('#chosenCategory input:first').val(jQuery(this).val());
		} else if ( jQuery('#catlvl' + ( currentLevel - 1 ) + ' select').val() > 0) {
			jQuery('#chosenCategory input:first').val(jQuery('#catlvl' + ( currentLevel - 1 ) + ' select').val());
		} else {
			jQuery('#chosenCategory input:first').val('-1');
		}
	});
}


function cp_get_subcategories(dropdown, results_div_id, level, allow_parent_posting) {
	parent_dropdown = jQuery(dropdown).parent();
	category_ID = jQuery(dropdown).val();
	results_div = results_div_id + level;
	if ( ! jQuery(parent_dropdown).hasClass('hasChild') ) {
		jQuery(parent_dropdown).addClass('hasChild').parent().append('<div id="' + results_div + '" level="' + level + '" class="childCategory"></div>');
	}

	jQuery.ajax({
		type: "post",
		url: classipress_params.ajax_url,
		data: {
			action: 'cp_getChildrenCategories',
			catID : category_ID
		},
		//show loading just when dropdown changed
		beforeSend: function() {
			jQuery('#getcat').hide();
			jQuery('#ad-categories-footer').addClass('ui-autocomplete-loading').slideDown("fast");
		},
		//stop showing loading when the process is complete
		complete: function() {
			jQuery('#ad-categories-footer').removeClass('ui-autocomplete-loading');
		},
		// if data is retrieved, store it in html
		success: function(html) {
			// if no categories are found
			if ( html === "" ) {
				jQuery('#' + results_div).slideUp("fast");
				if ( jQuery(dropdown).val() === -1 && level === 2 ) {
					whenEmpty = false;
				} else {
					whenEmpty = true;
				}
			// child categories found so build and display them
			} else {
				jQuery('#' + results_div).html(html).slideDown("fast"); //build html from ajax post
				if ( level === 1 ) {
					whenEmpty = false;
				} else {
					whenEmpty = true;
				}
			}

			// always check if go button should be on or off, jQuery parent is used for traveling backup the category heirarchy
			if ( ( allow_parent_posting === 'yes' && jQuery('#chosenCategory input:first').val() > 0) ) {
				jQuery('#getcat').fadeIn();
			//check for empty category option
			} else if ( whenEmpty && allow_parent_posting === 'whenEmpty' && jQuery('#chosenCategory input:first').val() > 0 ) {
				jQuery('#getcat').fadeIn();
			//if child category exists, is set, and allow_parent_posting not set to "when empty"
			} else if ( jQuery('#' + results_div_id + (level-1)).hasClass('childCategory') && jQuery(dropdown).val() > -1 && allow_parent_posting === 'no' ) {
				jQuery('#getcat').fadeIn();
			} else {
				jQuery('#getcat').fadeOut();
			}

		}
	});
}

