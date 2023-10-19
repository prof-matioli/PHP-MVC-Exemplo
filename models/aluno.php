<?php
class Aluno {
    private $table = "aluno";
    private $Connection;
    private $idaluno;
    private $nome;
    private $ra;
    private $email;
    private $celular;
    public function __construct($Connection) {
		$this->Connection = $Connection;
    }
    public function getId() {
        return $this->idaluno;
    }
    public function setId($id) {
        $this->idaluno = $id;
    }
    public function getNome() {
        return $this->nome;
    }
    public function setNome($Nome) {
        $this->nome = $Nome;
    }
    public function getRa() {
        return $this->ra;
    }
    public function setRa($ra) {
        $this->ra = $ra;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getCelular() {
        return $this->celular;
    }
    public function setCelular($celular) {
        $this->celular = $celular;
    }
    public function save(){
        $command = $this->Connection->prepare("INSERT INTO " . $this->table . " (nome,ra,email,celular)
                                        VALUES (:nome,:ra,:email,:celular)");
        $result = $command->execute(array(
            "nome" => $this->nome,
            "ra" => $this->ra,
            "email" => $this->email,
            "celular" => $this->celular
        ));
        $this->Connection = null;
        return $result;
    }
    public function update(){
        $consultation = $this->Connection->prepare("
            UPDATE " . $this->table . "
            SET
                nome = :nome,
                ra = :ra,
                email = :email,
                celular = :celular
            WHERE idaluno = :id
        ");
        $resultado = $consultation->execute(array(
            "id" => $this->idaluno,
            "nome" => $this->nome,
            "ra" => $this->ra,
            "email" => $this->email,
            "celular" => $this->celular
        )
    );
        $this->Connection = null;
        return $resultado;
    }
    public function getAll(){
        $consultation = $this->Connection->prepare("SELECT idaluno,nome,ra,email,celular FROM " . $this->table);
        $consultation->execute();
        /* Fetch all of the remaining rows in the result set */
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //cierre de conexión
        return $resultados;
    }
    public function getById($id){
        $consultation = $this->Connection->prepare("SELECT idaluno,nome,ra,email,celular
                                                FROM " . $this->table . "  WHERE idaluno = :id");
        $consultation->execute(array(
            "id" => $id
        ));
        /*Fetch all of the remaining rows in the result set*/
        $resultado = $consultation->fetchObject();
        $this->Connection = null; //connection closure
        return $resultado;
    }
    public function getBy($column,$value){
        $consultation = $this->Connection->prepare("SELECT id,nome,ra,email,celular
                                                FROM " . $this->table . " WHERE :column = :value");
        $consultation->execute(array(
            "column" => $column,
            "value" => $value
        ));
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //connection closure
        return $resultados;
    }
    public function deleteById($id){
        try {
            $consultation = $this->Connection->prepare("DELETE FROM " . $this->table . " WHERE idaluno = :id");
            $consultation->execute(array(
                "id" => $id
            ));
            $Connection = null;
        } catch (Exception $e) {
            echo 'Failed DELETE (deleteById): ' . $e->getMessage();
            return -1;
        }
    }
    public function deleteBy($column,$value){
        try {
            $consultation = $this->Connection->prepare("DELETE FROM " . $this->table . " WHERE :column = :value");
            $consultation->execute(array(
                "column" => $value,
                "value" => $value,
            ));
            $Connection = null;
        } catch (Exception $e) {
            echo 'Failed DELETE (deleteBy): ' . $e->getMessage();
            return -1;
        }
    }
}
?>