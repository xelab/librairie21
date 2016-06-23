$(document).ready(function() {

    $('#publisher_id').select2();
    $('#distributor_id').select2();
    $('#authors').select2();
    $('#tags').select2();

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
        .done(function(response)
        {
            var book = response.book;
            var tags = response.tags;
            var newTags = response.newTags;
            var authors = response.authors;
            var newAuthors = response.newAuthors;
            var newPublisher = response.newPublisher;
            if(book != null && book != undefined)
            {
                $('#price').val(book.price);
                $('#released').val(book.released);
                $('#title').val(book.title);

                if(newPublisher != null && newPublisher != undefined)
                {
                    $('#publisher_id')
                        .append($('<option>', { value : newPublisher.id }).text(newPublisher.name)); 
                    $('#publisher_id').val(newPublisher.id);
                }
                else
                {
                    $('#publisher_id').val(book.publisher_id);
                }
                $('#publisher_id').trigger('change');

                for (var i = authors.length - 1; i >= 0; i--)
                {
                    $("#authors option[value='" + authors[i].id + "']").prop("selected", true);
                }
                if(newAuthors != null && newAuthors != undefined)
                {
                    for (var i = newAuthors.length - 1; i >= 0; i--)
                    {
                        $('#authors')
                            .append($('<option>', { value : newAuthors[i].id, selected: true }).text(newAuthors[i].name)); 
                    }
                }
                $('#authors').trigger('change');

                for (var i = tags.length - 1; i >= 0; i--)
                {
                    $("#tags option[value='" + tags[i].id + "']").prop("selected", true);
                }
                if(newTags != null && newTags != undefined)
                {
                    for (var i = newTags.length - 1; i >= 0; i--)
                    {
                        $('#tags')
                            .append($('<option>', { value : newTags[i].id, selected: true }).text(newTags[i].name)); 
                    }
                }
                $('#tags').trigger('change');
            }
            else
            {
                alert('Aucun ouvrage trouvé avec cet ISBN!');
            }
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
    $('#publisher_id').trigger('change');
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
    $('#distributor_id').trigger('change');
    $.magnificPopup.close();
}

function addAndHideAuthorForm(data)
{
    $('#authors')
        .append($('<option>', { value : data.id, selected: true }).text(data.name)); 
    $.magnificPopup.close();
}

function addAndHideTagForm(data)
{
    $('#tags')
        .append($('<option>', { value : data.id, selected: true }).text(data.name)); 
    $('#tags').trigger('change');
    $.magnificPopup.close();
}

function addBook(data)
{
    $('#books-table').DataTable().draw();
    $('#publisher_id').trigger('change');
    $('#authors').trigger('change');
    $('#tags').trigger('change');
    $('#distributor_id').trigger('change');
}

$('#publisher_id').on('change', function(){
    $('#collection_publisher').val($('#publisher_id').val());
    $('#collection_id').empty();
    if($('#publisher_id').val() == '')
    {
        $('.collection').hide();
    }
    else
    {
        $('.collection').show();
        $.ajax(
        {
            method: 'GET',
            url: $('#url-collections').val() + '/' + $('#publisher_id').val(),
            datatype: 'json'
        })
        .done(function(data){
            
            
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
    }
    
});