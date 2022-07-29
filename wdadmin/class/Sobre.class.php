<?php

require_once "Conexao.class.php";

class Sobre extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $resumo_texto;
    private $texto;
    private $imagem;
    private $link;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            $salva_dados = $pdo->prepare('
                UPDATE sobre SET 
                    resumo_texto = ?,
                    texto = ?,
                    imagem = ?,
                    link = ?
            ');
            $salva_dados->execute(array(
                "$this->resumo_texto",
                "$this->texto",
                "$this->imagem",
                "$this->link"
            ));
            $this->setRetorno_dados("1");
            return true;
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
                    resumo_texto,
                    texto,
                    imagem,
                    link
                FROM
                    sobre
            ");
            $edita_dados->execute();
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

    function getResumo_texto() {
        return $this->resumo_texto;
    }

    function getTexto() {
        return $this->texto;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getLink() {
        return $this->link;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setResumo_texto($resumo_texto) {
        $this->resumo_texto = $resumo_texto;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setLink($link) {
        $this->link = $link;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
