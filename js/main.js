// intial the data table
new DataTable('#category_table');
new DataTable('#company_table');
new DataTable('#product_table');

// edit category data
$(document).ready(function () {
    $(".edit_category").click(function (e) { 
        e.preventDefault();
        $("#editCategory").modal("show");
        $tr = $(this).closest("tr");
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#update_id').val(data[0]);
        $('#category_name').val(data[1]);
    });
});
// edit company data
$(document).ready(function () {
    $(".edit_company").click(function (e) { 
        e.preventDefault();
        $("#editcompany").modal("show");
        $tr = $(this).closest("tr");
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#update_id').val(data[0]);
        $('#company_name').val(data[1]);
    });
});
// edit product data
$(document).ready(function () {
    $(".edit_product").click(function (e) { 
        e.preventDefault();
        $("#editproduct").modal("show");
        $tr = $(this).closest("tr");
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#update_id').val(data[0]);
        $('#category').val(data[1]).addClass("selected");
        $('#product_name').val(data[2]);
        $('#price').val(data[3]);
        $('#quantity').val(data[4]);
        $('#company').val(data[5]);
    });
});

