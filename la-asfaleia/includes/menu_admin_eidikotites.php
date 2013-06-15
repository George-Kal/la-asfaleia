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
				<h4>Ειδικότητες</h4>
				Προσθέστε ή αφαιρέστε ειδικότητες από τη λίστα.
				</div>
		</div>
		
		<div class="span10">
			<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Ειδικότητες μηχανικών</a></li>
				<li><a href="#tabs-2">Ειδικότητες εργαζομένων</a></li>
			</ul>
			
			<div id="tabs-1">
			<?php 
				$ped="library_eidikotites";
				$dig="0|0|0|0|0|0|0|0|0|0|0|0|0";
				$tb_name="library_eidikotites";
				$tb_title = "Ειδικότητες μηχανικών";
				$fields="fields: {
					id: {key: true,create: false,edit: false,list: false},
					name: {title: 'Τίτλος<a href=\"#titlos_popup\" role=\"button\" data-toggle=\"modal\"><img src=\"images/help.png\"></a>',width: '60%',listClass: 'center'},
					cando: {title: 'Μπορεί να αναλάβει<a href=\"#cando_popup\" role=\"button\" data-toggle=\"modal\"><img src=\"images/help.png\"></a>',width: '40%',listClass: 'center'}
				}";
				include('includes/jtable_nouser.php');
			?>

			<!-- ######################### Κρυφό div για εμφάνιση ######################### -->			
			<div id="titlos_popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Τίτλος</h3>
			</div>
			<div class="modal-body">
			<p>
			Το όνομα της ειδικότητας του μηχανικού. <br/><br/>
			</p>
			</div>
			<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
			</div>
			</div>
			<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

			<!-- ######################### Κρυφό div για εμφάνιση ######################### -->			
			<div id="cando_popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Ανάληψη καθηκόντων</h3>
			</div>
			<div class="modal-body">
			<p>
			Τι μπορεί να αναλάβει ως Τ.Α. η συγκεκριμένη ειδικότητα. Τιμές διαχωρισμένες με κόμμα των κωδικών 
			της <a href="index.php?nav=vivliothikes#tabs-1">κατηγορίας επιχείρησης</a>.<br/><br/>
			(πχ: 11,12,13,14,15)
			</p>
			</div>
			<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
			</div>
			</div>
			<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

			
			</div>
			
			<div id="tabs-2">
			<?php
				$ped="library_eidikotiteserg";
				$dig="0|0|0|0|0|0|0|0|0|0|0|0|0";
				$tb_name="library_eidikotiteserg";
				$tb_title = "Ειδικότητες εργαζομένων";
				$fields="fields: {
					id: {key: true,create: false,edit: false,list: false},
					name: {title: 'Τίτλος',width: '60%',listClass: 'center'},
					map: {title: 'ΜΑΠ',width: '60%',listClass: 'center', type:'textarea'}
				}";
				include('includes/jtable_nouser.php');	
			?>
			</div>
			
			
		
			</div>
		</div>
	</div>
</div>
