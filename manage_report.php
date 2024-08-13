<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM survey_set where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
}
?>
<div class="container-fluid">
	<form action="" id="manage-skor">
		<div class="row">
			<div class="col-lg-12">
				<div class="card-body">
					<input type="hidden" name="id" value="<?php echo $id ?>">
					<label for="" class="control-label">Poin Report = <?php echo $poin_r ?></label>
					<input value="<?php echo $poin_r ?>" class="form-control" type="number" name="poin_r" id="poin_r" min="0">
			</div>
		</div>
	</form>
</div>




<script>
	
	$(function () {
	$('#manage-skor').submit(function(e){
		e.preventDefault()
		start_load()
		// $('#msg').html('')
		$.ajax({
			url:'ajax.php?action=atur_report',
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
					alert_toast("Poin gagal disimpan",'error')
					end_load()
				}
			}
		})
	})

  })
</script>