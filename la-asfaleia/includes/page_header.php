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
?>
<div class="navbar">
<div class="navbar-inner">
<div class="container">
 
<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</a>
 
<!-- Be sure to leave the brand out there if you want it shown -->
<a class="brand" href="index.php"><img src="images/logo.png">la-asfaleia v. 
<?php
echo APPLICATION_VERSION;
?>
</a>
 
<!-- Everything you want hidden at 940px or less, place within here -->
<div class="nav-collapse collapse">
<!-- .nav, .navbar-search, .navbar-form, etc -->
    <ul class="nav">
	
	<?php
	if (!isset($_GET['nav'])){
	?>
    <li class="active">
	<?php
	}else{
	?>
	<li>
	<?php
	}
	?>
	
    <a href="index.php">Αρχική</a>
    </li>
	<?php
	if (isset($_GET['nav']) AND $_GET['nav']=="vivliothikes"){
	?>
    <li class="active">
	<?php
	}else{
	?>
	<li>
	<?php
	}
	?>
	<a href="?nav=vivliothikes">Βιβλιοθήκες</a></li>
	
	<?php
	if (isset($_GET['nav']) AND $_GET['nav']=="nomothesia"){
	?>
    <li class="active">
	<?php
	}else{
	?>
	<li>
	<?php
	}
	?>
    <a href="?nav=nomothesia">Νομοθεσία</a></li>
    </ul>
	
	<div class="btn-group">
    <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#">
    <?php 
	if (isset($_SESSION['username'])){
	echo $_SESSION['username'];
	}else{
	echo 'Επισκέπτης';
	}
	?>
    <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
	<?php
	if (isset($_SESSION['username'])){
	?>
    	<li><a tabindex="-1" href="?nav=user_login"><i class="icon-pencil"></i>Μελέτες</a></li>
		<li><a tabindex="-1" href="?nav=user_preferences"><i class="icon-wrench"></i>Λογαριασμός</a></li>
		<?php
		if(confirm_admin()){
		?>
		<li><a tabindex="-1" href="admin.php"><i class="icon-leaf"></i>Διαχειριστής</a></li>
		<?php
		}
		?>
		<li class="divider"></li>
		<li><a tabindex="-1" href="?logoff"><i class="icon-off"></i>Αποσύνδεση</a></li>
	<?php
	}else{
	?>
		<li><a tabindex="-1" href="?nav=user_login"><i class="icon-pencil"></i>Σύνδεση</a></li>
	<?php
	}
	?>
    </ul>
    </div>
	
	
	<?php
	if (isset($_SESSION['username'])){
	?>
	<div class="btn-group">
    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
	<?php
	if (isset($_SESSION['meleti_id'])){
	echo $_SESSION['meleti_name'];
	}else{
	echo "Μελέτη";
	}
	?>
    <span class="caret"></span>
    </a>
		<ul class="dropdown-menu">	
		<?php
		if (isset($_SESSION['meleti_id'])){
		?>
			<li><a tabindex="-1" href="?nav=meleti_general"><i class="icon-map-marker"></i>Γενικά στοιχεία</a></li>
			<li><a tabindex="-1" href="?nav=meleti_ktiria"><i class="icon-home"></i>Κτίρια</a></li>
			<li><a tabindex="-1" href="?nav=meleti_proswpiko"><i class="icon-user"></i>Προσωπικό</a></li>
			<li><a tabindex="-1" href="?nav=meleti_programma"><i class="icon-list-alt"></i>Προγραμμα εργασίας</a></li>
			<li><a tabindex="-1" href="?nav=meleti_kindynoi"><i class="icon-warning-sign"></i>Πηγές κινδύνου</a></li>
			<li><a tabindex="-1" href="?nav=meleti_metra"><i class="icon-ok-sign"></i>Μέτρα πρόληψης</a></li>
			<li><a tabindex="-1" href="?nav=meleti_sxedio"><i class="icon-fire"></i>Σχέδιο έκτακτης ανάγκης</a></li>
			<li><a tabindex="-1" href="?nav=meleti_qa"><i class="icon-list-alt"></i>Ερωτηματολόγια</a></li>
			<li class="divider"></li>
			<li><a tabindex="-1" href="?nav=meleti_entypa"><i class="icon-print"></i>Έντυπα</a></li>
			<li><a tabindex="-1" href="?nav=meleti_print"><i class="icon-print"></i>Εκτύπωση</a></li>
		<?php
		}else{
		?>
			<li><a tabindex="-1" href="?nav=user_login"><i class="icon-home"></i>Επιλογή μελέτης</a></li>
		<?php
		}
	}
	?>
    </ul>
    </div>
    
	
</div>
 
</div>
</div>
</div>

