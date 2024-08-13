<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'save_page_img'){
	$save = $crud->save_page_img();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == "save_survey"){
	$save = $crud->save_survey();
	if($save)
		echo $save;
}
if($action == "delete_survey"){
	$delete = $crud->delete_survey();
	if($delete)
		echo $delete;
}
if($action == "save_question"){
	$save = $crud->save_question();
	if($save)
		echo $save;
}
if($action == "delete_question"){
	$delsete = $crud->delete_question();
	if($delsete)
		echo $delsete;
}

if($action == "action_update_qsort"){
	$save = $crud->action_update_qsort();
	if($save)
		echo $save;
}
if($action == "save_answer"){
	$save = $crud->save_answer();
	if($save)
		echo $save;
}
if($action == "update_user"){
	$save = $crud->update_user();
	if($save)
		echo $save;
}
if($action == "save_kuis"){
	$save = $crud->save_kuis();
	if($save)
		echo $save;
}
if($action == "delete_kuis"){
	$delsete = $crud->delete_kuis();
	if($delsete)
		echo $delsete;
}

if($action == "action_update_qsort_kuis"){
	$save = $crud->action_update_qsort_kuis();
	if($save)
		echo $save;
}

if($action == "save_skor"){
	$save = $crud->save_skor();
	if($save)
		echo $save;
}

if($action == "save_poin"){
	$save = $crud->save_poin();
	if($save)
		echo $save;
}

if($action == "save_blokir"){
	$save = $crud->save_blokir();
	if($save)
		echo $save;
}

if($action == "cek_kuis"){
	$save = $crud->cek_kuis();
	if($save)
		echo $save;
}

if($action == "ambil_report"){
	$save = $crud->ambil_report();
	if($save)
		echo $save;
}

if($action == "atur_report"){
	$save = $crud->atur_report();
	if($save)
		echo $save;
}


if($action == "atur_status"){
	$save = $crud->atur_status();
	if($save)
		echo $save;
}

if($action == "atur_status1"){
	$save = $crud->atur_status1();
	if($save)
		echo $save;
}

if($action == "mulai_gpt"){
	$save = $crud->mulai_gpt();
	if($save)
		echo $save;
}

if($action == "mulai_survey"){
	$save = $crud->mulai_survey();
	if($save)
		echo $save;
}

if($action == "tutup_survey"){
	$save = $crud->tutup_survey();
	if($save)
		echo $save;
}

if($action == "bisa_edit_survey"){
	$save = $crud->bisa_edit_survey();
	if($save)
		echo $save;
}

if($action == "tambah_poin"){
	$save = $crud->tambah_poin();
	if($save)
		echo $save;
}

ob_end_flush();
?>
