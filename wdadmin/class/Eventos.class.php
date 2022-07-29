<?php

require_once "Conexao.class.php";

class Eventos extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_eventos;
    private $descricao;
    private $detalhes;
    private $mais_informacoes;
    private $mapa;
    private $valor;
    private $valor_adicional;
    private $data_evento;
    private $imagem;
    private $status;
    private $url_amigavel;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_eventos === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO eventos (
                        descricao,
                        detalhes,
                        mais_informacoes,
                        mapa,
                        valor,
                        valor_adicional,
                        data_evento,
                        imagem,
                        status,
                        url_amigavel
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
                    "$this->descricao",
                    "$this->detalhes",
                    "$this->mais_informacoes",
                    "$this->mapa",
                    "$this->valor",
                    "$this->valor_adicional",
                    "$this->data_evento",
                    "$this->imagem",
                    "$this->status",
                    "$this->url_amigavel"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE eventos SET 
                        descricao = ?,
                        detalhes = ?,
                        mais_informacoes = ?,
                        mapa = ?,
                        valor = ?,
                        valor_adicional = ?,
                        data_evento = ?,
                        imagem = ?,
                        status = ?,
                        url_amigavel = ?
                    WHERE 
                        id_eventos = ?;
                ');

                $salva_dados->execute(array(
                    "$this->descricao",
                    "$this->detalhes",
                    "$this->mais_informacoes",
                    "$this->mapa",
                    "$this->valor",
                    "$this->valor_adicional",
                    "$this->data_evento",
                    "$this->imagem",
                    "$this->status",
                    "$this->url_amigavel",
                    "$this->id_eventos"
                ));
                $this->setRetorno_dados($this->id_eventos);
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
                    vp.id_eventos AS id_eventos,
                    vp.descricao AS descricao,
                    CASE vp.status
                        WHEN 1 THEN 'success'
                        WHEN 0 THEN 'danger'
                    END AS status_class,
                    CASE vp.status
                        WHEN 1 THEN 'Ativo'
                        WHEN 0 THEN 'Inativo'
                    END AS status,
                    format(vp.valor,2,'de_DE') AS valor,
                    vp.data_evento
                FROM
                    eventos vp
                WHERE
                    vp.id_eventos > 0
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

    public function consulta_dados_relatorio_compras() {

        try {
            $pdo = parent::getDB();

            $consulta_dados = $pdo->prepare("
                select 
                    v.idvenda,
                    ve.descricao as evento,
                    vp.valor,
                    vp.nome as participante, 
                    vp.cpf,
                    uc.nome as comprador,
                    (select 
                        venda_status.descricao_status 
                        from venda_status 
                        where venda_status.id_venda = v.idvenda 
                        ORDER by venda_status.datahora DESC 
                        LIMIT 1) as status,
                    (select 
                        CASE venda_status.status
                            WHEN 3 THEN 'success'
                            WHEN 4 THEN 'success'
                            WHEN 0 THEN 'warning'
                            WHEN 1 THEN 'warning'
                            WHEN 2 THEN 'warning'
                            ELSE 'danger'
                        END AS status_class 
                        from venda_status 
                        where venda_status.id_venda = v.idvenda 
                        ORDER by venda_status.datahora DESC 
                        LIMIT 1) as status_class
                from 
                    venda v inner join usuario_cliente uc on uc.id_usuario_cliente = v.idcliente
                    inner join eventos ve on ve.id_eventos = v.id_eventos
                    inner join venda_participante vp on vp.id_venda = v.idvenda
                where 
                    v.idvenda in ( select id_venda from venda_status )
                
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

    public function GetEventoPorID() {

        try {
            $pdo = parent::getDB();

            $consulta_dados = $pdo->prepare("
                SELECT ve.*
                FROM
                    eventos ve
                WHERE
                    ve.id_eventos = " . $this->id_eventos);
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
                    vp.descricao,
                    vp.detalhes,
                    vp.mais_informacoes,
                    vp.mapa,
                    format(vp.valor,2,'de_DE') AS valor,
                    format(vp.valor_adicional,2,'de_DE') AS valor_adicional,
                    DATE_FORMAT(vp.data_evento, '%Y-%m-%dT%H:%i') AS data_evento,
                    vp.imagem,
                    vp.status,
                    vp.url_amigavel
                FROM
                    eventos vp
                WHERE
                    vp.id_eventos =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_eventos"
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

    function getId_eventos() {
        return $this->id_eventos;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getReferencia() {
        return $this->referencia;
    }

    function getDetalhes() {
        return $this->detalhes;
    }

    function getMaisInformacoes() {
        return $this->mais_informacoes;
    }

    function getMapa() {
        return $this->mapa;
    }

    function getValor() {
        return $this->valor;
    }

    function getStatus() {
        return $this->status;
    }

    function getValor_adicional() {
        return $this->valor_adicional;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function getDataEvento() {
        return $this->data_evento;
    }

    function getUrlAmigavel() {
        return $this->url_amigavel;
    }

    function setId_eventos($id_eventos) {
        $this->id_eventos = $id_eventos;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setDetalhes($detalhes) {
        $this->detalhes = $detalhes;
    }

    function setMaisInformacoes($mais_informacoes) {
        $this->mais_informacoes = $mais_informacoes;
    }

    function setMapa($mapa) {
        $this->mapa = $mapa;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setDataEvento($data_evento) {
        $this->data_evento = $data_evento;
    }

    function setValor_adicional($valor_adicional) {
        $this->valor_adicional = $valor_adicional;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

    function setUrlAmigavel($url_amigavel) {
        $this->url_amigavel = $url_amigavel;
    }

}
