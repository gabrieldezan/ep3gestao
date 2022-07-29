<?php

require_once "Conexao.class.php";

class GaleriaGrupos extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_galeria_grupo;
    private $descricao;
    private $status;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_galeria_grupo === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO galeria_grupo (
                        descricao,
                        status
                    ) VALUES (
                        ?,
                        ?
                    );
                ');
                $salva_dados->execute(array(
                    "$this->descricao",
                    "$this->status"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE galeria_grupo SET 
                        descricao   = ?,
                        status      = ?
                    WHERE 
                        id_galeria_grupo = ?;
                ');
                $salva_dados->execute(array(
                    "$this->descricao",
                    "$this->status",
                    "$this->id_galeria_grupo"
                ));
                $this->setRetorno_dados($this->id_galeria_grupo);
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
                    id_galeria_grupo,
                    descricao,
                    CASE status
                        WHEN 1 THEN 'success'
                        WHEN 0 THEN 'danger'
                    END AS status_class,
                    CASE status
                        WHEN 1 THEN 'Ativo'
                        WHEN 0 THEN 'Inativo'
                    END AS status
                FROM
                    galeria_grupo
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
                    descricao,
                    status
                FROM
                    galeria_grupo
                WHERE
                    id_galeria_grupo =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_galeria_grupo"
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

    /* =============== GETTERS E SETTERS =============== */

    function getId_galeria_grupo() {
        return $this->id_galeria_grupo;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getStatus() {
        return $this->status;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_galeria_grupo($id_galeria_grupo) {
        $this->id_galeria_grupo = $id_galeria_grupo;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
