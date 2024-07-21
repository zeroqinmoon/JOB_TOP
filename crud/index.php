<!DOCTYPE html>

<?php include("conexao.php");
$dados = selectAllcontato();
$dados2 = selectAllCurriculos();
?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>CRUD com PHP e MYSQL - INSERT</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
</head>
<div class="container">

    <body>
        <div class="posicionarCabecalho">
            <h1>Agenda de Solicitacoes</h1>
        </div>
        <table border="1" class="table">
            <thead class="thead-light">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Objetivo</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dados as $contato) { ?>
                    <tr>
                        <th><?= $contato["nome"] ?></th>
                        <th><?= $contato["email"] ?></th>
                        <th><?= $contato["objetivo"] ?></th>
                        <th>
                            <form name="alterar" action="alterar.php" method="post">
                                <input type="hidden" name="id" value="<?= $contato["id"] ?>">
                                <input type="submit" name="editar" value="Editar">
                            </form>
                        </th>
                        <th>
                            <form name="excluir" action="conexao.php" method="post">
                                <input type="hidden" name="id" value="<?= $contato["id"] ?>">
                                <input type="hidden" name="acao" value="excluir">
                                <input type="submit" name="excluit" value="Excluir">
                            </form>
                        </th>
                    </tr> "
                <?php } ?>
            </tbody>
        </table>
        <div class="text-center">
            <button type="button" class="btn btn-primary"><a href="inserir.php">Adicionar Solicitacao</a></button>
        </div>
        <div class="posicionarCabecalho">
            <br>
            <h1>Agenda de Curriculos</h1>
        </div>
        <table border="1" class="table">
            <thead class="thead-light">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Objetivo</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dados2 as $curriculos) { ?>
                    <tr>
                        <th><?= $curriculos["nome"] ?></th>
                        <th><?= $curriculos["email"] ?></th>
                        <th><?= $curriculos["objetivo"] ?></th>
                        <th>
                            <form name="excluir" action="conexao.php" method="post">
                                <input type="hidden" name="id" value="<?= $curriculos["id"] ?>">
                                <input type="hidden" name="acao" value="excluir">
                                <input type="submit" name="excluit" value="Excluir">
                            </form>
                        </th>
                    </tr> "
                <?php } ?>
            </tbody>
        </table>
    </body>
</div>

</html>