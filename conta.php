<?php 
require_once('./private/connection.php');
require_once('./private/contaClass.php');
$error = "";
$pessoas = $conn->query("SELECT * FROM pessoa")->fetchAll(PDO::FETCH_ASSOC);

if(!empty($_POST['pessoa']) && !empty($_POST['saldo']) && !empty($_POST['numero'])){
    $conta = new Conta ($_POST['pessoa'], $_POST['saldo'], $_POST['numero']);
    $exists = $conn->query("SELECT * FROM conta where numero = $conta->numero")->fetchAll(PDO::FETCH_ASSOC);
        if (sizeof($exists) > 0) {
            $error = "Conta já cadastrada";
        } else {
            $conn->query("INSERT INTO conta (id_conta, saldo, numero, id_pessoa) values(DEFAULT, $conta->saldo, $conta->numero, $conta->pessoa)") or die($error = "eror");
        }
}

$contas = $conn->query("SELECT p.nome, p.cpf, c.saldo,  c.numero FROM conta AS c 
JOIN pessoa AS p ON c.id_pessoa = p.id_pessoa")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <?php include('./includes/cdnsCss.php') ?>
    <title>Bank - Conta</title>
</head>

<body>
    <main class="container-fluid p-3">
        <div class="new-account w-50 shadow p-3 align-self-center d-flex flex-column mt-5">
                <a href="index.php" type="button" class="btn btn-secondary align-self-baseline">Voltar</a>
                <h2 class="text-center flex-center"> Cadastrar Conta </h2>
            <hr>
            <form action="" method="POST" class="w-70 d-flex flex-column align-self-center">
                <div class="form-group">
                    <label for="pessoa">Pessoa: </label>
                    <select id="pessoa" name="pessoa" class="form-select" required>
                        <option value="" disabled selected>---SELECIONE A PESSOA---</option>
                        <?php foreach($pessoas as $pessoa):?>
                            <option value="<?=$pessoa['id_pessoa']?>"><?= $pessoa['nome'] . ' - ' .$pessoa['cpf']?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="saldo" class="form-label">Saldo: </label>
                    <input type="number" id="saldo" name="saldo" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="numero" class="form-label">Número da Conta: </label>
                    <input type="number" id="numero" name="numero" class="form-control" required>
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
            <h2 class="text-center">Contas Cadastradas</h2>
            <hr>
            <table class="table table-striped w-80 align-self-center">
                <thead>
                    <tr>
                        <th>Pessoa</th>
                        <th>CPF</th>
                        <th>Saldo</th>
                        <th>Número da Conta</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($contas as $c) : ?>
                        <tr>
                            <td><?= $c['nome'] ?></td>
                            <td><?= $c['cpf'] ?></td>
                            <td><?= $c['saldo'] ?></td>
                            <td><?= $c['numero'] ?></td>
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