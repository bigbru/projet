<!-- BARRE DE MENU !-->
<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="/projet/">PROJETS</a></h1>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

  <section class="top-bar-section">
    <ul class="right">
      <li class="messageBienvenue">Bonjour <span></span></li>
      <li class="has-form ">
        <a class="button" id="disconnectButton" href="#">Déconnexion</a>
        <a class="button" id="loginButton" href="#">Connexion</a>
        <form action="#" id="loginForm">
          <div class="row">
            <div type="text" class="columns small-5 large-5"><input name="pseudo" class="pseudo inputText" placeholder="Pseudo" /></div>
            <div type="text" class="columns small-5 large-5"><input name="pass" class="pass inputText" placeholder="Pass" /></div>
            <div type="text" class="columns small-2 large-2"><input type="submit" name="submit" class="submit button" value="Go" /></div>
          </div>
        </form>
      </li>
      <li class="has-dropdown active">
        <a href="/projet/">MENU</a>
        <ul class="dropdown">
          <li><a href="?page=add-supp-user">Ajout/Suppression d'utilisateurs</a></li>
          <li><a href="?page=room-display">Room display</a></li>
        </ul>
      </li>
    </ul>
  </section>
</nav>
<!-- FIN BARRE DE MENU !-->