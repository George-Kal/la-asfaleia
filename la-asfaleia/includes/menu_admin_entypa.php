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
require("include_check.php");
confirm_admin();
?>
<div class="container-fluid">
	<div class="row-fluid">
	
		<div class="span2">
			    <div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Πρότυπα έντυπα</h4>
				Τα πρότυπα έντυπα αποτελείται από 3 έντυπα τα οποία είναι κοινά για όλους τους χρήστες και όλες τις μελέτες τους.<br/><br/>
				Στα κείμενα των εντύπων βρίσκονται "θέσεις" προσθήκης δεδομένων οι οποίες περικλείονται σε αγκύλες με κεφαλαία αγγλική 
				ονομασία ( πχ: {ENTYPA_ONOMAEPIXEIRISIS} ).<br/><br/>
				Στο αρχείο includes/update_entypa.php ορίζεται τι ακριβώς μεταφέρεται σε εκείνες τις θέσεις.
				</div>
				
				<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Αποθήκευση</h4>
				Κατά την αποθήκευση τροποποιούνται όλα τα έντυπα ταυτόχρονα επομένως μπορείτε να πραγματοποιήσετε αλλαγές σε 2 ή περισσότερα 
				έντυπα και έπειτα να αποθηκεύσετε τα πρότυπα. Κάθε φορά που τροποποιείτε κάτι  αυτό είναι άμεσα 
				διαθέσιμο σε όλους τους χρήστες του λογισμικού και για όλες τις μελέτες τους. <br/><br/>
				Το μέγιστο μέγεθος που μπορεί να αποστέλεται μέσω POSΤ στο server που βρίσκεστε είναι: 
				<?php
				echo ini_get('post_max_size');
				?>
				</div>
				
				<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>ΠΡΟΣΟΧΗ:</h4>
				Η τροποποίηση των πρότυπων εντύπων δεν επηρρεάζει τα ήδη δημιουργημένα έντυπα των μελετών των χρηστών. Για να ενημερώσουν τα 
				έντυπα των μελετών τους οι χρήστες θα πρέπει να δημιουργήσουν εκ νέου τα έντυπα για κάθε μελέτη τους από το πρότυπο.<br/><br/>
				</div>
		</div>
		
		<div class="span10">
		<?php
		$database = new medoo(DB_NAME);
		$protypo_table = "library_entypa";
		$db_columns = "*";
		$select_protypo = $database->select($protypo_table,$db_columns);
		?>
			<div id="tabs">
			<ul>
			<?php
		
			foreach($select_protypo as $teyxos){
			echo "<li><a href=\"#entypo-".$teyxos["type"]."\">".$teyxos["name"]."</a></li>";
			}
			echo "</ul>";
			echo "<form id=\"form_entypa\" action=\"\" method=\"post\">";
			
			foreach($select_protypo as $teyxos){
			
			echo "<div id=\"entypo-".$teyxos["type"]."\">";
			echo "<div id=\"container\" style=\"background:#eee;border:1px solid #000000;padding:3px;width:99%;height:610px;\">";
			echo "<textarea name=\"text_entypo".$teyxos["type"]."\" id=\"text_entypo".$teyxos["type"]."\" >".$teyxos["text"]."</textarea>";
			echo "<script type=\"text/javascript\">CKEDITOR.replace('text_entypo".$teyxos["type"]."');</script>";
			echo "</div>";
			echo "</div>";
			
			}
			echo "<button type=\"submit\" name=\"submit\" value=\"save-protypaentypa\" class=\"btn btn-primary\">Αποθήκευση Προτύπων</button> ";
			echo"</form>";
			
		?>
			</div>
		
		
			</div>
		</div>
	</div>
</div>
