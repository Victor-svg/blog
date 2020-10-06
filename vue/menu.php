<div class="dropdown">
  <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Menu</button>
    <div class="dropdown-menu">
    <a class="dropdown-item" href="index.php?">Accueil</a>
      <a class="dropdown-item" href="index.php?action=connexion">Connexion</a>
      <?php if (isset($_SESSION['id'])) {
        ?>
          <a class="dropdown-item" href="index.php?action=board">Tableau de Bord</a>
          <a class="dropdown-item" href="index.php?action=deco">Deconnexion</a>
        <?php
      } ?>

    </div>
</div>