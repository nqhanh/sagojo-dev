var display, aCount=1, pageId=1, timeout, lastPage, lastAnimation;
var ARTICLE_PER_PAGE = 30, DEBUG_MODE = false;
var VERSION = '2.164', RELEASEDATE = "03/06/2013";
var App = new AppEngine();
var menu, inTransition = false, inappnav = false, timing1, timing2;


$(document).ready(function(){	
	if($.cookie('upgraded') == "valid") {
		showAppUpgrade(VERSION, RELEASEDATE);
		$.removeCookie('upgraded');
	}	
	detectDevice();
	showAdPopup('mp3_campaign', "zingmp3.html", {ios:'https://itunes.apple.com/vn/app/zing-mp3/id457008165', android:'https://play.google.com/store/apps/details?id=mp3.zing.vn'});
	App.initializeController();		
	App.render.updateLayout();
	$('a').live('tap', function(event, data){
		if (!$(this).hasClass('linked')) {
			event.preventDefault();	
		}
	});			
});

$(window).bind('load', function(){
	
	var hash = $.mobile.path.parseUrl(location.href).hash;
	$('#menu').show();
	menu = new iScroll('menu',  { hScroll:true,vScroll:false, hScrollbar: false, vScrollbar: false });		
	$('#menu li').bind('tap', function(){
		_gaq.push(['_trackEvent', 'App', 'Menu', 'Click']);
		
		if ($($.mobile.activePage).parents('#article').length!=0) {
			App.gotoCate($(this).attr('cate-id'), {transition:'flip'});
		} else {
			App.gotoCate($(this).attr('cate-id'));
		}			
	});
	
	if (/^#\//.test(hash) && /\.html/.test(hash)) {	
		App.detectState(hash);		
	} else {
		if (display.performance == "low") {
			window.location.href = "http://m.news.zing.vn/";
		}
		var frontpage = 'home';
		App.feed.loadArticlesListJSON(getCateDataSource(frontpage), {pageIndex:0, postLimit:100}, function(articles){
			App.render.renderArticleList(articles, {cateId:frontpage, cateName: getCateName(frontpage), cateUrl:getCateLink(frontpage)}, function(catePage) {						
				try {
					setTimeout(function(){
						$.mobile.changePage($(catePage),{transition:'slide',reverse:false});												
						setTimeout(function() {
							App.prefetchCates(new Array('home','new', 'doi-song','the-thao','the-gioi-sao'));
						}, 1000);	
					}, 200);
				} catch (e) {
					popup(DIALOG_GENERAL_ERROR, ERR_CODE_TRANSITION);
				}
				
			});
		});		
	}		
}).bind('resize', function(){
	setTimeout(function(){
		App.render.updateLayout();
		$('.iscroll-scroller').each(function(){
			if($(this).parents('#category').length!=0) {
				$(this).css('height',($(this).find('ul').height()+50)+'px');
			} else if ($(this).parents('#article').length!=0) {
				$(this).css('height',($(this).find('.article-content').height()+50)+'px');
			}
			$(this).parents('div[data-role="content"]').iscrollview("refresh");	
		});
	}, 250);
});

$(window).hashchange(function(){
	var hash = location.hash;
	if (!inappnav && /^#\//.test(hash)) {
		App.detectState(hash);			
	} else {
		inappnav = !inappnav;
	}
});

function AppEngine() {
	
	this.storage = new Storage("local");
	this.tempStorage = new Storage("session");
	this.feed = new FeedReader('json');
	this.render = new RenderEngine();
	this.animationInProgress = false;
	this.temp = null;
	
	var self = this;
	
	this.detectState = function(hash) {		
		var url = hash.replace(/(#\/)*/,'');
		if (display.performance == "low") {
			window.location.href = url.replace('http://news.zing.vn/', 'http://m.news.zing.vn/');
		}
		var filename = $.mobile.path.parseUrl(url).filename;		
		if (/a[0-9]+\.html/.test(filename)) {
			if ($($.mobile.activePage).parents('#article').length==0) {
				App.gotoArticle(url,{transition:'flip', reverse:false});
			} else {
				App.gotoArticle(url);	
			}			
		} else {
			if (filename=="") filename="home.html";
			var cateid = filename.replace(/\.[a-z]*/,'');
			if ($($.mobile.activePage).parents('#article').length!=0) {
				App.gotoCate(cateid,{transition:'flip', reverse:false});
			} else {
				App.gotoCate(cateid);
			}
			
		}
		
	}
	
	// Prefetch single cate, provide cateid)
	// @params: cateid such as "home", "new", "doi-song",...
	this.prefetchCate = function(cateid) {
		var link = getCateDataSource(cateid);
		var cateName = getCateName(cateid);
		
		if (self.tempStorage.isSupported() && getCateDOM(cateid)==null && !$("#menu li[cate-id='"+cateid+"']").attr('prefetched')) {
			_gaq.push(['_trackEvent', 'Load Data', 'Category', "Prefetch Category"]);			
			self.feed.loadArticlesListJSON(link, {allowqueue:true});
		}
	}
	
	// Prefetch cate group, only when no page transition is occurring, maximum 2 call at a time
	// @params: cateGroup = array of cateid to be fetched ('home', 'new', 'doi-song'...)
	this.prefetchCates = function(cateGroup, timer) {
		var cates = $.makeArray(cateGroup);	
		if (cates.length > 0) {
			if ($.xhrPool.length<3 && !self.animationInProgress) {
				this.prefetchCate(cates[0]);
				cates.shift();this.prefetchCates(cates);	
			} else {
				setTimeout(function() {self.prefetchCates(cates, this)},1000);	
			}				
		} else {
			if (timer) clearTimeout(timer);
		}
	}
	
	this.prefetchArticles = function(cateId, container) {
		if (cateId!="home") {
			_gaq.push(['_trackEvent', 'Load Data', 'Category', "Prefetch Article List"]);
			App.feed.loadArticlesListJSON(getCateDataSource(cateId), {pageIndex:1}, function(list){
				var content = "";				
				for(var i=0,j=list.articles.length; i<j; i++){
				  content += self.render.renderArticleItem(list.articles[i], {hidden:true});
				};
				$(container).find('ul').append(content);
			});	
		}
	}
	
	this.prefetchArticle = function(article_url) {
		App.feed.loadArticleJSON(getArticleLink(article_url));
	}
	
	this.gotoCate = function(toCate, options) {
		var previd = $('#menu li.current').attr('cate-id');
		$('#menu li').removeClass('current');
		$('#menu li[cate-id="'+toCate+'"]').addClass('current');
		showBusy();
		var idx1 = $('#menu li').index($('li[cate-id="'+previd+'"]'));
		var idx2 = $('#menu li').index($('li[cate-id="'+toCate+'"]'));		
		var effect = (display.performance=="high" && options && options.transition) ? options.transition : 'slide';		
		var direction = (options && options.reverse) ? options.reverse : (idx1 > idx2);
		
		if($('#category > div[cate-id="'+toCate+'"]').length!=0) {				
			$.mobile.changePage($('#category > div[cate-id="'+toCate+'"]'),{transition:effect,reverse:direction});
			return;			
		} else {						
			App.feed.loadArticlesListJSON(getCateDataSource(toCate), {}, function(articles){
				App.render.renderArticleList(articles, {cateId:toCate, cateName: getCateName(toCate), cateUrl:getCateLink(toCate)}, function(catePage) {
					try {			
						$.mobile.changePage($(catePage),{transition:effect,reverse:direction});
						setTimeout(function(){ App.prefetchArticles(toCate, catePage);}, 500);
					} catch (e) {
						popup(DIALOG_GENERAL_ERROR, ERR_CODE_TRANSITION);
					}
				});
			});	
			return;
		}		
	}
	
	this.gotoPrevCate = function() {		
		log("Goto Prev Cate");
		var previous = $('#menu li.current').prev()[0];
		if (previous) {
			menu.scrollToElement(previous, 300);
			showBusy();	
			self.gotoCate($(previous).attr('cate-id'));
		} else {
			inTransition = false;
		}
	}
	
	this.gotoNextCate = function() {		
		log("Goto Next Cate");
		var next = $('#menu li.current').next()[0];
		if (next) {
			menu.scrollToElement(next, 300);
			showBusy();	
			self.gotoCate($(next).attr('cate-id'));
		} else {
			self.gotoCate('home');
		}		
	}
	
	this.gotoArticle = function(url, options) {	
		showBusy();	
		var effect = (display.performance=="high" && options && options.transition) ? options.transition : 'slide';		
		var direction = (options && options.reverse) ? options.reverse : false;
		var article = $('#category li[article-id="'+getArticleId(url)+'"]');
		var prefetch = null;
		if ($('#article > div[article-id="'+getArticleId(url)+'"]').length!=0) {
			log("article already loaded");
			$.mobile.changePage($('#article > div[article-id="'+getArticleId(url)+'"]'),{transition:effect, reverse:direction});
			$('#category li.current').removeClass('current');
			$(article).addClass('current');			
		} else {			
			if (article.length!= 0) {
				prefetch = {
					title:$(article).find('.heading').html(),
					cover:$(article).find('.cover img').attr('src'),
					summary:$(article).find('.summary').html(),
					time:$(article).find('.time').html(),
					category:$(article).find('.cate').html()
				};	
			}
			App.render.renderArticleContent(url,function(articleContainer){
				try { 									
					if(display.performance != "high") { effect="slide";	} 				
					$.mobile.changePage($(articleContainer), {transition:effect, reverse:direction});						
					$('#category li.current').removeClass('current');
					$(article).addClass('current');
					$(article).css('opacity', 0.5);	
				} catch (e) {	
					alert("Có lỗi xả ra. Ứng dụng sẽ được tải lại.");
				}
			}, prefetch);					
		}			
	}
	
	this.gotoPrevArticle = function() {
		var previous = $('#category li.current').prev();
		if (previous.length!=0) {
			showBusy();	
			self.gotoArticle($(previous).attr('data-source'), {reverse:true});
		} else {
			_gaq.push(['_trackEvent', 'Article', 'Go Back to Listing']);
			$('#header .btnClose').hide();
			self.gotoCate($('#menu li.current').attr('cate-id'), {transition:'flip', reverse:false});
		}
		log("Goto Prev Article");
	}
	
	this.gotoNextArticle = function() {
		var next = $('#category li.current').next();
		if (next.length!=0) {
			showBusy();	
			self.gotoArticle($(next).attr('data-source'), {reverse:false});
		} else {
			if (confirm(DIALOG_AT_END)) {				
				self.gotoNextCate();
			} else {
				inTransition = false;
			}
			
		}
		log("Goto Next Article");
	}
	
	this.reload = function(popup){
		if (popup) {
			if(confirm(popup)) {
				_gaq.push(['_trackEvent', 'App', 'Reload']);
				self.reloadData();
				window.location.reload();
			}
		} else {
			gaq.push(['_trackEvent', 'App', 'Refresh']);
			window.location.reload(); 
		}
	}
	
	// clear local storage
	this.reloadData = function() {
		self.storage.clear(); 
		self.tempStorage.clear();			
	}
	
	this.initializeController = function() {
		$(document).live('pagebeforechange',function(){
			timing1 = (new Date()).getTime();
			// before page loading & transition			
		}).live('pagechange', function(event,ui){	
			timing2 = (new Date()).getTime(); 
			log("Time delay = " + (timing2-timing1));
			// Category Page		
			if($(ui.toPage).parents('#category').length != 0) {		
				var cateId = $(ui.toPage).attr('cate-id');		
				// $(ui.toPage).find('li').noClickDelay();
				$('#menu').show();
				$(ui.toPage).find('.iscroll-scroller').css('height',($(ui.toPage).find('ul').height()+90)+'px');
				$(ui.toPage).find('div[data-role="content"]').iscrollview("refresh");	
				$(ui.toPage).find(".iscroll-wrapper").bind("iscroll_onpullup", function () {
					var hiddens = $(ui.toPage).find('li.hidden');											
					if($(hiddens).length > 0) {												
						$(hiddens).removeClass('hidden');
						$(ui.toPage).find('.iscroll-scroller').css('height',($(ui.toPage).find('ul').height()+90)+'px');
						$(ui.toPage).find('.iscroll-pull-label').remove();
						$(ui.toPage).find('div[data-role="content"]').iscrollview("refresh");
						_gaq.push(['_trackEvent', 'Category', 'Load More', $('#menu li.current>h1').text()]);													
					} else {
						$(ui.toPage).find('.iscroll-pull-label').remove();
					}												
				});					
				_gaq.push(['_trackEvent', 'Category', 'View', $('#menu li.current>h1').text(), (timing2-timing1)]);						
				$(ui.toPage).siblings('div[data-role="page"]').remove();
				$('#article div[data-role="page"]').remove();													
			} 
			// Article Page
			else if ($(ui.toPage).parents('#article').length != 0){
				$('#header .btnClose').show();
				$('#menu').hide();
				$(ui.toPage).find('.iscroll-scroller').css('height',($(ui.toPage).find('.article-content').height()+50)+'px');
				$(ui.toPage).find('div[data-role="content"]').iscrollview("refresh");
				_gaq.push(['_trackEvent', 'Article', 'View', $(ui.toPage).find('.aTitle').text(), (timing2-timing1)]);				
			}
			if($(ui.toPage).attr('data-source')) {
				var url = $(ui.toPage).attr('data-source');
				inappnav = true;
				window.location.hash = "#/"+$(ui.toPage).attr('data-source');				
				_gaq.push(['_trackPageview', url.replace("http://news.zing.vn/","")]);				
			}			
			
			lastAnimation = {effect:ui.options.transition, reverse:ui.options.reverse};
			inTransition = false;
			hideBusy();			
			// ((new Date()).getTime() - timing)
		}).live('pagebeforeshow', function(event, ui) {			
			lastPage = ui.prevPage;
		});
		
		$('#header > div').live('tap', function(){
			if($(this).hasClass('btnCategory')) {				
				if($('#menu').is(":visible")) {
					_gaq.push(['_trackEvent', 'App', 'Menu', 'Hide']);
					$('#menu').hide();
				} else {
					_gaq.push(['_trackEvent', 'App', 'Menu', 'Show']);
					$('#menu').show();
					menu = new iScroll('menu',  { hScroll:true,vScroll:false, hScrollbar: false, vScrollbar: false });
				}
				return false;
			}
			else if (!inTransition && $(this).hasClass('btnClose')) {
				inTransition = true;
				_gaq.push(['_trackEvent', 'Article', 'Go Back to Listing']);
				$('#header .btnClose').hide();
				self.gotoCate($('#menu li.current').attr('cate-id'), {transition:'flip', reverse:false});
				return false;				
			} 
			else if ($(this).hasClass('btnRefresh')) {
				_gaq.push(['_trackEvent', 'App', 'Reload', 'By User']);
				App.reload(DIALOG_MSG_RELOAD_CONFIRM);
				return false;
			}
			else if ($(this).hasClass('btnWeb')) {
				log("Switch");
				if (confirm(DIALOG_SWITCH_DESKTOP)) {
					_gaq.push(['_trackEvent', 'App', 'Switch Desktop']);	
					$.cookie('Mobile','o',{domain:'.zing.vn', expires: 1});
					window.location = getStateUrl();
				}
			}
		});
		
		
		if (window.navigator.standalone) {
			$('#category div[data-role="page"]').live('swiperight', function() {
				if (!inTransition) {
					inTransition = true;
					_gaq.push(['_trackEvent', 'Category', 'Swipe Go Backward']);
					self.gotoPrevCate();	
				}			
			}).live('swipeleft', function(){	
				if (!inTransition) {
					inTransition = true;
					_gaq.push(['_trackEvent', 'Category', 'Swipe Go Forward']);	
					self.gotoNextCate();	
				}	
			});
			
			$('#article div[data-role="page"]').live('swiperight', function(){
				if (!inTransition) {
					inTransition = true;
					_gaq.push(['_trackEvent', 'Article', 'Swipe Go Backward']);
					self.gotoPrevArticle();
				}
			}).live('swipeleft', function(){
				if (!inTransition) {
					inTransition = true;
					_gaq.push(['_trackEvent', 'Article', 'Swipe Go Forward']);
					self.gotoNextArticle();
				}			
			});	
		}
		
		
		
		
		
		
		$('#category div[data-role="page"] li').live('tap',function(){
			if (!inTransition) {
				inTransition = true;		
				_gaq.push(['_trackEvent', 'Category', 'Tap View Article']);	
				self.gotoArticle($(this).attr('data-source'), {transition:'flip', reverse:false});
			}			
		});
		
		//$('.swipe_nav').noClickDelay();
		$('.swipe_nav').live('tap', function(){		
			if (!inTransition) {
				inTransition = true;	
				if ($($.mobile.activePage).parents('#category').length!=0) {
					if ($(this).hasClass('btnNext')) {
						_gaq.push(['_trackEvent', 'Category', 'Tap Go Forward']);
						self.gotoNextCate();
					} else if($(this).hasClass('btnBack')) {
						_gaq.push(['_trackEvent', 'Category', 'Tap Go Backward']);
						self.gotoPrevCate();
					}		
				} else if ($($.mobile.activePage).parents('#article').length!=0) {
					if ($(this).hasClass('btnNext')) {
						_gaq.push(['_trackEvent', 'Article', 'Tap Go Forward']);
						self.gotoNextArticle();
					} else if($(this).hasClass('btnBack')) {
						_gaq.push(['_trackEvent', 'Article', 'Tap Go Backward']);
						self.gotoPrevArticle();
					}	
				}
			}
		})
	}	
}

/**
 * Render Engine is responsible for all content presentation inside a screen 
 */
function RenderEngine() {
	
	var self = this;	
	
	// Render list of articles
	// @params: <json>articles, {cateName, cateId, cateUrl}, <function>callback(firstPage)	 
	this.renderArticleList = function(list, options, callback) {
		var i = 0, remain, content="", firstPage;
		var cateName 	= ""; if (options && options.cateName) { this.cateName = options.cateName;}		
		var cateId 		= ""; if (options && options.cateId) { this.cateId = options.cateId;}				
		var cateContainer = getCateDOM(this.cateId);
		
		if (cateContainer==null) {
			cateContainer = App.render.renderPage('<ul></ul>',{pageTitle:this.cateName, cateId:this.cateId,cateName:this.cateName, scrollable:'{"hScroll":false,"vScroll":true, "hScrollbar":false, "vScrollbar":true, "removeWrapperPadding":false, "addScrollerPadding":false, "fastDestroy":true, "use-transition":true}', pullToRefresh:true});			
			$('#category').append(cateContainer);
			$(cateContainer).attr('data-source', options.cateUrl);	
		}
		var count = 1;
		while (i<list.articles.length) {
			var isHidden = (i>29); //(i>29);
			content += self.renderArticleItem(list.articles[i++], {hidden:isHidden, index:count++});
		}
		
		$(cateContainer).find('ul').append(content);
		                        						
		if (callback && (typeof callback == 'function')) {	
			callback(cateContainer); 					
		} 
		
	}
	
	this.renderArticleContent = function(permanentURL, callback, prefetch) {
		var articleid = getArticleId(permanentURL);
		var container = getArticleDOM(articleid);
		var preview = '';
		if (container == null) {			
			if (prefetch) {
				container = App.render.renderPage('<div class="article-content"></div>', {pageId:articleid, pageTitle: prefetch.catename, cateId:prefetch.cateid, cateName:prefetch.catename, scrollable:'{"hScroll":false,"vScroll":true,"resizeEvents":"orientationchange"}'});
				preview += '<div class="aCover" style="background-image:url(\''+prefetch.cover+'\');"><img src="'+prefetch.cover+'" alt="'+prefetch.summary+'" /></div>';
				preview += '<h1 class="aTitle">'+prefetch.title+'</h1>';
				preview += '<p class="aCate">'+prefetch.category+'</p>';
				preview += '<p class="aDate">'+prefetch.time+'</p>';								
				preview += '<div class="aSummary"><p>'+prefetch.summary+'</p></div>';				
			} else {
				container = App.render.renderPage('<div class="article-content"></div>', {pageId:articleid, scrollable:'{"hScroll":false,"vScroll":true,"resizeEvents":"orientationchange"}'});
				preview += '<div class="aCover"></div>';
				preview += '<h1 class="aTitle"></h1>';
				preview += '<p class="aCate"></p>';
				preview += '<p class="aDate"></p>';								
				preview += '<div class="aSummary"><p></p></div>';
			}
			preview	+= '<div class="aContent"><p style="text-align:center; margin-top:10px; height:1000px;"><img src="data:image/gif;base64,R0lGODlhEAALAPQAAP///wAAANra2tDQ0Orq6gYGBgAAAC4uLoKCgmBgYLq6uiIiIkpKSoqKimRkZL6+viYmJgQEBE5OTubm5tjY2PT09Dg4ONzc3PLy8ra2tqCgoMrKyu7u7gAAAAAAAAAAACH+GkNyZWF0ZWQgd2l0aCBhamF4bG9hZC5pbmZvACH5BAALAAAAIf8LTkVUU0NBUEUyLjADAQAAACwAAAAAEAALAAAFLSAgjmRpnqSgCuLKAq5AEIM4zDVw03ve27ifDgfkEYe04kDIDC5zrtYKRa2WQgAh+QQACwABACwAAAAAEAALAAAFJGBhGAVgnqhpHIeRvsDawqns0qeN5+y967tYLyicBYE7EYkYAgAh+QQACwACACwAAAAAEAALAAAFNiAgjothLOOIJAkiGgxjpGKiKMkbz7SN6zIawJcDwIK9W/HISxGBzdHTuBNOmcJVCyoUlk7CEAAh+QQACwADACwAAAAAEAALAAAFNSAgjqQIRRFUAo3jNGIkSdHqPI8Tz3V55zuaDacDyIQ+YrBH+hWPzJFzOQQaeavWi7oqnVIhACH5BAALAAQALAAAAAAQAAsAAAUyICCOZGme1rJY5kRRk7hI0mJSVUXJtF3iOl7tltsBZsNfUegjAY3I5sgFY55KqdX1GgIAIfkEAAsABQAsAAAAABAACwAABTcgII5kaZ4kcV2EqLJipmnZhWGXaOOitm2aXQ4g7P2Ct2ER4AMul00kj5g0Al8tADY2y6C+4FIIACH5BAALAAYALAAAAAAQAAsAAAUvICCOZGme5ERRk6iy7qpyHCVStA3gNa/7txxwlwv2isSacYUc+l4tADQGQ1mvpBAAIfkEAAsABwAsAAAAABAACwAABS8gII5kaZ7kRFGTqLLuqnIcJVK0DeA1r/u3HHCXC/aKxJpxhRz6Xi0ANAZDWa+kEAA7AAAAAAAAAAAA" style="width:auto; height:auto;" width="16" height="11" alt="Đang tải nội dung..." /></p></div>';
			$(container).find('.article-content').html(preview);
			$(container).find('.iscroll-scroller').css('height',($(container).find('.article-content').height()+50)+'px');						
			$(container).find('div[data-role="content"]').iscrollview("refresh");
			$(container).attr('data-source', permanentURL);
			$(container).attr('article-id', articleid);						
			
			$(container).bind('pageshow', function() {
				if ($(container).find('.gallery').length==0) {					
					App.feed.loadArticleJSON(getArticleLink(permanentURL), function(article) {
						setTimeout(function(){
							if(prefetch==null) {
								$(container).attr('data-title', article.cate_child);
								$(container).attr('cate-name', article.cate_child);
								$(container).find('.aCover').html('<img src="'+article.cover+'" />').attr('style','background-image:url("'+article.cover+'")');
								$(container).find('.aDate').html(article.date);
								$(container).find('.aTitle').html(article.title);
								$(container).find('.aSummary').html(article.summary);	
							}
							var a = $('<div>');
							var pic = $('<div>', {'class':'gallery'});
							
							$(a).html(cleanContent(article.content));
							var picCount = $(a).find('img').length;
							// processing table 
							$(a).find('table').each(function(){
							    if($(this).attr('align')=='left' || $(this).attr('align')=='right') {
							        var content_quote = $('<blockquote>');
							        $(content_quote).html("<div>"+($(this).html()).replace(/<[\/]*(tbody|td|tr)[^>]*>/g,"")+"</div>");
							        $(this).after(content_quote);
							        $(this).remove();
							    } else {
							        var imgs = $(this).find('img');
							        if(imgs.length!=0) {
							            var content_pic = $('<div>',{"class":"picture"});
							            $(content_pic).html(($(this).html()).replace(/<[\/]*(tbody|td|tr|p)[^>]*>/g,""));
							            if (display.deviceType!="phone" && picCount>2 && $(document).width()>=1000) {$(pic).append(content_pic);}
							            else {$(this).after(content_pic);}						            
							            $(this).remove();            
							        } else {
							            $(this).css({'width':'100%'}).attr('width','auto');
							        }
							    }
							});
							$(a).find('.pTitle').remove();$(a).find('.pHead').remove();
							// $(a).find('.pAuthor').remove(); $(a).find('.pSource').remove();
							$(a).find('pSubTitle').addClass('dontend');
							var words = countWords($(a).text());
							var zalo = '<div class="zalo"><a href="http://zaloapp.com/qr/p/jq0q0zuhb27m" class="linked" title="Quan tâm Zing News trên Zalo"><img alt="" src="data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAABQAAD/4QMpaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjAtYzA2MCA2MS4xMzQ3NzcsIDIwMTAvMDIvMTItMTc6MzI6MDAgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDUzUgV2luZG93cyIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo4MUQ2QjExRENDMDkxMUUyQjlCNkRCOUQ5QTkyMEQwNiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo4MUQ2QjExRUNDMDkxMUUyQjlCNkRCOUQ5QTkyMEQwNiI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjgxRDZCMTFCQ0MwOTExRTJCOUI2REI5RDlBOTIwRDA2IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjgxRDZCMTFDQ0MwOTExRTJCOUI2REI5RDlBOTIwRDA2Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+/+4ADkFkb2JlAGTAAAAAAf/bAIQAAgICAgICAgICAgMCAgIDBAMCAgME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" width="40" height="40"><strong>Nhận tin trực tiếp từ điện thoại</strong><br />Zing News trên Zalo</a></div>';							
							$(container).find('.aContent').html($(a).html()+zalo+'<fb:like href="'+permanentURL+'" send="false" width="'+$('.article-content').width()+'" show_faces="false" font="lucida grande"></fb:like>');
							$(container).find('.aContent').after(pic);
							if (display.deviceType!="phone" && (words > 300 || $(pic).find('img').length>0)) $(container).find('.aContent').addClass('column');
							$(container).find('.iscroll-scroller').css('height',($(container).find('.article-content').height()+100)+'px');						
							$(container).find('div[data-role="content"]').iscrollview("refresh");
							
							$(container).find('.gallery img, .aContent img').load(function(){
								$(container).find('.iscroll-scroller').css('height',($(container).find('.article-content').height()+100)+'px');
								$(container).find('div[data-role="content"]').iscrollview("refresh");					
							});	
								
							if ($('#fb-root').length==0) {
								$('body').after('<div id="fb-root"></div><script>( function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return; js = d.createElement(s);js.id = id;	js.src = "../connect.facebook.net/vi_VN/all.js#xfbml=1";	fjs.parentNode.insertBefore(js, fjs);}(document, "script", "facebook-jssdk"));</script>');
							}					
							setTimeout(function(){
								if (FB != null) FB.XFBML.parse();
							}, 4000);
						},500);
					
					});
				}
				
			});
			
			$('#article').append(container);
			if (callback && (typeof callback == 'function')) {	
				callback(container); 					
			} 
		}
	}
	
	this.renderArticleItem = function(article, options) {
		if(article!=null) {	
			cate = '<span class="parent">'+article.cateparent+'</span><span class="subcate"> | '+article.catechild+"</span>";
			if(article.cateparent.trim() == article.catechild.trim()) {
				cate = '<span class="parent">'+article.cateparent+'</span>';
			}
			var hidden = "", classCounter = "";
			if (options && options.hidden && options.hidden===true) hidden='hidden';			
			if (options && options.index && options.index%2==1) {classCounter += "odd ";} else {classCounter += "even"}
			if (options && options.index && (options.index-1)%3==0) classCounter += "c3n1";
			if (options && options.index && (options.index%3==0)) classCounter += "c3n3"; 
			return	'<li class="article '+hidden+'" data-title="'+article.cateparent+'" data-source="'+article.link+'" article-id="'+getArticleId(article.link)+'" >'
					+	'<a class="cover" style="background-image:url(' + article.cover +')">'
					+		'<img src="' + article.cover +'" alt="' + article.title +'">'
					+	'</a>'
					+ 	'<div class="meta">'
					+		'<h1 class="heading">' + article.title +'</h1>'
					+		'<p class="cate">'+cate+'</p>'
					+		'<p class="time">' + getTimeSpan(article.time, true) +'</p>'
					+		'<div class="summary">' + article.summary +'</div>'
					+	'</div>'
					+ '</li>';
		}
		return "";
	}
	
	// Dynamically inject & render jquery mobile page
	// @params: page_type (class), content (HTML), {pageId, pageTitle, cateId, cateName, scrollable}	
	this.renderPage = function(content, options) {
		var  pId, pTitle, pObj;		
		if(options && options.pageId) { this.pId = options.pageId; } else { this.pId = pageId++; }			
		if(options && options.pageTitle) { this.pTitle = options.pageTitle;	} else { this.pTitle = "Zing News";}
		if(options && options.pullToRefresh===true) {
			content += '<div class="iscroll-pullup"><span class="iscroll-pull-label" data-iscroll-pulled-text="Kéo xuống để xem thêm..." data-iscroll-loading-text="Đang lấy dữ liệu...">Kéo xuống để xem thêm...</span> </div>';
		}			
		try {
			pObj = $('<div>', { "data-role": "page", id:'page-'+this.pId, "data-title": this.pTitle}).append($('<div>', {"data-role":"content"}).html(content));
			if(options && options.cateId) $(pObj).attr('cate-id',options.cateId);
			if(options && options.cateName)  $(pObj).attr('cate-name',options.cateName);
			if(options && options.scrollable) {
				$(pObj).find('div[data-role="content"]').attr('data-iscroll', options.scrollable);
				// $(pObj).find('div[data-role="content"]').addClass('overthrow');
			}			
		} catch (e) {
			log (e);
		} 		
		$(pObj).page();				
		if(options && options.scrollable) {
			$(pObj).find('div[data-role="content"]').iscrollview();
			
		}
		// log("Rendering Page", this.pObj);
		return pObj;
	}
	
	// Calculate element width & height on the page
	this.updateLayout = function() {
		//alert($(document).width());
		var pageWidth = $(window).width();
		var pageHeight = $.mobile.getScreenHeight()-46;	
		$('.wrapper').css('height',pageHeight+'px');		
	}
	
}

/**
 * Feed Reader will read from any input format into a standardized json format of the app 
 */
function FeedReader() {
	var self = this;
	
	// Load article list from json input. Cache in local database & load from it if supported. 
	// @param: url, options {pageIndex, postLimit, allowcache, allowqueue}, callback	
	this.loadArticlesListJSON = function(url, options, callback) {	
			
		var articlesList;		
		
		var page = 0, limit = ARTICLE_PER_PAGE;
		if (options && options.pageIndex) page = options.pageIndex;
		if (options && options.postLimit) limit = options.postLimit;
		
		var jsonlink = !/home.json/i.test(url) ? url+"?p="+page+"&c="+limit : url;
		var content = App.storage.loadContent(jsonlink);
		var refresh = !(content!=null && content!==false && content.age<15);
		
		log ("Load: "+jsonlink);
		if (refresh && navigator.onLine) {
			log("\tTrying to load from Internet...");			
			$.ajax({
				url:jsonlink,
				dataType: "text"
			}).done(function(data) {								
				articlesList = self.parseJSON(data);
				if(articlesList.articles.length!=0) {		
					_gaq.push(['_trackEvent', 'Load Data', 'Category', "Live: "+jsonlink]);			
					if (callback && (typeof callback == 'function')) {					
						callback(articlesList); 					
					}
					if (App.storage.isSupported()) { App.storage.insertContent(jsonlink, data);}					
				} else if (content!=null && content!==false) {						
					_gaq.push(['_trackEvent', 'Load Data', 'Category', "Cached: "+jsonlink]);
					articlesList = self.parseJSON(content.content);
					log("\t...feed data empty. Load data from local storage ("+content.age+"' ago)");			
					if (callback && (typeof callback == 'function')) {					
						callback(articlesList); 					
					}
				} else if (callback && (typeof callback == 'function')) {
					_gaq.push(['_trackEvent', 'Load Data', 'Category', "No Data: "+jsonlink]);
					App.reload(DIALOG_ERROR_EMPTY);
				} 
				
			}).fail(function(request, status, error) {
				log ("\t\t... fail with error: ",request, status, error);	
				_gaq.push(['_trackEvent', 'Load Data', 'Category', "Failed: "+jsonlink]);			
				if (content!=null && content!==false) {						
					_gaq.push(['_trackEvent', 'Load Data', 'Category', "Cached: "+jsonlink]);
					articlesList = self.parseJSON(content.content);
					log("\t...loading data fail. Load data from local storage ("+content.age+"' ago)");			
					if (callback && (typeof callback == 'function')) {					
						callback(articlesList); 					
					}
				} else if (callback && (typeof callback == 'function')) {
					App.reload(DIALOG_MSG_UNSTABLE_CONNECTION);
				} 
			});
		} else if (content!=null && content!==false) {						
			_gaq.push(['_trackEvent', 'Load Data', 'Category', "Cached: "+jsonlink]);
			articlesList = self.parseJSON(content.content);
			log("\t...load data from local storage ("+content.age+"' ago)");			
			if (callback && (typeof callback == 'function')) {					
				callback(articlesList); 					
			}
			return;				
		} else if (callback && (typeof callback == 'function')) {
			_gaq.push(['_trackEvent', 'Load Data', 'Category', "Offline: "+jsonlink]);
			App.reload(DIALOG_MSG_NOINTERNET_WITHOUTCONTENT);
		} 
	}
	
	this.loadArticleJSON = function(jsonURL, callback) {
		var articleContent = null;
		var currentTime = (new Date()).getTime();		
		var content = App.tempStorage.loadContent(jsonURL);
		var isCached = (content!=null && content!==false);
		if (callback && (typeof callback == 'function')) {
			log ("Load: "+jsonURL);
		} else {
			log ("Prefetch: "+jsonURL);
		}
		if (!isCached && navigator.onLine) {			
			$.ajax({
				url:jsonURL,
				dataType: "text"
			}).done(function(data) {	
				log("\t...loaded from Internet");
				_gaq.push(['_trackEvent', 'Load Data', 'Article', "Live: "+jsonURL]);
				if (App.tempStorage.isSupported()) {App.tempStorage.insertContent(jsonURL, data);}
				if (callback && (typeof callback == 'function')) {
					articleContent = self.parseJSON(data).article;
					callback(articleContent);					
				} else {
					_gaq.push(['_trackEvent', 'Load Data', 'Article', "Prefetch: "+jsonURL]);
				}
				return;								
			}).fail(function(request, status, error) {
				log ("\t\t... fail with error: ",request, status, error);	
				_gaq.push(['_trackEvent', 'Load Data', 'Article', "Failed: "+jsonURL]);		
				popup(DIALOG_MSG_UNSTABLE_CONNECTION, 105);
				if (lastPage!=null && callback && (typeof callback == 'function')) {					
					try {
						$.mobile.changePage($(lastPage),{transition:lastAnimation.effect, reverse:!lastAnimation.reverse });
					} catch (e) {
						popup(DIALOG_GENERAL_ERROR, 1, function(){
							window.location.reload();
						});
					}	 
				}
				return;
			});
		}
		 
		if (isCached) {
			_gaq.push(['_trackEvent', 'Load Data', 'Article', "Cached: "+jsonURL]);
			articleContent = self.parseJSON(content.content).article;
			if (callback && (typeof callback == 'function')) {
				callback(articleContent);
			}	
			log("\tLocal data available & new. Load data from local storage...");
			return;	
		} 
				
		if (!navigator.onLine) {
			popup(DIALOG_MSG_NOINTERNET, 105);
			_gaq.push(['_trackEvent', 'Load Data', 'Article', "Offline: "+jsonURL]);
			if (lastPage!=null && callback && (typeof callback == 'function')) {
				try {
					$.mobile.changePage($(lastPage),{transition:lastAnimation.effect, reverse:!lastAnimation.reverse });
				} catch (e) {
					popup(DIALOG_GENERAL_ERROR, 1, function(){
						window.location.reload();
					});
				}	 
			}
		}
		
	}
	
	// Parse JSON	 
	this.parseJSON = function(data) {
		var obj = null;		
		try {
			obj = $.parseJSON(data);
		} catch (e) {
			_gaq.push(['_trackEvent', 'Load Data', 'Parse Error']);
			log ("Error parsing JSON data", e);
		}
		return obj;	
	}
}


