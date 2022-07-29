<?php

require_once "Conexao.class.php";

class InformacoesGerais extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $nome_empresa;
    private $titulo;
    private $descricao;
    private $whatsapp;
    private $celular1;
    private $celular2;
    private $email;
    private $email_contato;
    private $envio_host;
    private $envio_porta;
    private $envio_email;
    private $envio_senha;
    private $google_search_console;
    private $google_analytics;
    private $facebook_pixel;
    private $favicon;
    private $logo_principal;
    private $logo_secundaria;
    private $video_banner;
    private $politicas_privacidade;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            $salva_dados = $pdo->prepare('
                UPDATE informacoes_gerais SET 
                    nome_empresa = ?, 
                    titulo = ?, 
                    descricao = ?,  
                    whatsapp = ?, 
                    celular1 = ?, 
                    celular2 = ?, 
                    email = ?, 
                    email_contato = ?,
                    envio_host = ?,
                    envio_porta = ?,
                    envio_email = ?,
                    envio_senha = ?,
                    google_search_console = ?,
                    google_analytics = ?,
                    facebook_pixel = ?,
                    favicon = ?, 
                    logo_principal = ?,
                    logo_secundaria = ?,
                    video_banner = ?,
                    politicas_privacidade = ?
            ');
            $salva_dados->execute(array(
                "$this->nome_empresa",
                "$this->titulo",
                "$this->descricao",
                "$this->whatsapp",
                "$this->celular1",
                "$this->celular2",
                "$this->email",
                "$this->email_contato",
                "$this->envio_host",
                "$this->envio_porta",
                "$this->envio_email",
                "$this->envio_senha",
                "$this->google_search_console",
                "$this->google_analytics",
                "$this->facebook_pixel",
                "$this->favicon",
                "$this->logo_principal",
                "$this->logo_secundaria",
                "$this->video_banner",
                "$this->politicas_privacidade"
            ));
            $this->setRetorno_dados("1");
            return true;
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
                    nome_empresa,
                    titulo,
                    descricao,
                    whatsapp, 
                    celular1,
                    celular2,
                    email,
                    email_contato,
                    envio_host,
                    envio_porta,
                    envio_email,
                    envio_senha,
                    google_search_console,
                    google_analytics,
                    facebook_pixel,
                    favicon,
                    logo_principal,
                    logo_secundaria,
                    video_banner,
                    politicas_privacidade
                FROM
                    informacoes_gerais
            ");
            $edita_dados->execute();
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

    function getNome_empresa() {
        return $this->nome_empresa;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getWhatsapp() {
        return $this->whatsapp;
    }

    function getCelular1() {
        return $this->celular1;
    }

    function getCelular2() {
        return $this->celular2;
    }

    function getEmail() {
        return $this->email;
    }

    function getEmail_contato() {
        return $this->email_contato;
    }

    function getEnvio_host() {
        return $this->envio_host;
    }

    function getEnvio_porta() {
        return $this->envio_porta;
    }

    function getEnvio_email() {
        return $this->envio_email;
    }

    function getEnvio_senha() {
        return $this->envio_senha;
    }

    function getGoogle_search_console() {
        return $this->google_search_console;
    }

    function getGoogle_analytics() {
        return $this->google_analytics;
    }

    function getFacebook_pixel() {
        return $this->facebook_pixel;
    }

    function getFavicon() {
        return $this->favicon;
    }

    function getLogo_principal() {
        return $this->logo_principal;
    }

    function getLogo_secundaria() {
        return $this->logo_secundaria;
    }

    function getVideo_banner() {
        return $this->video_banner;
    }

    function getPoliticas_privacidade() {
        return $this->politicas_privacidade;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setNome_empresa($nome_empresa) {
        $this->nome_empresa = $nome_empresa;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setWhatsapp($whatsapp) {
        $this->whatsapp = $whatsapp;
    }

    function setCelular1($celular1) {
        $this->celular1 = $celular1;
    }

    function setCelular2($celular2) {
        $this->celular2 = $celular2;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setEmail_contato($email_contato) {
        $this->email_contato = $email_contato;
    }

    function setEnvio_host($envio_host) {
        $this->envio_host = $envio_host;
    }

    function setEnvio_porta($envio_porta) {
        $this->envio_porta = $envio_porta;
    }

    function setEnvio_email($envio_email) {
        $this->envio_email = $envio_email;
    }

    function setEnvio_senha($envio_senha) {
        $this->envio_senha = $envio_senha;
    }

    function setGoogle_search_console($google_search_console) {
        $this->google_search_console = $google_search_console;
    }

    function setGoogle_analytics($google_analytics) {
        $this->google_analytics = $google_analytics;
    }

    function setFacebook_pixel($facebook_pixel) {
        $this->facebook_pixel = $facebook_pixel;
    }

    function setFavicon($favicon) {
        $this->favicon = $favicon;
    }

    function setLogo_principal($logo_principal) {
        $this->logo_principal = $logo_principal;
    }

    function setLogo_secundaria($logo_secundaria) {
        $this->logo_secundaria = $logo_secundaria;
    }

    function setVideo_banner($video_banner) {
        $this->video_banner = $video_banner;
    }

    function setPoliticas_privacidade($politicas_privacidade) {
        $this->politicas_privacidade = $politicas_privacidade;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
