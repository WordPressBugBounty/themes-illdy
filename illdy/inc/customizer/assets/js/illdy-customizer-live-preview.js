/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
( function( $ ) {
	/* Company text logo */
	// The text logo is only printed when there is no image logo, so the element
	// itself says whether to update. This read a removed setting and threw.
	wp.customize( 'illdy_text_logo', function( value ) {
		value.bind( function( newval ) {
			$( '#header .top-header .header-logo' ).text( newval );
		} );
	} );

	/* Footer Copyright */
	wp.customize( 'illdy_footer_copyright', function( value ) {
		value.bind( function( newval ) {
			$( '.bottom-footer .bottom-copyright' ).html( newval.split( '{year}' ).join( String( new Date().getFullYear() ) ) );
		} );
	} );

	/* Current header */
	wp.customize( 'header_image', function( value ) {
		value.bind( function( newval ) {
			if( newval === 'remove-header' ) {
				$( '#header.header-blog' ).removeAttr( 'style' );
			} else if( newval !== 'random-uploaded-image' && newval !== 'random-default-image' ) {
				$( '#header.header-blog' ).css( 'background-image', 'url('+ newval +')' );
			}
		} );
	} );

	// Title
	wp.customize( 'illdy_jumbotron_title', function( value ) {
		value.bind( function( newval ) {
			$( '#header .bottom-header h1' ).html( newval );
		} );
	} );

	// Entry
	wp.customize( 'illdy_jumbotron_general_entry', function( value ) {
		value.bind( function( newval ) {
			$( '#header .bottom-header .section-description' ).html( newval );
		} );
	} );

	// First button text
	wp.customize( 'illdy_jumbotron_general_first_button_title', function( value ) {
		value.bind( function( newval ) {
			$( '#header .bottom-header .header-button-one' ).toggle( '' !== newval );
			$( '#header .bottom-header .header-button-one' ).text( newval );
		} );
	} );

	// First button URL
	wp.customize( 'illdy_jumbotron_general_first_button_url', function( value ) {
		value.bind( function( newval ) {
			$( '#header .bottom-header .header-button-one' ).attr( 'href', newval );
		} );
	} );

	// Second button text
	wp.customize( 'illdy_jumbotron_general_second_button_title', function( value ) {
		value.bind( function( newval ) {
			$( '#header .bottom-header .header-button-two' ).toggle( '' !== newval );
			$( '#header .bottom-header .header-button-two' ).text( newval );
		} );
	} );

	// Second button URL
	wp.customize( 'illdy_jumbotron_general_second_button_url', function( value ) {
		value.bind( function( newval ) {
			$( '#header .bottom-header .header-button-two' ).attr( 'href', newval );
		} );
	} );

	// Title
	wp.customize( 'illdy_about_general_title', function( value ) {
		value.bind( function( newval ) {
			$( '#about.front-page-section .section-header h3' ).html( newval );
		} );
	} );

	// Entry
	wp.customize( 'illdy_about_general_entry', function( value ) {
		value.bind( function( newval ) {
			$( '#about.front-page-section .section-header .section-description' ).html( newval );
		} );
	} );

	// Title
	wp.customize( 'illdy_projects_general_title', function( value ) {
		value.bind( function( newval ) {
			$( '#projects.front-page-section .section-header h3' ).html( newval );
		} );
	} );

	// Entry
	wp.customize( 'illdy_projects_general_entry', function( value ) {
		value.bind( function( newval ) {
			$( '#projects.front-page-section .section-header .section-description' ).html( newval );
		} );
	} );

	// Title
	wp.customize( 'illdy_testimonials_general_title', function( value ) {
		value.bind( function( newval ) {
			$( '#testimonials.front-page-section .section-header h3' ).html( newval );
		} );
	} );

	// Title
	wp.customize( 'illdy_services_general_title', function( value ) {
		value.bind( function( newval ) {
			$( '#services.front-page-section .section-header h3' ).html( newval );
		} );
	} );

	// Entry
	wp.customize( 'illdy_services_general_entry', function( value ) {
		value.bind( function( newval ) {
			$( '#services.front-page-section .section-header .section-description' ).html( newval );
		} );
	} );

	// Title
	wp.customize( 'illdy_latest_news_general_title', function( value ) {
		value.bind( function( newval ) {
			$( '#latest-news.front-page-section .section-header h3' ).html( newval );
		} );
	} );

	// Entry
	wp.customize( 'illdy_latest_news_general_entry', function( value ) {
		value.bind( function( newval ) {
			$( '#latest-news.front-page-section .section-header .section-description' ).html( newval );
		} );
	} );

	// Button Text
	wp.customize( 'illdy_latest_news_button_text', function( value ) {
		value.bind( function( newval ) {
			$( '#latest-news .latest-news-button' ).empty().append( '<i class="fa-solid fa-chevron-circle-right" aria-hidden="true"></i>', document.createTextNode( newval ) );
		} );
	} );

	// Counter background: an image over a colour, or just the colour. The colour
	// handler used to set background-color to "color:#…", which is not a colour.
	function counterBackground() {
		var type = wp.customize( 'illdy_counter_background_type' )(),
			image = wp.customize( 'illdy_counter_background_image' )(),
			color = wp.customize( 'illdy_counter_background_color' )();

		$( '#counter' ).css( {
			'background-image': ( 'image' === type && image ) ? 'url(' + image + ')' : 'none',
			'background-color': color || ''
		} );
	}

	wp.customize( 'illdy_counter_background_type', 'illdy_counter_background_image', 'illdy_counter_background_color', function( type, image, color ) {
		type.bind( counterBackground );
		image.bind( counterBackground );
		color.bind( counterBackground );
	} );

	// Title
	wp.customize( 'illdy_team_general_title', function( value ) {
		value.bind( function( newval ) {
			$( '#team.front-page-section .section-header h3' ).html( newval );
		} );
	} );

	// Entry
	wp.customize( 'illdy_team_general_entry', function( value ) {
		value.bind( function( newval ) {
			$( '#team.front-page-section .section-header .section-description' ).html( newval );
		} );
	} );

	// Title
	wp.customize( 'illdy_contact_us_general_title', function( value ) {
		value.bind( function( newval ) {
			$( '#contact-us.front-page-section .section-header h3' ).html( newval );
		} );
	} );

	// Entry
	wp.customize( 'illdy_contact_us_entry', function( value ) {
		value.bind( function( newval ) {
			$( '#contact-us.front-page-section .section-header .section-description' ).html( newval );
		} );
	} );

	// Address Title
	wp.customize( 'illdy_contact_us_general_address_title', function( value ) {
		value.bind( function( newval ) {
			$( '#contact-us .section-content .contact-us-box .box-left[data-customizer="box-left-address-title"]' ).html( newval );
		} );
	} );

	// Customer Support Title
	wp.customize( 'illdy_contact_us_general_customer_support_title', function( value ) {
		value.bind( function( newval ) {
			$( '#contact-us .section-content .contact-us-box .box-left[data-customizer="box-left-customer-support-title"]' ).html( newval );
		} );
	} );

	// Color scheme
	wp.customize.bind('preview-ready', function () {
		wp.customize.preview.bind('update-section-css', function (object) {
			var template = '#illdy-'+object.illdy_section+'-section';
			var h_t = Handlebars.compile($(template).text());
			var html = h_t(object.values);
			var style = $('#illdy-'+object.illdy_section+'-section-css');
			if ( !style.length ) {
				style = $('head').append('<style type="text/css" id="illdy-'+object.illdy_section+'-section-css" />').find('#illdy-'+object.illdy_section+'-section-css');
			}
			
			style.html(html);
		});

		wp.customize.preview.bind( 'section-highlight', function( data ) {
			var selectors = {
				'illdy_jumbotron_general' : '#header',
				'illdy_panel_about' : '#about',
				'illdy_panel_projects' : '#projects',
				'illdy_testimonials_general' : '#testimonials',
				'illdy_panel_services' : '#services',
				'illdy_latest_news_general' : '#latest-news',
				'illdy_counter_general' : '#counter',
				'illdy_panel_team' : '#team',
				'illdy_contact_us' : '#contact-us',
				'illdy_full_width' : '#full-width',
			};

			// Only on the front page.
			if ( ! $( selectors[ data.section ] ).length ) {
				return;
			}

			// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
			if ( true === data.expanded ) {
				$.scrollTo( $( selectors[ data.section ] ), {
					duration: 600,
				});
			}
		});

	});

	$(document).ready(function(){
		wp.customize.selectiveRefresh.bind('widget-updated', function (placement) {
			$('.parallax-window').parallax();
		});
	});

} )( jQuery );