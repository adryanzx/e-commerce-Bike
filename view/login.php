<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../css/loginn.css">
    <title>BikeScriptzx - Login</title>

<body>
    <section class="conteudo-login">
        <section class="conteudo-formulario">
            <p>Bem vindo a BikeScriptzx</p>
            <form id="form-log" method="POST" action="../processamento/processamento.php">
                <input id="input-log" type="text" placeholder="Email" name="inputEmailLog" required>
                <input id="input-log" type="password" placeholder="Senha" name="inputSenhaLog" required>
                <input id="botao-log" type="submit" value="ENTRAR">
            </form>
            <br>
            <p>Novo na BikeScriptzx? <a href="cadastroCliente.php">Cadastrar</a></p>
        </section>
    </section>


</body>

</html>