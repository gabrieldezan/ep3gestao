<?php

require_once "Conexao.class.php";
require_once "Arquivos.class.php";

class Exclusao extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_registro;
    private $tabela;
    private $pasta;
    private $arquivo_atual;
    private $arquivo_atual2;
    private $arquivo_atual3;
    private $arquivo_atual4;
    private $arquivo_atual5;

    /* =============== FUNÇÃO EXCLUI REGISTRO =============== */

    public function excluir_registro() {

        try {
            $pdo = parent::getDB();

            $excluir_registro = $pdo->prepare("
                DELETE FROM
                    $this->tabela
                WHERE
                    id_$this->tabela = $this->id_registro
            ");
            $excluir_registro->execute();

            if ($excluir_registro->execute()) {
                $Arquivos = new Arquivos();
                $Arquivos->setPasta($this->pasta);
                $Arquivos->setArquivo_atual($this->arquivo_atual);
                $Arquivos->excluir_arquivo();
                $Arquivos->setArquivo_atual($this->arquivo_atual2);
                $Arquivos->excluir_arquivo();
                $Arquivos->setArquivo_atual($this->arquivo_atual3);
                $Arquivos->excluir_arquivo();
                $Arquivos->setArquivo_atual($this->arquivo_atual4);
                $Arquivos->excluir_arquivo();
                $Arquivos->setArquivo_atual($this->arquivo_atual5);
                $Arquivos->excluir_arquivo();
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== GETTERS E SETTERS =============== */

    function getId_registro() {
        return $this->id_registro;
    }

    function getTabela() {
        return $this->tabela;
    }

    function getPasta() {
        return $this->pasta;
    }

    function getArquivo_atual() {
        return $this->arquivo_atual;
    }

    function getArquivo_atual2() {
        return $this->arquivo_atual2;
    }

    function getArquivo_atual3() {
        return $this->arquivo_atual3;
    }

    function getArquivo_atual4() {
        return $this->arquivo_atual4;
    }

    function getArquivo_atual5() {
        return $this->arquivo_atual5;
    }

    function setId_registro($id_registro) {
        $this->id_registro = $id_registro;
    }

    function setTabela($tabela) {
        $this->tabela = $tabela;
    }

    function setPasta($pasta) {
        $this->pasta = $pasta;
    }

    function setArquivo_atual($arquivo_atual) {
        $this->arquivo_atual = $arquivo_atual;
    }

    function setArquivo_atual2($arquivo_atual2) {
        $this->arquivo_atual2 = $arquivo_atual2;
    }

    function setArquivo_atual3($arquivo_atual3) {
        $this->arquivo_atual3 = $arquivo_atual3;
    }

    function setArquivo_atual4($arquivo_atual4) {
        $this->arquivo_atual4 = $arquivo_atual4;
    }

    function setArquivo_atual5($arquivo_atual5) {
        $this->arquivo_atual5 = $arquivo_atual5;
    }

}
