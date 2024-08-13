<?php 
include 'db_connect.php' 
?>
<?php 
$qry = $conn->query("SELECT * FROM survey_set where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	if($k == 'title')
		$k = 'stitle';
	$$k = $v;
}

$taken = $conn->query("SELECT distinct(user_id) from answers where survey_id ={$id}")->num_rows;

$user = $conn->query("SELECT poin_user FROM users where id = '{$_SESSION['login_id']}'");
$row_user = $user->fetch_assoc();
$poin_u= $row_user['poin_user'];

?>
<div class="col-lg-12">
	<div class="row">
        <div class="col-md-8">
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title"><b>Detail Survey</b></h3>
					
				</div>
				<div class="card-body p-0 py-2">
					<div class="container-fluid">
						<p>Judul: <b><?php echo $stitle ?></b></p>
						<p class="mb-0">Deskripsi:</p>
						<small><?php echo $description; ?></small>
						<p>Mulai: <b><?php echo date("M d, Y",strtotime($start_date)) ?></b></p>
						<p>Berakhir: <b><?php echo date("M d, Y",strtotime($end_date)) ?></b></p>
						<p>Jumlah Pengisi: <b><?php echo number_format($taken) ?></b></p>
					</div>
					<hr class="border-primary">
                    <div class="container-fluid">
                    <?php if($status_s == 'tutup'){?>	
						<p>Status : <b>Survey Sudah Ditutup</b></p>
						<?php
						} else if ($status_s =='mulai') { ?>
							<p>Status : <b>Survey Sudah Dimulai</b></p>
						<?php
						} else { ?>
							<p>Status : <b>Survey Belum Dimulai</b></p>
						<?php
						}	
						?>
                    </div>
				</div>
			</div>
		</div>
        <div class="col-md-4">
			<div class="card card-outline card-secondary">
				<div class="card-header">
					<h3 class="card-title"><b>Info Pengguna</b></h3>
				</div>
				<div class="card-body p-0 py-2">
					<div class="container-fluid">
                    <p>Poin yang dimiliki : <b><?php echo number_format($poin_u); ?></b></p>
					</div>
					<hr class="border-primary">
                    <div class="container-fluid">
					<p>poin yang bisa didapat: <b><?php echo number_format($poin_survey) ?></b></p>
					<p>Stok Poin: <b><?php echo number_format($stok_poin) ?></b></p>
                    </div>
					<?php if($skor == 0){?>
                        <div class="container-fluid">
						<form id="answerForm" method="post" action="survey.php?page=answer_survey">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<button type="submit" class="btn btn-sm bg-gradient-primary">
							<i class="fa fa-pen-square"></i> Isi Survey
						</button>
						</form>
                        </div>
						<?php }else{?>
                        <div class="container-fluid">
						<form id="answerForm" method="post" action="survey.php?page=answer_kuis">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<button type="submit" class="btn btn-sm bg-gradient-primary">
						<i class="fa fa-pen-square"></i> Isi Survey
						</button>
						</form>
                        </div>
						<?php }?>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$('.atur_report').click(function(){
		uni_modal("Atur Report","manage_report.php?id=<?php echo $id ?>","large")
	})
$('.ganti_status').click(function(){
	_conf("Jika anda membagikan report, anda tidak bisa menghapus atau pun mengedit survey kembali walaupun berhenti berbagi, apakah anda yakin?","ganti_status",[$(this).attr('data-id')])
})

$('.ganti_status1').click(function(){
	_conf("apakah anda yakin berhenti membagikan report? ","ganti_status1",[$(this).attr('data-id')])
})
	
	function ganti_status($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=atur_status',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Berhasil mengganti status",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}else{
					alert_toast("Gagal mengganti status",'error')
					end_load()
				}
			}
		})
	}

	function ganti_status1($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=atur_status1',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Berhasil mengganti status",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}else{
					alert_toast("Gagal mengganti status",'error')
					end_load()
				}
			}
		})
	}

$(document).ready(function() {
    $('#ambil').submit(function(e){
		e.preventDefault();
		start_load();
		$.ajax({
			url: 'ajax.php?action=ambil_report',
			method: 'POST',
			data: $(this).serialize(),
			success: function(resp) {
				if(resp == 1){
					alert_toast('Berhasil diambil', "success");
					setTimeout(function(){
            		location.reload();
          			}, 1500);
				}else if(resp == 2){
					alert_toast('Gagal diambil', "error");
					end_load();
				}else{
					alert_toast('ada kesalahan', "error");
					end_load();
				}
			}
		});
	});

});

</script>	