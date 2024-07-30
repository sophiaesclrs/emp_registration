
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<img src="{{ asset('storage/') }}/{{ $emp[0]->profile_picture }}" alt="" width="100">

<form id="update-form">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Name</label>
                <input type="text" name="full_name" value="{{ $emp[0]->full_name }}">
            </div>
            <div class="form-group col-md-6">
                <label for="">Email</label>
                <input type="email" name="email" value="{{ $emp[0]->email }}" class="form-control" id="email">
            </div>
        </div>
        <div class="form-group">
            <label for="">Profile Pic</label>
            <input type="file" name="profile_picture" id="profile-picture" accept="image/*">
            <input type="hidden" id="profile-picture" value="{{ $emp[0]->id }}" name="id" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Update Employee</button>
    </form>

    <span id="output"></span>

    <script>
        $(document).ready(function(){
            $("#update-form").submit(function(registration){
                registration.preventDefault();

                var form = $("#update-form")[0];
                var data = new FormData(form);

                $("#btnSubmit").prop("disabled",true);

                $.ajax({
                    type:"POST",
                    url:"{{ route('updateEmp') }}",
                    data:data,
                    processData:false,
                    contentType:false,
                    success:function(data){
                        $("#output").text(data.result);

                        swal({
                            position: "center",
                            icon: "success",
                            title: "Successfully Updated!",
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function() {
                            window.location.href = "/get-employees";
                        });
                    },
                    error:function(e){

                        let errorMessage = e.responseJSON ? e.responseJSON.message : 'An error occurred. Please try again.';
                    
                        swal({
                            title: "Error!",
                            text: errorMessage,
                            icon: "error",
                            button: "try again",
                        });

                    $("#output").text(e.responseText);


                        $("#output").text(e.responseText);
                    }
                });
        })
        });
    </script>