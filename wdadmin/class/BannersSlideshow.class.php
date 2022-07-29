<?php

require_once "Conexao.class.php";

class BannersSlideshow extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_banner;
    private $imagem;
    private $titulo;
    private $descricao;
    private $link;
    private $texto_botao;
    private $link_nova_aba;
    private $posicao;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_banner === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO banner (
                        imagem,
                        titulo,
                        descricao,
                        link,
                        texto_botao,
                        link_nova_aba,
                        posicao
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    );
                ');
                $salva_dados->execute(array(
                    "$this->imagem",
                    "$this->titulo",
                    "$this->descricao",
                    "$this->link",
                    "$this->texto_botao",
                    "$this->link_nova_aba",
                    "$this->posicao"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE banner SET 
                        imagem = ?,
                        titulo = ?,
                        descricao = ?,
                        link = ?,
                        texto_botao = ?,
                        link_nova_aba = ?,
                        posicao = ?
                    WHERE 
                        id_banner = ?;
                ');
                $salva_dados->execute(array(
                    "$this->imagem",
                    "$this->titulo",
                    "$this->descricao",
                    "$this->link",
                    "$this->texto_botao",
                    "$this->link_nova_aba",
                    "$this->posicao",
                    "$this->id_banner"
                ));
                $this->setRetorno_dados($this->id_banner);
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
                    id_banner,
                    imagem,
                    titulo,
                    CASE link_nova_aba
                    WHEN 1 THEN 'success'
                    WHEN 0 THEN 'danger'
                    END AS link_nova_aba_class,
                    CASE link_nova_aba
                    WHEN 1 THEN 'Sim'
                    WHEN 0 THEN 'Não'
                    END AS link_nova_aba,
                    posicao
                FROM
                    banner
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
                    imagem,
                    titulo,
                    descricao,
                    link,
                    texto_botao,
                    link_nova_aba,
                    posicao
                FROM
                    banner
                WHERE
                    id_banner =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_banner"
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

    function getId_banner() {
        return $this->id_banner;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getLink() {
        return $this->link;
    }

    function getTexto_botao() {
        return $this->texto_botao;
    }

    function getLink_nova_aba() {
        return $this->link_nova_aba;
    }

    function getPosicao() {
        return $this->posicao;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_banner($id_banner) {
        $this->id_banner = $id_banner;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setLink($link) {
        $this->link = $link;
    }

    function setTexto_botao($texto_botao) {
        $this->texto_botao = $texto_botao;
    }

    function setLink_nova_aba($link_nova_aba) {
        $this->link_nova_aba = $link_nova_aba;
    }

    function setPosicao($posicao) {
        $this->posicao = $posicao;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
