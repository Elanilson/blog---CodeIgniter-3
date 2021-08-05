<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?= 'Administrar '.$subtitulo?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?= 'Adicionar novo - '.$subtitulo?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                   <?php 
                                echo validation_errors('<div class="alert alert-danger">','</div>');
                                echo form_open('admin/usuarios/inserir');

                                   ?>
                                   <div class="form-group">
                                            <label id="txt-nome">Nome do usuário</label>
                                            <input class="form-control" type="text" placeholder="Digite o nome da nome" id="txt-nome" name="txt-nome" value="<?= set_value('txt-nome') ?>">
                                    </div>
                                    <div class="form-group">
                                            <label id="txt-email">E-mail</label>
                                            <input class="form-control" type="text" placeholder="Digite o email da email" id="txt-email" name="txt-email" <?= set_value('txt-email') ?>>
                                    </div>
                                    <div class="form-group">
                                            <label id="txt-historico">Historico do usuário</label>
                                            <textarea class="form-control" id="txt-historico" name="txt-historico" > 
                                            <?= set_value('txt-historico') ?></textarea>
                                            
                                    </div>
                                    <div class="form-group">
                                            <label id="txt-user">User</label>
                                            <input class="form-control" type="text" placeholder="Digite o user da user" id="txt-user" name="txt-user" <?= set_value('txt-user') ?>>
                                    </div>
                                    <div class="form-group">
                                            <label id="txt-senha">Senha</label>
                                            <input class="form-control" type="password" id="txt-senha" name="txt-senha" >
                                    </div>
                                    <div class="form-group">
                                            <label id="txt-confirm-senha">Confirmar senha</label>
                                            <input class="form-control" type="password"  id="txt-confirm-senha" name="txt-confirm-senha">
                                    </div>
                                    <button type="submit" class="btn btn-default">Cadastrar</button>
                                   <?php

                                   echo form_close();

                                   ?>
                                    
                                </div>
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?= 'Alterar '.$subtitulo.' existente' ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                     <?php
                                    $this->table->set_heading('Foto','Nome do Usuário', 'Alterar','Excluir');
                                    foreach($usuarios as $usuario){
                                        $nomeuser= $usuario->nome;
                                        $fotouser= 'foto';
                                        $alterar= anchor(base_url('admin/usuarios/alterar/'.md5($usuario->id)),'<i class="fa fa-refresh fa-fw"></i>Alterar');
                                        $excluir= anchor(base_url('admin/usuarios/excluir/'.md5($usuario->id)),'<i class="fa fa-remove fa-fw"></i>Excluir');

                                        $this->table->add_row($fotouser,$nomeuser,$alterar,$excluir);
                                    } 
                                    $this->table->set_template(array(
                                        'table_open'=> '<table class="table table-striped">'
                                    ));

                                    echo $this->table->generate();




                                    ?>
                                </div>
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!--


<form role="form">
                                        <div class="form-group">
                                            <label>Titulo</label>
                                            <input class="form-control" placeholder="Entre com o texto">
                                        </div>
                                        <div class="form-group">
                                            <label>Foto Destaque</label>
                                            <input type="file">
                                        </div>
                                        <div class="form-group">
                                            <label>Conteúdo</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>Selects</label>
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-default">Cadastrar</button>
                                        <button type="reset" class="btn btn-default">Limpar</button>
                                    </form>

       -->