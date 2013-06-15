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

//Το αρχείο δεν εκτελείται μόνο του
require("include_check.php");

//Μετατροπή λεπτών σε ώρες και λεπτά
function convertToHoursMins($time) {
    settype($time, "integer");
    if ($time < 1) {
        return;
    }
	//οι ώρες. το ακέραιο της διαίρεσης με το 60
    $hours = floor($time/60);
	//τα λεπτά. το υπόλοιπο της διαίρεσης με το 60
    $minutes = $time%60;
	if($minutes==0){
	$format = "%d ώρες";
	return sprintf($format, $hours);
	}else{
	$format = "%d ώρες %d λεπτά";
    return sprintf($format, $hours, $minutes);
	}
}

//Εύρεση του αριθμού των μηνών ανάμεσα σε 2 ημερομηνίες
function howmanymonths($date1,$date2) {
$d1 = strtotime($date1);
$d2 = strtotime($date2);
$min_date = min($d1, $d2);
$max_date = max($d1, $d2);
$i = 0;

while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
    $i++;
}
return $i;
}


//Ημερολόγιο έτους για τεχνικό ασφαλείας
//Επιστρέφει το ημερολόγιο του έτους που δηλώθηκε με τα γεγονότα από όλες τις μελέτες
//για τον Τ.Α. (πίνακας:meleti_programma_ta) και τον Ι.Ε. (πίνακας:meleti_programma_ie)
function draw_calendar($year, $pinakas){
	
	$database = new medoo(DB_NAME);
	//o πίνακας που περιέχει τα γεγονότα (Τ.Α. ή Ι.Ε.)
	$db_table = $pinakas;
	$db_columns = "*";
	$count_prog = $database->count($db_table, array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'])));
	
	if($count_prog!=0){
	
	$calendar = "";
	//Array με τους μήνες και τις ημέρες
	$month_names = array("0","Ιανουάριος","Φεβρουάριος","Μάρτιος","Απρίλιος","Μαϊος","Ιούνιος",
	"Ιούλιος","Αύγουστος",	"Σεπτέμβριος","Οκτώβριος","Νοέμβριος","Δεκέμβριος");
	$day_names = array('Κυριακή','Δευτέρα','Τρίτη','Τετάρτη','Πέμπτη','Παρασκευή','Σάββατο');
	
	//Για τους 12 μήνες
	for ($z=1; $z<=12; $z++){
	//Εισαγωγικό κείμενο που δείχνει το μήνα και το χρόνο πριν τον πίνακα
	$calendar .= "<h2>".$month_names[$z]." ".$year."</h2>";
	//αρχή πίνακα
	$calendar .= '<table border="1" cellpadding="0" cellspacing="0" class="calendar">';
	$calendar .= '<tbody>';
	
	//γραμμή τίτλων πίνακα
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$day_names).'</td></tr>';

	//μεταβλητές για αντιπροσωπευτική μέρα, αρ. ημερών στον πίνακα, ημέρες στην τρέχουσα εβδομάδα, αρίθμηση ημερών
	$running_day = date('w',mktime(0,0,0,$z,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$z,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();
	
	$evdomada = 1;

	//Αρχή πρώτης γραμμής
	$calendar.= '<tr class="calendar-row">';

	//Τα κενά κελιά του πίνακα μέχρι την πρώτη μέρα της εβδομάδας
	for($x = 0; $x < $running_day; $x++){
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	}

	//Οι υπόλοιπες μέρες
	for($list_day = 1; $list_day <= $days_in_month; $list_day++){

			//Η πρώτη Δευτέρα, Τρίτη, Τετάρτη...
			if($list_day>=1 AND $list_day<=7){
			$evdomada = 1;
			}
			//Η δεύτερη Δευτέρα, Τρίτη, Τετάρτη...
			if($list_day>7 AND $list_day<=14){
			$evdomada = 2;
			}
			//Η τρίτη Δευτέρα, Τρίτη, Τετάρτη...
			if($list_day>14 AND $list_day<=21){
			$evdomada = 3;
			}
			//Η τέταρτη Δευτέρα, Τρίτη, Τετάρτη...
			if($list_day>21 AND $list_day<=28){
			$evdomada = 4;
			}
			//Η πέμπτη (αν υπάρχει) Δευτέρα, Τρίτη, Τετάρτη...
			if($list_day>28 AND $list_day<=31){
			$evdomada = 5;
			}
		
			$calendar.= '<td class="calendar-day">';
			//Ο αριθμός της μέρας του μήνα
			$calendar.= '<div class="day-number">'.$list_day.'</div>';
			
				//ευρεση των γεγονότων για τη μέρα από τη βάση
				$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"day" => $running_day,"kathe" => $evdomada));
				$data_gegonota = $database->select($db_table,$db_columns,$db_parameters);
				$count_gegonota = $database->count($db_table, $db_parameters);
				
				foreach($data_gegonota as $data){
					$timestamp_day = $year."-".$z."-".$list_day;
					//Μόνο τα γεγονότα πριν τη λήξη
					if (strtotime($timestamp_day)<=strtotime($data["date_end"]) AND strtotime($timestamp_day)>=strtotime($data["date_start"])){
					//Το ωριαίο πρόγραμμα
					//$hours = (strtotime($data["time_end"])-strtotime($data["time_start"]))/3600;
					$minutes = (strtotime($data["time_end"])-strtotime($data["time_start"]))/60;
					$hoursmin = convertToHoursMins($minutes);
					$calendar.= $data["time_start"]." - ".$data["time_end"]." (".$hoursmin.")<br/>";
					
					//Το όνομα της μελέτης (Άρα και της επιχείρησης)
					$data_meleti = $database->select("meletes","*",array("AND" => array("user_id" => $_SESSION['user_id'],"id" => $data['meleti_id'])));
					$calendar.= $data_meleti[0]["name"]." - ";
					
					//Σε ποιό υποκατάστημα
					$data_ktirio = $database->select("meleti_ktiria","*",array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $data['meleti_id'],"id" => $data['ktirio_id'])));
					$calendar.= $data_ktirio[0]["name"];

					$calendar.= "<br/><br/>";
					}
				}
				
			
			
			$calendar.= str_repeat('<p> </p>',2);
			
		$calendar.= '</td>';
		if($running_day == 6){
			$calendar.= '</tr>';
			if(($day_counter+1) <= $days_in_month){
				$calendar.= '<tr class="calendar-row">';
			}
			$running_day = -1;
			$days_in_this_week = 0;
		}
		$days_in_this_week++; $running_day++; $day_counter++;
	}

	//Τα τελευταία κελιά της τελευταίας γραμμής συμπληρώνονται κενά
	if($days_in_this_week < 8){
		for($x = 1; $x <= (8 - $days_in_this_week); $x++){
			$calendar.= '<td class="calendar-day-np"> </td>';
		}
	}

	//τελευταία γραμμή
	$calendar.= '</tr>';
	//τέλος πίνακα
	$calendar .= '</tbody>';
	$calendar.= '</table>';
	//Απαιτείται στο τεύχος για να αλλάζει σελίδα
	$calendar .= "<p style=\"page-break-before:always;\">&nbsp;</p>";
	}//επανάληψη για μήνες
	
	}else{//Δεν βρέθηκαν προγράμματα
		$calendar = "<font color=\"green\">Δεν έχει οριστεί πρόγραμμα.</font><br/>";
		
		if($db_table=="meleti_programma_ta"){
		$calendar .= "<font color=\"red\">Πρέπει αναγκαστικά να δηλώσετε πρόγραμμα Τ.Α.</font>";
		}
		if($db_table=="meleti_programma_ie"){
		$count_ie = $database->count("meleti_ypeythinos", array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"type"=>"5")));
			if($count_ie>0){
			$calendar .= "<font color=\"red\">Έχετε ορίσει Ι.Ε. στους υπευθύνους. Πρέπει αναγκαστικά να προσθέσετε πρόγραμμα Ι.Ε.</font>";
			}
		
		}
	}
	
	//επιστροφή αποτελέσματος
	return $calendar;
}



//Τσεκάρει όλα τα προγράμματα του χρήστη εάν συμπίπτουν
function check_events($pinakas){
	
	$overlaping = array();

	$database = new medoo(DB_NAME);
	//o πίνακας που περιέχει τα γεγονότα (Τ.Α. ή Ι.Ε.)
	$db_table = $pinakas;
	$db_columns = "*";
	$db_parameters = array("user_id" => $_SESSION['user_id']);
	$data_gegonota = $database->select($db_table,$db_columns,$db_parameters);
	
		foreach($data_gegonota as $data){
			$time_start = strtotime($data["time_start"]);
			$time_end = strtotime($data["time_end"]);
			$date_start = strtotime($data["date_start"]);
			$date_end = strtotime($data["date_end"]);
			$event_duration = $time_end - $time_start;
			
			//Επιλέγω κάθε φορά όλα τα άλλα γεγονότα του πίνακα
			$db_parametersother = array("AND" => array("id[!]" => $data['id'],"ktirio_id" => $data['ktirio_id'],"kathe" => $data['kathe'],"day" => $data['day']));
			$data_loipa = $database->select($db_table,$db_columns,$db_parametersother);
				foreach($data_loipa as $data1){
					
					$time_start1 = strtotime($data1["time_start"]);
					$time_end1 = strtotime($data1["time_end"]);
					$date_start1 = strtotime($data1["date_start"]);
					$date_end1 = strtotime($data1["date_end"]);

					//Η ημερομηνία αρχής βρίσκεται εντός ή η ημερομηνία τέλους βρίσκεται εντός (ΤΑ ΓΕΓΟΝΟΤΑ ΑΦΟΡΟΥΝ ΤΟΝ ΙΔΙΟ ΜΗΝΑ ΣΙΓΟΥΡΑ)
					if ( ($date_start1>=$date_start AND $date_start1<=$date_end) OR ($date_end1<=$date_end AND $date_end1>=$date_start) ){
						//και η ώρα αρχής βρίσκεται εντός ή η ώρα τέλους βρίσκεται εντός (ΤΑ ΓΕΓΟΝΟΤΑ ΑΦΟΡΟΥΝ ΤΗΝ ΙΔΙΑ ΩΡΑ - ΕΔΩ ΑΠΑΙΤΕΙΤΑΙ ΕΛΕΓΧΟΣ ΚΑΙ ΤΩΝ 2 γεγονότων)
						if ( ($time_start1>=$time_start AND $time_start1<=$time_end) OR ($time_end1<=$time_end AND $time_end1>=$time_start) ){
						array_push($overlaping, $data['id'], $data1['id']);
						}
						if ( ($time_start>=$time_start1 AND $time_start<=$time_end1) OR ($time_end<=$time_end1 AND $time_end>=$time_start1) ){
						array_push($overlaping, $data['id'], $data1['id']);
						}
					}
					
				}
			
		}

	//Για τις περιπτώσεις (τα ίσον του τύπου) όπου το ίδιο id βρίσκεται 2 φορές στην array
	return array_unique($overlaping);
}

//Εκτύπωση των προγραμμάτων Τ.Α. ή Ι.Ε. που συμπίπτουν
function print_overlaping($pinakas){
	$overlaping_ids = check_events($pinakas);
	if ($pinakas=="meleti_programma_ta"){$text = "<b>Έλεγχος υπερκάληψης γεγονότων Τ.Α.:</b><br/>";}
	if ($pinakas=="meleti_programma_ie"){$text = "<b>Έλεγχος υπερκάληψης γεγονότων Ι.Ε.:</b><br/>";}

	
	
	if (count($overlaping_ids)==0){
	$text .= "<font color=\"green\">Δεν υπάρχουν γεγονότα των οποίων τα ωράρια συμπίπτουν για το ίδιο κτίριο την ίδια ημέρα στις ίδιες ημερομηνίες</font>";
	}else{
	$text .= "<font color=\"red\">Προσοχή!!!</font><br/>";
	$database = new medoo(DB_NAME);
	//o πίνακας που περιέχει τα γεγονότα (Τ.Α. ή Ι.Ε.)
	$db_table = $pinakas;
	$db_columns = "*";
	
		foreach($overlaping_ids as $id){
		$db_parameters = array("id" => $id);
		$data_gegonota = $database->select($db_table,$db_columns,$db_parameters);
		
			$data_ktirio = $database->select("meleti_ktiria",$db_columns,array("id" => $data_gegonota[0]["ktirio_id"]));
			
			if($data_gegonota[0]["kathe"]==1){$kathe="πρώτη";}
			if($data_gegonota[0]["kathe"]==2){$kathe="δεύτερη";}
			if($data_gegonota[0]["kathe"]==3){$kathe="τρίτη";}
			if($data_gegonota[0]["kathe"]==4){$kathe="τέταρτη";}
			
			if($data_gegonota[0]["day"]==0){$day="Κυριακή";}
			if($data_gegonota[0]["day"]==1){$day="Δευτέρα";}
			if($data_gegonota[0]["day"]==2){$day="Τρίτη";}
			if($data_gegonota[0]["day"]==3){$day="Τετάρτη";}
			if($data_gegonota[0]["day"]==4){$day="Πέμπτη";}
			if($data_gegonota[0]["day"]==5){$day="Παρασκευή";}
			if($data_gegonota[0]["day"]==6){$day="Σάββαρο";}
			$text .= $data_ktirio[0]["name"]."-Κάθε ".$kathe." ".$day." ".$data_gegonota[0]["time_start"]." με ".$data_gegonota[0]["time_end"]." από ".$data_gegonota[0]["date_start"]." έως ".$data_gegonota[0]["date_end"]."<br/>";
			$text .= "<br/>";
		}
	}
	
	return $text;
}

//Εύρεση των ελαχίστων ωρών Τ.Α. ή Ι.Ε.
function elaxistes_wres(){
	$database = new medoo(DB_NAME);
	$db_columns = "*";
	
	//Επιλογή του είδους της επιχείρησης για τη μελέτη
	$select_typemeleti = $database->select("meletes",$db_columns,array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id'])) );
	$typemeleti = $select_typemeleti[0]["type"];
	
	//Επιλογή της κατηγορίας της επιχείρησης (Α,Β,Γ)
	$select_catmeleti = $database->select("library_industry_cat",$db_columns,array("id"=>$typemeleti) );
	$catmeleti = $select_catmeleti[0]["cat"];
	
	//Επιλογή του αριθμού των εργαζομένων της επιχείρησης
	$ergazomenoi = count_ergazomenoi();
	
	//Κατηγορία Α
	if($catmeleti==1 AND $ergazomenoi<=500){$t_ta=3.5; $t_ie=0.8;}
	if($catmeleti==1 AND $ergazomenoi>500 AND $ergazomenoi<=1000){$t_ta=3; $t_ie=0.8;}
	if($catmeleti==1 AND $ergazomenoi>1000 AND $ergazomenoi<=5000){$t_ta=2.5; $t_ie=0.8;}
	if($catmeleti==1 AND $ergazomenoi>5000){$t_ta=2; $t_ie=0.8;}
	//Κατηγορία Β
	if($catmeleti==2 AND $ergazomenoi<=1000){$t_ta=2.5; $t_ie=0.6;}
	if($catmeleti==2 AND $ergazomenoi>1000 AND $ergazomenoi<=5000){$t_ta=3; $t_ie=0.6;}
	if($catmeleti==2 AND $ergazomenoi>5000){$t_ta=2; $t_ie=0.6;}
	//Κατηγορία Γ
	if($catmeleti==3){$t_ta=0.4; $t_ie=0.4;}
	
	$wres_ta = $ergazomenoi*$t_ta;
	$wres_ie = $ergazomenoi*$t_ie;
	
	//Διόρθωση για τις ελάχιστες ώρες
	if($wres_ta<25 AND $ergazomenoi<=20){$wres_ta=25;}
	if($wres_ta<50 AND $ergazomenoi>20 AND $ergazomenoi<=50){$wres_ta=50;}
	if($wres_ta<75 AND $ergazomenoi>50){$wres_ta=75;}
	
	if($wres_ie<25 AND $ergazomenoi<=20){$wres_ie=25;}
	if($wres_ie<50 AND $ergazomenoi>20 AND $ergazomenoi<=50){$wres_ie=50;}
	if($wres_ie<75 AND $ergazomenoi>50){$wres_ie=75;}
	
	//Εάν δεν απαιτείται Ι.Ε.
	if($ergazomenoi<50){$wres_ie=0;}
	
	return array ($wres_ta,$wres_ie);
}


//Επιστροφή ωρών και εμφανίσεων για το μια γραμμή του προγράμματος
//για τον Τ.Α. (πίνακας:meleti_programma_ta) και τον Ι.Ε. (πίνακας:meleti_programma_ie)
function get_emfaniseis($id, $pinakas){
	
	$database = new medoo(DB_NAME);
	//o πίνακας που περιέχει τα γεγονότα (Τ.Α. ή Ι.Ε.)
	$db_table = $pinakas;
	$db_columns = "*";
	$parameters = array("id"=>$id);
	
	$emfaniseis = 0;
	$minutes = 0;
	
	$data_id = $database->select($db_table,$db_columns,$parameters);
	$time_start = $data_id[0]["time_start"];
	$time_end = $data_id[0]["time_end"];
	$date_start = $data_id[0]["date_start"];
	$date_end = $data_id[0]["date_end"];
	
	$year_start = date('Y',strtotime($date_start));
	$year_end = date('Y',strtotime($date_end));
	
	//Για τις ημερολογιακές χρονιές
	for($year=$year_start; $year<=$year_end; $year++){
	
		//Για τους 12 μήνες
		for ($z=1; $z<=12; $z++){

		//μεταβλητές για αντιπροσωπευτική μέρα, αρ. ημερών στον πίνακα, ημέρες στην τρέχουσα εβδομάδα, αρίθμηση ημερών
		$running_day = date('w',mktime(0,0,0,$z,1,$year));
		$days_in_month = date('t',mktime(0,0,0,$z,1,$year));
		$days_in_this_week = 1;
		$day_counter = 0;
		$dates_array = array();
		
		$evdomada = 1;

		//Οι υπόλοιπες μέρες
		for($list_day = 1; $list_day <= $days_in_month; $list_day++){

				//Η πρώτη Δευτέρα, Τρίτη, Τετάρτη...
				if($list_day>=1 AND $list_day<=7){
				$evdomada = 1;
				}
				//Η δεύτερη Δευτέρα, Τρίτη, Τετάρτη...
				if($list_day>7 AND $list_day<=14){
				$evdomada = 2;
				}
				//Η τρίτη Δευτέρα, Τρίτη, Τετάρτη...
				if($list_day>14 AND $list_day<=21){
				$evdomada = 3;
				}
				//Η τέταρτη Δευτέρα, Τρίτη, Τετάρτη...
				if($list_day>21 AND $list_day<=28){
				$evdomada = 4;
				}
				//Η πέμπτη (αν υπάρχει) Δευτέρα, Τρίτη, Τετάρτη...
				if($list_day>28 AND $list_day<=31){
				$evdomada = 5;
				}
				
					//ευρεση των γεγονότων για τη μέρα από τη βάση
					$parameters_kathe = array("AND" => array("id"=>$id, "user_id" => $_SESSION['user_id'],"day" => $running_day,"kathe" => $evdomada));
					$data_gegonota = $database->select($db_table,$db_columns,$parameters_kathe);
					$count_gegonota = $database->count($db_table, $parameters_kathe);
					
					foreach($data_gegonota as $data){
						$timestamp_day = $year."-".$z."-".$list_day;
						//Μόνο τα γεγονότα πριν τη λήξη
						if (strtotime($timestamp_day)<=strtotime($data["date_end"]) AND strtotime($timestamp_day)>=strtotime($data["date_start"])){
						
						$emfaniseis += 1;
						$minutes += (strtotime($data["time_end"])-strtotime($data["time_start"]))/60;
						
						}
					}
				
			if($running_day == 6){
				$running_day = -1;
				$days_in_this_week = 0;
			}
			$days_in_this_week++; $running_day++; $day_counter++;
		}

		}//επανάληψη για μήνες
	}//επανάληψη για τα έτη
	
	//επιστροφή αποτελέσματος
	return array ($emfaniseis,$minutes);
}



//Εύρεση των ωρών βάση προγράμματος Τ.Α. ή Ι.Ε.
function programma_wres(){
	$database = new medoo(DB_NAME);
	$db_columns = "*";
	$db_parameters = array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_prog_ta = $database->select("meleti_programma_ta",$db_columns,$db_parameters);
	$select_prog_ie = $database->select("meleti_programma_ie",$db_columns,$db_parameters);

	$minutes_ta = 0;
	$minutes_ie = 0;
	$emfaniseis_ta = 0;
	$emfaniseis_ie = 0;
	
	foreach($select_prog_ta as $prog_ta){
	$minutes_ta_per_month = (strtotime($prog_ta["time_end"])-strtotime($prog_ta["time_start"]))/60;
	$apotelesmata_ta = get_emfaniseis($prog_ta["id"], "meleti_programma_ta");
	$minutes_ta += $apotelesmata_ta[1];
	$emfaniseis_ta += $apotelesmata_ta[0];
	}
	
	foreach($select_prog_ie as $prog_ie){
	$minutes_ie_per_month = (strtotime($prog_ie["time_end"])-strtotime($prog_ie["time_start"]))/60;
	$apotelesmata_ie = get_emfaniseis($prog_ie["id"], "meleti_programma_ie");
	$minutes_ie += $apotelesmata_ie[1];
	$emfaniseis_ie += $apotelesmata_ie[0];
	}
	
	$hours_ta = convertToHoursMins($minutes_ta);
	$hours_ie = convertToHoursMins($minutes_ie);

return array ($hours_ta,$hours_ie);
}

//Εύρεση των ωρών βάση προγράμματος σε ένα συγκεκριμένο κτίριο
function programma_wres_ktirio($ktirio_id){
	$database = new medoo(DB_NAME);
	$db_columns = "*";
	$db_parameters = array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"ktirio_id"=>$ktirio_id));
	$select_prog_ta = $database->select("meleti_programma_ta",$db_columns,$db_parameters);
	$select_prog_ie = $database->select("meleti_programma_ie",$db_columns,$db_parameters);

	$minutes_ta = 0;
	$minutes_ie = 0;
	$emfaniseis_ta = 0;
	$emfaniseis_ie = 0;
	
	foreach($select_prog_ta as $prog_ta){
	$minutes_ta_per_month = (strtotime($prog_ta["time_end"])-strtotime($prog_ta["time_start"]))/60;
	$apotelesmata_ta = get_emfaniseis($prog_ta["id"], "meleti_programma_ta");
	$minutes_ta += $apotelesmata_ta[1];
	$emfaniseis_ta += $apotelesmata_ta[0];
	}
	
	foreach($select_prog_ie as $prog_ie){
	$minutes_ie_per_month = (strtotime($prog_ie["time_end"])-strtotime($prog_ie["time_start"]))/60;
	$apotelesmata_ie = get_emfaniseis($prog_ie["id"], "meleti_programma_ie");
	$minutes_ie += $apotelesmata_ie[1];
	$emfaniseis_ie += $apotelesmata_ie[0];
	}
	
	$hours_ta = convertToHoursMins($minutes_ta);
	$hours_ie = convertToHoursMins($minutes_ie);

return array ($hours_ta,$hours_ie);
}


//Εύρεση των ωρών βάση προγράμματος σε όλες τις επιχειρήσεις
function programma_wres_full(){
	$database = new medoo(DB_NAME);
	$db_columns = "*";
	$db_parameters = array("user_id"=>$_SESSION['user_id']);
	$select_prog_ta = $database->select("meleti_programma_ta",$db_columns,$db_parameters);
	$select_prog_ie = $database->select("meleti_programma_ie",$db_columns,$db_parameters);

	$minutes_ta = 0;
	$minutes_ie = 0;
	$emfaniseis_ta = 0;
	$emfaniseis_ie = 0;
	
	foreach($select_prog_ta as $prog_ta){
	$minutes_ta_per_month = (strtotime($prog_ta["time_end"])-strtotime($prog_ta["time_start"]))/60;
	$apotelesmata_ta = get_emfaniseis($prog_ta["id"], "meleti_programma_ta");
	$minutes_ta += $apotelesmata_ta[1];
	$emfaniseis_ta += $apotelesmata_ta[0];
	}
	
	foreach($select_prog_ie as $prog_ie){
	$minutes_ie_per_month = (strtotime($prog_ie["time_end"])-strtotime($prog_ie["time_start"]))/60;
	$apotelesmata_ie = get_emfaniseis($prog_ie["id"], "meleti_programma_ie");
	$minutes_ie += $apotelesmata_ie[1];
	$emfaniseis_ie += $apotelesmata_ie[0];
	}
	
	$hours_ta = convertToHoursMins($minutes_ta);
	$hours_ie = convertToHoursMins($minutes_ie);

return array ($hours_ta,$hours_ie);
}

?>