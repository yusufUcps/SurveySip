<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT id,skor FROM survey_set where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
}
?>
<div class="container-fluid">
<form action="" id="manage-skor">
<table class="table">
		<?php $soal = $conn->query("SELECT pertanyaan from kuis_s where survey_id =".$_GET['id'])->num_rows;
		?>
		<input type="hidden" name="id" value="<?php echo $id ?>">
		<h3 class="card-title"><b>Minimum Skor = <?php echo $skor ?></b></h3>
		<input value="<?php echo $skor ?>" class="form-control" type="number" name="skor" min="0" max="<?php echo $soal?>" placeholder="<?php echo $skor ?>"oninput="limitInput(this)">		
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
	function limitInput(input) {
  if (input.value > <?php echo $soal ?>) {
    input.value = <?php echo $soal ?>;
  }
}
	$(function () {
	$('#manage-skor').submit(function(e){
		e.preventDefault()
		start_load()
		// $('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_skor',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Skor Berhasil Disimpan.',"success");
					setTimeout(function(){
						location.reload()
					},1500)
				}else{
					alert_toast("Skor gagal disimpan",'error')
					end_load()
				}
			}
		})
	})

  })
</script>