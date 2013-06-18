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
$script = '';

//Έλεγχος μήπως επανεκκινήθηκε ο browser και δεν υπάρχει το "να με θυμάσαι" cookie
if(isset($_SESSION['user_id']) && !isset($_COOKIE['asfaleiaRemember']) && !$_SESSION['rememberMe'])
{
	// Εάν ο χρήστης είναι συνδεδεμένος, αλλά δεν υπάρχει το asfaleiaRemember cookie (πχ επανεκιννήθηκε ο browser)
	// και δεν επιλέχθηκε το "να με θυμάσαι":

	// Καταστροφή της συνεδρίας
	$_SESSION = array();
	session_destroy();
	
}

//Φόρμα για logout
if(isset($_GET['logoff']))
{
	$_SESSION = array();
	session_destroy();
	
	header("Location: index.php?nav=user_logout");
	exit;
}

//Φόρμα για σύνδεση
if(isset($_POST['submit']) AND $_POST['submit']=='Login'){
	
	$err = array();
	//Κρατάει τα λάθη
	
	
	if(!$_POST['username'] || !$_POST['password']){
		$err[] = 'Λείπει το όνομα χρήστη ή/και ο κωδικός!';
	}
	if(!count($err)){
		//Έλεγχος πριν την είσοδο στη βάση
		$_POST['username'] = mysql_real_escape_string($_POST['username']);
		$_POST['password'] = mysql_real_escape_string($_POST['password']);
		$_POST['rememberMe'] = (int)$_POST['rememberMe'];
		
		//Αυτή η γραμμή ελέγχει το χρήστη στη βάση δεδομένων
		//Για τη σύνδεση σε ήδη υπάρχουσες βάσεις δεδομένων με χρήστες μπορεί να γίνει το εξής:
		//1.Να ελέγχεται ο χρήστης στην βάση του la-asfaleia για αρχή. 
		//2.Εάν βρεθεί στη βάση του la-asfaleia να προχωράμε με το login
		//3.Εάν δεν βρεθεί να ελέγχεται ο χρήστης στην άλλη βάση. 
		//4.Εάν βρεθεί στην άλλη βάση να δημιουργείται μια γραμμή στον πίνακα users του la-asfaleia και να επανελέγχεται ο χρήστης στο la-asfaleia (οπότε θα προχωράει και με το login)
		//Αυτός ο τρόπος ευννοεί την ασφάλεια. Καθώς οι χρήστες κρατώνται μόνο στο la-asfaleia χωρίς να "κινδυνεύει" η λίστα χρηστών και οι ρυθμίσεις τους στην άλλη βάση. 
		//ΣΗΜΕΙΩΣΗ: Στο la-asfaleia όπως φαίνεται παρακάτω οι κωδικοί αποθηκεύονται με md5()
		$database = new medoo(DB_NAME);

		$user_table = "users";
		$where_parameters = array("AND"=>array ("usr" => $_POST['username'],"pass"=>md5($_POST['password']) ));
		$select_user = $database->select($user_table,"*",$where_parameters);
		
		//Πρέπει να επιστρέφει 1.
		$count_user = $database->count($user_table, $where_parameters);
		
		//Δεν βρέθηκε ο χρήστης
		if($count_user==0){
		
		}

		//Εάν βρεθεί η γραμμή υπάρχει ο χρήστης και ορίζω ότι επιστρέφει η βάση στο session cookie
		if($select_user[0]["usr"]){
			$_SESSION['username']=$select_user[0]["usr"];
			$_SESSION['user_id'] = $select_user[0]["id"];
			$_SESSION['rememberMe'] = $_POST['rememberMe'];
			
			//Ορίζω δεδομένα στο cookie asfaleiaRemember
			setcookie('asfaleiaRemember',$_POST['rememberMe']);
		}
		
		/*
		//--------------------------------------------------------------------------------------------------------------
		//Εάν υπάρχει και άλλος πίνακας για να ψάξει το λογισμικό χρήστες (phpbb) αφαιρέστε από τα σχόλια το παρακάτω if
		//και διορθώστε ανάλογα τον πίνακα και τη διαδρομή για το phpbb
		//Δεν βρέθηκε η γραμμή στον πίνακα χρηστών του la-asfaleia. Ελέγχω στον άλλο πίνακα (χρήστες του phpbb3)
		
		$database_phpbb = "DATABASE_PHPBB"; //Προσθέστε εδώ τη βάση δεδομένων του phpbb
		$userstable_phpbb = "USERSTABLE_PHPBB"; //Προσθέστε εδώ τον πίνακα για τους χρήστες στο phpbb (συνήθως phpbb_users)
		$folder_phpbb = "DIADROMI_PHPBB"; //Προσθέστε εδώ τη σχετική διαδρομή του phpbb σε σχέση με το la-asfaleia (πχ εάν στο root υπάρχει ένας φάκελος για το ασφάλεια και ένας φάκελος για το phpbb3 προσθέστε ../phpbb3/)
		
		if(!$select_user[0]["usr"]){
			//Η βάση δεδομένων του phpbb
			$database_bb = new medoo($database_phpbb);
			
			//Επιλέγω τη γραμμή με το χρήστη από το phpbb
			$where_parameters_bb = array ("username" => $_POST['username']);
			$select_user_bb = $database_bb->select($userstable_phpbb,"*",$where_parameters_bb);
			
			//Εάν βρεθεί ο χρήστης στον πίνακα users του phpbb
			if($select_user_bb[0]["username"]){
				
				//Ελέγχω αν είναι ίδιος ο κωδικός χρησιμοποιώντας τις εγγενείς function του phpbb.Αυτό γιατί ο κωδικός γίνεται hash εκεί όχι με απλό md5()
				define('IN_PHPBB', true);
				$phpbb_root_path = $folder_phpbb;
				$phpEx = substr(strrchr(__FILE__, '.'), 1);
				include($phpbb_root_path . 'common.' . $phpEx);
				
				if (phpbb_check_hash($_POST['password'], $select_user_bb[0]["user_password"])){
				$err[]='Ταυτοποιήθηκε ο χρήστης στο forum. Τώρα μπορείτε να συνδέεστε και εδώ με τον ίδια στοιχεία.';
				$insert_parameters = array("usr"=>$select_user_bb[0]["username"],"pass"=>md5($_POST['password']) );
			
				//Προσθήκη του χρήστη στη βάση του la-asfaleia
				$insert_user = $database->insert($user_table,$insert_parameters);
				
				//Επανέλεγχος στη βάση του la-asfaleia αν υπάρχει ο χρήστης (για να δω αν έγινε σωστά η προσθήκη)
				$select_user = $database->select($user_table,"*",$where_parameters);
					if($select_user[0]["usr"]){
						$_SESSION['username']=$select_user[0]["usr"];
						$_SESSION['user_id'] = $select_user[0]["id"];
						$_SESSION['rememberMe'] = $_POST['rememberMe'];
						
						//Ορίζω δεδομένα στο cookie asfaleiaRemember
						setcookie('asfaleiaRemember',$_POST['rememberMe']);
					}
				}//Έλεγχος κωδικού στο phpbb
			}//Βρέθηκε ο χρήστης στο phpbb
		}//Δεν βρέθηκε ο χρήστης στο la-asfaleia
		//-------------------------------------------------------------------------------------------------------------------
		*/
		
		if(!$select_user[0]["usr"] AND !$select_user_bb[0]["username"]){
		$err[]='Λάθος όνομα χρήστη ή/και κωδικός! Προσπαθήστε ξανά';
		}
	}
	
	if($err)
	$_SESSION['msg']['login-err'] = implode('<br />',$err);
	//Αποθήκευση των λαθών στο session

	header("Location: index.php?nav=user_login");
	exit;
}
//Φόρμα για εγγραφή
else if(isset($_POST['submit']) AND $_POST['submit']=='Register')
{
	//Υποβλήθηκε η φόρμα για εγγραφή
	
	$err = array();
	
	if(strlen($_POST['username'])<4 || strlen($_POST['username'])>32)
	{
		$err[]='Το όνομα χρήστη πρέπει να είναι μεταξύ 3ων και 32 χαρακτήρων!';
	}
	
	if(preg_match('/[^a-z0-9\-\_\.]+/i',$_POST['username']))
	{
		$err[]='Το όνομα χρήστη περιέχει μη αποδεκτούς χαρακτήρες!';
	}
	
	if(!checkEmail($_POST['email']))
	{
		$err[]='Το e-mail που δηλώσατε δεν είναι σωστό!';
	}
	
	if(!count($err))
	{
		//Δεν υπάρχουν λάθη
		
		$pass = substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
		//Δημιουργία τυχαίου κωδικού
		
		$_POST['email'] = mysql_real_escape_string($_POST['email']);
		$_POST['username'] = mysql_real_escape_string($_POST['username']);
		//Τα εισερχόμενα στοιχεία (έλεγχος)
		
		
		mysql_query("	INSERT INTO tz_members(usr,pass,email,regIP,dt)
						VALUES(
						
							'".$_POST['username']."',
							'".md5($pass)."',
							'".$_POST['email']."',
							'".$_SERVER['REMOTE_ADDR']."',
							NOW()
							
						)");
		
		if(mysql_affected_rows($connection)==1)
		{
			send_mail(	'la123@otenet.gr',
						$_POST['email'],
						'Λογισμικό τεχνικού ασφαλείας - Ο κωδικός σας',
						'Ο κωδικός σας είναι: '.$pass);

			$_SESSION['msg']['reg-success']='Σας στείλαμε ένα e-mail με τον κωδικό σας!';
		}
		else $err[]='Το όνομα χρήστη χρησιμοποιείται ήδη!';
	}

	if(count($err))
	{
		$_SESSION['msg']['reg-err'] = implode('<br />',$err);
	}	
	
	header("Location: index.php?nav=user_login");
	exit;
}



//Φόρμα για UPDATE στοιχείων χρήστη
if(isset($_POST['submit']) AND $_POST['submit']=='save-userpref')
{
$database = new medoo(DB_NAME);
$db_table = "users";
$update_parameters = array(
	"onoma" => $_POST['onoma'],
	"email" => $_POST['email'],
	"eidikotita" => $_POST['eidikotita'],
	"ptyxio_years" => $_POST['ptyxio_years'],
	"address" => $_POST['address'],
	"tel" => $_POST['tel'],
	"taytotita" => $_POST['taytotita'],
	"afm" => $_POST['afm']
	);
$where_parameters = array ("id" => $_SESSION['user_id']);
$update_user = $database->update($db_table,$update_parameters,$where_parameters);

header("Location: index.php?nav=user_preferences");
exit;
}


//Φόρμα για αλλαγή κωδικού
if(isset($_POST['submit']) AND $_POST['submit']=='update-password'){

$err = array();

$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$newpassword1 = $_POST['newpassword1'];
$newpassword2 = $_POST['newpassword2'];
$hashed_pass = md5($newpassword1);

	if($password1==$password2 AND $newpassword1==$newpassword2){
	$database = new medoo(DB_NAME);
	$db_table = "users";
	$update_parameters = array("pass" => $hashed_pass);
	$where_parameters = array ("id" => $_SESSION['user_id']);
	$update_user = $database->update($db_table,$update_parameters,$where_parameters);
	}else{
		if($password1!=$password2){
		$err[]="Ο παλιός κωδικός δεν ήταν ίδιος στα δύο κελιά";
		}
		if($newpassword1!=$newpassword2){
		$err[]="Ο νέος κωδικός δεν ήταν ίδιος στα δύο κελιά";
		}
	}
	
	if(count($err))
	{
		$_SESSION['msg']['pass-err'] = implode('<br />',$err);
	}	
header("Location: index.php?nav=user_preferences");
exit;
}



//Φόρμα για Επιλογή μελέτης
if(isset($_GET['action']) AND $_GET['action']=='select_meleti')
{
$_SESSION['meleti_id']=$_GET['meleti_id'];

$database = new medoo(DB_NAME);
$db_table = "meletes";
$db_columns = array ("name");
$select_parameters = array ("AND" => array("id" => $_GET['meleti_id'],"user_id" => $_SESSION['user_id']));
$select_meleti = $database->select($db_table,$db_columns,$select_parameters);

$_SESSION['meleti_name']=$select_meleti[0]["name"];

/*
//check εαν υπαρχει η γραμμη στον πινακα meleti_programma_ta
check_prog_ta($_SESSION['user_id'], $_SESSION['meleti_id']);
//check εαν υπαρχει η γραμμη στον πινακα meleti_programma_ie
check_prog_ie($_SESSION['user_id'], $_SESSION['meleti_id']);
*/

header("Location: index.php?nav=user_login");
exit;
}

//Φόρμα για διαγραφή μελέτης
if(isset($_GET['action']) AND $_GET['action']=='delete_meleti')
{
//Κρατάει τα λάθη.
$err = array();

$database = new medoo(DB_NAME);
$db_table = "meletes";
$meleti_tables = array("meletes","meleti_entypa","meleti_idioktitis","meleti_ktiria","meleti_metra","meleti_piges","meleti_programma_ie","meleti_programma_ta","meleti_proswpiko","meleti_qa","meleti_sxedio","meleti_teyxos","meleti_ypeythinos");
$db_columns = array ("id","user_id","name");
$select_parameters = array ("AND" => array("id" => $_GET['meleti_id'],"user_id" => $_SESSION['user_id']));
$delete_parameters = array("id" => $_GET['meleti_id']);
$delete_parameters1 = array("meleti_id" => $_GET['meleti_id']);
$select_meleti = $database->select($db_table,$db_columns,$select_parameters);

	//Ελεγχος για το αν όντως η μελέτη ανήκει στο συνδεδεμένο χρήστη.
	if ($select_meleti[0]["user_id"] == $_SESSION['user_id']){

	$delete_meleti = $database->delete($db_table,$delete_parameters);

		foreach($meleti_tables as $table){
		$delete_meleti1 = $database->delete($table,$delete_parameters1);
		}

		$filename = "output/ta_user".$select_meleti[0]["user_id"]."-meleti".$_GET['meleti_id']."-teyxos.pdf";
		if(file_exists($filename)){
		unlink($filename);
		}
	}else{
	exit;
	}

if ($_SESSION['meleti_id']==$_GET['meleti_id']){
unset($_SESSION['meleti_id']);
unset($_SESSION['meleti_name']);
}

header("Location: index.php?nav=user_login");
exit;
}



//Φόρμα για νέα μελέτη
if(isset($_POST['submit']) AND $_POST['submit']=='neameleti')
{
$database = new medoo(DB_NAME);
$db_table = "meletes";
$db_columns = array ("id","name");
$insert_parameters = array("user_id" => $_SESSION['user_id'],"name" => $_POST['onoma_meletis']);
$select_parameters = array ("AND" => array("name" => $_POST['onoma_meletis'],"user_id" => $_SESSION['user_id']));
$insert_meleti = $database->insert($db_table,$insert_parameters);
$select_meleti = $database->select($db_table,$db_columns,$select_parameters);

//Προσθήκη γραμμής για τον ιδιοκτήτη
$db_table1 = "meleti_idioktitis";
$insert_parameters1 = array("user_id" => $_SESSION['user_id'],"meleti_id" => $select_meleti[0]["id"]);
$insert_meleti1 = $database->insert($db_table1,$insert_parameters1);

//Επιλογή της μελέτης κατευθείαν με την δημιουργία της
$_SESSION['meleti_id']=$select_meleti[0]["id"];
$_SESSION['meleti_name']=$select_meleti[0]["name"];

header("Location: index.php?nav=user_login");
exit;
}

//Φόρμα για UPDATE στοιχείων μελέτης
if(isset($_POST['submit']) AND $_POST['submit']=='save-location')
{
$database = new medoo(DB_NAME);
$db_table = "meletes";
$update_parameters = array(
	"name" => $_POST['name'],
	"perigrafi" => $_POST['perigrafi'],
	"toponymio" => $_POST['toponymio'],
	"address" => $_POST['address'],
	"type" => $_POST['type'],
	"lat" => $_POST['lat'],
	"lon" => $_POST['lon'],
	"afm" => $_POST['afm'],
	"doy" => $_POST['doy'],
	"tel" => $_POST['tel']
	);
$where_parameters = array ("AND" => array("user_id" => $_SESSION['user_id'],"id" => $_SESSION['meleti_id']));
$update_meleti = $database->update($db_table,$update_parameters,$where_parameters);

$_SESSION['meleti_name'] = $_POST['name'];

header("Location: index.php?nav=meleti_general");
exit;
}


//Φόρμα για UPDATE στοιχείων ιδοκτήτη
if(isset($_POST['submit']) AND $_POST['submit']=='save-idioktitis')
{
$database = new medoo(DB_NAME);
$db_table = "meleti_idioktitis";
$update_parameters = array(
	"name" => $_POST['idio_name'],
	"father" => $_POST['idio_father'],
	"mother" => $_POST['idio_mother'],
	"address" => $_POST['idio_address'],
	"tel" => $_POST['idio_tel'],
	"afm" => $_POST['idio_afm'],
	"adt" => $_POST['idio_adt']
	);
$where_parameters = array ("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
$update_meleti = $database->update($db_table,$update_parameters,$where_parameters);

header("Location: index.php?nav=meleti_general");
exit;
}


//Φόρμα για UPDATE κειμένου παραγωγικής διαδικασίας
if(isset($_POST['submit']) AND $_POST['submit']=='save-paragwgiki')
{
$database = new medoo(DB_NAME);
$db_table = "meletes";
$update_parameters = array("paragwgiki" => $_POST['text_paragwgiki']);
$where_parameters = array ("AND" => array("user_id" => $_SESSION['user_id'],"id" => $_SESSION['meleti_id']));
$update_meleti = $database->update($db_table,$update_parameters,$where_parameters);

header("Location: index.php?nav=meleti_general");
exit;
}

//Φόρμα για UPDATE κειμένου συμπερασμάτων
if(isset($_POST['submit']) AND $_POST['submit']=='save-symperasmata')
{
$database = new medoo(DB_NAME);
$db_table = "meletes";
$update_parameters = array("symperasmata" => $_POST['text_symperasmata']);
$where_parameters = array ("AND" => array("user_id" => $_SESSION['user_id'],"id" => $_SESSION['meleti_id']));
$update_meleti = $database->update($db_table,$update_parameters,$where_parameters);

header("Location: index.php?nav=meleti_general");
exit;
}



//Φόρμα για αποθήκευση τεύχους χρήστη
if(isset($_POST['submit']) AND $_POST['submit']=='save-teyxos'){
	
	$database = new medoo(DB_NAME);
	$teyxos_table = "meleti_teyxos";
	$where_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
	$count_teyxos = $database->count($teyxos_table, $where_parameters);
	
	for ($i=1; $i<=$count_teyxos; $i++){
	//χωρος για Update script από μεταβλητές $_POST["text_kef".$i]
	$update_parameters = array("text" => $_POST["text_kef".$i]);
	$updatewhere_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"kefalaio" => $i));
	$update_teyxos = $database->update($teyxos_table,$update_parameters,$updatewhere_parameters);
	}
}

//Φόρμα για δημιουργία τεύχους χρήστη από το πρότυπο
if(isset($_POST['submit']) AND $_POST['submit']=='create-teyxos'){

	$database = new medoo(DB_NAME);
	$teyxos_table = "meleti_teyxos";
	$protypo_table = "library_teyxos";
	$db_columns = "*";
	$where_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
	$count_teyxos = $database->count($teyxos_table, $where_parameters);
	
	//Επιλογή του πρότυπου τεύχους
	$select_protypo = $database->select($protypo_table,$db_columns);
	
	//Αντιγραφή του πρότυπου τεύχους 
	foreach($select_protypo as $protypo){
		$update_parameters = array("text" => $protypo["text"]);
		$updatewhere_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"kefalaio" => $protypo["kefalaio"]));
		$update_teyxos = $database->update($teyxos_table,$update_parameters,$updatewhere_parameters);
	}
	include("includes/update_teyxos.php");
}


//Φόρμα για αποθήκευση ΕΝΤΥΠΩΝ χρήστη
if(isset($_POST['submit']) AND $_POST['submit']=='save-entypa'){
	
	$database = new medoo(DB_NAME);
	$entypa_table = "meleti_entypa";
	$where_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
	$count_entypa = $database->count($entypa_table, $where_parameters);
	
	for ($i=1; $i<=$count_entypa; $i++){
	//χωρος για Update script από μεταβλητές $_POST["text_entypo".$i]
	$update_parameters = array("text" => $_POST["text_entypo".$i]);
	$updatewhere_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"type" => $i));
	$update_entypa = $database->update($entypa_table,$update_parameters,$updatewhere_parameters);
	}
}

//Φόρμα για δημιουργία ΕΝΤΥΠΩΝ από το πρότυπο
if(isset($_POST['submit']) AND $_POST['submit']=='create-entypa'){

	$database = new medoo(DB_NAME);
	$entypa_table = "meleti_entypa";
	$protypo_table = "library_entypa";
	$db_columns = "*";
	$where_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
	$count_entypa = $database->count($entypa_table, $where_parameters);
	
	//Επιλογή του πρότυπου τεύχους
	$select_protypo = $database->select($protypo_table,$db_columns);
	
	//Αντιγραφή του πρότυπου τεύχους 
	foreach($select_protypo as $protypo){
		$update_parameters = array("text" => $protypo["text"]);
		$updatewhere_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id'],"type" => $protypo["type"]));
		$update_teyxos = $database->update($entypa_table,$update_parameters,$updatewhere_parameters);
	}
	include("includes/update_entypa.php");
}


?>
