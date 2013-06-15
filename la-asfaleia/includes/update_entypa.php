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
?>

<?php

//Το αρχείο δεν εκτελείται μόνο του
require("include_check.php");

$upentypa = new medoo(DB_NAME);

$z = array();
$z1 = array();

//Οι θέσεις αντικατάστασης
$z[0]="{ENTYPA_ONOMA}";
$z[1]="{ENTYPA_AFM}";
$z[2]="{ENTYPA_DOY}";
$z[3]="{ENTYPA_ADDRESS}";
$z[4]="{ENTYPA_TEL}";
$z[5]="{ENTYPA_DRASTIRIOTITA}";
$z[6]="{ENTYPA_YP_ONOMA}";
$z[7]="{ENTYPA_YP_PAT}";
$z[8]="{ENTYPA_YP_MIT}";
$z[9]="{ENTYPA_YP_ADDRESS}";
$z[10]="{ENTYPA_YP_ADT}";
$z[11]="{ENTYPA_YP_AFM}";
$z[12]="{ENTYPA_YP_TEL}";
$z[13]="{ENTYPA_TAAFM}";
$z[14]="{ENTYPA_TAONOMA}";
$z[15]="{ENTYPA_TAADT}";
$z[16]="{ENTYPA_TAADDRESS}";
$z[17]="{ENTYPA_TAEIDIKOTITA}";

$z[18]="{ENTYPA_TAWRES}";
$z[19]="{ENTYPA_TAWRES_OTHER}";
$z[20]="{ENTYPA_TAPROGRAM}";
$z[21]="{ENTYPA_TAEND}";
$z[22]="{ENTYPA_TASTART}";
$z[23]="{ENTYPA_ERG}";
$z[24]="{ENTYPA_ERGMALE}";
$z[25]="{ENTYPA_ERGFEMALE}";
$z[26]="{ENTYPA_ERG18}";
$z[27]="{ENTYPA_ERGDIOIK}";
$z[28]="{ENTYPA_ERGTEXN}";
$z[29]="{ENTYPA_ENTYPO2TABLE}";



//επιλογή στοιχείων μελέτης
$tb_meletes = "meletes";
$tb_user = "users";
$tb_idioktitis = "meleti_idioktitis";
$tb_prog_ta = "meleti_programma_ta";
$tb_proswpiko = "meleti_proswpiko";
$tb_ktiria = "meleti_ktiria";
$tb_entypa = "meleti_entypa";
$array_days = array('Κυριακή','Δευτέρα','Τρίτη','Τετάρτη','Πέμπτη','Παρασκευή','Σάββατο');

$col = "*";

$where_meletes = array("AND" => array("user_id" => $_SESSION['user_id'],"id" => $_SESSION['meleti_id']));
$where_id = array("id" => $_SESSION['user_id']);
$where_usermeleti = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));

$meletes = $upentypa->select($tb_meletes,$col,$where_meletes);
$category = $upentypa->select("library_industry_cat","*",array("id" => $meletes[0]["type"]));
$users = $upentypa->select($tb_user,$col,$where_id);
$eidikotita = $upentypa->select("library_eidikotites","*",array("id"=>$users[0]["eidikotita"]));
$idioktitis = $upentypa->select($tb_idioktitis,$col,$where_usermeleti);
	
	$data_prog_ta = $upentypa->select($tb_prog_ta,$col,$where_usermeleti);
	$date_end="1970-01-01";
	$date_start="2020-01-01";
	$programma_ta = "";
	foreach($data_prog_ta as $prog_ta){
	$data_ktirio = $upentypa->select("meleti_ktiria","*",array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $prog_ta['meleti_id'],"id" => $prog_ta['ktirio_id'])));
	$programma_ta .= "Κάθε ".$prog_ta["kathe"]."η ".$array_days[$prog_ta["day"]]." από ".$prog_ta["time_start"]." έως ".$prog_ta["time_end"]." (".$prog_ta["date_start"]."έως".$prog_ta["date_end"]."-".$data_ktirio[0]["name"].")<br/>";
	if(strtotime($prog_ta["date_end"])>=strtotime($date_end)){$date_end=$prog_ta["date_end"];}
	if(strtotime($prog_ta["date_start"])<=strtotime($date_start)){$date_start=$prog_ta["date_start"];}
	}
	
	$data_proswpiko = $upentypa->select($tb_proswpiko,$col,$where_usermeleti);
	$ergazomenoi = 0;
	$male = 0;
	$female = 0;
	$erg18 = 0;
	$ergatotexniko = 0;
	$dioikitiko = 0;
	foreach($data_proswpiko as $proswpiko){
	$ergazomenoi += $proswpiko["ar_ergazomenoi"];
		if($proswpiko["gender"]==1){$male+=$proswpiko["ar_ergazomenoi"];}
		if($proswpiko["gender"]==2){$female+=$proswpiko["ar_ergazomenoi"];}
		if($proswpiko["gender"]==3){$erg18+=$proswpiko["ar_ergazomenoi"];}
		if($proswpiko["type_ergazomenoi"]==1){$dioikitiko+=$proswpiko["ar_ergazomenoi"];}
		if($proswpiko["type_ergazomenoi"]!=1){$ergatotexniko+=$proswpiko["ar_ergazomenoi"];}
	}
	

$wres_array = programma_wres();
$wres_full_array = programma_wres_full();

$entypo2table = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:1019px;\" width=\"1019\">";
$ktiria = $upentypa->select($tb_ktiria,$col,$where_usermeleti);
foreach($ktiria as $ktirio){
$entypo2table .= "<tr>";
$entypo2table .= "<td style=\"width:208px;height:33px;\">";
if($ktirio["kentriko"]==1){$kentriko="Κεντρικό";}
if($ktirio["kentriko"]==2){$kentriko="Υποκατάστημα";}
if($ktirio["kentriko"]==3){$kentriko="Εξωτερικός χώρος";}
$entypo2table .= $ktirio["name"]." ".$ktirio["address"]."(".$kentriko.")";
$entypo2table .= "</td>";
	$entypo2_proswpiko = $upentypa->select($tb_proswpiko,$col,array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"ktirio_id"=>$ktirio["id"])));
	$entypo2_ergazomenoi = 0;
	$entypo2_male = 0;
	$entypo2_female = 0;
	$entypo2_erg18 = 0;
	$entypo2_ergatotexniko = 0;
	$entypo2_dioikitiko = 0;
	foreach($entypo2_proswpiko as $proswpiko){
	$entypo2_ergazomenoi += $proswpiko["ar_ergazomenoi"];
		if($proswpiko["gender"]==1){$entypo2_male+=$proswpiko["ar_ergazomenoi"];}
		if($proswpiko["gender"]==2){$entypo2_female+=$proswpiko["ar_ergazomenoi"];}
		if($proswpiko["gender"]==3){$entypo2_erg18+=$proswpiko["ar_ergazomenoi"];}
		if($proswpiko["type_ergazomenoi"]==1){$entypo2_dioikitiko+=$proswpiko["ar_ergazomenoi"];}
		if($proswpiko["type_ergazomenoi"]!=1){$entypo2_ergatotexniko+=$proswpiko["ar_ergazomenoi"];}
	}
$entypo2table .= "<td style=\"width:49px;height:33px;\">";
$entypo2table .= $entypo2_male;
$entypo2table .= "</td>";
$entypo2table .= "<td style=\"width:49px;height:33px;\">";
$entypo2table .= $entypo2_female;
$entypo2table .= "</td>";
$entypo2table .= "<td style=\"width:53px;height:33px;\">";
$entypo2table .= $entypo2_dioikitiko;
$entypo2table .= "</td>";
$entypo2table .= "<td style=\"width:49px;height:33px;\">";
$entypo2table .= $entypo2_ergatotexniko;
$entypo2table .= "</td>";
$entypo2table .= "<td style=\"width:57px;height:33px;\">";
$entypo2table .= $entypo2_ergazomenoi;
$entypo2table .= "</td>";
$entypo2table .= "<td style=\"width:30px;height:33px;\">";
$entypo2table .= "Τ.Α.";
$entypo2table .= "</td>";
$entypo2table .= "<td style=\"width:186px;height:33px;\">";
$entypo2table .= $users[0]["onoma"];
$entypo2table .= "</td>";
	$entypo2_wres_sto_ktirio = programma_wres_ktirio($ktirio["id"]);
$entypo2table .= "<td style=\"width:47px;height:33px;\">";
$entypo2table .= $entypo2_wres_sto_ktirio[0];
$entypo2table .= "</td>";
	$entypo2_data_prog_ta = $upentypa->select($tb_prog_ta,$col,array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"ktirio_id"=>$ktirio["id"])));
	$entypo2_prog_ta = "";
	foreach($entypo2_data_prog_ta as $data){
	$entypo2_prog_ta .= "Κάθε ".$data["kathe"]."η ".$array_days[$data["day"]]." από ".$data["time_start"]." έως ".$data["time_end"]." (".$data["date_start"]."έως".$data["date_end"].")<br/>";
	}
$entypo2table .= "<td style=\"width:291px;height:33px;\">";
$entypo2table .= $entypo2_prog_ta;
$entypo2table .= "</td>";
$entypo2table .= "</tr>";

}
$entypo2table .= "</table>";


$z1[0]=$meletes[0]["name"];
$z1[1]=$meletes[0]["afm"];
$z1[2]=$meletes[0]["doy"];
$z1[3]=$meletes[0]["address"];
$z1[4]=$meletes[0]["tel"];
$z1[5]=$category[0]["name"];

$z1[6]=$idioktitis[0]["name"];
$z1[7]=$idioktitis[0]["father"];
$z1[8]=$idioktitis[0]["mother"];
$z1[9]=$idioktitis[0]["address"];
$z1[10]=$idioktitis[0]["adt"];
$z1[11]=$idioktitis[0]["afm"];
$z1[12]=$idioktitis[0]["tel"];

$z1[13]=$users[0]["afm"];
$z1[14]=$users[0]["onoma"];
$z1[15]=$users[0]["taytotita"];
$z1[16]=$users[0]["address"];
$z1[17]=$eidikotita[0]["name"];

$z1[18]=$wres_array[0];
$z1[19]=$wres_full_array[0] - $wres_array[0];
$z1[20]=$programma_ta;
$z1[21]=$date_end;
$z1[22]=$date_start;

$z1[23]=$ergazomenoi;
$z1[24]=$male;
$z1[25]=$female;
$z1[26]=$erg18;
$z1[27]=$dioikitiko;
$z1[28]=$ergatotexniko;
$z1[29]=$entypo2table;



//επιλογή στοιχείων εντύπων
$count_entypa = $upentypa->count($tb_entypa, $where_usermeleti);
$entypa = $upentypa->select($tb_entypa,$col,$where_usermeleti);

foreach($entypa as $entypo){
$entypo["text"] = str_replace($z, $z1, $entypo["text"]);
$update_parameters = array("text" => $entypo["text"]);
$updatewhere_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"type" => $entypo["type"]));
$update_teyxos = $upentypa->update($tb_entypa,$update_parameters,$updatewhere_parameters);
}

?>