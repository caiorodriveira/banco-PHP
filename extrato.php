<?php
require_once('private/connection.php');
require_once('private/operacaoClass.php');
$pessoas = $conn->query("SELECT DISTINCT p.* FROM pessoa p JOIN conta c ON p.id_pessoa = c.id_pessoa")->fetchAll(PDO::FETCH_ASSOC);
$showPessoa = false;
$showConta = false;
$showExtrato = false;
$contas = "";
$dados = "";
$extrato = "";
$pessoa = "";
$conta = "";

if (empty($_POST["pessoa"]) && empty($_POST["conta"]) && empty($_POST["tipo"]) && empty($_POST["valor"])) {
    $showPessoa = true;
} else if (!empty($_POST["pessoa"])) {
    $showPessoa = false;
    $showConta = true;
    $contas = $conn->query("SELECT * FROM conta where id_pessoa =" . $_POST["pessoa"])->fetchAll(PDO::FETCH_ASSOC);
    $pessoa =  $conn->query("SELECT * FROM pessoa where id_pessoa =" . $_POST["pessoa"])->fetch(PDO::FETCH_ASSOC);
} else if (!empty($_POST["conta"])) {
    $showConta = false;
    $pessoa = $conn->query("SELECT p.nome, p.cpf, c.numero  FROM conta c join pessoa p on c.id_pessoa = p.id_pessoa where id_conta = " . $_POST["conta"])->fetch(PDO::FETCH_ASSOC);
    $extrato = $conn->query("SELECT * FROM extrato where id_conta = " . $_POST["conta"])->fetchAll(PDO::FETCH_ASSOC);
    $conta = $conn->query("SELECT * FROM conta where id_conta = " . $_POST["conta"])->fetch(PDO::FETCH_ASSOC);
    $showExtrato = true;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <?php include('./includes/cdnsCss.php') ?>
    <title>Bank - Extrato</title>
</head>

<body>
    <main class="container-fluid p-3">
        <div class="new-account w-50 shadow p-3 align-self-center d-flex flex-column mt-5">
            <a href="bank.php" type="button" class="btn btn-secondary align-self-baseline">Voltar</a>
            <h2 class="text-center flex-center"> Extrato </h2>
            <hr>
            <form action="" method="POST" class="w-70 d-flex flex-column align-self-center">
                <?php if ($showPessoa) : ?>
                    <h4 class="text-center">Selecione a pessoa que possua conta</h4>
                    <div class="form-group">
                        <label for="pessoa">Pessoa: </label>
                        <select id="pessoa" name="pessoa" class="form-select" required>
                            <option value="" disabled selected>---SELECIONE A PESSOA---</option>
                            <?php foreach ($pessoas as $pessoa) : ?>
                                <option value="<?= $pessoa['id_pessoa'] ?>"><?= $pessoa['nome'] . ' - ' . $pessoa['cpf'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="action d-flex flex-column align-self-center mt-3">
                        <button type="submit" class="btn btn-warning">Selecionar conta</button>
                    </div>
                <?php endif ?>
                <?php if ($showConta) : ?>
                    <h4 class="text-center">Selecione a conta</h4>
                    <div class="form-group">
                        <label for="pessoa">Pessoa: </label>
                        <input type="text" id="pessoa" name="pessoa" class="form-control" value="<?= $pessoa['nome'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF: </label>
                        <input type="text" id="cpf" name="cpf" class="form-control" value="<?= $pessoa['cpf'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="conta">Conta: </label>
                        <select id="conta" name="conta" class="form-select" required>
                            <option value="" disabled selected>---SELECIONE O NUMERO DA CONTA---</option>
                            <?php foreach ($contas as $conta) : ?>
                                <option value="<?= $conta['id_conta'] ?>">Cc: <?= $conta['numero'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="action d-flex flex-column align-self-center mt-3">
                        <button type="submit" class="btn btn-warning">Visualizar extrato</button>
                    </div>
                <?php endif ?>
                <?php if ($showExtrato) : ?>
                    <div class="form-group">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" name="nome" id="nome" class="form-control" value='<?=$pessoa["nome"]?>' disabled>
                    </div>
                    <div class="form-group">
                        <label for="cpf" class="form-label">CPF:</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" value='<?=$pessoa["cpf"]?>' disabled>
                    </div>
                    <div class="form-group">
                        <label for="conta" class="form-label">Numero da conta:</label>
                        <input type="text" name="conta" id="conta" class="form-control" value='<?=$pessoa["numero"]?>' disabled>
                    </div>
                    <h4 class="text-center"><strong>Saldo atual: </strong><?= $conta['saldo']?></h4>
                    <hr>
                    <table class="table table-striped w-80 align-self-center">
                        <thead>
                            <tr>
                                <th>Tipo de operação</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($extrato as $e) : ?>
                                <tr>
                                    <td><?= $e["tipo_operacao"] ?></td>
                                    <td><?= $e["valor"] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                <?php endif ?>

            </form>
        </div>

    </main>

    <?php include('./includes/cdnsJs.php') ?>
</body>

</html>