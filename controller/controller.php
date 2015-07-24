<?php
include 'load.php';
include 'function.php';

$id = $_POST['id'];
$REPONSE;

switch($id) {
	case 'afficherPersonnages':
		header('Content-Type: application/json');
		$REPONSE = getAllPersonnages(0);
		break;
	case 'supprimerPersonnage':
		removePersonnage($_POST['personnageId']);
		$REPONSE = true;
		break;
	case 'creerPersonnage':
		header('Content-Type: application/json');
		createPersonnage($_POST['nom'],$_POST['prenom'],$_POST['age'],$_POST['fonction']);
		$REPONSE = getAllPersonnages(1);
		break;
	case 'connexionJoueur':
		header('Content-Type: application/json');
		$REPONSE = connexionJoueur($_POST['pseudo'], $_POST['pass']);
		break;
}

echo $REPONSE;
exit;

