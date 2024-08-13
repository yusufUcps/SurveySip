<?php include 'db_connect.php' ?>
<?php
$qry = $conn->query("SELECT * FROM survey_set where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}

$user = $conn->query("SELECT poin_user FROM users where id = $user_id");
$row_user = $user->fetch_assoc();
$poin_u= $row_user['poin_user'];

$poin_maks= $poin_u + $stok_poin;
?>
<div class="container-fluid">
	<form action="" id="manage-poin">
		<div class="col-lg-12">
        <div class="card-body">
            <input type="hidden" name="sid" value="<?php echo $id ?>">
            <input type="hidden" name="uid" value="<?php echo $user_id ?>">
			<h3 class="card-title"><b>Poin saat ini = <?php echo $poin_u ?></b></h3>
			<br>
			<br>
            <h3 class="card-title"><b>poin yang bisa didapat = <?php echo $poin_survey ?></b></h3>
			<br>
			<p>(poin yang didapatkan penjwab survey)</p>
			<input value="<?php echo $poin_survey ?>" class="form-control" type="number" name="poin" min="0" max="<?php echo $poin_maks?>" placeholder="<?php echo $poin_survey ?>"oninput="limitInput(this)">
            <p></p>
            <h3 class="card-title"><b>stok poin yang diatur = <?php echo $stok_poin ?></b></h3>
			<br>
			<p>(poin ini akan diambil dari poin pembuat)</p>
			<input value="<?php echo $stok_poin ?>" class="form-control" type="number" name="stok_poin" min="0" max="<?php echo $poin_maks?>"placeholder="<?php echo $stok_poin ?>" oninput="limitInput(this)">
                
            </div>
		</div>
	</form>
</div>



<script>
	function limitInput(input) {
  if (input.value > <?php echo $poin_maks ?>) {
    input.value = <?php echo $poin_maks ?>;
  }
}
	$(function () {
	$('#manage-poin').submit(function(e){
		e.preventDefault()
		start_load()
		// $('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_poin',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Poin Berhasil Disimpan.',"success");
					setTimeout(function(){
						location.reload()
					},1500)
				}else{
				alert_toast('Gagal Menyimpan Poin', "error");
				end_load();
				}
			}
		})
	})

  })
</script>