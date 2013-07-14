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

//require("medoo.php");

require("include_check.php");

function checkEmail($str)
{
	return preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $str);
}


function send_mail($from,$to,$subject,$body)
{
	$headers = '';
	$headers .= "From: $from\n";
	$headers .= "Reply-to: $from\n";
	$headers .= "Return-Path: $from\n";
	$headers .= "Message-ID: <" . md5(uniqid(time())) . "@" . $_SERVER['SERVER_NAME'] . ">\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Date: " . date('r', time()) . "\n";

	mail($to,$subject,$body,$headers);
}


//Ανακατευθυνση σε διαδρομη
function redirect_to( $location = NULL ) {
	if ($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}

function check_prog_ta($user_id, $meleti_id){
	$database = new medoo(DB_NAME);
	//check για τον πινακα meleti_programma_ta
	$db_table = "meleti_programma_ta";
	$where_parameters = array("AND" => array("user_id" => $user_id,"meleti_id" => $meleti_id));
	$insert_parameters = array("user_id" => $user_id,"meleti_id" => $meleti_id);
	//$select_table = $database->select($db_table,"*",$where_parameters);
	$count_table = $database->count($db_table, $where_parameters);
	
		if ($count_table==0){
		$insert_table = $database->insert($db_table,$insert_parameters);
		}
}

function check_prog_ie($user_id, $meleti_id){
	$database = new medoo(DB_NAME);
	//check για τον πινακα meleti_programma_ta
	$db_table = "meleti_programma_ie";
	$where_parameters = array("AND" => array("user_id" => $user_id,"meleti_id" => $meleti_id));
	$insert_parameters = array("user_id" => $user_id,"meleti_id" => $meleti_id);
	//$select_table = $database->select($db_table,"*",$where_parameters);
	$count_table = $database->count($db_table, $where_parameters);
	
		if ($count_table==0){
		$insert_table = $database->insert($db_table,$insert_parameters);
		}
}

//Δημιουργία select του jtable σε format json για την επιλογή κτιρίου
function getktiria(){
	
	$user_id = $_SESSION['user_id'];
	$meleti_id = $_SESSION['meleti_id'];
	
	$database = new medoo(DB_NAME);
	$db_table = "meleti_ktiria";
	$db_columns = array ("id","name");
	$where_parameters = array("AND" => array("user_id" => $user_id,"meleti_id" => $meleti_id));
	$select_table = $database->select($db_table,$db_columns,$where_parameters);
	$count_table = $database->count($db_table, $where_parameters);
	
	$ret=array();
	//για κάθε γραμμή $ret[id]=name
	foreach($select_table as $data)
	{
	$ret[$data["id"]] =  $data["name"];
	}
	
return json_encode($ret);
}

//Δημιουργία select του jtable σε format json για την επιλογή πηγής κινδύνου
function getpigesk(){
	
	$database = new medoo(DB_NAME);
	$db_table = "library_pigeskindynoy";
	$db_columns = array ("id","name");
	$select_table = $database->select($db_table,$db_columns);
	$count_table = $database->count($db_table);
	
	$ret=array();
	//για κάθε γραμμή $ret[id]=name
	foreach($select_table as $data)
	{
	$ret[$data["id"]] =  $data["name"];
	}
	
return json_encode($ret);
}

//Δημιουργία select του jtable σε format json για την επιλογή ειδικότητας εργαζομένου
function get_eidikotitaerg(){
	
	$database = new medoo(DB_NAME);
	$db_table = "library_eidikotiteserg";
	$db_columns = array ("id","name");
	$select_table = $database->select($db_table,$db_columns);
	$count_table = $database->count($db_table);
	
	$ret=array();
	//για κάθε γραμμή $ret[id]=name
	foreach($select_table as $data)
	{
	$ret[$data["id"]] =  $data["name"];
	}
	
	$select_table1 = $database->select("user_eidikotiteserg",$db_columns,array("user_id"=>$_SESSION["user_id"]));
	foreach($select_table1 as $data1)
	{
	$ret[$count_table+$data1["id"]] =  $data1["name"];
	}
	
return json_encode($ret);
}

//Δημιουργία select της φόρμας με βάση τον πίνακα, το $id (χρησιμοποιείται ως value), το $name (χρησιμοποιείται ως τιμή του κάθε option)
function make_selectbox($pinakas,$nameofselect="",$name="name",$id="id",$classofselect="span5"){
	
	$database = new medoo(DB_NAME);
	$db_table = $pinakas;
	$db_columns = array ($id,$name);
	if($db_table=="library_industry_cat"){$db_columns = array ($id,$name,"cat");}
	$select_table = $database->select($db_table,$db_columns);
	$count_table = $database->count($db_table);
	
	$select = "
	<select id=\"".$nameofselect."\" name=\"".$nameofselect."\" class=\"".$classofselect."\">
	<option value=\"0\">Επιλέξτε...</option>";
	
	foreach($select_table as $data)
	{
		if($db_table=="library_industry_cat"){
			if($data["cat"]==1){$cat="A";}
			if($data["cat"]==2){$cat="B";}
			if($data["cat"]==3){$cat="Γ";}
		$select .= "<option value=\"".$data[$id]."\">".$data[$name]."-".$cat."</option>";
		}
		if($db_table!="library_industry_cat"){
		$select .= "<option value=\"".$data[$id]."\">".$data[$name]."</option>";
		}
	}
	$select .= "</select>";
	
	
return $select;
}

?>