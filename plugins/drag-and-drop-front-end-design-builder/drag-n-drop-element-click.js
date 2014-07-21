// 0 = none, 1 = sparse, 2 = verbose
var loggingLevel = 2;
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

jQuery(document).ready(function() {

	var curParameter = ( (window.parent.document).location.search ).toString();
	console.log('current paramenter' + curParameter);

	if ( curParameter == '?enigma=styler') {

		jQuery(this).click(function(e){
			var element = jQuery(e.target);

			// get class and id
			function getClassId (element) {
				elementIdName = element.attr("id");
				elementClassName = element.attr("class");
				if ( elementIdName == false && elementClassName == false ) {
					getClassId( jQuery(e.target).parent() );
				};
			};
			// return class and id
			getClassId(element);
			
			// jQuery('h5', window.parent.document).hasClass(indicatorList[i])
			
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
			
				logSparse(indicatorList);
				
			
				for ( var i = 0 ; i < indicatorList.length ; i++ ) { 
		
					if ( jQuery('h5', window.parent.document).hasClass(indicatorList[i]) ) {				

						matchList.push(indicatorList[i]);
						logVerbose('match ' + matchList);					
					
						logVerbose('matched');					
					
						if ( matchList.length == 1 ) {
		
							logVerbose('finished toggling');
							logVerbose(matchList.length);
							
							// get matching h5 accordion
							h5Accordion = jQuery( 'h5.' + indicatorList[i], window.parent.document );
					
							// get h5 parent h4 that matched - for limitless 2.0
							h4Accordion = jQuery( 'h5.' + indicatorList[i], window.parent.document ).parent().parent().siblings('h4');
							logSparse(h4Accordion);
							
							// get children of .panels in iFrame
							childrenPanels = jQuery('.panels',window.parent.document).children().length;
							
							if ( h4Accordion.hasClass('opened-title') == false && h4Accordion.parent().siblings().children('h4').hasClass('opened-title')) {
							
								logVerbose('close opened');							
								
								//fixed for version 2.0 - Close opened h5
								h4Accordion.parent().siblings().children('h4.opened-title').siblings('.enigma-styler-section').children().children('h5.sub-opened-title').next().slideToggle('normal');
								h4Accordion.parent().siblings().children('h4.opened-title').siblings('.enigma-styler-section').children().children('h5.sub-opened-title').next().toggleClass('sub-opened');
								h4Accordion.parent().siblings().children('h4.opened-title').siblings('.enigma-styler-section').children().children('h5.sub-opened-title').toggleClass('sub-opened-title');
								logVerbose(h4Accordion.parent().siblings().children('h4.opened-title').siblings('.enigma-styler-section').children('h5.sub-opened-title'));
								
								// close opened h4
								jQuery('h4.opened-title',window.parent.document).next().slideToggle('normal');
								jQuery('h4.opened-title',window.parent.document).next().toggleClass('opened');
								jQuery('h4.opened-title',window.parent.document).toggleClass('opened-title');

								// toggle matched h4
								h4Accordion.next().slideToggle('normal');
								h4Accordion.next().toggleClass('opened');
								h4Accordion.toggleClass('opened-title');

							} else if ( h4Accordion.hasClass('opened-title') && jQuery('h5.' + indicatorList[i], window.parent.document).hasClass('sub-opened-title') ) {
								
								logVerbose('opened siblings w/ same class');						
							
							} else if ( h4Accordion.hasClass('opened-title') && jQuery('h5.' + indicatorList[i], window.parent.document).parent().siblings().children('h5').hasClass('sub-opened-title') ) {							
								
								// fixed for version 2.0 - close opened h5 at the same h4
								h5Accordion.parent().siblings().children('h5.sub-opened-title').next().slideToggle('normal');
								h5Accordion.parent().siblings().children('h5.sub-opened-title').next().toggleClass('sub-opened');
								h5Accordion.parent().siblings().children('h5.sub-opened-title').toggleClass('sub-opened-title');
								logVerbose('has opened simblings!!!');
								
							} else if ( h4Accordion.hasClass('opened-title') && jQuery('h5.' + indicatorList[i], window.parent.document).hasClass('sub-opened-title') == false) {
								
								logVerbose("opened h4 and self h5 closed");
								
							} else if ( h4Accordion.hasClass('opened-title') ){
								
								h4Accordion.next().slideToggle('normal');
								h4Accordion.next().toggleClass('opened');
								h4Accordion.toggleClass('opened-title');
								
							} else {
							
								h4Accordion.next().slideToggle('normal');
								h4Accordion.next().toggleClass('opened');
								h4Accordion.toggleClass('opened-title');
								
							};
							
							logVerbose(jQuery('h5', window.parent.document).hasClass(indicatorList[i]));
							// end of h4 accordion opening
							
							// open h5 accordion
							logVerbose(indicatorList[i]);
							
							h5Accordion.next().slideToggle('normal');
							h5Accordion.next().toggleClass('sub-opened');
							h5Accordion.toggleClass('sub-opened-title');
							// end of h5 accordion
							
							
							//i = indicatorList.length; // the bellow break worked better
							logVerbose(i);
							//break; this break didn`t work
						};
						
						//break;

					}; 
					
						
				};
			};	
			
			toggleAccordion();	
			
			while ( matchList.length == 0) {
				logVerbose('retry');
				element = element.parent();
				getClassId(element);
				getIndicator(elementIdName,elementClassName);
				classIdArray(classIdString); //return indicator list
				logVerbose(indicatorList);
				//break;
				toggleAccordion();
			};
			
			// scroll position
			function scrollPosition() {

				logVerbose('scroll position');
				logVerbose( 'height of above siblings ' + h4Accordion.prevAll().height() ); // height of above siblings
				
				var eTop = h4Accordion.offset().top; //get the offset top of the element
				logVerbose('eTop ' + eTop);
				logVerbose(eTop - jQuery('.panels', window.parent.document).scrollTop()); //position of the ele w.r.t window
				logVerbose( jQuery('.panels',window.parent.document).children().children().index( h4Accordion ) );
				
				jQuery('.panels', window.parent.document).animate({
					scrollTop: ( jQuery('.panels',window.parent.document).children().children().index( h4Accordion )*23)
				}, 1000);
				
			};
				
			scrollPosition();
		
		});
	
	};

});
