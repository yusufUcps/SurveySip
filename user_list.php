<?php include'db_connect.php' ?>
<style>

</style>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./survey.php?page=new_user"><i class="fa fa-plus"></i> Add New User</a>
			</div>
			<div class="cek1"></div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" style="width:100%" id="list">
				<thead>
					<tr>
						<th class="text-center" data-priority="3">No</th>
						<th data-priority="2">Nama</th>
						<th>Peran</th>
						<th>Email</th>
						<th data-priority="1">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$type = array('',"Admin","Staff","Member");
					$qry = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users ORDER BY id DESC");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td><b><?php echo $type[$row['type']] ?></b></td>
						<td><b><?php echo $row['email'] ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Aksi
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Lihat</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./survey.php?page=edit_user&id=<?php echo $row['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Hapus</a>
							  <div class="dropdown-divider"></div>
		                      <a class="dropdown-item tambah_poin" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Poin</a>
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
	$('.view_user').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> User Details","view_user.php?id="+$(this).attr('data-id'))
	})
	$('.delete_user').click(function(){
	_conf("apakah anda yaking menghapus pengguna ini?","delete_user",[$(this).attr('data-id')])
	})
	$('.tambah_poin').click(function(){
		uni_modal("Tambah Poin","tambah_poin.php?id="+$(this).attr('data-id'))
	})
	function delete_user($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_user',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data Berhasil Dihapus",'success')
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