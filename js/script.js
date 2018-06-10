(function () {
  'use strict';

  main.registerListeners = function () {
    $( window ).bind( 'popstate', main.StateManager.popOldState );
    $( 'nav li a' ).click( main.NavigationManager.itemClicked );
    $( ".disclaimer-link" ).click( main.FooterManager.showDisclaimer );
  };

  main.State = function ( controller, action, arg ) {
    this.controller = controller;
    this.action = action;
    this.arg = arg;
  };

  main.StateManager = {
    popOldState: function ( event ) {
      var popableState = event.originalEvent.state;
      if ( popableState === null ) {
        //if event from page load
        return;
      }
      main.NavigationManager.setNavItemActive( popableState.controller );
      main.AjaxManager.retrieveNewContent( popableState );
      main.TrackingManager.pushStateToTrackingService( popableState );
    },
    pushNewState: function ( state ) {
      var newUrl = main.Utils.parseHrefFromState( state );
      if ( typeof window.history.pushState === 'function' ) {
        window.history.pushState( state, state.controller, newUrl );
        main.TrackingManager.pushStateToTrackingService( state );
      } else {//for old browser not supporting pushState
        window.location.assign( newUrl );
      }
    }
  };

  main.TrackingManager = {
    pushStateToTrackingService: function ( state ) {
      var hrefString = main.Utils.parseHrefFromState( state );
      _gaq.push( [ '_trackPageview', hrefString ] );
    }
  };

  main.FooterManager = {
    showDisclaimer: function ( event ) {
      event.preventDefault();
      var disclaimer = $( ".disclaimer" );
      disclaimer.show();

      var iframe = $( ".disclaimer iframe" );
      iframe.attr( "src", "/includes/disclaimerframe.html" );

      main.DomManager.scrollTo( disclaimer );
    }
  };

  main.ContentManager = {
    setNewData: function ( data ) {
      $( ".content" ).html( data );
    },
    showContentLoadingScreen: function () {
      $( ".content" ).html( "<div class='loading'></div>" );
    }
  };

  main.NavigationManager = {
    itemClicked: function ( event ) {
      event.preventDefault();
      main.ContentManager.showContentLoadingScreen();

      var newState = new main.Utils.parseStateFromHref( $( this ).attr( "href" ) );

      main.NavigationManager.setNavItemActive( newState.controller );
      main.StateManager.pushNewState( newState );
      main.AjaxManager.retrieveNewContent( newState );
    },
    setNavItemActive: function ( controller ) {
      $( 'nav li a.active' ).removeClass( "active" );
      $( "nav li a:contains('" + controller + "')" ).addClass( "active" );
    }
  };

  main.DomManager = {
    scrollTo: function ( element ) {
      var yOffset = $( element ).offset().top;
      $( 'html,body' ).animate( {
        scrollTop: yOffset
      }, 500 );
    }
  };

  main.AjaxManager = {
    retrieveNewContent: function ( newState ) {
      var url = "/php/ajax-adapter.php?controller=" + newState.controller;
      if ( newState.action ) {
        url += "&action=" + newState.action;
      }
      if ( newState.arg ) {
        url += "&arg=" + newState.arg;
      }

      $.ajax( {
        url: url
      } ).done( function ( data ) {

        main.ContentManager.setNewData( data );

        var newTitle = newState.controller + " - stephan lindauer";
        $( document ).attr( "title", newTitle );
        main.Utils.excecutePosponedFunction();
      } );
    }
  };

  main.Utils = {
    parseStateFromHref: function ( href ) {
      var hrefArray = href.split( "/" );
      return new main.State( hrefArray[1], hrefArray[2], hrefArray[3] );
    },
    parseHrefFromState: function ( state ) {
      var resultString = "/";
      resultString += state.controller;
      if ( state.action ) {
        resultString += "/" + state.action + "/";
      }
      if ( state.arg ) {
        resultString += state.arg;
      }

      return resultString;
    },
    excecutePosponedFunction: function () {
      if ( typeof main.postponedExcecution === 'function' ) {
        main.postponedExcecution();
        main.postponedExcecution = null;
      }
    }
  };

  $( document ).ready( function () {
    main.registerListeners();
    main.Utils.excecutePosponedFunction();
  } );

}());