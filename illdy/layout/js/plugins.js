
jQuery( document ).ready( function( $ ) {

  // Each library below is only enqueued on the front page, so feature-detect before
  // calling it. Keeps inner pages error-free when the library is intentionally absent.
  function hasPlugin( name ) {
    return typeof $.fn[ name ] === 'function';
  }

  // Progress Bar
  function illdyProgressBar() {
    if ( ! hasPlugin( 'progressbar' ) ) {
      return;
    }

    if ( $( '#about .skill' ).length ) {
      $( '#about .skill' ).each( function() {
        var skill = $( this );
        var skillProgressBar = $( skill ).children( '.skill-top' ).children( '.skill-progress-bar' );
        var dataSkillProgressBarWidth = $( skill ).data( 'skill-progress-bar-width' );
        var dataSkillColor = $( skill ).data( 'skill-color' );

        $( skillProgressBar ).progressbar( {
          value: dataSkillProgressBarWidth
        } );

        $( this ).children( '.skill-top' ).children( '.skill-progress-bar' ).children( '.ui-progressbar-value' ).css( 'background-color', dataSkillColor );
        $( this ).
            children( '.skill-top' ).
            children( '.skill-progress-bar' ).
            children( '.ui-progressbar-value' ).
            append( '<span class="ui-progressbar-value-circle" style="background-color: ' + dataSkillColor + '"></span>' );
        $( this ).
            children( '.skill-top' ).
            children( '.skill-progress-bar' ).
            children( '.ui-progressbar-value' ).
            append( '<span class="ui-progressbar-value-top" style="background-color: ' + dataSkillColor + '"></span>' );
        $( this ).
            children( '.skill-top' ).
            children( '.skill-progress-bar' ).
            children( '.ui-progressbar-value' ).
            children( '.ui-progressbar-value-top' ).
            text( dataSkillProgressBarWidth + '%' );
        $( this ).
            children( '.skill-top' ).
            children( '.skill-progress-bar' ).
            children( '.ui-progressbar-value' ).
            children( '.ui-progressbar-value-top' ).
            append( '<span class="ui-progressbar-value-triangle" style="border-top-color: ' + dataSkillColor +
                '; border-right-color: transparent; border-bottom-color: transparent; border-left-color: transparent;"></span>' );
        $( this ).children( '.skill-bottom' ).css( 'color', dataSkillColor );
      } );
    }
  }

  var l10n = $.extend( {
    previous: 'Previous',
    next: 'Next',
    slide: 'Go to slide %d'
  }, window.illdyPlugins || {} );

  /*
   * Owl Carousel builds its controls without names and, for loop: true, clones
   * the first and last items, ids included. Every testimonial widget id was
   * therefore on the page three times, and the dots were empty buttons.
   * The clones are taken out of the accessibility tree and the tab order, since
   * the originals are already there.
   */
  function tidyCarousel( carousel ) {
    carousel.find( '.owl-item.cloned' ).attr( 'aria-hidden', 'true' )
      .find( '[id]' ).removeAttr( 'id' ).end()
      .find( 'a, button, input, select, textarea' ).attr( 'tabindex', '-1' );
    carousel.find( '.owl-item.cloned[id]' ).removeAttr( 'id' );
    carousel.find( '.owl-dot' ).each( function( index ) {
      $( this ).attr( { type: 'button', 'aria-label': l10n.slide.replace( '%d', index + 1 ) } );
    } );
    carousel.find( '.owl-prev' ).attr( { type: 'button', 'aria-label': l10n.previous } );
    carousel.find( '.owl-next' ).attr( { type: 'button', 'aria-label': l10n.next } );
  }

  function startCarousel( carousel, options ) {
    carousel.owlCarousel( $.extend( { navElement: 'button' }, options ) );
    tidyCarousel( carousel );
    carousel.on( 'refreshed.owl.carousel changed.owl.carousel', function() {
      tidyCarousel( carousel );
    } );
  }

  // Testimonials OWL Carousel
  function testimonialsOwlCarousel() {
    if ( ! hasPlugin( 'owlCarousel' ) ) {
      return;
    }

    if ( $( '.testimonials-carousel.owl-carousel-enabled .widget_illdy_testimonial' ).length > 1 ) {
      startCarousel( $( '.testimonials-carousel.owl-carousel-enabled' ), {
        'items': 1,
        'loop': true,
        'dots': true
      } );
    }
  }

  // Counter Number
  var counterStarted = false;

  function counterNumber() {
    if ( counterStarted || ! hasPlugin( 'countTo' ) ) {
      return;
    }

    var counter = $( '#counter' ).find( '.counter-number' );
    if ( counter.length ) {
      // Guarded so the count runs once. It used to restart on every scroll event
      // while the section stayed in view, which visibly reset the number.
      counterStarted = true;
      counter.countTo();
    }
  }

  // Front Page jumbotron Slider
  function illdyJumbotronSlider() {
    if ( ! hasPlugin( 'owlCarousel' ) ) {
      return;
    }

    var illdySlider = $( '.illdy-slider' );
    if ( illdySlider.length > 0 ) {
      startCarousel( illdySlider, {
        'items': 1,
        'loop': true,
        'dots': false,
        'autoplay': illdySlider.data( 'autoplay' ),
        'autoplayTimeout': illdySlider.data( 'autoplay-time' )
      } );
      $( '.illdy-slider-navigation .illdy-slider-prev' ).on( 'click', function( evt ) {
        evt.preventDefault();
        illdySlider.trigger( 'prev.owl.carousel' );
      } );
      $( '.illdy-slider-navigation .illdy-slider-next' ).on( 'click', function( evt ) {
        evt.preventDefault();
        illdySlider.trigger( 'next.owl.carousel' );
      } );
    }

  }

  // Latest News carousel, used once there are more posts than fit in a row.
  function latestNewsCarousel() {
    var carousel = $( '.blog-carousel' );

    if ( ! hasPlugin( 'owlCarousel' ) || carousel.children( '.illdy-blog-post' ).length <= 3 ) {
      return;
    }

    startCarousel( carousel, {
      'items': 3,
      'loop': true,
      'dots': false,
      'nav': true,
      'navText': [ '<i class="fa-solid fa-angle-left" aria-hidden="true"></i>', '<i class="fa-solid fa-angle-right" aria-hidden="true"></i>' ],
      'responsive': { 0: { items: 1 }, 480: { items: 2 }, 900: { items: 3 } }
    } );
  }

  // Called Functions
  $( function() {
    illdyProgressBar();
    testimonialsOwlCarousel();
    illdyJumbotronSlider();
    latestNewsCarousel();

    if ( ! $( '#counter' ).length || ! hasPlugin( 'visible' ) ) {
      return;
    }

    // Passive + rAF-throttled: the previous handler ran a layout-reading visibility
    // test on every single scroll event.
    var ticking = false;

    function onScroll() {
      if ( ticking ) {
        return;
      }
      ticking = true;
      window.requestAnimationFrame( function() {
        if ( true === $( '#counter' ).visible() ) {
          counterNumber();
          if ( counterStarted ) {
            window.removeEventListener( 'scroll', onScroll );
          }
        }
        ticking = false;
      } );
    }

    window.addEventListener( 'scroll', onScroll, { passive: true } );
    onScroll();
  } );
} );
