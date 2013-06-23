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

***********************************************************************
Tsak mods - Κώστας Τσακίρης - πολιτικός μηχανικός - ktsaki@tee.gr     *
                                                                      *
Τροποποίηση ημερολογίων. Εμφάνιση ανά μήνα			                  *
                                                                      *
***********************************************************************
*/

require("include_check.php");
confirm_logged_in();
?>
<div class="container-fluid">
	<div class="row-fluid">
	
		<div class="span2">
			    <div class="alert alert-info"  id="programma_help_1">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Ωράριο εργασίας Τ.Α.</h4>
				Δηλώστε το πρόγραμμα εργασίας του Τ.Α. και του Ι.Ε.<br/>
				Μπορείτε να δηλώσετε διαφορετικές ημέρες και ώρες σε κάθε υποκατάστημα ή μπορείτε 
				να κατανείμετε το ωράριο σε διαφορετικές ημέρες και ώρες για το ίδιο υποκατάστημα.
				</div>
				
				<div class="alert alert-info" id="programma_help_2">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Πρόγραμμα Τ.Α. και Ι.Ε.</h4>
				Εμφανίζεται το πλήρες πρόγραμμα (αφορά όλες τις μελέτες) του Τ.Α. για το τρέχον έτος. 
				Σε κάθε αλλαγή του προγράμματος απαιτείται ανανέωση της σελίδας για επαναδημιουργία του 
				προγράμματος. <br/><br/>
				Πρέπει να φροντίσετε στην επιλογή του ωραρίου για την τρέχουσα μελέτη αυτό 
				να μην συμπίπτει με το ωράριο που έχει δηλωθεί σε άλλες επιχειρήσεις.
				Βρείτε μία ημέρα που είναι κενή ή ελέξτε το ωράριο για τη μέρα που δηλώνετε.<br/><br/>
				Επίσης φροντίστε κάποιες ημέρες τα προγράμματα Τ.Α. και Ι.Ε. να συμπίπτουν ώστε να ελέγχεται 
				η επιχείρηση με τη συνεργασία των δύο.<br/><br/>
				Μπορείτε να εκτυπώσετε το πρόγραμμα σε pdf. 
				</div>
		</div>
		
		<div class="span10">
			<div id="tabs">
			<ul>
				<li><a href="#tabs-1" onclick="show_help(1);">Ωράριο εργασίας</a></li>
				<li><a href="#tabs-2" onclick="get_calendar('meleti_programma_ta',year_ta,month_ta);show_help(2);">Πρόγραμμα Τ.Α.</a></li>
				<li><a href="#tabs-3" onclick="get_calendar('meleti_programma_ie',year_ie,month_ie);show_help(2);">Πρόγραμμα Ι.Ε.</a></li>
				<li><a href="#tabs-4" onclick="check_times();">Ελάχιστες απαιτήσεις</a></li>
			</ul>
			
			<div id="tabs-1">
			<img src="images/calendar.png"><br/>
			
			<!--
			Ωράριο Τεχνικού Ασφαλείας:
			<form name="wrario_form" action="index.php" method="POST">
			<table class="table table-bordered table-hover">
			<tr>
			<td>Ειδος τεχνικου</td>
			<td>Ναι/Οχι</td>
			<td>Καθε</td>
			<td>Ημερα</td>
			<td>Απο</td>
			<td>Εως</td>
			<td>Ληξη</td>
			</tr>
			<tr>
			<td>T.A.</td>
			<td><input type="checkbox" id="ta_is" name="ta_is"></input></td>
			<td><select id="ta_kathe" name="ta_kathe" class="input-medium">
					<option value="0">Κάθε...</option>
					<option value="1">πρώτη</option>
					<option value="2">δεύτερη</option>
					<option value="3">τρίτη</option>
					<option value="4">τέταρτη</option>
				</select>
			</td>
			<td><select id="ta_mera" name="ta_mera" class="input-medium">
					<option value="0">Ημέρα...</option>
					<option value="1">Δευτέρα</option>
					<option value="2">Τρίτη</option>
					<option value="3">Τετάρτη</option>
					<option value="4">Πέμπτη</option>
					<option value="5">Παρασκευή</option>
				</select>
			</td>
			<td><input type="text" id="ta_timestart" name="ta_timestart" class="input-medium" placeholder="Από (ώρα).."></td>
			<td><input type="text" id="ta_timeend" name="ta_timeend" class="input-medium" placeholder="Έως (ώρα).."></td>
			<td><input type="text" id="ta_datepicker" name="ta_end" class="input-medium" placeholder="Λήξη (Ημ/νία).."></td>
			</tr>
			<tr>
			<td>Ι.Ε.</td>
			<td><input type="checkbox" id="ie_is" name="ie_is"></input></td>
			<td><select id="ie_kathe" name="ie_kathe" class="input-medium">
					<option value="0">Κάθε...</option>
					<option value="1">πρώτη</option>
					<option value="2">δεύτερη</option>
					<option value="3">τρίτη</option>
					<option value="4">τέταρτη</option>
				</select>
			</td>
			<td><select id="ie_mera" name="ie_mera" class="input-medium">
					<option value="0">Ημέρα...</option>
					<option value="1">Δευτέρα</option>
					<option value="2">Τρίτη</option>
					<option value="3">Τετάρτη</option>
					<option value="4">Πέμπτη</option>
					<option value="5">Παρασκευή</option>
				</select>
			</td>
			<td><input type="text" id="ie_timestart" name="ie_timestart" class="input-medium" placeholder="Από (ώρα).."></td>
			<td><input type="text" id="ie_timeend" name="ie_timeend" class="input-medium" placeholder="Έως (ώρα).."></td>
			<td><input type="text" id="ie_datepicker" name="ie_end" class="input-medium" placeholder="Λήξη (Ημ/νία).."></td>
			</tr>
			</table>
			
			<button type="submit" name="submit" value="wrario_ie_submit" class="btn">Αποθηκευση</button>
			</form>	
			-->
				
				<?php 
				$ped="meleti_programma_ta";
				$dig="0|0|0|0|0|0|0|0|0|0|0|0|0";
				$tb_name="meleti_programma_ta";
				$tb_title = "Ωράριο τεχνικού ασφαλείας";
				$fields="fields: {
					id: {key: true,create: false,edit: false,list: false},
					user_id: {create: false,edit: false,list: false},
					meleti_id: {create: false,edit: false,list: false},
					ktirio_id: {title: 'Κτίριο',width: '20%',listClass: 'center',options: ".getktiria()."},
					kathe: {title: 'Κάθε',width: '10%',listClass: 'center',options: 
						{
						'1':'πρώτη',
						'2':'δεύτερη',
						'3':'τρίτη',
						'4':'τέταρτη'
						}},
					day: {title: 'Ημέρα',width: '10%',listClass: 'center',options: 
						{
						'0':'Κυριακή',
						'1':'Δευτέρα',
						'2':'Τρίτη',
						'3':'Τετάρτη',
						'4':'Πέμπτη',
						'5':'Παρασκευή',
						'6':'Σάββατο'
						}},
					time_start: {title: 'Από',width: '20%',listClass: 'center'},
					time_end: {title: 'Μέχρι',width: '20%',listClass: 'center'},
					date_start: {title: 'Αρχή',width: '20%', type: 'date', displayFormat: 'yy-mm-dd', width: '10%', listClass: 'center'},
					date_end: {title: 'Τέλος',width: '20%', type: 'date', displayFormat: 'yy-mm-dd', width: '10%', listClass: 'center'}
				}";
				include('includes/jtable.php');
				
				$ped="meleti_programma_ie";
				$dig="0|0|0|0|0|0|0|0|0|0|0|0|0";
				$tb_name="meleti_programma_ie";
				$tb_title = "Ωράριο Ιατρού εργασίας";
				$fields="fields: {
					id: {key: true,create: false,edit: false,list: false},
					user_id: {create: false,edit: false,list: false},
					meleti_id: {create: false,edit: false,list: false},
					ktirio_id: {title: 'Κτίριο',width: '20%',listClass: 'center',options: ".getktiria()."},
					kathe: {title: 'Κάθε',width: '20%',listClass: 'center',options: 
						{
						'1':'πρώτη',
						'2':'δεύτερη',
						'3':'τρίτη',
						'4':'τέταρτη'
						}},
					day: {title: 'Ημέρα',width: '20%',listClass: 'center',options: 
						{
						'0':'Κυριακή',
						'1':'Δευτέρα',
						'2':'Τρίτη',
						'3':'Τετάρτη',
						'4':'Πέμπτη',
						'5':'Παρασκευή',
						'6':'Σάββατο'
						}},
					time_start: {title: 'Από',width: '20%',listClass: 'center'},
					time_end: {title: 'Μέχρι',width: '20%',listClass: 'center'},
					date_start: {title: 'Αρχή',width: '20%', type: 'date', displayFormat: 'yy-mm-dd', width: '10%', listClass: 'center'},
					date_end: {title: 'Τέλος',width: '20%', type: 'date', displayFormat: 'yy-mm-dd', width: '10%', listClass: 'center'}
				}";
				include('includes/jtable.php');
				?>
				
			</div>
			
			<div id="tabs-2"> 
			<!--Ανανεώστε τη σελίδα σε κάθε αλλαγή στην καρτέλα "ωράριο εργασίας" ώστε να επαναφορτωθεί το πρόγραμμα του Τεχνικού ασφαλείας.<br/>-->
			<div id="meleti_programma_ta0"></div>
			<script>
				var d = new Date();
				month_ta=d.getMonth()+1;
				month_ie=d.getMonth()+1;
				year_ta=d.getFullYear();
				year_ie=d.getFullYear();
				function get_calendar(pinakas,year,month){
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById(pinakas+'0').innerHTML=xmlhttp.responseText;
				}}
				xmlhttp.open("GET","includes/functions_calendar.php?year="+year+"&pinakas="+pinakas+"&month="+month,true);
				xmlhttp.send();
				}
				function next_month_meleti_programma_ta(){
					month_ta += 1;
					if (month_ta>12){month_ta=1;year_ta += 1;}
					get_calendar("meleti_programma_ta",year_ta,month_ta);
				}
				function next_year_meleti_programma_ta(){
					year_ta += 1;
					get_calendar("meleti_programma_ta",year_ta,month_ta);
				}
				function prev_month_meleti_programma_ta(){
					month_ta -= 1;
					if (month_ta<1){month_ta=12;year_ta -= 1;}
					get_calendar("meleti_programma_ta",year_ta,month_ta);
				}
				function prev_year_meleti_programma_ta(){
					year_ta -= 1;
					get_calendar("meleti_programma_ta",year_ta,month_ta);
				}
				function next_month_meleti_programma_ie(){
					month_ie += 1;
					if (month_ie>12){month_ie=1;year_ie += 1;}
					get_calendar("meleti_programma_ie",year_ie,month_ie);
				}
				function this_month_meleti_programma_ta(){
					var d = new Date();
					month_ta=d.getMonth()+1;
					year_ta=d.getFullYear();
					get_calendar("meleti_programma_ta",year_ta,month_ta);
				}
				function this_month_meleti_programma_ie(){
					var d = new Date();
					month_ie=d.getMonth()+1;
					year_ie=d.getFullYear();
					get_calendar("meleti_programma_ie",year_ie,month_ie);
				}
				function next_year_meleti_programma_ie(){
					year_ie += 1;
					get_calendar("meleti_programma_ie",year_ie,month_ie);
				}
				function prev_month_meleti_programma_ie(){
					month_ie -= 1;
					if (month_ie<1){month_ie=12;year_ie -= 1;}
					get_calendar("meleti_programma_ie",year_ie,month_ie);
				}
				function prev_year_meleti_programma_ie(){
					year_ie -= 1;
					get_calendar("meleti_programma_ie",year_ie,month_ie);
				}
				get_calendar("meleti_programma_ta",year_ta,month_ta);
			</script>
			<?php
//			$trexon_y = date("Y");
//			draw_calendar($trexon_y,"meleti_programma_ta",1);
			?>
			</div>
			
			<div id="tabs-3" >
			<!--Ανανεώστε τη σελίδα σε κάθε αλλαγή στην καρτέλα "ωράριο εργασίας" ώστε να επαναφορτωθεί το πρόγραμμα του Ιατρού εργασίας.<br/>-->
			<div id="meleti_programma_ie0"></div>
			<script>
				get_calendar("meleti_programma_ie",year_ie,month_ie);
			</script>
			<?php
//			draw_calendar($trexon_y,"meleti_programma_ie",1);
			?>
			</div>
			
			<div id="tabs-4">
			<table><tr><td style="width:135px;">
			<img src="images/extras.png"><br/></td><td>
			Εδώ αναγράφονται οι ελάχιστες ώρες απασχόλησης που θα πρέπει να δηλώσει ο Τ.Α. και ο Ι.Ε. ανάλογα με την κατηγορία της επιχείρησης 
			και τον αριθμό των εργαζομένων όπως δηλώθηκαν. Παρακάτω αναγράφονται οι συνολικές ώρες των προγραμμάτων που έχουν δηλωθεί για τον 
			Τ.Α. και τον Ι.Ε. και ελέγχονται αν υπερκαλύπτονται τα γεγονότα.<br/><br/></td></tr></table>
			<h1>Ελάχιστες ώρες εργασίας Τ.Α. και Ι.Ε.</h1>
			<div id="times_check"></div>
			<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/ajax-loader.gif"></div>
			<script>
			function show_help(n){
				document.getElementById('programma_help_1').style.display="none";
				document.getElementById('programma_help_2').style.display="none";
				document.getElementById('programma_help_'+n).style.display="block";
			}
			show_help(1);
			function check_times(){
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					var rec=xmlhttp.responseText;
					var recs=rec.split("|");
					var out="Τεχνικός ασφαλείας: "+recs[0]+"<br/>";
					out += "Ιατρός εργασίας: "+recs[1]+"<br/>";
					out += "<h1>Ώρες εργασίας Τ.Α. και Ι.Ε. (βάσει προγράμματος)</h1>";
					out += "Τεχνικός ασφαλείας: "+recs[2]+"<br/>";
					out += "Ιατρός εργασίας: "+recs[3]+"<br/>";
					out += "<h1>Γεγονότα που υπερκαλύπτεται το ωράριο:</h1>";
					out += recs[4] + "<br />" + recs[5];
					document.getElementById("times_check").innerHTML=out;
					document.getElementById('wait').style.display="none";
				}}
				xmlhttp.open("GET","includes/functions_calendar.php?wres=1",true);
				xmlhttp.send();
			}
			check_times();
			</script>
			
			
<!--
			<?php
			$el_wres = elaxistes_wres();
			echo "Τεχνικός ασφαλείας: ".$el_wres[0]."<br/>";
			echo "Ιατρός εργασίας: ".$el_wres[1]."<br/>";
			?>
			
			<h1>Ώρες εργασίας Τ.Α. και Ι.Ε. (βάση προγράμματος)</h1>
			
			<?php
			$wres = programma_wres();
			echo "Τεχνικός ασφαλείας: ".$wres[0]."<br/>";
			echo "Ιατρός εργασίας: ".$wres[1]."<br/>";
			?>
			
			<h1>Γεγονότα που υπερκαλύπτεται το ωράριο:</h1>
			<?php			
			echo print_overlaping("meleti_programma_ta");
			echo print_overlaping("meleti_programma_ie");
			?>
-->			
			</div>
		
		
			</div>
		</div>
	</div>
</div>
