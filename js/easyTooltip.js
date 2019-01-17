/*
 * 	Easy Tooltip 1.0 - jQuery plugin
 *	written by Alen Grakalic	
 *	http://cssglobe.com/post/4380/easy-tooltip--jquery-plugin
 *
 *	Copyright (c) 2009 Alen Grakalic (http://cssglobe.com)
 *	Dual licensed under the MIT (MIT-LICENSE.txt)
 *	and GPL (GPL-LICENSE.txt) licenses.
 *
 *	Built for jQuery library
 *	http://jquery.com
 *
 */

(function($) {

	$.fn.easyTooltip = function(options){

		var defaults = {
			xOffset: 10,
			yOffset: -15,
            yOffset2: $(window).scrollTop(),
            yC: $(window).height() ,
			tooltipId: 'easyTooltip'
		};

		var options = $.extend(defaults, options);
		$('#' + options.tooltipId).remove();
		this.each(function() {
			var title = $(this).attr('title');
			$(this).hover(function(e){
				$(this).attr('title','');
					$('body').append('<div id="'+ options.tooltipId +'">'+ title +'</div>');
					$('#' + options.tooltipId).css('position','absolute').css('top',(e.pageY - options.yOffset) + 'px').css('left',(e.pageX + options.xOffset) + 'px').css('display','none').fadeIn('fast');
			},
			function(){	
				$('#' + options.tooltipId).remove();
				$(this).attr('title',title);
			});	
			$(this).mousemove(function(e){
				var a = (e.pageY - options.yOffset) - ($('#' + options.tooltipId).height() - 10);
				
				$('#' + options.tooltipId).css('top', a + 'px').css('left',(e.pageX + options.xOffset) + 'px');
			});
		});
	  
	};
})(jQuery);