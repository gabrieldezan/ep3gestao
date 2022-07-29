<?php

require_once "Conexao.class.php";
require_once "class.phpmailer.php";

class EnviosEmailOrcamento extends Conexao
{
    /* =============== VARIAVEIS =============== */

    private $nome;
    private $cidade_uf;
    private $email;
    private $gasto_mensal;
    private $anexo;
    private $telefone;
    private $mensagem;
    private $host;
    private $port;
    private $username;
    private $password;
    private $email_envio;
    private $nome_empresa;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function envia_email_orcamento()
    {
        try {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->CharSet = "UTF-8";
            $mail->Encoding = 'base64';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "mail.webdezan.com.br";
            $mail->Port = 465;
            $mail->Username = "naoresponda@webdezan.com.br";
            $mail->Password = "!@#nr!@#";
            $mail->From = "naoresponda@webdezan.com.br";
            $mail->FromName = '=?utf-8?B?' . base64_encode("Não Responda") . '?=';
            $mail->AddAddress($this->email_envio, '=?utf-8?B?' . base64_encode($this->nome_empresa) . '?=');
            $mail->IsHTML(true);
            $mail->Subject = '=?utf-8?B?' . base64_encode("Orçamento via E-mail") . '?=';
            $mail->Body = "
                <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
                <html xmlns='http://www.w3.org/1999/xhtml'>
                    <head>
                        <title>Web Dezan - Envios de E-mail</title>
                        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
                        <style type='text/css'>
                            * {
                                -ms-text-size-adjust:100%;
                                -webkit-text-size-adjust:none;
                                -webkit-text-resize:100%;
                                text-resize:100%;
                            }
                            a{
                                outline:none;
                                color:#40aceb;
                                text-decoration:underline;
                            }
                            a:hover{text-decoration:none !important;}
                            .nav a:hover{text-decoration:underline !important;}
                            .title a:hover{text-decoration:underline !important;}
                            .title-2 a:hover{text-decoration:underline !important;}
                            .btn:hover{opacity:0.8;}
                            .btn a:hover{text-decoration:none !important;}
                            .btn{
                                -webkit-transition:all 0.3s ease;
                                -moz-transition:all 0.3s ease;
                                -ms-transition:all 0.3s ease;
                                transition:all 0.3s ease;
                            }
                            #corpo_mensagem img{max-width:500px!important;height:auto!important;}
                            table td {border-collapse: collapse !important;}
                            .ExternalClass, .ExternalClass a, .ExternalClass span, .ExternalClass b, .ExternalClass br, .ExternalClass p, .ExternalClass div{line-height:inherit;}
                            @media only screen and (max-width:500px) {
                                table[class='flexible']{width:100% !important;}
                                table[class='center']{
                                    float:none !important;
                                    margin:0 auto !important;
                                }
                                *[class='hide']{
                                    display:none !important;
                                    width:0 !important;
                                    height:0 !important;
                                    padding:0 !important;
                                    font-size:0 !important;
                                    line-height:0 !important;
                                }
                                td[class='img-flex'] img{
                                    width:100% !important;
                                    height:auto !important;
                                }
                                td[class='aligncenter']{text-align:center !important;}
                                th[class='flex']{
                                    display:block !important;
                                    width:100% !important;
                                }
                                td[class='wrapper']{padding:0 !important;}
                                td[class='holder']{padding:30px 15px 20px !important;}
                                td[class='nav']{
                                    padding:20px 0 0 !important;
                                    text-align:center !important;
                                }
                                td[class='h-auto']{height:auto !important;}
                                td[class='description']{padding:30px 20px !important;}
                                td[class='i-120'] img{
                                    width:120px !important;
                                    height:auto !important;
                                }
                                td[class='footer']{padding:5px 20px 20px !important;}
                                td[class='footer'] td[class='aligncenter']{
                                    line-height:25px !important;
                                    padding:20px 0 0 !important;
                                }
                                tr[class='table-holder']{
                                    display:table !important;
                                    width:100% !important;
                                }
                                th[class='thead']{display:table-header-group !important; width:100% !important;}
                                th[class='tfoot']{display:table-footer-group !important; width:100% !important;}
                            }
                        </style>
                    </head>
                    <body style='margin:0; padding:0;' bgcolor='#eaeced'>
                        <table style='min-width:320px;' width='100%' cellspacing='0' cellpadding='0' bgcolor='#eaeced'>
                            <tr>
                                <td class='hide'>
                                    <table width='600' cellpadding='0' cellspacing='0' style='width:600px !important;'>
                                        <tr>
                                            <td style='min-width:600px; font-size:0; line-height:0;'>&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class='wrapper' style='padding:0 10px;'>
                                    <table data-module='module-2' data-thumb='thumbnails/02.png' width='100%' cellpadding='10' cellspacing='0'>
                                        <tr>
                                            <td data-bgcolor='bg-module' bgcolor='#eaeced'>
                                                <table class='flexible' width='600' align='center' style='margin:0 auto;' cellpadding='0' cellspacing='0'>
                                                    <tr>
                                                        <td class='img-flex'><img src='https://webdezan.com.br/images/cabecalho.png' style='vertical-align:top;' width='600' height='200'/></td>
                                                    </tr>
                                                    <tr>
                                                        <td data-bgcolor='bg-block' class='holder' style='padding:58px 50px 52px;' bgcolor='#f9f9f9'>
                                                            <table width='100%' cellpadding='0' cellspacing='0'>
                                                            <tr>
                                                                <td data-color='title' data-size='size title' data-min='25' data-max='45' data-link-color='link title color' data-link-style='text-decoration:none; color:#292c34;' class='title' align='center' style='font:24px/27px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 24px;'>
                                                                    Olá, $this->nome_empresa você recebeu um novo currículo via site
                                                                </td>
                                                            </tr>
                                                                <tr>
                                                                    <td id='corpo_mensagem' data-color='text' data-size='size text' data-min='10' data-max='26' data-link-color='link text color' data-link-style='font-weight:light; text-decoration:underline; color:#40aceb;' style='font:lighter 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;'>
                                                                        <b>Nome:</b> $this->nome <br /><br />
                                                                        <b>Cidade-UF:</b> $this->cidade_uf <br /><br />
                                                                        <b>E-mail:</b> $this->email <br /><br />
                                                                        <b>Gasto médio mensal em eletricidade:</b> R$ $this->gasto_mensal <br /><br />
                                                                        <b>Fatura anexada:</b> <a href='$this->anexo'>Acesse o anexo</a> <br /><br />
                                                                        <b>Telefone:</b> $this->telefone <br /><br />
                                                                        <b>Mensagem:</b> $this->mensagem
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class='img-flex'><img src='https://webdezan.com.br/images/rodape.png' style='vertical-align:top;' width='600' height='95'/></td>
                                                    </tr>
                                                    <tr><td height='28'></td></tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style='line-height:0;'><div style='display:none; white-space:nowrap; font:15px/1px courier;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div></td>
                            </tr>
                        </table>
                    </body>
                </html>
            ";

            if ($mail->Send()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            print 0;
        }
    }

    /* =============== GETTERS E SETTERS =============== */

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

    function getAnexo()
    {
        return $this->anexo;
    }

    function getTelefone()
    {
        return $this->telefone;
    }

    function getMensagem()
    {
        return $this->mensagem;
    }

    function getHost()
    {
        return $this->host;
    }

    function getPort()
    {
        return $this->port;
    }

    function getUsername()
    {
        return $this->username;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getEmail_envio()
    {
        return $this->email_envio;
    }

    function getNome_empresa()
    {
        return $this->nome_empresa;
    }

    function getRetorno_dados()
    {
        return $this->retorno_dados;
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

    function setAnexo($anexo)
    {
        $this->anexo = $anexo;
    }

    function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    function setHost($host)
    {
        $this->host = $host;
    }

    function setPort($port)
    {
        $this->port = $port;
    }

    function setUsername($username)
    {
        $this->username = $username;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setEmail_envio($email_envio)
    {
        $this->email_envio = $email_envio;
    }

    function setNome_empresa($nome_empresa)
    {
        $this->nome_empresa = $nome_empresa;
    }

    function setRetorno_dados($retorno_dados)
    {
        $this->retorno_dados = $retorno_dados;
    }

    public function IsValidEmail($email)
    {
        //verifica se e-mail esta no formato correto de escrita
        if (!preg_match('^([a-zA-Z0-9.-])*([@])([a-z0-9]).([a-z]{2,3})', $email)) {
            return false;
        } else {
            //Valida o dominio
            $dominio = explode('@', $email);
            if (!checkdnsrr($dominio[1], 'A')) {
                return false;
            } else {
                return true;
            } // Retorno true para indicar que o e-mail
            // é valido
        }
    }
}
