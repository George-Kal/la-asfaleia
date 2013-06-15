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

//Εκτύπωση νομοθεσίας
function create_laws(){
	
	$database = new medoo(DB_NAME);
	$tb_meletes = "library_laws";
	$col_meletes = "*";
	//$where_meletes = array("type" => "1");
	$data_laws = $database->select($tb_meletes,$col_meletes);
	
	$laws = "Νομοθεσία Τ.Α.<br/>";
	
	$laws .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$laws .= "<tr><th width=\"5%\">α/α</th><th>Τύπος</th><th>Όνομα</th><th>Περιγραφή</th></tr>";
	
		$i=1;
		foreach($data_laws as $data){
		$laws .= "<tr>";
		$laws .= "<td>".$i."</td>";
		
			if($data["type"]==1){$type="Νόμος";}
			if($data["type"]==2){$type="Ανακοίνωση/Άλλο";}
			if($data["type"]==3){$type="Π.Δ.";}
			if($data["type"]==4){$type="Εγκύκλιος";}
			if($data["type"]==5){$type="Υ.Α.";}

		$laws .= "<td>".$type."</td>";
		$laws .= "<td><a href=\"".$data["link"]."\" target=\"_blank\">".$data["name"]."</a></td>";
		$laws .= "<td>".$data["perigrafi"]."</td>";
		$laws .= "</tr>";
		$i++;
		}
	$laws .= "</table>";
	
	return $laws;
}

//Εκτύπωση κατηγοριών επιχειρήσεων
function create_industry_cat(){
	
	$database = new medoo(DB_NAME);
	$tb_meletes = "library_industry_cat";
	$col_meletes = "*";
	//$where_meletes = array("type" => "1");
	$data_laws = $database->select($tb_meletes,$col_meletes);
	
	$cat = "Κατηγοριοποίηση δραστηριοτήτων<br/>";
	
	$cat .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$cat .= "<tr><th width=\"5%\">α/α</th><th>Κατηγορία</th><th>Κωδ.</th><th>Περιγραφή</th></tr>";
	
		$i=1;
		foreach($data_laws as $data){
		$cat .= "<tr>";
		$cat .= "<td>".$i."</td>";
		
			if($data["cat"]==1){$type="Α";}
			if($data["cat"]==2){$type="Β";}
			if($data["cat"]==3){$type="Γ";}

		$cat .= "<td>".$type."</td>";
		$cat .= "<td>".$data["code"]."</td>";
		$cat .= "<td>".$data["name"]."</td>";
		$cat .= "</tr>";
		$i++;
		}
	$cat .= "</table>";
	
	return $cat;
}

//Εκτύπωση βιβλιοθήκης πηγών κινδύνων
function create_library_piges(){
	
	$database = new medoo(DB_NAME);
	$tb_meletes = "library_pigeskindynoy";
	$col_meletes = "*";
	$data_libmetra = $database->select($tb_meletes,$col_meletes);
	
	$lib_metra = "<div id=\"tabs-inside\">";
	$lib_metra .= "<ul>";
		foreach($data_libmetra as $data){
		$lib_metra .= "<li><a href=\"#tabs-inside-".$data["id"]."\">".$data["name"]."</a></li>";
		}
	$lib_metra .= "</ul>";
	
		foreach($data_libmetra as $data){
		$lib_metra .= "<div id=\"tabs-inside-".$data["id"]."\">";
		$lib_metra .= $data["perigrafi"];
		$lib_metra .= "</div>";
		}
	
	$lib_metra .= "</div>";
	
	
	return $lib_metra;
}

?>