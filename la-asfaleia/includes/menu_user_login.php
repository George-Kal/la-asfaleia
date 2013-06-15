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
?>
<div class="container-fluid">
	<div class="row-fluid">
	
		<div class="span2">
		<?php
		$database = new medoo(DB_NAME);
		$select_prefs = $database->select("preferences","*",array("id" => "1"));
		$registration = $select_prefs[0]["registration"];
		
		if(!isset($_SESSION['user_id'])){//Ο χρήστης δεν είναι συνδεδεμένος
			
			if (!isset($_SESSION['msg']['login-err']) && !isset($_SESSION['msg']['reg-err']) && !isset($_SESSION['msg']['reg-success'])){
			
				echo "<div class=\"alert alert-info\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				<strong>Βοήθεια!</strong><br/>
				Συνδεθείτε εισάγοντας το όνομα χρήστη και τον κωδικό σας. <br/><br/>
				Πρότυπα συνθηματικά: admin/admin <br/><br/>";
				if($registration==1){
				echo "Εάν δεν έχετε ακόμα εγγραφεί εισάγετε το όνομα χρήστη 
				και το e-mail σας για να σας στείλουμε ένα κωδικό.";
				}else{
				echo "<font color=\"red\">Οι εγγραφές προσωρινά είναι κλειστές για το κοινό</font>";
				}
				echo "</div>";
			}
			
			if(isset($_SESSION['msg']['login-err']))
			{
				echo "<div class=\"alert alert-error\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				<strong>Προσοχή!</strong>".$_SESSION['msg']['login-err']."</div>";
				unset($_SESSION['msg']['login-err']);
			}
			if(isset($_SESSION['msg']['reg-err']))
			{
				echo "<div class=\"alert alert-error\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				<strong>Προσοχή!</strong>".$_SESSION['msg']['reg-err']."</div>";
				unset($_SESSION['msg']['reg-err']);
			}
			
			if(isset($_SESSION['msg']['reg-success']))
			{
				echo "<div class=\"alert alert-success\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				<strong>Συγχαρητήρια!</strong>".$_SESSION['msg']['reg-success']."</div>";
				unset($_SESSION['msg']['reg-success']);
			}
			
		}else{//Ο χρήστης είναι συνδεδεμένος
		
			
			$db_table = "meletes";
			$db_columns = array ("id","user_id","name","perigrafi","toponymio","address","type","lat","lon");
			$db_parameters = array("user_id" => $_SESSION['user_id']);
			$data_user = $database->select($db_table,$db_columns,$db_parameters);
			$count_meletes = $database->count($db_table, $db_parameters);
			
			//μεταβλητές της μορφής $meletes_id1, $meletes_name2 κλπ
				$i=1;
				foreach($data_user as $data)
				{
					for ($j=0; $j<=count($db_columns)-1; $j++){
					${$db_table."_".$db_columns[$j].$i}=$data[$db_columns[$j]];
					}
				$i++;
				}	
		?>
			
			<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Βοήθεια!</strong><br/>
			Προσθέστε νέα μελέτη δίνοντας το όνομά της. Έπειτα πατήστε το πλήκτρο "Νέα μελέτη". <br/><br/>
			Αφού προσθέσετε τη μελέτη σας από τη λίστα των μελετών μπορείτε να επιλέξετε τη μελέτη εργασίας σας είτε 
			πατώντας το πλήκτρο "Επιλογή" είτε από το πρόσθετο μενού. <br/><br/>
			Αφού επιλέξετε τη μελέτη εργασίας σας θα δείτε το όνομά της να εμφανίζεται στο μενού κορυφής. Το όνομα της μελέτης συμβαδίζει με 
			το όνομα της επιχείρησης. Μπορείτε να το τροποποιήσετε στο μενού <a href="index.php?nav=meleti_general">Γενικά στοιχεία</a> 
			μαζί με τα υπόλοιπα δεδομένα της μελέτης.
			</div>
			
			<div class="alert alert-block">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Σημείωση:</h4>
			<?php
			if($count_meletes==0){
			echo "Δεν βρέθηκε καμία μελέτη στο λογαριασμό σας.";
			}
			if($count_meletes==1){
			echo "Βρέθηκε ".$count_meletes." μελέτη στο λογαριασμό χρήστη";
			}
			if($count_meletes>1){
			echo "Βρέθηκαν ".$count_meletes." μελέτες στο λογαριασμό χρήστη";
			}
			?>
			</div>
		<?php
		}
		?>
		
		</div><!-- /span2 -->
		
		<div class="span10">

		<?php
		//Ο χρήστης δεν είναι συνδεδεμένος
		if(!isset($_SESSION['user_id'])){
		
		?>
			
			<!-- Login Form -->
			<form class="clearfix" action="" method="post">
				<h1>Σύνδεση χρήστη</h1>
				
				<div class="input-prepend">
				<span class="add-on">@</span>
				<input class="input-medium" type="text" name="username" id="username" placeholder="Όνομα χρήστη" length="50">
				</div>
				<div class="input-prepend">
				<span class="add-on">*</span>
				<input class="input-medium" type="password" name="password" id="password" placeholder="Κωδικός">
				</div>
				
				<label><input name="rememberMe" id="rememberMe" type="checkbox" checked="checked" value="1" /> &nbsp;Να με θυμάσαι</label>
				<div class="clear"></div>
				<!--<input type="submit" name="submit" value="Login" class="bt_login" />-->
				<button type="submit" name="submit" value="Login" class="btn">Σύνδεση</button>
			</form>
			
			<?php
			if($registration==1){
			?>
			<!-- Register Form -->
			<form action="" method="post">
				<h1>Δεν είστε ακόμα μέλος; Εγγραφή!</h1>		

				<label class="grey" for="username">Όνομα χρήστη:</label>
				<input class="field" type="text" name="username" id="username" value="" size="23" />
				<label class="grey" for="email">Email:</label>
				<input class="field" type="text" name="email" id="email" size="23" />
				<label>Ο κωδικός θα σταλεί στο e-mail.</label>
				<!--<input type="submit" name="submit" value="Register" class="bt_register" />-->
				<button type="submit" name="submit" value="Register" class="btn">Εγγραφή</button>
			</form>
            <?php
			}
			?>
			
			
            <?php
			}else{ //Ο χρήστης είναι συνδεδεμένος
			
			?>
            
			<!--
			<h1>Μενού χρήστη</h1>
			<a class="btn btn-info" href="?nav=show_users">Επεξεργασία χρηστών</a>			
			<a class="btn btn-danger" href="?logoff">Αποσύνδεση</a>		
			-->
			
			<h1>Μελέτες χρήστη</h1>
			
			<form action="" method="post">
			<input type="text" name="onoma_meletis" size="50" placeholder="Όνομα νέας μελέτης">
			<button type="submit" name="submit" value="neameleti" class="btn">Νέα μελέτη</button>
			</form>
			
			<table class="table table-bordered table-hover">
			<tr>
			<th width=10%><a href="#" id="tb_meletes_aa" data-toggle="tooltip" title="Αρίθμηση και σε σημείωση το id του πίνακα meletes (εάν ζητηθεί από το διαχειριστή για υποστήριξη)">α/α</a></th>
			<th width=40%><a href="#" id="tb_meletes_onoma" data-toggle="tooltip" title="Χαρακτηριστικό όνομα της μελέτης. Συμβαδίζει με την επωνυμία">Όνομα</a></th>
			<th width=30%><a href="#" id="tb_meletes_address" data-toggle="tooltip" title="Η διεύθυνση της επιχείρησης όπως προστέθηκε στα γενικά στοιχεία">Διεύθυνση</a></th>
			<th width=10%><a href="#" id="tb_meletes_epiloges" data-toggle="tooltip" title="Επιλογές για την επιλογή/διαγραφή μελέτης">Ενέργειες</a></th>
			<th width=10%><a href="#" id="tb_meletes_teyxos" data-toggle="tooltip" title="Εάν έχει δημιουργηθεί το τεύχος εμφανίζεται εικονίδιο για κατέβασμα">Τεύχος</a></th>
			<th colspan="3" width=10%></th>
			</tr>
			<?php
			for ($i=1; $i<=$count_meletes; $i++){
			echo "<tr>";
			echo "<td><span class=\"label label-inverse\">".$i."</span><span class=\"label label-Info\">meletes.id=".${"meletes_id".$i}."</span></td><td>".${"meletes_name".$i}."</td><td>".${"meletes_address".$i}."</td>";
			echo "<td>";
			echo "<div class=\"btn-group\">";
			echo "<a class=\"btn\" href=\"?action=select_meleti&meleti_id=".${"meletes_id".$i}."\">Επιλογή</a>";
			//echo "<button class=\"btn\">Επιλογές</button>";
			echo "<button class=\"btn dropdown-toggle\" data-toggle=\"dropdown\">";
			echo "<span class=\"caret\"></span>";
			echo "</button>";
			echo "<ul class=\"dropdown-menu\">";
			echo "<li><a tabindex=\"1\" href=\"?action=select_meleti&meleti_id=".${"meletes_id".$i}."\"><i class=\"icon-check\"></i>Επιλογή</a></li>";
			echo "<li><a tabindex=\"2\" href=\"?action=delete_meleti&meleti_id=".${"meletes_id".$i}."\"><i class=\"icon-trash\"></i>Διαγραφή</a></li>";
			echo "</ul>";
			echo "</div></td>";
				$filename = "output/ta_user".$_SESSION['user_id']."-meleti".${"meletes_id".$i}."-teyxos.pdf";
				if(file_exists($filename)){
				echo "<td><a href=\"".$filename."\" target=\"_blank\"><img src=\"images/pdf.png\"></a></td>";
				}else{
				echo "<td><img src=\"images/no.png\"></td>";
				}
			echo "</tr>";
			}
			?>
			</table>
			
			
			<?php
				$xmltxt = "";
				$cattxt = "";
			
				// array σε μορφή javascript
				foreach($data_user as $data){
					if($xmltxt!=""){
						$xmltxt.=",";
					}
				$xmltxt .= "[".$data["id"].",'".$data["name"]."','".$data["perigrafi"]."',".$data["type"].",'".$data["address"]."',".$data["lat"].",".$data["lon"]."]";
				}
				
				$data_cat = $database->select("library_industry_cat","*");
				foreach($data_cat as $data){
					if($cattxt!=""){
						$cattxt.=",";
					}
				$cattxt .= "[".$data["cat"].",'".$data["name"]."']";
				}
				
			?>
			<style>
			  #mapCanvas {
				width: 100%;
				height: 500px;
				padding: 3px;
				border: 5px solid #ddd;
			  }
			  #infoPanel {
				float: left;
				margin-left: 10px;
			  }
			  #infoPanel div {
				margin-bottom: 5px;
			  }
			</style>
			
			<div id="mapCanvas"></div>
			
			<script type="text/javascript">
			
			var points = [
			<?php echo $xmltxt; ?>
			];
			var categories = [
			<?php echo $cattxt; ?>
			];
			
			
			var map = new google.maps.Map(document.getElementById('mapCanvas'), {
			  zoom: 6,
			  center: new google.maps.LatLng(39, 22),
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			});

			var infowindow = new google.maps.InfoWindow();

			var marker, i;
			var html = new Array();

			for (i = 0; i < points.length; i++) {
			
				var id = points[i][0];
				var name = points[i][1];
				var perigrafi = points[i][2];
				var type = categories[points[i][3]-1][1];
				var address = points[i][4];
				var lat = points[i][5];
				var lon = points[i][6];
				html[i] = "<b>Meleti_id:</b>"+id+"<br/>" + "<b>Μελέτη:</b>"+name+"<br/>" + "<b>Περιγραφή:</b>"+perigrafi+"<br/>" + "<b>Τύπος:</b>"+type+"<br/>" +
				"<b>Διεύθυνση:</b>"+address+"<br/>" + "<b>lat:</b>"+lat+"<br/>" + "<b>lon:</b>"+lon+"<br/>";
			
			var myLatLng = 	new google.maps.LatLng(lat, lon);

			  marker = new google.maps.Marker({
				position: myLatLng,
				map: map
			  });

			  google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
				return function() {
				  infowindow.setContent(html[i]);
				  infowindow.open(map, marker);
				}
			  })(marker, i));

			}
			</script>
			
            <?php
			}
			?>
		</div><!-- /span10 -->
	</div><!-- /row-fluid -->
</div><!-- /container-fluid -->