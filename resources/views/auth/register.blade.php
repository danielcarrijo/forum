@extends('layouts.register')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form autocomplete="off">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" />
                                <span style="font-size:10pt; color:red" class="ml-3" id="name-warning"></span> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" autocomplete="off" />
                                <span style="font-size:10pt; color:red" class="ml-3" id="username-warning"></span> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" />
                                <span style="font-size:10pt; color:red" class="ml-3" id="email-warning"></span> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" />
                                <span style="font-size:10pt; color:red" class="ml-3" id="password-warning"></span> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirmpassword" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="confirmpassword" type="password" class="form-control" name="confirmpassword" />
                                <span style="font-size:10pt; color:red" class="ml-3" id="confirmpassword-warning"></span> 
                            </div>
                        </div>
                        <button id="btn-submit" class="btn btn-primary"> Register </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
var valid_username=-1
console.log('dkfmfm')
$.ajaxSetup({

headers: {

    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});

function check_username(value) {
    valid_username = 1
    const usernameRegex = RegExp(/^(\d|\w)+$/);
    if(!usernameRegex.test(value)) {
        $("#username-warning").html("Spaces and special characters are not allowed")
        $("#username").addClass("border border-danger");
        return false
    }
    $.ajax({
            type :'GET',
            url:'/user',
            success:function(data){
                $.each(data['users'], function (key, val) {
                    if(val.username == value) {
                        $("#username-warning").html("Username has already been registered")
                         $("#username").removeClass("border-success")
                        $("#username").addClass("border border-danger");
                        valid_username=0
                        return false
                    }
                }); 
            }

       });
       $("#username-warning").html("")
        $("#username").removeClass("border-danger")
        $("#username").addClass("border border-success");
        console.log('oiu')
        return true
}

$("#username").change(function(e) {
    const {name, value} = e.target
    check_username(value)
});

$("#btn-submit").click(function(e){

  

e.preventDefault();

const emailRegex = RegExp(
  /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
);


var name = $("input[name=name]").val();

var username = $("input[name=username]").val();

var email = $("input[name=email]").val();

var password = $("input[name=password]").val();

var confirmpassword = $("input[name=confirmpassword]").val();


var ok = 1;

if (!(/\S/.test(name))) {
    $("#name").addClass("border border-danger")
    $("#name-warning").html("Please type a valid name");
    ok=0
} else if (name.length > 1000) {
    $("#name").addClass("border border-danger")
    $("#name-warning").html("Write a shorter name");
    ok=0
}else{
    $("#name").removeClass("border border-danger")
    $("#name-warning").html("");
}
if (!(/\S/.test(username))) {
    $("#username").addClass("border border-danger")
    $("#username-warning").html("Please type a valid username");
    ok=0
}else if (username.length > 255) {
    $("#username").addClass("border border-danger")
    $("#username-warning").html("Write a shorter username");
    ok=0
}else if(!check_username(username)) {
        console.log(check_username(username))
        console.log('entrei')
        ok = 0
}
else {
    $("#username-warning").html("");
}

if (!(/\S/.test(email))) {
    $("#email").addClass("border border-danger")
    $("#email-warning").html("Please type a valid email");
    ok=0
    
}else if (!emailRegex.test(email)) {
    $("#email").addClass("border border-danger")
    $("#email-warning").html("Invalid email. Uset the following format: user@email.com (or other extension)");
    ok=0
}else {
    $("#email").removeClass("border border-danger")
    $("#email-warning").html("");
}
if (!(/\S/.test(password))) {
    $("#password").addClass("border border-danger")
    $("#password-warning").html("Please type a valid password");
    ok=0
}else if (password.length < 6) {
    $("#password").addClass("border border-danger")
    $("#password-warning").html("Write a longer password");
    ok=0
} else {
    $("#password").removeClass("border border-danger")
    $("#password-warning").html("");
}
if (!(/\S/.test(confirmpassword)) || (confirmpassword != password)) {
    console.log(password) 
    console.log(confirmpassword)
    $("#confirmpassword").addClass("border border-danger")
    $("#confirmpassword-warning").html("Passwords don't match");
    ok=0
}else {
    $("#confirmpassword").removeClass("border border-danger")
    $("#confirmpassword-warning").html("");
}

console.log(ok)

if (ok==1) {
    $("#name").removeClass("border border-danger")
    $("#name-warning").html("");
    $("#username").removeClass("border border-danger")
    $("#username-warning").html("");
    $("#email").removeClass("border border-danger")
    $("#email-warning").html("");
    $("#password").removeClass("border border-danger")
    $("#password-warning").html("");
    $("#confirmpassword").removeClass("border border-danger")
    $("#confirmpassword-warning").html("");
    $
    $.ajax({

        type:'POST',

        url:'/user',

        data:{name:name, username:username, email:email, password:password},

        success:function(data){
            console.log(data)
            alert(data)
            window.location.href = "/login";

        }

    });
}
});

</script>
@endsection