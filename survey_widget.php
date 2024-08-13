<?php include 'db_connect.php' ?>
<?php 
if($_SESSION['login_type'] == 1){
	echo "<script>window.location.href = 'survey.php?page=dashboard';</script>";
    exit();
}
$answers = $conn->query("SELECT distinct(survey_id) from answers where user_id ={$_SESSION['login_id']}");
$ans = array();
while($row=$answers->fetch_assoc()){
	$ans[$row['survey_id']] = 1;
}
$blok = $conn->query("SELECT survey_id from daftar_blokir where user_id ={$_SESSION['login_id']}");
$blokir = array();
while($row=$blok->fetch_assoc()){
	$blokir[$row['survey_id']] = 1;}
?>
<div class="col-lg-12">
	<div class="d-flex w-100 justify-content-center align-items-center mb-2">
		<label for="" class="control-label">Cari Survey</label>
		<div class="input-group input-group-sm col-sm-5">
          <input type="text" class="form-control" id="filter" placeholder="judul / deskripsi / poin">
          <span class="input-group-append">
            <button type="button" class="btn btn-primary btn-flat" id="search">Cari</button>
          </span>
        </div>
	</div>
	<div class=" w-100" id='ns' style="display: none"><center><b>Tidak ditemukan.</b></center></div>
	<div class="row">
		<?php 
		$survey = $conn->query("SELECT * FROM survey_set where status_s = 'mulai' and '".date('Y-m-d')."' between date(start_date) and date(end_date) order by rand() ");
		while($row=$survey->fetch_assoc()):
			if(!isset($ans[$row['id']])&&!isset($blokir[$row['id']])){ 
		?>
		<div class="col-md-3 py-1 px-1 survey-item">
			<div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo ucwords($row['title']) ?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
               <?php 
			   $description = $row['description']; // Ambil deskripsi dari database
				$batas_panjang = 150; // Batasan panjang deskripsi yang ditampilkan
				$poin = $row['poin_survey']; // Ambil deskripsi dari database
				$stok_poin = $row['stok_poin']; // Ambil deskripsi dari database

				if (strlen($description) > $batas_panjang) {
					$deskripsi_pendek = substr($description, 0, $batas_panjang); // Potong deskripsi menjadi panjang yang diinginkan
					$deskripsi_pendek .= '...'; // Tambahkan tanda elipsis
					echo $deskripsi_pendek;
					echo '<div class="row">';
					echo '<hr class="border-primary">';
					echo '<p>poin :  $poin </p>';
					echo '<p>stok poin : $stok_poin </p>';
					echo '<div class="d-flex justify-content-center w-100 text-center">';
					echo '</div>';
					echo '</div>';
				} else {
					echo $description;
					echo '<div class="row">';
					echo '<hr class="border-primary">';
					echo '<div class="d-flex justify-content-center w-100 text-center">';
					echo '</div>';
					echo '</div>';
				} ?>
					<p>poin : <?php echo $poin ?> </p>
					<p>stok poin : <?php echo $stok_poin ?> </p>
					<div class="d-flex justify-content-center w-100 text-center">
               			<a href="survey.php?page=detail_survey&id=<?php echo $row['id'] ?>" class="btn btn-sm bg-gradient-primary"><i class="fa fa-poll"></i> Lihat Survey</a>
               	</div>
              </div>
            </div>
		</div>
		<?php } ?>
	<?php endwhile; ?>
	</div>
</div>
<script>
	function find_survey(){
		start_load()
		var filter = $('#filter').val()
			filter = filter.toLowerCase()
			console.log(filter)
		$('.survey-item').each(function(){
			var txt = $(this).text()
			if((txt.toLowerCase()).includes(filter) == true){
				$(this).toggle(true)
			}else{
				$(this).toggle(false)
			}
			if($('.survey-item:visible').length <= 0){
				$('#ns').show()
			}else{
				$('#ns').hide()
			}
		})
		end_load()
	}
	$('#search').click(function(){
		find_survey()
	})
	$('#filter').keypress(function(e){
		if(e.which == 13){
		find_survey()
		return false;
		}
	})
</script>