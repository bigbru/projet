<?php

/////RECUPERATION DES PERSONNAGES/////
function getAllPersonnages($param) {
	global $bdd;

	if($param == 0) {
		$request = $bdd->query('SELECT * FROM personnage');
	} else {
		$request = $bdd->query('SELECT * FROM personnage WHERE id = (SELECT max(id) FROM personnage)');
	}
	
	$construction = '';
	$listePersonnages = array();

	while($personnage = $request->fetch()) {
		$construction = '<div class="personnageDisplay" data-personnage="'.$personnage['prenom'].'-'.$personnage['nom'].'" id="'.$personnage['prenom'].'-'.$personnage['nom'].'">';
		$construction .= '<p> <b>Nom</b> : '.$personnage['nom'].'</p>';
		$construction .= '<p> <b>Prenom</b> : '.$personnage['prenom'].'</p>';
		$construction .= '<p> <b>Age</b> : '.$personnage['age'].'</p>';
		$construction .= '<p> <b>Profession</b> : '.$personnage['fonction'].'</p>';
		$construction .= '<div class="removePersonnage" data-idPersonnage="'.$personnage['id'].'">X</div>';
		$construction .= '</div>';
		array_push($listePersonnages, $construction);
	}
	$request->closeCursor(); 
	return json_encode($listePersonnages);
}


/////SUPPRIMER UN PERSONNAGE/////
function removePersonnage($personnageID) {
	global $bdd;

	$request = $bdd->prepare("DELETE FROM personnage WHERE id=:personnageID");
	$request->execute(array(':personnageID' => $personnageID));
	return true;
}


/////CREER UN PERSONNAGES /////
function createPersonnage($nom, $prenom, $age, $fonction) {
	global $bdd;

	$request = $bdd->prepare("INSERT INTO personnage(nom, prenom, age, fonction) VALUES (:nom, :prenom, :age, :fonction)");
	$request->execute(array(':nom' => $_POST['nom'], ':prenom' => $_POST['prenom'], ':age' => $_POST['age'], ':fonction' => $_POST['fonction']));
	return true;
}


/////CONNEXION D'UN JOUEUR /////
function connexionJoueur($pseudo, $pass) {
	global $bdd;

	$request = $bdd->prepare('SELECT * FROM joueur WHERE pseudo = :pseudo');
	$request->execute(array(':pseudo' => $_POST['pseudo']));
	$joueurs = $request->fetchAll();
	$data = array();
	foreach($joueurs as $joueur) {
		if($joueur['password'] == $pass) {
			$data['logged'] = 'on';
			$data['pseudo'] = $joueur['pseudo'];
			$data['pass'] = $joueur['password'];
			$data['niveau'] = $joueur['niveau'];
		}
		else {
			$data['pass'] = 'off';
		}
	}

	return json_encode($data);
}