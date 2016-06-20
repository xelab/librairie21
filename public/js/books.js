$(document).ready(function() {

    $('#publisher_id').select2();
    $('#distributor_id').select2();
    $('#authors').select2();

    $('.open-popup-link').magnificPopup({
        type: 'inline',
        preloader: false,
        focus: '#publisherName',

        // When elemened is focused, some mobile browsers in some cases zoom in
        // It looks not nice, so we disable it:
        callbacks: {
            beforeOpen: function() {
                if($(window).width() < 700) {
                    this.st.focus = false;
                } else {
                    this.st.focus = '#publisherName';
                }
            }
        }
    });
});

$('#isbn').on('input', function(){
    if($(this).val().length == 13)
    {
        $.ajax(
        {
            method: 'POST',
            url: $('#url-scraping').val(),
            data: { isbn: $('#isbn').val()}
        })
        .done(function(response){
            console.log(response);
        })
        .fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        });
    }
});