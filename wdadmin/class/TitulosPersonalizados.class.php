<?php

require_once "Conexao.class.php";

class TitulosPersonalizados extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_titulos_personalizados;
    private $titulo;
    private $subtitulo;
    private $imagem;
    private $icone;
    private $status;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_titulos_personalizados === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO titulos_personalizados (
                        titulo,
                        subtitulo,
                        imagem,
                        icone,
                        status
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    );
                ');
                $salva_dados->execute(array(
                    "$this->titulo",
                    "$this->subtitulo",
                    "$this->imagem",
                    "$this->icone",
                    "$this->status"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE titulos_personalizados SET 
                        titulo = ?,
                        subtitulo = ?,
                        imagem = ?,
                        icone = ?,
                        status = ?
                    WHERE 
                        id_titulos_personalizados = ?;
                ');
                $salva_dados->execute(array(
                    "$this->titulo",
                    "$this->subtitulo",
                    "$this->imagem",
                    "$this->icone",
                    "$this->status",
                    "$this->id_titulos_personalizados"
                ));
                $this->setRetorno_dados($this->id_titulos_personalizados);
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
                    id_titulos_personalizados,
                    titulo,
                    subtitulo,
                    CASE status
                        WHEN 1 THEN 'success'
                        WHEN 0 THEN 'danger'
                    END AS status_class,
                    CASE status
                        WHEN 1 THEN 'Ativo'
                        WHEN 0 THEN 'Inativo'
                    END AS status
                FROM
                    titulos_personalizados
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
                    subtitulo,
                    imagem,
                    icone,
                    status
                FROM
                    titulos_personalizados
                WHERE
                    id_titulos_personalizados =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_titulos_personalizados"
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

    function getId_titulos_personalizados() {
        return $this->id_titulos_personalizados;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getSubtitulo() {
        return $this->subtitulo;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getIcone() {
        return $this->icone;
    }

    function getStatus() {
        return $this->status;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_titulos_personalizados($id_titulos_personalizados) {
        $this->id_titulos_personalizados = $id_titulos_personalizados;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setSubtitulo($subtitulo) {
        $this->subtitulo = $subtitulo;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setIcone($icone) {
        $this->icone = $icone;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
