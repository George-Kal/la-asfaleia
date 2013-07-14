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

$upteyxos = new medoo(DB_NAME);

$z = array();
$z1 = array();

//επιλογή στοιχείων μελέτης
$tb_meletes = "meletes";
$col_meletes = "*";
$where_meletes = array("AND" => array("user_id" => $_SESSION['user_id'],"id" => $_SESSION['meleti_id']));
$meletes = $upteyxos->select($tb_meletes,$col_meletes,$where_meletes);

//Επωνυμία επιχείρησης
$z[0]="{TEYXOS_EPWNYMIA}";
$z1[0]=$meletes[0]["name"];

//Διεύθυνση επιχείρησης
$z[1]="{TEYXOS_ADDRESS}";
$z1[1]=$meletes[0]["address"];

$category = $upteyxos->select("library_industry_cat","*",array("id" => $meletes[0]["type"]));

//Αντικείμενο εργασιών
$z[2]="{TEYXOS_ANTIKEIMENO}";
$z1[2]=$category[0]["name"];
if($category[0]["cat"]==1){$cat_epik="A";}
if($category[0]["cat"]==2){$cat_epik="Β";}
if($category[0]["cat"]==3){$cat_epik="Γ";}
$z1[2].=" (ΚΩΔ: ".$category[0]["code"]." Κατηγορία επικινδυνότητας: ".$cat_epik.")";

//επιλογή στοιχείων χρήστη
$tb_user = "users";
$col_user = "*";
$where_id = array("id" => $_SESSION['user_id']);
$users = $upteyxos->select($tb_user,$col_user,$where_id);

$data_eidikotita = $upteyxos->select("library_eidikotites","*",array("id"=>$users[0]["eidikotita"]));
$eidikotita=$data_eidikotita[0]["name"];

//Μελετητής
$z[3]="{TEYXOS_MELETITIS}";
$z1[3]=$users[0]["onoma"]."<br/>".$eidikotita;

$z[4]="{TEYXOS_KATIGORIA}";
$z1[4]=$meletes[0]["paragwgiki"];

$z[5]="{TEYXOS_SYMPERASMATA}";
$z1[5]=$meletes[0]["symperasmata"];

//Πρόγραμμα τεχνικού ασφαλείας και ιατρού εργασίας για το τρέχον έτος
$trexon_y = date("Y");
$wres = programma_wres();
$el_wres = elaxistes_wres();

$z[6]="{TA_PROGRAM}";
$z1[6] = draw_calendar($trexon_y,"meleti_programma_ta");
$z1[6] .= "Σύνολο ωρών Τ.Α. στην επιχείρηση: ".$wres[0].". Ελάχιστες ώρες: ".$el_wres[0];

$z[7]="{IE_PROGRAM}";
$z1[7] = draw_calendar($trexon_y,"meleti_programma_ie");
$z1[7] .= "Σύνολο ωρών Τ.Α. στην επιχείρηση: ".$wres[1].". Ελάχιστες ώρες: ".$el_wres[1];

//Ερωτηματολόγια
$z[8]="{TEYXOS_ERWTIMATOLOGIA}";
$z1[8] = create_qa();

$z[9]="{TEYXOS_EPIKINDYNOTITA}";
$z1[9] = calc_epikindynotita()."<br/>".print_measurements();


$z[10]="{EPIXEIRISI_STOIXEIA}";
$z1[10] = print_stoixeia();

$z[11]="{EPIXEIRISI_KTIRIA}";
$z1[11] = print_ktiria();

$z[12]="{TA_STOIXEIA}";
$z1[12] = print_stoixeiauser();

$z[13]="{IE_STOIXEIA}";
$z1[13] = print_stoixeiaie();

$z[14]="{TEYXOS_YPEYTHINOI}";
$z1[14] = print_stoixeiaypeythinoi();

$z[15]="{TEYXOS_ERGAZOMENOI}";
$z1[15] = print_stoixeiaergazomenoi();

$z[16]="{TEYXOS_METRAPROLIPSIS}";
$z1[16] = print_metraprolipsis();

$z[17]="{TEYXOS_PIGES}";
$z1[17] = print_pigeskindynoy();

$z[18]="{TEYXOS_SXEDIO}";
$z1[18] = print_sxedio();

$z[19]="{TEYXOS_NOMOTHESIA}";
$z1[19] = create_laws();

//επιλογή στοιχείων τεύχους
$tb_teyxos = "meleti_teyxos";
$col_teyxos = "*";
$where_usermeleti = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
$count_kefalaia = $upteyxos->count($tb_teyxos, $where_usermeleti);
$kefalaia = $upteyxos->select($tb_teyxos,$col_teyxos,$where_usermeleti);

foreach($kefalaia as $kefalaio){
$kefalaio["text"] = str_replace($z, $z1, $kefalaio["text"]);
$update_parameters = array("text" => $kefalaio["text"]);
$updatewhere_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"kefalaio" => $kefalaio["kefalaio"]));
$update_teyxos = $upteyxos->update($tb_teyxos,$update_parameters,$updatewhere_parameters);
}

?>