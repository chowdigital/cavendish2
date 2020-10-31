(function($) {
	$.fn.ultraSlider = function(options) {

        var settings = $.extend({
            slides : '.slide',
            indicators: 'b',
            tabs : false,
            stopOnHover : true,
        }, options); 
        if(settings.sec) settings.sec = Math.abs(settings.sec) ? Math.abs(settings.sec) * 1000 : false;
        else settings.sec = settings.tabs ? false : 3000;
        if(this.find(settings.slides).length) settings.slides = this.find('>*:first')[0].tagName;
        
		// private variables
        var si=0,ss,sb;
        
		// private methods
		var foo = function() {
			// do something ...
		}
		// ...

		// public methods
		this.init = function() {
			ss = this.find(settings.slides).get();
			$s = this;
    		if(settings.indicators && ss.length > 1) {
    			if(!this.find('.indicators').length) {
    				var indicators = $('<div class="indicators"></div>');
        			if(!settings.tabs) this.append(indicators);
        			else this.prepend(indicators);
    			} else var indicators = this.find('.indicators');
    			if(this.find(settings.indicators).length==0) for (var z=0;z<ss.length;z++) $(indicators).append('<'+settings.indicators+'></'+settings.indicators+'> ');
    			else if(settings.tabs) this.find(settings.indicators).remove().appendTo(indicators);
        		sb = this.find(settings.indicators).get();
        		
        		$(sb).click(function(e,$s) {
        			e.preventDefault();
    				if($(sb).index(this)!=si) $s.sig(
    					$(sb).index(this)
    				)
    			});
    		}
    		if(settings.sec && ss.length > 1) {
	    		if(settings.stopOnHover) this.hover(function(){
	    			this.addClass('hover');
	    			clearInterval(this.paso);
	    		},function(){
	    			clearInterval(this.paso);
	    			this.removeClass('hover');
	    			this.paso = setInterval(this.sig,settings.sec);
	    		});    	
	    		clearInterval(this.paso);
	    		this.paso = setInterval(this.sig,settings.sec);
    		}
    		if(ss.length > 1) this.sig(si);
			return this;
		};

		this.sig = function(ideb) {
			var iLast = si;
			if(ideb===undefined) si = (si<ss.length -1 )? si+1 : 0;
			else if(ideb==-1) si = (si<1 )? ss.length-1 : si-1;
			else si = ideb;
    		if(iLast<si) $($s).addClass('forward').removeClass('backward');
    		else if(iLast>si) $($s).addClass('backward').removeClass('forward');
			$(ss).addClass('inactive').removeClass('last');
			$(sb).addClass('inactive').removeClass('last');
			$(ss[iLast]).addClass('last').removeClass('current');
			$(sb[iLast]).addClass('last').removeClass('current');
			$(ss[si]).addClass('current').removeClass('last inactive');
			$(sb[si]).addClass('current').removeClass('last inactive');
		};
		this.stop = function(ideb) {
			
		};
		return this.each.init;
	}
})(jQuery);