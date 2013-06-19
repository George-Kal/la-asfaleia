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

//Να εμφανίζονται τα λάθη για να βλέπω τι συμβαίνει - ΟΣΟ ΔΙΑΡΚΕΙ ΤΟ DEVELOPMENT
ini_set('display_errors',1); 
error_reporting(E_ALL);

//Αποθήκευση της χρονικής σήμανσης που ξεκινά να φορτώνει η σελίδα.
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;

//Ορίζω μια μεταβλητή μόνο στις σελίδες που βλέπει ο χρήστης.
// Τα αρχεία php εκτελούνται μόνο εκεί που ορίζεται το INCLUDE_CHECK.
//Έτσι πχ αν ζητήσει κάποιος στο browser το includes/medoo.php αυτό δεν εκτελείται.
define('INCLUDE_CHECK',true);

require("includes/include_check.php");
//Ορίζεται στο medoo.php
//require("includes/connection.php");
require("includes/functions.php");
require("includes/medoo.php");
require("includes/session.php");

require("includes/functions_genika.php");
require("includes/functions_calendar.php");
require("includes/functions_epikindynotita.php");
require("includes/functions_qa.php");
require("includes/functions_vivliothikes.php");

include("includes/forms_user.php");

//Όλη η εφαρμογή βρίσκεται στο αρχείο index.php
//Ανάλογα με τιμή της μεταβλητής _GET["nav"] δηλαδή τη σελίδα που βλέπει ο χρήστης
//γίνεται έλεγχος αν ο χρήστης είναι συνδεδεμένος ή/και έχει επιλέξει και μελέτη εργασίας. 
if (isset($_GET["nav"])){
	if ($_GET["nav"]=="meleti_general" OR $_GET["nav"]=="meleti_ktiria" OR $_GET["nav"]=="meleti_proswpiko" OR $_GET["nav"]=="meleti_programma" OR 
	$_GET["nav"]=="meleti_kindynoi" OR $_GET["nav"]=="meleti_metra" OR $_GET["nav"]=="meleti_qa" OR $_GET["nav"]=="meleti_print"){
	confirm_meleti_isset();
	}
	if ($_GET["nav"]=="user_preferences" OR $_GET["nav"]=="vivliothikes" OR $_GET["nav"]=="nomothesia"){
	confirm_logged_in();
	}
}

//το header της σελίδας
include("includes/header_index.php");
?>

<body>

<style>
	#mapCanvas {
    width: 80%;
    height: 400px;
	}
	#mapCanvas img {
	max-width: none;
	}
	
	#dialog-ktimatologio-link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
	#dialog-ktimatologio-link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
	ul#icons {margin: 0; padding: 0;}
	ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
	ul#icons span.ui-icon {float: left; margin: 0 4px;}
</style>
  
  

<?php
//include("includes/page_top_panel.php");
?>

<div class="pageContent">
<?php
include("includes/page_header.php");
?>
	<div id="main">      
        <div class="container1">
       
	<?php
	if (isset($_GET["nav"])){
		if ($_GET["nav"]=="vivliothikes"){
		include("includes/menu_vivliothikes.php");
		}
		if ($_GET["nav"]=="nomothesia"){
		include("includes/menu_nomothesia.php");
		}
		
		if ($_GET["nav"]=="user_login"){
		include("includes/menu_user_login.php");
		}
		if ($_GET["nav"]=="user_logout"){
		include("includes/menu_user_logout.php");
		}
		if ($_GET["nav"]=="user_preferences"){
		include("includes/menu_user_preferences.php");
		}
		
		if ($_GET["nav"]=="meleti_general"){
		include("includes/menu_meleti_genika.php");
		}
		if ($_GET["nav"]=="meleti_ktiria"){
		include("includes/menu_meleti_ktiria.php");
		}
		if ($_GET["nav"]=="meleti_proswpiko"){
		include("includes/menu_meleti_proswpiko.php");
		}
		if ($_GET["nav"]=="meleti_programma"){
		include("includes/menu_meleti_programma.php");
		}
		if ($_GET["nav"]=="meleti_kindynoi"){
		include("includes/menu_meleti_kindynoi.php");
		}
		if ($_GET["nav"]=="meleti_metra"){
		include("includes/menu_meleti_metra.php");
		}
		if ($_GET["nav"]=="meleti_qa"){
		include("includes/menu_meleti_qa.php");
		}
		if ($_GET["nav"]=="meleti_sxedio"){
		include("includes/menu_meleti_sxedio.php");
		}
		if ($_GET["nav"]=="meleti_entypa"){
		include("includes/menu_meleti_entypa.php");
		}
		if ($_GET["nav"]=="meleti_print"){
		include("includes/menu_meleti_print.php");
		}
	}else{
	include("includes/menu_index.php");
	}
	?>
		</div>

<?php
include("includes/page_footer.php");
?>

	</div>
</div>
</body>
</html>
