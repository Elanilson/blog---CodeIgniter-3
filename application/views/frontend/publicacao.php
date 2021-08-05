<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?= $titulo?>
                    <small> > <?=  $subtitulo ?></small>
                </h1>

                <!-- First Blog Post -->
                <?php  foreach ($postagens as $destaque) { ?>
                  
                <h2>
                    <?=  $destaque->titulo ?>   
                </h2>
                <p class="lead">
                    por <a href="<?= base_url('autor/'.$destaque->idautor.'/'.limpar($destaque->nome)) ?>"><?= $destaque->nome ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?= postadoem($destaque->data) ?></p>
                <hr>
                <i><p><?=  $destaque->subtitulo ?> </p></i>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p><?=  $destaque->conteudo ?> </p>
            

                <hr>

            <?php } ?>

                

            </div>