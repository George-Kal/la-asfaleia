<?php
/*
Copyright (C) 2013 - Labros Asfaleia v.1.0 beta
Author: Labros Karoyntzos 

Labros Asfaleia v.1.0 beta from Labros Karountzos is free software: 
you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, version 3 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License version 3
along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.

Το παρόν με την ονομασία Labros Asfaleia v.1.0 beta με δημιουργό τον Λάμπρο Καρούντζο
στοιχεία επικοινωνίας info@chem-lab.gr www.chem-lab.gr
είναι δωρεάν λογισμικό. Μπορείτε να το τροποποιήσετε και επαναδιανείμετε υπό τους
όρους της άδειας GNU General Public License όπως δίδεται από το Free Software Foundation
στην έκδοση 3 αυτής της άδειας.
Το παρόν σχόλιο πρέπει να παραμένει ως έχει ώστε να τηρείται η παραπάνω άδεια κατά τη διανομή.
*/

//Το αρχείο δεν εκτελείται μόνο του
require("include_check.php");

//Φόρμα για διαγραφή χρήστη
if(isset($_GET['action']) AND $_GET['action']=='delete_user'){
	//Κρατάει τα λάθη.
	$err = array();

	$database = new medoo(DB_NAME);
	$user_table = "users";
	$meleti_tables = array("meletes","meleti_entypa","meleti_idioktitis","meleti_ktiria","meleti_metra","meleti_piges","meleti_programma_ie","meleti_programma_ta","meleti_proswpiko","meleti_qa","meleti_sxedio","meleti_teyxos","meleti_ypeythinos");
	$delete_parameters_user = array ("id" => $_GET["user_id"]);
	$delete_parameters_meleti = array ("user_id" => $_GET["user_id"]);
	
	//ΝΑ ΜΗΝ ΜΠΟΡΕΙ ΝΑ ΔΙΑΓΡΑΦΕΙ Ο ΔΙΑΧΕΙΡΙΣΤΗΣ
	if($_GET["user_id"]!=APPLICATION_ADMIN_ID){
		//Διαγραφή αρχείων pdf των μελετών του χρήστη
		$select_meletes = $database->select("meletes","*",array("user_id"=>$_GET['user_id']));
			foreach($select_meletes as $meletes){
			$filename = "output/ta_user".$_GET["user_id"]."-meleti".$meletes["id"]."-teyxos.pdf";
				if(file_exists($filename)){
				unlink($filename);
				}
			}	
		
		//Διαγραφή όλων των μελετών του χρήστη
		foreach($meleti_tables as $table){
		$delete_meleti = $database->delete($table,$delete_parameters_meleti);
		}
		
		//Διαγραφή χρήστη
		$delete_user = $database->delete($user_table,$delete_parameters_user);
	}else{
	$err[]='Δεν μπορείτε να διαγράψετε λογαριασμό του διαχειριστή.';
	}
	
	if($err)
	$_SESSION['msg']['admin-err'] = implode('<br />',$err);
		
	header("Location: admin.php?nav=users");
	exit;
}

//Υποβολή φόρμες για επεξεργασία χρηστών
$database = new medoo(DB_NAME);
$db_table = "users";
$db_columns = "*";
$data_users = $database->select($db_table,$db_columns);

//Όσοι οι χρήστες τόσες και οι διαθέσιμες φόρμες (κάθε φόρμα έχει submit=edit_user1,edit_user2, κλπ και μεταβλητές usr1, usr2, κλπ)
foreach($data_users as $data){
	if(isset($_POST["submit"]) AND $_POST['submit']=="edit_user".$data["id"]){
	
		$where_parameters = array("id"=>$data["id"]);
		$check_pass = $database->select($db_table,"*",$where_parameters);
		
			if($check_pass[0]["pass"]==$_POST["pass".$data["id"]]){
			$pass=$check_pass[0]["pass"];
			}else{
			$pass=md5($_POST["pass".$data["id"]]);
			}
		
		$update_parameters = array(
		"usr" => $_POST["usr".$data["id"]],
		"pass" => $pass,
		"email" => $_POST["email".$data["id"]],
		"onoma" => $_POST["onoma".$data["id"]],
		"eidikotita" => $_POST["eidikotita".$data["id"]],
		"ptyxio_years" => $_POST["ptyxio_years".$data["id"]],
		"address" => $_POST["address".$data["id"]],
		"tel" => $_POST["tel".$data["id"]],
		"taytotita" => $_POST["taytotita".$data["id"]],
		"afm" => $_POST["afm".$data["id"]]
		);
		
		$update_user = $database->update($db_table,$update_parameters,$where_parameters);
	header("Location: admin.php?nav=users");
	exit;
	}
	
}


//Φόρμα για νέο χρήστη
if(isset($_POST['submit']) AND $_POST['submit']=='create_user')
{
$database = new medoo(DB_NAME);
$db_table = "users";
$insert_parameters = array(
		"usr" => $_POST["usr"],
		"pass" => md5($_POST["pass"]),
		"email" => $_POST["email"],
		"onoma" => $_POST["onoma"],
		"eidikotita" => $_POST["eidikotita"],
		"ptyxio_years" => $_POST["ptyxio_years"],
		"address" => $_POST["address"],
		"tel" => $_POST["tel"],
		"taytotita" => $_POST["taytotita"],
		"afm" => $_POST["afm"]
		);
$insert_user = $database->insert($db_table,$insert_parameters);

header("Location: admin.php?nav=users");
exit;
}


//Υποβολή φόρμες για επεξεργασία κειμένου πηγών
$database = new medoo(DB_NAME);
$db_table = "library_pigeskindynoy";
$db_columns = "*";
$data_piges = $database->select($db_table,$db_columns);

//Όσες οι πηγές τόσες και οι διαθέσιμες φόρμες (κάθε φόρμα έχει submit=save-pigi1,save-pigi2, κλπ και μεταβλητές text_pigi1, text_pigi2, κλπ)
foreach($data_piges as $data){
	if(isset($_POST["submit"]) AND $_POST['submit']=="save-pigi".$data["id"]){
	
	$where_parameters = array("id"=>$data["id"]);
	$update_parameters = array("perigrafi" => $_POST["text_pigi".$data["id"]]);
	
	$update_piges = $database->update($db_table,$update_parameters,$where_parameters);
	
	header("Location: admin.php?nav=piges#tabs-2");
	exit;
	}
	
}

//Φόρμα για αποθήκευση πρότυπου ΤΕΥΧΟΥΣ
if(isset($_POST['submit']) AND $_POST['submit']=='save-protypo'){
	
	$database = new medoo(DB_NAME);
	$teyxos_table = "library_teyxos";
	$count_teyxos = $database->count($teyxos_table);
	
	for ($i=1; $i<=$count_teyxos; $i++){
	//χωρος για Update script από μεταβλητές $_POST["text_kef".$i]
	$update_parameters = array("text" => $_POST["text_kef".$i]);
	$where_parameters = array("kefalaio" => $i);
	$update_teyxos = $database->update($teyxos_table,$update_parameters,$where_parameters);
	}
}

//Φόρμα για αποθήκευση πρότυπων ΕΝΤΥΠΩΝ
if(isset($_POST['submit']) AND $_POST['submit']=='save-protypaentypa'){
	
	$database = new medoo(DB_NAME);
	$entypa_table = "library_entypa";
	$count_teyxos = $database->count($entypa_table);
	
	for ($i=1; $i<=$count_teyxos; $i++){
	//χωρος για Update script από μεταβλητές $_POST["text_kef".$i]
	$update_parameters = array("text" => $_POST["text_entypo".$i]);
	$where_parameters = array("type" => $i);
	$update_teyxos = $database->update($entypa_table,$update_parameters,$where_parameters);
	}
}

//Φόρμα για αποθήκευση ρυθμίσεων
if(isset($_POST['submit']) AND $_POST['submit']=='save-pref'){
	
	$database = new medoo(DB_NAME);
	$table = "preferences";	
	if(isset($_POST["registration"]) AND $_POST["registration"]==1){
	$input=1;
	}else{
	$input=0;
	}
	$update_parameters = array("registration" => $input);
	$where_parameters = array("id" => "1");
	
	$update_teyxos = $database->update($table,$update_parameters,$where_parameters);

}


?>