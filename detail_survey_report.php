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
					
					<?php
					$am = $conn->query ("SELECT * FROM riwayat where survey_id = $id and user_id ={$_SESSION['login_id']} and keterangan = 'Mengambil report survey'" )->num_rows;
				if($am >= 1){ 
					?>
					<div class="container-fluid">
					<p>Anda sudah mengambil report ini</p>
					</div>
					<hr class="border-primary">
					<form id="lihat"  action="survey.php?page=view_survey_report" method="POST">
        			<input type="hidden" name="id" value="<?php echo $id; ?>">
					<button class="btn btn-sm btn-flat bg-gradient-primary mx-1" >Lihat Report</button>
    				</form>
					<?php
				}else if($user_id == $_SESSION['login_id'] ){
				?>	<div class="container-fluid">
					<p>Ini merupakan report dari survey yang anda buat</p>
					<p>Status report : <b><?php echo $status_r; ?></b></p>
					<?php if($status_r == 'pribadi'){  ?>
						<?php if ($status_s == 'buka') {?>
						<p>Tutup survey dahulu agar bisa membagikan report</p>
						<form id="view"  action="survey.php?page=view_survey" method="POST">
        						<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
								<button class="btn btn-sm btn-flat bg-gradient-primary mx-1" >lihat survey</i></button>
								</form>
						<?php } else {?>
							<p>Poin report yang diatur : <b><?php echo number_format($poin_r); ?></b></p>
							<p></p>
							<a class="btn btn-sm btn-flat bg-gradient-primary mx-1 atur_report" href="javascript:void(0)" data-id="<?php echo $id ?>">Pengaturan poin</a>
							<p></p>
							<a class="btn btn-sm btn-flat bg-gradient-primary mx-1 ganti_status " href="javascript:void(0)" data-id="<?php echo $id ?>">Bagikan Report</a>
						<?php } ?>
					<?php
					}
					?>
					<?php if($status_r == 'sedang berbagi'){  ?>
					<p>Poin report yang diatur : <b><?php echo number_format($poin_r); ?></b></p>
					<p></p>
						<a class="btn btn-sm btn-flat bg-gradient-primary mx-1 atur_report" href="javascript:void(0)" data-id="<?php echo $id ?>">Pengaturan poin</a>
					<p></p>
						<a class="btn btn-sm btn-flat bg-gradient-primary mx-1 ganti_status1 " href="javascript:void(0)" data-id="<?php echo $id ?>">Berhenti Berbagi Report</a>
					</div>
					<?php
					}
					?>
					<?php if($status_r == 'berhenti berbagi'){  ?>
					<p>Poin report yang diatur : <b><?php echo number_format($poin_r); ?></b></p>
					<p></p>
						<a class="btn btn-sm btn-flat bg-gradient-primary mx-1 atur_report" href="javascript:void(0)" data-id="<?php echo $id ?>">Pengaturan poin</a>
					<p></p>
						<a class="btn btn-sm btn-flat bg-gradient-primary mx-1 ganti_status " href="javascript:void(0)" data-id="<?php echo $id ?>">Bagikan Report</a>
					</div>
					<?php
					}
					?>
					<hr class="border-primary">
					<form id="lihat"  action="survey.php?page=view_survey_report" method="POST">
        			<input type="hidden" name="id" value="<?php echo $id; ?>">
					<button class="btn btn-sm btn-flat bg-gradient-primary mx-1" >Lihat Report</button>
    				</form>
				<?php
				}	
				else{	
				?>
				<div class="container-fluid">
				<p>Anda Belum Mempunyai report ini, silakan diambil dengan poin !! </p>
				<p>Poin yang dibutuhkan : <b><?php echo number_format($poin_r); ?></b></p>
				</div>
				<hr class="border-primary">
					<form id="ambil" action="">
        			<input type="hidden" name="sid" value="<?php echo $id; ?>">
					<input type="hidden" name="uid" value="<?php echo $user_id; ?>">
					<button class="btn btn-sm btn-flat bg-gradient-primary mx-1" >Ambil Report</button>
    				</form>
					<?php
				}?>
					
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$('.atur_report').click(function(){
		uni_modal("Atur Report","manage_report.php?id=<?php echo $id ?>")
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