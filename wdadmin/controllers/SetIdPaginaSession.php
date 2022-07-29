<?php

setcookie('id_conteudo_personalizado', $_POST['id'], time() + 86400, '/');
setcookie('titulo_conteudo_personalizado', $_POST['titulo'], time() + 86400, '/');
setcookie('largura_conteudo_personalizado', $_POST['largura'], time() + 86400, '/');
setcookie('altura_conteudo_personalizado', $_POST['altura'], time() + 86400, '/');
