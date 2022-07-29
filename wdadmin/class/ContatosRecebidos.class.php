<?php

require_once "Conexao.class.php";

class ContatosRecebidos extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_contatos_recebidos;
    private $nome;
    private $email;
    private $telefone;
    private $assunto;
    private $mensagem;
    private $data_recebimento;
    private $status;
    private $retorno_dados;

    /* =============== FUNÇÃO INSERE DADOS =============== */

    public function insere_dados() {
        try {

            $pdo = parent::getDB();

            $insere_dados = $pdo->prepare('
                    INSERT INTO contatos_recebidos (
                        nome,
                        email,
                        telefone,
                        assunto,
                        mensagem,
                        data_recebimento,
                        status
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    );
                ');
            $insere_dados->execute(array(
                "$this->nome",
                "$this->email",
                "$this->telefone",
                "$this->assunto",
                "$this->mensagem",
                "$this->data_recebimento",
                "$this->status"
            ));
            $this->setRetorno_dados($pdo->lastInsertId());
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== FUNÇÃO ATUALIZA STATUS =============== */

    public function atualiza_status() {
        try {

            $pdo = parent::getDB();

            $atualiza_status = $pdo->prepare('
                UPDATE contatos_recebidos SET 
                    status = ?
                WHERE 
                    id_contatos_recebidos = ?;
            ');

            $atualiza_status->execute(array(
                "$this->status",
                "$this->id_contatos_recebidos"
            ));
            $this->setRetorno_dados($this->id_contatos_recebidos);
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== FUNÇÃO CONSULTA DADOS =============== */

    public function consulta_dados() {

        try {
            $pdo = parent::getDB();

            $consulta_dados = $pdo->prepare("
                SELECT
                    id_contatos_recebidos,
                    nome,
                    email,
                    telefone,
                    assunto,
                    mensagem,
                    DATE_FORMAT(data_recebimento, '%d/%m/%Y às %H:%i') AS data_recebimento_formatado,
                    CASE status
                        WHEN 1 THEN 'info'
                        WHEN 2 THEN 'success'
                    END AS status_class,
                    CASE status
                        WHEN 1 THEN 'Novo'
                        WHEN 2 THEN 'Lido'
                    END AS status
                FROM
                    contatos_recebidos
            ");
            $consulta_dados->execute();
            if ($consulta_dados->rowCount() > 0):
                $this->setRetorno_dados(json_encode($consulta_dados->fetchAll()));
                return true;
            else:
                return false;
            endif;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== GETTERS E SETTERS =============== */

    function getId_contatos_recebidos() {
        return $this->id_contatos_recebidos;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getAssunto() {
        return $this->assunto;
    }

    function getMensagem() {
        return $this->mensagem;
    }

    function getData_recebimento() {
        return $this->data_recebimento;
    }

    function getStatus() {
        return $this->status;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_contatos_recebidos($id_contatos_recebidos) {
        $this->id_contatos_recebidos = $id_contatos_recebidos;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setAssunto($assunto) {
        $this->assunto = $assunto;
    }

    function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    function setData_recebimento($data_recebimento) {
        $this->data_recebimento = $data_recebimento;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
