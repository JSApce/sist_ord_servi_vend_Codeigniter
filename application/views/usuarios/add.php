<?php $this->load->view('layout/sidebar'); ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('usuarios') ?>">Usuários cadastrados</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
            </ol>
        </nav>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a title="Voltar" href="<?php echo base_url('usuarios') ?>" class="btn btn-sm btn-success float-right"><i class="fas fa-arrow-left"></i>&nbsp;Voltar</a>
            </div>
            <div class="card-body">
                <form class="user"  method="POST" name="form_add">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label >Nome</label>
                            <input type="text" class="form-control form-control-user" name="first_name" value="<?php echo set_value('first_name') ?>">
                            <?php echo form_error('first_name', '<small class="form-text text-danger">', '</small>') ?>

                        </div>
                        <div class="col-md-4">
                            <label >Sobrenome</label>
                            <input type="text" class="form-control form-control-user" name="last_name" value="<?php echo set_value('last_name') ?>">
                            <?php echo form_error('last_name', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                        <div class="col-md-4">
                            <label >E-mail</label>
                            <input type="email" class="form-control form-control-user" name="email" value="<?php echo set_value('email') ?>">
                            <?php echo form_error('email', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label >Usuário</label>
                            <input type="text" class="form-control form-control-user" name="username" value="<?php echo set_value('username') ?>">
                            <?php echo form_error('username', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                        <div class="col-md-4">
                            <label >Ativo</label>
                            <select class="form-control custom-select" name="active">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label >Perfil de acesso</label>
                            <select class="form-control custom-select" name="perfil_usuario">
                                <option value="2">Vendedor</option>
                                <option value="1">Administrador</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Senha</label>
                            <input type="password" class="form-control form-control-user" name="password">
                            <?php echo form_error('password', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                        <div class="col-md-6">
                            <label>Confirme Senha</label>
                            <input type="password" class="form-control form-control-user" name="confirm_password">
                            <?php echo form_error('confirm_password', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

