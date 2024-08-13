<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login | Online Survey System</title>
 	

<?php include('./header.php'); ?>
<?php include('./footer.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:survey.php?page=home");

?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    position: fixed;
	    top:0;
	    left: 0
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		display: flex;
	}

</style>

<body class="bg-dark">


  <main id="main" >
  <div class="container">
  		<div class="align-self-center w-100">
        <br>
        <br>
        <br>
        <br>
		<h4 class="text-white text-center"><b>Online Survey System</b></h4>
  		<div id="login-center" class="bg-dark row justify-content-center">
  			<div class="card col-md-6">
  				<div class="card-body">
                  <form action="" id="manage_user">
                  <input type="hidden" name="type" value="3">
				<div class="row">
					
						<b class="text-muted">Form Pendaftaran</b>
						<p id="error-msg"></p>
						<div class="form-group">
							<label for="" class="control-label text-dark">Nama Depan</label>
							<input type="text" name="firstname" class="form-control form-control-sm" >
						</div>
						<div class="form-group">
							<label for="" class="control-label text-dark">Nama Belakang</label>
							<input type="text" name="lastname" class="form-control form-control-sm" >
						</div>
						
						<div class="form-group">
							<label class="control-label text-dark">Email</label>
							<input type="email" class="form-control form-control-sm" name="email" >
							<small id="msg"></small>
						</div>
						<div class="form-group">
							<label class="control-label text-dark">Password</label>
							<input type="password" class="form-control form-control-sm" name="password" >
							
						</div>
						<div class="form-group">
							<label class="control-label text-dark">Konfirmasi Password</label>
							<input type="password" class="form-control form-control-sm" name="cpass">
							<small id="pass_match" data-status=''></small>
						</div>
					
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-success mr-2">Daftar</button>
					<a class="btn btn-primary mr-2" href="login.php">Login</a>
				</div>
			</form>
  		</div>
  		</div>
          </div>
  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('[name="password"],[name="cpass"]').keyup(function(){
		var pass = $('[name="password"]').val()
		var cpass = $('[name="cpass"]').val()
		if(cpass == '' ||pass == ''){
			$('#pass_match').attr('data-status','')
		}else{
			if(cpass == pass){
				$('#pass_match').attr('data-status','1').html('<i class="text-success">Password Cocok.</i>')
			}else{
				$('#pass_match').attr('data-status','2').html('<i class="text-danger">Password Tidak Cocok.</i>')
			}
		}
	})
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage_user').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		var firstname = $('[name="firstname"]').val();
    	var lastname = $('[name="lastname"]').val();
    	var email = $('[name="email"]').val();
    	var password = $('[name="password"]').val();
    	var cpass = $('[name="cpass"]').val();

    	if (firstname === '' || lastname === '' || email === '' || password === '' || cpass === '') {
			$('#error-msg').html("<div class='alert alert-danger'>Tidak boleh ada yang kosong.</div>");
        $('[name="firstname"], [name="lastname"], [name="email"], [name="password"], [name="cpass"]').addClass("border-danger");
        end_load();
        return false;
   		 }
		if($('#pass_match').attr('data-status') != 1){
			if($("[name='password']").val() !=''){
				$('[name="password"],[name="cpass"]').addClass("border-danger")
				end_load()
				return false;
			}
		}
		$.ajax({
			url:'ajax.php?action=save_user',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Berhasil Mendaftar',"success");
					setTimeout(function(){
						location.href ='survey.php?page=home';
					},750)
				}else if(resp == 2){
					$('#msg').html("<div class='alert alert-danger'>Email Sudah Digunakan.</div>");
					$('[name="email"]').addClass("border-danger")
					end_load()
				}else{
					alert_toast("Data Gagal Disimpan",'error')
					end_load()
				}
			}
		})
	})

	
</script>
</html>