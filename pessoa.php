<?php

require_once('./private/connection.php');
require_once('./private/pessoaClass.php');
$error = "";
if (!empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['email'])) {
    $pessoa = new Pessoa($_POST['nome'],  $_POST['email'], $_POST['cpf']);
    $exists =  $conn->query("SELECT * FROM pessoa where cpf = $pessoa->cpf")->fetchAll(PDO::FETCH_ASSOC);
    if (sizeof($exists) > 0) {
        $error = "CPF já cadastrado";
    } else {
        $conn->query("INSERT INTO pessoa (id_pessoa,nome,cpf,email) values(DEFAULT, '$pessoa->nome', '$pessoa->cpf', '$pessoa->email')");
    }
}
//fazer outras funções do crud

$pessoas = $conn->query("SELECT * FROM pessoa")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <?php include('./includes/cdnsCss.php') ?>
    <title>Bank $ - Pessoas</title>
</head>

<body>
    <main class="container-fluid p-3">
        <div class="new-people w-50 shadow p-3 align-self-center d-flex flex-column mt-5">
                <a href="index.php" type="button" class="btn btn-secondary align-self-baseline">Voltar</a>
                <h2 class="text-center flex-center"> Cadastrar Pessoa </h2>
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
                <?php if ($error != "") : ?>
                    <div class="alert alert-danger mt-3">
                        <span><?= $error ?></span>
                    </div>
                <?php endif ?>
                <div class="action mt-3 d-flex flex-column align-self-center">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>

        <div class="table-peoples w-50 p-3 shadow align-self-center d-flex flex-column mt-5">
            <h2 class="text-center">Pessoas Cadastradas</h2>
            <hr>
            <table class="table table-striped w-80 align-self-center">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pessoas as $p) : ?>
                        <tr>
                            <td><?= $p['nome'] ?></td>
                            <td><?= $p['cpf'] ?></td>
                            <td><?= $p['email'] ?></td>
                            <td><span class="material-symbols-outlined text-danger">delete</span></td>
                            <td><span class="material-symbols-outlined text-primary">edit</span></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>


    </main>

    <?php include('./includes/cdnsJs.php') ?>
</body>

</html>