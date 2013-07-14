-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: localhost
-- Χρόνος δημιουργίας: 30 Ιουν 2013 στις 22:06:38
-- Έκδοση Διακομιστή: 5.5.16
-- Έκδοση PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Βάση: `labros_asfaleia`
--

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `library_teyxos`
--

CREATE TABLE IF NOT EXISTS `library_teyxos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kefalaio` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Άδειασμα δεδομένων του πίνακα `library_teyxos`
--

INSERT INTO `library_teyxos` (`id`, `kefalaio`, `text`) VALUES
(1, 1, '<h1>&nbsp;</h1>\r\n\r\n<h1>&nbsp;</h1>\r\n\r\n<h1>&nbsp;</h1>\r\n\r\n<h1 style="text-align: center;"><strong>ΜΕΛΕΤΗ ΕΚΤΙΜΗΣΗΣ ΕΠΑΓΓΕΛΜΑΤΙΚΩΝ ΚΙΝΔΥΝΩΝ</strong></h1>\r\n\r\n<p style="text-align: center;">&nbsp;</p>\r\n\r\n<p style="text-align: left;">&nbsp;</p>\r\n\r\n<p style="text-align: left;">&nbsp;</p>\r\n\r\n<table border="1" cellpadding="1" cellspacing="1" height="95" width="500">\r\n	<tbody>\r\n		<tr>\r\n			<td>Επωνυμία επιχείρησης:</td>\r\n			<td>{TEYXOS_EPWNYMIA}</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Διεύθυνση επιχείρησης:</td>\r\n			<td>{TEYXOS_ADDRESS}</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Αντικείμενο εργασιών:</td>\r\n			<td>{TEYXOS_ANTIKEIMENO}</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Μελετητής:</td>\r\n			<td>{TEYXOS_MELETITIS}</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n'),
(2, 2, '<p><strong>2. Εισαγωγη</strong></p>\r\n\r\n<p><em><strong>2.1. Νομοθετικό πλαίσιο</strong></em></p>\r\n\r\n<p>{TEYXOS_NOMOTHESIA}</p>\r\n\r\n<p><em><strong>2.2. Τομέας δράσης - Παραγωγική διαδικασία</strong></em></p>\r\n\r\n<p>{TEYXOS_KATIGORIA}</p>\r\n'),
(3, 3, '<p><strong>3. Χώροι εργασίας</strong></p>\r\n\r\n<p><em><strong>3.1. Στοιχεία επιχείρησης</strong></em></p>\r\n\r\n<p>{EPIXEIRISI_STOIXEIA}</p>\r\n\r\n<p><em><strong>3.2. Κτίρια/Χώροι εργασίας/Υποκαταστήματα</strong></em></p>\r\n\r\n<p>{EPIXEIRISI_KTIRIA}</p>\r\n'),
(4, 4, '<p><strong>4. Εργαζόμενοι</strong></p>\r\n\r\n<p><em><strong>4.1. Τεχνικός ασφαλείας</strong></em></p>\r\n\r\n<p>4.1.1. Στοιχεία υπευθύνου</p>\r\n\r\n<p>{TA_STOIXEIA}</p>\r\n\r\n<p><em><strong>4.2. Ιατρός εργασίας</strong></em></p>\r\n\r\n<p>4.2.1. Στοιχεία υπευθύνου</p>\r\n\r\n<p>{IE_STOIXEIA}</p>\r\n\r\n<p><em><strong>4.3. Διοικητικό προσωπικό - Συντηρητές εξοπλισμού</strong></em></p>\r\n\r\n<p>4.2.1. Στοιχεία υπευθύνων</p>\r\n\r\n<p>{TEYXOS_YPEYTHINOI}</p>\r\n\r\n<p><em><strong>4.4. Εργαζόμενοι επιχείρησης</strong></em></p>\r\n\r\n<p>4.2.1. Στοιχεία εργαζομένων</p>\r\n\r\n<p>{TEYXOS_ERGAZOMENOI}</p>\r\n\r\n<p>Σημείωση: Παροχή μέσων ατομικής προστασίας σε υπαλλήλους των Ο.Τ.Α. και μέτρα προληπτικής ιατρικής - Φ.Ε.Κ.-ΤΕΥΧΟΣ Β-ΑΡ.ΦΥΛΛΟΥ 1503/11-10-2006</p>\r\n'),
(5, 5, '<p><strong>5. Πηγές κινδύνου</strong></p>\r\n\r\n<p><em><strong>5.1. Κατηγορίες κινδύνων</strong></em></p>\r\n\r\n<p>{TEYXOS_PIGES}</p>\r\n\r\n<p><em><strong>5.2. Εκτίμηση επικινδυνότητας</strong></em></p>\r\n\r\n<p>{TEYXOS_EPIKINDYNOTITA}</p>\r\n'),
(6, 6, '<p><strong>6. Μέτρα πρόληψης</strong></p>\r\n\r\n<p><em><strong>6.1. Προτάσεις βελτίωσης</strong></em></p>\r\n\r\n<p>{TEYXOS_METRAPROLIPSIS}</p>\r\n'),
(7, 7, '<p><strong>7. Συμπεράσματα</strong></p>\r\n\r\n<p><em><strong>7.1. Εκτίμηση της κατάστασης</strong></em></p>\r\n\r\n<p>{TEYXOS_SYMPERASMATA}</p>\r\n'),
(8, 8, '<p><strong>8 Παραρτήματα</strong></p>\r\n\r\n<p><strong>8.1 Ερωτηματολόγια</strong></p>\r\n\r\n<p>{TEYXOS_ERWTIMATOLOGIA}</p>\r\n\r\n<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>\r\n\r\n<p><strong>8.2 Σχέδιο έκτακτης ανάγκης</strong></p>\r\n\r\n<p>Ο κάθε εργαζόμενος θα πρέπει να είναι ενήμερος για το ρόλο που έχει σε περίπτωση που ξεσπάσει πυρκαγιά ή γενικότερα σε κάθε περίπτωση που ζητείται να εγκαταληφθεί ο χώρος εργασίας ενδεχομένως εξαιτίας άλλων κινδύνων. Οι περισσότεροι εργαζόμενοι της επιχείρησης δεν χρειάζεται να κάνουν τίποτε παραπάνω από το να εγκαταλείψουν το χώρο εργασίας τους διευκολύνοντας έτσι την κατάσβεση της πυρκαγιάς από αυτούς που θα είναι επιφορτισμένοι με το έργο κατάσβεσης (Πυροσβεστική υπηρεσία, ομάδα πυρόσβεσης των εργαζομένων).</p>\r\n\r\n<p>Όπου οι εργαζόμενοι βρίσκονται σε χώρο εργασίας που βρίσκεται σε άλλο επίπεδο ή όροφο από τον αύλειο χώρο της εγκατάστασης κατά την εκκένωση θα πρέπει να χρησιμοποιούνται οι σκάλες - με απαγορευτική τη χρήση ανελκυστήρα - και να συγκεντρώνονται στον αύλειο χώρο της επιχείρησης σε προκαθορισμένο σημείο. Άλλοι εργαζόμενοι είναι επιφορτισμένοι με ειδικά καθήκοντα στην περίπτωση έκτακτης ανάγκης και αυτά παρουσιάζονται παρακάτω:</p>\r\n\r\n<p>{TEYXOS_SXEDIO}</p>\r\n\r\n<p>Η κατάσβεση μιας πυρκαγιάς μπορεί να επιτευχθεί από οποιοδήποτε ενήλικο άτομο εφόσον ευρίσκεται στην αρχική της φάση. Η κατάσβεση μιας πυρκαγιάς είναι πολλές φορές πλήρως επιτυχημένη με την επέμβαση στην αρχή της εκδήλωσής της. Η φωτιά είναι ένα φαινόμενο το οποίο εξαπλώνεται με φοβερή ταχύτητα και γι αυτό θα απαιτηθεί δυσανάλογα μεγαλύτερη προσπάθεια εάν επεκταθεί η φωτιά.</p>\r\n\r\n<p>Σημείωση: Οι εργαζόμενοι που είναι επιφορτισμένοι με ειδικά καθήκοντα προσπάθειας κατάσβεσης της πυρκαγιάς θα πρέπει να εκτιμήσουν εάν είναι επικίνδυνη η προσπάθεια αυτή. Η προσπάθεια κατάσβεσης είναι επικίνδυνη όταν:</p>\r\n\r\n<ol>\r\n	<li>Δεν υπάρχει ο αναγκαίος πυροσβεστικός εξοπλισμός. πχ Εάν στο χώρο πρέπει να υπάρχει φορητός πυροσβεστήρας και δεν βρίσκεται εκεί δεν θα πρέπει να γίνει προσπάθεια κατάσβεσης με άλλα μέσα.</li>\r\n	<li>Η φωτιά έχει επεκταθεί πέρα από το χώρο που ξεκίνησε</li>\r\n	<li>Δεν υπάρχει δυνατότητα διαφυγής</li>\r\n	<li>Η φωτιά εμποδίζει τη μοναδική έξοδο διαφυγής</li>\r\n</ol>\r\n\r\n<p>Σε αυτές τις περιπτώσεις πρέπει να δοθεί σήμα συναγερμού (αναγκελίας πυρκαγιάς), να ειδοποιηθεί η Π.Υ. (τηλ 199) και να εκκενωθεί ο χώρος εργασίας.</p>\r\n\r\n<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>\r\n\r\n<p><strong>8.3. Σήμανση χώρων</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(9, 9, '<p><strong>9. Πρόγραμμα εργασίας Τ.Α.</strong></p>\r\n\r\n<p>{TA_PROGRAM}</p>\r\n'),
(10, 10, '<p><strong>10. Πρόγραμμα εργασίας Ι.Ε.</strong></p>\r\n\r\n<p>{IE_PROGRAM}</p>\r\n');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
