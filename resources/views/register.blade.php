<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Registration</title>

    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <section class="container">
        <header>Employee Registration</header>

        <form class="form" id="register-form">
            @csrf

            <div class="column">
                <div class="input-box">
                  <span>Employee Photo</span>
                  <input type="file" name="profile_picture" accept="image/*" required>
                </div>

                <div class="input-box">
                    <span>Full Name</span>
                    <input type="text" name="full_name" placeholder="Enter fullname" required>
                </div>
            </div>

            <div class="column">
                <div class="input-box">
                    <span>Age</span>
                    <input type="number" name="age" placeholder="Enter age" required>
                </div>

                <div class="input-box">
                  <span>Birth Date</span>
                  <input type="date" name="birth" required>
                </div>
            </div>

            <div class="column">
                <div class="input-box">
                    <span>Phone Number</span>
                    <input type="number" name="phone" placeholder="Enter phone number" required>
                </div>

                <div class="input-box">
                  <span>Email Address</span>
                  <input type="email" name="email" placeholder="Enter email" required>
                </div>
            </div>

            <div class="column">
                <div class="input-box">
                    <span>Gender</span>
                    <div class="select-box">
                        <select required>
                            <option disabled selected>Select gender</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Others</option>
                        </select>
                    </div>
                </div>

                <div class="input-box">
                    <span>Civil Status</span>
                    <div class="select-box">
                        <select required>
                            <option disabled selected>Select status</option>
                            <option>Single</option>
                            <option>Married</option>
                            <option>Widowed</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="input-box">
                    <span>Work Position</span>
                    <input type="text" name="phone" placeholder="Enter phone number" required>
                </div>

                <div class="input-box">
                  <span>Type of Work</span>
                    <div class="select-box">
                        <select required>
                            <option disabled selected>Select type</option>
                            <option>Onsite</option>
                            <option>Hybrid</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="input-box address">
                <span>Address</span>
                <input type="text" placeholder="Enter street address" required />
            </div>

            <button type="submit" class="btn btn-primary" id="btnSubmit">Register</button>
        </form>
    </section>

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
