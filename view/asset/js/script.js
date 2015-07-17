$( document ).ready(function() {
	var body = $('body');
	afficherPersonnages();
	removePersonnage(body);
	createPersonnage();
});

function afficherPersonnages() {
	var trigger = $('.displayPersonnages');
	if(trigger) {

	  	var container = $('.personnagesContainer');
	  	trigger.on("click", function(){
	  		if(!container.children().is(":hidden") && container.children().length > 0) {
	  			container.children().toggle('slide', { direction: 'left' }, 'slow');
			}
			else {
				$.ajax({
				  type: "POST",
				  url: '/projet/controller/controller.php',
				  data: 'id=displayPersonnages',
				  success: function(data) {
				  		container.html(data);
				  		container.children().toggle('slide', { direction: 'left' }, 'slow');
				  }
				});
			}
	  	});
    }
}

function removePersonnage(body) {
	var removeElement = $('.removePersonnage');
	if(removeElement) {
		body.on("click", '.removePersonnage', function() {
			var parent = $(this).parent();
			$.ajax({
			    type: "POST",
			    url: '/projet/controller/controller.php',
			    data: 'id=removePersonnage&personnageId='+$(this).data('idpersonnage'),
			    success: function(data) {
			  		parent.hide('slow');
			  		setTimeout(function(){parent.remove();}, 600);
			    }
			});
		});

	}
}

function createPersonnage() {
	var boutonAdd = $('.boutonAdd');
	var formulaire = $('#createPersonnage');

	boutonAdd.on("click", function(){
		formulaire.toggle('slow');
	});

	formulaire.on("submit", function(e){
		e.preventDefault();
		var form = $(this);
		var formData = form.serialize();
		$.ajax({
		    type: "POST",
		    url: '/projet/controller/controller.php',
		    data: 'id=createPersonnage&'+formData,
		    success: function(data) {
				form.find('input:text').val("");
				$.ajax({
				  type: "POST",
				  url: '/projet/controller/controller.php',
				  data: 'id=displayPersonnages',
				  success: function(data) {
				  		$('.personnagesContainer').html(data);
				  		$('.personnagesContainer').children().toggle('slide', { direction: 'left' }, 'slow');
				  }
				});
		    }
		});

	});
}