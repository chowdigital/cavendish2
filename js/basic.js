var h,hh,device='phone';

var resizeScreen = function() {
	hh = $('header').height();
	h = $(window).height() - hh;
	if(device == 'phone') $('.subsection').css('overflow','visible');
	else if(device == 'desktop') {
		$('.subsection').css('min-height',h);
		$('#menuview').height(h - 20);
	}
};

var CAVENDISH = CAVENDISH || {};

var getSec = function(href) {
	var sec = href.replace(SITE_URL,'').replace(/[\w-\.:]*?\/?([a-z0-9-\/]*)\/(#|\?.*)?$/,'$1');
	console.log("sec="+sec);
	if(sec=='/' || sec=='' || sec==SITE_URL+'/' || sec==SITE_URL) sec = 'home';
	return sec;
};


var openSec = function(e, forcehref,openAfter) {
	//e.preventDefault();
	console.log("openSec");
	console.log(e);
	console.log(forcehref);
	console.log(openAfter);
	
	if($('html').hasClass('showHeader')) {
		$('html').removeClass('showHeader');
		resizeScreen();
	}

	if(forcehref !== undefined) { // if openSec was called directly as a function
		var href = forcehref;
	} else { // or openSec was called by a html link
		var href = $(this).attr('href');
		console.log("HREF="+href);
		// if we are dealing with an external link, let's stop the function
		if (href.substring(0, 4) == "http" && href.substring(0, SITE_URL.length) != SITE_URL || href.substring(0, 4) == "mail" || href.substring(0, 3) == "tel") {			return;
		}
		else e.preventDefault(); //else, stop the default event
	}
	console.log("HREF1="+href);
	$('header').removeClass('social').find('nav').removeClass('open');
	var sec = getSec(href); // define sec
	// open the new section if it's not in the current one

	if($('body').attr('data-url').replace(/\/$/,'') != href.replace(/\/$/,'')) { //avoid opening already opened sec
		$('.subsection').removeClass('show');
		$('#lightGallery-outer, #menuview').addClass('delete').delay(200).animate({opacity: 0},'2000',function(){
			$(this).remove();
		});
		// 1st step: change url:
		if(window.history && window.history.pushState && openAfter === undefined && getSec(location.href) != sec) history.pushState({sec:sec}, sec, href);
		// 2nd step: process actions:
		var dontAjax=0,limit;
		console.log("Sec="+sec);
		if(sec=='home' || sec=='events' || sec=='press') { // Are we replacing one of the 3 wall areas?
			$('main').unbind('click');
			if(sec=='home' && $('.wall').hasClass('wall-home') ||
					(sec=='events') && $('.wall').hasClass('wall-events') ||
					(sec=='press') && $('.wall').hasClass('wall-press')) {
				// the area is already loaded, just close the subsection
				dontAjax = true;
				$('body').attr('data-url',href);
				//$('title').text('Home');
				setTimeout(function(){
					$('.subsection > article').remove();
					$('body')[0].className=sec;
				},600);
			} else {
				// remove the different area, and open the new one
				var wall = $('.wall').addClass('delete').fadeOut(2000);
				setTimeout(function(){wall.remove()},2000);
				$('html,body').delay(400).animate({scrollTop:0});
				if(sec == 'home') href = SITE_URL+'/home/'
				var callback = function(contents) {
					$('body').removeClass('open');
					$('main').append(contents);
					if(device == 'desktop') $('.subsection').css('min-height',h);
					if(openAfter !== undefined) {openSec(e,openAfter); }
				}
			}
		} else { // Are we replacing a subsection?
			var is_event = sec.replace(/\/([a-z0-9-\/]+)$/,'')=='event' ? true : false;
			if(is_event && !$('.wall').hasClass('wall-events')) { // an event should be opened over events wall, do openAfter
				openSec(e,SITE_URL + '/events/',href);
				dontAjax = true;
			} else if(!is_event && $('.wall').hasClass('wall-empty')) { // empty wall, do openAfter
				openSec(e,SITE_URL + '/',href);
				dontAjax = true;
			}
			var callback = function(contents) {
				$('.subsection > article').addClass('delete').delay(200).css('opacity',0).animate({opacity: 0.05},'2000',function(){
					$(this).remove();
				});
				$('.subsection',contents).removeClass('show');
				$('main .wall .subsection').append($('.subsection > article',contents));
				$('.subsection')[0].offsetHeight;
				$('.subsection').addClass('show');
				$('body').addClass('open');
			}
		}
		dontAjax=false;
		// 3rd step: process actions:
		if(!dontAjax){
			console.log("dontAjax");
			console.log(href);
			$('body').addClass('loading');
			$.get( href+'?method=ajax', function( data ) {
				console.log("Loading "+href);
				data = JSON.parse(data);
				$('title').text(data.title);
				$('body').attr('class',data.bodyclasses);
				var contents = $.parseHTML( data.contents );
				if(sec!='gallery') $('a',contents).on('click', openSec);
				$('a.close',contents).unbind('click').on('click', closeSec);
				if (callback!==undefined) {	callback(contents); }
				if(device == 'phone') $('main').height(h);
				$('body').attr('data-url',href);
				$('body').removeClass('loading').unbind('keyup').keyup(function(e) {
					if(e.keyCode == 27) closeSec(e);
				});
				loadSec(sec);
			}, "html");
		}
	}
};

var loadSec = function(sec) {
	console.log("loadSec");
	$('.subsection').height(h);
	setTimeout(function(){$('.subsection').css('overflow','auto')},500);
	$('html,body').delay(400).animate({scrollTop:0});
	if(sec.match(/menu\/\w/)) $('.type-menu h1 div a').click(menuArrow);
	if(sec=='gallery') mobileGallery();
	if(sec=='location') initMap();
	console.log("Finished loadSec");
};

var closeSec = function(event) {
	if(event.preventDefault !==undefined) event.preventDefault();
	if($('body').hasClass('single-post') || $('.wall').hasClass('wall-events')) var goURl = SITE_URL+'/events/';
	else if($('.wall').hasClass('wall-events')) var goURl = SITE_URL+'/press/';
	else var goURl = SITE_URL+'/';
	openSec(event,goURl);
};

var toggleMenu = function(e) {
	e.preventDefault();
	$('header nav').toggleClass('open');
	$('header').removeClass('social');
};
var toggleSocial = function(e) {
	e.preventDefault();
	$('header').toggleClass('social');
	$('header nav').removeClass('open');
};

var menuArrow = function(e) {
	if(this.rel=='next') $(this).parents('h1').find('strong').css({'transform': 'translate3d(50px,0,0)', opacity: 0});
	else if(this.rel=='prev') $(this).parents('h1').find('strong').css({'transform': 'translate3d(-50px,0,0)', opacity: 0});
}
var mobileGallery = function() {
	var g = $('#post-gallery');
	$('ul',g).width(60*$('a',g).length);
	$('a',g).unbind('click').click(function(e){
		e.preventDefault();
		$('figure',g).fadeOut('fast',function(){$(this).remove()});
		var fig = '<figure style="background-image:url('+$(this).parent('li').data('src')+')"></figure>';
		$(fig).height(h-62).appendTo(g);
	});
	$('a:first',g).click();
};
var initMap = function() {
		var map,script = document.createElement('script');
		script.type = 'text/javascript';
	//	script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBrGYhxUmg09jlD3FylHfq8Fg7Ij4UmQDM&callback=initialize';
		if(typeof google == 'undefined') {
			document.body.appendChild(script);
		} else initialize();
}
function initialize() {
	var styles = [{"stylers": [{ "saturation": -100 }]}];
	var mapOptions = {
		zoom: 17,
		center: new google.maps.LatLng(51.5189406,-0.149852),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		styles: styles,
		panControl: true,
		zoomControl: true,
		scaleControl: true,
		mapTypeControl: false,
		streetViewControl:false,
	};
	map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);
	var image = SITE_URL+'/wp-content/themes/newcavendish/images/map_marker.png';
	var myLatLng = new google.maps.LatLng(51.5189406,-0.149852);
	var beachMarker = new google.maps.Marker({
		position: myLatLng,
		map: map,
		icon: image
	});
	google.maps.event.addDomListener($('#map_canvas img')[0], 'mouseover', initialize);
}

window.onpopstate = function(event) {
	if(location.href.slice(-1) != '#') openSec(event,location.href);
};

$(window).resize(resizeScreen);

if(localStorage && !localStorage.getItem('headerDisplayed')){
	localStorage.setItem('headerDisplayed',1);
	$('html').addClass('showHeader');
}

$(document).ready(function(){
    $('header a').on('click touchstart', openSec);
    $('main a, footer a').on('click', openSec);
    $('nav button').on('click touchstart', toggleMenu);
    $('#social-icon').on('click touchstart', toggleSocial);
    resizeScreen();
    if(device == 'phone') {
    	loadSec(getSec(location.href));
    	$('footer').remove();
    }
});
$(window).load(resizeScreen);
