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

if (isset($_GET['sxedio'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	echo print_sxedio();
	exit;
}
if (isset($_GET['epikindynotita'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	echo calc_epikindynotita()."<br/>".print_measurements()."<br/>".print_taktikoielegxoi();
	exit;
}
if (isset($_GET['metra'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	echo print_metraprolipsis();
	exit;
}

require("include_check.php");

//Υπολογισμός επικινδυνότητας από την τρέχουσα μελέτη.
function calc_epikindynotita(){
	
	$epikindynotita = "";
	
	$array_sobarotita = array(
		"0",
		"1-Αμελητέα",
		"4-Σημαντική",
		"8-Σοβαρή",
		"16-Πολύ σοβαρή",
		"25-Καταστρεπτική"
	);
	$array_sobarotita_varytita = array(
		0,
		1,
		4,
		8,
		16,
		25
	);
	$array_ekthesi = array(
		"0",
		"1-Πολύ σπάνια",
		"2-Περιορισμένη",
		"3-Ευκαιριακή",
		"4-Συχνή",
		"5-Διαρκής"
	);
	$array_pithanotita = array(
		"0",
		"1-Μηδενική",
		"2-Πολύ μικρή",
		"3-Μικρή",
		"4-Μεσαία",
		"5-Υψηλή"
	);
	$array_pithanotita = array(
		"0",
		"1-Μηδενική",
		"2-Πολύ μικρή",
		"3-Μικρή",
		"4-Μεσαία",
		"5-Υψηλή"
	);
	$array_perigrafi = array(
		"0",
		"(R &le; 25)<br/>Ανεκτή:Η επικινδυνότητα είναι ασήμαντη και δεν ενδέχεται να αυξηθεί στο εγγύς μέλλον χωρίς αλλαγή των συνθηκών εργασίας.",
		"(25 &lsaquo; R &le; 100)<br/>Χαμηλή:Η επικινδυνότητα είναι ελεγχόμενη χωρίς να αποκλείεται η εκδήλωση ανεπιθύμητου συμβάντος.",
		"(100 &lsaquo; R &le; 200)<br/>Μέτρια:Η επικινδυνότητα δεν ελέγχεται αποτελεσματικά ή δεν αποκλείεται η εκδήλωση σοβαρού ανεπιθύμητου συμβάντος.",
		"(200 &lsaquo; R &le; 400)<br/>Μεγάλη:Η επικινδυνότητα δεν ελέγχεται αποτελεσματικά και υπάρχει πιθανότητα εκδήλωσης σοβαρού ανεπιθύμητου συμβάντος.",
		"(400 &lsaquo; R &le; 625)<br/>Απαράδεκτα μεγάλη:Υπάρχει πιθανότητα απώλειας ζωής ή επίκειται άμεσα η εκδήλωση σοβαρού ανεπιθύμητου συμβάντος"
	);
	$array_energeies = array(
		"0",
		"Δεν κρίνεται απαραίτητη η λήψη μέτρων. Αυτό δεν σημαίνει χαλάρωση των μέτρων ασφαλείας αλλά συνεχή εφαρμογή τους.",
		"Απαιτείται παρακολούθηση και ενέργειες για τη μείωση του κινδύνου. Η άμεση λήψη μέτρων δεν κρίνεται απαραίτητη.",
		"Απαιτείται ο προγραμματισμός λήψης μέτρων για τη μείωση του κινδύνου.",
		"Απαιτείται ο προγραμματισμός ενεργειών για την εξάλειψη του κινδύνου και η άμεση λήψη μέτρων για τον περιορισμό του κινδύνου.",
		"Άμεση προτεραιότητα σε ενέργειες εξάλειψης του κινδύνου."
	);
	
	
	$database = new medoo(DB_NAME);
	$db_table = "meleti_piges";
	$db_columns = "*";
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
	$data_piges = $database->select($db_table,$db_columns,$db_parameters);
	$count_piges = $database->count($db_table, $db_parameters);
	
	if ($count_piges==0){
	$epikindynotita .= "ΠΡΟΣΟΧΗ! Δεν έχουν οριστεί πηγές κινδύνου στην επιχείρηση.";
	}else{
	$epikindynotita .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$epikindynotita .= "<tr><th>Κτίριο</th><th>Πηγή κινδύνου</th><th>Σύντομη περιγραφή</th><th>Σοβαρότητα</th><th>Έκθεση</th><th>Πιθανότητα</th><th>Επικινδυνότητα (R)</th><th>Περιγραφή (R)</th><th>Ενέργειες (R)</th><th>Πρόβλεψη</th><th>Μέτρα</th></tr>";
		foreach($data_piges as $data){
		$epikindynotita .= "<tr>";
		
			$data_ktirio = $database->select("meleti_ktiria","*",array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $data['meleti_id'],"id" => $data['ktirio_id'])));
			$epikindynotita .= "<td>".$data_ktirio[0]["name"]."</td>";
			$data_library_piges = $database->select("library_pigeskindynoy","*",array("id" => $data["type"]));
			
		$epikindynotita .= "<td>".$data_library_piges[0]["name"]."</td>";
		$epikindynotita .= "<td>".$data["perigrafi"]."</td>";
		$epikindynotita .= "<td>".$array_sobarotita[$data["sobarotita"]]."</td>";
		$epikindynotita .= "<td>".$array_ekthesi[$data["ekthesi"]]."</td>";
		$epikindynotita .= "<td>".$array_pithanotita[$data["pithanotita"]]."</td>";
		$result = $array_sobarotita_varytita[$data["sobarotita"]]*$data["ekthesi"]*$data["pithanotita"];
		$epikindynotita .= "<td>".$result."</td>";
			if($result<=25){$perigrafi=$array_perigrafi[1];$energeies=$array_energeies[1];}
			if($result>25 AND $result<=100){$perigrafi=$array_perigrafi[2];$energeies=$array_energeies[2];}
			if($result>100 AND $result<=200){$perigrafi=$array_perigrafi[3];$energeies=$array_energeies[3];}
			if($result>200 AND $result<=400){$perigrafi=$array_perigrafi[4];$energeies=$array_energeies[4];}
			if($result>400 AND $result<=625){$perigrafi=$array_perigrafi[5];$energeies=$array_energeies[5];}
		$epikindynotita .= "<td>".$perigrafi."</td>";
		$epikindynotita .= "<td>".$energeies."</td>";
			if($data["provlepsi"]==1){$provlepsi="ΝΑΙ";}
			if($data["provlepsi"]==2){$provlepsi="ΟΧΙ";}
		$epikindynotita .= "<td>".$provlepsi."</td>";
		$epikindynotita .= "<td>".$data["metra"]."</td>";
		$epikindynotita .= "</tr>";
		}
	$epikindynotita .= "</table>";
	}
	return $epikindynotita;
}


function print_metraprolipsis(){
	$metra ="";
	
	$database = new medoo(DB_NAME);
	$db_table = "meleti_metra";
	$db_columns = "*";
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
	$data_metra = $database->select($db_table,$db_columns,$db_parameters);
	$count_metra = $database->count($db_table, $db_parameters);
	if ($count_metra==0){
	$metra .= "ΠΡΟΣΟΧΗ! Δεν έχουν οριστεί μέτρα πρόληψης στην επιχείρηση ή βάση της τιμής επικινδυνότητας δεν κρίνεται η ανάγκη λήψης νέων μέτρων.";
	}else{
		$metra .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
		$metra .= "<tr><td>α/α</td><td>Κτίριο</td><td>Επικίνδυνη Εργασία</td><td>Πιθανός κίνδυνος</td><td>Πρόταση βελτίωσης</td></tr>";
		
		$i=1;
		foreach($data_metra as $data){
			$metra .= "<tr>";
			$metra .= "<td>".$i."</td>";
				$data_ktirio = $database->select("meleti_ktiria",$db_columns,array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"id" => $data["ktirio_id"])));
			$metra .= "<td>".$data_ktirio[0]["name"]."</td>";
			$metra .= "<td>".$data["ergasia"]."</td>";
			$metra .= "<td>".$data["kindynos"]."</td>";
			$metra .= "<td>".$data["protasi"]."</td>";			
			$metra .= "</tr>";
		$i++;	
		}
		$metra .= "</table>";
	}
	
	return $metra;
}

//Εκτύπωση επιτόπιων μετρήσεων
function print_measurements(){
	$database = new medoo(DB_NAME);
	$db_table = "meleti_measurements";
	$db_columns = "*";
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
	$data_measurements = $database->select($db_table,$db_columns,$db_parameters);
	$count_measurements = $database->count($db_table, $db_parameters);
	
	$measurements = "";
	
	if ($count_measurements==0){
	$measurements .= "ΠΡΟΣΟΧΗ! Δεν έχουν πραγματοποιηθεί ακόμη μετρήσεις παραμέτρων στην επιχείρηση.";
	}else{
		$measurements .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
		$measurements .= "<tr><td>α/α</td><td>Κτίριο</td><td>Παράμετρος</td><td>Θέση</td><td>Τιμή</td><td>Μονάδα</td><td>Πρόβλεψη</td><td>Μέτρα</td></tr>";
		
		$i=1;
		foreach($data_measurements as $data){
			$measurements .= "<tr>";
			$measurements .= "<td>".$i."</td>";
				$data_ktirio = $database->select("meleti_ktiria",$db_columns,array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"id" => $data["ktirio_id"])));
			$measurements .= "<td>".$data_ktirio[0]["name"]."</td>";
			$measurements .= "<td>".$data["type"]."</td>";
			$measurements .= "<td>".$data["thesi"]."</td>";
			$measurements .= "<td>".$data["value"]."</td>";
			$measurements .= "<td>".$data["unit"]."</td>";
				if($data["provlepsi"]==1){$provlepsi="NAI";}
				if($data["provlepsi"]==2){$provlepsi="OXI";}
			$measurements .= "<td>".$provlepsi."</td>";
			$measurements .= "<td>".$data["metra"]."</td>";			
			$measurements .= "</tr>";
		$i++;	
		}
		$measurements .= "</table>";
	}	
	return $measurements;	
}

//Εκτύπωση τακτικών ελέγχων
function print_taktikoielegxoi(){
	$database = new medoo(DB_NAME);
	$db_table = "meleti_taktikoielegxoi";
	$db_columns = "*";
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
	$data_elegxoi = $database->select($db_table,$db_columns,$db_parameters);
	$count_elegxoi = $database->count($db_table, $db_parameters);
	
	$elegxoi = "";
	
	if ($count_elegxoi==0){
	$elegxoi .= "ΠΡΟΣΟΧΗ! Δεν έχουν δηλωθεί ακόμη τακτικοί ή περιοδικοί έλεγχοι εξοπλισμού.";
	}else{
		$elegxoi .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
		$elegxoi .= "<tr><td>α/α</td><td>Τύπος ελέγχου</td><td>Ημερομηνία ελέγχου</td><td>Ονομ/νο ελεγκτή</td><td>Ειδικότητα ελεγκτή</td><td>Παρατηρήσεις</td></tr>";
		
		$i=1;
		foreach($data_elegxoi as $data){
			$elegxoi .= "<tr>";
			$elegxoi .= "<td>".$i."</td>";
			$elegxoi .= "<td>".$data["type"]."</td>";
			$elegxoi .= "<td>".$data["date"]."</td>";
			$elegxoi .= "<td>".$data["name"]."</td>";
			$elegxoi .= "<td>".$data["eidikotita"]."</td>";
			$elegxoi .= "<td>".$data["sxolia"]."</td>";
			$elegxoi .= "</tr>";
		$i++;	
		}
		$elegxoi .= "</table>";
	}	
	return $elegxoi;	
}

//Εκτύπωση περιγραφών πηγών κινδύνου.
function print_pigeskindynoy(){
	$database = new medoo(DB_NAME);
	$db_table = "meleti_piges";
	$db_library = "library_pigeskindynoy";
	$db_columns = "*";
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
	$data_piges = $database->select($db_table,$db_columns,$db_parameters);
	$count_piges = $database->count($db_table, $db_parameters);
	
	$piges = "";
	$piges_array = array();
	
		foreach($data_piges as $data){
		array_push($piges_array, $data["type"]);
		}
		
	$piges_array = array_unique($piges_array);
		
		foreach($piges_array as $id){
		$data_library_piges = $database->select("library_pigeskindynoy","*",array("id" => $id));
		$piges .= $data_library_piges[0]["perigrafi"];
		$piges .= "<p style=\"page-break-before:always;\">&nbsp;</p>";	
		}
	
	$piges .= "<p style=\"page-break-before:always;\">&nbsp;</p>";	
	return $piges;	
}


//Εκτύπωση σχεδίου έκτακτης ανάγκης
function print_sxedio(){
	$database = new medoo(DB_NAME);
	$db_table = "meleti_sxedio";
	$db_columns = "*";
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
	$data_sxedio = $database->select($db_table,$db_columns,$db_parameters);
	$count_sxedio = $database->count($db_table, $db_parameters);
	$count_eidikotites = $database->count("library_eidikotiteserg");
	
	if ($count_sxedio==0){
	$sxedio .= "ΠΡΟΣΟΧΗ! Δεν έχει καταρτιστεί ακόμα σχέδιο ασφαλείας σε περίπτωση επικίνδυνης κατάστασης.";
	}else{
	$sxedio = "";
	$sxedio .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$sxedio .= "<tr><th>α/α</th><th>Ονοματεπώνυμο/Κατηγορία εργαζομένων</th><th>Ειδικότητα</th><th>Καθήκοντα</th></tr>";
		
		$i=1;
		foreach($data_sxedio as $data){
		
		$sxedio .= "<tr>";
		$sxedio .= "<td>".$i."</td>";
		$sxedio .= "<td>".$data["name"]."</td>";
		
			if($data["type"]<=$count_eidikotites){$table_eidikotites="library_eidikotiteserg";}
			if($data["type"]>$count_eidikotites){$table_eidikotites="user_eidikotiteserg";$data["type"]-=$count_eidikotites;}
			
			$data_eidikotita = $database->select($table_eidikotites,"*",array("id"=>$data["type"]));
		$sxedio .= "<td>".$data_eidikotita[0]["name"]."</td>";
		$sxedio .= "<td>".$data["kathikonta"]."</td>";
		$sxedio .= "</tr>";
		$i++;
		}
	
	$sxedio .= "</table>";	
	}
	return $sxedio;	
}

?>