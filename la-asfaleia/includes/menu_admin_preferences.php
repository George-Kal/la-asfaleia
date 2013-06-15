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
confirm_admin();
?>
<div class="container-fluid">
	<div class="row-fluid">
	
		<div class="span2">
			    <div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Γενικές ρυθμίσεις</h4>
				Ορίστε γενικές ρυθμίσεις για το λογισμικό. Αφορά όλους τους χρήστες<br/><br/>
				</div>
				
		</div>
		
		<div class="span10">
			<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Προτιμήσεις</a></li>
			</ul>
			
			<div id="tabs-1">
			<?php
			$database = new medoo(DB_NAME);
			$db_table = "preferences";
			$db_columns = "*";
			$where_parameters = array("id" => "1");
			$select_prefs = $database->select($db_table,$db_columns,$where_parameters);
			
			$id = $select_prefs[0]["id"];
			$registration = $select_prefs[0]["registration"];
			?>
			
				<form name="form_pref" action="" method="POST">
				
				<table>
				<tr>
				<td><b>Εγγραφές χρηστών ενεργές:</b></td>
				<td>
				<input type="checkbox" id="registration" name="registration" value="1">
				<script language="JavaScript">
					var register = <?php echo $registration;?>;
					if (register == 1){
					document.getElementById("registration").checked=true;
					}else{
					document.getElementById("registration").checked=false;
					}
				</script>
				</td>
				</tr>
				</table>
				<br/>
				<button type="submit" name="submit" value="save-pref" class="btn btn-primary">Τροποποίηση</button>
				</form>
				
			
			</div>
		
		
			</div>
		</div>
	</div>
</div>
