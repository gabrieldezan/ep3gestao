<aside class="col-md-4" data-animated-time="10" data-animated-in="animated fadeInUp" data-animated-innerContent="yes">
    <div class="sidebox widget">
        <h3 class="widget-title">Mais Populares</h3>
        <ul class="post-list">
            <?php
            $vsSqlBlog = "
                SELECT
                    titulo,
                    url_amigavel,
                    imagem,
                    DATE_FORMAT(data_publicacao, '%d/%m/%Y') AS data_publicacao_formatada
                FROM
                    blog_postagem
                WHERE
                    data_publicacao < '$data_hora_atual'
                ORDER BY
                    visualizacoes DESC
                LIMIT 5
            ";
            $vrsExecutaBlog = mysqli_query($Conexao, $vsSqlBlog) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
            while ($voResultadoBlog = mysqli_fetch_object($vrsExecutaBlog)) {
            ?>
                <li>
                    <figure class="itemOver">
                        <a href="<?php echo URL . "post/" . $voResultadoBlog->url_amigavel ?>">
                            <img alt="image_alt_text" class="preload alignCenter resize-with-grid" src="<?php echo URL . "wdadmin/uploads/blog_postagens/" . $voResultadoBlog->imagem ?>" data-src="<?php echo URL . "wdadmin/uploads/blog_postagens/" . $voResultadoBlog->imagem ?>" title="<?php echo $voResultadoBlog->titulo ?>" alt="<?php echo $voResultadoBlog->titulo ?>">
                        </a>
                    </figure>
                    <h5><a href="post.php" class="smoothPageLoad normal"><?php echo $voResultadoBlog->titulo ?></a></h5>
                    <ul class="tools">
                        <li class="date"><i class="fas fa-calendar-days"></i><?php echo $voResultadoBlog->data_publicacao_formatada ?></li>
                    </ul>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
</aside>