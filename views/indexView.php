<!DOCTYPE HTML>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Exemplo PHP+PDO+POO+MVC</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <style>
        input {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .right {
            float: right;
        }
    </style>
</head>

<body>
    <div class="col-lg-12">
        <h2 class="text-center text-primary">Manutenção do Cadastro de Funcionários</h2>
    </div>
    <form action="index.php?controller=funcionarios&action=criar" method="post" class="col-lg-5">
        <h3>Adicionar Funcionário</h3>
        <hr />
        Nome: <input type="text" name="nome" class="form-control" />
        Sobrenome: <input type="text" name="sobrenome" class="form-control" />
        Email: <input type="text" name="email" class="form-control" />
        Celular: <input type="text" name="celular" class="form-control" />
        <input type="submit" value="Enviar" class="btn btn-success" />
    </form>
    <div class="col-lg-7">
        <h3>Funcionários Cadastrados</h3>
        <hr/>
    </div>
    <section class="col-lg-7 usuario" style="height:400px;overflow-y:scroll;">
        <?php foreach ($dados["funcionario"] as $funcionario) { ?>
            <?php echo $funcionario["id"]; ?> -
            <?php echo $funcionario["nome"]; ?> -
            <?php echo $funcionario["email"]; ?> -
            <?php echo $funcionario["celular"]; ?>
            <div class="right">
                <a href="index.php?controller=funcionarios&action=detalhe&id=<?php echo $funcionario['id']; ?>" class="btn btn-info">Detalhes</a>
            </div>
            <div class="right">
                <a href="index.php?controller=funcionarios&action=excluir&id=<?php echo $funcionario['id']; ?>" class="btn btn-danger">Excluir</a>
                &nbsp;
            </div>
            <hr />
        <?php } ?>
    </section>
</body>

</html>