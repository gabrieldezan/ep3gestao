<?php

require_once "Conexao.class.php";

class BlogImagens extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_blog_imagens;
    private $titulo;
    private $imagem;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            $salva_dados = $pdo->prepare('
                INSERT INTO blog_imagens (
                    titulo,
                    imagem
                ) VALUES (
                    ?,
                    ?
                );
            ');
            $salva_dados->execute(array(
                "$this->titulo",
                "$this->imagem"
            ));
            $this->setRetorno_dados($pdo->lastInsertId());
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
                    id_blog_imagens,
                    titulo,
                    imagem
                FROM
                    blog_imagens
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

    /* =============== GETTERS E SETTERS =============== */

    function getId_blog_imagens() {
        return $this->id_blog_imagens;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_blog_imagens($id_blog_imagens) {
        $this->id_blog_imagens = $id_blog_imagens;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
