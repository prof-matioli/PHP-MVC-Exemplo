<?php
class AlunosController
{
    private $conectar;
    private $Connection;
    public function __construct()
    {
        require_once __DIR__ . "/../core/conectar.php";
        require_once __DIR__ . "/../models/aluno.php";
        $this->conectar = new Conectar();
        $this->Connection = $this->conectar->Connection();
    }
    /**
     * Executa uma das ações.
     *
     */
    public function run($action)
    {
        switch ($action) {
            case "index":
                $this->index();
                break;
            case "criar":
                $this->criar();
                break;
            case "detalhe":
                $this->detalhe();
                break;
            case "atualizar":
                $this->atualizar();
                break;
            case "excluir":
                $this->excluir();
                break;
            default:
                $this->index();
                break;
        }
    }
    /**
     * Carrega a home page de funcionarios com a lista 
     * de funcionarios obtida do model.
     *
     */
    public function index()
    {
        //Cria o objeto funcionario
        $aluno = new Aluno($this->Connection);
        //Obtem uma lista com todos os funcionarios
        $alunos = $aluno->getAll();

        //Carrega a View index e passa os valores para ela
        $this->view("index", array(
            "aluno" => $alunos,
            "titulo" => "CADASTRO DE ALUNOS"
        )
        );

    }
    /**
     * Carrega a home page de funcionarios com a lista
     * de funcionarios obtidas do model.
     *
     */
    public function detalhe()
    {
        //Carrega o model
        $modelo = new Aluno($this->Connection);
        //Recupera o funcionario do BD
        $aluno = $modelo->getById($_GET["id"]);
        //Carrega a View de detalhe e passa os valores para ela
        $this->view("detalhe", array(
            "aluno" => $aluno,
            "titulo" => "Detalhe Aluno"
        )
        );
    }
    /**
     * Cria um novo funcionario a partir dos parametros
     * POST e recarrega o index.php
     */
    public function criar()
    {
        if (isset($_POST["nome"])) {
            $aluno = new Aluno($this->Connection);
            $aluno->setNome($_POST["nome"]);
            $aluno->setRa($_POST["ra"]);
            $aluno->setEmail($_POST["email"]);
            $aluno->setCelular($_POST["celular"]);
            $save = $aluno->save();
        }
        header('Location: index.php?controller=alunos');
    }
    /**
     * Atualiza empregado a partir dos parametros
     * POST e recarrega o index.php
     */
    public function atualizar()
    {
        if (isset($_POST["idaluno"])) {
            //Cria um usuario
            $aluno = new Aluno($this->Connection);
            $aluno->setId($_POST["idaluno"]);
            $aluno->setNome($_POST["nome"]);
            $aluno->setRa($_POST["ra"]);
            $aluno->setEmail($_POST["email"]);
            $aluno->setCelular($_POST["celular"]);
            $save = $aluno->update();
        }
        header('Location: index.php?controller=alunos');
    }


    public function excluir()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            //Cria um usuario
            $aluno = new Aluno($this->Connection);
            $aluno->deleteById($id);
        }
        header('Location: index.php?controller=alunos');
    }

    /**
     * Chama a View indicada por $view e passa para ela 
     * os dados indicados em $data
     */
    public function view($view, $data)
    {
        $dados = $data;  
        require_once __DIR__ . "/../views/alunos/" . $view . "View.php";
    }
}
?>