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
                <div class="form-group">
							<label for="" class="control-label">Mulai</label>
							<input type="date" name="start_date" class="form-control form-control-sm" required value="<?php echo isset($start_date) ? $start_date : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Berakahir</label>
							<input type="date" name="end_date" class="form-control form-control-sm" required value="<?php echo isset($end_date) ? $end_date : '' ?>">
						</div>

                    <div class="card-header">
						<label class="text-red">PENTING</label>
						
					</div>
					<div class="container-fluid">
						<p class="text-red">Jika survey sudah dimulai maka tidak dapat mengedit pertanyaan kembali sampai survey ditutup, dan jika ingin mengedit pertanyaan akan menghapus jawaban yang ada pada survey ini !!!</b></p>
					</div>
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
			url:'ajax.php?action=mulai_survey',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Survey Berhasil Dimulai.',"success");
					setTimeout(function(){
						location.reload()
					},1500)
				}else{
					alert_toast("Survey gagal memulai",'error')
					end_load()
				}
			}
		})
	})

  })
</script>