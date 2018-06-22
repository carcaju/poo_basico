<?php

class BD_model {
    protected $pdo;

    public function __construct() {
        $host = '127.0.0.1';
        $db   = 'perguntas';
        $user = 'root';
        $pass = '';
        $charset = 'utf8';
        
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->pdo = new PDO($dsn, $user, $pass, $opt);
    }

    public function lista_perguntas() {
        $data = $this->pdo->query('SELECT * FROM perguntas')->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function lista_respostas($idpergunta) {
        $data = $this->pdo->prepare('SELECT idresposta, resposta FROM respostas WHERE idpergunta = :idpergunta');
        $data->bindParam(':idpergunta',$idpergunta);
        $data->execute();

        $result = $data->fetchAll();
        return $result;
    }

    public function lista_perguntas_respostas() {
        $data = $this->pdo->query('
            SELECT p.idpergunta, r.idresposta, p.pergunta, r.resposta
            FROM perguntas as p INNER JOIN respostas as r
            ON p.idpergunta = r.idpergunta
        ')->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    
    public function lista_perguntas_testes() {
        $data = $this->pdo->query('
            SELECT p.idpergunta, r.idresposta, p.pergunta, r.resposta
            FROM perguntas as p INNER JOIN testes as t
            ON p.idpergunta = r.idpergunta
        ')->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function lista_testes_resposta($idpergunta,$idresposta) {
        $data = $this->pdo->prepare('SELECT idresposta, count(idteste) as qtd FROM perguntas.testes where idpergunta=:idpergunta and idresposta=:idresposta');
        $data->bindParam(':idpergunta',$idpergunta);
        $data->bindParam(':idresposta',$idresposta);
        $data->execute();

        $result = $data->fetchAll();
        return $result[0];        
    }

    public function lista_total_testes_resposta($idpergunta) {
        $data = $this->pdo->prepare('SELECT idresposta, count(idteste) as qtd FROM perguntas.testes where idpergunta=:idpergunta');
        $data->bindParam(':idpergunta',$idpergunta);
        $data->execute();

        $result = $data->fetchAll();
        return $result[0]['qtd'];        
    }

    public function salvar_testes($array) {

        foreach($array as $idpergunta=>$idresposta) {
            $idpergunta = str_replace("resposta","",$idpergunta);

            $data = $this->pdo->prepare('INSERT INTO testes (idpergunta, idresposta) VALUES (:idpergunta, :idresposta) ');
            $data->bindParam(':idpergunta',$idpergunta);
            $data->bindParam(':idresposta',$idresposta);
            $data->execute();
                            
        }


    }



}



?>