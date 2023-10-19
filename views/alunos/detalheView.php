<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Example PHP+PDO+POO+MVC</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
        </style>
    </head>
    <body>
        <div class="col-lg-5 mr-auto">
            <form action="index.php?controller=alunos&action=atualizar" method="post">
                <h3>Detalhes do aluno</h3>
                <hr/>
                <input type="hidden" name="idaluno" value="<?php echo $dados["aluno"]->idaluno ?>"/>
                Nome: <input type="text" name="nome" value="<?php echo $dados["aluno"]->nome ?>" class="form-control"/>
                RA: <input type="text" name="ra" value="<?php echo $dados['aluno']->ra ?>" class="form-control"/>
                Email: <input type="text" name="email" value="<?php echo $dados['aluno']->email ?>" class="form-control"/>
                Celular: <input type="text" name="celular" value="<?php echo$dados['aluno']->celular ?>" class="form-control"/>
                <input type="submit" value="Enviar" class="btn btn-success"/>
            </form>
            <br>
            <a href="index.php" class="btn btn-info">Voltar</a>
        </div>
    </body>
</html>