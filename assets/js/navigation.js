/**
 * Accessible hamburger navigation toggle.
 *
 * Progressive enhancement: the menu panel ships open-capable but is
 * collapsed here once JS runs, then toggled via an aria-expanded button.
 */
( function () {
	"use strict";

	var button = document.querySelector( ".menu-button" );
	var panel = document.getElementById( "primary-menu" );

	if ( ! button || ! panel ) {
		return;
	}

	function isOpen() {
		return button.getAttribute( "aria-expanded" ) === "true";
	}

	function open() {
		button.setAttribute( "aria-expanded", "true" );
		panel.hidden = false;
	}

	function close( returnFocus ) {
		button.setAttribute( "aria-expanded", "false" );
		panel.hidden = true;
		if ( returnFocus ) {
			button.focus();
		}
	}

	// JS present: start collapsed (no-JS fallback keeps the panel visible).
	close( false );

	button.addEventListener( "click", function () {
		if ( isOpen() ) {
			close( false );
		} else {
			open();
		}
	} );

	document.addEventListener( "keydown", function ( event ) {
		if ( event.key === "Escape" && isOpen() ) {
			close( true );
		}
	} );

	document.addEventListener( "click", function ( event ) {
		if (
			isOpen() &&
			! panel.contains( event.target ) &&
			! button.contains( event.target )
		) {
			close( false );
		}
	} );
} )();
