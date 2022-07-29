<?php

require_once "Conexao.class.php";

class Cases extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_cases;
    private $servico;
    private $arquivo;
    private $imagem;
    private $id_clientes;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_cases === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO cases (
                        servico,
                        arquivo,
                        imagem,
                        id_clientes
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?
                    );
                ');
                $salva_dados->execute(array(
                    "$this->servico",
                    "$this->arquivo",
                    "$this->imagem",
                    "$this->id_clientes"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE cases SET 
                        servico = ?,
                        arquivo = ?,
                        imagem = ?,
                        id_clientes = ?
                    WHERE 
                        id_cases = ?;
                ');
                $salva_dados->execute(array(
                    "$this->servico",
                    "$this->arquivo",
                    "$this->imagem",
                    "$this->id_clientes",
                    "$this->id_cases"
                ));
                $this->setRetorno_dados($this->id_cases);
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

            if ($this->id_clientes != "T") {
                $vsWhereFiltro = "WHERE cs.id_clientes = $this->id_clientes";
            } else {
                $vsWhereFiltro = "";
            }

            $consulta_dados = $pdo->prepare("
                SELECT
                    cs.id_cases,
                    cl.descricao AS cliente,
                    cs.servico,
                    cs.imagem,
                    cs.arquivo
                FROM
                    cases cs
                    LEFT JOIN clientes cl ON cl.id_clientes = cs.id_clientes
                $vsWhereFiltro
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
                    servico,
                    arquivo,
                    imagem,
                    id_clientes
                FROM
                    cases
                WHERE
                    id_cases =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_cases"
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

    function getId_cases() {
        return $this->id_cases;
    }

    function getServico() {
        return $this->servico;
    }

    function getArquivo() {
        return $this->arquivo;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getId_clientes() {
        return $this->id_clientes;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_cases($id_cases) {
        $this->id_cases = $id_cases;
    }

    function setServico($servico) {
        $this->servico = $servico;
    }

    function setArquivo($arquivo) {
        $this->arquivo = $arquivo;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setId_clientes($id_clientes) {
        $this->id_clientes = $id_clientes;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
