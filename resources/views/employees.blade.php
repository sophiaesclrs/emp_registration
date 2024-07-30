<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>

    <table id="employees-log">
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Profile</th>
            <th>Actions</th>
        </tr>
    </table>

    <script>
        $(document).ready(function(){
            $.ajax({
                type: "GET",
                url: "{{ route('getEmployees') }}",
                success: function(data) {
                    console.log(data);
                    if(data.employees.length > 0) {
                        for(let i = 0; i < data.employees.length; i++) {
                            let img = data.employees[i].profile_picture;
                            let imgUrl = "{{ asset('storage') }}/" + img;

                            $("#employees-log").append('<tr>' +
                                '<td>' + (i + 1) + '</td>' +
                                '<td>' + data.employees[i].full_name + '</td>' +
                                '<td>' + data.employees[i].email + '</td>' +
                                '<td><img src="' + imgUrl + '" alt="Profile Picture" width="100"></td>' +
                                '<td><a href="updateEmployee/' + data.employees[i].id + '">Update</a> <a class="deleteData" href="javascript:void(0);" data-id='+ data.employees[i].id +'>Delete</a></td>' +
                                '</tr>');
                        }
                    } else {
                        $("#employees-log").append("<tr><td colspan='5'>No registered employees at this time</td></tr>");
                    }
                },
                error: function(err) {
                    console.log(err.responseText);
                }
            });
        });

        $("#employees-log").on("click", ".deleteData", function(){
            var id = $(this).attr("data-id");
            var obj = $(this);
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this employee data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "GET",
                        url: "delete-data/" + id,
                        success: function(data) {
                            $(obj).parent().parent().remove();
                            swal("Poof! Your employee data has been deleted!", {
                                icon: "success",
                            });
                        },
                        error: function(err) {
                            swal("Error deleting data!", {
                                icon: "error",
                            });
                            console.log(err.responseText);
                        }
                    });
                } else {
                    swal("Your employee data is safe!");
                }
            });
        });
    </script>

</body>
</html>
