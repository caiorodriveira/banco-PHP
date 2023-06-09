<?php 
require_once('private/connection.php');
require_once('private/operacaoClass.php');
$pessoas = $conn->query("SELECT DISTINCT p.* FROM pessoa p JOIN conta c ON p.id_pessoa = c.id_pessoa")->fetchAll(PDO::FETCH_ASSOC);
$error = "";
$showPessoa = false;
$showConta = false;
$showOperacao = false;
$contas = "";
$dados = "";
$extrato = "";

if(empty($_POST["pessoa"]) && empty($_POST["conta"]) && empty($_POST["tipo"]) && empty($_POST["valor"])){
    $showPessoa = true;
}
else if(!empty($_POST["pessoa"])){
    $showPessoa = false;
    $showConta = true;
    $contas = $conn->query("SELECT * FROM conta where id_pessoa =" . $_POST["pessoa"])->fetchAll(PDO::FETCH_ASSOC);
} else if(!empty($_POST["conta"])){
    $showPessoa = false;
    $showConta = false;
    $showOperacao = true;
    $dados = $conn->query("SELECT p.nome, p.cpf, c.numero from conta c join pessoa p on c.id_pessoa = p.id_pessoa WHERE c.id_conta = " . $_POST["conta"])->fetch(PDO::FETCH_ASSOC);
} else if(!empty($_POST["tipo"]) && !empty($_POST["valor"])){
    $dadosOp = $conn->query("SELECT p.id_pessoa, c.id_conta from conta c join pessoa p on c.id_pessoa = p.id_pessoa WHERE c.id_conta = " . $_POST["contaOp"])->fetch(PDO::FETCH_ASSOC);
    $op = new Operacao($dadosOP["id_pessoa"], $dadosOp["id_conta"], $_POST["tipo"], $_POST["valor"]);
    echo print_r($op);
}

if($showOperacao){
    $extrato = $conn->query("SELECT * FROM extrato")->fetchAll(PDO::FETCH_ASSOC);
    
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
    <title>Bank - Transação</title>
</head>

<body>
    <main class="container-fluid p-3">
        <div class="new-account w-50 shadow p-3 align-self-center d-flex flex-column mt-5">
                <a href="index.php" type="button" class="btn btn-secondary align-self-baseline">Voltar</a>
                <h2 class="text-center flex-center"> Realizar Operação </h2>
            <hr>
            <form action="" method="POST" class="w-70 d-flex flex-column align-self-center">
                <?php if($showPessoa):?>
                <h4 class="text-center">Selecione a pessoa que possua conta</h4>
                <div class="form-group">
                    <label for="pessoa">Pessoa: </label>
                    <select id="pessoa" name="pessoa" class="form-select" required>
                        <option value="" disabled selected>---SELECIONE A PESSOA---</option>
                        <?php foreach($pessoas as $pessoa):?>
                            <option value="<?=$pessoa['id_pessoa']?>"><?= $pessoa['nome'] . ' - ' .$pessoa['cpf']?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="action d-flex flex-column align-self-center mt-3">
                    <button type="submit" class="btn btn-warning">Selecionar conta</button>
                </div>
                <?php endif?>
                <?php if($showConta):?>
                <h4 class="text-center">Selecione a conta</h4>
                <div class="form-group">
                    <label for="conta">Conta: </label>
                    <select id="conta" name="conta" class="form-select" required>
                        <option value="" disabled selected>---SELECIONE O NUMERO DA CONTA---</option>
                        <?php foreach($contas as $conta):?>
                            <option value="<?=$conta['id_conta']?>">Cc: <?= $conta['numero']?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="action d-flex flex-column align-self-center mt-3">
                    <button type="submit" class="btn btn-warning">Selecionar operação</button>
                </div>
                <?php endif?>
                <?php if($showOperacao):?>
                <h4 class="text-center">Selecione a operação</h4>
                <div class="form-group">
                    <label for="pessoa">Pessoa: </label>
                    <input type="text" id="pessoa" name="pessoa" class="form-control" value="<?= $dados['nome']?>" disabled>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF: </label>
                    <input type="text" id="cpf" name="cpf" class="form-control" value="<?= $dados['cpf']?>" disabled>
                </div>
                <!-- AJUSTAR PARA APARECER COM SHOW CONTA E REMOVER SHOW OPERAÇÃO -->
                <div class="form-group">
                    <label for="conta">Numero da conta: </label>
                    <input type="number" id="contaOp" name="contaOp" class="form-control" value="<?= $dados['numero']?>" disabled>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo da Operação</label>
                    <select name="tipo" id="tipo" class="form-select" required>
                        <option value="" disabled selected>--- SELECIONE A OPERAÇÃO ---</option>
                        <option value="saque">Saque</option>
                        <option value="deposito">Depósito</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="valor">Valor: </label>
                    <input type="number" id="valor" name="valor" class="form-control" required>
                </div>
                <div class="action d-flex flex-column align-self-center mt-3">
                    <button type="submit" class="btn btn-warning">Realizar operação</button>
                </div>
                <?php endif?>
                
            </form>

            <?php //if(sizeof($contas) > 0):?>
                <!-- <div class="form-group">
                    <label for="conta">Conta: </label>
                    <select id="conta" name="conta" class="form-select" required>
                        <option value="" disabled selected>---SELECIONE O NUMERO DA CONTA---</option>
                        <?php foreach($contas as $conta):?>
                            <option value="<?=$conta['id_conta']?>"><?= $conta['numero']?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <?php //endif?>
                <div class="form-group">
                    <label for="tipo">Tipo da Operação</label>
                    <select name="tipo" id="tipo" class="form-select" required>
                        <option value="" disabled selected>--- SELECIONE A OPERAÇÃO ---</option>
                        <option value="saque">Saque</option>
                        <option value="deposito">Depósito</option>
                    </select>
                </div>
                <?php if ($error != "") : ?>
                    <div class="alert alert-danger mt-3">
                        <span><?= $error ?></span>
                    </div>
                <?php endif ?>
                <div class="action mt-3 d-flex flex-column align-self-center">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div> -->
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