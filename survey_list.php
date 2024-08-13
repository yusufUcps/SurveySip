<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./survey.php?page=new_survey"><i class="fa fa-plus"></i> Add New Survey</a>
			</div>
			<div class="cek1"></div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" style="width:100%" id="list">
				<thead>
					<tr>
						<th class="text-center" data-priority="3">No</th>
						<th data-priority="2">Judul</th>
						<th>Deskripsi</th>
						<th>Mulai</th>
						<th>Berakhir</th>
						<th data-priority="1">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					if($_SESSION['login_type'] == 1) {
						$qry = $conn->query("SELECT * FROM survey_set ORDER BY id DESC");
					}else{
						$qry = $conn->query("SELECT * FROM survey_set where user_id = {$_SESSION['login_id']} ORDER BY id DESC");
					}
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['title']) ?></b></td>
						<td><b class="truncate"><?php echo $row['description'] ?></b></td>
						<td><b><?php echo date("d M, Y",strtotime($row['start_date'])) ?></b></td>
						<td><b><?php echo date("d M, Y",strtotime($row['end_date'])) ?></b></td>
						<td class="text-center">
		                    <div class="btn-group">
								<?php if($row['status_r'] == 'sedang berbagi' || $row['status_r'] == 'berhenti berbagi') {?>
									<form id="view"  action="survey.php?page=view_survey" method="POST">
									<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
									<button class="btn btn-info btn-flat" ><i class="fas fa-eye"></i></button>
									</form>
								<?php 
								}	else {
								?>
								<form id="edit"  action="survey.php?page=edit_survey" method="POST">
        						<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
								<button class="btn btn-primary btn-flat"  title="edit survey"><i class="fas fa-edit"></i></button>
								</form>
								<form id="view"  action="survey.php?page=view_survey" method="POST">
        						<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
								<button class="btn btn-info btn-flat" title="lihat survey"><i class="fas fa-eye"></i></button>
								</form>
		                        <button type="button" class="btn btn-danger btn-flat delete_survey" data-id="<?php echo $row['id'] ?>"  title="Hapus">
		                          <i class="fas fa-trash"></i>
		                        </button>
								<?php 
								}
								?>
	                      </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
			<p></p>
			<div class="cek"></div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		drawCallback: _conf
		var table = $('#list').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
		columnDefs: [
        { responsivePriority: 1, targets: 1 },
        { responsivePriority: 2, targets: 2 },
		{ responsivePriority: 3, targets: 3 }
		
    ]
    } );


	})

	$('.delete_survey').click(function(){
	_conf("jika anda menghapus survey, maka pertanyaan kuis maupun survey akan dihapus dan jawaban pada survey ini juga akan dihapus, sedangkan sisa stok poin akan dikembalikan, apakah anda yakin menghapus survey?","delete_survey",[$(this).attr('data-id')])
	})

	$('.child').click(function(){
	_conf("jika anda menghapus survey, maka pertanyaan kuis maupun survey akan dihapus dan jawaban pada survey ini juga akan dihapus, sedangkan sisa stok poin akan dikembalikan, apakah anda yakin menghapus survey?","delete_survey",[$(this).attr('data-id')])
	})

	function delete_survey($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_survey',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}else{
					alert_toast("Data Gagal Dihapus",'error')
					end_load()
				}
			}
		})
	}
</script>