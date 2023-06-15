<?php 
require_once('private/connection.php');
require_once('private/operacaoClass.php');
$pessoas = $conn->query("SELECT DISTINCT p.* FROM pessoa p JOIN conta c ON p.id_pessoa = c.id_pessoa")->fetchAll(PDO::FETCH_ASSOC);
$error = "";
$showPessoa = false;
$showConta = false;
$contas = "";
$dados = "";
$extrato = "";
$pessoa = "";

if(empty($_POST["pessoa"]) && empty($_POST["conta"]) && empty($_POST["tipo"]) && empty($_POST["valor"])){
    $showPessoa = true;
}
else if(!empty($_POST["pessoa"])){
    $showPessoa = false;
    $showConta = true;
    $contas = $conn->query("SELECT * FROM conta where id_pessoa =" . $_POST["pessoa"])->fetchAll(PDO::FETCH_ASSOC);
    $pessoa =  $conn->query("SELECT * FROM pessoa where id_pessoa =" . $_POST["pessoa"])->fetch(PDO::FETCH_ASSOC);
} else if(!empty($_POST["conta"]) && !empty($_POST["tipo"]) && !empty($_POST["valor"])){
    $showConta = false;

    $tipo = $_POST["tipo"];
    $valor = $_POST["valor"];
    $idConta = $_POST["conta"];
    $operacao = new Operacao($idConta, $tipo, $valor);
    $conn->query("INSERT INTO extrato (id_extrato, tipo_operacao, valor, id_conta) values (default, '$operacao->operacao', '$operacao->valor', '$operacao->conta')");
    switch ($tipo){
        case 'saque':
            $conn->query("UPDATE conta SET saldo = saldo - $valor where id_conta = '$idConta'");
            break;
        case 'deposito':
            $conn->query("UPDATE conta SET saldo = saldo + $valor where id_conta = '$idConta'");
            break;
    }
    $showPessoa = true;

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
                <a href="bank.php" type="button" class="btn btn-secondary align-self-baseline">Voltar</a>
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
                    <label for="pessoa">Pessoa: </label>
                    <input type="text" id="pessoa" name="pessoa" class="form-control" value="<?=$pessoa['nome']?>" disabled>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF: </label>
                    <input type="text" id="cpf" name="cpf" class="form-control" value="<?=$pessoa['cpf']?>" disabled>
                </div>
                <div class="form-group">
                    <label for="conta">Conta: </label>
                    <select id="conta" name="conta" class="form-select" required>
                        <option value="" disabled selected>---SELECIONE O NUMERO DA CONTA---</option>
                        <?php foreach($contas as $conta):?>
                            <option value="<?=$conta['id_conta']?>">Cc: <?= $conta['numero']?></option>
                        <?php endforeach?>
                    </select>
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
        </div>

    </main>

    <?php include('./includes/cdnsJs.php') ?>
</body>

</html>