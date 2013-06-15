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
				<h4>Προσωπικό</h4>
				Προσωπικό περιγραφή βοήθειας
				</div>
		</div>
		
		<div class="span10">
			<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Προσωπικό</a></li>
				<li><a href="#tabs-2">Υπεύθυνοι</a></li>
				<li><a href="#tabs-3">Σύνολο εργαζομένων</a></li>
			</ul>
			
			<div id="tabs-1">
			<?php 
				$ped="meleti_proswpiko";
				$dig="0|0|0|0|0|0|0|0|0|0|0|0|0";
				$tb_name="meleti_proswpiko";
				$tb_title = "Εργαζόμενοι";
				$fields="fields: {
					id: {key: true,create: false,edit: false,list: false},
					user_id: {create: false,edit: false,list: false},
					meleti_id: {create: false,edit: false,list: false},
					ktirio_id: {title: 'Κτίριο',width: '20%',listClass: 'center',options: ".getktiria()."},
					ar_ergazomenoi: {title: 'Αρ. εργαζομένων',width: '20%',listClass: 'center'},
					type_ergazomenoi: {title: 'Ειδικότητα',width: '20%',listClass: 'center',options:".get_eidikotitaerg()."},
					gender: {title: 'Φύλλο-Ηλ. ομάδα',width: '20%',listClass: 'center', type: 'radiobox',options: 
						{
						'1':'Άνδρες',
						'2':'Γυναίκες',
						'3':'<18 ετών'
						}},	
					apasxolisi: {title: 'Απασχόληση',width: '20%',listClass: 'center',options: 
						{
						'1':'Πλήρης απασχόληση',
						'2':'Μερική απασχόληση',
						'1':'Ορισμένου χρόνου'
						}}
				}";
				include('includes/jtable.php');
			?>	
			</div>
			
			<div id="tabs-2"> 
			<?php 
				$ped="meleti_ypeythinos";
				$dig="0|0|0|0|0|0|0|0|0|0|0|0|0";
				$tb_name="meleti_ypeythinos";
				$tb_title = "Υπεύθυνοι επιχείρησης (δεν προσμετρώνται στο συνολικό αριθμο εργαζομένων)";
				$fields="fields: {
					id: {key: true,create: false,edit: false,list: false},
					user_id: {create: false,edit: false,list: false},
					meleti_id: {create: false,edit: false,list: false},
					ktirio_id: {title: 'Κτίριο',width: '10%',listClass: 'center',options: ".getktiria()."},
					type: {title: 'Είδος υπευθύνου',width: '20%',listClass: 'center',options: 
						{
						'1':'Διευθυντής',
						'2':'Υπεύθυνος προσωπικού',
						'3':'Συντηρητής εξοπλισμού',
						'4':'Συντηρητής Π.Υ. μέσων',
						'5':'Ιατρός εργασίας'
						}},
					onoma: {title: 'Όνομα',width: '20%',listClass: 'center'},
					pateras: {title: 'Ον. Πατρός',width: '10%',listClass: 'center'},
					mitera: {title: 'Ον. Μητέρας',width: '10%',listClass: 'center'},
					address: {title: 'Διεύθυνση',width: '10%',listClass: 'center'},
					tel: {title: 'Τηλέφωνο',width: '10%',listClass: 'center'},
					taytotita: {title: 'ΑΔΤ',width: '10%',listClass: 'center'},
					afm: {title: 'ΑΦΜ',width: '10%',listClass: 'center'}
				}";
				include('includes/jtable.php');
			?>
			</div>
			
			
			<div id="tabs-3">
			<img src="images/extras.png"><br/>
			Ανανεώστε τη σελίδα σε κάθε αλλαγή στην καρτέλα "Προσωπικό" και "Υπεύθυνοι".<br/><br/>
			Έχετε δηλώσει:<br/>
			<?php
			echo count_ergazomenoi()." εργαζομένους στην επιχείρηση<br/>";
			echo count_ypeythinoi()." υπευθύνους στην επιχείρηση<br/>";
			?>
			</div>
			
			</div>
		</div>
	</div>
</div>
