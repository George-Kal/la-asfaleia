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
<a class="brand" href="admin.php"><img src="images/logo.png">la-asfaleia v. 
<?php
echo APPLICATION_VERSION;
?>
 Διαχείριση
</a>
 
<!-- Everything you want hidden at 940px or less, place within here -->
<div class="nav-collapse collapse">
	<ul class="nav">
	<li><a href="index.php">Επιστροφή στο λογισμικό</a></li>
    </ul>
	
	<div class="btn-group">
    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
	Διαχειριστής
    <span class="caret"></span>
    </a>
		<ul class="dropdown-menu">	
			<li><a tabindex="-1" href="?nav=users"><i class="icon-user"></i>Χρήστες</a></li>
			<li><a tabindex="-1" href="?nav=preferences"><i class="icon-wrench"></i>Προτιμήσεις</a></li>
			<li class="divider"></li>
			<li><a tabindex="-1" href="?nav=nomothesia"><i class="icon-align-justify"></i>Νομοθεσία</a></li>
			<li><a tabindex="-1" href="?nav=categories"><i class="icon-tasks"></i>Κατηγορίες επιχειρήσεων</a></li>
			<li><a tabindex="-1" href="?nav=eidikotites"><i class="icon-certificate"></i>Ειδικότητες</a></li>
			<li><a tabindex="-1" href="?nav=piges"><i class="icon-fire"></i>Πηγές κινδύνου</a></li>
			<li class="divider"></li>
			<li><a tabindex="-1" href="?nav=pentypa"><i class="icon-print"></i>Πρότυπα έντυπα</a></li>
			<li><a tabindex="-1" href="?nav=pteyxos"><i class="icon-print"></i>Πρότυπο τεύχος</a></li>
    </ul>
    </div>
    
	
</div>
 
</div>
</div>
</div>

