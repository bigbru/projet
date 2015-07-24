<?php 
include 'header.php';

	if($_GET['page'] == 'add-supp-user') {
		include 'page/add-supp-user.php';

	}
	else if ($_GET['page'] == 'room-display') {
		include 'page/room-display.php';
		
	}
	else {
		include 'page/add-supp-user.php';
	}

include 'footer.php';
?>