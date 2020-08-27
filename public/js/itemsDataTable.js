$(document).ready(function() {
    $.noConflict();
    var items_table = $('#items_table').DataTable();
    var shoplist_table = $('#shoplist_table').DataTable();

    $('#items_table').on( 'click', 'tbody tr', function () {
        shoplist_table.row.add(items_table.row( this ).data()).draw();
        items_table.row( this ).remove().draw();

    } );
} );
