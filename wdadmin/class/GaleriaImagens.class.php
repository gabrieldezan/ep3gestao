<?php

require_once "Conexao.class.php";

class GaleriaImagens extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_galeria_imagem;
    private $titulo;
    private $imagem1;
    private $imagem2;
    private $imagem3;
    private $imagem4;
    private $imagem5;
    private $descricao;
    private $detalhes;
    private $link1;
    private $link2;
    private $youtube;
    private $url_amigavel;
    private $id_galeria_grupo;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_galeria_imagem === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO galeria_imagem (
                        titulo,
                        imagem1,
                        imagem2,
                        imagem3,
                        imagem4,
                        imagem5,
                        descricao,
                        detalhes,
                        link1,
                        link2,
                        youtube,
                        url_amigavel,
                        id_galeria_grupo
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
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
                    "$this->titulo",
                    "$this->imagem1",
                    "$this->imagem2",
                    "$this->imagem3",
                    "$this->imagem4",
                    "$this->imagem5",
                    "$this->descricao",
                    "$this->detalhes",
                    "$this->link1",
                    "$this->link2",
                    "$this->youtube",
                    "$this->url_amigavel",
                    "$this->id_galeria_grupo"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE galeria_imagem SET 
                        titulo = ?,
                        imagem1 = ?,
                        imagem2 = ?,
                        imagem3 = ?,
                        imagem4 = ?,
                        imagem5 = ?,
                        descricao = ?,
                        detalhes = ?,
                        link1 = ?,
                        link2 = ?,
                        youtube = ?,
                        url_amigavel = ?,
                        id_galeria_grupo = ?
                    WHERE 
                        id_galeria_imagem = ?;
                ');
                $salva_dados->execute(array(
                    "$this->titulo",
                    "$this->imagem1",
                    "$this->imagem2",
                    "$this->imagem3",
                    "$this->imagem4",
                    "$this->imagem5",
                    "$this->descricao",
                    "$this->detalhes",
                    "$this->link1",
                    "$this->link2",
                    "$this->youtube",
                    "$this->url_amigavel",
                    "$this->id_galeria_grupo",
                    "$this->id_galeria_imagem"
                ));
                $this->setRetorno_dados($this->id_galeria_imagem);
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

            if ($this->id_galeria_grupo != "T") {
                $vsWhereFiltro = "WHERE gi.id_galeria_grupo = $this->id_galeria_grupo";
            } else {
                $vsWhereFiltro = "";
            }

            $consulta_dados = $pdo->prepare("
                SELECT
                    gi.id_galeria_imagem,
                    gg.descricao,
                    gi.imagem1,
                    gi.titulo
                FROM
                    galeria_imagem gi
                    LEFT JOIN galeria_grupo gg ON gg.id_galeria_grupo = gi.id_galeria_grupo
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
                    titulo,                    
                    imagem1,
                    imagem2,
                    imagem3,
                    imagem4,
                    imagem5,
                    descricao,
                    detalhes,
                    link1,
                    link2,
                    youtube,
                    id_galeria_grupo
                FROM
                    galeria_imagem
                WHERE
                    id_galeria_imagem =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_galeria_imagem"
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

    function getId_galeria_imagem() {
        return $this->id_galeria_imagem;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getImagem1() {
        return $this->imagem1;
    }

    function getImagem2() {
        return $this->imagem2;
    }

    function getImagem3() {
        return $this->imagem3;
    }

    function getImagem4() {
        return $this->imagem4;
    }

    function getImagem5() {
        return $this->imagem5;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getDetalhes() {
        return $this->detalhes;
    }

    function getLink1() {
        return $this->link1;
    }

    function getLink2() {
        return $this->link2;
    }
    
    function getYoutube() {
        return $this->youtube;
    }

    function getUrl_amigavel() {
        return $this->url_amigavel;
    }

    function getId_galeria_grupo() {
        return $this->id_galeria_grupo;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_galeria_imagem($id_galeria_imagem) {
        $this->id_galeria_imagem = $id_galeria_imagem;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setImagem1($imagem1) {
        $this->imagem1 = $imagem1;
    }

    function setImagem2($imagem2) {
        $this->imagem2 = $imagem2;
    }

    function setImagem3($imagem3) {
        $this->imagem3 = $imagem3;
    }

    function setImagem4($imagem4) {
        $this->imagem4 = $imagem4;
    }

    function setImagem5($imagem5) {
        $this->imagem5 = $imagem5;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setDetalhes($detalhes) {
        $this->detalhes = $detalhes;
    }

    function setLink1($link1) {
        $this->link1 = $link1;
    }

    function setLink2($link2) {
        $this->link2 = $link2;
    }

    function setYoutube($youtube) {
        $this->youtube = $youtube;
    }

    function setUrl_amigavel($url_amigavel) {
        $this->url_amigavel = $url_amigavel;
    }

    function setId_galeria_grupo($id_galeria_grupo) {
        $this->id_galeria_grupo = $id_galeria_grupo;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
