<?php
?>
<div class="container">
<div class="col-md-8 ">
	<div class="card">
		<div class="card-body ">
			<form action="" id="manage_user">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					
						<b class="text-muted">Form Pendaftaran</b>
						<div class="form-group">
							<label for="" class="control-label">Nama Depan</label>
							<input type="text" name="firstname" class="form-control form-control-sm" required value="<?php echo isset($firstname) ? $firstname : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Nama Belakang</label>
							<input type="text" name="lastname" class="form-control form-control-sm" required value="<?php echo isset($lastname) ? $lastname : '' ?>">
						</div>
						<?php if($_SESSION['login_type'] == 1): ?>
						<div class="form-group">
							<label for="" class="control-label">Peran</label>
							<select name="type" id="type" class="custom-select custom-select-sm">
								<option value="3" <?php echo isset($type) && $type == 3 ? 'selected' : '' ?>>Member</option>
								<option value="1" <?php echo isset($type) && $type == 1 ? 'selected' : '' ?>>Admin</option>
							</select>
						</div>
						<?php else: ?>
							<input type="hidden" name="type" value="3">
						<?php endif; ?>
						<div class="form-group">
							<label class="control-label">Email</label>
							<input type="email" class="form-control form-control-sm" name="email" required value="<?php echo isset($email) ? $email : '' ?>">
							<small id="#msg"></small>
						</div>
						<div class="form-group">
							<label class="control-label">Password</label>
							<input type="password" class="form-control form-control-sm" name="password" <?php echo isset($id) ? "":'required' ?>>
							<small><i><?php echo isset($id) ? "kosongkan ini jika tidak ingin mengubah password":'' ?></i></small>
						</div>
						<div class="form-group">
							<label class="label control-label">Konfirmasi Password</label>
							<input type="password" class="form-control form-control-sm" name="cpass" <?php echo isset($id) ? 'required' : '' ?>>
							<small id="pass_match" data-status=''></small>
						</div>
					
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary mr-2">Simpan</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=user_list'">Kembali</button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>

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
					alert_toast('Data Berhasil Disimpan.',"success");
					setTimeout(function(){
						location.replace('survey.php?page=user_list')
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