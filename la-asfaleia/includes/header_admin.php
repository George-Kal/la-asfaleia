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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Λογισμικό τεχνικού ασφαλείας &amp εκτίμησης επαγγελματικού κινδύνου</title>
    
	<link rel="stylesheet" href="javascripts/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="javascripts/bootstrap/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css" media="screen" />
	<link href="stylesheets/jquery-ui-1.9.2.custom.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css"  href="stylesheets/jtable_grey.css"/>
	<link rel="stylesheet" type="text/css"  href="stylesheets/calendar.css"/>
	
	<script src="javascripts/jquery-1.8.3.js" type="text/javascript"></script>
	<script src="javascripts/jquery-ui-1.9.2.custom.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="javascripts/jquery.jtable.js"></script>
	<script type="text/javascript" src="javascripts/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="javascripts/bootstrap/js/bootstrap.js" /></script>
	<script type="text/javascript" src="javascripts/bootstrap/js/bootstrap-tooltip.js" /></script>
	<script type="text/javascript" src="includes/ckeditor/ckeditor.js"></script>
	
	<script type="text/javascript" src="javascripts/main.js" /></script>
	
    
    <!-- PNG FIX for IE6 -->
    <!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
    <!--[if lte IE 6]>
        <script type="text/javascript" src="login_panel/js/pngfix/supersleight-min.js"></script>
    <![endif]-->
    
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	 <style>
	.ui-tabs-vertical { width: 99%; }
	.ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 20%; }
	.ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
	.ui-tabs-vertical .ui-tabs-nav li a { display:block; }
	.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
	.ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 75%;}
	</style>
</head>