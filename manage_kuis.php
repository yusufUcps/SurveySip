<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM kuis_s where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
}
?>
<div class="container-fluid">
	<form action="" id="manage-kuis">
	<div id="msg"></div>
		<div class="col-lg-12">
			<div class="row">
				<div class="col-sm-6 border-right">
						<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
						<input type="hidden" name="sid" value="<?php echo isset($_GET['sid']) ? $_GET['sid'] : '' ?>">
						<div class="form-group">
							<label for="" class="control-label">Pertanyaan</label>
							<textarea name="pertanyaan" id="" cols="30" rows="4" class="form-control"><?php echo isset($pertanyaan)? $pertanyaan: '' ?></textarea>
						</div>
						<div class="form-group">
							<label for="" class="control-label">Jawaban</label>
							<textarea name="jawaban" id="" cols="30" rows="1" class="form-control"><?php echo isset($jawaban)? $jawaban: '' ?></textarea>
						</div>
                        
						
				</div>
				<div class="col-sm-6">
					<b>Pilihan Jawaban</b>
					<div class="preview">
                        
						<?php if(!isset($id)): ?>
                            <div id="radio_opt_clone">
                            <div class="callout callout-info">
                            <table width="100%" class="table">
                                <colgroup>
                                    <col width="10%">
                                    <col width="80%">
                                    <col width="10%">
                                </colgroup>
                                <thead>
                                    <tr class="">
                                        <th class="text-center"></th>

                                        <th class="text-center">
                                            <label for="" class="control-label">Label</label>
                                        </th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        <td class="text-center">
                                            <div class="icheck-primary d-inline" data-count = '1'>
                                                <input type="radio" id="radioPrimary1" name="radio" checked="">
                                                <label for="radioPrimary1">
                                                </label>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <input type="text" class="form-control form-control-sm check_inp"  name="label[]">
                                        </td>
                                        <td class="text-center"></td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-center">
                                            <div class="icheck-primary d-inline" data-count = '2'>
                                                <input type="radio" id="radioPrimary2" name="radio" >
                                                <label for="radioPrimary2">
                                                </label>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <input type="text" class="form-control form-control-sm check_inp"  name="label[]">
                                        </td>
                                        <td class="text-center"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                            <div class="col-sm-12 text-center">
                                <button class="btn btn-sm btn-flat btn-default" type="button" onclick="new_radio($(this))"><i class="fa fa-plus"></i> Add</button>
                            </div>
                            </div>
                            </div>
                        </div>
						<?php else: ?>
							<div class="callout callout-info">
							<?php 
								$opt= 'radio';
							?>
						      <table width="100%" class="table">
						      	<colgroup>
						      		<col width="10%">
						      		<col width="80%">
						      		<col width="10%">
						      	</colgroup>
						      	<thead>
							      	<tr class="">
								      	<th class="text-center"></th>

								      	<th class="text-center">
								      		<label for="" class="control-label">Label</label>
								      	</th>
								      	<th class="text-center"></th>
							     	</tr>
						     	</thead>
						     	<tbody>
						     		<?php  
						     		$i = 0;
						     		foreach(json_decode($frm_option) as $k => $v):
						     			$i++;
						     		?>
						     		<tr class="">
								      	<td class="text-center">
								      		<div class="icheck-primary d-inline" data-count = '<?php echo $i ?>'>
									        	<input type="<?php echo $opt ?>" id="<?php echo $opt ?>Primary<?php echo $i ?>" name="<?php echo $opt ?>" checked="">
									        	<label for="<?php echo $opt ?>Primary<?php echo $i ?>">
									        	</label>
									        </div>
								      	</td>

								      	<td class="text-center">
								      		<input type="text" class="form-control form-control-sm check_inp"  name="label[<?php echo $i ?>]" value="<?php echo $v ?>">
								      	</td>
								      	<td class="text-center"></td>
							     	</tr>
						     		<?php  endforeach; ?>

						     	</tbody>
						      </table>
						      <div class="row">
						      <div class="col-sm-12 text-center">
						      	<button class="btn btn-sm btn-flat btn-default" type="button" onclick="new_radio($(this))"><i class="fa fa-plus"></i> Add</button>
						      </div>
						      </div>
						    </div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>



<script>
	function new_radio(_this){
		var tbody=_this.closest('.row').siblings('table').find('tbody')
		var count = tbody.find('tr').last().find('.icheck-primary').attr('data-count')
			count++;
		console.log(count)
		var opt = '';
			opt +='<td class="text-center pt-1"><div class="icheck-primary d-inline" data-count = "'+count+'"><input type="radio" id="radioPrimary'+count+'" name="radio"><label for="radioPrimary'+count+'"> </label></div></td>';
			opt +='<td class="text-center"><input type="text" class="form-control form-control-sm check_inp" name="label[]"></td>';
			opt +='<td class="text-center"><a href="javascript:void(0)" onclick="$(this).closest(\'tr\').remove()"><span class="fa fa-times" ></span></a></td>';
		var tr = $('<tr></tr>')
		tr.append(opt)
		tbody.append(tr)
	}
    function radio_opt(){
		var radio_opt_clone = $('#radio_opt_clone').clone()
		$('.preview').html(radio_opt_clone.html())
	}
	$('[name="type"]').change(function(){
		window[$(this).val()]()
	})
	$(function () {
  $('#manage-kuis').submit(function(e){
    e.preventDefault();

    start_load();

    $.ajax({
      url: 'ajax.php?action=save_kuis',
      data: new FormData($(this)[0]),
      cache: false,
      contentType: false,
      processData: false,
      method: 'POST',
      type: 'POST',
      success:function(resp){
        if(resp == 1){
          alert_toast('Data Behasil Disimpan.', "success");
          setTimeout(function(){
            location.reload();
          }, 1500);
        } else{
          alert_toast('Gagal Menyimpan Data', "error");
          end_load();
        }
      }
    });
  });
});

</script>