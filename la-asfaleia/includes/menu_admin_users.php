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
<div class="container-fluid">
	<div class="row-fluid">
		<?php
		$database = new medoo(DB_NAME);
		$db_table = "users";
		$db_columns = "*";
		$data_users = $database->select($db_table,$db_columns);
		$count_users = $database->count($db_table);
		$count_meletes = $database->count("meletes");
		
		?>
		<div class="span2">
		
			<?php
			if(isset($_SESSION['msg']['admin-err']))
			{
				echo "<div class=\"alert alert-error\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				<strong>Προσοχή!</strong>".$_SESSION['msg']['admin-err']."</div>";
				unset($_SESSION['msg']['admin-err']);
			}
			?>
		
			<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Βοήθεια!</strong><br/>
			Εδώ εμφανίζονται οι εγγεγραμμένοι χρήστες στο λογισμικό.<br/><br/>
			Μπορείτε να επεξεργαστείτε και να ενημερώσετε τα στοιχεία του χρήστη ή να διαγράψετε κάποιο εγγεγραμμένο χρήστη.<br/><br/>
			Στην επεξεργασία του κάθε χρήστη ο κωδικός εμφανίζεται κρυπτογραφημένος. Εάν δεν αλλάξετε το κελί δεν μεταβάλλεται στη βάση δεδομένων και 
			μεταβάλλονται μόνο τα υπόλοιπα στοιχεία
			Εάν χρειάζεται να αλλάξετε τον κωδικό του χρήστη εισάγετε τον κωδικό που θέλετε να πληκτρολογεί ο χρήστης κατά τη σύνδεση. Ο κωδικός που εισάγετε 
			κρυπτογραφείται αυτόματα κατά την προσθήκη στη βάση δεδομένων.
			</div>
			
			<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Στατιστικά</strong><br/>
			<?php
			echo "Σύνολο χρηστών: ".$count_users."<br/>";
			echo "Σύνολο μελετών: ".$count_meletes."<br/>";
			?>
			</div>
			
		</div><!-- /span2 -->
		
		<div class="span10">

		<a href="#create_user_popup" role="button" class="btn btn-warning" data-toggle="modal">Προσθήκη νέου χρήστη</a>
		
		<table class="table table-bordered table-hover">
		<tr>
		<th width=10%>α/α</th>
		<th width=40%>Όνομα</th>
		<th width=30%>e-mail</th>
		<th width=10%>Μελέτες</th>
		<th width=10%>Ενέργειες</th>
		</tr>
		
		<?php
		$i=1;
		foreach($data_users as $data){
			echo "<tr>";
			echo "<td><span class=\"label label-inverse\">".$i."</span><span class=\"label label-Info\">user.id=".$data["id"]."</span></td>";
			echo "<td>".$data["usr"]."</td>";
			echo "<td>".$data["email"]."</td>";
			$meletes_xristi = $database->count("meletes",array("user_id"=>$data["id"]));
			echo "<td>".$meletes_xristi."</td>";
			echo "<td>";
			echo "<div class=\"btn-group\">";
			echo "<a class=\"btn\" href=\"#popup_user".$data["id"]."\" role=\"button\" data-toggle=\"modal\">Επεξεργασία</a>";
			echo "<button class=\"btn dropdown-toggle\" data-toggle=\"dropdown\">";
			echo "<span class=\"caret\"></span>";
			echo "</button>";
			echo "<ul class=\"dropdown-menu\">";
			echo "<li><a tabindex=\"1\" href=\"#popup_user".$i."\" role=\"button\" data-toggle=\"modal\"><i class=\"icon-check\"></i>Επεξεργασία</a></li>";
			echo "<li class=\"divider\"></li>";
			echo "<li><a tabindex=\"2\" href=\"?action=delete_user&user_id=".$data["id"]."\"><i class=\"icon-trash\"></i>Διαγραφή</a></li>";
			echo "</ul>";
			echo "</div></td>";
			echo "</tr>";
		$i++;
		}
		?>
		</table>
		
		<?php
		//Κρυφό div για εμφάνιση			
		foreach($data_users as $data){
			echo "<form action=\"\" method=\"post\">";
		
			echo "<div id=\"popup_user".$data["id"]."\" class=\"modal hide fade\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
			
			echo "<div class=\"modal-header\">";
			echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>";
			echo "<h3 id=\"myModalLabel\">Επεξεργασία χρήστη ".$data["usr"]."</h3>";
			echo "</div>";
			
			echo "<div class=\"modal-body\">";
			echo "<p>";
			
			echo "<table>";
			echo "<tr><td>Όνομα χρήστη:</td><td><input type=\"text\" id=\"usr".$data["id"]."\" name=\"usr".$data["id"]."\" value=\"".$data["usr"]."\"></td></tr>";
			echo "<tr><td>Κωδικός:</td><td><input type=\"text\" id=\"pass".$data["id"]."\" name=\"pass".$data["id"]."\" value=\"".$data["pass"]."\"></td></tr>";
			echo "<tr><td>e-mail:</td><td><input type=\"text\" id=\"email".$data["id"]."\" name=\"email".$data["id"]."\" value=\"".$data["email"]."\"></td></tr>";
			echo "<tr><td>Όνομα/επώνυμο:</td><td><input type=\"text\" id=\"onoma".$data["id"]."\" name=\"onoma".$data["id"]."\" value=\"".$data["onoma"]."\"></td></tr>";
			$select = make_selectbox("library_eidikotites","eidikotita".$data["id"]);
			echo "<tr><td>Ειδικότητα:</td><td>".$select."</td></tr>";
			echo "<script language=\"JavaScript\">";
			echo "document.getElementById(\"eidikotita".$data["id"]."\").selectedIndex=".$data["eidikotita"].";";
			echo "</script>";
			echo "<tr><td>Έτη πτυχίου:</td><td><input type=\"text\" id=\"ptyxio_years".$data["id"]."\" name=\"ptyxio_years".$data["id"]."\" value=\"".$data["ptyxio_years"]."\"></td></tr>";
			echo "<tr><td>Διεύθυνση:</td><td><input type=\"text\" id=\"address".$data["id"]."\" name=\"address".$data["id"]."\" value=\"".$data["address"]."\"></td></tr>";
			echo "<tr><td>Τηλέφωνο:</td><td><input type=\"text\" id=\"tel".$data["id"]."\" name=\"tel".$data["id"]."\" value=\"".$data["tel"]."\"></td></tr>";
			echo "<tr><td>ΑΔΤ:</td><td><input type=\"text\" id=\"taytotita".$data["id"]."\" name=\"taytotita".$data["id"]."\" value=\"".$data["taytotita"]."\"></td></tr>";
			echo "<tr><td>ΑΦΜ:</td><td><input type=\"text\" id=\"afm".$data["id"]."\" name=\"afm".$data["id"]."\" value=\"".$data["afm"]."\"></td></tr>";
			echo "</table>";
			
			echo "</p>";
			echo "</div>";
			
			echo "<div class=\"modal-footer\">";
			echo "<button type=\"submit\" name=\"submit\" value=\"edit_user".$data["id"]."\" class=\"btn btn-primary\">Επεξεργασία</button>";
			echo "<button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">Ακύρωση</button>";
			echo "</div>";
			
			echo "</div>";
			echo "</form>";
		//Κρυφό div για εμφάνιση
		}
		?>
		
		<!-- ###################### Κρυφό create_user_popup για εμφάνιση ###################### -->
		<form action="" method="post">
		<div id="create_user_popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Προσθήκη νέου χρήστη</h3>
		</div>
		<div class="modal-body">
		<p>
		
		<table>
		<tr><td><b>Όνομα χρήστη:</b></td><td><input type="text" id="usr" name="usr" value=""></td></tr>
		<tr><td><b>Κωδικός:</b></td><td><input type="text" id="pass" name="pass" value=""></td></tr>
		<tr><td><b>e-mail:</b></td><td><input type="text" id="email" name="email" value=""></td></tr>
		<tr><td><b>Όνομα-Επώνυμο:</b></td><td><input type="text" id="onoma" name="onoma" value=""></td></tr>
		<tr>
		<td><b>Ειδικότητα:</b></td>
		<td>
		<?php
		echo make_selectbox("library_eidikotites","eidikotita");
		?>
		</td></tr>
		<tr><td><b>Έτη πτυχίου:</b></td><td><input type="text" id="ptyxio_years" name="ptyxio_years" value=""></td></tr>
		<tr><td><b>Διεύθυνση:</b></td><td><input type="text" id="address" name="address" value=""></td></tr>
		<tr><td><b>Τηλέφωνο:</b></td><td><input type="text" id="tel" name="tel" value=""></td></tr>
		<tr><td><b>ΑΔΤ:</b></td><td><input type="text" id="taytotita" name="taytotita" value=""></td></tr>
		<tr><td><b>ΑΦΜ:</b></td><td><input type="text" id="afm" name="afm" value=""></td></tr>
		</table>
		
		
		</p>
		</div>
		<div class="modal-footer">
		<button type="submit" name="submit" value="create_user" class="btn btn-primary">Προσθήκη</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Ακύρωση</button>
		</div>
		</div>
		</form>
		<!-- ######################### Κρυφό create_user_popup για εμφάνιση ######################### -->
		
		</div><!-- /span10 -->
	</div><!-- /row-fluid -->
</div><!-- /container-fluid -->