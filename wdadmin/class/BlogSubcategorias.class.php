<?php

require_once "Conexao.class.php";

class BlogSubcategorias extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_blog_subcategorias;
    private $descricao;
    private $posicao;
    private $url_amigavel;
    private $status;
    private $id_blog_categorias;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_blog_subcategorias === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO blog_subcategorias (
                        descricao,
                        posicao,
                        url_amigavel,
                        status,
                        id_blog_categorias
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    );
                ');
                $salva_dados->execute(array(
                    "$this->descricao",
                    "$this->posicao",
                    "$this->url_amigavel",
                    "$this->status",
                    "$this->id_blog_categorias"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE blog_subcategorias SET 
                        descricao           = ?,
                        posicao             = ?,
                        url_amigavel        = ?,
                        status              = ?,
                        id_blog_categorias  = ?
                    WHERE 
                        id_blog_subcategorias = ?;
                ');
                $salva_dados->execute(array(
                    "$this->descricao",
                    "$this->posicao",
                    "$this->url_amigavel",
                    "$this->status",
                    "$this->id_blog_categorias",
                    "$this->id_blog_subcategorias"
                ));
                $this->setRetorno_dados($this->id_blog_subcategorias);
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
                    id_blog_subcategorias,
                    descricao,
                    posicao,
                    CASE status
                        WHEN 1 THEN 'success'
                        WHEN 0 THEN 'danger'
                    END AS status_class,
                    CASE status
                        WHEN 1 THEN 'Ativo'
                        WHEN 0 THEN 'Inativo'
                    END AS status
                FROM
                    blog_subcategorias
                WHERE 
                    id_blog_categorias = ?
                ORDER BY
                    status, posicao, descricao;
            ");
            $consulta_dados->execute(array(
                    "$this->id_blog_categorias"
                ));
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
                    posicao,
                    status
                FROM
                    blog_subcategorias
                WHERE
                    id_blog_subcategorias =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_blog_subcategorias"
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

    function getId_blog_subcategorias() {
        return $this->id_blog_subcategorias;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getPosicao() {
        return $this->posicao;
    }

    function getUrl_amigavel() {
        return $this->url_amigavel;
    }

    function getStatus() {
        return $this->status;
    }

    function getId_blog_Categorias() {
        return $this->id_blog_categorias;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_blog_subcategorias($id_blog_subcategorias) {
        $this->id_blog_subcategorias = $id_blog_subcategorias;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setPosicao($posicao) {
        $this->posicao = $posicao;
    }

    function setUrl_amigavel($url_amigavel) {
        $this->url_amigavel = $url_amigavel;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setId_blog_categorias($id_blog_categorias) {
        $this->id_blog_categorias = $id_blog_categorias;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
