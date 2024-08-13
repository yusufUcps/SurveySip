                            <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Aksi
		                    </button>
		                    <div class="dropdown-menu" style="">
                            <div class="btn-group">
								<?php if($row['status_r'] == 'sedang berbagi' || $row['status_r'] == 'berhenti berbagi') {?>
									<form id="view"  action="survey.php?page=view_survey" method="POST">
									<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
									<button class="btn btn-info btn-flat dropdown-item" ><i class="fas fa-eye"></i></button>
									</form>
								<?php 
								}	else {
								?>
								<form id="edit"  action="survey.php?page=edit_survey" method="POST">
        						<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
								<button class="btn btn-primary btn-flat dropdown-item"  title="edit survey"><i class="fas fa-edit"></i></button>
								</form>
								<form id="view"  action="survey.php?page=view_survey" method="POST">
        						<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
								<button class="btn btn-info btn-flat dropdown-item" title="lihat survey"><i class="fas fa-eye"></i></button>
								</form>
		                        <button type="button dropdown-item" class="btn btn-danger btn-flat delete_survey" data-id="<?php echo $row['id'] ?>"  title="Hapus">
		                          <i class="fas fa-trash"></i>
		                        </button>
								<?php 
								}
								?>
	                        </div>
		                    </div>

                            <?php if($row['status_r'] == 'sedang berbagi' || $row['status_r'] == 'berhenti berbagi') {?>
									<form id="view"  action="survey.php?page=view_survey" method="POST">
									<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
									<a class="dropdown-item" ><i class="fas fa-eye"></i>lihat</a>
									</form>
								<?php 
								}	else {
								?>
								<form id="edit"  action="survey.php?page=edit_survey" method="POST">
        						<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
								<a class="dropdown-item"  title="edit survey">edit</i></a>
								</form>
								<form id="view"  action="survey.php?page=view_survey" method="POST">
        						<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
								<a class="dropdown-item" ><i class="fas fa-eye"></i>lihat</a>
								</form>
		                        <a class="dropdown-item delete_survey" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"  title="Hapus">
		                          hapus
                                </a>
								<?php 
								}
								?>