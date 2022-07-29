<?php

require_once "Conexao.class.php";

class VitrineProdutosCores extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_vitrine_produto_cores;
    private $descricao;
    private $cor_hexadecimal;
    private $referencia;
    private $imagem1;
    private $imagem2;
    private $imagem3;
    private $imagem4;
    private $imagem5;
    private $id_vitrine_produto;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_vitrine_produto_cores === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO vitrine_produto_cores (
                        descricao,
                        cor_hexadecimal,
                        referencia,
                        imagem1,
                        imagem2,
                        imagem3,
                        imagem4,
                        imagem5,
                        id_vitrine_produto
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
                    "$this->descricao",
                    "$this->cor_hexadecimal",
                    "$this->referencia",
                    "$this->imagem1",
                    "$this->imagem2",
                    "$this->imagem3",
                    "$this->imagem4",
                    "$this->imagem5",
                    "$this->id_vitrine_produto"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE vitrine_produto_cores SET 
                        descricao = ?,
                        cor_hexadecimal = ?,
                        referencia = ?,
                        imagem1 = ?,
                        imagem2 = ?,
                        imagem3 = ?,
                        imagem4 = ?,
                        imagem5 = ?,
                        id_vitrine_produto = ?
                    WHERE 
                        id_vitrine_produto_cores = ?;
                ');
                $salva_dados->execute(array(
                    "$this->descricao",
                    "$this->cor_hexadecimal",
                    "$this->referencia",
                    "$this->imagem1",
                    "$this->imagem2",
                    "$this->imagem3",
                    "$this->imagem4",
                    "$this->imagem5",
                    "$this->id_vitrine_produto",
                    "$this->id_vitrine_produto_cores"
                ));
                $this->setRetorno_dados($this->id_vitrine_produto_cores);
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
                    id_vitrine_produto_cores,
                    cor_hexadecimal,
                    descricao,
                    referencia,
                    imagem1,
                    imagem2,
                    imagem3,
                    imagem4,
                    imagem5
                FROM
                    vitrine_produto_cores
                WHERE
                    id_vitrine_produto = $this->id_vitrine_produto
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
                    cor_hexadecimal,
                    referencia,
                    imagem1,
                    imagem2,
                    imagem3,
                    imagem4,
                    imagem5
                FROM
                    vitrine_produto_cores
                WHERE
                    id_vitrine_produto_cores =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_vitrine_produto_cores"
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

    function getId_vitrine_produto_cores() {
        return $this->id_vitrine_produto_cores;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getCor_hexadecimal() {
        return $this->cor_hexadecimal;
    }

    function getReferencia() {
        return $this->referencia;
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

    function getId_vitrine_produto() {
        return $this->id_vitrine_produto;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_vitrine_produto_cores($id_vitrine_produto_cores) {
        $this->id_vitrine_produto_cores = $id_vitrine_produto_cores;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setCor_hexadecimal($cor_hexadecimal) {
        $this->cor_hexadecimal = $cor_hexadecimal;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
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

    function setId_vitrine_produto($id_vitrine_produto) {
        $this->id_vitrine_produto = $id_vitrine_produto;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
