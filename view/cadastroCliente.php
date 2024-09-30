<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../css/loginn.css">
    <title>BikeScriptzx - Cadastro</title>
<body>
    <section class="conteudo-login">
        <section class="conteudo-formulario">
            <p>Bem vindo a BikeScriptzx</p>
            <form id="form-log" method="POST" action="../processamento/processamento.php">
                <input id="input-log" type="text" placeholder="Nome" name="inputNome" required>
                <input id="input-log" type="text" placeholder="CPF" name="inputCPF" maxlength="11" required>
                <input id="input-log" type="email" placeholder="Email" name="inputEmail" required>
                <input id="input-log" type="password" placeholder="Senha" name="inputSenha" required>
                <input id="botao-log" type="submit" value="CADASTRAR-SE">
            </form>
            <br>
            <p>Já tem cadastro? <a href="login.php">Entrar</a></p>
        </section>
    </section>


</body>
</html>