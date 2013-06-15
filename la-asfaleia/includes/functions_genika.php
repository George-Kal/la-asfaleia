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

require("include_check.php");

//Εκτύπωση στοιχείων μελέτης
function print_stoixeia(){
	
	$genika = "";
	
	$database = new medoo(DB_NAME);
	$db_table = "meletes";
	$db_columns = "*";
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"id" => $_SESSION['meleti_id']));
	$data_genika = $database->select($db_table,$db_columns,$db_parameters);
	$count_genika = $database->count($db_table, $db_parameters);
	
	$genika .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$genika .= "<tr><td>Επωνυμία</td><td>".$data_genika[0]["name"]."</td></tr>";
	$genika .= "<tr><td>Περιγραφή</td><td>".$data_genika[0]["perigrafi"]."</td></tr>";
	$genika .= "<tr><td>Διεύθυνση</td><td>".$data_genika[0]["address"]."</td></tr>";
	$genika .= "<tr><td>Τοπωνύμιο</td><td>".$data_genika[0]["toponymio"]."</td></tr>";
	$genika .= "<tr><td>Γ. μήκος</td><td>".$data_genika[0]["lat"]."</td></tr>";
	$genika .= "<tr><td>Γ. πλάτος</td><td>".$data_genika[0]["lon"]."</td></tr>";
	$genika .= "<tr><td>ΑΦΜ</td><td>".$data_genika[0]["afm"]."</td></tr>";
	$genika .= "<tr><td>ΔΟΥ</td><td>".$data_genika[0]["doy"]."</td></tr>";
	$genika .= "<tr><td>Τηλέφωνο</td><td>".$data_genika[0]["tel"]."</td></tr>";

	$genika .= "</table>";
	
	return $genika;
}

//Εκτύπωση στοιχείων Τ.Α.
function print_stoixeiauser(){
	
	$user = "";
	
	$database = new medoo(DB_NAME);
	$db_table = "users";
	$db_columns = "*";
	$db_parameters = array("id" => $_SESSION['user_id']);
	$data_user = $database->select($db_table,$db_columns,$db_parameters);
	$count_user = $database->count($db_table, $db_parameters);
	
	$user .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$user .= "<tr><td>Όνομα</td><td>".$data_user[0]["onoma"]."</td></tr>";
		$data_eidikotita = $database->select("library_eidikotites","*",array("id"=>$data_user[0]["eidikotita"]));
		$eidikotita=$data_eidikotita[0]["name"];

	$user .= "<tr><td>Ειδικότητα</td><td>".$eidikotita."</td></tr>";
	$user .= "<tr><td>Διεύθυνση</td><td>".$data_user[0]["address"]."</td></tr>";
	$user .= "<tr><td>Τηλέφωνο</td><td>".$data_user[0]["tel"]."</td></tr>";
	$user .= "<tr><td>Ταυτότητα</td><td>".$data_user[0]["taytotita"]."</td></tr>";
	$user .= "<tr><td>ΑΦΜ</td><td>".$data_user[0]["afm"]."</td></tr>";
	$user .= "<tr><td>e-mail</td><td>".$data_user[0]["email"]."</td></tr>";

	$user .= "</table>";
	
	return $user;
}

//Εκτύπωση κτιρίων μελέτης
function print_ktiria(){
	
	$ktiria = "";
	
	$database = new medoo(DB_NAME);
	$db_table = "meleti_ktiria";
	$db_columns = "*";
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"id" => $_SESSION['meleti_id']));
	$data_ktiria = $database->select($db_table,$db_columns,$db_parameters);
	$count_ktiria = $database->count($db_table, $db_parameters);
	
	$ktiria .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$ktiria .= "<tr><td>α/α</td><td>Όνομα</td><td>Κεντρικό/Υποκατάστημα</td><td>Διεύθυνση</td><td>Χρήση</td></tr>";
	
	$i=1;
	foreach($data_ktiria as $data){
		$ktiria .= "<tr>";
		$ktiria .= "<td>".$i."</td>";
		$ktiria .= "<td>".$data["name"]."</td>";
		if($data["kentriko"]==1){$kentriko="Κεντρικό";}
		if($data["kentriko"]==2){$kentriko="Υποκατάστημα";}
		if($data["kentriko"]==3){$kentriko="Εξ. χώρος";}
		$ktiria .= "<td>".$kentriko."</td>";
		$ktiria .= "<td>".$data["address"]."</td>";
		if($data["xrisi"]==1){$xrisi="Της επιχείρησης";}
		if($data["xrisi"]==2){$xrisi="Γραφεία";}
		if($data["xrisi"]==3){$xrisi="Αποθήκη";}
		$ktiria .= "<td>".$xrisi."</td>";
		$ktiria .= "</tr>";
	$i++;	
	}
	$ktiria .= "</table>";
	
	return $ktiria;
}


//Εκτύπωση στοιχείων Ι.Ε.
function print_stoixeiaie(){
	
	$ie = "";
	
	$database = new medoo(DB_NAME);
	$db_table = "meleti_ypeythinos";
	$db_columns = "*";
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"type" => "5"));
	$data_ie = $database->select($db_table,$db_columns,$db_parameters);
	$count_ie = $database->count($db_table, $db_parameters);
	if ($count_ie==0){
	$ie .= "Δεν έχει οριστεί Ι.Ε. στην επιχείρηση";
	}else{
		$ie .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
		$ie .= "<tr><td>α/α</td><td>Κτίριο</td><td>Είδος υπευθύνου</td><td>Όνομα-Επώνυμο</td><td>Ον. Πατέρα</td><td>Ον. Μητέρας</td><td>Δ/νση</td><td>Τηλ</td><td>ΑΔΤ</td><td>ΑΦΜ</td></tr>";
		
		$i=1;
		foreach($data_ie as $data){
			$ie .= "<tr>";
			$ie .= "<td>".$i."</td>";
			$ie .= "<td>".$data["ktirio_id"]."</td>";
			$ie .= "<td>Ι.Ε.</td>";
			$ie .= "<td>".$data["onoma"]."</td>";
			$ie .= "<td>".$data["pateras"]."</td>";
			$ie .= "<td>".$data["mitera"]."</td>";
			$ie .= "<td>".$data["address"]."</td>";
			$ie .= "<td>".$data["tel"]."</td>";
			$ie .= "<td>".$data["taytotita"]."</td>";
			$ie .= "<td>".$data["afm"]."</td>";
			$ie .= "</tr>";
		$i++;	
		}
		$ie .= "</table>";
	}
	return $ie;
}

//Εκτύπωση στοιχείων Υπευθύνων
function print_stoixeiaypeythinoi(){
	
	$ypeythinoi = "";
	
	$database = new medoo(DB_NAME);
	$db_table = "meleti_ypeythinos";
	$db_columns = "*";
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"type[!]" => "5"));
	$data_ypeythinoi = $database->select($db_table,$db_columns,$db_parameters);
	$count_ypeythinoi = $database->count($db_table, $db_parameters);
	if ($count_ypeythinoi==0){
	$ypeythinoi .= "Δεν έχουν οριστεί υπεύθυνοι στην επιχείρηση";
	}else{
		$ypeythinoi .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
		$ypeythinoi .= "<tr><td>α/α</td><td>Κτίριο</td><td>Είδος υπευθύνου</td><td>Όνομα-Επώνυμο</td><td>Ον. Πατέρα</td><td>Ον. Μητέρας</td><td>Δ/νση</td><td>Τηλ</td><td>ΑΔΤ</td><td>ΑΦΜ</td></tr>";
		
		$i=1;
		foreach($data_ypeythinoi as $data){
			$ypeythinoi .= "<tr>";
			$ypeythinoi .= "<td>".$i."</td>";
				$data_ktirio = $database->select("meleti_ktiria",$db_columns,array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"id" => $data["ktirio_id"])));
			$ypeythinoi .= "<td>".$data_ktirio[0]["name"]."</td>";
				if($data["type"]==1){$type="Διευθυντής";}
				if($data["type"]==2){$type="Υπεύθυνος προσωπικού";}
				if($data["type"]==3){$type="Συντηρητής εξοπλισμού";}
				if($data["type"]==4){$type="Συντηρητής Π.Υ. μέσων";}
			$ypeythinoi .= "<td>".$type."</td>";
			$ypeythinoi .= "<td>".$data["onoma"]."</td>";
			$ypeythinoi .= "<td>".$data["pateras"]."</td>";
			$ypeythinoi .= "<td>".$data["mitera"]."</td>";
			$ypeythinoi .= "<td>".$data["address"]."</td>";
			$ypeythinoi .= "<td>".$data["tel"]."</td>";
			$ypeythinoi .= "<td>".$data["taytotita"]."</td>";
			$ypeythinoi .= "<td>".$data["afm"]."</td>";
			$ypeythinoi .= "</tr>";
		$i++;	
		}
		$ypeythinoi .= "</table>";
	}
	return $ypeythinoi;
}


//Εκτύπωση στοιχείων εργαζομένων
function print_stoixeiaergazomenoi(){
	
	$ergazomenoi = "";
	
	$database = new medoo(DB_NAME);
	$db_table = "meleti_proswpiko";
	$db_columns = "*";
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
	$data_ergazomenoi = $database->select($db_table,$db_columns,$db_parameters);
	$count_ergazomenoi = $database->count($db_table, $db_parameters);
	if ($count_ergazomenoi==0){
	$ergazomenoi .= "ΠΡΟΣΟΧΗ! Δεν έχουν οριστεί εργαζόμενοι στην επιχείρηση";
	}else{
		$ergazomenoi .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
		$ergazomenoi .= "<tr><td>α/α</td><td>Κτίριο</td><td>αρ. εργαζομένων</td><td>Φύλλο</td><td>Ειδικότητα</td><td>Είδος απασχόλησης</td><td>ΜΑΠ</td></tr>";
		
		$i=1;
		foreach($data_ergazomenoi as $data){
			$ergazomenoi .= "<tr>";
			$ergazomenoi .= "<td>".$i."</td>";
				$data_ktirio = $database->select("meleti_ktiria",$db_columns,array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"id" => $data["ktirio_id"])));
			$ergazomenoi .= "<td>".$data_ktirio[0]["name"]."</td>";
			$ergazomenoi .= "<td>".$data["ar_ergazomenoi"]."</td>";
				if($data["gender"]==1){$gender="Άνδρες";}
				if($data["gender"]==2){$gender="Γυναίκες";}
				if($data["gender"]==3){$gender="<18 ετών";}
			$ergazomenoi .= "<td>".$gender."</td>";		
				$data_eidikotita = $database->select("library_eidikotiteserg","*",array("id"=>$data["type_ergazomenoi"]));
				$type=$data_eidikotita[0]["name"];
				$map=$data_eidikotita[0]["map"];

			$ergazomenoi .= "<td>".$type."</td>";
				if($data["apasxolisi"]==1){$apasxolisi="Πλήρης απασχόληση";}
				if($data["apasxolisi"]==2){$apasxolisi="Μερική απασχόληση";}
				if($data["apasxolisi"]==3){$apasxolisi="Ορισμένου χρόνου";}
			$ergazomenoi .= "<td>".$apasxolisi."</td>";	
			$ergazomenoi .= "<td>".$map."</td>";
			$ergazomenoi .= "</tr>";
		$i++;	
		}
		$ergazomenoi .= "</table>";
	}
	return $ergazomenoi;
}

//Εκτύπωση αριθμού εργαζομένων
function count_ergazomenoi(){
	
	$database = new medoo(DB_NAME);
	$db_table = "meleti_proswpiko";
	$db_columns = "*";
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
	$count_ergazomenoi = $database->select($db_table,$db_columns,$db_parameters);
	$ergazomenoi = 0;
		foreach($count_ergazomenoi as $row){
		$ergazomenoi += $row["ar_ergazomenoi"];
		}
	
	return $ergazomenoi;

}

//Εκτύπωση αριθμού υπευθύνων
function count_ypeythinoi(){
	
	$database = new medoo(DB_NAME);
	$db_table = "meleti_ypeythinos";
	$db_columns = "*";
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
	$count_ypeythinoi = $database->count($db_table, $db_parameters);
	
	return $count_ypeythinoi;

}


//Εκτύπωση αριθμού κτιρίων
function count_ktiria(){

	$database = new medoo(DB_NAME);
	$db_table = "meleti_ktiria";
	$db_columns = "*";
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
	$count_ktiria = $database->count($db_table, $db_parameters);
	
	return $count_ktiria;

}
?>
