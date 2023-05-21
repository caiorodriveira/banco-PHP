<?php
    
    require_once('./private/connection.php');
    require_once('./private/pessoaClass.php');

    if(!empty($_POST['nome']) && !empty( $_POST['cpf']) && !empty($_POST['email'])){
        $pessoa = new Pessoa($_POST['nome'],  $_POST['cpf'], $_POST['email']);
        //fazer validação(if) de cpf unico
        $conn->query("INSERT INTO pessoa (id_pessoa,nome,cpf,email) values(DEFAULT, '$pessoa->nome', '$pessoa->cpf', '$pessoa->email')");
    }


    $pessoas = $conn->query("SELECT * FROM pessoa")->fetchAll(PDO::FETCH_ASSOC);
    
    if(sizeof($pessoas) > 0){
        foreach($pessoas as $p){
            echo $p['nome'] . "<br>";
        }
    } else {
        echo 'vazio';
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <?php include('./includes/bootstrapcss.php') ?>
    <title>Bank $ - Pessoas</title>
</head>

<body>
    <main class="container-fluid p-3">
        <div class="new-people w-50 shadow p-3 align-self-center d-flex flex-column mt-5">
            <h2 class="text-center"> Cadastrar Pessoa </h2>
            <hr>
            <form action="" method="POST" class="w-70 d-flex flex-column align-self-center">
                <div class="form-group">
                    <label for="nome" class="form-label">Nome: </label>
                    <input type="text" id="nome" name="nome" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cpf" class="form-label">CPF: </label>
                    <input type="number" id="cpf" name="cpf" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email: </label>
                    <input type="text" id="email" name="email" class="form-control" required>
                </div>
                <div class="action mt-3 d-flex flex-column align-self-center">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>


    </main>

    <?php include('./includes/bootstrapjs.php') ?>
</body>

</html>