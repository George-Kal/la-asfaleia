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
				<h4>Μέτρα πρόληψης ατυχημάτων</h4>
				Προσθέστε πρόσθετα μέτρα πρόληψης. Αυτά ενδεχομένως να μην έχουν προβλεφθεί με βάση τις πηγές κινδύνου που 
				ορίστηκαν στην περιοχή "Πηγές Κινδύνων" του λογισμικού. Κάθε γραμμή στον πίνακα μεταφέρεται αυτούσια στον 
				πίνακα των ειδικών μέτρων πρόληψης για το κάθε κτίριο στο τεύχος της μελέτης.
				<br/><br/><br/><br/><br/><br/><br/>
				</div>
		</div>
		
		<div class="span10">
			<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Μέτρα</a></li>
				<li><a href="#tabs-2" onclick="get_metra();">Προεπισκόπηση</a></li>
			</ul>
			
			<div id="tabs-1">
			<?php 
				$ped="meleti_metra";
				$dig="0|0|0|0|0|0|0|0|0|0|0|0|0";
				$tb_name="meleti_metra";
				$tb_title = "Πρόσθετα μέτρα πρόληψης";
				$fields="fields: {
					id: {key: true,create: false,edit: false,list: false},
					user_id: {create: false,edit: false,list: false},
					meleti_id: {create: false,edit: false,list: false},
					ktirio_id: {title: 'Κτίριο',width: '10%',listClass: 'center',options: ".getktiria()."},
					ergasia: {title: 'Επικίνδυνη εργασία<a href=\"#ergasia_popup\" role=\"button\" data-toggle=\"modal\"><img src=\"images/help.png\"></a>',width: '30%',listClass: 'center', type: 'textarea'},
					kindynos: {title: 'Πιθανός κίνδυνος<a href=\"#kindynos_popup\" role=\"button\" data-toggle=\"modal\"><img src=\"images/help.png\"></a>',width: '30%',listClass: 'center', type: 'textarea'},
					protasi: {title: 'Πρόταση βελτίωσης<a href=\"#protasi_popup\" role=\"button\" data-toggle=\"modal\"><img src=\"images/help.png\"></a>',width: '30%',listClass: 'center', type: 'textarea'}
				}";
				include('includes/jtable.php');
			?>

<!-- ######################### Κρυφό div για εμφάνιση ######################### -->			
<div id="ergasia_popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Επικίνδυνη εργασία</h3>
</div>
<div class="modal-body">
<p>
Περιγράψτε την επικίνδυνη εργασία όπως θέλετε να εμφανίζεται στο τεύχος. <br/><br/>
Μπορείτε να παρουσιάσετε επικίνδυνες καταστάσεις σε σύντομο κείμενο, μετρήσεις συνθηκών (θορύβου, χημικών ουσιών κλπ) 
και να περιγράψετε στο επόμενο κελί προτεινόμενα μέτρα.<br/><br/>
(πχ η τιμή θορύβου πλησίον της πακεταριστικής μηχανής βρέθηκε στα 85db)<br/><br/>
Αυτή η διαδικασία είναι απαραίτητη αν στην εκτίμηση επικινδυνότητας (Πηγές κινδύνου) κρίθηκε απαραίτητη βάση της τιμής R η 
λήψη μέτρων.
</p>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

<!-- ######################### Κρυφό div για εμφάνιση ######################### -->			
<div id="kindynos_popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Ενδεχόμενος κίνδυνος</h3>
</div>
<div class="modal-body">
<p>
Περιγράψτε τον ενδεχόμενο κίνδυνο. <br/><br/>
(πχ προβλήματα στην ακοή, κώφωση κλπ)<br/><br/>
</p>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

<!-- ######################### Κρυφό div για εμφάνιση ######################### -->			
<div id="protasi_popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Πρόταση βελτίωσης</h3>
</div>
<div class="modal-body">
<p>
Προτείνετε μέτρα για την εξάλειψη του ενδεχόμενου κινδύνου ή/και την προστασία των εργαζομενων από την επικίνδυνη κατάσταση. <br/><br/>
(πχ χρήση ωτοασπίδων από τον χειριστή)<br/><br/>
</p>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

			</div>
			
			<div id="tabs-2"> 
			<div id="check_metra"></div>
			<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/ajax-loader.gif"></div>
			<script>
			function get_metra(){
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("check_metra").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				}}
				xmlhttp.open("GET","includes/functions_epikindynotita.php?metra=1",true);
				xmlhttp.send();
			}
			get_metra();
			</script>
<!--
			<?php
			echo print_metraprolipsis();
			?>
-->
			</div>
		
		
			</div>
		</div>
	</div>
</div>
