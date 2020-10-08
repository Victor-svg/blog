<nav class="navbar navbar-expand-lg navbar-expend-md navbar-expend-sm navbar-dark ">
  <a class="navbar-brand" href="index.php?"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="main nav-item nav-link active" href="index.php?">Accueil <span class="sr-only">(current)</span></a>
      <a class="main nav-item nav-link" href="index.php?action=connexion">Connexion</a>
      <?php if (isset($_SESSION['id'])) {
      ?>
        <a class="main nav-item nav-link" href="index.php?action=board">Tableau</a>
        <a class="main nav-item nav-link" href="index.php?action=deco">Deconnexion</a>
      <?php
      }?>
    </div>
  </div>
</nav>