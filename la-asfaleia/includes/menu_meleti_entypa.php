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
confirm_logged_in();
?>
<div class="container-fluid">
	<div class="row-fluid">
	
				<div class="span2">
		<form id="create_teyxos" action="" method="post">
		<button type="submit" name="submit" value="create-entypa" class="btn btn-danger">Δημιουργία από πρότυπα</button>
		</form>
		<br/>
			    <div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Έντυπα</h4>
				Κατά την πρώτη εμφάνιση της σελίδας δημιουργούνται και αποθηκεύονται τα έντυπα στη μελέτη σας από τα πρότυπα έντυπα. 
				Τα έντυπα παραμένουν αποθηκευμένα στη μελέτη σας για να πραγματοποιήσετε όποιες αλλαγές θέλετε. <br/><br/>
				Αφού πραγματοποιήσετε τις αλλαγές στα κείμενα των εντύπων πατήστε το πλήκτρο "Αποθήκευση" 
				για να αποθηκευτούν τα διορθωμένα έντυπα στη μελέτη σας.<br/><br/>
				Εάν πραγματοποιήσετε αλλαγές σε άλλη ενότητα της μελέτης σας (πχ αλλάξετε το πρόγραμμα του Τ.Α.) 
				θα πρέπει να επαναδημιουργήσετε τα έντυπα σας πατώντας το κουμπί "Δημιουργία από πρότυπα" ώστε να 
				εμφανιστούν τα νέα στοιχεία στα κείμενα των εντύπων. <br/><br/>
				Οποιαδήποτε στιγμή σας ικανοποιεί το αποτέλεσμα μπορείτε να τυπώσετε τα έντυπα πατώντας στο πλήκτρο 
				"Εκτύπωση" ή "Προεπισκόπηση".
				</div>
				<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Προσοχή!</h4>
				Πατώντας στο κουμπί "Δημιουργία από πρότυπα" τα έντυπα επαναδημιουργείται ξανά από τα πρότυπα 
				έντυπα προσθέτοντας σε αυτά όλα τα στοιχεία της μελέτης σας. Όσες αλλαγές πραγματοποιήσατε στα 
				έντυπα πριν από αυτή την ενέργεια θα χαθούν και θα ξεκινήσετε να επεξεργάζεστε τα έντυπα από 
				την αρχή.
				</div>
		</div>
		
		<div class="span10">
		<?php
		$database = new medoo(DB_NAME);
		$teyxos_table = "meleti_entypa";
		$protypo_table = "library_entypa";
		$db_columns = "*";
		$where_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
		$count_teyxos = $database->count($teyxos_table, $where_parameters);
		
		//Επιλογή του πρότυπου τεύχους
		$select_protypo = $database->select($protypo_table,$db_columns);
		

		//εάν δεν υπάρχουν οι γραμμές των εντύπων για τη μελέτη->δημιουργία
		if ($count_teyxos==0){
			foreach($select_protypo as $protypo){
			$insert_parameters = array (
				"user_id" => $_SESSION['user_id'],
				"meleti_id" => $_SESSION['meleti_id'],
				"type" => $protypo["type"],
				"name" => $protypo["name"],
				"text" => $protypo["text"]
				);
			$insert_teyxos = $database->insert($teyxos_table,$insert_parameters);
			}
		include("includes/update_entypa.php");	
		}

		$select_teyxos = $database->select($teyxos_table,$db_columns,$where_parameters);
		
		?>
		<div id="tabs">
			<ul>
		<?php
		
			foreach($select_teyxos as $teyxos){
			echo "<li><a href=\"#entypo-".$teyxos["type"]."\">".$teyxos["name"]."</a></li>";
			}
			echo "</ul>";
			echo "<form id=\"form_kefalaia\" action=\"\" method=\"post\">";
			
			foreach($select_teyxos as $teyxos){
			
			echo "<div id=\"entypo-".$teyxos["type"]."\">";
			echo "<div id=\"container\" style=\"background:#eee;border:1px solid #000000;padding:3px;width:99%;height:610px;\">";
			echo "<textarea name=\"text_entypo".$teyxos["type"]."\" id=\"text_entypo".$teyxos["type"]."\" >".$teyxos["text"]."</textarea>";
			echo "<script type=\"text/javascript\">CKEDITOR.replace('text_entypo".$teyxos["type"]."');</script>";
			echo "</div>";
			echo "</div>";
			
			}
			echo "<button type=\"submit\" name=\"submit\" value=\"save-entypa\" class=\"btn btn-primary\">Αποθήκευση</button> ";
			echo"</form>";
			
		?>
		
		
			</div>
		</div>
	</div>
</div>