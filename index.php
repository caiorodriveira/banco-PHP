<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <?php include('./includes/bootstrapcss.php')?>
    <title>Bank $</title>
</head>
<body>
      
    <main class="container-fluid p-3">
        <div class="welcome shadow p-3 w-50 align-self-center">
            <h1 class="text-center">Bem vindo ao banco digital</h1>
            <h3 class="text-center">Escolha uma das operações</h3>
            <hr>
            <div class="operations mt-3 mb-3 d-flex justify-content-around">
                <a type="button" href="./pessoa.php" class="btn btn-primary">Cadastrar Pessoa</a>
                <a type="button" href="./conta.php" class="btn btn-primary">Criar Conta</a>
                <a type="button" href="./transacao.php" class="btn btn-primary">Realizar transação</a>
            </div>
        </div>
    </main>

<?php include('./includes/bootstrapjs.php')?>
</body>
</html>