<?php

require_once "Conexao.class.php";

class UsuarioCliente extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_usuario_cliente;
    private $nome;
    private $email;
    private $senha;
    private $receber_novidades_email;
    private $status;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function insere_dados() {
        try {

            $pdo = parent::getDB();

            $insere_dados = $pdo->prepare('
                INSERT INTO usuario_cliente (
                    nome,
                    email,
                    senha,
                    receber_novidades_email,
                    status
                ) VALUES (
                    ?,
                    ?,
                    ?,
                    ?
                );
            ');
            $insere_dados->execute(array(
                "$this->nome",
                "$this->email",
                "$this->senha",
                "$this->receber_novidades_email",
                "$this->status"
            ));
            $this->setRetorno_dados($pdo->lastInsertId());
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== FUNÇÃO ATUALIZA DADOS =============== */

    public function atualiza_dados() {
        try {

            $pdo = parent::getDB();

            $atualiza_dados = $pdo->prepare('
                UPDATE usuario_cliente SET 
                    nome = ?,
                    receber_novidades_email = ?,
                    status = ?
                WHERE 
                    id_usuario_cliente = ?;
            ');
            $atualiza_dados->execute(array(
                "$this->nome",
                "$this->receber_novidades_email",
                "$this->status",
                "$this->id_usuario_cliente"
            ));
            $this->setRetorno_dados($this->id_usuario_cliente);
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
                    id_usuario_cliente,                  
                    nome,
                    email,
                    CASE status
                        WHEN 1 THEN 'success'
                        WHEN 0 THEN 'danger'
                    END AS status_class,
                    CASE status
                        WHEN 1 THEN 'Ativo'
                        WHEN 0 THEN 'Inativo'
                    END AS status
                FROM
                    usuario_cliente
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

    /* =============== FUNÇÃO EDITA DADOS =============== */

    public function edita_dados() {

        try {
            $pdo = parent::getDB();

            $edita_dados = $pdo->prepare("
                SELECT
                    nome, 
                    email,
                    receber_novidades_email,
                    status
                FROM
                    usuario_cliente
                WHERE
                    id_usuario_cliente = ?
            ");
            $edita_dados->execute(array(
                "$this->id_usuario_cliente"
            ));
            if ($edita_dados->rowCount() > 0):
                $this->setRetorno_dados(json_encode($edita_dados->fetchAll()));
                return true;
            else:
                return false;
            endif;
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== FUNÇÃO VERIFICA CADASTRO EXISTENTE =============== */

    public function verifica_cadastro_existente() {

        try {
            $pdo = parent::getDB();

            $verifica_cadastro_existente = $pdo->prepare("
                SELECT
                    id_usuario_cliente
                FROM
                    usuario_cliente
                WHERE
                    email = ?
            ");
            $verifica_cadastro_existente->execute(array(
                "$this->email"
            ));
            if ($verifica_cadastro_existente->rowCount() > 0):
                return true;
            else:
                return false;
            endif;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== FUNÇÃO ATUALIZA SENHA =============== */

    public function atualiza_senha() {
        try {

            $pdo = parent::getDB();

            $atualiza_senha = $pdo->prepare('
                UPDATE usuario_cliente SET 
                    senha = ?
                WHERE 
                    id_usuario_cliente = ?;
            ');
            $atualiza_senha->execute(array(
                "$this->senha",
                "$this->id_usuario_cliente"
            ));
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }
    
    /* =============== FUNÇÃO CONSULTA DADOS =============== */

    public function consulta_emails_newsletter() {

        try {
            $pdo = parent::getDB();

            $consulta_emails_newsletter = $pdo->prepare("
                SELECT
                    nome,
                    email
                FROM
                    usuario_cliente
                WHERE
                    status = 1 AND receber_novidades_email = 1
            ");
            $consulta_emails_newsletter->execute();
            if ($consulta_emails_newsletter->rowCount() > 0):
                $this->setRetorno_dados($consulta_emails_newsletter->fetchAll());
                return true;
            else:
                return false;
            endif;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== FUNÇÃO LOGIN =============== */

    public function login() {
        session_start();

        $pdo = parent::getDB();

        $login = $pdo->prepare("
            SELECT   
                id_usuario_cliente,
                nome,
                email,
                senha
            FROM
                usuario_cliente
            WHERE
                status = 1 AND
                email = ? AND 
                senha = ?
        ");
        $login->bindValue(1, $this->email);
        $login->bindValue(2, $this->senha);
        $login->execute();
        if ($login->rowCount() == 1):
            $dados = $login->fetch(PDO::FETCH_OBJ);
            $_SESSION['usuario_cliente_id'] = $dados->id_usuario_cliente;
            $_SESSION['usuario_cliente_nome'] = $dados->nome;
            $_SESSION['usuario_cliente_email'] = $dados->email;
            $_SESSION['usuario_cliente_logado'] = true;
            return true;
        else:
            return false;
        endif;
    }

    /* =============== FUNÇÃO LOGOFF =============== */

    public static function logoff() {
        session_start();

        if ($_SESSION['usuario_cliente_logado']):
            unset($_SESSION['usuario_cliente_logado']);
            session_destroy();
            return true;
        else:
            return false;
        endif;
    }

    /* =============== GETTERS E SETTERS =============== */

    function getId_usuario_cliente() {
        return $this->id_usuario_cliente;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function getReceber_novidades_email() {
        return $this->receber_novidades_email;
    }

    function getStatus() {
        return $this->status;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_usuario_cliente($id_usuario_cliente) {
        $this->id_usuario_cliente = $id_usuario_cliente;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setReceber_novidades_email($receber_novidades_email) {
        $this->receber_novidades_email = $receber_novidades_email;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
