<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT id,poin_user FROM users where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
}
?>
<div class="container-fluid">
<form action="" id="manage-skor">
<table class="table">
		<input type="hidden" name="id" value="<?php echo $id ?>">
		<h3 class="card-title"><b>Poin saat ini = <?php echo $poin_user ?></b></h3>
		<input value="1" class="form-control"name="poin_tam"placeholder="Tambahkan Poin"min=""type="number">
		<br>
		<h6>Bilangan positif untuk menambahkan </h6>
		<h6>Bilangan negatif untuk mengurangi</h6>
        <p></p>
        <h3 class="card-title"><b>Keterangan</b></h3>
		<textarea name="ket" id="" cols="30" rows="10" class="form-control" placeholder="Tuliskan Sesuatu Disini..."></textarea>		
		</table>
	</form>
	

<style>
	<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>
</style>


<script>
	$(function () {
	$('#manage-skor').submit(function(e){
		e.preventDefault()
		start_load()
		// $('#msg').html('')
		$.ajax({
			url:'ajax.php?action=tambah_poin',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Poin berhasil ditambahkan.',"success");
					setTimeout(function(){
						location.reload()
					},1500)
				}else if(resp == 2){
					alert_toast('Poin berhasil didikurangi.',"success");
					setTimeout(function(){
						location.reload()
					},1500)
				}
				else{
					alert_toast("Poin gagal diubah",'error')
					end_load()
				}
			}
		})
	})

  })
</script>