<?php

require_once "Conexao.class.php";

class VitrineProdutos extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_vitrine_produto;
    private $descricao;
    private $detalhes;
    private $garantia;
    private $peso;
    private $dimensoes;
    private $materiais;
    private $imagem;
    private $manual;
    private $informacao_adicional_1;
    private $informacao_adicional_2;
    private $informacao_adicional_3;
    private $link;
    private $link_secundario;
    private $valor;
    private $situacao;
    private $destaque;
    private $status;
    private $url_amigavel;
    private $id_vitrine_subgrupo;
    private $id_vitrine_grupo;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_vitrine_produto === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO vitrine_produto (
                        descricao,
                        detalhes,
                        garantia,
                        peso,
                        dimensoes,
                        materiais,
                        imagem,
                        manual,
                        informacao_adicional_1,
                        informacao_adicional_2,
                        informacao_adicional_3,
                        link,
                        link_secundario,
                        valor,
                        situacao,
                        destaque,
                        status,
                        url_amigavel,
                        id_vitrine_grupo,
                        id_vitrine_subgrupo
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
                        ?,
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
                    "$this->garantia",
                    "$this->peso",
                    "$this->dimensoes",
                    "$this->materiais",
                    "$this->imagem",
                    "$this->manual",
                    "$this->informacao_adicional_1",
                    "$this->informacao_adicional_2",
                    "$this->informacao_adicional_3",
                    "$this->link",
                    "$this->link_secundario",
                    "$this->valor",
                    "$this->situacao",
                    "$this->destaque",
                    "$this->status",
                    "$this->url_amigavel",
                    "$this->id_vitrine_grupo",
                    "$this->id_vitrine_subgrupo"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE vitrine_produto SET 
                        descricao = ?,
                        detalhes = ?,
                        garantia = ?,
                        peso = ?,
                        dimensoes = ?,
                        materiais = ?,
                        imagem = ?,
                        manual = ?,
                        informacao_adicional_1 = ?,
                        informacao_adicional_2 = ?,
                        informacao_adicional_3 = ?,
                        link = ?,
                        link_secundario = ?,
                        valor = ?,
                        situacao = ?,
                        destaque = ?,
                        status = ?,
                        url_amigavel = ?,
                        id_vitrine_grupo = ?,
                        id_vitrine_subgrupo = ?
                    WHERE 
                        id_vitrine_produto = ?;
                ');
                $salva_dados->execute(array(
                    "$this->descricao",
                    "$this->detalhes",
                    "$this->garantia",
                    "$this->peso",
                    "$this->dimensoes",
                    "$this->materiais",
                    "$this->imagem",
                    "$this->manual",
                    "$this->informacao_adicional_1",
                    "$this->informacao_adicional_2",
                    "$this->informacao_adicional_3",
                    "$this->link",
                    "$this->link_secundario",
                    "$this->valor",
                    "$this->situacao",
                    "$this->destaque",
                    "$this->status",
                    "$this->url_amigavel",
                    "$this->id_vitrine_grupo",
                    "$this->id_vitrine_subgrupo",
                    "$this->id_vitrine_produto"
                ));
                $this->setRetorno_dados($this->id_vitrine_produto);
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

            if ($this->id_vitrine_grupo != "T") {
                $vsWhereFiltroGrupo = "AND vg.id_vitrine_grupo = $this->id_vitrine_grupo";
            } else {
                $vsWhereFiltroGrupo = "";
            }

            if ($this->id_vitrine_subgrupo != "T") {
                $vsWhereFiltroSubgrupo = "AND vs.id_vitrine_subgrupo = $this->id_vitrine_subgrupo";
            } else {
                $vsWhereFiltroSubgrupo = "";
            }

            $consulta_dados = $pdo->prepare("
                SELECT
                    vp.id_vitrine_produto AS id_vitrine_produto,
                    vp.descricao AS descricao,
                    vg.descricao AS grupo,
                    vs.descricao AS subgrupo,
                    CASE vp.situacao
                        WHEN 1 THEN 'info'
                        WHEN 0 THEN 'warning'
                    END AS situacao_class,
                    CASE vp.situacao
                        WHEN 1 THEN 'Novo'
                        WHEN 0 THEN 'Usado'
                    END AS situacao,
                    CASE vp.status
                        WHEN 1 THEN 'success'
                        WHEN 0 THEN 'danger'
                    END AS status_class,
                    CASE vp.status
                        WHEN 1 THEN 'Ativo'
                        WHEN 0 THEN 'Inativo'
                    END AS status,
                    vp.valor AS valor
                FROM
                    vitrine_produto vp
                    LEFT JOIN vitrine_subgrupo vs ON vp.id_vitrine_subgrupo = vs.id_vitrine_subgrupo
                    LEFT JOIN vitrine_grupo vg ON vs.id_vitrine_grupo = vg.id_vitrine_grupo
                WHERE
                    vp.id_vitrine_produto > 0
                    $vsWhereFiltroGrupo
                    $vsWhereFiltroSubgrupo
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
                    vp.descricao,
                    vp.detalhes,
                    vp.garantia,
                    vp.peso,
                    vp.dimensoes,
                    vp.materiais,
                    vp.imagem,
                    vp.manual,
                    vp.informacao_adicional_1,
                    vp.informacao_adicional_2,
                    vp.informacao_adicional_3,
                    vp.link,
                    vp.link_secundario,
                    vp.valor,
                    vp.situacao,
                    vp.destaque,
                    vp.status,
                    vs.id_vitrine_grupo,
                    vp.id_vitrine_subgrupo
                FROM
                    vitrine_produto vp
                    LEFT JOIN vitrine_subgrupo vs ON vp.id_vitrine_subgrupo = vs.id_vitrine_subgrupo
                WHERE
                    vp.id_vitrine_produto =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_vitrine_produto"
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

    function getId_vitrine_produto() {
        return $this->id_vitrine_produto;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getDetalhes() {
        return $this->detalhes;
    }

    function getGarantia() {
        return $this->garantia;
    }

    function getPeso() {
        return $this->peso;
    }

    function getDimensoes() {
        return $this->dimensoes;
    }

    function getMateriais() {
        return $this->materiais;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getManual() {
        return $this->manual;
    }

    function getInformacao_adicional_1() {
        return $this->informacao_adicional_1;
    }

    function getInformacao_adicional_2() {
        return $this->informacao_adicional_2;
    }

    function getInformacao_adicional_3() {
        return $this->informacao_adicional_3;
    }

    function getLink() {
        return $this->link;
    }

    function getLink_secundario() {
        return $this->link_secundario;
    }

    function getValor() {
        return $this->valor;
    }

    function getSituacao() {
        return $this->situacao;
    }

    function getDestaque() {
        return $this->destaque;
    }

    function getStatus() {
        return $this->status;
    }

    function getUrl_amigavel() {
        return $this->url_amigavel;
    }

    function getId_vitrine_subgrupo() {
        return $this->id_vitrine_subgrupo;
    }

    function getId_vitrine_grupo() {
        return $this->id_vitrine_grupo;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_vitrine_produto($id_vitrine_produto) {
        $this->id_vitrine_produto = $id_vitrine_produto;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setDetalhes($detalhes) {
        $this->detalhes = $detalhes;
    }

    function setGarantia($garantia) {
        $this->garantia = $garantia;
    }

    function setPeso($peso) {
        $this->peso = $peso;
    }

    function setDimensoes($dimensoes) {
        $this->dimensoes = $dimensoes;
    }

    function setMateriais($materiais) {
        $this->materiais = $materiais;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setManual($manual) {
        $this->manual = $manual;
    }

    function setInformacao_adicional_1($informacao_adicional_1) {
        $this->informacao_adicional_1 = $informacao_adicional_1;
    }

    function setInformacao_adicional_2($informacao_adicional_2) {
        $this->informacao_adicional_2 = $informacao_adicional_2;
    }

    function setInformacao_adicional_3($informacao_adicional_3) {
        $this->informacao_adicional_3 = $informacao_adicional_3;
    }

    function setLink($link) {
        $this->link = $link;
    }
    
    function setLink_secundario($link_secundario) {
        $this->link_secundario = $link_secundario;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    function setDestaque($destaque) {
        $this->destaque = $destaque;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setUrl_amigavel($url_amigavel) {
        $this->url_amigavel = $url_amigavel;
    }

    function setId_vitrine_subgrupo($id_vitrine_subgrupo) {
        $this->id_vitrine_subgrupo = $id_vitrine_subgrupo;
    }

    function setId_vitrine_grupo($id_vitrine_grupo) {
        $this->id_vitrine_grupo = $id_vitrine_grupo;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
