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
		<img src="images/library.png"><br/>
		</div>
		
		<div class="span10">
		
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Κατηγορίες</a></li>
				<li><a href="#tabs-2">Ωράριο</a></li>
				<li><a href="#tabs-3">Επιθεωρήσεις</a></li>
				<li><a href="#tabs-4">Πηγές κινδύνου</a></li>
				<li><a href="#tabs-5">Ερωτηματολόγια</a></li>
			</ul>
			
			<div id="tabs-1">
				<?php
				echo create_industry_cat();
				?>
			</div>
			
			<div id="tabs-2"> 
			<b>Ελάχιστες ώρες εργασίας Τ.Α. και Ι.Ε.</b><br/>
				<table border="1" class="table table-bordered table-hover">
				<tr><td>Αριθμός εργαζομένων</td><td>Τεχνικός ασφάλειας</td><td>Γιατρός εργασίας</td></tr>
				<tr><td colspan="3" bgcolor="CCFF33">ΚΑΤΗΓΟΡΙΑ Α</td></tr>
				<tr><td>έως 500</td><td>3.5</td><td>0.8</td></tr>
				<tr><td>501 έως 1000</td><td>3</td><td>0.8</td></tr>
				<tr><td>1001 έως 5000</td><td>2.5</td><td>0.8</td></tr>
				<tr><td>5001 και άνω</td><td>2</td><td>0.8</td></tr>
				<tr><td colspan="3" bgcolor="CC9933">ΚΑΤΗΓΟΡΙΑ Β</td></tr>
				<tr><td>έως 1000</td><td>2.5</td><td>0.6</td></tr>
				<tr><td>1001 έως 5000</td><td>1.5</td><td>0.6</td></tr>
				<tr><td>5001 και άνω</td><td>1.0</td><td>0.6</td></tr>
				<tr><td colspan="3" bgcolor="CC0033">ΚΑΤΗΓΟΡΙΑ Γ</td></tr>
				<tr><td>-</td><td>0.4</td><td>0.4</td></tr>
				</table>
				<br/><br/>
				Σε κάθε περίπτωση και για κάθε κατηγορία επικινδυνότητας δραστηριοτήτων οι ώρες απασχόλησης ΤΑ και ΙΕ δεν μπορεί να είναι μικρότερες από:
				<table border="1">
				<tr><td>Αριθμός εργαζομένων</td><td>Τεχνικός ασφάλειας</td><td>Γιατρός εργασίας</td></tr>
				<tr><td>μέχρι 20</td><td>25 ώρες</td><td>25 ώρες</td></tr>
				<tr><td>Από 21-50</td><td>50 ώρες</td><td>50 ώρες</td></tr>
				<tr><td>Άνω των 50</td><td>75 ώρες</td><td>75 ώρες</td></tr>
				</table>
			</div>
			
			<div id="tabs-3">
			<b>Διαδικασία ελέγχων</b><br/>
			Βάση νομοθεσίας κάθε επιχείρηση πρέπει να καθιερώνει και να τηρεί διαδικασίες για τη συνεχή αναγνώριση των κινδύνων, την εκτίμηση της επικινδυνότητας 
			και την εφαρμογή των απαραίτητων μέτρων επιθεώρησης και ελέγχου.<br/>
			Κατά την επιθεώρηση από τον Τ.Α. πρέπει να ελέγχονται τουλάχιστον:
			<ul>
			<li>Οι εργασίες που λαμβάνουν χώρα και συμμετέχει το προσωπικό</li>
			<li>Οι χώροι και οι εγκαταστάσεις</li>
			</ul><br/>
			Παράλληλα - αλλά όχι υποχρεωτικά - η επιχείρηση μπορεί να ζητήσει τη διενέργεια εξωτερικού ελέγχου από τρίτο οργανισμό. Ένας τέτοιος έλεγχος είναι 
			και η επιθεώρηση από το ΣΕΠΕ ή από άλλο φορέα ή ο έλεγχος από διαπιστευμένους φορείς σχετικά με τον έλεγχο ποιότητας των προϊόντων (πχ ISO,TUV).<br/><br/>
			Ο επιτόπιος έλεγχος (προγραμματισμένος ή μη) σε μια επιχείρηση μπορεί να πραγματοποιηθεί οπτικά από τον Τ.Α. με χρήση πινάκων ελέγχου (check lists) 
			οι οποίοι είναι στην πράξη ερωτηματολόγια τα οποία οφείλει να απαντήσει ο Τ.Α. ώστε να έχει πλήρη γνώση των δεδομένων για την επιχείρηση. Για να 
			απαντήσει ο Τ.Α. αυτές τις λίστες ελέγχου απαιτείται να ενημερωθεί για τις δραστηριότητες στην επιχείρηση (παραγωγική διαδικασία κ.α.) να συνομιλήσει 
			με τους εργαζόμενους της επιχείρησης, να διερευνήσει παραμέτρους της παραγωγικής διαδικασίας κ.α. Η προσθήκη των δεδομένων που έχει ο Τ.Α. σε λίστες 
			ελέγχου βοηθά στην καταγραφή των σημείων που πρέπει να καλυφθούν και στην αναφορά του τι έχει ήδη καλυφθεί. Έτσι μπορεί να επανέρχεται ο Τ.Α. σε 
			επόμενους ελέγχους και να συμπληρώνει νέες ερωτήσεις.<br/><br/>
			
			
			
			</div>
			
			<div id="tabs-4">
			<b>Πηγές κινδύνων</b><br/>
				<?php
				echo create_library_piges();
				?>
			</div>
			
			<div id="tabs-5"> 
			
			</div>
		
		
			</div>
		</div>
	</div>
</div>

