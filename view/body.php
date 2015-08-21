<?php 
include 'header.php';

	switch($_GET['page']) {
		case 'add-supp-user':
			include 'page/add-supp-user.php';
			break;
		case 'room-display':
			include 'page/room-display.php';
			break;
		default:
			include 'page/add-supp-user.php';
			break;
	}

include 'footer.php';
?>