 jQuery( function( $ ) {
    
    var $window = $( window ); 
    var $featuredMedia = $( "#featured-media" ); 
    var $featuredVideo = $( "#ytplayer" );
    
    
    var player; 
    var top = $( "#featured-media" ).offset().top; 
    var offset = Math.floor( top + ( $( "#featured-media" ).outerHeight() / 2 ) );
    
    var stream = document.getElementsByTagName('video');
    
    
    window.onYouTubeIframeAPIReady = function() {
        
    player = new YT.Player( "ytplayer", {
       events: {
         "onStateChange": onPlayerStateChange
       }
    } );
    };
    function onPlayerStateChange( event ) {
     
       var isPlay  = 1 === event.data;
       var isPause = 2 === event.data;
       var isEnd   = 0 === event.data;
       
     
       if ( isPlay ) {
          $( "#ytplayer" ).removeClass( "is-paused" );
          $( "#ytplayer" ).toggleClass( "is-playing" );
       }
     
       if ( isPause ) {
          $( "#ytplayer" ).removeClass( "is-playing" );
          $( "#ytplayer" ).toggleClass( "is-paused" );
       }
     
       if ( isEnd ) {
          $( "#ytplayer" ).removeClass( "is-playing", "is-paused" );
       }
    }
    $window
    .on( "resize", function() {
       top = $( "#featured-media" ).offset().top;
       offset = Math.floor( top + ( $( "#featured-media" ).outerHeight() / 2 ) );
    } )
     
    .on( "scroll", function() {
       $( "#ytplayer" ).toggleClass( "is-sticky",
         $window.scrollTop() > offset && $( "#ytplayer" ).hasClass( "is-playing" )
       );
    } );
} );