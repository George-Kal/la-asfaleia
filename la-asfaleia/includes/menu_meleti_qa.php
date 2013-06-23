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
				<h4>Ερωτηματολόγια</h4>
				Ερωτηματολόγια περιγραφή βοήθειας
				<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
				<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
				</div>
		</div>
		
		<div class="span10">
			<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Ερωτηματολόγια</a></li>
				<li><a href="#tabs-2" onclick="get_qa();">Προεπισκόπηση</a></li>
			</ul>
			
			<div id="tabs-1">
			<?php 
				$ped="meleti_qa";
				$dig="0|0|0|0|0|0|0|0|0|0|0|0|0";
				$tb_name="meleti_qa";
				$tb_title = "Ερωτήσεις";
				$fields="fields: {
					id: {key: true,create: false,edit: false,list: false},
					user_id: {create: false,edit: false,list: false},
					meleti_id: {create: false,edit: false,list: false},
					question: {title: 'Ερώτηση',width: '70%',listClass: 'center', type: 'textarea'},
					answer_type: {title: 'Τύπος απάντησης',width: '30%',listClass: 'center',options: 
						{
						'1':'Ναί/Όχι',
						'2':'Φύλλο',
						'3':'Ηλικιακή ομάδα',
						'4':'Ημερομηνία/Ώρα',
						'5':'Κλίμακα 5 σημείων',
						'6':'Κλίμακα 10 σημείων',
						'7':'Σύντομο κείμενο',
						'8':'Εκτενές κείμενο'
						}}
				}";
				include('includes/jtable.php');
			?>
			</div>
			
			<div id="tabs-2"> 
			<div id="check_qa"></div>
			<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/ajax-loader.gif"></div>
			<script>
			function get_qa(){
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("check_qa").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				}}
				xmlhttp.open("GET","includes/functions_qa.php?qa=1",true);
				xmlhttp.send();
			}
			get_qa();
			</script>
<!--
			<?php
			echo create_qa();
			?>
-->
			</div>
		
		
			</div>
		</div>
	</div>
</div>
