<?php include 'db_connect.php' ?>

<div class="col-lg-12">
	<div class="d-flex w-100 justify-content-center align-items-center mb-2">
		<label for="" class="control-label">Cari Survey</label>
		<div class="input-group input-group-sm col-sm-5">
          <input type="text" class="form-control" id="filter" placeholder="judul / deskripisi  ">
          <span class="input-group-append">
            <button type="button" class="btn btn-primary btn-flat" id="search">cari</button>
          </span>
        </div>
	</div>
	<div class=" w-100" id='ns' style="display: none"><center><b>Tidak ada</b></center></div>
	<div class="row">
		<?php 
		$survey = $conn->query("SELECT * FROM survey_set where user_id = '{$_SESSION['login_id']}' and (status_s = 'mulai' or status_s = 'tutup') order by abs(id) asc");
		while($row=$survey->fetch_assoc()):
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
               <?php echo $row['description'] ?>
               <div class="row">
               	<hr class="border-primary">
               	<div class="d-flex justify-content-center w-100 text-center">
               			<a href="survey.php?page=detail_survey_report&id=<?php echo $row['id'] ?>" class="btn btn-sm bg-gradient-primary"><i class="fa fa-poll"></i> View Report</a>
               	</div>
               </div>
              </div>
            </div>
		</div>
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