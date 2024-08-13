<?php include 'db_connect.php' ?>
<?php extract($_POST);

$s = 1;
$m = 1;
$qus = array();
$usr = array(); 

$answers2 = $conn->query("SELECT distinct user_id from answers where survey_id = $sid");

while($row=$answers2->fetch_assoc()){
    $usr[$m] = $row['user_id'];
    $m++;
}

$answers = $conn->query("SELECT * FROM answers where survey_id = $sid ");
$ans = array();

while($row=$answers->fetch_assoc()){
    $ans[$row['question_id']][$row['user_id']] = $row['answer'];
}
 ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
			</div>
			<div class="cek1"></div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" style="width:100%" id="list">
				<thead>
					<tr>
                    <th class="text-center">No</th>
                    <?php 
                    $i = 1;
                    $quest = array();
                    $question = $conn->query("SELECT * FROM questions where survey_id = $sid order by abs(order_by) asc,abs(id) asc");
					while($row=$question->fetch_assoc()):
                        $qus[$s] = $row['id'];
                        $s++;
                    ?>  
                        <th><?php echo $row['question']?></th>
                    <?php endwhile;
                        ?>
					</tr>
				</thead>
				<tbody>
					<?php
                    while($i < $m){?>
                    <tr>
                        <th class="text-center"><?php echo $i ?></th>
                        <?php
                        $j=1;
                        while($j < $s){?>
                            <th><?php echo $ans[$qus[$j]][$usr[$i]]; ?></th>
                            <?php
                            $j++;
                        }
                        ?>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>  
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
		buttons: [ 'print', 'excel', 'csv','colvis' ],
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } )
	$('.buttons-pdf').detach().prependTo('.cek')
	$('.buttons-excel').detach().prependTo('.cek')
	$('.buttons-print').detach().prependTo('.cek')
	$('.buttons-colvis').detach().prependTo('.cek1')
	$('.buttons-csv').detach().prependTo('.cek')
	
	})
</script>