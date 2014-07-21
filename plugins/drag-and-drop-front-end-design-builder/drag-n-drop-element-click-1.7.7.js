// 0 = none, 1 = sparse, 2 = verbose
var loggingLevel = 1;
function logSparse(msg) {
	if ( loggingLevel > 0 ) {
	  console.log(msg);
	}
}
function logVerbose(msg) {
	if ( loggingLevel > 1 ) {
		console.log(msg);
	}
}

$(document).ready(function() {

	var curParameter = ( (window.parent.document).location.search ).toString();
	console.log('current paramenter' + curParameter);

	if ( curParameter == '?enigma=styler&pid=2') {

		$(this).click(function(e){
			var element = $(e.target);

			// get class and id
			function getClassId (element) {
				elementIdName = element.attr("id");
				elementClassName = element.attr("class");
				if ( elementIdName == false && elementClassName == false ) {
					getClassId( $(e.target).parent() );
				};
			};
			// return class and id
			getClassId(element);
			
			// $('h5', window.parent.document).hasClass(indicatorList[i])
			
			// create a string with classes and ids
			var classIdString = "";
			function getIndicator(elementIdName,elementClassName) {
				if (elementIdName == false && elementClassName == true) {
					classIdString = (elementClassName.trim()).replace(/\s+/g, " ");
					
				} else if (elementIdName == true && elementClassName == false) {
					classIdString = (elementIdName.trim()).replace(/\s+/g, " ");
				} else {
					classIdString = ((elementClassName + " " + elementIdName).trim()).replace(/\s+/g, " ");
				};
			};
			
			// return a string with classes and ids
			getIndicator(elementIdName,elementClassName);
			
			//remove white spaces
			logVerbose(classIdString);
			
			//push classes or ids in a list
			var indicatorList = [];
			function classIdArray(classIdString) {			
				indicatorList = classIdString.split(" ");
				logVerbose(indicatorList);
			};
			
			//return the classes and ids in an array
			classIdArray(classIdString);
			
			// list match indicators
			matchList = [];
			
			function toggleAccordion() {
			
				for ( var i = 0 ; i < indicatorList.length ; i++ ) { 
		
					if ( $('h5', window.parent.document).hasClass(indicatorList[i]) ) {				

						matchList.push(indicatorList[i]);
						logVerbose('match ' + matchList);
						
					
						logSparse('matched');
					
						if ( matchList.length == 1 ) {
		
							logSparse('finished toggling');
							logVerbose(matchList.length);
							
							// get matching h5 accordion
							h5Accordion = $( 'h5.' + indicatorList[i], window.parent.document );
					
							// get h5 parent h4 that matched
							h4Accordion = $( 'h5.' + indicatorList[i], window.parent.document ).parent().prev();
							
							// get children of .panels in iFrame
							childrenPanels = $('.panels',window.parent.document).children().length;
							
							if ( h4Accordion.hasClass('opened-title') == false && h4Accordion.siblings('h4').hasClass('opened-title')) {
							
								logVerbose('close opened');							
								
								h4Accordion.siblings('h4.opened-title').siblings('.enigma-styler-section').children('h5.sub-opened-title').children('i').addClass('icon-caret-up').removeClass('icon-caret-down');
								h4Accordion.siblings('h4.opened-title').siblings('.enigma-styler-section').children('h5.sub-opened-title').next().slideToggle('normal');
								h4Accordion.siblings('h4.opened-title').siblings('.enigma-styler-section').children('h5.sub-opened-title').next().toggleClass('sub-opened');
								h4Accordion.siblings('h4.opened-title').siblings('.enigma-styler-section').children('h5.sub-opened-title').toggleClass('sub-opened-title');
								logVerbose(h4Accordion.siblings('h4.opened-title').siblings('.enigma-styler-section').children('h5.sub-opened-title'));
								
								$('h4.opened-title',window.parent.document).children('i').addClass('icon-caret-up').removeClass('icon-caret-down');
								$('h4.opened-title',window.parent.document).next().slideToggle('normal');
								$('h4.opened-title',window.parent.document).next().toggleClass('opened');
								$('h4.opened-title',window.parent.document).toggleClass('opened-title');

								h4Accordion.children('i').removeClass('icon-caret-up').addClass('icon-caret-down');
								h4Accordion.next().slideToggle('normal');
								h4Accordion.next().toggleClass('opened');
								h4Accordion.toggleClass('opened-title');

							} else if ( h4Accordion.hasClass('opened-title') && $('h5.' + indicatorList[i], window.parent.document).hasClass('sub-opened-title') ) {
								
								logVerbose('opened siblings w/ same class');						
							
							} else if ( h4Accordion.hasClass('opened-title') && $('h5.' + indicatorList[i], window.parent.document).siblings('h5').hasClass('sub-opened-title') ) {							
								
								h5Accordion.siblings('h5.sub-opened-title').children('i').addClass('icon-caret-up').removeClass('icon-caret-down');					
								h5Accordion.siblings('h5.sub-opened-title').next().slideToggle('normal');
								h5Accordion.siblings('h5.sub-opened-title').next().toggleClass('sub-opened');
								h5Accordion.siblings('h5.sub-opened-title').toggleClass('sub-opened-title');
								logVerbose('has opened simblings!!!');
								
							} else if ( h4Accordion.hasClass('opened-title') && $('h5.' + indicatorList[i], window.parent.document).hasClass('sub-opened-title') == false) {
								
								logVerbose("opened h4 and self h5 closed");
								
							} else if ( h4Accordion.children('i').hasClass('icon-caret-down') ){
								
								h4Accordion.children('i').addClass('icon-caret-up').removeClass('icon-caret-down');
								h4Accordion.next().slideToggle('normal');
								h4Accordion.next().toggleClass('opened');
								h4Accordion.toggleClass('opened-title');
								
							} else {
							
								h4Accordion.children('i').removeClass('icon-caret-up').addClass('icon-caret-down');
								h4Accordion.next().slideToggle('normal');
								h4Accordion.next().toggleClass('opened');
								h4Accordion.toggleClass('opened-title');
								
							};
							
							logVerbose($('h5', window.parent.document).hasClass(indicatorList[i]));
							// end of h4 accordion opening
							
							// open h5 accordion
							logVerbose(indicatorList[i]);

							if ( h5Accordion.children('i').hasClass('icon-caret-down')) {
								h5Accordion.children('i').addClass('icon-caret-up').removeClass('icon-caret-down');
							} else {
								h5Accordion.children('i').removeClass('icon-caret-up').addClass('icon-caret-down');
							};
							
							h5Accordion.next().slideToggle('normal');
							h5Accordion.next().toggleClass('sub-opened');
							h5Accordion.toggleClass('sub-opened-title');
							// end of h4 accordion
							
						};

					} else {
						logSparse('retry');
						element = element.parent();
						getClassId(element);
						getIndicator(elementIdName,elementClassName);
						classIdArray(classIdString); //return indicator list
						logVerbose(indicatorList);
									
						toggleAccordion();
					};	
				};
			};	
			
			toggleAccordion();	
			
			// scroll position
			function scrollPosition() {

				logVerbose('scroll position');
				logVerbose( 'height of above siblings ' + h4Accordion.prevAll().height() ); // height of above siblings
				
				var eTop = h4Accordion.offset().top; //get the offset top of the element
				logVerbose(eTop - $('.panels', window.parent.document).scrollTop()); //position of the ele w.r.t window
				
					$('.panels', window.parent.document).animate({
						scrollTop: ( $('.panels',window.parent.document).children().index( h4Accordion )*22)
					}, 1000);
					logVerbose('more than the half');				
					logVerbose('h5 desse elemento ' + h4Accordion.siblings('div.opened').children().length);
					
					logVerbose('altura dos h5 '+ h4Accordion.siblings('.enigma-styler-section').children('h5').height());
				
					$('.panels', window.parent.document).animate({
						scrollTop: ( $('.panels',window.parent.document).children().index( h4Accordion )*22)
					}, 1000);
					logVerbose('no more than a half');
					logVerbose(h4Accordion.siblings('div.enigma-styler-section').children('div.sub-opened').height());
				
			};
				
			scrollPosition();
		
		});
	
	};

});
