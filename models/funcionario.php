<?php
class Funcionario {
    private $table = "funcionarios";
    private $Connection;
    private $id;
    private $Nome;
    private $Sobrenome;
    private $email;
    private $celular;
    public function __construct($Connection) {
		$this->Connection = $Connection;
    }
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getNome() {
        return $this->Nome;
    }
    public function setNome($Nome) {
        $this->Nome = $Nome;
    }
    public function getSobrenome() {
        return $this->Sobrenome;
    }
    public function setSobrenome($Sobrenome) {
        $this->Sobrenome = $Sobrenome;
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
        $command = $this->Connection->prepare("INSERT INTO " . $this->table . " (nome,sobrenome,email,celular)
                                        VALUES (:Nome,:Sobrenome,:Email,:Celular)");
        $result = $command->execute(array(
            "Nome" => $this->Nome,
            "Sobrenome" => $this->Sobrenome,
            "Email" => $this->email,
            "Celular" => $this->celular
        ));
        $this->Connection = null;
        return $result;
    }
    public function update(){
        $consultation = $this->Connection->prepare("
            UPDATE " . $this->table . "
            SET
                nome = :Nome,
                sobrenome = :Sobrenome,
                email = :Email,
                celular = :Celular
            WHERE id = :id
        ");
        $resultado = $consultation->execute(array(
            "id" => $this->id,
            "Nome" => $this->Nome,
            "Sobrenome" => $this->Sobrenome,
            "Email" => $this->email,
            "Celular" => $this->celular
        )
    );
        $this->Connection = null;
        return $resultado;
    }
    public function getAll(){
        $consultation = $this->Connection->prepare("SELECT id,nome,sobrenome,email,celular FROM " . $this->table);
        $consultation->execute();
        /* Fetch all of the remaining rows in the result set */
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //cierre de conexión
        return $resultados;
    }
    public function getById($id){
        $consultation = $this->Connection->prepare("SELECT id,nome,sobrenome,email,celular
                                                FROM " . $this->table . "  WHERE id = :id");
        $consultation->execute(array(
            "id" => $id
        ));
        /*Fetch all of the remaining rows in the result set*/
        $resultado = $consultation->fetchObject();
        $this->Connection = null; //connection closure
        return $resultado;
    }
    public function getBy($column,$value){
        $consultation = $this->Connection->prepare("SELECT id,nome,sobrenome,email,celular
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
            $consultation = $this->Connection->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
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