<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Registration</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    <form id="register-form">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Name</label>
                <input type="text" name="full_name" placeholder="Enter your name" required>
            </div>
            <div class="form-group col-md-6">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
        </div>
        <div class="form-group">
            <label for="">Profile Pic</label>
            <input type="file" id="profile-picture" name="profile_picture" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary" id="btnSubmit">Register</button>
    </form>

    <span id="output"></span>

    <script>
        $("#register-form").submit(function(registration){
            registration.preventDefault();

            var form = $("#register-form")[0];
            var data = new FormData(form);

            $("#btnSubmit").prop("disabled",true);

            $.ajax({
                type:"POST",
                url:"{{ route('registerEmp') }}",
                data:data,
                processData:false,
                contentType:false,
                success:function(data){
                    $("#output").text(data.respond);
                    $("#btnSubmit").prop("disabled",false);
                    $("input[type='text']").val('');
                    $("input[type='email']").val('');
                    $("input[type='file']").val('');

                    swal({
                        position: "center",
                        icon: "success",
                        title: "Successfully Registered!",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(function() {
                        window.location.href = "/get-employees";
                    });

                },
                error: function(e){
                    $("#btnSubmit").prop("disabled", false);

                    let errorMessage = e.responseJSON ? e.responseJSON.message : 'An error occurred. Please try again.';
                    
                    swal({
                        title: "Error!",
                        text: errorMessage,
                        icon: "error",
                        button: "try again",
                    });

                    $("#output").text(e.responseText);
                }
            });
        })
    </script>


</body>
</html>
