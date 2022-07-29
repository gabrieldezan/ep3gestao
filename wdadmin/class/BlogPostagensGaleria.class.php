<?php

require_once "Conexao.class.php";

class BlogPostagensGaleria extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_blog_postagem_galeria;
    private $descricao;
    private $imagem;
    private $id_blog_postagem;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_blog_postagem_galeria === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO blog_postagem_galeria (
                        descricao,
                        imagem,
                        id_blog_postagem
                    ) VALUES (
                        ?,
                        ?,
                        ?
                    );
                ');
                $salva_dados->execute(array(
                    "$this->descricao",
                    "$this->imagem",
                    "$this->id_blog_postagem"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE blog_postagem_galeria SET 
                        descricao = ?,
                        imagem = ?,
                        id_blog_postagem = ?
                    WHERE 
                        id_blog_postagem_galeria = ?;
                ');
                $salva_dados->execute(array(
                    "$this->descricao",
                    "$this->imagem",
                    "$this->id_blog_postagem",
                    "$this->id_blog_postagem_galeria"
                ));
                $this->setRetorno_dados($this->id_blog_postagem_galeria);
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
                    id_blog_postagem_galeria,
                    descricao,
                    imagem
                FROM
                    blog_postagem_galeria
                WHERE
                    id_blog_postagem = $this->id_blog_postagem
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
                    imagem
                FROM
                    blog_postagem_galeria
                WHERE
                    id_blog_postagem_galeria =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_blog_postagem_galeria"
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

    function getId_blog_postagem_galeria() {
        return $this->id_blog_postagem_galeria;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getId_blog_postagem() {
        return $this->id_blog_postagem;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_blog_postagem_galeria($id_blog_postagem_galeria) {
        $this->id_blog_postagem_galeria = $id_blog_postagem_galeria;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setId_blog_postagem($id_blog_postagem) {
        $this->id_blog_postagem = $id_blog_postagem;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}