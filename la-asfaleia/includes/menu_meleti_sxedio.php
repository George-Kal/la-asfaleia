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
			    <div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Σχέδιο έκτακτης ανάγκης</h4>
				Προσθέστε τους εργαζομένους και τα καθήκοντα που έχουν σε περίπτωση έκτακτης ανάγκης όπως σε εκδήλωση πυρκαγιάς. <br/>
				Ο κάθε εργαζόμενος μπορεί να επιφορτιστεί με συγκεκριμένα καθήκοντα ή απλά την εγκατάλειψη του χώρου εργασίας του.
				</div>
		</div>
		
		<div class="span10">
			<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Καθήκοντα</a></li>
				<li><a href="#tabs-2">Προεπισκόπηση</a></li>
			</ul>
			
			<div id="tabs-1">
			<?php 
				$ped="meleti_sxedio";
				$dig="0|0|0|0|0|0|0|0|0|0|0|0|0";
				$tb_name="meleti_sxedio";
				$tb_title = "Σχέδιο έκτακτης ανάγκης";
				$fields="fields: {
					id: {key: true,create: false,edit: false,list: false},
					user_id: {create: false,edit: false,list: false},
					meleti_id: {create: false,edit: false,list: false},
					name: {title: 'Ονοματεπώνυμο/Ομάδα εργαζομένων',width: '40%',listClass: 'center'},
					type: {title: 'Ειδικότητα',width: '20%',listClass: 'center',options:".get_eidikotitaerg()."},
					kathikonta: {title: 'Καθήκοντα',width: '40%',listClass: 'center', type: 'textarea'}
				}";
				include('includes/jtable.php');
			?>
			</div>
			
			<div id="tabs-2"> 
			<?php
			echo print_sxedio();
			?>
			</div>
		
		
			</div>
		</div>
	</div>
</div>
