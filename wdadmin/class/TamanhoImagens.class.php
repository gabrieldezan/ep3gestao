<?php

require_once "Conexao.class.php";

class TamanhoImagens extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_tamanho_imagens;
    private $tabela;
    private $campo;
    private $largura;
    private $altura;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_tamanho_imagens === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO tamanho_imagens (
                        tabela,
                        campo,
                        largura,
                        altura
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?
                    );
                ');
                $salva_dados->execute(array(
                    "$this->tabela",
                    "$this->campo",
                    "$this->largura",
                    "$this->altura"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE tamanho_imagens SET 
                        tabela = ?,
                        campo = ?,
                        largura = ?,
                        altura = ?
                    WHERE 
                        id_tamanho_imagens = ?;
                ');
                $salva_dados->execute(array(
                    "$this->tabela",
                    "$this->campo",
                    "$this->largura",
                    "$this->altura",
                    "$this->id_tamanho_imagens"
                ));
                $this->setRetorno_dados($this->id_tamanho_imagens);
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
                    id_tamanho_imagens,
                    tabela,
                    campo,
                    largura,
                    altura
                FROM
                    tamanho_imagens
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

    public function tamanho_imagens_tela() {

        try {
            $pdo = parent::getDB();

            $tamanho_imagens_tela = $pdo->prepare("
                SELECT
                    campo,
                    largura,
                    altura
                FROM
                    tamanho_imagens
                WHERE
                    tabela = ?
            ");
            $tamanho_imagens_tela->execute(array(
                "$this->tabela"
            ));
            if ($tamanho_imagens_tela->rowCount() > 0):
                $this->setRetorno_dados(json_encode($tamanho_imagens_tela->fetchAll()));
                return true;
            else:
                return false;
            endif;
        } catch (Exception $e) {
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
                    tabela,
                    campo,
                    largura,
                    altura
                FROM
                    tamanho_imagens
                WHERE
                    id_tamanho_imagens =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_tamanho_imagens"
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

    function getId_tamanho_imagens() {
        return $this->id_tamanho_imagens;
    }

    function getTabela() {
        return $this->tabela;
    }

    function getCampo() {
        return $this->campo;
    }

    function getLargura() {
        return $this->largura;
    }

    function getAltura() {
        return $this->altura;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_tamanho_imagens($id_tamanho_imagens) {
        $this->id_tamanho_imagens = $id_tamanho_imagens;
    }

    function setTabela($tabela) {
        $this->tabela = $tabela;
    }

    function setCampo($campo) {
        $this->campo = $campo;
    }

    function setLargura($largura) {
        $this->largura = $largura;
    }

    function setAltura($altura) {
        $this->altura = $altura;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
