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
//Το αρχείο δεν εκτελείται μόνο του
require("include_check.php");
$script = '';

if(isset($_SESSION['user_id']) && !isset($_COOKIE['asfaleiaRemember']) && !$_SESSION['rememberMe'])
{
	// Εάν ο χρήστης είναι συνδεδεμένος, αλλά δεν υπάρχει το asfaleiaRemember cookie (πχ επανεκιννήθηκε ο browser)
	// και δεν επιλέχθηκε το "να με θυμάσαι":

	// Καταστροφή της συνεδρίας
	$_SESSION = array();
	session_destroy();
	
}

if(isset($_GET['logoff']))
{
	$_SESSION = array();
	session_destroy();
	
	header("Location: index.php?nav=user_logout");
	exit;
}

if(isset($_POST['submit']) AND $_POST['submit']=='Login')
{
	// Checking whether the Login form has been submitted
	
	$err = array();
	// Will hold our errors
	
	
	if(!$_POST['username'] || !$_POST['password'])
		$err[] = 'Λείπει το όνομα χρήστη ή/και ο κωδικός!';
	
	if(!count($err))
	{
		$_POST['username'] = mysql_real_escape_string($_POST['username']);
		$_POST['password'] = mysql_real_escape_string($_POST['password']);
		$_POST['rememberMe'] = (int)$_POST['rememberMe'];
		
		// Escaping all input data
		
		
		$row = mysql_fetch_assoc(mysql_query("SELECT id,usr FROM users WHERE usr='{$_POST['username']}' AND pass='".md5($_POST['password'])."'"));

		if($row['usr']){
			//Εάν βρεθεί η γραμμή υπάρχει ο χρήστης και ορίζω ότι επιστρέφει από τη βάση στο session cookie
			$_SESSION['username']=$row['usr'];
			$_SESSION['user_id'] = $row['id'];
			$_SESSION['rememberMe'] = $_POST['rememberMe'];
			
			//Ορίζω δεδομένα στο cookie asfaleiaRemember
			setcookie('asfaleiaRemember',$_POST['rememberMe']);
		}else{
		$err[]='Λάθος όνομα χρήστη ή/και κωδικός! Προσπαθήστε ξανά';
		}
	}
	
	if($err)
	$_SESSION['msg']['login-err'] = implode('<br />',$err);
	//Αποθήκευση των λαθών στο session

	header("Location: index.php?nav=user_login");
	exit;
}
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
		
		if(mysql_affected_rows($link)==1)
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