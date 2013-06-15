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
confirm_logged_in();
?>
<div class="container-fluid">
	<div class="row-fluid">
	
		<div class="span2">
			    <div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Στοιχεία χρήστη</h4>
				Προσθέστε ή τροποποιήστε τα στοιχεία του Τ.Α. τα οποία αποθηκεύονται στο λογαριασμό χρήστη.
				</div>
				
				<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Αλλαγή κωδικού</h4>
				Αλλάξτε τον κωδικό σύνδεσης του χρήστη.
				</div>
			
			<?php			
			if(isset($_SESSION['msg']['pass-err'])){
				echo "<div class=\"alert alert-error\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				<strong>Προσοχή!</strong><br/>".$_SESSION['msg']['pass-err']."</div>";
				unset($_SESSION['msg']['pass-err']);
			}
			?>
				
		</div>
		
		<div class="span10">
			<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Στοιχεία Τ.Α.</a></li>
				<li><a href="#tabs-2">Αλλαγή κωδικού σύνδεσης</a></li>
			</ul>
			
			<div id="tabs-1">
			<?php
			$database = new medoo(DB_NAME);
			$db_table = "users";
			$db_columns = "*";
			$where_id = array("id" => $_SESSION['user_id']);
			$select_user = $database->select($db_table,$db_columns,$where_id);
			
			$email = $select_user[0]["email"];
			$onoma = $select_user[0]["onoma"];
			$eidikotita = $select_user[0]["eidikotita"];
			$ptyxio_years = $select_user[0]["ptyxio_years"];
			$address = $select_user[0]["address"];
			$tel = $select_user[0]["tel"];
			$taytotita = $select_user[0]["taytotita"];
			$afm = $select_user[0]["afm"];
			?>
			
				<form name="user_pref" action="" method="POST">
				
				<table>
				<tr><td><b>e-mail:</b></td><td><input type="text" id="email" name="email" value="<?php echo $email;?>"></td></tr>
				<tr><td><b>Όνομα-Επώνυμο:</b></td><td><input type="text" id="onoma" name="onoma" value="<?php echo $onoma;?>"></td></tr>
				<tr>
				<td><b>Ειδικότητα:</b></td>
				<td>
				<?php
				echo make_selectbox("library_eidikotites","eidikotita");
				?>
				<script language="JavaScript">
					document.getElementById("eidikotita").selectedIndex=<?php echo $eidikotita;?>;
				</script>
				</td></tr>
				<tr><td><b>Έτη πτυχίου:</b></td><td><input type="text" id="ptyxio_years" name="ptyxio_years" value="<?php echo $ptyxio_years;?>"><span class="help-inline">*Χρόνια προυπηρεσίας</span></td></tr>
				<tr><td><b>Διεύθυνση:</b></td><td><input type="text" id="address" name="address" value="<?php echo $address;?>"></td></tr>
				<tr><td><b>Τηλέφωνο:</b></td><td><input type="text" id="tel" name="tel" value="<?php echo $tel;?>"></td></tr>
				<tr><td><b>ΑΔΤ:</b></td><td><input type="text" id="taytotita" name="taytotita" value="<?php echo $taytotita;?>"></td></tr>
				<tr><td><b>ΑΦΜ:</b></td><td><input type="text" id="afm" name="afm" value="<?php echo $afm;?>"></td></tr>
				</table>
				<br/>
				<button type="submit" name="submit" value="save-userpref" class="btn btn-primary">Τροποποίηση στοιχείων</button>
				</form>
				
			
			</div>
			
			<div id="tabs-2"> 
			<form class="clearfix" action="" method="post">
				<table>
				<tr><td><b>Παλαιός κωδικός:</b></td><td><input type="password" id="password1" name="password1"></td></tr>
				<tr><td><b>Παλαιός κωδικός (επιβεβαίωση):</b></td><td><input type="password" id="password2" name="password2"></td></tr>
				<tr><td><b>Νέος κωδικός:</b></td><td><input type="password" id="newpassword1" name="newpassword1"></td></tr>
				<tr><td><b>Νέος κωδικός (επιβεβαίωση):</b></td><td><input type="password" id="newpassword2" name="newpassword2"></td></tr>
				<tr>
				</table>
				<button type="submit" name="submit" value="update-password" class="btn btn-primary">Αλλαγή κωδικού</button>
			</form>
			</div>

		
			</div>
		</div>
	</div>
</div>
