<?php

require_once "Conexao.class.php";

class Usuarios extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_usuarios;
    private $nome;
    private $login;
    private $senha;
    private $imagem_perfil;
    private $status;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_usuarios === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO usuarios (
                        nome, 
                        login, 
                        imagem_perfil, 
                        status
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?
                    );
                ');
                $salva_dados->execute(array(
                    "$this->nome",
                    "$this->login",
                    "$this->imagem_perfil",
                    "$this->status"
                ));
                $this->id_usuarios = $pdo->lastInsertId();
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE usuarios SET 
                        nome = ?,
                        imagem_perfil = ?,
                        status = ?
                    WHERE 
                        id_usuarios = ?;
                ');
                $salva_dados->execute(array(
                    "$this->nome",
                    "$this->imagem_perfil",
                    "$this->status",
                    "$this->id_usuarios"
                ));
                $this->setRetorno_dados($this->id_usuarios);
            }
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados_perfil() {
        try {

            $pdo = parent::getDB();

            $salva_dados = $pdo->prepare('
                UPDATE usuarios SET 
                    nome = ?,
                    imagem_perfil = ?
                WHERE 
                    id_usuarios = ?;
            ');
            $salva_dados->execute(array(
                "$this->nome",
                "$this->imagem_perfil",
                "$this->id_usuarios"
            ));
            $this->setRetorno_dados($this->id_usuarios);
            return true;
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
                UPDATE usuarios SET 
                    senha = ?
                WHERE 
                    id_usuarios = ?;
            ');
            $atualiza_senha->execute(array(
                "$this->senha",
                "$this->id_usuarios"
            ));
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
                    id_usuarios,
                    IF(imagem_perfil != '', imagem_perfil, 'sem-imagem-avatar.png') as imagem_perfil,
                    login,                    
                    nome,
                    CASE status
                        WHEN 1 THEN 'success'
                        WHEN 0 THEN 'danger'
                    END AS status_class,
                    CASE status
                        WHEN 1 THEN 'Ativo'
                        WHEN 0 THEN 'Inativo'
                    END AS status
                FROM
                    usuarios
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
                    login, 
                    imagem_perfil, 
                    status
                FROM
                    usuarios
                WHERE
                    id_usuarios = ?
            ");
            $edita_dados->execute(array(
                "$this->id_usuarios"
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

    /* =============== REMOVE CARACTERES ESPECIAIS =============== */

    public function remover_caracter($string) {
        return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
    }

    /* =============== GETTERS E SETTERS =============== */

    function getId_usuarios() {
        return $this->id_usuarios;
    }

    function getNome() {
        return $this->nome;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getImagem_perfil() {
        return $this->imagem_perfil;
    }

    function getStatus() {
        return $this->status;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_usuarios($id_usuarios) {
        $this->id_usuarios = $id_usuarios;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setImagem_perfil($imagem_perfil) {
        $this->imagem_perfil = $imagem_perfil;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
