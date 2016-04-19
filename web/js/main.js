window.onscroll = function() {
  var scrolled = window.pageYOffset || document.documentElement.scrollTop;
  if(scrolled>=50){
  	
  	$('.leftWidget').css({'top':'0px'});
  }else{
  	topMargin = 50 - scrolled;
  	$('.leftWidget').css({'top':topMargin+'px'});
  }
}



$(document).ready(function(){
			
var $elementWidth,$elementHeight;

$(window).resize(function(){

	var scrolled = window.pageYOffset || document.documentElement.scrollTop;
	$elementWidth = ($(window).width() - $('.centerElement').outerWidth())/2;
	$elementHeight = (($(window).height() - $('.centerElement').outerHeight())/2)+scrolled;

	if($elementHeight<scrolled){
		$elementHeight = scrolled;
	}

		$offset = $elementHeight-50;

	$('.centerElement').css({
		'left'			: $elementWidth,
		'top'			: $elementHeight,
	});

});


});


function removeFlowWindow () {
			$('.centerElement').css({
				'opacity'	: 0,
				'top'		: $offset
			});
			$('.bgshadow').css({
				'opacity'	: 0
			});
		setTimeout(function(){
			$('.bgshadow').css({
				'width'		: 0,
				'height'	: 0,
			});
		},600);
		setTimeout(function(){
			$('.centerElement').css({
				'width'		: 0,
				'height'	: 0,
				'top'		: $offset,
			});
		},500);	
}

$(document).ready(function(){

	$('.bgshadow,.octicon-main').click(function(){
		removeFlowWindow();
	});
	$('.locationOptionBtn').click(function(event){
        $('.LocationInnerWrapper').css({
        	'opacity'	: 0,
        	'top'		: '250%',
        });
		$(this).children().css({
			'width':'auto',
			'height':'auto',
			'opacity':1,
			'top':'110%',
		});
		$('.locationOptionBtn').removeClass('thisElementClicked');
		$(this).addClass('thisElementClicked');
		event.preventDefault();
	});
    $(document).click(function (event) {

    	console.log($(event.target));
        if ($(event.target).closest('.LocationInnerWrapper').length == 0 && !$(event.target).hasClass('thisElementClicked')) {
            $('.LocationInnerWrapper').css({
            	'opacity'	: 0,
            	'top'		: '250%',
            });
            setTimeout(function(){
				$('.LocationInnerWrapper').css({
	            	'width'		: 0,
	            	'height'	: 0,
	            });
            },200);
        }
    });	
});


/*
* * History PushState
* *
*/

function validFunction(fieldstatus,fieldname){
	$('.mistakePopUp').show();
    if(fieldstatus == 'mistake') {
        
        if(fieldname == 'nameField'){
        	$('input[name="'+fieldname+'"],select[name="'+fieldname+'"]').parent().parent().children('h2').css({'color': '#c11','font-weight' : 'bold'});
        }else{
        	$('input[name="'+fieldname+'"],select[name="'+fieldname+'"]').parent().children('h2').css({'color': '#c11','font-weight' : 'bold'});
        }
        // $('input[name="'+fieldname+'"],select[name="'+fieldname+'"]').prev().css({'color': '#c11','font-weight' : 'bold'});
    }
}

$(document).on('click','.octicon-x',function(){
	$(this).parent().hide();
});

function getRandomArbitary(min, max)
{
  return Math.round(Math.random() * (max - min) + min);
}


$(document).on('click','#numberGeneratorField', function(){
	nextNumber = $(this).attr('data-gen');
	$('input[name="nameField"]').val(nextNumber);
});

