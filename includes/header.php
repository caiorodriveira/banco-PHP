
<?php 
if(!empty($_GET["sair"])){
    session_destroy();
    header('Location: login.php');
}
?>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <form action="" method="GET">
        
        <input class="btn btn-danger" type="submit" value="Sair" name="sair">
    </form>
  </div>
</nav>