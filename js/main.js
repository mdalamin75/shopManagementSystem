// intial the data table
new DataTable('#example');

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

