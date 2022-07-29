<?php

require_once "Conexao.class.php";

class OrcamentosRecebidos extends Conexao
{
    /* =============== VARIAVEIS =============== */

    private $id_orcamentos_recebidos;
    private $nome;
    private $cidade_uf;
    private $email;
    private $gasto_mensal;
    private $telefone;
    private $anexo;
    private $mensagem;
    private $data_recebimento;
    private $status;
    private $retorno_dados;

    /* =============== FUNÇÃO INSERE DADOS =============== */

    public function insere_dados()
    {
        try {

            $pdo = parent::getDB();

            $insere_dados = $pdo->prepare('
                    INSERT INTO orcamentos_recebidos (
                        nome,
                        cidade_uf,
                        email,
                        gasto_mensal,
                        telefone,
                        anexo,
                        mensagem,
                        data_recebimento,
                        status
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
            $insere_dados->execute(array(
                "$this->nome",
                "$this->cidade_uf",
                "$this->email",
                "$this->gasto_mensal",
                "$this->telefone",
                "$this->anexo",
                "$this->mensagem",
                "$this->data_recebimento",
                "$this->status"
            ));
            $this->setRetorno_dados($pdo->lastInsertId());
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== FUNÇÃO ATUALIZA STATUS =============== */

    public function atualiza_status_orcamentos()
    {
        try {

            $pdo = parent::getDB();

            $atualiza_status_orcamentos = $pdo->prepare('
                UPDATE orcamentos_recebidos SET 
                    status = ?
                WHERE 
                    id_orcamentos_recebidos = ?;
            ');

            $atualiza_status_orcamentos->execute(array(
                "$this->status",
                "$this->id_orcamentos_recebidos"
            ));
            $this->setRetorno_dados($this->id_orcamentos_recebidos);
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== FUNÇÃO CONSULTA DADOS =============== */

    public function consulta_dados()
    {

        try {
            $pdo = parent::getDB();

            $consulta_dados = $pdo->prepare("
                SELECT
                    id_orcamentos_recebidos,
                    nome,
                    cidade_uf,
                    email,
                    gasto_mensal,
                    telefone,
                    anexo,
                    mensagem,
                    DATE_FORMAT(data_recebimento, '%d/%m/%Y às %H:%i') AS data_recebimento_formatado,
                    CASE status
                        WHEN 1 THEN 'info'
                        WHEN 2 THEN 'success'
                    END AS status_class,
                    CASE status
                        WHEN 1 THEN 'Novo'
                        WHEN 2 THEN 'Lido'
                    END AS status
                FROM
                    orcamentos_recebidos
            ");
            $consulta_dados->execute();
            if ($consulta_dados->rowCount() > 0) :
                $this->setRetorno_dados(json_encode($consulta_dados->fetchAll()));
                return true;
            else :
                return false;
            endif;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== GETTERS E SETTERS =============== */

    function getId_orcamentos_recebidos()
    {
        return $this->id_orcamentos_recebidos;
    }

    function getNome()
    {
        return $this->nome;
    }

    function getCidade_uf()
    {
        return $this->cidade_uf;
    }

    function getEmail()
    {
        return $this->email;
    }
    
    function getGasto_mensal()
    {
        return $this->gasto_mensal;
    }

    function getTelefone()
    {
        return $this->telefone;
    }

    function getAnexo()
    {
        return $this->anexo;
    }

    function getMensagem()
    {
        return $this->mensagem;
    }

    function getData_recebimento()
    {
        return $this->data_recebimento;
    }

    function getStatus()
    {
        return $this->status;
    }

    function getRetorno_dados()
    {
        return $this->retorno_dados;
    }

    function setId_orcamentos_recebidos($id_orcamentos_recebidos)
    {
        $this->id_orcamentos_recebidos = $id_orcamentos_recebidos;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
    }

    function setCidade_uf($cidade_uf)
    {
        $this->cidade_uf = $cidade_uf;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }
    
    function setGasto_mensal($gasto_mensal)
    {
        $this->gasto_mensal = $gasto_mensal;
    }

    function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    function setAnexo($anexo)
    {
        $this->anexo = $anexo;
    }

    function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    function setData_recebimento($data_recebimento)
    {
        $this->data_recebimento = $data_recebimento;
    }

    function setStatus($status)
    {
        $this->status = $status;
    }

    function setRetorno_dados($retorno_dados)
    {
        $this->retorno_dados = $retorno_dados;
    }
}