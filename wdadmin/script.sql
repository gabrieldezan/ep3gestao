use base;

--
-- Despejando dados para a tabela `acessos`
--

INSERT INTO `acessos` (`id_acessos`, `funcao`, `status`) VALUES
(1, 'menu_banners_slideshow', 1),
(2, 'menu_central_servicos', 1),
(3, 'menu_relacao_cliente', 1),
(4, 'menu_galeria', 1),
(5, 'menu_vitrine', 1),
(6, 'menu_eventos', 1),
(7, 'menu_blog', 1);

--
-- Despejando dados para a tabela `informacoes_gerais`
--

INSERT INTO `informacoes_gerais` (`nome_empresa`, `titulo`, `descricao`, `whatsapp`, `celular1`, `celular2`, `email`, `email_contato`, `envio_host`, `envio_porta`, `envio_email`, `envio_senha`, `google_search_console`, `google_analytics`, `facebook_pixel`, `favicon`, `logo_principal`, `logo_secundaria`, `politicas_privacidade`) VALUES
('Nome da Empresa', 'Titulo do Site', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'logo-nome-da-empresa-201911061509.jpg', '', '<p><strong>Atualiza&ccedil;&atilde;o 11/01/2021</strong></p>\r\n<p>A <em><strong>Web Dezan</strong></em>&nbsp;tem como objetivo receber dados pessoais para contato com poss&iacute;veis clientes.&nbsp;A&nbsp;<em><strong>Web Dezan</strong></em>&nbsp;coleta, utiliza, mas n&atilde;o compartilha sua informa&ccedil;&atilde;o.</p>\r\n<p>Se tiver quaisquer d&uacute;vidas ou coment&aacute;rios relacionados a esta Pol&iacute;tica de Privacidade, fale conosco pelo endere&ccedil;o&nbsp;<em><strong>contato@webdezan.com.br</strong></em>.</p>\r\n<ol>\r\n<li><strong>Coleta de dados</strong></li>\r\n</ol>\r\n<p>Podemos coletar dados atrav&eacute;s do fornecimento volunt&aacute;rio de suas informa&ccedil;&otilde;es no formul&aacute;rio do site, ou ainda, podemos guardar os dados b&aacute;sicos da sua navega&ccedil;&atilde;o e intera&ccedil;&atilde;o com o site e ferramentas.</p>\r\n<p>Solicitamos informa&ccedil;&otilde;es b&aacute;sicas de contato no formul&aacute;rio no site, sendo necess&aacute;rio deixar uma mensagem para a empresa especificando sua necessidade, assim poderemos direcionar seu atendimento para o departamento respons&aacute;vel.</p>\r\n<p><strong>Registro de atividades</strong></p>\r\n<p>A sua navega&ccedil;&atilde;o e intera&ccedil;&atilde;o tamb&eacute;m podem ser registrados, atrav&eacute;s de diversas tecnologias aplic&aacute;veis, para que seja poss&iacute;vel oferecer o melhor conte&uacute;do, orientar estat&iacute;sticas para melhoria e cria&ccedil;&atilde;o de novos produtos, assim como atender a necessidades legais e administrativas em caso de fraude ou ordem judicial.</p>\r\n<ol start=\"2\">\r\n<li><strong>Armazenamento e Transfer&ecirc;ncia de Dados</strong></li>\r\n</ol>\r\n<p><strong>Acesso aos dados</strong></p>\r\n<p>A Web Dezan n&atilde;o divulga ou compartilha dados pessoais privados do seu registro. Seus dados de acesso (inclusive e-mail), endere&ccedil;o etc., n&atilde;o ser&atilde;o fornecidos a terceiros.</p>\r\n<p>Em virtude de ordens judiciais ou de disposi&ccedil;&otilde;es legais e administrativas,&nbsp;a&nbsp;Web Dezan&nbsp;pode ser compelido a revelar informa&ccedil;&atilde;o &agrave;s autoridades ou terceiras partes.</p>\r\n<p><strong>Armazenamento</strong><br />Todos os dados coletados ser&atilde;o armazenados no banco de dados da&nbsp;Web Dezan em ambiente seguro, observadas as tecnologias dispon&iacute;veis.</p>\r\n<ol start=\"3\">\r\n<li><strong>Uso e divulga&ccedil;&atilde;o de Informa&ccedil;&otilde;es</strong></li>\r\n</ol>\r\n<p>A&nbsp;Web Dezan&nbsp;Associados utiliza internamente os dados coletados.</p>\r\n<p><strong>Uso interno</strong></p>\r\n<p>Dados e informa&ccedil;&otilde;es coletados dos usu&aacute;rios s&atilde;o utilizados internamente para:</p>\r\n<ul>\r\n<li>Identificar o assunto;</li>\r\n<li>Encaminhar para o departamento respons&aacute;vel;</li>\r\n<li>Cumprir ordem legal ou judicial.</li>\r\n</ul>\r\n<p>Apenas&nbsp;a&nbsp;Web Dezan&nbsp;ter&aacute; acesso aos dados pessoais dos seus poss&iacute;veis clientes: nome, endere&ccedil;o e telefone.</p>\r\n<ol start=\"4\">\r\n<li><strong>Altera&ccedil;&otilde;es a esta pol&iacute;tica</strong></li>\r\n</ol>\r\n<p>A&nbsp;Web Dezan poder&aacute; revisar esta Pol&iacute;tica de Privacidade periodicamente. N&atilde;o nos responsabilizamos por envio de notifica&ccedil;&atilde;o de altera&ccedil;&otilde;es em nossa Pol&iacute;tica de Privacidade, sendo de responsabilidade do usu&aacute;rio aceitar os termos sempre que cadastrar um novo pedido em nosso formul&aacute;rio.</p>\r\n<p>&nbsp;</p>');

--
-- Despejando dados para a tabela `missao_visao_valores`
--

INSERT INTO `missao_visao_valores` (`icone_missao`, `imagem_missao`, `texto_missao`, `icone_visao`, `imagem_visao`, `texto_visao`, `icone_valores`, `imagem_valores`, `texto_valores`) VALUES
('', '', '', '', '', '', '', '', '');

--
-- Despejando dados para a tabela `sobre`
--

INSERT INTO `sobre` (`resumo_texto`, `texto`, `imagem`, `link`) VALUES
('', '', '', '');

--
-- Despejando dados para a tabela `tamanho_imagens`
--

INSERT INTO `tamanho_imagens` (`id_tamanho_imagens`, `tabela`, `campo`, `largura`, `altura`) VALUES
(1, 'banner', '#inputImagem', '1080', '1080'),
(2, 'sobre', '#inputImagem', '500', '500'),
(3, 'missao_visao_valores', '#inputImagemMissao, #inputImagemVisao, #inputImagemValores', '100', '100'),
(4, 'equipe', '#inputImagem', '120', '60'),
(5, 'redes_sociais', '#inputImagem', '50', '50'),
(6, 'servicos', '#inputImagem', '500', '500'),
(7, 'clientes', '#inputImagem', '200', '200'),
(8, 'cases', '#inputImagem', '200', '200'),
(9, 'depoimentos', '#inputImagem', '100', '100'),
(10, 'galeria_imagem', '#inputImagem1, #inputImagem2, #inputImagem3, #inputImagem4, #inputImagem5', '500', '400'),
(11, 'vitrine_subgrupo', '#inputImagemCapa', '500', '500'),
(12, 'vitrine_produto', '#inputImagem, #inputImagem1, #inputImagem2, #inputImagem3, #inputImagem4, #inputImagem5', '500', '500'),
(13, 'eventos', '#inputImagem', '500', '500'),
(14, 'blog_postagem', '#inputImagem, #inputImagemGaleria', '800', '400'),
(15, 'informacoes_gerais', '#inputLogoPrincipal', '200', '100'),
(16, 'solucoes', '#inputImagemSolucoes', '500', '500'),
(17, 'titulos_personalizados', '#inputImagem', '32', '32');

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `nome`, `login`, `senha`, `imagem_perfil`, `status`) VALUES
(1, 'Web Dezan', 'webdezan', '7bb6fe52d89f19e81c0178ac2572c9ba', 'perfil-web-dezan.jpg', 1);