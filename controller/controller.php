<?php
include 'load.php';

$id = $_POST['id'];

if($id == 'displayPersonnages') {
	
	$request = $bdd->query('SELECT * FROM personnage');
	$reponse = '';
	while($personnage = $request->fetch()) {
		$reponse = '<div class="personnageDisplay" data-personnage="'.$personnage['prenom'].' '.$personnage['nom'].'">';
		$reponse .= '<p> <b>Nom</b> : '.$personnage['nom'].'</p>';
		$reponse .= '<p> <b>Prenom</b> : '.$personnage['prenom'].'</p>';
		$reponse .= '<p> <b>Age</b> : '.$personnage['age'].'</p>';
		$reponse .= '<p> <b>Profession</b> : '.$personnage['fonction'].'</p>';
		$reponse .= '<div class="removePersonnage" data-idPersonnage="'.$personnage['id'].'">X</div>';
		$reponse .= '</div>';
		echo $reponse;
	}
	$request->closeCursor(); 
	exit;
}

if($id == 'removePersonnage') {
	$personnageId = $_POST['personnageId'];
	$request = $bdd->exec("DELETE FROM personnage WHERE id='$personnageId'");
	echo $request +' id = '.$personnageId;
	exit;
}

if($id == 'createPersonnage') {
	$request = $bdd->exec("INSERT INTO personnage(nom, prenom, age, fonction) VALUES ('".$_POST['nom']."', '".$_POST['prenom']."', '".$_POST['age']."', '".$_POST['fonction']."')");
	exit;
}

