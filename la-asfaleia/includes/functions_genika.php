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

if (isset($_GET['ktiria'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$ktiria = count_ktiria();
	if($ktiria[0]==0){$text_entypo = "<font color=\"red\">Δηλώστε πρώτα ένα τουλάχιστον κτίριο στην επιχείρηση</font>";}
	if($ktiria[2]==0){$text_entypo = "<font color=\"green\">Έντυπο 1</font>";}
	if($ktiria[2]!=0){$text_entypo = "<font color=\"green\">Έντυπο 2</font>";}
	echo $text_entypo;
	echo "<br/><br/>Έχουν δηλωθεί:<br/>";
	echo $ktiria[0]." Κτίρια στο κεντρικό κατάστημα της επιχείρησης.<br/>";
	echo $ktiria[1]." Κτίρια σε υποκαταστήματα στην επιχείρηση.<br/>";
	echo $ktiria[2]." εξωτερικοί χώροι στην επιχείρηση.<br/>";
	exit;
}
if (isset($_GET['proswpiko'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$e=count_ergazomenoi();
	$y=count_ypeythinoi();
	$te=" εργαζόμενους";
	if ($e==1)$te=" εργαζόμενο";
	$ty=" υπεύθυνους";
	if ($y==1)$ty=" υπεύθυνο";
	echo $e.$te." στην επιχείρηση<br/>";
	echo $y.$ty." στην επιχείρηση<br/>";
	exit;
}

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
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
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
	$count_eidikotites = $database->count("library_eidikotiteserg");
	
	if ($count_ergazomenoi==0){
	$ergazomenoi .= "ΠΡΟΣΟΧΗ! Δεν έχουν οριστεί εργαζόμενοι στην επιχείρηση";
	}else{
		$ergazomenoi .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
		$ergazomenoi .= "<tr><td>α/α</td><td>Κτίριο</td><td>αρ. εργαζομένων</td><td>Ονομ/μο</td><td>Φύλλο</td><td>Ειδικότητα</td><td>Είδος απασχόλησης</td><td>ΜΑΠ</td></tr>";
		
		$i=1;
		foreach($data_ergazomenoi as $data){
			$ergazomenoi .= "<tr>";
			$ergazomenoi .= "<td>".$i."</td>";
				$data_ktirio = $database->select("meleti_ktiria",$db_columns,array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"id" => $data["ktirio_id"])));
			$ergazomenoi .= "<td>".$data_ktirio[0]["name"]."</td>";
			$ergazomenoi .= "<td>".$data["ar_ergazomenoi"]."</td>";
			$ergazomenoi .= "<td>".$data["name"]."</td>";
				if($data["gender"]==1){$gender="Άνδρες";}
				if($data["gender"]==2){$gender="Γυναίκες";}
				if($data["gender"]==3){$gender="<18 ετών";}
			$ergazomenoi .= "<td>".$gender."</td>";		
			
				if($data["type_ergazomenoi"]<=$count_eidikotites){$table_eidikotites="library_eidikotiteserg";}
				if($data["type_ergazomenoi"]>$count_eidikotites){$table_eidikotites="user_eidikotiteserg";$data["type_ergazomenoi"]-=$count_eidikotites;}
				
				$data_eidikotita = $database->select($table_eidikotites,"*",array("id"=>$data["type_ergazomenoi"]));
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

//Εκτύπωση στοιχείων θέσεων εργασίας
function print_theseiserg(){
	
	$theseiserg = "";
	
	$database = new medoo(DB_NAME);
	$db_table = "meleti_theseiserg";
	$db_columns = "*";
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
	$data_theseis = $database->select($db_table,$db_columns,$db_parameters);
	$count_theseis = $database->count($db_table, $db_parameters);
	
	if ($count_theseis==0){
	$theseiserg .= "ΠΡΟΣΟΧΗ! Δεν έχουν οριστεί θέσεις εργασίας στην επιχείρηση";
	}else{
		$theseiserg .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
		$theseiserg .= "<tr><td>α/α</td><td>Κτίριο</td><td>Περιγραφή θέσης εργασίας</td><td>Σημάνσεις</td></tr>";
		
		$i=1;
		foreach($data_theseis as $data){
			$theseiserg .= "<tr>";
			$theseiserg .= "<td>".$i."</td>";
				$data_ktirio = $database->select("meleti_ktiria",$db_columns,array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"id" => $data["ktirio_id"])));
			$theseiserg .= "<td>".$data_ktirio[0]["name"]."</td>";
			$theseiserg .= "<td>".$data["perigrafi"]."</td>";
			$theseiserg .= "<td>".$data["simansi"]."</td>";				
			$theseiserg .= "</tr>";
		$i++;	
		}
		$theseiserg .= "</table>";
		$theseiserg .= "<br/>";
		
		$theseiserg .= "Ενδεχόμενη έκθεση σε βλαπτικούς παράγοντες - Θέσεις εργασίας";
		
		$theseiserg .= "<span style=\"font-size:8px;\">";
		$theseiserg .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
		$theseiserg .= "<tr>
		<td>α/α θέσης</td>
		<td>Ελεύθερα καλώδια</td>
		<td>Ολισθηρό δάπεδο</td>
		<td>Φωτισμός</td>
		<td>Θερμικό περιβάλλον</td>
		<td>Εξαερισμός</td>
		<td>Ακτινοβολίες</td>
		<td>Θόρυβος</td>
		<td>Δονήσεις</td>
		<td>Κτιριολογικές απαιτήσεις</td>
		<td>Εργασία με ΗΥ</td>
		<td>Βιολογικοί παράγοντες</td>
		<td>Χημικοί παράγοντες</td>
		<td>Καρκινογόνοι παράγοντες</td>
		<td>Ηλεκτρικό ρεύμα</td>
		<td>Εκρηκτικές ατμόσφαιρες</td>
		<td>Πυρασφάλεια</td>
		<td>Εργασίες σε ύψος</td>
		<td>Περιορισμένοι χώροι</td>
		<td>Χειρονακτικός χειρισμός φορτίων</td>
		<td>Φορητά εργαλεία</td>
		<td>Συντήρηση και επισκευές</td>
		<td>Κοπή μετάλλων</td>
		<td>Περονοφόρα και ανυψωτικά</td>
		<td>Απορριμματοφόρα</td>
		<td>Κλαρκ</td>
		<td>Οχήματα μεταφοράς</td>
		<td>Χωματουργικά</td>
		<td>Επιβλέψεις - Τεχνικά</td>
		<td>Ναυπηγικά</td>
		<td>Μεταλλευτικά - Λατομικά</td>
		<td>Ψυχοκοινωνικοί</td>
		<td>Βιολογικός καθαρισμός</td>
		</tr>";
		
		$i=1;
		$column_array = array(
		"kalwdia",
		"dapedo",
		"fwtismos",
		"thermiko",
		"eksaerismos",
		"aktinovolies",
		"thorivos",
		"doniseis",
		"ktirio",
		"pc",
		"viologikoi",
		"ximikoi",
		"karkinogonoi",
		"reyma",
		"ekriktika",
		"pyrasfaleia",
		"ypsos",
		"periorismenoi",
		"xeironaktika",
		"forita",
		"syntirisi",
		"kopi",
		"peronofora",
		"aporimatofora",
		"klark",
		"oximatametaforas",
		"xwmatoyrgika",
		"epivlepseis",
		"naypigika",
		"metaleytikalatomika",
		"stress",
		"viologikoikathar"
		);
		
		foreach($data_theseis as $data){
			$theseiserg .= "<tr>";
			$theseiserg .= "<td>".$i."</td>";
				foreach($column_array as $column){
					if($data[$column]==1){$value="OXI";}
					if($data[$column]==2){$value="<font color=\"red\">NAI</font>";}
				$theseiserg .= "<td>".$value."</td>";
				}		
			$theseiserg .= "</tr>";
		$i++;	
		}
		$theseiserg .= "</table>";
		$theseiserg .= "</span>";
		
		
	}
	return $theseiserg;
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
	$db_param_kentriko = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"kentriko" => 1));
	$db_param_ypokat = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"kentriko" => 2));
	$db_param_eksw = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"kentriko" => 3));
	
	//Το σύνολο των κτιρίων στην επιχείρηση
	$count_ktiria = $database->count($db_table, $db_parameters);
	
	//Τα κτίρια στο κεντρικό κατάστημα
	$count_kentriko = $database->count($db_table, $db_param_kentriko);
	
	//Τα κτίρια στα υποκαταστήματα κατάστημα
	$count_ypokat = $database->count($db_table, $db_param_ypokat);
	
	//Οι εξωτερικοί χώροι εργασίας
	$count_eksw = $database->count($db_table, $db_param_eksw);
	
	return array($count_ktiria,$count_ypokat,$count_eksw);

}
?>