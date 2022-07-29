<?php

require_once "Conexao.class.php";

class MissaoVisaoValores extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $icone_missao;
    private $imagem_missao;
    private $texto_missao;
    private $icone_visao;
    private $imagem_visao;
    private $texto_visao;
    private $icone_valores;
    private $imagem_valores;
    private $texto_valores;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            $salva_dados = $pdo->prepare('
                UPDATE missao_visao_valores SET 
                    icone_missao = ?,
                    imagem_missao = ?,
                    texto_missao = ?,
                    icone_visao = ?,
                    imagem_visao = ?,
                    texto_visao = ?,
                    icone_valores = ?,
                    imagem_valores = ?,
                    texto_valores = ?
            ');
            $salva_dados->execute(array(
                "$this->icone_missao",
                "$this->imagem_missao",
                "$this->texto_missao",
                "$this->icone_visao",
                "$this->imagem_visao",
                "$this->texto_visao",
                "$this->icone_valores",
                "$this->imagem_valores",
                "$this->texto_valores"
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
                    icone_missao,
                    imagem_missao,
                    texto_missao,
                    icone_visao,
                    imagem_visao,
                    texto_visao,
                    icone_valores,
                    imagem_valores,
                    texto_valores
                FROM
                    missao_visao_valores
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

    function getIcone_missao() {
        return $this->icone_missao;
    }

    function getImagem_missao() {
        return $this->imagem_missao;
    }

    function getTexto_missao() {
        return $this->texto_missao;
    }

    function getIcone_visao() {
        return $this->icone_visao;
    }

    function getImagem_visao() {
        return $this->imagem_visao;
    }

    function getTexto_visao() {
        return $this->texto_visao;
    }

    function getIcone_valores() {
        return $this->icone_valores;
    }

    function getImagem_valores() {
        return $this->imagem_valores;
    }

    function getTexto_valores() {
        return $this->texto_valores;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setIcone_missao($icone_missao) {
        $this->icone_missao = $icone_missao;
    }

    function setImagem_missao($imagem_missao) {
        $this->imagem_missao = $imagem_missao;
    }

    function setTexto_missao($texto_missao) {
        $this->texto_missao = $texto_missao;
    }

    function setIcone_visao($icone_visao) {
        $this->icone_visao = $icone_visao;
    }

    function setImagem_visao($imagem_visao) {
        $this->imagem_visao = $imagem_visao;
    }

    function setTexto_visao($texto_visao) {
        $this->texto_visao = $texto_visao;
    }

    function setIcone_valores($icone_valores) {
        $this->icone_valores = $icone_valores;
    }

    function setImagem_valores($imagem_valores) {
        $this->imagem_valores = $imagem_valores;
    }

    function setTexto_valores($texto_valores) {
        $this->texto_valores = $texto_valores;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
