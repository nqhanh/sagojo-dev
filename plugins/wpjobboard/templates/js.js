Wpjb = {
    State: null,
	Location: null,
    LogoImg: null,
    Lang: {},
    Listing: [],
    ListingId: null,
    Discount: null,
    AjaxRequest: null,

    calculate: function() {
        var listing = null;
        var id = Wpjb.ListingId;
        for(var i in Wpjb.Listing) {
            if(Wpjb.Listing[i].id == id) {
                listing = Wpjb.Listing[i];
                break;
            }
        }

        var discount = "0.00";
        var total = listing.price;
        if(Wpjb.Discount) {
            if(Wpjb.Discount.type == 2) {
                if(Wpjb.Discount.currency != listing.currency) {
                    alert(Wpjb.Lang.CurrencyMismatch);
                } else {
                    discount = Wpjb.Discount.discount;
                    total -= discount;
					var remain = Wpjb.Discount.max_uses - Wpjb.Discount.used;
					if(discount=="0.00"){ var jobpack=Wpjb.Lang.Free;}
					else if(discount=="50.00"){ var jobpack=Wpjb.Lang.Standard;}
					else if(discount=="100.00"){ var jobpack=Wpjb.Lang.Professional;}
					else if(discount=="200.00"){ var jobpack=Wpjb.Lang.Enterprise;}
					var today = new Date();
					var dd = today.getDate();
					var mm = today.getMonth()+1; //January is 0!
					var yyyy = today.getFullYear();

					if(dd<10) {
						dd='0'+dd
					} 

					if(mm<10) {
						mm='0'+mm
					} 

					today = yyyy+'-'+mm+'-'+dd;
					var date1 = new Date(today);
					var date2 = new Date(Wpjb.Discount.expires_at);
					var timeDiff = Math.abs(date2.getTime() - date1.getTime());
					var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
					
					if(total < 0) {
						alert(Wpjb.Lang.Accepted+'\n\n'+Wpjb.Lang.Name+jobpack+'\n'+Wpjb.Lang.Paid+Wpjb.Discount.code+'\n'+Wpjb.Lang.Max+Wpjb.Discount.max_uses+'\n'+Wpjb.Lang.Usage+Wpjb.Discount.used+'\n'+Wpjb.Lang.Remain+remain+'\n'+Wpjb.Lang.Expires+Wpjb.Discount.expires_at+' ('+diffDays+Wpjb.Lang.Diff+')\n\n'+Wpjb.Lang.Usethis+jobpack+Wpjb.Lang.Forthis+listing.listtitle+Wpjb.Lang.Rusure); 
					}
					else if(total > 0) {
						alert(Wpjb.Lang.Accepted+'\n\n'+Wpjb.Lang.Name+jobpack+'\n'+Wpjb.Lang.Paid+Wpjb.Discount.code+'\n'+Wpjb.Lang.Max+Wpjb.Discount.max_uses+'\n'+Wpjb.Lang.Usage+Wpjb.Discount.used+'\n'+Wpjb.Lang.Remain+remain+'\n'+Wpjb.Lang.Expires+Wpjb.Discount.expires_at+' ('+diffDays+Wpjb.Lang.Diff+')\n\n'+Wpjb.Lang.Usethis+jobpack+Wpjb.Lang.Forthis+listing.listtitle+Wpjb.Lang.overRusure); 
					}
					else {alert(Wpjb.Lang.Accepted+'\n\n'+Wpjb.Lang.Name+jobpack+'\n'+Wpjb.Lang.Paid+Wpjb.Discount.code+'\n'+Wpjb.Lang.Max+Wpjb.Discount.max_uses+'\n'+Wpjb.Lang.Usage+Wpjb.Discount.used+'\n'+Wpjb.Lang.Remain+remain+'\n'+Wpjb.Lang.Expires+Wpjb.Discount.expires_at+' ('+diffDays+Wpjb.Lang.Diff+')');}
                }
            } else {
                discount = Wpjb.Discount.discount*listing.price/100;
                total -= discount;
            }
        }

        if(total < 0) {
            total = 0;
        }

        var symbol = listing.symbol;
        var price = new Number(listing.price);
        jQuery("#wpjb_listing_cost").html(symbol+price.toFixed(2));
        discount = new Number(discount);
        jQuery("#wpjb_listing_discount").html(symbol+discount.toFixed(2));
        total = new Number(total);
        jQuery("#wpjb_listing_total").html(symbol+total.toFixed(2));
    }
};

(function($) {
    $.fn.wpjb_menu = function(options) {

        // merge default options with user options
        var settings = $.extend({
            position: "left",
            classes: "wpjb-dropdown wpjb-dropdown-shadow",
            postfix: "-menu"
        }, options);

        return this.each(function() {

            var menu = $(this);
            var img = menu.find("img");
            var ul = menu.find("ul");

            //var id = $(this).attr("id");
            var menuId = ul.attr("id");

            $("html").click(function() {
                $("#"+menuId).hide();
                $("#"+menuId+"-img").removeClass("wpjb-dropdown-open");
            });
            
            ul.find("li a").hover(function() {
                $(this).addClass("wpjb-hover");
            }, function() {
                $(this).removeClass("wpjb-hover");
            });

            ul.hide();
            $(this).after(ul);
            $(this).click(function(e) {
                var dd = $("#"+menuId);
                var visible = dd.is(":visible");
                dd.css("position", "absolute");
                dd.css("margin", "0");
                dd.css("padding", "0");

                $("html").click();
                
                img.addClass("wpjb-dropdown-open");

                var parent = $(this).position();
                var parent_width = $(this).width();

                //dd.css("top", parent.top+$(this).height());

                if(settings.position == "left") {
                    dd.css("left", parent.left);
                } else {
                    dd.show();
                    dd.css("left", parent.left+parent_width-dd.width());
                }

                if(visible) {
                    dd.hide();
                } else {
                    dd.show();
                }

                e.stopPropagation();
                e.preventDefault();
            });
        });


    }
})(jQuery);


jQuery(function() {

    if(jQuery("input#protection")) {
        jQuery("input#protection").attr("value", Wpjb.Protection);
    }

    if(jQuery(".wpjb_apply_form")) {
        var hd = jQuery('<input type="hidden" />');
        hd.attr("name", "protection");
        hd.attr("value", Wpjb.Protection);
        jQuery(".wpjb_apply_form").append(hd);
    }
	
	if(jQuery("#job_location")) {

        // Change State: select or input[type=text]
        var altState = jQuery('<input type="text" />')
            .hide()
            .attr("id", "job_location_text")
            .attr("value", Wpjb.State)
            .attr("name", "job_location_text");

        jQuery("#job_location").after(altState);

        jQuery("#job_country").bind("change", function() {
            var stateSelect = jQuery("#job_location");
            var stateInput = jQuery("#job_location_text");
            if(jQuery(this).val() != 704) {
                stateInput.show();
                stateSelect.hide();
            } else {
                stateInput.hide();
                stateSelect.show();
            }
        });

        jQuery("#job_country").trigger("change");
    }
	
	if(jQuery("#company_location")) {

        // Change State: select or input[type=text]
        var altState = jQuery('<input type="text" />')
            .hide()
            .attr("id", "company_location_text")
            .attr("value", Wpjb.Location)
            .attr("name", "company_location_text");

        jQuery("#company_location").after(altState);

        jQuery("#company_country").bind("change", function() {
            var stateSelect = jQuery("#company_location");
            var stateInput = jQuery("#company_location_text");
            if(jQuery(this).val() != 704) {
                stateInput.show();
                stateSelect.hide();
            } else {
                stateInput.hide();
                stateSelect.show();
            }
        });

        jQuery("#company_country").trigger("change");
    }
	
	
	
	

    // Insert image
    if(Wpjb.LogoImg != null) {
        var logoWrap = jQuery("<div></div>");
        var logoImg = jQuery("<img />");
        logoImg.attr("alt", "");
        logoImg.attr("src", Wpjb.LogoImg);
        logoWrap.append(logoImg);
        jQuery("#wpjb-input-company_logo").append(logoWrap);
    }

    // Coupon handling
    var listingDiv = jQuery(".wpjb-fieldset-coupon");
    var table = jQuery("<table></table>");
    table.attr("id", "wpjb_pricing");
    var tbody = jQuery("<tbody></tbody>");

    var tr1 = jQuery("<tr></tr>");
    var td11 = jQuery("<td></td>").append(Wpjb.Lang.ListingCost+":");
    var span1 = jQuery("<span></span>")
        .attr("id", "wpjb_listing_cost")
        .append(Wpjb.Lang.SelectListingType);
    var td12 = jQuery("<td></td>").append(span1);

    var tr2 = jQuery("<tr></tr>");
    var td21 = jQuery("<td></td>").append(Wpjb.Lang.Discount+":");
    var span2 = jQuery("<span></span>")
        .attr("id", "wpjb_listing_discount")
        .append(Wpjb.Lang.SelectListingType);
    var td22 = jQuery("<td></td>").append(span2);

    var tr3 = jQuery("<tr></tr>").attr("id", "wpjb_table_total");
    var td31 = jQuery("<td></td>").append(Wpjb.Lang.Total+":");
    var span3 = jQuery("<span></span>")
        .attr("id", "wpjb_listing_total")
        .append(Wpjb.Lang.SelectListingType);
    var td32 = jQuery("<td></td>").append(span3);

    tr1.append(td11).append(td12);
    tr2.append(td21).append(td22);
    tr3.append(td31).append(td32);
    tbody.append(tr1).append(tr2).append(tr3);
    table.append(tbody);
    listingDiv.append(table);

    var small = jQuery("<small></small>");
    small.attr("id", "wpjb-coupon-check");
    small.addClass("wpjb-none");
    jQuery("#coupon").after(small);

    jQuery("#coupon").blur(function() {
        var value = jQuery("#coupon").val();
        if(value.length == 0) {
            small.addClass("wpjb-none");
            return;
        }

        var data = {"code": value};
        jQuery.ajax({
            url: Wpjb.AjaxRequest,
            dataType: 'json',
            data: data,
            type: "POST",
            success: function(data) {

                small.removeClass("wpjb-none");

                if(data.isError) {
                    small.addClass("wpjb-coupon-error").html(data.error);
                    return;
                }

                small.addClass("wpjb-coupon-ok");
                Wpjb.Discount = data;
                Wpjb.calculate();
            }
        });
    });

    
    jQuery(".wpjb-element-name-listing input[type=radio]").bind("click", function() {
        Wpjb.ListingId = jQuery(this).val();
        Wpjb.calculate();

    });
    jQuery(".wpjb-element-name-listing input[type=radio]:checked").trigger("click");

    jQuery("#wpjb_reset").click(function() {
        if(confirm(Wpjb.Lang.ResetForm)) {
            var form = jQuery(".wpjb-form");
            form.append(jQuery('<input type="hidden" name="wpjb_reset" value="1" />'))
            form.submit();
        }
    });

});

var WpjbResume = {
    
    Avatar: null,
    
    Message: null,

    Init: function() {
        jQuery(function() {
            jQuery("#wpjb-resume").submit(function() {
                if(!confirm(WpjbResume.Message)) {
                    return false;
                }

                return true;
            });
        });
    },

    HandleImage: function() {
        jQuery(function() {
            if(WpjbResume.Avatar) {
                WpjbResume._handleImage();
            }
        });
    },

    _handleImage: function() {
        
        var logoWrap = jQuery("<div></div>");
        var logoImg = jQuery("<img />");
        logoImg.attr("alt", "");
        logoImg.attr("src", WpjbResume.Avatar);
        logoWrap.append(logoImg);
        jQuery("#wpjb-input-image").append(logoWrap);

        var removeButton = jQuery("<button></button>");
        removeButton.attr("id", "wpjb_remove_resume_avatar");
        removeButton.text(Wpjb.Lang.Remove);

        jQuery("#wpjb-input-image input[type=file]").after(removeButton);
        jQuery("#wpjb_remove_resume_avatar").bind("click", function(e) {
            e.preventDefault();
            jQuery("#wpjb-remove-image-form-input").attr("value", 1);
            jQuery("#wpjb-remove-image-form").submit();
        });
    }
}

jQuery(function() {
    
    var autoClear = jQuery("input.wpjb-auto-clear");
    
    autoClear.each(function(index, item) {
        var input = jQuery(item);
        input.attr("autocomplete", "off");
        input.attr("wpjbdef", input.val());
        input.addClass("wpjb-ac-enabled");
    });
    
    autoClear.keydown(function() {
        jQuery(this).removeClass("wpjb-ac-enabled");
    });
    
    autoClear.focus(function() {
        var input = jQuery(this);
        
        if(input.val() == input.attr("wpjbdef")) {
            input.val("");
            input.addClass("wpjb-ac-enabled");
        }
        
    });
    
    autoClear.blur(function() {
        var input = jQuery(this);
        input.removeClass("wpjb-ac-enabled");
        
        if(input.val() == "") {
            input.val(input.attr("wpjbdef"));
            input.addClass("wpjb-ac-enabled");
        }
    });
    
    autoClear.closest("form").submit(function() {
        autoClear.unbind("click");
        if(autoClear.val() == autoClear.attr("wpjbdef")) {
            autoClear.val("");
        }
    });

});
