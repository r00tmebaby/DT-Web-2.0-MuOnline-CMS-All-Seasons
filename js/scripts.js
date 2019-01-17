( function( $ ) {
    $(document).ready(function (){
      
      // Live Search
        $('#live-search-faux-input').on('click', function() {
            $('.live-search-modal').fadeIn(500);
            $('input#live-search-input').focus();
            $('#live-search-input').addClass('live-search-to-show');
        });
        $('input#live-search-input').on('input', function() {
            if ( this.value.length >= 3 ) {
                $.ajax({
                    url: live_search.ajax_url, // use the globally declared variable
                    type: 'POST',
                    data: {
                        action: 'live_search', // Call the PHP function
                        keyword: $('#live-search-input').val()
                    },
                    success: function(data) {
                        $('.live-search-reset-btn').fadeIn(500);
                        $('.live-search-results').delay(500).slideDown(400).html(data);
                        $('.live-search-result').each(function(index) {
                            $(this).delay(500*index).fadeTo(400, 1);
                        });
                    }
                });
            } else {
                $('.live-search-results').html('');
            }
        });
        $('.live-search-reset-btn').on('click', function() {
            $('.live-search-results').html('').slideUp();
        });
        $('.live-search-close').on('click', function() {
            $('.live-search-modal').fadeOut(500);
            $('#live-search-input').removeClass('live-search-to-show').val('');
        });
      
    });
} )( jQuery );