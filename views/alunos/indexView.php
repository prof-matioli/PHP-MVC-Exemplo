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
        <h2 class="text-center text-primary">Manutenção do Cadastro de Alunos</h2>
    </div>
    <form action="index.php?controller=alunos&action=criar" method="post" class="col-lg-5">
        <h3>Adicionar Aluno</h3>
        <hr />
        Nome: <input type="text" name="nome" class="form-control" />
        RA: <input type="text" name="ra" class="form-control" />
        Email: <input type="text" name="email" class="form-control" />
        Celular: <input type="text" name="celular" class="form-control" />
        <input type="submit" value="Enviar" class="btn btn-success" />
    </form>
    <div class="col-lg-7">
        <h3>Alunos Cadastrados</h3>
        <hr/>
    </div>
    <section class="col-lg-7 usuario" style="height:400px;overflow-y:scroll;">
        <?php foreach ($dados["aluno"] as $aluno) { ?>
            <?php echo $aluno["idaluno"]; ?> -
            <?php echo $aluno["nome"]; ?> -
            <?php echo $aluno["ra"]; ?> -
            <?php echo $aluno["email"]; ?> -
            <?php echo $aluno["celular"]; ?>
            <div class="right">
                <a href="index.php?controller=alunos&action=detalhe&id=<?php echo $aluno['idaluno']; ?>" class="btn btn-info">Detalhes</a>
            </div>
            <div class="right">
                <a href="index.php?controller=alunos&action=excluir&id=<?php echo $aluno['idaluno']; ?>" class="btn btn-danger">Excluir</a>
                &nbsp;
            </div>
            <hr />
        <?php } ?>
    </section>
</body>

</html>