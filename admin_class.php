<?php
require __DIR__.'/vendor/autoload.php';
use Orhanerday\OpenAi\OpenAi;
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where email = '".$email."' and password = '".md5($password)."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}

	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}

	function save_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			 if(!in_array($k, array('id','cpass')) && !is_numeric($k)){
				if($k =='password'){
					$v = md5($v);
				}
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$data .= ", poin_user = 1000";
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			return 1;
		}else{
			return 3;
		}
	}
	function update_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','table')) && !is_numeric($k)){
				if($k =='password')
					$v = md5($v);
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			foreach ($_POST as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			return 1;
		}else{
			return 3;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete){
			return 1;
		}
	}

	function save_survey(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
				
			}
		}
		
		if(empty($id)){
			$data .= ", user_id='{$_SESSION['login_id']}' ";
			$data .= ", skor = 0 ";
			$data .= ", poin_survey = 0 ";
			$data .= ", stok_poin = 0 ";
			$data .= ", poin_r = 0 ";
			$data .= ", status_r = 'pribadi' ";
			$data .= ", status_s = '' ";
			$save = $this->db->query("INSERT INTO survey_set set $data");
		}else{
			$save = $this->db->query("UPDATE survey_set set $data where id = $id");
		}

		if($save){
			return 1;
		}else{
			return 2;
		}
	}
	function delete_survey(){
		extract($_POST);
		$user = $this->db->query("SELECT poin_user FROM users where id = '{$_SESSION['login_id']}'");
		$row_user = $user->fetch_assoc();
		$poin_u= $row_user['poin_user'];

		$poin_result = $this->db->query("SELECT stok_poin,title FROM survey_set where id = $id");
		$poin_row = $poin_result->fetch_assoc();
		$poin_s = $poin_row['stok_poin'];
		$judul = $poin_row['title'];

		$data1 = " user_id = '{$_SESSION['login_id']}'";
		$data1 .= ", survey_id = $id ";
		$data1 .= ", judul = '$judul' ";
		$data1 .= ", keterangan = 'Poin sisa menghapus survey' ";
		$data1 .= ", poin_tambah = $poin_s";
		$data1 .= ", poin_kurang = 0 ";
		$save2 = $this->db->query("INSERT INTO riwayat set $data1");		

		$poin_us = $poin_u + $poin_s;

		$data_u = " poin_user = $poin_us";
		$save1 = $this->db->query("UPDATE users set $data_u where id = '{$_SESSION['login_id']}'");

		$delete = $this->db->query("DELETE FROM kuis_s where survey_id = ".$id);
		$delete1 = $this->db->query("DELETE FROM questions where survey_id = ".$id);
		$delete2 = $this->db->query("DELETE FROM survey_set where id = ".$id);
		if($delete && $delete1 && $delete2 && $save1 && $save2){
			return 1;
		}else{
			return 2;
		}
	}
	
	function save_question(){
		extract($_POST);
			$data = " survey_id=$sid ";
			$data .= ", question='$question' ";
			$data .= ", type='$type' ";
			$data .= ", order_by=0 ";
			if($type != 'textfield_s'){
				$arr = array();
				foreach ($label as $k => $v) {
					$i = 0 ;
					while($i == 0){
						$k = substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
						if(!isset($arr[$k]))
							$i = 1;
					}
					$arr[$k] = $v;
				}
			$data .= ", frm_option='".json_encode($arr)."' ";
			}else{
			$data .= ", frm_option='' ";
			}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO questions set $data");
		}else{
			$save = $this->db->query("UPDATE questions set $data where id = $id");
		}

		if($save){
			return 1;
		}else{
			return 2;
		}	
	}
	function delete_question(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM questions where id = ".$id);
		if($delete){
			return 1;
		}else{
			return 2;
		}
	}
	function action_update_qsort(){
		extract($_POST);
		$i = 0;
		foreach($qid as $k => $v){
			$i++;
			$update[] = $this->db->query("UPDATE questions set order_by = $i where id = $v");
		}
		if(isset($update)){
			return 1;
		}else{
			return 2;
		}
	}
	function save_answer(){
		extract($_POST);
		$blok = $this->db->query("SELECT id from answers where survey_id = $survey_id and user_id ={$_SESSION['login_id']}")->num_rows;
		if($blok >= 1){
			return 2;
			exit;
		}else{
			$poin_result1 = $this->db->query("SELECT * FROM survey_set where id = $survey_id");
			if($poin_result1->num_rows > 0){
				foreach($qid as $k => $v){
					$data = " survey_id=$survey_id ";
					$data .= ", question_id='$qid[$k]' ";
					$data .= ", user_id='{$_SESSION['login_id']}' ";
					if($type[$k] == 'check_opt'){
						$data .= ", answer='[".implode("],[",$answer[$k])."]' ";
					}else{
						$data .= ", answer='$answer[$k]' ";
					}
					$save[] = $this->db->query("INSERT INTO answers set $data");
				}
	
				$poin_row1 = $poin_result1->fetch_assoc();
				$s_poin = $poin_row1['stok_poin'];
				$poin = $poin_row1['poin_survey'];
				$judul = $poin_row1['title'];
				
				$data1 = " user_id='{$_SESSION['login_id']}'";
				$data1 .= ", survey_id = $survey_id ";
				$data1 .= ", judul = '$judul' ";
				$data1 .= ", keterangan = 'Menjawab Survey' ";
				$data1 .= ", poin_tambah = $poin ";
				$data1 .= ", poin_kurang = 0 ";
				$save1 = $this->db->query("INSERT INTO riwayat set $data1");
	
				$poin_h = $s_poin - $poin;
				if($poin_h < $poin){
					$data2 = " poin_survey = $poin_h";
					$data2 .= ", stok_poin = $poin_h";
				}else{
					$data2 = " stok_poin = $poin_h";
				}
				$save2 = $this->db->query("UPDATE survey_set set $data2 where id = $survey_id");
	
				$poin_result = $this->db->query("SELECT poin_user FROM users where id = '{$_SESSION['login_id']}'");
				$poin_row = $poin_result->fetch_assoc();
				$poin_u = $poin_row['poin_user'];
	
				$poin_hsl = $poin_u + $poin;
				$poin_user1 = " poin_user = $poin_hsl";
				$save3 = $this->db->query("UPDATE users set $poin_user1 where id = '{$_SESSION['login_id']}'");
	
			
				if($save&&$save1&&$save2&&$save3){
					return 1;
				}else{
					$delete = $this->db->query("DELETE FROM answers WHERE user_id = ".$_SESSION['login_id']." AND survey_id = ".$survey_id);
					if($delete){
						return 3;
					}
				}

			}else{
				return 2;
			}

		}
			
	}


	function save_kuis(){
		extract($_POST);
			$data = " survey_id=$sid ";
			$data .= ", pertanyaan='$pertanyaan' ";
			$data .= ", jawaban='$jawaban' ";
			$data .= ", order_by=0 ";
				$arr = array();
				foreach ($label as $k => $v) {
					$i = 0 ;
					while($i == 0){
						$k = substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
						if(!isset($arr[$k]))
							$i = 1;
					}
					$arr[$k] = $v;
				}
			$data .= ", frm_option='".json_encode($arr)."' ";
		if(empty($id)){

			$save = $this->db->query("INSERT INTO kuis_s set $data");
		}else{
			$save = $this->db->query("UPDATE kuis_s set $data where id = $id");
		}

		if($save){
			return 1;
		}else{
			return 2;
		}
	}
	function delete_kuis(){
		extract($_POST);
		$kuis = $this->db->query("SELECT * FROM kuis_s where id = $id");
		$row = $kuis->fetch_assoc();
		$sid = $row['survey_id'];

		$skor_result = $this->db->query("SELECT skor FROM survey_set where id = $sid");
		$skor_row = $skor_result->fetch_assoc();
		$skor = $skor_row['skor'];
		
		$delete = $this->db->query("DELETE FROM kuis_s where id = ".$id);

		$soal = $this->db->query("SELECT pertanyaan from kuis_s where survey_id = $sid" )->num_rows;
		if ($skor>$soal){
			$skor = $skor - 1;
			$data = " skor=$skor";
			$save = $this->db->query("UPDATE survey_set set $data where id = $sid");	
			if($delete && $save){
				return 1;
			}
		}else{
			if($delete){
				return 1;
			}
		}
	}
	function action_update_qsort_kuis(){
		extract($_POST);
		$i = 0;
		foreach($qid as $k => $v){
			$i++;
			$update[] = $this->db->query("UPDATE kuis_s set order_by = $i where id = $v");
		}
		if(isset($update)){
			return 1;
		}else{
			return 2;
		}
	}

	function save_skor(){
		extract($_POST);
		$data = "skor=$skor";
		$save = $this->db->query("UPDATE survey_set set $data where id = $id");
		if($save){
			return 1;
		}else{
			return 2;
		}
	}

	function save_poin(){
		extract($_POST);

		$user = $this->db->query("SELECT poin_user FROM users where id = $uid");
		$row_user = $user->fetch_assoc();
		$poin_u= $row_user['poin_user'];

		$poin_result = $this->db->query("SELECT stok_poin,title FROM survey_set where id = $sid");
		$poin_row = $poin_result->fetch_assoc();
		$poin_s = $poin_row['stok_poin'];
		$judul = $poin_row['title'];

		if($poin > $stok_poin ){
			$poin = $stok_poin;
		}

		$data1 = " user_id = $uid";
		$data1 .= ", survey_id = $sid ";
		$data1 .= ", judul = '$judul' ";
		$data1 .= ", keterangan = 'Mengisi poin survey' ";
		$data1 .= ", poin_tambah = $poin_s";
		$data1 .= ", poin_kurang = $stok_poin";
		$save2 = $this->db->query("INSERT INTO riwayat set $data1");		

		$poin_us = $poin_u - $stok_poin + $poin_s;

		if ($poin_us < 0){
			$poin_us = 0;
		}
		$data_u = " poin_user = $poin_us";
		$save1 = $this->db->query("UPDATE users set $data_u where id = $uid");

		$data = " poin_survey=$poin";
		$data .= ", stok_poin=$stok_poin";
		$save = $this->db->query("UPDATE survey_set set $data where id = $sid");
		if($save && $save1 && $save2){
			return 1;
		}else{
			return 2;
		}
	}


	function cek_kuis(){
		extract($_POST);
		$blok = $this->db->query ("SELECT id from daftar_blokir where survey_id = $survey_id and user_id ={$_SESSION['login_id']}")->num_rows;
		if($blok >= 1){
			return 2;
			exit;
		}else{
			$skor_result = $this->db->query("SELECT * FROM survey_set where id = $survey_id");
			if($skor_result->num_rows > 0){
				$skor_row = $skor_result->fetch_assoc();
				$skor = $skor_row['skor'];

				$qry = $this->db->query("SELECT id, jawaban FROM kuis_s where survey_id = $survey_id order by abs(order_by) asc,abs(id) asc");
				while($row=$qry->fetch_assoc()):
					$jawaban[$row['id']]=$row['jawaban'];
				endwhile;
				$score=0;
				foreach($qid as $k => $v){
					if ($answer[$k] == $jawaban[$k]) {
						$score++; // Tambahkan skor jika jawaban benar
					}
				}
				if ($score >= $skor) {
					return 1;
				}else {
					$data = " user_id = '{$_SESSION['login_id']}' ";
					$data .= ", survey_id = $survey_id ";
					$save = $this->db->query("INSERT INTO daftar_blokir set $data");
					if($save){
						return 2;  
					}else{
						return 3;
					}
				}

			} else {
				return 2;
			}
		}

	}

	
	function ambil_report(){
		extract($_POST);

		$poin_result1 = $this->db->query("SELECT * FROM survey_set where id = $sid");
		$poin_row1 = $poin_result1->fetch_assoc();
		$poin_r = $poin_row1['poin_r'];
		$judul = $poin_row1['title'];

		$poin_result2 = $this->db->query("SELECT poin_user FROM users where id = '{$_SESSION['login_id']}'");
		$poin_row2 = $poin_result2->fetch_assoc();
		$poin_u= $poin_row2['poin_user'];	

		$poin_result3 = $this->db->query("SELECT poin_user FROM users where id = $uid");
		$poin_row3 = $poin_result3->fetch_assoc();
		$poin_p= $poin_row3['poin_user'];	
			
		$poin1 = $poin_u - $poin_r;

		if ($poin1 < 0) {
			return 2;
		}

		$poin2 = $poin_p + $poin_r;
		

		$data1 = " user_id='{$_SESSION['login_id']}'";
		$data1 .= ", survey_id = $sid ";
		$data1 .= ", judul = '$judul' ";
		$data1 .= ", keterangan = 'Mengambil report survey' ";
		$data1 .= ", poin_tambah = 0 ";
		$data1 .= ", poin_kurang = $poin_r ";
		$save1 = $this->db->query("INSERT INTO riwayat set $data1");

		$update1= " poin_user = $poin1 ";
		$save2 = $this->db->query("UPDATE users set $update1 where id = '{$_SESSION['login_id']}' ");

		$data2 = " user_id = $uid";
		$data2 .= ", survey_id = $sid ";
		$data2 .= ", judul = '$judul' ";
		$data2 .= ", keterangan = 'Menerima poin survey report' ";
		$data2 .= ", poin_tambah = $poin_r ";
		$data2 .= ", poin_kurang = 0 ";
		$save3 = $this->db->query("INSERT INTO riwayat set $data2");

		$update2= "poin_user = $poin2";
		$save4 = $this->db->query("UPDATE users set $update2 where id = $uid ");

		if($save1&&$save2&&$save3&&$save4){
			return 1;
		}else{
			return 2;
		}
	}

	function atur_report(){
		extract($_POST);
		$data = " poin_r = $poin_r";
		$save = $this->db->query("UPDATE survey_set set $data where id = $id");
		if($save){
			return 1;
		}else{
			return 2;
		}
	}

	function atur_status(){
		extract($_POST);
		$data = " status_r = 'sedang berbagi'";
		$save = $this->db->query("UPDATE survey_set set $data where id = $id");
		if($save){
			return 1;
		}else{
			return 2;
		}
	}

	function atur_status1(){
		extract($_POST);
		$data = " status_r = 'berhenti berbagi'";
		$save = $this->db->query("UPDATE survey_set set $data where id = $id");
		if($save){
			return 1;
		}else{
			return 2;
		}
	}

	function mulai_gpt(){
		extract($_POST);

		$key ="";

		$open_ai_key = $key;

		$open_ai = new OpenAi($open_ai_key);

		$prompt = " survey_id = $sid ";
		$prompt .= ", deskripsi ".$des;

		$isi = "INSERT INTO questions (question, frm_option, type, order_by, survey_id) VALUES ";
		$isi .= "('berapa umur anda?', '{\"fQCrP\":\"3\",\"SDIEo\":\"44\"}', 'radio_opt', 0, 7), ";
		$isi .= "('siapa nama anda?', '', 'textfield_s', 0, 7),";
		$isi .= "('berapa anak anda?', '{\"fQC1P\":\"3\",\"Si3Eo\":\"2\"}', 'check_opt', 0, 7), ";

		$complete = $open_ai->completion([
			'model' => 'gpt-3.5-turbo-instruct',
			'prompt' => 'buatkan query sebanyak 10 disatukan menjadi 1 query dengan output hanya query sql tanpa tambahan yang lain tanpa penomoran agar sekaligus dapat langsung dimasukan kedalam sql contoh sebagai berikut, '.$isi.' untuk type ada 3 jenis yaitu radio_opt untuk radio button yaitu hanya bisa memilih salah satu pilihan daari banyak pilihan, textfield yaitu text area untuk menulis jawaban dengan text, kemudian check_opt yaitu check box untuk bisa memilih banyak pilihan, frm_option berisi label 5 digit kode random yang mengandung isi dari pilihan, label tersebut tidak boleh sama dengan pilihan yang lain baik di pertanyaan itu maupun pertanyaan yang lain, jadi seluruh pilihan dari seluruh pertanyann memiliki label unik, dan order_by selalu 0 dengan deskripsi sebagai berikut :  '. $prompt.'yang dikirim hanya kode sql tanpa penjelasan yang lain',
			'temperature' => 0.9,
			'max_tokens' => 1000,
			'frequency_penalty' => 0,
			'presence_penalty' => 0.6,
			'stop' => ['\n']  // Add this line to stop the completion at the first line break
		]);

		$response = json_decode($complete, true);
		if (isset($response['choices'][0]['text'])) {
			$responseText = $response['choices'][0]['text'];
			$save = $this->db->query("$responseText");
			if($save){
				return 1;
			}else{
				return 3;
			}
		} elseif (isset($response['error'])) {
			return 2;
		} else {
			return 3;
		}
	}



	function mulai_survey(){
		extract($_POST);

		$data = " status_s = 'mulai' ";
		$data .= ", start_date = '$start_date' ";
		$data .= ", end_date = '$end_date' ";
		$save = $this->db->query("UPDATE survey_set set $data where id = $id");
		if($save){
			return 1;
		}else{
			return 2;
		}
	}

	function tutup_survey(){
		extract($_POST);
		$data = " status_s = 'tutup' ";
		$save = $this->db->query("UPDATE survey_set set $data where id = $id");
		if($save){
			return 1;
		}else{
			return 2;
		}
	}

	function bisa_edit_survey(){
		extract($_POST);
		$data = " status_s = '' ";
		$save = $this->db->query("UPDATE survey_set set $data where id = $id");
		$delete = $this->db->query("DELETE FROM answers where survey_id = ".$id);
		if($save && $delete){
			return 1;
		}else{
			return 2;
		}
	}

	function tambah_poin(){
		extract($_POST);
		$poin_result3 = $this->db->query("SELECT poin_user FROM users where id = $id");
		$poin_row3 = $poin_result3->fetch_assoc();
		$poin_p= $poin_row3['poin_user'];

		$poin_h= $poin_p + $poin_tam;

		$data = " poin_user = $poin_h ";
		$save = $this->db->query("UPDATE users set $data where id = $id");

		$data1 = " user_id= $id";
		$data1 .= ", survey_id = 0 ";
		$data1 .= ", judul = 'admin' ";
		$data1 .= ", keterangan = '$ket' ";

		if ($poin_tam > 0){
			$data1 .= ", poin_tambah = $poin_tam ";
			$data1 .= ", poin_kurang = 0 ";
		}

		if ($poin_tam < 0){
			$data1 .= ", poin_tambah = 0 ";
			$data1 .= ", poin_kurang = $poin_tam ";
		}
		$save1 = $this->db->query("INSERT INTO riwayat set $data1");

		if($save && $save1){
			return 1;
		}elseif($save && $save1 && $poin_tam < 0){
			return 2;
		}
		else{
			return 3;
		}
	}
}