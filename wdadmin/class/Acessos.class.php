<?php

require_once "Conexao.class.php";

class Acessos extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_acessos;
    private $funcao;
    private $status;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_acessos === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO acessos (
                        funcao,
                        status
                    ) VALUES (
                        ?,
                        ?
                    );
                ');
                $salva_dados->execute(array(
                    "$this->funcao",
                    "$this->status"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE acessos SET 
                        funcao = ?,
                        status = ?
                    WHERE 
                        id_acessos = ?;
                ');
                $salva_dados->execute(array(
                    "$this->funcao",
                    "$this->status",
                    "$this->id_acessos"
                ));
                $this->setRetorno_dados($this->id_acessos);
            }
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
                    id_acessos,
                    funcao,
                    status,
                    CASE status
                        WHEN 1 THEN 'success'
                        WHEN 0 THEN 'danger'
                    END AS status_class,
                    CASE status
                        WHEN 1 THEN 'Ativo'
                        WHEN 0 THEN 'Inativo'
                    END AS status_descricao
                FROM
                    acessos
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
                    funcao,
                    status
                FROM
                    acessos
                WHERE
                    id_acessos =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_acessos"
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
    
    
    /* =============== FUNÇÃO CONSULTA DADOS =============== */

    public function consulta_acessos_bloqueados() {

        try {
            $pdo = parent::getDB();

            $consulta_dados = $pdo->prepare("
                SELECT
                    funcao
                FROM
                    acessos
                WHERE
                    status = 0
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

    function getId_acessos() {
        return $this->id_acessos;
    }

    function getFuncao() {
        return $this->funcao;
    }

    function getStatus() {
        return $this->status;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_acessos($id_acessos) {
        $this->id_acessos = $id_acessos;
    }

    function setFuncao($funcao) {
        $this->funcao = $funcao;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
