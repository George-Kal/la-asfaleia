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
				<h4>Θέση</h4>
				Σύρετε το δείκτη στο χάρτη στη θέση που βρίσκεται η επιχείρηση. Οι συντεταγμένες καθώς και η διεύθυνση 
				εισάγονται αυτόματα. Εάν η διεύθυνση δεν εμφανίζεται σωστά μπορείτε να την τροποποιήσετε. <br/><br/>
				Προσθέστε το όνομα της επιχείρησης, μια σύντομη περιγραφή και το είδος της επιχείρησης. <br/><br/>
				Αφού προσθέσετε όλα τα στοιχεία πατήστε αποθήκευση θέσης ώστε να αποθηκευτούν τα δεδομένα για την παρούσα μελέτη.
				</div>
				
				<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Υπεύθυνος επιχείρησης</h4>
				Δηλώστε τα στοιχεία του ιδιοκτήτη ή νομίμου εκπροσώπου της επιχείρησης όπως θέλετε να εμφανίζεται στα έντυπα των συμβάσεων 
				και λοιπά έντυπα προς τις υπηρεσίες του Σ.ΕΠ.Ε.
				</div>
				
				<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Λοιπά κείμενα</h4>
				Συμπληρώστε σε σύντομα κείμενα την παραγωγική διαδικασία της επιχείρησης και τα συμπεράσματά σας από την εκτίμηση επαγγελματικών 
				κινδύνων. Μπορείτε να αφήσετε τα συμπεράσματα κενά και να επιστρέψετε εδώ εφόσον προσθέσετε όλα τα στοιχεία των εργαζομένων, πηγών 
				κινδύνων κλπ στα επόμενα μενού.
				</div>
		</div>
		
		<div class="span10">
			<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Θέση</a></li>
				<li><a href="#tabs-2">Υπεύθυνος επιχείρησης</a></li>
				<li><a href="#tabs-3">Παραγωγική διαδικασία</a></li>
				<li><a href="#tabs-4">Συμπεράσματα</a></li>
			</ul>
			
			<div id="tabs-1">
			<?php
			$database = new medoo(DB_NAME);
			
			
			$db_table = "meletes";
			$db_columns = "*";
			$where_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"id" => $_SESSION['meleti_id']));
			$select_meleti = $database->select($db_table,$db_columns,$where_parameters);
			
			$name = $select_meleti[0]["name"];
			$perigrafi = $select_meleti[0]["perigrafi"];
			$toponymio = $select_meleti[0]["toponymio"];
			$address = $select_meleti[0]["address"];
			$type = $select_meleti[0]["type"];
			$lat = $select_meleti[0]["lat"];
			$lon = $select_meleti[0]["lon"];
			$afm = $select_meleti[0]["afm"];
			$doy = $select_meleti[0]["doy"];
			$tel = $select_meleti[0]["tel"];
			$paragwgiki = $select_meleti[0]["paragwgiki"];
			$symperasmata = $select_meleti[0]["symperasmata"];
			
			
			$db_table1 = "meleti_idioktitis";
			$db_columns1 = "*";
			$where_parameters1 = array("AND" => array("user_id" => $_SESSION['user_id'],"id" => $_SESSION['meleti_id']));
			$select_meleti1 = $database->select($db_table1,$db_columns1,$where_parameters1);
			
			$idio_name = $select_meleti1[0]["name"];
			$idio_father = $select_meleti1[0]["father"];
			$idio_mother = $select_meleti1[0]["mother"];
			$idio_address = $select_meleti1[0]["address"];
			$idio_tel = $select_meleti1[0]["tel"];
			$idio_afm = $select_meleti1[0]["afm"];
			$idio_adt = $select_meleti1[0]["adt"];
			
			?>
			
			<script type="text/javascript">
			var geocoder = new google.maps.Geocoder();

			function geocodePosition(pos) {
			  geocoder.geocode({
				latLng: pos
			  }, function(responses) {
				if (responses && responses.length > 0) {
				  updateMarkerAddress(responses[0].formatted_address);
				} else {
				  updateMarkerAddress('Άγνωστη τοποθεσία');
				}
			  });
			}

			function updateMarkerStatus(str) {
			  document.getElementById('markerStatus').innerHTML = str;
			}

			function updateMarkerPosition(latLng) {
				document.getElementById("lat").value = latLng.lat();
				document.getElementById("lon").value = latLng.lng();
			}

			function updateMarkerAddress(str) {
			  document.getElementById('address_from_map').innerHTML = str;
			}

			function initialize() {
			  var latLng = new google.maps.LatLng(<?php echo $lat;?>, <?php echo $lon;?>);
			  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
				zoom: 14,
				center: latLng,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			  });
			  var marker = new google.maps.Marker({
				position: latLng,
				title: 'Point A',
				map: map,
				draggable: true
			  });
			  
			  // Update current position info.
			  updateMarkerPosition(latLng);
			  geocodePosition(latLng);
			  
			  // Add dragging event listeners.
			  google.maps.event.addListener(marker, 'dragstart', function() {
				updateMarkerAddress('Τοποθετήστε το δείκτη...');
			  });
			  
			  google.maps.event.addListener(marker, 'drag', function() {
				updateMarkerStatus('Τοποθετήστε το δείκτη...');
				updateMarkerPosition(marker.getPosition());
			  });
			  
			  google.maps.event.addListener(marker, 'dragend', function() {
				updateMarkerStatus('Τοποθετήθηκε ο δείκτης');
				geocodePosition(marker.getPosition());
			  });
			}

			// Onload handler to fire off the app.
			google.maps.event.addDomListener(window, 'load', initialize);
			</script>
			
			
				<div id="mapCanvas"></div>
				<div id="infoPanel">
				<b>Στοιχεία επιχείρησης:</b>
				<div id="markerStatus"><i>Αλλάξτε τη θέση του δείκτη.</i></div>
				<div id="address_from_map"></div>
				<form name="map_form" action="index.php" method="POST">
				
				<table>
				<tr><td><b>Διεύθυνση:</b></td><td><input class="input-xxlarge" type="text" id="address" name="address" value="<?php echo $address;?>"></td></tr>
				<tr><td><b>Lat:</b></td><td><input type="text" id="lat" name="lat" value="<?php echo $lat;?>"></td></tr>
				<tr><td><b>Long:</b></td><td><input type="text" id="lon" name="lon" value="<?php echo $lon;?>"></td></tr>
				<tr><td><b>Τοπωνύμιο:</b></td><td><input type="text" id="toponymio" name="toponymio" value="<?php echo $toponymio;?>"></td></tr>
				<tr><td><b>Επωνυμία:</b></td><td><input type="text" id="name" name="name" value="<?php echo $name;?>"><span class="help-inline">*όνομα μελέτης</span></td></tr>
				<tr><td><b>Περιγραφή:</b></td><td><input type="text" id="perigrafi" name="perigrafi" value="<?php echo $perigrafi;?>"></td></tr>
				<tr>
				<td><b>Αντ. εργασιών:</b></td>
				<td>
				<?php
				echo make_selectbox("library_industry_cat","type");
				?>
				<script language="JavaScript">
					document.getElementById("type").selectedIndex=<?php echo $type;?>;
				</script>
				<span class="help-inline">*ΠΔ294/88,ΣΤΑΚΟΔ 1980</span>
				</td></tr>
				<tr><td><b>ΑΦΜ:</b></td><td><input type="text" id="afm" name="afm" value="<?php echo $afm;?>"></td></tr>
				<tr><td><b>ΔΟΥ:</b></td><td><input type="text" id="doy" name="doy" value="<?php echo $doy;?>"></td></tr>
				<tr><td><b>Τηλέφωνο:</b></td><td><input type="text" id="tel" name="tel" value="<?php echo $tel;?>"></td></tr>
				</table>
				<br/>
				<button type="submit" name="submit" value="save-location" class="btn btn-primary">Αποθήκευση θέσης</button>
				</form>
				
				<br/>
				<p><a href="#" id="dialog-ktimatologio-link" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>Κτηματολόγιο</a></p>
				<!-- ui-ktimatologio -->
				<div id="dialog-ktimatologio" title="Πληροφορίες">
				<iframe src="http://gis.ktimanet.gr/wms/ktbasemap/default.aspx" height="100%" width="100%"></iframe>
				</div>
				</div>
			
			</div>
			
			<div id="tabs-2"> 
			<img src="images/person.png"><br/>
			<form name="idioktitis_form" action="index.php" method="POST">
				
				<table>
				<tr><td><b>Ονοματεπώνυμο:</b></td><td><input type="text" id="idio_name" name="idio_name" value="<?php echo $idio_name;?>"></td></tr>
				<tr><td><b>Όν. Πατέρα:</b></td><td><input type="text" id="idio_father" name="idio_father" value="<?php echo $idio_father;?>"></td></tr>
				<tr><td><b>Ον. Μητέρας:</b></td><td><input type="text" id="idio_mother" name="idio_mother" value="<?php echo $idio_mother;?>"></td></tr>
				<tr><td><b>Δ/νση:</b></td><td><input type="text" id="idio_address" name="idio_address" value="<?php echo $idio_address;?>"></td></tr>
				<tr><td><b>Τηλ.:</b></td><td><input type="text" id="idio_tel" name="idio_tel" value="<?php echo $idio_tel;?>"></td></tr>
				<tr><td><b>ΑΦΜ:</b></td><td><input type="text" id="idio_afm" name="idio_afm" value="<?php echo $idio_afm;?>"></td></tr>
				<tr><td><b>ΑΔΤ:</b></td><td><input type="text" id="idio_adt" name="idio_adt" value="<?php echo $idio_adt;?>"></td></tr>
				</table>
				<br/>
				<button type="submit" name="submit" value="save-idioktitis" class="btn btn-primary">Αποθήκευση ιδιοκτήτη</button>
				</form>
			</div>
			
			
			<div id="tabs-3">
			Περιγράψτε σε σύντομο κείμενο την παραγωγική διαδικασία της επιχείρησης.<br/>
				<form id="form_paragwgiki" action="" method="post">
				<div id="kefalaio">
				<div id="container" style="background:#eee;border:1px solid #000000;padding:3px;width:99%;height:610px;">
				<textarea name="text_paragwgiki" id="text_paragwgiki" ><?php echo $paragwgiki;?></textarea>
				<script type="text/javascript">CKEDITOR.replace('text_paragwgiki');</script>
				</div>
				</div>
				
				<button type="submit" name="submit" value="save-paragwgiki" class="btn btn-primary">Αποθήκευση παραγωγικής διαδικασίας</button>
				</form>
			</div>
				
		

			<div id="tabs-4">
			Μπορείτε πρώτα να προσθέσετε όλα τα στοιχεία της επιχείρησης και έπειτα να επιστρέψετε εδώ ώστε να γράψετε σέ σύντομο 
			κείμενο τα συμπεράσματά σας.<br/>
				<form id="form_symperasmata" action="" method="post">
				<div id="kefalaio">
				<div id="container" style="background:#eee;border:1px solid #000000;padding:3px;width:99%;height:610px;">
				<textarea name="text_symperasmata" id="text_symperasmata" ><?php echo $symperasmata;?></textarea>
				<script type="text/javascript">CKEDITOR.replace('text_symperasmata');</script>
				</div>
				</div>
				
				<button type="submit" name="submit" value="save-symperasmata" class="btn btn-primary">Αποθήκευση Συμπερασμάτων</button>
				</form>
			</div>
				
			</div>
			
		</div>
	</div>
</div>
