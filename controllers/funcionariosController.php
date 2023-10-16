<?php
class FuncionariosController
{
    private $conectar;
    private $Connection;
    public function __construct()
    {
        require_once __DIR__ . "/../core/conectar.php";
        require_once __DIR__ . "/../models/funcionario.php";
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
        $funcionario = new Funcionario($this->Connection);
        //Obtem uma lista com todos os funcionarios
        $funcionarios = $funcionario->getAll();
        //Carrega a View index e passa os valores para ela
        $this->view("index", array(
            "funcionario" => $funcionarios,
            "titulo" => "PHP MVC"
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
        $modelo = new Funcionario($this->Connection);
        //Recupera o funcionario do BD
        $funcionario = $modelo->getById($_GET["id"]);
        //Carrega a View de detalhe e passa os valores para ela
        $this->view("detalhe", array(
            "funcionario" => $funcionario,
            "titulo" => "Detalhe Funcionário"
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
            $funcionario = new Funcionario($this->Connection);
            $funcionario->setNome($_POST["nome"]);
            $funcionario->setSobrenome($_POST["sobrenome"]);
            $funcionario->setEmail($_POST["email"]);
            $funcionario->setCelular($_POST["celular"]);
            $save = $funcionario->save();
        }
        header('Location: index.php');
    }
    /**
     * Atualiza empregado a partir dos parametros
     * POST e recarrega o index.php
     */
    public function atualizar()
    {
        if (isset($_POST["id"])) {
            //Cria um usuario
            $funcionario = new Funcionario($this->Connection);
            $funcionario->setId($_POST["id"]);
            $funcionario->setNome($_POST["nome"]);
            $funcionario->setSobrenome($_POST["sobrenome"]);
            $funcionario->setEmail($_POST["email"]);
            $funcionario->setCelular($_POST["celular"]);
            $save = $funcionario->update();
        }
        header('Location: index.php');
    }


    public function excluir()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            //Cria um usuario
            $funcionario = new Funcionario($this->Connection);
            $funcionario->deleteById($id);
        }
        header('Location: index.php');
    }

    /**
     * Chama a View indicada por $view e passa para ela 
     * os dados indicados em $data
     */
    public function view($view, $data)
    {
        $dados = $data;
        require_once __DIR__ . "/../views/" . $view . "View.php";
    }
}
?>