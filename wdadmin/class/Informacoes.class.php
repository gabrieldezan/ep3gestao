<?php

require_once "Conexao.class.php";

class Informacoes extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_informacoes;
    private $titulo;
    private $icone;
    private $imagem;
    private $texto;
    private $link;
    private $data;
    private $hora;
    private $numero;
    private $id_conteudo_personalizado;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_informacoes === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO informacoes (
                        titulo,
                        icone,
                        imagem,
                        texto,
                        link,
                        data,
                        hora,
                        numero,
                        id_conteudo_personalizado
                    ) VALUES (
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
                    "$this->texto",
                    "$this->link",
                    "$this->data",
                    "$this->hora",
                    "$this->numero",
                    "$this->id_conteudo_personalizado"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE informacoes SET 
                        titulo = ?,
                        icone = ?,
                        imagem = ?,
                        texto = ?,
                        link = ?,
                        data = ?,
                        hora = ?,
                        numero = ?
                    WHERE 
                        id_informacoes = ?;
                ');
                $salva_dados->execute(array(
                    "$this->titulo",
                    "$this->icone",
                    "$this->imagem",
                    "$this->texto",
                    "$this->link",
                    "$this->data",
                    "$this->hora",
                    "$this->numero",
                    "$this->id_informacoes"
                ));
                $this->setRetorno_dados($this->id_informacoes);
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
                    id_informacoes,
                    titulo,
                    imagem
                FROM
                    informacoes
                WHERE
                    id_conteudo_personalizado = ?
            ");
            $consulta_dados->execute(array(
                "$this->id_conteudo_personalizado"
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
                    titulo,
                    icone,
                    imagem,
                    texto,
                    link,
                    data,
                    hora,
                    numero
                FROM
                    informacoes
                WHERE
                    id_informacoes =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_informacoes"
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

    function getId_informacoes() {
        return $this->id_informacoes;
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

    function getId_conteudo_personalizado() {
        return $this->id_conteudo_personalizado;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_informacoes($id_informacoes) {
        $this->id_informacoes = $id_informacoes;
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

    function setId_conteudo_personalizado($id_conteudo_personalizado) {
        $this->id_conteudo_personalizado = $id_conteudo_personalizado;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
