$( document ).ready(function() {
	//Récupération des éléments pour limiter les appels du DOM
	var body = $('body');
	var boutonAffichage = $('.displayPersonnages');;
	var conteneurPersonnages = $('.personnagesContainer');

	//Mise en place des observers
	gestionCookieLogin();
	connexionJoueur();
	deconnexionJoueur();
	afficherPersonnages(boutonAffichage, conteneurPersonnages);
	creerPersonnage(conteneurPersonnages);
	supprimerPersonnage(body);

});

// OBSERVER // Sert à afficher/masquer la liste des personnages
function afficherPersonnages(boutonAffichage, conteneurPersonnages) {
  	boutonAffichage.on("click", function(){
  		if(!conteneurPersonnages.children().is(":hidden") && conteneurPersonnages.children().length > 0) {
  			conteneurPersonnages.children().toggle('slide', { direction: 'left' }, 'slow');
		}
		else {
			$.ajax({
			  type: "POST",
			  url: '/projet/controller/controller.php',
			  data: 'id=afficherPersonnages',
			  dataType: "json",
			  success: function(data) {
			  		conteneurPersonnages.html(data);
			  		conteneurPersonnages.children().toggle('slide', { direction: 'left' }, 'slow');
			  }
			});
		}
  	});
}

// OBSERVER // Sert à supprimer un personnage
function supprimerPersonnage(body) {
	body.on("click", '.removePersonnage', function() {
		var parent = $(this).parent();
		$.ajax({
		    type: "POST",
		    url: '/projet/controller/controller.php',
		    data: 'id=supprimerPersonnage&personnageId='+$(this).data('idpersonnage'),
		    success: function(data) {
		  		parent.hide('slow');
		  		setTimeout(function(){parent.remove();}, 600);
		    }
		});
	});
}

// OBSERVER // Sert à créer un personnage
function creerPersonnage(conteneurPersonnages) {
	var boutonAjouter = $('.boutonAdd');
	var formulaire = $('#createPersonnage');

	boutonAjouter.on("click", function(){
		formulaire.toggle('slow');
	});

	formulaire.on("submit", function(e){
		e.preventDefault();
		var form = $(this);
		var formData = form.serialize();
		$.ajax({
		    type: "POST",
		    url: '/projet/controller/controller.php',
		    data: 'id=creerPersonnage&'+formData,
		    dataType: "json",
		    success: function(data) {
				form.find('input:text').val("");	
				conteneurPersonnages.append(data);
				conteneurPersonnages.children().last().toggle('slide', { direction: 'left' }, 'slow');
		    }
		});

	});
}

// OBSERVER // Sert à se connecter
function connexionJoueur(){
	var boutonFormulaire = $('#loginButton');
	var formulaireConnexion = $('#loginForm');

	boutonFormulaire.on("click", function(){
		formulaireConnexion.toggle('slow');
	});

	formulaireConnexion.on("submit", function(e){
		e.preventDefault();
		var form = $(this);
		var formData = form.serialize();
		var allElementToToggle = $('#disconnectButton, li.messageBienvenue, #loginButton, #loginForm');

		$.ajax({
		    type: "POST",
		    url: '/projet/controller/controller.php',
		    data: 'id=connexionJoueur&'+formData,
		    dataType: "json",
		    success: function(data) {
		    	if(data['logged'] == 'on') {
		    		$.cookie("logged","on");
		    		$.cookie("pseudo", data['pseudo']);

		    		allElementToToggle.toggle();
		    		$('li.messageBienvenue span').html($.cookie("pseudo")+' !');
		    	} else {
		    		alert('Mot de passe incorrect');
		    	}

		    }
		});
	});
}

// OBSERVER // Sert à se déconnecter
function deconnexionJoueur(){
	var bouton = $('#disconnectButton');
	var allElementToToggle = $('#disconnectButton, li.messageBienvenue, #loginButton');

	bouton.on("click", function(){
		allElementToToggle.toggle();
		$.cookie("logged",null);
		$.cookie("pseudo", null);
	});
}

// OBSERVER // Gestionnaire de connexion lors du chargement de la page
function gestionCookieLogin() {
	var displayElement = $('#disconnectButton, li.messageBienvenue');
	var hideElement = $('#loginButton');

	if($.cookie("logged") == "on") {
		hideElement.hide();
		displayElement.show();
		$('li.messageBienvenue span').html($.cookie("pseudo")+' !');
	}
}