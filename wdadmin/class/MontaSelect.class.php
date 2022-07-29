<?php

require_once "Conexao.class.php";

class MontaSelect extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id;
    private $campo;
    private $tabela;
    private $filtro;
    private $ordem;
    private $retorno;

    /* =============== FUNÇÃO =============== */

    public function consulta_dados() {
        try {
            $pdo = parent::getDB();

            $consulta_dados = $pdo->prepare("
                SELECT       
                    $this->id,
                    $this->campo
                FROM
                    $this->tabela
                    $this->filtro
                ORDER BY
                    $this->ordem
            ");
            $consulta_dados->execute();
            if ($consulta_dados->rowCount() > 0):
                while ($row = $consulta_dados->fetch()) {
                    $dados[] = array(
                        "id" => $row[$this->id],
                        "texto" => $row[$this->campo]
                    );
                }
                $this->setRetorno(json_encode($dados));
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

    function getId() {
        return $this->id;
    }

    function getCampo() {
        return $this->campo;
    }

    function getTabela() {
        return $this->tabela;
    }

    function getFiltro() {
        return $this->filtro;
    }

    function getOrdem() {
        return $this->ordem;
    }

    function getRetorno() {
        return $this->retorno;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCampo($campo) {
        $this->campo = $campo;
    }

    function setTabela($tabela) {
        $this->tabela = $tabela;
    }

    function setFiltro($filtro) {
        $this->filtro = $filtro;
    }

    function setOrdem($ordem) {
        $this->ordem = $ordem;
    }

    function setRetorno($retorno) {
        $this->retorno = $retorno;
    }

}
