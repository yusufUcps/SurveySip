<?php include 'db_connect.php' ?>
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
						<th class="text-center">No</th>
						<th>survey_id</th>
						<th>Judul Survey</th>
						<th>Poin Bertambah</th>
						<th>Poin Berkurang</th>
                        <th>Keterangan</th>
						<th>Tanggal</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * FROM riwayat where user_id = {$_SESSION['login_id']} order by tanggal desc");
					while ($row = $qry->fetch_assoc()):
						?>
						<tr>
							<th class="text-center"><?php echo $i++ ?></th>
							<td><b><?php echo $row['survey_id'] ?></b></td>
							<td><b><?php echo ucwords($row['judul']) ?></b></td>
							<td><b class="text-success"><?php echo $row['poin_tambah'] ?></b></td>
							<td><b class="text-danger"><?php echo $row['poin_kurang'] ?></b></td>
							<td><b><?php echo ucwords($row['keterangan']) ?></b></td>
							<td><b><?php echo date('Y-m-d H:i:s', strtotime($row['tanggal'])) ?></b></td>
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
		dom: 'B<"clear">lfrtip',
		buttons: [ 'print','colvis' ],
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
	$('.buttons-pdf').detach().prependTo('.cek')
	$('.buttons-print').detach().prependTo('.cek')
	$('.buttons-colvis').detach().prependTo('.cek1')
	})
</script>