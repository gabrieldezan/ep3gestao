<?php

//IMPORTA CLASSES
require_once "../class/class.phpmailer.php";
require_once "../class/UsuarioCliente.class.php";
require_once "../class/BlogPostagens.class.php";
require_once "../class/InformacoesGerais.class.php";

//INSTANCIA CLASSES
$UsuarioCliente = new UsuarioCliente();
$BlogPostagens = new BlogPostagens();
$InformacoesGerais = new InformacoesGerais();

//BUSCA DADOS DO POST
$BlogPostagens->setId_blog_postagem($_POST['IdRegistro']);
$BlogPostagens->edita_dados();
$DadosPost = json_decode($BlogPostagens->getRetorno_dados(), true);

//BUSCA DADOS INFORMACOES GERAIS
$InformacoesGerais->edita_dados();
$DadosInfoGerais = json_decode($InformacoesGerais->getRetorno_dados(), true);

//VERIFICA SE TEM USUARIO CLIENTE PARA RECEBER A NEWSLETTER
if ($UsuarioCliente->consulta_emails_newsletter()) {

    try {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "UTF-8";
        $mail->Encoding = 'base64';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = $DadosInfoGerais[0]["envio_host"];
        $mail->Port = 465;
        $mail->Username = $DadosInfoGerais[0]["envio_email"];
        $mail->Password = $DadosInfoGerais[0]["envio_senha"];
        $mail->From = $DadosInfoGerais[0]["envio_email"];
        $mail->FromName = '=?utf-8?B?' . base64_encode($DadosInfoGerais[0]["titulo"]) . '?=';
        $DadosUsuarioCliente = $UsuarioCliente->getRetorno_dados();
        for ($i = 0; $i < count($DadosUsuarioCliente); $i++) {
            $mail->AddBCC($DadosUsuarioCliente[$i]['email'], $DadosUsuarioCliente[$i]['nome']);
        }
        $mail->IsHTML(true);
        $mail->Subject = '=?utf-8?B?' . base64_encode($DadosPost[0]["titulo"]) . '?=';
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
                                                        <td class='img-flex'><center><img src='" . URL_SITE . "wdadmin/uploads/informacoes_gerais/" . $DadosInfoGerais[0]["logo_principal"] . "' style='vertical-align:top;padding-bottom: 10px;width:auto;height:90px!important;' /></center></td>
                                                    </tr>
                                                    <tr>
                                                        <td class='img-flex'><img src='" . URL_SITE . "wdadmin/uploads/blog_postagens/" . $DadosPost[0]["imagem"] . "' style='vertical-align:top;' width='600' height='auto'/></td>
                                                    </tr>
                                                    <tr>
                                                        <td data-bgcolor='bg-block' class='holder' style='padding:58px 50px 52px;' bgcolor='#f9f9f9'>
                                                            <table width='100%' cellpadding='0' cellspacing='0'>
                                                            <tr>
                                                                <td data-color='title' data-size='size title' data-min='25' data-max='45' data-link-color='link title color' data-link-style='text-decoration:none; color:#292c34;' class='title' align='center' style='font:28px/31px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 24px;'>
                                                                    " . $DadosPost[0]["titulo"] . "
                                                                </td>
                                                            </tr>
                                                                <tr>
                                                                    <td id='corpo_mensagem' data-color='text' data-size='size text' data-min='10' data-max='26' data-link-color='link text color' data-link-style='font-weight:light; text-decoration:underline; color:#40aceb;' style='font:lighter 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;'>
                                                                        " . substr(strip_tags(trim($DadosPost[0]["texto"])), 0, strrpos(substr(strip_tags(trim($DadosPost[0]["texto"])), 0, 500), ' ')) . '...' . " <br /><br /><br />
                                                                        <center><a href='" . URL_SITE . "post/" . $DadosPost[0]["url_amigavel"] . "' style='text-decoration: none;background-color: #000;padding: 10px;border-radius: 5px;color: #f9f9f9;'>Ver a matéria completa no site</a></center>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class='img-flex'>
                                                            <center><a href='https://webdezan.com.br'><img src='https://webdezan.com.br/images/logo-wd-preta.png' style='vertical-align:top;padding-top: 10px;'/></a></center></td>
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
            print 1;
        } else {
            print 0;
        }
    } catch (PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
        print 0;
    }
} else {
    print 2;
}