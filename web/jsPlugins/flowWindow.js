(function($){
	$.fn.flowWindow = function($options){
		$options = $.extend({
			'ajaxLink' : 'no',
			'ajaxData' : false,
			'header' : false,
		},$options);


		return this.each(function(){			
			//$(this).click(function(event){
				$('#completeAjax').hide();
				$('#spinnerAjax').hide();
				$('.flowWindow').html($options.header);

				var $elementWidth,$elementHeight, dataId;
				var scrolled = window.pageYOffset || document.documentElement.scrollTop;

				/*
				 * * INIT PLUGIN * *
				 * DEFAULT VALUES
				*/
			  	$('#contentAjax').html('');
			  	$('#contentAjax').css({
			  		'opacity' : 0,
			  		'position' : 'absolute'
			  	});
				$('#spinnerAjax').show();
				dataId = $(this).attr('data-id');
				/*
				 * * SETTING WORKING CONDITION
				*/
				$('.centerElement').css({
					'height'		: 'auto',
					'width'			: '400px',
				});

				/*
				 * * COUNTING WIDTH/HEIGHT
				*/
				$elementWidth = ($(window).width() - $('.centerElement').outerWidth())/2;
				$elementHeight = (($(window).height() - $('.centerElement').outerHeight())/2)+scrolled;
				if($elementHeight<scrolled){
					$elementHeight = scrolled;
				}


				/*
				 * FIRST START 
				*/
				$offset = $elementHeight-50;
				$('.bgshadow').css({
					'width'   : '100%',
					'height'   : '100%',
					'opacity' : '0.8',
				});

				$('.centerElement').css({
					'top'	: $offset,
				});

				/*
				 * * FOR OFFSET WORKING..
				 * SETTING TIME OUT, becouse of CSS ANIMATION
				*/
				setTimeout(function(){
					/*
					 * * REAL CENTER TOP && LEFT
					 * ... centering our flwo Window ...
					*/
					$('.centerElement').css({
						'left'			: $elementWidth,
						'top'			: $elementHeight,
						'opacity' 		: '1',
					});

					/*
					 * * GETTING AJAX DATA
					*/
					$.ajax({
						type: "POST",
						url	: $options.ajaxLink,
						data: {'dataID' : dataId},
						success: function(data){
							$('#contentAjax').append(data);

							/*
							 * * COUNTING CONTAINER HEIGHT WITH CONTENT
							*/
						    $HeightContainer = ($('#contentAjax').outerHeight())+33;
						    $elementHeight = (($(window).height() - $HeightContainer)/2)+scrolled;
	    					if($elementHeight<scrolled){
								$elementHeight = scrolled;
							}

							$offset = $elementHeight-50;

							/*
							 * TIME FOT APPENDING
							*/
							setTimeout(function(){
								/*
								 * * ANIMATING NEW WINDOW
								 * AND CREATING WITH NEW CONTENT
								*/
						    	$('.centerElement').animate({
						    		'top'			: $elementHeight,
						    		'height' : $HeightContainer
						    	},300);

						    	setTimeout(function(){
						    		$('#spinnerAjax').hide();
						    		$('#contentAjax').css({
						    			'position' : 'relative',
						    			'opacity' : 1
						    		});
						    		$('.centerElement').css({
						    			'height' : 'auto'
						    		});
						    	},900);
							},300);
						}
					});

				},350);
				return false;
			//});
		});
	}
})(jQuery);