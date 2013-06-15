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

require("includes/include_check.php");
?>
<div class="container1 footer">
Το λογισμικό αυτό υλοποιήθηκε με ελεύθερο λογισμικό και διατίθεται ελεύθερα με τους όρους της <a href="http://fsfe.org/projects/gplv3/gplv3.el.html" target="_blank">GPLv3 αδείας</a>. 
Στο λογισμικό περιέχονται βιβλιοθήκες (js,css,php class) που διατίθενται σύμφωνα με την άδεια <a href="http://www.apache.org/licenses/LICENSE-2.0.html" target="_blank">apache2</a> είτε με την 
άδεια <a href="http://opensource.org/licenses/MIT" target="_blank">ΜΙΤ</a>. Και οι 2 άδειες θεωρούνται "gplv3 compatible". Μπορούν να περιέχονται σε λογισμικό που διανέμεται 
με την GPLv3 (όχι όμως το αντίστροφο για την Apache).<br/>
<?php
//Στηρίξτε τον δημιουργό. Διατηρήστε το footer αυτούσιο.
echo APPLICATION_NAME." v.".APPLICATION_VERSION." - Λάμπρος Καρούντζος";

$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo "Η σελίδα φόρτωσε σε ".$total_time." δευτερόλεπτα.";

?>

</div>