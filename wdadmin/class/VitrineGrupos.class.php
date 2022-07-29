<?php

require_once "Conexao.class.php";

class VitrineGrupos extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_vitrine_grupo;
    private $descricao;
    private $url_amigavel;
    private $status;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_vitrine_grupo === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO vitrine_grupo (
                        descricao,
                        url_amigavel,
                        status
                    ) VALUES (
                        ?,
                        ?,
                        ?
                    );
                ');
                $salva_dados->execute(array(
                    "$this->descricao",
                    "$this->url_amigavel",
                    "$this->status"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE vitrine_grupo SET 
                        descricao       = ?,
                        url_amigavel    = ?,
                        status          = ?
                    WHERE 
                        id_vitrine_grupo = ?;
                ');
                $salva_dados->execute(array(
                    "$this->descricao",
                    "$this->url_amigavel",
                    "$this->status",
                    "$this->id_vitrine_grupo"
                ));
                $this->setRetorno_dados($this->id_vitrine_grupo);
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
                    id_vitrine_grupo,
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
                    vitrine_grupo
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
                    vitrine_grupo
                WHERE
                    id_vitrine_grupo =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_vitrine_grupo"
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

    function getId_vitrine_grupo() {
        return $this->id_vitrine_grupo;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getStatus() {
        return $this->status;
    }

    function getUrl_amigavel() {
        return $this->url_amigavel;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_vitrine_grupo($id_vitrine_grupo) {
        $this->id_vitrine_grupo = $id_vitrine_grupo;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setUrl_amigavel($url_amigavel) {
        $this->url_amigavel = $url_amigavel;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
