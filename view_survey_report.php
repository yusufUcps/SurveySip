<?php include 'db_connect.php' ?>
<?php 
$qry = $conn->query("SELECT * FROM survey_set where id = ".$_POST['id'])->fetch_array();
foreach($qry as $k => $v){
	if($k == 'title')
		$k = 'stitle';
	$$k = $v;
}
$taken = $conn->query("SELECT distinct(user_id) from answers where survey_id ={$id}")->num_rows;
if($taken == 0){
	$taken1 = 1;
}else{
	$taken1 = $taken;
}
$answers = $conn->query("SELECT a.*,q.type from answers a inner join questions q on q.id = a.question_id where a.survey_id ={$id}");
$ans = array();

while($row=$answers->fetch_assoc()){
	if($row['type'] == 'radio_opt'){
		$ans[$row['question_id']][$row['answer']][] = 1;
	}
	if($row['type'] == 'check_opt'){
		foreach(explode(",", str_replace(array("[","]"), '', $row['answer'])) as $v){
		$ans[$row['question_id']][$v][] = 1;
		}
	}
	if($row['type'] == 'textfield_s'){
		$ans[$row['question_id']][] = $row['answer'];
	}
}
?>
<style>
	.tfield-area{
		max-height: 30vh;
		overflow: auto;
	}
</style>
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
						<p>Jumlah Pengisi: <b><?php echo number_format($taken) ?></b></p>


					</div>
					<hr class="border-primary">
					<form id="answerForm" method="post" action="survey.php?page=table_list">
						<input type="hidden" name="sid" value="<?php echo $id; ?>">
						<button type="submit" class="btn btn-sm bg-gradient-primary">
							<i class="fa fa-table"></i> Tabel
						</button>
						</form>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title"><b>Survey Report</b></h3>
					<div class="card-tools">
						<button class="btn btn-flat btn-sm bg-gradient-success" type="button" id="print"><i class="fa fa-print"></i> Print</button>
					</div>
				</div>
				<div class="card-body ui-sortable">
					<?php 
					$question = $conn->query("SELECT * FROM questions where survey_id = $id order by abs(order_by) asc,abs(id) asc");
					while($row=$question->fetch_assoc()):	
					?>
					<div class="callout callout-info">
						<h5><?php echo $row['question'] ?></h5>	
						<div class="col-md-12">	
							
							<?php if($row['type'] != 'textfield_s'):?>
								<ul>
							<?php foreach(json_decode($row['frm_option']) as $k => $v): 
								$prog = ((isset($ans[$row['id']][$v]) ? count($ans[$row['id']][$v]) : 0) / $taken1) * 100;
								$prog = round($prog,2);
								?>
								<li>
									<div class="d-block w-100">
										<b><?php echo $v ?></b>
									</div>
									<div class="d-flex w-100">
									<span class=""><?php echo isset($ans[$row['id']][$v]) ? count($ans[$row['id']][$v]) : 0 ?>/<?php echo $taken ?></span>
									<div class="mx-1 col-sm-8">
									<div class="progress w-100" >
					                  <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog ?>%">
					                    <span class="sr-only"><?php echo $prog ?>%</span>
					                  </div>
					                </div>
					                </div>
					                <span class="badge badge-info"><?php echo $prog ?>%</span>
									</div>
								</li>
								<?php endforeach; ?>
								</ul>
						<?php else: ?>
							<div class="d-block tfield-area w-100 bg-dark">
								<?php if(isset($ans[$row['id']])): ?>
								<?php foreach($ans[$row['id']] as $val): ?>
								<blockquote class="text-dark"><?php echo $val ?></blockquote>
								<?php endforeach; ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						</div>	
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#manage-survey').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_answer',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp == 1){
					alert_toast("Thank You.",'success')
					setTimeout(function(){
						location.href = 'survey.php?page=survey_widget'
					},2000)
				}
			}
		})
	})
	$('#print').click(function(){
		start_load()
		var nw = window.open("print_report.php?id=<?php echo $id ?>","_blank","width=800,height=600")
			nw.print()
			setTimeout(function(){
				nw.close()
				end_load()
			},2500)
	})
</script>