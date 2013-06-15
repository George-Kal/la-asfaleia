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

//Υπολογισμός επικινδυνότητας από την τρέχουσα μελέτη.
function create_qa(){
	
	$database = new medoo(DB_NAME);
	$tb_meletes = "meletes";
	$col_meletes = "*";
	$where_meletes = array("AND" => array("user_id" => $_SESSION['user_id'],"id" => $_SESSION['meleti_id']));
	$meletes = $database->select($tb_meletes,$col_meletes,$where_meletes);
	
	$img_check = '<img alt="" src="'. APPLICATION_FOLDER .'images/checkbox.png"  style="width: 16px; height: 16px;" />';
	
	$qa = "Ερωτηματολόγιο -".$meletes[0]["name"]."<br/>";
	$qa .= "Επιλέξτε την απάντηση της κάθε ερώτησης στο ".$img_check."<br/><br/>";
	
	//Επιλογές απάντησης
	$array_answer = array();
	
	//Ναι/Οχι
	$array_answer[1] = $img_check." Ναι ".$img_check." Όχι ";
	//Φύλλο
	$array_answer[2] = $img_check." Άνδρας ".$img_check." Γυναίκα ";
	//Ηλικιακή ομάδα
	$array_answer[3] = 
	$img_check."  < 18 ετών <br/>"
	.$img_check." 18-25 ετών <br/>"
	.$img_check." 25-30 ετών <br/>"
	.$img_check." 30-35 ετών <br/>"
	.$img_check." 35-40 ετών <br/>"
	.$img_check." 40-50 ετών <br/>"
	.$img_check." > 50 ετών <br/>";
	//Ημερομηνία
	$array_answer[4] = "..../.../......";
	//Κλίμακα 5 σημείων
	$array_answer[5] = $img_check." 1 ".$img_check." 2 ".$img_check." 3 ".$img_check." 4 ".$img_check." 5 ";
	//Κλίμακα 10 σημείων
	$array_answer[6] = $array_answer[5].$img_check." 6 ".$img_check." 7 ".$img_check." 8 ".$img_check." 9 ".$img_check." 10 ";
	//Σύντομο κείμενο
	$array_answer[7] = " ";
	//Εκτενές κείμενο
	$array_answer[8] = " ";
	
	
	$db_table = "meleti_qa";
	$db_columns = "*";
	$db_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
	$data_qa = $database->select($db_table,$db_columns,$db_parameters);
	$count_qa = $database->count($db_table, $db_parameters);
	
	
	$qa .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$qa .= "<tr><th width=\"5%\">α/α</th><th>Ερώτηση</th><th>Απάντηση</th></tr>";
	
		$i=1;
		foreach($data_qa as $data){
		$qa .= "<tr>";
		$qa .= "<td>".$i."</td>";
		$qa .= "<td>".$data["question"]."</td>";
		
			if($data["answer_type"]==1){$answer=$array_answer[1];}
			if($data["answer_type"]==2){$answer=$array_answer[2];}
			if($data["answer_type"]==3){$answer=$array_answer[3];}
			if($data["answer_type"]==4){$answer=$array_answer[4];}
			if($data["answer_type"]==5){$answer=$array_answer[5];}
			if($data["answer_type"]==6){$answer=$array_answer[6];}
			if($data["answer_type"]==7){$answer=$array_answer[7];}
			if($data["answer_type"]==8){$answer=$array_answer[8];}

		$qa .= "<td>".$answer."</td>";
			
		$qa .= "</tr>";
			if($data["answer_type"]==8){
			$qa .= "<tr><td colspan=\"3\" height=\"100\">Χώρος απάντησης:</td></tr>";
			}
		$i++;
		}
	$qa .= "</table>";
	$qa .= "<br/><br/>";
	$qa .= "Ευχαριστούμε για το χρόνο που αφιερώσατε σε αυτό το ερωτηματολόγιο. Σύνολο ερωτήσεων: ".$count_qa;
	
	return $qa;
}

?>