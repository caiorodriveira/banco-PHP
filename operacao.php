<?php 
$error = "";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <?php include('./includes/cdnsCss.php') ?>
    <title>Bank - Transação</title>
</head>

<body>
    <main class="container-fluid p-3">
        <div class="new-account w-50 shadow p-3 align-self-center d-flex flex-column mt-5">
                <a href="index.php" type="button" class="btn btn-secondary align-self-baseline">Voltar</a>
                <h2 class="text-center flex-center"> Realizar Operação </h2>
            <hr>
            <form action="" method="POST" class="w-70 d-flex flex-column align-self-center">
                <div class="form-group">
                    <label for="pessoa">Pessoa: </label>
                    <select id="pessoa" name="pessoa" class="form-select" required>
                        <option value="">---SELECIONE A PESSOA---</option>
                    <?php foreach($pessoas as $pessoa):?>
                            <option value="<?=$pessoa['id_pessoa']?>"><?= $pessoa['nome'] . ' - ' .$pessoa['cpf']?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="conta">Conta: </label>
                    <select id="conta" name="conta" class="form-select" required>
                        <option value="">---SELECIONE A CONTA---</option>
                    </select>
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

        <div class="table-accounts w-50 p-3 shadow align-self-center d-flex flex-column mt-5">
            <h2 class="text-center">Extrato</h2>
            <h4 class="text-center"><strong>Saldo atual: </strong>[saldo]</h4>
            <hr>
            <table class="table table-striped w-80 align-self-center">
                <thead>
                    <tr>
                        <th>Tipo de operação</th>
                        <th>Valor</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>


    </main>

    <?php include('./includes/cdnsJs.php') ?>
</body>

</html>