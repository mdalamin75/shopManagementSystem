// intial the data table
new DataTable('#category_table');
new DataTable('#company_table');
new DataTable('#product_table');
new DataTable('#sale_table');
new DataTable('#stock_table');
new DataTable('#users_table');

// active link for sidebar
// JavaScript
// You need to include jQuery for this to work
$(document).ready(function() {
    // Get the current page URL
    var url = window.location.pathname;

    // Extract the page name (e.g., "index.html" becomes "index")
    var pageName = url.substring(url.lastIndexOf('/') + 1).split('.')[0];

    // Add the "active" class to the corresponding navbar link
    $('#' + pageName).addClass('active');
  });

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
        $('#category').val(data[1]);
        $('#product_name').val(data[2]);
        $('#price').val(data[3]);
        $('#quantity').val(data[4]);
        $('#company').val(data[5]);
        $('#date').val(data[6]);
    });
});
// edit sale product data
$(document).ready(function () {
    $(".edit_sale").click(function (e) { 
        e.preventDefault();
        $("#editsale").modal("show");
        $tr = $(this).closest("tr");
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#update_id').val(data[0]);
        $('#sale_date').val(data[1]);
        $('#product').val(data[2]);
        $('#sale_quantity').val(data[3]);
        $('#total_sale').val(data[4]);
        console.log(data);
    });
});
// edit users product data
$(document).ready(function () {
    $(".edit_users").click(function (e) { 
        e.preventDefault();
        $("#editUsers").modal("show");
        $tr = $(this).closest("tr");
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#update_user_id').val(data[0]);
        $('#user_name').val(data[1]);
        $('#user_role').val(data[2]);
        $('#user_password').val(data[3]);
        console.log(data);
    });
});

