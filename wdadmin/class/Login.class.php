<?php

require_once "Conexao.class.php";

class Login extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $login;
    private $senha;

    /* =============== FUNÇÃO LOGIN =============== */

    public function login() {
        session_start();

        $pdo = parent::getDB();

        $login = $pdo->prepare("
            SELECT   
                u.id_usuarios,
                u.nome,
                u.login,
                u.senha,
                u.imagem_perfil,
                u.status,
                ig.logo_principal,
                ig.whatsapp,
                ig.email
            FROM
                usuarios u, informacoes_gerais ig
            WHERE
                u.login = ? AND senha = ? AND status = 1
        ");
        $login->bindValue(1, $this->login);
        $login->bindValue(2, $this->senha);
        $login->execute();
        if ($login->rowCount() == 1):
            $dados = $login->fetch(PDO::FETCH_OBJ);
            setcookie('wd_id_usuario', $dados->id_usuarios, time() + 86400, '/');
            setcookie('wd_nome', $dados->nome, time() + 86400, '/');
            setcookie('wd_login', $dados->login, time() + 86400, '/');
            setcookie('wd_imagem_perfil', $dados->imagem_perfil !== "" ? $dados->imagem_perfil : "sem-imagem-avatar.png", time() + 86400, '/');
            setcookie('wd_status', $dados->status, time() + 86400, '/');
            setcookie('wd_logo_principal', $dados->logo_principal, time() + 86400, '/');
            setcookie('wd_whatsapp', $dados->whatsapp, time() + 86400, '/');
            setcookie('wd_email', $dados->email, time() + 86400, '/');
            setcookie('id_conteudo_personalizado', "0", time() + 86400, '/');
            setcookie('titulo_conteudo_personalizado', "0", time() + 86400, '/');
            setcookie('largura_conteudo_personalizado', "0", time() + 86400, '/');
            setcookie('altura_conteudo_personalizado', "0", time() + 86400, '/');
            setcookie('wd_logado', true, time() + 86400, '/');
            return true;
        else:
            return false;
        endif;
    }

    /* =============== FUNÇÃO LOGOFF =============== */

    public static function logoff() {
        session_start();

        if ($_COOKIE['wd_logado']):
            setcookie('wd_id_usuario', '', time() + 86400, '/');
            setcookie('wd_nome', '', time() + 86400, '/');
            setcookie('wd_login', '', time() + 86400, '/');
            setcookie('wd_imagem_perfil', '', time() + 86400, '/');
            setcookie('wd_status', '', time() + 86400, '/');
            setcookie('wd_logo_principal', '', time() + 86400, '/');
            setcookie('wd_whatsapp', '', time() + 86400, '/');
            setcookie('wd_email', '', time() + 86400, '/');
            setcookie('id_conteudo_personalizado', '', time() + 86400, '/');
            setcookie('titulo_conteudo_personalizado', '', time() + 86400, '/');
            setcookie('largura_conteudo_personalizado', '', time() + 86400, '/');
            setcookie('altura_conteudo_personalizado', '', time() + 86400, '/');
            setcookie('wd_logado', '', time() + 86400, '/');
            return true;
        else:
            return false;
        endif;
    }

    /* =============== GETTERS E SETTERS =============== */

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

}
