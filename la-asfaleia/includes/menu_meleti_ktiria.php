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
confirm_logged_in();
?>
<div class="container-fluid">
	<div class="row-fluid">
	
		<div class="span2">
			    <div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Κτίρια</h4>
				Δηλώστε τις κτιριακές εγκαταστάσεις της επιχείρησης. Αυτό το βήμα είναι βασικό 
				για τη συνέχεια καθώς θα χρειαστεί να δηλώσετε εργαζομένους, πηγές κινδύνου και 
				προτεινόμενα μέτρα σε κάθε κτίριο στα επόμενα τμήματα του λογισμικού.
				</div>
				<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Έντυπα</h4>
				Εμφανίζεται ποιό έντυπο θα πρέπει να κατατεθεί στο ΣΕΠΕ για τη θεώρηση της σύμβασης. <br/><br/>
				Εφόσον δηλώσετε τον αριθμό των εργαζομένων και το πρόγραμμα του Τ.Α. και του Ι.Ε. (εάν απαιτείται) 
				το ανάλογο έντυπο δημιουργείται αυτόματα στο μενού "Έντυπα".
				</div>
		</div>
		
		<div class="span10">
			<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Κτίρια</a></li>
				<li><a href="#tabs-2">Έντυπα</a></li>
			</ul>
			
			<div id="tabs-1">
			<?php 
				$ped="meleti_ktiria";
				$dig="0|0|0|0|0|0|0|0|0|0|0|0|0";
				$tb_name="meleti_ktiria";
				$tb_title = "Κτίρια/Υποκαταστήματα Επιχείρησης";
				$fields="fields: {
					id: {key: true,create: false,edit: false,list: false},
					user_id: {create: false,edit: false,list: false},
					meleti_id: {create: false,edit: false,list: false},
					name: {title: 'Όνομα',width: '20%',listClass: 'center'},
					kentriko: {title: 'Κεντρικό/Υποκατάστημα',width: '30%',listClass: 'center',options: 
						{
						'1':'Κεντρικό',
						'2':'Υποκατάστημα',
						'3':'Εξωτερικός χώρος εργασίας'
						}},
					address: {title: 'Διεύθυνση',width: '30%',listClass: 'center'},	
					xrisi: {title: 'Χρήση κτιρίου',width: '20%',listClass: 'center',options: 
						{
						'1':'Της επιχείρησης',
						'2':'Γραφεία',
						'3':'Αποθήκη'
						}}
				}";
				include('includes/jtable.php');
			?>
			
			</div>
			
			<div id="tabs-2"> 
			<img src="images/extras.png"><br/>
			<i>(ανανεώστε τη σελίδα όταν προσθέσετε όλα τα κεντρικά καταστήματα και υποκαταστήματα της επιχείρησης)</i><br/><br/>
			Σύμφωνα με τον αριθμό των κτιρίων που δηλώσατε για την επιχείρηση θα πρέπει να κατατεθεί το έντυπο:<br/>
			<?php
			$ktiria = count_ktiria();
			if($ktiria==0){$text_entypo = "<font color=\"red\">Δηλώστε πρώτα ένα τουλάχιστον κτίριο στην επιχείρηση</font>";}
			if($ktiria==1){$text_entypo = "<font color=\"green\">Έντυπο 1</font>";}
			if($ktiria>1){$text_entypo = "<font color=\"green\">Έντυπο 2</font>";}
			echo $text_entypo;
			?>
			</div>
		
		
			</div>
		</div>
	</div>
</div>
