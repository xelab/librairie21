$(document).ready(function() {

    $('#publisher_id').select2();
    $('#distributor_id').select2();
    $('#authors').select2();

    $('.open-popup-link').magnificPopup({
        type: 'inline',
        preloader: false
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

function addAndHidePublisherForm(data)
{
    $('#publisher_id')
        .append($('<option>', { value : data.id }).text(data.name)); 
    $('#publisher_id').val(data.id);
    $.magnificPopup.close();
    $('#collection_publisher').val(data.id);
    $('.collection').show();
}

function addAndHideCollectionForm(data)
{
    $('#collection_id')
        .append($('<option>', { value : data.id }).text(data.name)); 
    $('#collection_id').val(data.id);
    $.magnificPopup.close();
}

function addAndHideDistributorForm(data)
{
    $('#distributor_id')
        .append($('<option>', { value : data.id }).text(data.name)); 
    $('#distributor_id').val(data.id);
    $.magnificPopup.close();
}

function addAndHideAuthorForm(data)
{
    $('#authors')
        .append($('<option>', { value : data.id, selected: true }).text(data.name)); 
    $.magnificPopup.close();
}

$('#publisher_id').on('change', function(){
    $('#collection_publisher').val($('#publisher_id').val());
    $('.collection').show();
    $.ajax(
    {
        method: 'GET',
        url: $('#url-collections').val() + '/' + $('#publisher_id').val(),
        datatype: 'json'
    })
    .done(function(data){
        console.log(data);
        $('#collection_id').empty();
        $('#collection_id')
                .append($('<option>', { value : '' }).text(''));
        for (var i = data.length - 1; i >= 0; i--) {
            $('#collection_id')
                .append($('<option>', { value : data[i].id }).text(data[i].name));
        }
    })
    .fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
    });
});