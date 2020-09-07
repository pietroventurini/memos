function drawInputSpinnerFromItemId(item_id) {
    $('#'+item_id + " input[type='number']").inputSpinner();
}

const removeBtn = "<button class='btn btn-outline-danger remove-item-btn' type='button'>"
                    + "<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-trash-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>"
                    + "<path fill-rule='evenodd' d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z'/>"
                    + "</svg>"
                    + "</button>";

function addHiddenItemInput(id, quantity) {
    let input_tag = "<input type='hidden' name='shoplist_items[]' value=" 
                + '{"id":' + id + ','
                + '"quantity":' + quantity + '}'
                + '" />';
    return input_tag;
} 


function buildQuantityInput(quantity) {
    let element = "<input class='quantity-input' type='number' value='"
                + quantity
                + "' min='1' max='100' step='1'/>";
    return element;
}

function objectifyForm(formArray) {
    var objData = {};
    $.map(formArray, function(n,i) {
        objData[n['name']] = n['value']
    });
    return objData;
}

function retrieveShoplistData(table) {
    let items = [];
    table.rows().every(function(idx) {
        let row = this.node();
        let item_id = row.id;
        let quantity = $(row).find('td.quantity-cell')[0].children[0].value;
        let item = {id: item_id, quantity: quantity};
        items.push(item);
    });
    return { name: "items", value: items};
}

$(document).ready(function() {
    $.noConflict();

    $("input[type='number']").inputSpinner();
    var items_table = $('#items_table').DataTable({
        "columnDefs": [
            { className: "d-none d-sm-table-cell", "targets": [ 1, 2 ] },
            { className: "quantity-cell", "targets" : [ 3 ], "orderable": false}
          ],
        "lengthChange": false,
        "pageLength": 6,
    });
    var shoplist_table = $('#shoplist_table').DataTable({
        "columnDefs": [
            { className: "d-none d-sm-table-cell", "targets": [ 1, 2 ] },
            { className: "quantity-cell", "targets" : [ 3 ],  "orderable": false},
            {"targets": [ 4 ], "orderable": false},
          ],
        "lengthChange": false,
        "pageLength": 6,
    });

    /**
     * Add clicked row to the shoplist table (and remove it from the items table)
     */
    $('#items_table').on( 'click', 'tbody tr :not(.quantity-input)', function (e) {
        e.stopPropagation();
        if (!$(e.target).parents('.quantity-cell').length) {
            let table_row = $(e.target).parents('tr')[0];
            let item_id = table_row.id;
            let quantity = $(table_row).find('td.quantity-cell')[0].children[0].value;
            let row_data = items_table.row( this ).data();
            row_data[3] = buildQuantityInput(quantity);
            row_data[4] = removeBtn;
            row_data[5] = addHiddenItemInput(item_id, quantity);
            items_table.row( this ).remove().draw();
            shoplist_table.row.add(row_data).draw();
            drawInputSpinnerFromItemId(item_id);
        }
    } );

    /**
     * Remove corresponding row from the shoplist table and put it back in the items table
     */
    $('#shoplist_table tbody').on('click', '.remove-item-btn', function (e) {
        e.stopPropagation();
        let table_row = $(e.target).parents('tr')[0];
        let item_id = table_row.id;
        let quantity = $(table_row).find('td.quantity-cell')[0].children[0].value;
        let row_data = shoplist_table.row( table_row ).data();
        row_data[3] = buildQuantityInput(quantity);
        row_data.pop(); //remove delete button from the data array
        shoplist_table.row( table_row ).remove().draw();
        items_table.row.add(row_data).draw();
        drawInputSpinnerFromItemId(item_id);
    });

    $('#create-shoplist-form').submit(function(e) {
        e.preventDefault();
        let form = $(this);
        let serializedData = form.serializeArray();
        let extra_data = retrieveShoplistData(shoplist_table);
        serializedData.push(extra_data)

        $.ajax({ 
            url   : form.attr('action'),
            type  : form.attr('method'),
            contentType: "application/json",
            data  : JSON.stringify(serializedData, null, 2), // data to be submitted
            success: function(response){
               window.location.replace(response);
            }
       });
    });

    // è uguale al precedente, ne basta uno
    $('#edit-shoplist-form').submit(function(e) {
        e.preventDefault();
        let form = $(this);
        let serializedData = objectifyForm(form.serializeArray());
        let extra_data = retrieveShoplistData(shoplist_table);
        serializedData.items = extra_data.value;

        $.ajax({
            url : form.attr('action'),
            type: form.attr('method'),
            contentType: "application/json",
            data: JSON.stringify(serializedData),
            success: function(response) {
                window.location.replace(response.redirect); 
            },
            error: function(response) {
                window.location.replace(response.redirect);
            },
        });
    });
} );
