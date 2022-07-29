<?php

require_once "Conexao.class.php";

class Clientes extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_clientes;
    private $descricao;
    private $imagem;
    private $endereco;
    private $cidade;
    private $estado;
    private $telefone;
    private $link;
    private $status;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_clientes === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO clientes (
                        imagem,
                        descricao,
                        endereco,
                        cidade,
                        estado,
                        telefone,
                        link,
                        status
                    ) VALUES (
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
                    "$this->imagem",
                    "$this->descricao",
                    "$this->endereco",
                    "$this->cidade",
                    "$this->estado",
                    "$this->telefone",
                    "$this->link",
                    "$this->status"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE clientes SET 
                        imagem = ?,
                        descricao = ?,
                        endereco = ?,
                        cidade = ?,
                        estado = ?,
                        telefone = ?,
                        link = ?,
                        status = ?
                    WHERE 
                        id_clientes = ?;
                ');
                $salva_dados->execute(array(
                    "$this->imagem",
                    "$this->descricao",
                    "$this->endereco",
                    "$this->cidade",
                    "$this->estado",
                    "$this->telefone",
                    "$this->link",
                    "$this->status",
                    "$this->id_clientes"
                ));
                $this->setRetorno_dados($this->id_clientes);
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
                    id_clientes,
                    imagem,
                    descricao,
                    link,
                    CASE status
                        WHEN 1 THEN 'success'
                        WHEN 0 THEN 'danger'
                    END AS status_class,
                    CASE status
                        WHEN 1 THEN 'Ativo'
                        WHEN 0 THEN 'Inativo'
                    END AS status
                FROM
                    clientes
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

    public function consulta_onde_comprar() {

        try {
            $pdo = parent::getDB();

            $consulta_onde_comprar = $pdo->prepare("
                SELECT
                    imagem,
                    descricao,
                    endereco,
                    cidade,
                    estado
                FROM
                    clientes
                WHERE
                    status = 1 AND
                    cidade = ? AND
                    estado = ?
            ");
            $consulta_onde_comprar->execute(array(
                "$this->cidade",
                "$this->estado"
            ));
            if ($consulta_onde_comprar->rowCount() > 0):
                $this->setRetorno_dados(json_encode($consulta_onde_comprar->fetchAll()));
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
                    imagem,
                    descricao,
                    endereco,
                    cidade,
                    estado,
                    telefone,
                    link,
                    status
                FROM
                    clientes
                WHERE
                    id_clientes =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_clientes"
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

    function getId_clientes() {
        return $this->id_clientes;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getEstado() {
        return $this->estado;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getLink() {
        return $this->link;
    }

    function getStatus() {
        return $this->status;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_clientes($id_clientes) {
        $this->id_clientes = $id_clientes;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setLink($link) {
        $this->link = $link;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
