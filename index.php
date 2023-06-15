<?php 
$error = "";
require_once("private/connection.php");
if(!empty($_POST['login']) && !empty($_POST['senha'])){
    $user = $conn->query("SELECT * FROM usuario where login = '". $_POST["login"]. "' AND senha = '" . $_POST["senha"]. "'")->fetch(PDO::FETCH_ASSOC);
    if(!empty($user)){
        header('Location: bank.php');
    } else {
        $error = "Usuário ou senha inválidos";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('./includes/cdnsCss.php') ?>
    <title>Document</title>
</head>

<body>
    <style>
        main.container-fluid {
            min-height: 100vh;
            width: 100vw;
        }

        div.login_container {
            height: 365px;
            width: 730px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .form-group {
            width: 80%;
            align-self: center;
        }
    </style>
    <div class="d-flex login_container shadow">
        <div id="login" class="p-3 w-50">
            <div class="top_login">
                <h3 class="text-center">Login</h3>
                <hr class="m-0">
            </div>
            <div class="body_login">
                <form class="mt-5 d-flex flex-column" method="POST">
                    <div class="form-group">
                        <label for="login" class="form-label">Login:</label>
                        <input type="text" class="form-control" id="login" name="login" required/>
                    </div>
                    <div class="form-group">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" class="form-control" id="senha" name="senha" required/>
                    </div>
                    <?php if($error!=""):?>
                    <div class="w-100 d-flex justify-content-center">
                        <span v-if="error && error != 'N o existe sess o'" class="text-danger"> <?=$error?> </span>
                    </div>
                    <?php endif?>
                    <div class="action d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="p-3 py-5 img_login bg-dark w-50 h-100 d-flex flex-column justify-content-between">
            <div class="icon_login align-self-center">
                <span class="material-symbols-outlined" style="font-size: 200px; color: #d6d6d6"> account_balance </span>
            </div>
            <div class="title_login align-self-center">
                <h2 class="text-light text-center" style="color: #d6d6d6">Banco digital</h2>
            </div>
        </div>
    </div>
    <?php include('./includes/cdnsJs.php') ?>
</body>

</html>