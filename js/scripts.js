(function($){
	"use strict";


	$('[data-bg-image]').each(function(){
		$(this).css({ 'background-image': 'url('+$(this).data('bg-image')+')' });
	});

	$('[data-bg-color]').each(function(){
		$(this).css({ 'background-color': $(this).data('bg-color') });
	});

	$('[data-width]').each(function(){
		$(this).css({ 'width': $(this).data('width') });
	});

	$('[data-height]').each(function(){
		$(this).css({ 'height': $(this).data('height') });
	});



	// header search action
	$('#header-search').on('click', function(){
		$('#overlay-search').addClass('active');

		setTimeout(function(){
			$('#overlay-search').find('input').eq(0).focus();
		}, 400);
	});
	$('#overlay-search').find('.close-search').on('click', function(){
		$('#overlay-search').removeClass('active');
	}); 

	$('div[data-overlay]').each(function(){
    	var $row = $(this);
    	var $overlay = $('<div class="vc-row-overlay" style="background-color:'+$row.data('overlay')+'; opacity:'+$row.data('overlay-alpha')+';"></div>');
    	$row.prepend( $overlay );
    });


	// mobile menu
	$('nav.main-nav').on('click', function(){
		if( $(window).width()<997 ){
			$('nav.main-nav').addClass('show-menu');
		}
	});
	$('#close-menu').on('click', function(){
		$('nav.main-nav.show-menu').removeClass('show-menu');
		return false;
	});


	// post format improvements
	// video
	$('.blog-item.blog-single.format-video .entry-excerpt video, .blog-item.blog-single.format-video .entry-excerpt iframe').each(function(index){
		if(index==0){
			$(this).remove();
		}
	});
	// audio
	$('.blog-item.blog-single.format-audio .entry-excerpt audio, .blog-item.blog-single.format-audio .entry-excerpt iframe').each(function(index){
		if(index==0){
			$(this).remove();
		}
	});
	// quote
	$('.blog-item.blog-single.format-quote .entry-excerpt blockquote').each(function(index){
		if(index==0){
			$(this).remove();
		}
	});
	// gallery
	$('body.single-format-gallery .blog-item .entry-excerpt .gallery').each(function(index){
		if(index==0){
			$(this).remove();
		}
		else{
			var $this = $(this);
			var _gallery = $('<div class="gallery-masonry row"><div class="gallery-viewport"></div></div>');
			$this.find('.gallery-item').each(function(){
				var _item = $(this);
				_gallery.find('.gallery-viewport').append( $('<div class="col-sm-4 gitem"></div>').append(_item.find('a')) );
			});
			$this.replaceWith(_gallery);
		}
	});



	$(document).ready(function(){


		// Gallery slideshow
		$('.gallery-slideshow').each(function(){
			var _gallery = $(this);

			_gallery.find('.gallery-container').swiper({
			    nextButton: _gallery.find('.swiper-button-next'),
			    prevButton: _gallery.find('.swiper-button-prev')
			});
		});


		// Video Element
		$('.video-element').each(function(){
			var _video = $(this);
			_video.magnificPopup({
				delegate: 'a',
				type: 'iframe'
			});
		});

		$('a.video-play').each(function(){
			var _video = $(this);
			_video.magnificPopup({
				type: 'iframe'
			});
		});

		
		$('.image-link').each(function(){
			var $this = $(this);
			$this.magnificPopup({
				type:'image'
			});
		});



		setTimeout(function(){

			// fullwidth post slider
			$('.fullwidth-post-slider').each(function(){
				var $this = $(this);
				$this.find('.swiper-container').swiper({
					nextButton: $this.find('.swiper-button-next'),
				    prevButton: $this.find('.swiper-button-prev'),
				    pagination: $this.find('.swiper-pagination'),
				    paginationClickable: true,
				    slidesPerView: 1
				});
			});


			// katharine-post-slider
			$('.katharine-post-slider').each(function(){
				var $this = $(this);
				$this.find('.swiper-container').swiper({
					nextButton: $this.find('.swiper-button-next'),
				    prevButton: $this.find('.swiper-button-prev'),
				    pagination: $this.find('.swiper-pagination'),
				    paginationClickable: true,
				    slidesPerView: 1
				});
			});


			// carousel slider centered
			$('.carousel-posts.layout-centered').each(function(){
				var $this = $(this);
				$this.find('.swiper-container').swiper({
					loop: true,
					slidesPerView: 3,
					centeredSlides: true,
					// initialSlide: 1,
					nextButton: $this.find('.swiper-button-next'),
				    prevButton: $this.find('.swiper-button-prev'),
				    breakpoints: {
				    	996: {
				    		slidesPerView: 2
				    	}
				    }
				});
			});
			// carousel slider standard
			$('.carousel-posts.layout-standard').each(function(){
				var $this = $(this);
				$this.find('.swiper-container').swiper({
					slidesPerView: parseInt($this.data('columns'), 10),
					centeredSlides: false,
					nextButton: $this.find('.swiper-button-next'),
				    prevButton: $this.find('.swiper-button-prev'),
				    breakpoints: {
				    	996: {
				    		slidesPerView: 2
				    	}
				    }
				});
			});
			
		}, 1000);

	});


	$(window).load(function(){

		setTimeout(function(){
			$('#loader-container').addClass('loaded');
		}, 1000);

		$('.gallery-masonry').each(function(){
			var $this = $(this);

			$this.find('.gallery-viewport').isotope({
				itemSelector: '.gitem',
				masonry: {
                    columnWidth: 1
                }
			});

			$this.find('.gallery-viewport').magnificPopup({
				delegate: '.gitem a',
				type: 'image',
				gallery:{
					enabled:true
				}
			});

		});


		$('.blog-masonry-container').each(function(){
			var $this = $(this);
			$this.isotope({
				itemSelector: '.masonry-item',
				masonry: {
                    columnWidth: 1
                }
			});
		});


	});

	$('a[data-pid]').each(function(){
		var _this = $(this);
		_this.click(function(){
			if (_this.attr('class')!='liked') {
				$.post(theme_options.ajax_url, { 
					action:'blox_post_like_hook',
					post_id:_this.attr('data-pid')
					}, 
				function(response){
					_this.addClass('liked');
					var _like = _this.find('span').text();
					_like++;
					_this.find('span').text(_like);
					try{
					}
					catch(e){}
				});
			}
		});
	});
})(jQuery);