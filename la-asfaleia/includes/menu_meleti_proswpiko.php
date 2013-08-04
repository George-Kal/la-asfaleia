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
				Δηλώστε τον αριθμό των εργαζομένων, τους υπεύθυνους προσωπικού και τις θέσεις εργασίας.<br/><br/>
				Στους εργαζομένους της επιχείρησης μπορείτε να δηλώσετε ονομαστικά τους εργαζομένους προσθέτοντας για κάθε 
				έναν από αυτούς μία γραμμή και το ονοματεπώνυμό του είτε να προσθέσετε ομάδες εργαζομένων ως μία γραμμή και 
				τον αριθμό τους.<br/><br/>
				Οι υπεύθυνοι προσωπικού δεν προσμετρώνται στον συνολικό αριθμό των εργαζομένων. Εάν κάποιος δηλωμένος 
				εργαζόμενος στον πίνακα προσωπικού της επιχείρησης έχει αναλάβει το ρόλο του υπευθύνου για κάποιο τομέα 
				πχ ο Διευθυντής βρίσκεται στην μισθοδοσία της επιχείρησης τότε πρέπει να προστεθεί και στους εργαζομένους 
				αλλά και στους υπευθύνους.<br/><br/>
				Οι θέσεις εργασίας είναι οι πραγματικοί τομείς ευθύνης του κάθε εργαζόμενου. Δεν δηλώνεται το ονοματεπώνυμο 
				καθώς αποτελεί συνήθη πρακτική σε μία θέση εργασίας να μπορούν να εναλλάσσονται περισσότεροι του ενός εργαζόμενοι.
				</div>
		</div>
		
		<div class="span10">
			<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Προσωπικό</a></li>
				<li><a href="#tabs-2">Υπεύθυνοι</a></li>
				<li><a href="#tabs-3">Θέσεις εργασίας</a></li>
				<li><a href="#tabs-4" onclick="get_proswpiko();">Σύνολο εργαζομένων</a></li>
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
					ktirio_id: {title: 'Κτίριο',width: '10%',listClass: 'center',options: ".getktiria()."},
					ar_ergazomenoi: {title: 'Αρ. εργαζομένων',width: '10%',listClass: 'center'},
					name: {title: 'Ονομ/μο',width: '20%',listClass: 'center'},
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
			<?php 
				$ped="meleti_theseiserg";
				$dig="0|0|0|0|0|0|0|0|0|0|0|0|0";
				$tb_name="meleti_theseiserg";
				$tb_title = "Θέσεις εργασίας";
				$fields="fields: {
					id: {key: true,create: false,edit: false,list: false},
					user_id: {create: false,edit: false,list: false},
					meleti_id: {create: false,edit: false,list: false},
					ktirio_id: {title: 'Κτίριο',width: '10%',listClass: 'center',options: ".getktiria()."},
					perigrafi: {title: 'Περιγραφή',width: '20%',listClass: 'center', type: 'textarea'},
					simansi: {title: 'Σημάνσεις',width: '20%',listClass: 'center', type: 'textarea'},
					kalwdia: {title: 'Ελεύθερα καλώδια',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					dapedo: {title: 'Ολισθηρό δάπεδο',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					fwtismos: {title: 'Φωτισμός',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					thermiko: {title: 'Θερμικό περιβάλλον',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					eksaerismos: {title: 'Εξαερισμός',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					aktinovolies: {title: 'Ακτινοβολίες',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					thorivos: {title: 'Θόρυβος',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					doniseis: {title: 'Δονήσεις',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					ktirio: {title: 'Κτιριολογικές απαιτήσεις',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					pc: {title: 'Εργασία με ΗΥ',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					viologikoi: {title: 'Βιολογικοί παράγοντες',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					ximikoi: {title: 'Χημικοί παράγοντες',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					karkinogonoi: {title: 'Καρκινογόνοι παράγοντες',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					reyma: {title: 'Ηλεκτρικό ρεύμα',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					ekriktika: {title: 'Εκρηκτικές ατμόσφαιρες',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					pyrasfaleia: {title: 'Πυρασφάλεια',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					ypsos: {title: 'Εργασία σε ύψος',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					periorismenoi: {title: 'Περιορισμένοι χώροι',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					xeironaktika: {title: 'Χειρονακτικός χειρισμός φορτίων',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					forita: {title: 'Φορητά εργαλεία',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					syntirisi: {title: 'Συντήρηση - Επισκευές',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					kopi: {title: 'Κοπή μετάλλων',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					peronofora: {title: 'Περονοφόρα-Ανυψωτικά',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					aporimatofora: {title: 'Απορριμματοφόρα',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					klark: {title: 'Κλαρκ',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					oximatametaforas: {title: 'Οχήματα μεταφοράς φορτίου',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					xwmatoyrgika: {title: 'Χωματουργικές εργασίες',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					epivlepseis: {title: 'Επιβλέψεις - Τεχνικά έργα',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					naypigika: {title: 'Ναυπηγικές εργασίες',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					metaleytikalatomika: {title: 'Μεταλευτικές - Λατομικές εργασίες',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					stress: {title: 'Ψυχοκοινωνικοί κίνδυνοι',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}},
					viologikoikathar: {title: 'Βιολογικοί καθαρισμοί',list: false,options: 
						{
						'1':'OXI',
						'2':'NAI',
						}}
				}";
				include('includes/jtable.php');
			?>
			</div>
			
			<div id="tabs-4">
			<table><tr><td style="width:135px;">
			<img src="images/extras.png"><br/></td><td>
<!--			Ανανεώστε τη σελίδα σε κάθε αλλαγή στην καρτέλα "Προσωπικό" και "Υπεύθυνοι".  -->
			<br/><br/>
			Έχετε δηλώσει:<br/>
			<div id="check_proswpiko"></div>
			<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/ajax-loader.gif"></div>
			</td></tr></table>
			<script>
			function get_proswpiko(){
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("check_proswpiko").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				}}
				xmlhttp.open("GET","includes/functions_genika.php?proswpiko=1",true);
				xmlhttp.send();
			}
			get_proswpiko();
			</script>

<!--			
			<?php
			echo count_ergazomenoi()." εργαζομένους στην επιχείρηση<br/>";
			echo count_ypeythinoi()." υπευθύνους στην επιχείρηση<br/>";
			?>
-->			
			</div>
			
			</div>
		</div>
	</div>
</div>
