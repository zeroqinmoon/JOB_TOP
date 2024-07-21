<?php

include("conexao.php");
$contato = selectIdContato($_POST["id"]);
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/style1.css">
<meta charset="UTF-8">
<div class="posicionarCabecalho">
    <h1>Alterar uma Solicitacao</h1>
</div>
<div class="container">
    <form name="dadosContato" action="conexao.php" method="post">
        <table>
            <tbody>
                <tr>
                    <td>Nome: </td>
                    <td><input type="text" name="nome" value="<?=$contato["nome"]?>" size="25"></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><input type="text" name="email" value="<?=$contato["email"]?>" size="50"></td>
                </tr>
                <tr>
                    <td>Objetivo: </td>
                    <td><input type="text" name="objetivo" value="<?=$contato["objetivo"]?>" size="50"></td>
                </tr>
                <tr>
                    <td><input type="hidden" name="acao" value="atualizar">
                        <input type="hidden" name="id" value="<?=$contato["id"]?>">
                    </td>
                    <td><input type="submit" name="Enviar" value="Enviar"></td>
                </tr>
            </tbody>
        </table> 
    </form>
</div>