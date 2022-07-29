<?php

require_once "Conexao.class.php";

class ConteudoPersonalizado extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_conteudo_personalizado;
    private $titulo;
    private $icone;
    private $imagem;
    private $imagem_largura;
    private $imagem_altura;
    private $texto;
    private $link;
    private $data;
    private $hora;
    private $numero;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_conteudo_personalizado === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO conteudo_personalizado (
                        titulo,
                        icone,
                        imagem,
                        imagem_largura,
                        imagem_altura,
                        texto,
                        link,
                        data,
                        hora,
                        numero
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
                        ?
                    );
                ');
                $salva_dados->execute(array(
                    "$this->titulo",
                    "$this->icone",
                    "$this->imagem",
                    "$this->imagem_largura",
                    "$this->imagem_altura",
                    "$this->texto",
                    "$this->link",
                    "$this->data",
                    "$this->hora",
                    "$this->numero"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE conteudo_personalizado SET 
                        titulo = ?,
                        icone = ?,
                        imagem = ?,
                        imagem_largura = ?,
                        imagem_altura = ?,
                        texto = ?,
                        link = ?,
                        data = ?,
                        hora = ?,
                        numero = ?
                    WHERE 
                        id_conteudo_personalizado = ?;
                ');
                $salva_dados->execute(array(
                    "$this->titulo",
                    "$this->icone",
                    "$this->imagem",
                    "$this->imagem_largura",
                    "$this->imagem_altura",
                    "$this->texto",
                    "$this->link",
                    "$this->data",
                    "$this->hora",
                    "$this->numero",
                    "$this->id_conteudo_personalizado"
                ));
                $this->setRetorno_dados($this->id_conteudo_personalizado);
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
                    id_conteudo_personalizado,
                    titulo,
                    imagem_largura,
                    imagem_altura
                FROM
                    conteudo_personalizado
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
                    icone,
                    imagem,
                    imagem_largura,
                    imagem_altura,
                    texto,
                    link,
                    data,
                    hora,
                    numero
                FROM
                    conteudo_personalizado
                WHERE
                    id_conteudo_personalizado =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_conteudo_personalizado"
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

    function getId_conteudo_personalizado() {
        return $this->id_conteudo_personalizado;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getIcone() {
        return $this->icone;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getImagem_largura() {
        return $this->imagem_largura;
    }

    function getImagem_altura() {
        return $this->imagem_altura;
    }

    function getTexto() {
        return $this->texto;
    }

    function getLink() {
        return $this->link;
    }

    function getData() {
        return $this->data;
    }

    function getHora() {
        return $this->hora;
    }

    function getNumero() {
        return $this->numero;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_conteudo_personalizado($id_conteudo_personalizado) {
        $this->id_conteudo_personalizado = $id_conteudo_personalizado;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setIcone($icone) {
        $this->icone = $icone;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setImagem_largura($imagem_largura) {
        $this->imagem_largura = $imagem_largura;
    }

    function setImagem_altura($imagem_altura) {
        $this->imagem_altura = $imagem_altura;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    function setLink($link) {
        $this->link = $link;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
