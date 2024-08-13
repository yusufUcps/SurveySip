<?php include 'db_connect.php' ?>
<style>
        #teks-dicopy {
            cursor: pointer;
        }
    </style>
<?php 
$qry = $conn->query("SELECT * FROM survey_set where id = ".$_POST['id'])->fetch_array();
foreach($qry as $k => $v){
	if($k == 'title')
		$k = 'stitle';
	$$k = $v;
}
$answers = $conn->query("SELECT distinct(user_id) from answers where survey_id ={$id}")->num_rows;
?>
<div class="col-lg-12">
	<div class="row">
		<div class="col-md-4">
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">Survey Details</h3>
				</div>
				<div class="card-body p-0 py-2">
					<div class="container-fluid">
						<p>Judul: <b><?php echo $stitle ?></b></p>
						<p class="mb-0">Deskripsi:</p>
						<small><?php echo $description; ?></small>
						<p>Mulai: <b><?php echo date("d M, Y ",strtotime($start_date)) ?></b></p>
						<p>Berakhir: <b><?php echo date("d M, Y ",strtotime($end_date)) ?></b></p>
						<p>Jumlah Pengisi: <b><?php echo number_format($answers) ?></b></p>
						<?php if($status_s == 'tutup'){?>	
						<p>Status : <b>Survey Sudah Ditutup</b></p>
							<?php if($status_r == 'pribadi') { ?>
								<a class="btn btn-sm btn-flat bg-gradient-primary mx-1 edit" href="javascript:void(0)" data-id="<?php echo $id ?>">Edit Survey</a>
							<?php	} else { ?>
								<p class="text-red">Anda tidak bisa mengedit survey ini kembali, karena sudah pernah membagikan repot survey ini</p>
							 <?php } ?>
						<form id="lihat"  action="survey.php?page=view_survey_report" method="POST">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<br>
						<button class="btn btn-sm btn-flat bg-gradient-primary mx-1" >Lihat Report</button>
    					</form>
						<?php
						} else if ($status_s =='mulai') { ?>
							<p>Status : <b>Survey Sudah Dimulai</b></p>
							<p>Link : <b id="teks-dicopy" class="text-green" >https://surveysip.reinshome.online/survey.php?page=detail_survey&id=<?php echo $id ?></b>
							<p>Klik link untuk menyalin</p>
						<a class="btn btn-sm btn-flat bg-gradient-primary mx-1 tutup" href="javascript:void(0)" data-id="<?php echo $id ?>">Tutup Survey</a>
						<?php
						} else { ?>
							<p>Status : <b>Survey Belum Dimulai</b></p>
						<a class="btn btn-sm btn-flat bg-gradient-primary mx-1 mulai" href="javascript:void(0)" data-id="<?php echo $id ?>">Mulai Survey</a>
						<?php
						}	
						?>
					</div>
					<hr class="border-primary">
					<div class="container-fluid">
						<p>poin yang bisa didapat: <b><?php echo number_format($poin_survey) ?></b></p>
						<p>Stok Poin: <b><?php echo number_format($stok_poin) ?></b></p>
						<a class="btn btn-sm btn-flat bg-gradient-primary mx-1 save_poin" href="javascript:void(0)" data-id="<?php echo $id ?>">Pengaturan Poin</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title"><b>Survey Kuis</b></h3>
					<div class="card-tools">
					<?php if($status_s == '' && $status_r == 'pribadi'){?>
						<button class="btn btn-block btn-sm btn-default btn-flat border-success new_kuis" type="button"><i class="fa fa-plus"></i> Tambahkah Pertanyaan </button>
					<?php } ?>
					</div>
				</div>
				<form action="" id="manage-sort_kuis">
				<div class="card-body ui-sortable_kuis">
					<?php 
					$question = $conn->query("SELECT * FROM kuis_s where survey_id = $id order by abs(order_by) asc,abs(id) asc");
					while($row=$question->fetch_assoc()):	
					?>
					<div class="callout callout-info">
						<div class="row">
							<div class="col-md-12">
							<?php if($status_s == '' && $status_r == 'pribadi'){?>
								<span class="dropleft float-right">
									<a class="fa fa-ellipsis-v text-dark" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
									<div class="dropdown-menu" style="">
								        <a class="dropdown-item edit_kuis text-dark" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit</a>
								        <div class="dropdown-divider"></div>
								        <a class="dropdown-item delete_kuis text-dark" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Hapus</a>
								     </div>
								</span>	
						<?php } ?>	
							</div>	
						</div>	
						<h5><?php echo $row['pertanyaan'] ?></h5>	
						<div class="col-md-12">
						<input type="hidden" name="qid[]" value="<?php echo $row['id'] ?>">	
							<?php
								foreach(json_decode($row['frm_option']) as $k => $v):
							?>
							<div class="icheck-primary">
		                        <input type="radio" id="option_<?php echo $k ?>" name="answer[<?php echo $row['id'] ?>]" value="<?php echo $k ?>" checked="">
		                        <label for="option_<?php echo $k ?>"><?php echo $v ?></label>
		                     </div>
								<?php endforeach; ?>
						</div>	
					</div>
					<?php endwhile; 
					?>
				</div>
				</form>
					<div class="card-body">
						<div class="card-header">
						<h3 class="card-title"><b>Minimum Skor = <?php echo $skor ?></b></h3>
						</div>
						<?php if($status_s == '' && $status_r == 'pribadi'){?>
							<a class="btn btn-sm btn-flat bg-gradient-primary mx-1 save_skor" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Tentukan Minimum Skor</a>
					<?php } ?>
					</div>
				
				
			</div>
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title"><b>Survey Questionaire</b></h3>
					<div class="card-tools">
					<?php if($status_s == '' && $status_r == 'pribadi'){?>
						<button class="btn btn-block btn-sm btn-default btn-flat border-success new_question" type="button"><i class="fa fa-plus"></i> Tambahkah Pertanyaan </button>
					<?php } ?>
					</div>
				</div>
				<?php if($status_s == '' && $status_r == 'pribadi'){?>
				<div class="card-body">
				<div class="callout callout-scondary">
						<div class="row">
							<div class="col-md-12">
								<form id="gpt" action="">
								<div class="card-header">
								<label for="" class="control-label">Deskripsi survey</label>
								</div>
								<input type="hidden" name="sid" value="<?php echo $id ?>">
								<textarea name="des" id="" cols="30" rows="4" class="form-control" placeholder="" ><?php echo $description;?></textarea>
								<button class="btn btn-block btn-sm btn-default btn-flat border-success " form="gpt">Generate</button>
							</form>
							</div>
						</div>
				</div>	
				</div>					
				<?php } ?>

				<form action="" id="manage-sort">
				<div class="card-body ui-sortable">
					<?php 
					$question = $conn->query("SELECT * FROM questions where survey_id = $id order by abs(order_by) asc,abs(id) asc");
					while($row=$question->fetch_assoc()):	
					?>
					<div class="callout callout-info">
						<div class="row">
							<div class="col-md-12">	
							<?php if($status_s == '' && $status_r == 'pribadi'){?>
								<span class="dropleft float-right">
									<a class="fa fa-ellipsis-v text-dark" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
									<div class="dropdown-menu" style="">
								        <a class="dropdown-item edit_question text-dark" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit</a>
								        <div class="dropdown-divider"></div>
								        <a class="dropdown-item delete_question text-dark" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Hapus</a>
								     </div>
								</span>	
						<?php } ?>
							</div>	
						</div>	
						<h5><?php echo $row['question'] ?></h5>	
						<div class="col-md-12">
						<input type="hidden" name="qid[]" value="<?php echo $row['id'] ?>">	
							<?php
								if($row['type'] == 'radio_opt'):
									foreach(json_decode($row['frm_option']) as $k => $v):
							?>
							<div class="icheck-primary">
		                        <input type="radio" id="option_<?php echo $k ?>" name="answer[<?php echo $row['id'] ?>]" value="<?php echo $k ?>" checked="">
		                        <label for="option_<?php echo $k ?>"><?php echo $v ?></label>
		                     </div>
								<?php endforeach; ?>
						<?php elseif($row['type'] == 'check_opt'): 
									foreach(json_decode($row['frm_option']) as $k => $v):
							?>
							<div class="icheck-primary">
		                        <input type="checkbox" id="option_<?php echo $k ?>" name="answer[<?php echo $row['id'] ?>][]" value="<?php echo $k ?>" >
		                        <label for="option_<?php echo $k ?>"><?php echo $v ?></label>
		                     </div>
								<?php endforeach; ?>
						<?php else: ?>
							<div class="form-group">
								<textarea name="answer[<?php echo $row['id'] ?>]" id="" cols="30" rows="4" class="form-control" placeholder="Tulis Sesuatu Disini.."></textarea>
							</div>
						<?php endif; ?>
						</div>	
					</div>
					<?php endwhile; ?>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	
	$(document).ready(function(){

		$('#gpt').submit(function(e){
		e.preventDefault()
		start_load()
		// $('#msg').html('')
		$.ajax({
			url:'ajax.php?action=mulai_gpt',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data Berhasil Disimpan.',"success");
					setTimeout(function(){
						location.reload()
					},1500)
				}else if(resp == 2 ){
					alert_toast('tunggu dalulu.',"success");
					end_load();
				}else{
					alert_toast('ada kesalahan.',"error");
					end_load();
				}
			}
		})
	})


		$('.ui-sortable').sortable({
			placeholder: "ui-state-highlight",
			 update: function( ) {
			 	alert_toast("Sedang menyimpan urutan.","info")
		        $.ajax({
		        	url:"ajax.php?action=action_update_qsort",
		        	method:'POST',
		        	data:$('#manage-sort').serialize(),
		        	success:function(resp){
		        		if(resp == 1){
			 				alert_toast("Urutan berhasil disimpan.","success")
		        		}else{
							alert_toast("Urutan gagal disimpan",'error')
						}
		        	}
		        })
		    }
		})

		$('.ui-sortable_kuis').sortable({
			placeholder: "ui-state-highlight",
			 update: function( ) {
			 	alert_toast("Sedang menyimpan urutan.","info")
		        $.ajax({
		        	url:"ajax.php?action=action_update_qsort_kuis",
		        	method:'POST',
		        	data:$('#manage-sort_kuis').serialize(),
		        	success:function(resp){
		        		if(resp == 1){
			 				alert_toast("Urutan berhasil disimpan.","success")
		        		}else{
							alert_toast("Urutan gagal disimpan",'error')
						}
		        	}
		        })
		    }
		})
	})



	$('.mulai').click(function(){
		uni_modal("Atur tanggal","manage_tanggal.php?id=<?php echo $id ?>")
	})

	$('.tutup').click(function(){
	_conf("Survey akan ditutup, apakah anda yakin?","tutup",[$(this).attr('data-id')])
	})

	$('.edit').click(function(){
	_conf("fungsi edit akan dibuka, tetapi jawaban pada survey ini akan dihapus, apakah anda yakin","edit",[$(this).attr('data-id')])
	})

	$('.save_skor').click(function(){
		uni_modal("Atur Skor","manage_skor.php?id=<?php echo $id ?>")
	})

	$('.save_poin').click(function(){
		uni_modal("Atur poin","manage_poin.php?id=<?php echo $id ?>")
	})

	$('.new_question').click(function(){
		uni_modal("New Question","manage_question.php?sid=<?php echo $id ?>","modal-lg")
	})
	$('.edit_question').click(function(){
		uni_modal("Edit Question","manage_question.php?sid=<?php echo $id ?>&id="+$(this).attr('data-id'),"modal-lg")
	})
	
	$('.delete_question').click(function(){
	_conf("apakah anda yakin menghapus pertanyaan ini?","delete_question",[$(this).attr('data-id')])
	})

	$('.new_kuis').click(function(){
		uni_modal("New Kuis","manage_kuis.php?sid=<?php echo $id ?>","modal-lg")
	})
	$('.edit_kuis').click(function(){
		uni_modal("Edit Kuis","manage_kuis.php?sid=<?php echo $id ?>&id="+$(this).attr('data-id'),"modal-lg")
	})
	
	$('.delete_kuis').click(function(){
	_conf("apakah anda yakin menghapus pertanyaan ini?","delete_kuis",[$(this).attr('data-id')])
	})

	function delete_question($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_question',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data berhasil dihapus",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}else{
					alert_toast("Data gagal dihapus",'error')
					end_load()
				}
			}
		})
	}

	function delete_kuis($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_kuis',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data berhasil dihapus",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}else{
					alert_toast("Data gagal dihapus",'error')
					end_load()
				}
			}
		})
		
	}

	

	function tutup($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=tutup_survey',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Survey berhasil ditutup",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}else{
					alert_toast("Survey gagal ditutup",'error')
					end_load()
				}
			}
		})
		
	}

	function edit($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=bisa_edit_survey',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Survey bisa diedit kembali",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}else{
					alert_toast("Gagal membuka edit",'error')
					end_load()
				}
			}
		})
		
	}

	function copyTextToClipboard() {
    var teks = document.createElement("textarea");
    teks.value = document.getElementById("teks-dicopy").innerText;
    document.body.appendChild(teks);
    teks.select();
    document.execCommand("copy");
    document.body.removeChild(teks);
    alert_toast("Link Berhasil disalin", "success");
}
	document.getElementById("teks-dicopy").addEventListener("click", copyTextToClipboard);
</script>