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
confirm_admin();
?>
<div class="container-fluid">
	<div class="row-fluid">
	
		<div class="span2">
			    <div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Πηγές κινδύνου</h4>
				Επεξεργασία των πηγών κινδύνου όπως εμφανίζονται στις βιβλιοθήκες και στην επιλογή της εκτίμησης 
				επικινδυνότητας.
				</div>
				
				<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Υποβολή φόρμας περιγραφών</h4>
				Κατά την υποβολή της φόρμας στην καρτέλα "περιγραφή" εξαιτίας του γεγονότος οτι δεν είναι γνωστός ο αριθμός των περιγραφών 
				(τις ορίζει ο χρήστης στην καρτέλα "λίστα διαθέσιμων") υποβάλλεται η φόρμα για ένα κείμενο τη φορά. Αυτή η πρακτική είναι 
				η ιδανική για να μην μεταφέρεται μεγάλος όγκος δεδομένων μέσω POST στο server και αλλάζουν ταυτόχρονα όλες οι γραμμές στον πίνακα 
				"library_pigeskindynoy". Στη συγκεκριμένη περίπτωση αλλάζει μόνο η γραμμή του πίνακα βάση της φόρμας που κατατέθηκε. Το μέγιστο 
				μέγεθος που μπορεί να αποστέλεται μέσω POSΤ στο server που βρίσκεστε είναι: 
				<?php
				echo ini_get('post_max_size');
				?>
				</div>
		</div>
		
		<div class="span10">
			<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Λίστα διαθέσιμων</a></li>
				<li><a href="#tabs-2">Περιγραφή</a></li>
			</ul>
			
			<div id="tabs-1">
			<?php			
				$ped="library_pigeskindynoy";
				$dig="0|0|0|0|0|0|0|0|0|0|0|0|0";
				$tb_name="library_pigeskindynoy";
				$tb_title = "Βιβλιοθήκη - Πηγές κινδύνου";
				$fields="fields: {
					id: {key: true,create: false,edit: false,list: false},
					name: {title: 'Όνομα',width: '70%',listClass: 'center'},
					perigrafi: {create: false,edit: false,list: false}
				}";
				include('includes/jtable_nouser.php');
				
			?>
			</div>
			
			<div id="tabs-2">
			Ανανεώστε τη σελίδα σε κάθε προσθήκη ή αλλαγή στην καρτέλα "Λίστα διαθέσιμων".
			<?php
			$database = new medoo(DB_NAME);
			$tb_meletes = "library_pigeskindynoy";
			$col_meletes = "*";
			$data_libmetra = $database->select($tb_meletes,$col_meletes);
			
			$lib_metra = "<div id=\"tabs-inside\">";
			$lib_metra .= "<ul>";
				foreach($data_libmetra as $data){
				$lib_metra .= "<li><a href=\"#tabs-inside-".$data["id"]."\">".$data["name"]."</a></li>";
				}
			$lib_metra .= "</ul>";
			
				foreach($data_libmetra as $data){
				$lib_metra .= "<div id=\"tabs-inside-".$data["id"]."\">";
				
				$lib_metra .= "<form id=\"form_pigi".$data["id"]."\" action=\"\" method=\"post\">";
				$lib_metra .= "<div id=\"pigi-".$data["id"]."\">";
				$lib_metra .= "<div id=\"container\" style=\"background:#eee;border:1px solid #000000;padding:3px;width:99%;height:610px;\">";
				$lib_metra .= "<textarea name=\"text_pigi".$data["id"]."\" id=\"text_pigi".$data["id"]."\" >".$data["perigrafi"]."</textarea>";
				$lib_metra .= "<script type=\"text/javascript\">CKEDITOR.replace('text_pigi".$data["id"]."');</script>";
				$lib_metra .= "</div>";
				$lib_metra .= "</div>";
				$lib_metra .= "<input type=\"hidden\" name=\"id_pigi\" value=\"".$data["id"]."\"><br/>";
				$lib_metra .= "<button type=\"submit\" name=\"submit\" value=\"save-pigi".$data["id"]."\" class=\"btn btn-primary\">Τροποποίηση ".$data["name"]."</button> ";
				$lib_metra .= "</form>";
				$lib_metra .= "</div>";
				}
			
			$lib_metra .= "</div>";
			
			echo $lib_metra;
			?>
			</div>
		
		
			</div>
		</div>
	</div>
</div>
