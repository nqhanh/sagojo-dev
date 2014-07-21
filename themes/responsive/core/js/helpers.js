var		DIALOG_GENERAL_ERROR = "Có lỗi xảy ra.",
		DIALOG_NO_CONNECTION = "Bạn không kết nối với Internet. Ứng dụng sẽ tải dữ liệu đã có lần cuối bạn truy cập.",
		DIALOG_RELOAD_CONFIRM = 'Sẻ xóa và tải lại danh sách bài viết của các chuyên mục. Bạn có muốn tiếp tục?',
		DIALOG_ERROR_RELOAD = "Có lỗi xảy ra. Trang web sẽ được tải lại.",
		DIALOG_MSG_NOINTERNET_WITHCONTENT = "Không thể kết nối đến Internet. Zing News sẽ lấy bản lưu trước đây.",
		DIALOG_MSG_NOINTERNET_WITHOUTCONTENT = "Không thể tải dữ liệu vì bạn không kết nối đến Internet (không có bản lưu).",
		DIALOG_DATA_ERROR_WITHCONTENT = "Có lỗi xảy ra khi lấy dữ liệu từ Internet. Sẽ lấy bản lưu trước đây.",
		DIALOG_MSG_UNSTABLE_CONNECTION = "Đường truyền Internet không ổn định. Bạn vui lòng thử lại.",
		DIALOG_MSG_NOINTERNET = "Bạn không kết nối với Internet",
		DIALOG_MSG_RELOAD_CONFIRM = "Bạn có muốn tải lại dữ liệu mới nhất?",
		DIALOG_DATA_ERROR_NOCONTENT = "Có lỗi xảy ra khi lấy dữ liệu từ Internet.",
		DIALOG_ERROR_EMPTY = "Lỗi dữ liệu trả về. Bạn có muốn thử tải lại?",
		DIALOG_AT_BEGINNING = "Bạn đang ở đầu danh sách!",
		DIALOG_AT_END = "Bạn đã xem hết bài của chuyên mục. Bạn có muốn xem chuyên mục tiếp theo?", 
		DIALOG_SWITCH_DESKTOP = "Bạn muốn chuyển sang xem giao diện truyền thống của Zing News?",
		ERR_CODE_TRANSITION = 100;


/* This setup a mechanism for clear all pending ajax call */
$.xhrPool = [];
$.xhrPool.abortAll = function() {    $(this).each(function(idx, jqXHR) { jqXHR.abort(); }); $.xhrPool.length = 0};
$.ajaxSetup({
	//timeout:5000, // default timeout = 5s
	beforeSend: function(jqXHR) {
        $.xhrPool.push(jqXHR);
        // log ("Total ajax call in progress:" + $.xhrPool.length);
    },
    complete: function(jqXHR) {
        var index = $.xhrPool.indexOf(jqXHR);
        if (index > -1) {
            $.xhrPool.splice(index, 1);
            // log ("Total ajax call in progress:" + $.xhrPool.length);
        }
    }    
});
		
function getArticleId(url) {
	var filename = $.mobile.path.parseUrl(url).filename;
	if(/a\d+\.html/i.test(filename)) {
		return filename.replace(/\.[a-z]*/,'');
	} else {
		return "";
	}	
}

function getArticleLink(url) {
	var linkObj = $.mobile.path.parseUrl(url);
	if (linkObj.hostname!="") {
		return 'http://touch.news.zing.vn/ajax/mobilejson/detail/'+(linkObj.filename).replace('.html','.json');	
	} else {
		return 'http://touch.news.zing.vn/ajax/mobilejson/detail/'+linkObj.filename+'.json';
	}
			
}

function getCateId(url) {
	return ($.mobile.path.parseUrl(url).filename).replace(/\.[a-z]*/,'');
}

function getCateLink(cateid) {
	return $('#menu li[cate-id="'+cateid+'"]').attr('data-source');	
}

function getCateDataSource(cateid) {	
	return "http://touch.news.zing.vn/ajax/mobilejson/page/"+cateid+".json";
}

function getCateName(cateid) {
	return $('#menu li[cate-id="'+cateid+'"] a').attr('title');
}

function getCateDOM(cateid) {
	var dom = $('#category > div[cate-id="'+cateid+'"]');
	if (dom.length == 1) return dom;
	else return null;
}

function getArticleDOM(articleid) {
	var dom = $('#article > div[article-id="'+articleid+'"]');
	if (dom.length == 1) return dom;
	else return null;
}

function showBusy(modal) {
	// if ((modal && modal === true) || (display && display.speed == "low") ) {
		// $('#loadingmsg').addClass('modal');		
	// }
	$('#loadingmsg').show();
}

function hideBusy() {
	$('#loadingmsg').removeClass('modal').hide();
}

function getStateUrl() {
	var hash = $.mobile.path.parseUrl(location.href).hash;
	if (/^#\//.test(hash)) {
		return hash.replace(/^#\//,'');
	} else {
		return "http://news.zing.vn";
	}
}

function showAppUpgrade(ver, releasedate) {	
	//alert("App Upgraded");
	window.sessionStorage.clear();
	_gaq.push(['_trackEvent', 'App', 'Update version', ver + "(" + releasedate + ")"]);

}

// Check if a new cache is available on page load.
window.addEventListener('load', function(e) {
	window.applicationCache.addEventListener('updateready', function(e) {
		if (window.applicationCache.status == window.applicationCache.UPDATEREADY) {
			// Browser downloaded a new app cache.
			// Swap it in and reload the page to get the new hotness.
			window.applicationCache.swapCache();
			$.cookie('upgraded', 'valid', { expires: 30 });
		}
	}, false);

}, false); 

function popup(MESSAGE, code, callback) {
	var msg = MESSAGE;	
	if (DEBUG_MODE) msg += " (Error Code = "+code+")";
	if (callback && (typeof callback == 'function')) {
		if(confirm(msg)) {
			callback();
		}
	} else {
		alert(msg);
	}		
}

/* A function to represent a queue / by Stephen Morley - http://code.stephenmorley.org/ */
function Queue(){var _1=[];var _2=0;this.getLength=function(){return (_1.length-_2);};this.isEmpty=function(){return (_1.length==0);};this.enqueue=function(_3){_1.push(_3);};this.dequeue=function(){if(_1.length==0){return undefined;}var _4=_1[_2];if(++_2*2>=_1.length){_1=_1.slice(_2);_2=0;}return _4;};this.peek=function(){return (_1.length>0?_1[_2]:undefined);};};

function countWords(content){
	var s = content;
	s = s.replace(/(^\s*)|(\s*$)/gi,"");
	s = s.replace(/[ ]{2,}/gi," ");
	s = s.replace(/\n /,"\n");
	return s.split(' ').length;
}

/* Calculate time span between time in the past and the current, represent as a readable string */
function getTimeSpan(time, friendly) {	
	var difference, days, hours, minutes;
	if (friendly && friendly===true) {
		var time = time.replace(/:/,"index.html").replace(/(\,\s)/,"/").split('index.html');
		difference = (new Date()).getTime() - (new Date(parseInt(time[2]), parseInt(time[1])-1, parseInt(time[0]),parseInt(time[3]), parseInt(time[4]))).getTime();	
	} else {
		difference = (new Date()).getTime() - time;
	}
		
	var days = Math.floor(difference/1000/60/60/24);
    difference -= days*1000*60*60*24;
    var hours = Math.floor(difference/1000/60/60);
    difference -= hours*1000*60*60;
    var minutes = Math.floor(difference/1000/60);
    difference -= minutes*1000*60;   
     
    if (friendly && friendly===true) {
    	if (days == 0) {
	    	if (hours == 0) return minutes + " phút trước";
	    	else {
	    		if (minutes < 10) return "hơn " + hours + " giờ trước"
	    		else return hours + "h " + minutes + "' trước";
	    	}
	    } 
	    else if (days == 1) {
	    	return "Hôm qua, lúc " + time[3] + "h" + time[4];
	    } 
	    
	    return ""+time[0]+"/"+time[1]+"/"+time[2] + " | "+time[3]+"h"+time[4];	
    } else {
    	return days + " ngày " + hours + "h " + minutes + "";
    }
}

// Initialize local storage
// @params: kind = "session"/"local"
function Storage(kind) {
	
	var timeflag = "-timestamp";
	var dbkind = kind;
	var localdb = window.localStorage; 
	if (dbkind=="session") localdb = window.sessionStorage;
	
	// Get content from storage for a key
	// @params: key
	// @return: false if no local db support, null if no key exist, else return {age,content} for age = content age (minute)
	this.loadContent = function(key) {
		if (this.isSupported()) {
			data = localdb.getItem(key);
			timestamp = localdb.getItem(key+timeflag);
			currentTime = (new Date()).getTime();
			if (data!= null && timestamp != null) {
				return {age:Math.round((currentTime-parseInt(timestamp))/60000), content:data};	
			} else {
				return null;
			}
			
		} else {
			false;
		}
	}
	
	this.insertContent = function(key, data, updatetime) {
		if (this.isSupported()) {
			current = (new Date()).getTime();
			try {
				localdb.setItem(key, data);
				localdb.setItem(key+timeflag, current);
				if(updatetime==null || updatetime===true) {
					localdb.setItem("lastupdate", current );						
				} 				
			} catch (e) {
				// log ("Error code: ", e);
				this.clear();
				this.insertContent(key, data, updatetime);
			}			
			return true;
		}
		else {
			return false;
		}
	}
	
	this.insert = function(key,data) {
		if (this.isSupported()) {
			try {
				localdb.setItem(key, data);
			} catch (e) {
				this.clear();
				this.insert(key, data);
			}
		} else {
			return false;
		}
	}
	
	this.load = function(key) {
		if (this.isSupported()) {
			return localdb.getItem(key);
		} else {
			return false;
		}
	}
	
	this.clear = function() {
		var a = this.load('configurations');
		localdb.clear();
		this.insert('configurations',a);
	}
	
	this.lastUpdate = function() {
		if (this.isSupported()) {
			return localdb.getItem("lastupdate");
		}
		return false;
	}
	
	this.isSupported = function() {
		try {
			if (dbkind == "session") {
				return 'sessionStorage' in window && window['sessionStorage'] !== null;	
			}
			return 'localStorage' in window && window['localStorage'] !== null;
		} catch (e) {
			return false;
		}
	}
	
}

/* Encode HTML string */
function htmlEncode(value){  	
	//html = $('<div/>').text(value).html();
	html = value.replace(/\s/g,"%20");
	html = html.replace(/&/g,"%26");
	//https://www.facebook.com/sharer/sharer.php?s=100&p[title]=Doanh+nh%C3%A2n+H%C3%A0+D%C5%A9ng+%C4%91i+bar+k%E1%BB%83+chuy%E1%BB%87n+b%C3%A1n+bi%E1%BB%87t+th%E1%BB%B1&p[url]=http%3A%2F%2Fnews.zing.vn%2Fkinh-doanh%2Fdoanh-nhan-ha-dung-di-bar-ke-chuyen-ban-biet-thu%2Fa284047.html%23share_button_bottom&p[images][0]=http%3A%2F%2Fimg2.news.zing.vn%2F2012%2F11%2F09%2Fhadung20.jpg&p[summary]=%C3%94ng+ch%E1%BB%A7+h%C3%A3ng+h%C3%A0ng+kh%C3%B4ng+t%C6%B0+nh%C3%A2n+%C4%91%E1%BA%A7u+ti%C3%AAn+t%E1%BA%A1i+Vi%E1%BB%87t+Nam+-+Indochina+Airlines+k%E1%BB%83+r%E1%BA%B1ng%2C+%C4%91%C3%A3+ph%E1%BA%A3i+b%C3%A1n+7+c%C3%A1i+bi%E1%BB%87t+th%E1%BB%B1%2C+25+chi%E1%BA%BFc+xe+h%C6%A1i+%C4%91%E1%BB%83+gi%E1%BA%A3i+quy%E1%BA%BFt+n%E1%BB%A3+n%E1%BA%A7n+t%E1%BB%AB+vi%E1%BB%87c+l%C3%A0m+h%C3%A0ng+kh%C3%B4ng.
  	return html;
}

/* Help clean HTML content */
function cleanContent(text) {	
	var resultTxt = text;
	// clear unsupport elements
	resultTxt = resultTxt.replace(/<p[^>]*>(\s|\t|\&nbsp\;)*<\/p>/g,""); // remove empty paragraph
	resultTxt = resultTxt.replace(/<[\/]*(iframe|object|param|embed|span)[^>]*>/g,""); // remove unsupported element
	resultTxt = resultTxt.replace(/\<![ \r\n\t]*(--([^\-]|[\r\n]|-[^\-])*--[ \r\n\t]*)\>/g,""); // remove HTML comment
	resultTxt = resultTxt.replace('&nbsp;',' ');	
	resultTxt = resultTxt.replace(/style="[^"]*"/g,""); // remove inline style		
	return resultTxt;
}

function showAdPopup(id, img, url) {
	if($.cookie(id) != "valid") {
		_gaq.push(['_trackEvent', 'Advertising', display.platform, id + " : Show Popup on Start"]);
		$('#popup_content').html("<img src='ads/"+img+"' width='320' height='490'/>");
		$('#popup .btnSubmit').bind('tap', function(){
			_gaq.push(['_trackEvent', 'Advertising', display.platform, id + " : Click on Popup"]);
			$.cookie(id, 'valid', { expires: 30 });
			if (display.platform=="ios") {
				window.location = url.ios;	
			} else  {
				window.location = url.android;
			}
			
		});
		$('#popup .btnCancel').bind('tap', function(e){			
			_gaq.push(['_trackEvent', 'Advertising', display.platform, id + " : Ignore Popup"]);
			$.cookie(id, 'valid', { expires: 10 });
			setTimeout(function() {
				$('#popup').hide();
			}, 500);
			e.stopPropagation();
		});
		$('#popup').show();	
				
		
	}
}

function hidePopup(popupid) {
	$('#'+popupid).hide();
	$('#popups').hide();
}

/* This function help detect device and set the body id to either tablet or phone. It also set the global device variable. */
function detectDevice() {
	var type, speed = "high", platform = "unknown", device="unknown";
	var userAgent = navigator.userAgent.toLowerCase();	
	
	log("Detect Agent String: "+userAgent);	
	if (/ipad/i.test(userAgent)) { type = "tablet"; speed = "high"; platform = "ios"; device="ipad"}
	else if (/iphone/i.test(userAgent)) {type="phone"; speed = "high"; platform = "ios"; device="iphone"} 	
	else if (/android/i.test(userAgent) && !(/mobile/i.test(userAgent))) { type = "tablet"; platform="android"; speed="medium"; }
	else if (/android/i.test(userAgent)) {type="phone"; platform="android"; speed="medium";}
	else { speed = "high"; platform="web";}
	
	if (userAgent.match(/android [\d+\.]{1}/)) {
		speed = "low";
		/*
		droid = userAgent.match(/android [\d+\.]{1}/)[0].replace('android ','');
		if (parseInt(droid) < 4) {			
			speed = "low";
		}
		*/	
	}
	 	
	// platform = "ios";		
	// speed = "medium";
	// type = "phone";
	display = {deviceName:device,deviceType:type, performance: speed, platform:platform, deviceWidth:$(document).width(), deviceHeight:$.mobile.getScreenHeight()};
	if (display.deviceType!=null) {$('body').attr('id',display.deviceType);} 	
}


/* This code extend jquery event to support swipe up and swipe down */
(function() {
	// initializes touch and scroll events
	var supportTouch = $.support.touch, scrollEvent = "touchmove scroll", touchStartEvent = supportTouch ? "touchstart" : "mousedown", touchStopEvent = supportTouch ? "touchend" : "mouseup", touchMoveEvent = supportTouch ? "touchmove" : "mousemove";

	// handles swipeup and swipedown
	$.event.special.swipeupdown = {
		setup : function() {
			var thisObject = this;
			var $this = $(thisObject);

			$this.bind(touchStartEvent, function(event) {
				var data = event.originalEvent.touches ? event.originalEvent.touches[0] : event, start = {
					time : (new Date).getTime(),
					coords : [data.pageX, data.pageY],
					origin : $(event.target)
				}, stop;

				function moveHandler(event) {
					if (!start) {
						return;
					}

					var data = event.originalEvent.touches ? event.originalEvent.touches[0] : event;
					stop = {
						time : (new Date).getTime(),
						coords : [data.pageX, data.pageY]
					};

					// prevent scrolling
					if (Math.abs(start.coords[1] - stop.coords[1]) > 10) {
						event.preventDefault();
					}
				}


				$this.bind(touchMoveEvent, moveHandler).one(touchStopEvent, function(event) {
					$this.unbind(touchMoveEvent, moveHandler);
					if (start && stop) {
						if (stop.time - start.time < 1000 && Math.abs(start.coords[1] - stop.coords[1]) > 30 && Math.abs(start.coords[0] - stop.coords[0]) < 75) {
							start.origin.trigger("swipeupdown").trigger(start.coords[1] > stop.coords[1] ? "swipeup" : "swipedown");
						}
					}
					start = stop = undefined;
				});
			});
		}
	};

	//Adds the events to the jQuery events special collection
	$.each({
		swipedown : "swipeupdown",
		swipeup : "swipeupdown"
	}, function(event, sourceEvent) {
		$.event.special[event] = {
			setup : function() {
				$(this).bind(sourceEvent, $.noop);
			}
		};
	});

})(); 

/**
 * This code a fallback implementation of JSON.stringtify method for older browsers 
 */
jQuery.extend({
	stringify : function stringify(obj) {
		if ("JSON" in window) {	return JSON.stringify(obj);	}
		var t = typeof (obj);
		if (t != "object" || obj === null) {if (t == "string")	obj = '"' + obj + '"';	return String(obj);
		} else {var n, v, json = [], arr = (obj && obj.constructor == Array);for (n in obj) {v = obj[n];t = typeof (v);	if (obj.hasOwnProperty(n)) {if (t == "string") {v = '"' + v + '"';} else if (t == "object" && v !== null) {	v = jQuery.stringify(v);}json.push(( arr ? "" : '"' + n + '":') + String(v));}}	return ( arr ? "[" : "{") + String(json) + ( arr ? "]" : "}");}
	}
}); 

/* Cross browser loging mechanism */

if (Function.prototype.bind && ( typeof console == "object" || typeof console == "function") && typeof console.log == "object") {
	["log", "info", "warn", "error", "assert", "dir", "clear", "profile", "profileEnd"].forEach(function(method) {
		console[method] = this.call(console[method], console);
	}, Function.prototype.bind);
}
if (!window.log) {
	window.log = function() {		
		if (DEBUG_MODE) {
			log.history = log.history || [];
			log.history.push(arguments);
			if ( typeof console != 'undefined' && typeof console.log == 'function') {
				if (window.opera) {
					var i = 0;
					while (i < arguments.length) {
						console.log("Item " + (i + 1) + ": " + arguments[i]);
						i++;
					}
				} else if ((Array.prototype.slice.call(arguments)).length == 1 && typeof Array.prototype.slice.call(arguments)[0] == 'string') {
					console.log((Array.prototype.slice.call(arguments)).toString());
				} else {
					console.log(Array.prototype.slice.call(arguments));
				}
			} else if (!Function.prototype.bind && typeof console != 'undefined' && typeof console.log == 'object') {
				Function.prototype.call.call(console.log, console, Array.prototype.slice.call(arguments));
			} else {
				if (!document.getElementById('firebug-lite')) {
					var script = document.createElement('script');
					script.type = "text/javascript";
					script.id = 'firebug-lite';
					script.src = 'https://getfirebug.com/firebug-lite.js';
					document.getElementsByTagName('HEAD')[0].appendChild(script);
					setTimeout(function() {
						log(Array.prototype.slice.call(arguments));
					}, 2000);
				} else {
					setTimeout(function() {
						log(Array.prototype.slice.call(arguments));
					}, 500);
				}
			}
		}		
	}
}

/**
 * This code help create/remove cookie. 
 * https://github.com/carhartl/jquery-cookie
 */
(function ($, document, undefined) {

	var pluses = /\+/g;

	function raw(s) {
		return s;
	}

	function decoded(s) {
		return decodeURIComponent(s.replace(pluses, ' '));
	}

	var config = $.cookie = function (key, value, options) {

		// write
		if (value !== undefined) {
			options = $.extend({}, config.defaults, options);

			if (value === null) {
				options.expires = -1;
			}

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setDate(t.getDate() + days);
			}

			value = config.json ? JSON.stringify(value) : String(value);

			return (document.cookie = [
				encodeURIComponent(key), '=', config.raw ? value : encodeURIComponent(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				options.secure  ? '; secure' : ''
			].join(''));
		}

		// read
		var decode = config.raw ? raw : decoded;
		var cookies = document.cookie.split('; ');
		for (var i = 0, l = cookies.length; i < l; i++) {
			var parts = cookies[i].split('=');
			if (decode(parts.shift()) === key) {
				var cookie = decode(parts.join('='));
				return config.json ? JSON.parse(cookie) : cookie;
			}
		}

		return null;
	};

	config.defaults = {};

	$.removeCookie = function (key, options) {
		if ($.cookie(key) !== null) {
			log ("Remove Cookie " + key);
			$.cookie(key, null, options);
			return true;
		}
		return false;
	};

})(jQuery, document);


