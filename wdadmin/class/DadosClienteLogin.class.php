<?php

require_once "Conexao.class.php";

class DadosClienteLogin extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_cliente_login;
    private $nome;
    private $email;
    private $telefone;
    private $endereco;
    private $numero;
    private $complemento;
    private $cidade;
    private $estado;
    private $cep;
    private $senha;
    private $informacoes_adicionais;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();
            if ($this->id_cliente_login == "" || $this->id_cliente_login == null) {


                $salva_dados = $pdo->prepare('
                    INSERT INTO usuario_cliente
                    (email, nome, telefone, endereco, complemento, cidade, estado, cep, senha, informacoes_adicionais, data_cadastro, numero) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, current_timestamp, ?);
                ');
                $salva_dados->execute(array(
                    "$this->email",
                    "$this->nome",
                    "$this->telefone",
                    "$this->endereco",
                    "$this->complemento",
                    "$this->cidade",
                    "$this->estado",
                    "$this->cep",
                    "$this->senha",
                    "$this->informacoes_adicionais", 
                    "$this->numero"
                ));
                $this->id_cliente_login = $pdo->lastInsertId();
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE 
                            usuario_cliente 
                    SET 
                            nome=?,
                            telefone=?,
                            endereco=?,
                            numero=?,
                            complemento=?,
                            cidade=?,
                            estado=?,
                            cep=?,
                            informacoes_adicionais=?, 
                            data_alteracao= current_timestamp
                    WHERE 
                        id_usuario_cliente = ?;
                ');
                $salva_dados->execute(array(
                    "$this->nome",
                    "$this->telefone",
                    "$this->endereco",
                    "$this->numero",
                    "$this->complemento",
                    "$this->cidade",
                    "$this->estado",
                    "$this->cep",
                    "$this->informacoes_adicionais",
                    "$this->id_cliente_login"
                ));
                $this->setRetorno_dados($this->id_cliente_login);
            }
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== FUNÇÃO ATUALIZA SENHA =============== */

    public function atualiza_senha() {
        try {

            $pdo = parent::getDB();

            $atualiza_senha = $pdo->prepare('
                UPDATE cliente_login SET 
                    senha = ?
                WHERE 
                    id_cliente_login = ?;
            ');
            $atualiza_senha->execute(array(
                "$this->senha",
                "$this->id_cliente_login"
            ));
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== FUNÇÃO CONSULTA DADOS =============== */

    public function consulta_email() {

        try {
            $pdo = parent::getDB();

            $consulta_dados = $pdo->prepare("
                SELECT
                    *
                FROM
                    usuario_cliente where email = '" . $this->getEmail() . "'
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


    public function logar() {
        $pdo = parent::getDB();

        $logar = $pdo->prepare("
            SELECT   
                u.id_usuario_cliente,
                u.nome,
                u.email,
                u.senha
            FROM
                usuario_cliente u
            WHERE
                u.email = ? AND senha = ? 
        ");
        $logar->bindValue(1, $this->getEmail());
        $logar->bindValue(2, $this->getSenha());
        $logar->execute();
        if ($logar->rowCount() == 1):
            $dados = $logar->fetch(PDO::FETCH_OBJ);
            $_SESSION['cliente-elite-id'] = $dados->id_usuario_cliente;
            $_SESSION['cliente-elite-nome'] = $dados->nome;
            $_SESSION['cliente-elite-email'] = $dados->email;
            $_SESSION['cliente-elite'] = $dados->email;
            $_SESSION['cliente-elite-logado'] = true;
            return true;
        else:
            return false;
        endif;
    }

    public static function deslogar() {
        session_start();
        if ($_SESSION['cliente-elite']):
            unset($_SESSION['cliente-elite']);
            unset($_SESSION['cliente-elite-logado']);
            unset($_SESSION['cliente-elite-id']);
            unset($_SESSION['cliente-elite-nome']);
            unset($_SESSION['cliente-elite-email']);
                        
            session_destroy();
            return true;
        else:
            return false;
        endif;
    }

    /* =============== REMOVE CARACTERES ESPECIAIS =============== */

    public function remover_caracter($string) {
        return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
    }

    /* =============== GETTERS E SETTERS =============== */

    function getNome() {
        return $this->nome;
    }

    function getSenha() {
        return $this->senha;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSenha($senha) {
        $this->senha = md5($senha);
    }

    function getId_cliente_login() {
        return $this->id_cliente_login;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getEndereco() {
        return $this->endereco;
    }
    function getNumero() {
        return $this->numero;
    }

        function getComplemento() {
        return $this->complemento;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getEstado() {
        return $this->estado;
    }

    function getCep() {
        return $this->cep;
    }

    function getInformacoes_adicionais() {
        return $this->informacoes_adicionais;
    }

    function setId_cliente_login($id_cliente_login) {
        $this->id_cliente_login = $id_cliente_login;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }
    
    function setNumero($numero) {
        $this->numero = $numero;
    }

    
    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setInformacoes_adicionais($informacoes_adicionais) {
        $this->informacoes_adicionais = $informacoes_adicionais;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
