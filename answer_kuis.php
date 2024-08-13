<?php 
include 'db_connect.php' 
?>
<?php 
extract($_POST);
$sid = $id;
$qry = $conn->query("SELECT * FROM survey_set WHERE id = ".$_POST['id']);

if ($qry->num_rows > 0) {
    $row = $qry->fetch_assoc();

    foreach ($row as $k => $v) {
        if ($k == 'title') {
            $k = 'stitle';
        }
        $$k = $v;
    }
} else {
    echo "<script>alert('Maaf, survey ini tidak ditemukan'); window.location.href = 'survey.php?page=survey_widget';</script>";
    exit();
}

$blok = $conn->query("SELECT id from daftar_blokir where survey_id = $sid and user_id ={$_SESSION['login_id']}")->num_rows;
if($blok >= 1){
	echo "<script>alert('Maaf, Anda tidak memenuhi kriteria untuk mengisi survey ini!'); window.location.href = 'survey.php?page=survey_widget';</script>";
	exit();
}else{ ?>
	<div class="col-lg-12">
	<div class="row">
		<div class="col-md-4">
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

					</div>
					<hr class="border-primary">
					<div class="container-fluid">
						<p>poin yang bisa didapat: <b><?php echo number_format($poin_survey) ?></b></p>
						<p>Stok Poin: <b><?php echo number_format($stok_poin) ?></b></p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
		<div id="msg"></div>
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title"><b>Survey kuis</b></h3>
				</div>
				<form a id="manage-survey1">
					<input type="hidden" name="survey_id" value="<?php echo $id ?>">
				<div class="card-body ui-sortable">
					<?php 
					$question = $conn->query("SELECT * FROM kuis_s where survey_id = $id order by abs(order_by) asc,abs(id) asc");
					while($row=$question->fetch_assoc()):	
					?>
					<div class="callout callout-info">
						<h5><?php echo $row['pertanyaan'] ?></h5>	
						<div class="col-md-12">
						<input type="hidden" name="qid[<?php echo $row['id'] ?>]" value="<?php echo $row['id'] ?>">	
							<?php
									foreach(json_decode($row['frm_option']) as $k => $v):
							?>
							<div class="icheck-primary">
		                        <input type="radio" id="option_<?php echo $k ?>" name="answer[<?php echo $row['id'] ?>]" value="<?php echo $v ?>" checked="">
		                        <label for="option_<?php echo $k ?>"><?php echo $v ?></label>
		                     </div>
								<?php endforeach; ?>
						</div>	
					</div>
					<?php endwhile; ?>
				</div>
				<div class="card-footer border-top border-success">
					<div class="d-flex w-100 justify-content-center">
						<button class="btn btn-sm btn-flat bg-gradient-primary mx-1" >Kirim Jawaban</button>
                        </form>
						<button class="btn btn-sm btn-flat bg-gradient-secondary mx-1" type="button" onclick="location.href = 'survey.php?page=survey_widget'">Kembali</button>
					</div>
				</div>
                </form>
				<form id="redirectForm" action="survey.php?page=answer_survey" method="POST">
        		<input type="hidden" name="id" value="<?php echo $id; ?>">
   			 	</form>
										
			</div>
		</div>
	</div>
</div>
<?php
}

?>
<script>
$(document).ready(function() {
    $('#manage-survey1').submit(function(e){
		e.preventDefault();
		start_load();
		$.ajax({
			url: 'ajax.php?action=cek_kuis',
			method: 'POST',
			data: $(this).serialize(),
			success: function(resp) {
				if(resp == 1){
					document.getElementById('redirectForm').submit();
				}else if(resp == 2){
					location.reload();
				}else{
					$('#msg').html('<div class="alert alert-danger">Ada Kesalahan Dalam Meyimpan Jawaban, Silahkan Coba Kembali</div>')
					end_load()
				}
			}
		});
	});

});
</script>	

