<?php

class Arquivos {

    private $novo_arquivo;
    private $nome_amigavel;
    private $arquivo_atual;
    private $pasta;
    private $retorno_arquivo;
    private $erro;

    /* =============== FUNÇÃO INSERE ARQUIVO =============== */

    public function insere_arquivo() {
        if (isset($this->novo_arquivo['name']) && $this->novo_arquivo['error'] == 0) {
            $arquivo_tmp = $this->novo_arquivo['tmp_name'];
            $nome = $this->novo_arquivo['name'];
            $extensao = pathinfo($nome, PATHINFO_EXTENSION);
            $extensao = strtolower($extensao);
            $novoArquivo = $this->nome_amigavel . '-' . date("YmdHi") . "." . $extensao;
            $novoArquivoWebP = $this->nome_amigavel . '-' . date("YmdHi") . ".webp";
            $caminho_pasta = '../uploads/' . $this->pasta . '/';
            $destino = $caminho_pasta . $novoArquivo;
            if (!is_dir($caminho_pasta)) {
                mkdir($caminho_pasta, 0775, true);
            }
            if (@move_uploaded_file($arquivo_tmp, $destino)) {
//                imagewebp($destino, $caminho_pasta . $novoArquivoWebP);
                $this->retorno_arquivo = "$novoArquivo";
                $this->erro = 0;
                $this->excluir_arquivo();
            }
        } else if ($this->novo_arquivo['error'] == 1) {
            $this->retorno_arquivo = "$this->arquivo_atual";
            $this->erro = 1;
        } else if ($this->novo_arquivo['error'] == 2) {
            $this->retorno_arquivo = "$this->arquivo_atual";
            $this->erro = 2;
        } else if ($this->novo_arquivo['error'] == 4) {
            $this->retorno_arquivo = "$this->arquivo_atual";
            $this->erro = 4;
        }
    }

    /* =============== FUNÇÃO REMOVE ARQUIVO =============== */

    function excluir_arquivo() {
        if ($this->arquivo_atual !== "") {
            unlink("../uploads/$this->pasta/" . $this->arquivo_atual);
        }
    }

    /* =============== GETTERS E SETTERS =============== */

    function getNovo_arquivo() {
        return $this->novo_arquivo;
    }

    function getNome_amigavel() {
        return $this->nome_amigavel;
    }

    function getArquivo_atual() {
        return $this->arquivo_atual;
    }

    function getPasta() {
        return $this->pasta;
    }

    function getRetorno_arquivo() {
        return $this->retorno_arquivo;
    }

    function getErro() {
        return $this->erro;
    }

    function setNovo_arquivo($novo_arquivo) {
        $this->novo_arquivo = $novo_arquivo;
    }

    function setNome_amigavel($nome_amigavel) {
        $this->nome_amigavel = $nome_amigavel;
    }

    function setArquivo_atual($arquivo_atual) {
        $this->arquivo_atual = $arquivo_atual;
    }

    function setPasta($pasta) {
        $this->pasta = $pasta;
    }

    function setRetorno_arquivo($retorno_arquivo) {
        $this->retorno_arquivo = $retorno_arquivo;
    }

    function setErro($erro) {
        $this->erro = $erro;
    }

}
