import './jquery-3.7.1.js'
import './bootstrap';

function processResponseData(data){
    var headers = data.headers;
    var headerRow = '';
    $.each(headers, function(index, header) {
        headerRow += '<th scope="col">' + header + '</th>';
    });
    $('#collectionDataTableHeader').html(headerRow);

    // Populate data
    var rows = data.data;
    var tableBody = '';
    $.each(rows, function(index, row) {
        var rowHtml = '<tr>';
        $.each(headers, function(i, header) {
            rowHtml += '<td>' + row[header] + '</td>';
        });
        rowHtml += '</tr>';
        tableBody += rowHtml;
    });
    $('#collectionDataTableBody').html(tableBody);
}

$(function(){

    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  
    $("#collectionData").on('submit', function(event){
        event.preventDefault();
        console.log("form submit");
        console.log($(this).serialize());
        $.post({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                $(this).trigger("reset");
                console.log(response);
                $("#collectionDataTable").html(processResponseData(response.data));
            },
            error: function(response) {
            }
        });

    });
});
