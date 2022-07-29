<?php

require_once "Conexao.class.php";

class RedesSociais extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_redes_sociais;
    private $titulo;
    private $link;
    private $imagem;
    private $icone;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_redes_sociais === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO redes_sociais (
                        titulo,
                        link,
                        imagem,
                        icone
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?
                    );
                ');
                $salva_dados->execute(array(
                    "$this->titulo",
                    "$this->link",
                    "$this->imagem",
                    "$this->icone"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE redes_sociais SET 
                        titulo = ?,
                        link = ?,
                        imagem = ?,
                        icone = ?
                    WHERE 
                        id_redes_sociais = ?;
                ');
                $salva_dados->execute(array(
                    "$this->titulo",
                    "$this->link",
                    "$this->imagem",
                    "$this->icone",
                    "$this->id_redes_sociais"
                ));
                $this->setRetorno_dados($this->id_redes_sociais);
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
                    id_redes_sociais,
                    imagem,
                    titulo,
                    link
                FROM
                    redes_sociais
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
                    link,
                    imagem,
                    icone
                FROM
                    redes_sociais
                WHERE
                    id_redes_sociais =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_redes_sociais"
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

    function getId_redes_sociais() {
        return $this->id_redes_sociais;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getLink() {
        return $this->link;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getIcone() {
        return $this->icone;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_redes_sociais($id_redes_sociais) {
        $this->id_redes_sociais = $id_redes_sociais;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setLink($link) {
        $this->link = $link;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setIcone($icone) {
        $this->icone = $icone;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
