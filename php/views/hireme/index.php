<div class="hireme">

    <div class="whoiam"></div>
    <div class="longstoryshort">
        <div class="timeline">
            <h1>long story short</h1>

        </div>
    </div>
    <div class="skilllevels"></div>
    <div class="whatiamlookingfor"></div>

</div>

<script>
    main.postponedExcecution = function () {

        $( ".contact form input[type='submit']" ).unbind( 'click' );

        $( ".contact form input[type='submit']" ).on( "click", function ( event ) {
            event.preventDefault();

            $( this ).attr( "value", "sending..." );

            $( this ).css( {
                "background-color": "#191919"
            } );

            var url = "/php/ajax-adapter.php?controller=contact&action=sendmessage";

            $.ajax( {
                type: "POST",
                url: url,
                data: $( ".contact form" ).serialize(),

                success: function ( data ) {

                    if ( data === "success" ) {
                        $( ".contact form" ).animate( {
                            'height': "0px"
                        } );
                        $( ".contact .success" ).css( {
                            "display": "block"
                        } ).animate( {
                            'opacity': 1
                        } );
                    } else {
                        $( ".contact .fail" ).css( {
                            "display": "block"
                        } ).animate( {
                            'opacity': 1
                        } );
                    }
                }
            } );
            return false;
        } );

    };
</script>
