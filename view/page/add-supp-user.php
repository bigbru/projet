<!-- SECTION GESTION DE LA CREATION DES PERSONNAGES !-->
	<div class="buttonInteraction">
		<button class="displayPersonnages" name="displayPersonnages">Personnages</button> 
		<i class="fi-plus boutonAdd"></i>
	</div>
	<form action="#" id="createPersonnage">
		<div class="row">
			<div type="text" class="columns small-12 large-12"><input name="prenom" class="prenom inputText" placeholder="Prénom" /></div> 
			<div type="text" class="columns small-12 large-12"><input name="nom" class="nom inputText" placeholder="Nom" /></div>
			<div type="text" class="columns small-6 large-6"><input name="age" class="age inputText" placeholder="Âge" /></div>
			<div type="text" class="columns small-6 large-6"><input name="fonction" class="fonction inputText" placeholder="Fonction" /></div>
			<input type="submit" name="submit" class="submit" value="Créer un personnage" />
		</div>
	</form>
	<div class="personnagesContainer"></div>