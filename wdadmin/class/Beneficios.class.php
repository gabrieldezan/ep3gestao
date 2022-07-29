<?php

require_once "Conexao.class.php";

class Beneficios extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_beneficios;
    private $titulo;
    private $status;
    private $id_planos;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_beneficios === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO beneficios (
                        titulo,
                        status,
                        id_planos
                    ) VALUES (
                        ?,
                        ?,
                        ?
                    );
                ');
                $salva_dados->execute(array(
                    "$this->titulo",
                    "$this->status",
                    "$this->id_planos"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE beneficios SET 
                        titulo = ?,
                        status = ?,
                        id_planos = ?
                    WHERE 
                        id_beneficios = ?;
                ');
                $salva_dados->execute(array(
                    "$this->titulo",
                    "$this->status",
                    "$this->id_planos",
                    "$this->id_beneficios"
                ));
                $this->setRetorno_dados($this->id_beneficios);
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
                    id_beneficios,
                    titulo,
                    CASE status
                        WHEN 1 THEN 'success'
                        WHEN 0 THEN 'danger'
                    END AS status_class,
                    CASE status
                        WHEN 1 THEN 'Ativo'
                        WHEN 0 THEN 'Inativo'
                    END AS status
                FROM
                    beneficios
                WHERE
                    id_planos = $this->id_planos
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
                    titulo,
                    status
                FROM
                    beneficios
                WHERE
                    id_beneficios = ?
            ");
            $edita_dados->execute(array(
                "$this->id_beneficios"
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

    function getId_beneficios() {
        return $this->id_beneficios;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getStatus() {
        return $this->status;
    }

    function getId_planos() {
        return $this->id_planos;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_beneficios($id_beneficios) {
        $this->id_beneficios = $id_beneficios;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setId_planos($id_planos) {
        $this->id_planos = $id_planos;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
