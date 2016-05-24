        $(document).ready(function (t) {
var obj=document.body;  // obj=element for example body
// bind mousewheel event on the mouseWheel function
if(obj.addEventListener)
{
    obj.addEventListener('DOMMouseScroll',mouseWheel,false);
    obj.addEventListener("mousewheel",mouseWheel,false);
}
else obj.onmousewheel=mouseWheel;

function mouseWheel(e)
{
    // disabling
    e=e?e:window.event;
    if(e.ctrlKey)
    {
        if(e.preventDefault) e.preventDefault();
        else e.returnValue=false;
        return false;
    }
}
    $(document).HorizontalBlocks({
        parentBox: "#content",
        block:".section",
        firstBlock: 1,
        scrollOption:"swing",
        scrollSpeed: "slow",
        horizontalMenu: ".nav div",
        nextId: "#next",
        prevId: "#prev"
    });

    $("body").css({"opacity": 1});
    $(document).mouseup(function (e)
    {
        var container = $(".window");

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $('.window, .bgwindow').fadeOut(300);
        }
    });
$(window).load(function(){
            $(".conent-window").mCustomScrollbar({
                theme: 'dark'
            });
        });
    $('.button.resume').click(function() {
        $('.window').hide();
        $('.bgwindow, .window.resume').fadeIn(350);
    });
    $('.button.findmore').click(function() {
        $('.window').hide();
        $('.bgwindow, .window.findmore').fadeIn(350);
    });
    $('.button.authrresume').click(function() {
        $('.window').hide();
        $('.bgwindow, .window.authrresume').fadeIn(350);
    });
    /*$('.photo').click(function() {
        $('.window').hide();
        $('.bgwindow, .window.photo').fadeIn(350);
    });*/
    $('#content').flexiblecontent({});
});


(function($) { //create closure
$.fn.flexiblecontent = function(options){
//return false
	this.each(function(){
		var defaults = {
			w: 1280,
			h: 1024,
			sX: 1, // scale X
			sY: 1 // scale Y
		};
		var errors = 0; var msg='';
		var o = $.extend(defaults, options);
		var htmltag = $('html');
		var intention = $('.section');
		var logo = $('.logo');
		var nav = $('.nav');
		var $window = $('.window');
        var asprateFlex = Math.max(o.h, o.w) / Math.min(o.h, o.w);
        function mainscale() {
			var H = $(window).height(), W = $(window).width(),
			asprateWindow = (W>H) ? Math.max(H, W) / Math.min(H, W) : Math.min(H, W) / Math.max(H, W),
			scale = (asprateWindow >= asprateFlex)? H/o.h : W/o.w;
			_SCALE = scale;
			htmltag.height((asprateWindow >= asprateFlex)? H : Math.max(H, H/scale));
            logo.css({
                'webkit-transform' : 'scale('+scale+','+scale+')',
                'ms-transform' : 'scale('+scale+','+scale+')',
                '-moz-transform' : 'scale('+scale+','+scale+')',
                'transform' : 'scale('+scale+','+scale+')',
                'transform-origin': 'left top',
                top: '0px', left: '0px'
            });
            nav.css({
                'webkit-transform' : 'scale('+scale+','+scale+')',
                'ms-transform' : 'scale('+scale+','+scale+')',
                '-moz-transform' : 'scale('+scale+','+scale+')',
                'transform' : 'scale('+scale+','+scale+')',
                'transform-origin': 'top',
            });
			intention.css({
				'webkit-transform' : 'scale('+scale+','+scale+')',
				'ms-transform' : 'scale('+scale+','+scale+')',
				'-moz-transform' : 'scale('+scale+','+scale+')',
				'transform' : 'scale('+scale+','+scale+')',
            });
            $window.css({
				'webkit-transform' : 'scale('+scale+','+scale+')',
				'ms-transform' : 'scale('+scale+','+scale+')',
				'-moz-transform' : 'scale('+scale+','+scale+')',
				'transform' : 'scale('+scale+','+scale+')',
                'transform-origin': 'top',
            });

		}
		mainscale();
		$(window).resize(function(){
			mainscale();
		});
		$('body').addClass('flexready');
	});
}
//end of closure
})(jQuery);

