<?php $this->load->view('layout/sidebar'); ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
            </ol>
        </nav>
<<<<<<< HEAD
        <?php if ($this->session->flashdata('success')) : $message = $this->session->flashdata('success') ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="far fa-smile-wink"></i>&nbsp;&nbsp;<?php echo $message ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')) : $message = $this->session->flashdata('error') ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?php echo $message ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
=======
>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
<<<<<<< HEAD
                <form class="user"  method="POST" name="form_edit">
                    <div class="form-group row mb-3">
                        <div class="col-md-3">
                            <label >Razão social</label>
                            <input type="text" class="form-control form-control-user" name="sistema_razao_social" value="<?php echo $sistema->sistema_razao_social ?>">
=======
                <form  method="POST" name="form_edit">
                    <div class="form-group row mb-3">
                        <div class="col-md-3">
                            <label >Razão social</label>
                            <input type="text" class="form-control" name="sistema_razao_social" value="<?php echo $sistema->sistema_razao_social ?>">
>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f
                            <?php echo form_error('sistema_razao_social', '<small class="form-text text-danger">', '</small>') ?>

                        </div>
                        <div class="col-md-3">
                            <label >Nome fantasia</label>
<<<<<<< HEAD
                            <input type="text" class="form-control form-control-user" name="sistema_nome_fantasia" value="<?php echo $sistema->sistema_nome_fantasia ?>">
=======
                            <input type="text" class="form-control" name="sistema_nome_fantasia" value="<?php echo $sistema->sistema_nome_fantasia ?>">
>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f
                            <?php echo form_error('sistema_nome_fantasia', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                        <div class="col-md-3">
                            <label >CNPJ</label>
<<<<<<< HEAD
                            <input type="text" class="form-control form-control-user" name="sistema_cnpj" value="<?php echo $sistema->sistema_cnpj ?>">
=======
                            <input type="text" class="form-control" name="sistema_cnpj" value="<?php echo $sistema->sistema_cnpj ?>">
>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f
                            <?php echo form_error('sistema_cnpj', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                        <div class="col-md-3">
                            <label >Inscrição estadual</label>
<<<<<<< HEAD
                            <input type="text" class="form-control form-control-user" name="sistema_ie" value="<?php echo $sistema->sistema_ie ?>">
=======
                            <input type="text" class="form-control" name="sistema_ie" value="<?php echo $sistema->sistema_ie ?>">
>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f
                            <?php echo form_error('sistema_ie', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-3">
                            <label >Telefone fixo</label>
<<<<<<< HEAD
                            <input type="text" class="form-control form-control-user" name="sistema_telefone_fixo" value="<?php echo $sistema->sistema_telefone_fixo ?>">
=======
                            <input type="text" class="form-control" name="sistema_telefone_fixo" value="<?php echo $sistema->sistema_telefone_fixo ?>">
>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f
                            <?php echo form_error('sistema_telefone_fixo', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                        <div class="col-md-3">
                            <label >Telefone móvel</label>
<<<<<<< HEAD
                            <input type="text" class="form-control form-control-user" name="sistema_telefone_movel" value="<?php echo $sistema->sistema_telefone_movel ?>">
=======
                            <input type="text" class="form-control" name="sistema_telefone_movel" value="<?php echo $sistema->sistema_telefone_movel ?>">
>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f
                            <?php echo form_error('sistema_telefone_movel', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                        <div class="col-md-3">
                            <label >URL</label>
<<<<<<< HEAD
                            <input type="text" class="form-control form-control-user" name="sistema_site_url" value="<?php echo $sistema->sistema_site_url ?>">
=======
                            <input type="text" class="form-control" name="sistema_site_url" value="<?php echo $sistema->sistema_site_url ?>">
>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f
                            <?php echo form_error('sistema_site_url', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                        <div class="col-md-3">
                            <label >E-mail de contato</label>
<<<<<<< HEAD
                            <input type="text" class="form-control form-control-user" name="sistema_email" value="<?php echo $sistema->sistema_email ?>">
=======
                            <input type="text" class="form-control" name="sistema_email" value="<?php echo $sistema->sistema_email ?>">
>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f
                            <?php echo form_error('sistema_email', '<small class="form-text text-danger">', '</small>') ?>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-4">
                            <label >Endereço</label>
<<<<<<< HEAD
                            <input type="text" class="form-control form-control-user" name="sistema_endereco" value="<?php echo $sistema->sistema_endereco ?>">
=======
                            <input type="text" class="form-control" name="sistema_endereco" value="<?php echo $sistema->sistema_endereco ?>">
>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f
                            <?php echo form_error('sistema_endereco', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                        <div class="col-md-2">
                            <label >CEP</label>
<<<<<<< HEAD
                            <input type="text" class="form-control form-control-user" name="sistema_cep" value="<?php echo $sistema->sistema_cep ?>">
=======
                            <input type="text" class="form-control" name="sistema_cep" value="<?php echo $sistema->sistema_cep ?>">
>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f
                            <?php echo form_error('sistema_cep', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                        <div class="col-md-2">
                            <label >Número</label>
<<<<<<< HEAD
                            <input type="text" class="form-control form-control-user" name="sistema_numero" value="<?php echo $sistema->sistema_numero ?>">
=======
                            <input type="text" class="form-control" name="sistema_numero" value="<?php echo $sistema->sistema_numero ?>">
>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f
                            <?php echo form_error('sistema_numero', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                        <div class="col-md-2">
                            <label >Cidade</label>
<<<<<<< HEAD
                            <input type="text" class="form-control form-control-user" name="sistema_cidade" value="<?php echo $sistema->sistema_cidade ?>">
=======
                            <input type="text" class="form-control" name="sistema_cidade" value="<?php echo $sistema->sistema_cidade ?>">
>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f
                            <?php echo form_error('sistema_cidade', '<small class="form-text text-danger">', '</small>') ?>

                        </div>
                        <div class="col-md-2">
                            <label >UF</label>
<<<<<<< HEAD
                            <input type="text" class="form-control form-control-user" name="sistema_estado" value="<?php echo $sistema->sistema_estado ?>">
=======
                            <input type="text" class="form-control" name="sistema_estado" value="<?php echo $sistema->sistema_estado ?>">
>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f
                            <?php echo form_error('sistema_estado', '<small class="form-text text-danger">', '</small>') ?>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-12">
                            <label >Texto da ordem de serviço</label>
<<<<<<< HEAD
                            <textarea class="form-control form-control-user" name="sistema_txt_ordem_servico"><?php echo $sistema->sistema_txt_ordem_servico ?></textarea>
=======
                            <textarea class="form-control" name="sistema_txt_ordem_servico"><?php echo $sistema->sistema_txt_ordem_servico ?></textarea>
>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f
                            <?php echo form_error('sistema_txt_ordem_servico', '<small class="form-text text-danger">', '</small>') ?>
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

