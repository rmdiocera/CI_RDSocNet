<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/css/style.css">
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>A Social Media Website</title>
</head>

<body>
    <div class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a href="<?= base_url();?>" class="navbar-brand">BookFace</a>
            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarResponsive">
                <?php if(!$this->session->userdata('logged_in')) : ?>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url();?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url();?>pages/about">About</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url();?>login">Login</a></li>    
                    <li class="nav-item"><a class="nav-link" href="<?= base_url();?>register">Create an Account</a></li>
                </ul>
                <?php endif; ?>
                <?php if($this->session->userdata('logged_in')) : ?>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url();?>feed">Latest Posts</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link"><?= $this->session->userdata('username') ?></a></li>    
                    <li class="nav-item"><a class="nav-link" href="<?= base_url();?>logout">Logout</a></li>
                </ul>
                <?php endif; ?>

            </div>
        </div>
    </div>

        <div class="container mt-3">
            <!-- User registration -->
            <?php if($this->session->flashdata('user_registered')): ?>
            <?='<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'?>
            <?php endif ?>

            <!-- User login -->
            <?php if($this->session->flashdata('user_login_failed')): ?>
            <?='<p class="alert alert-danger">'.$this->session->flashdata('user_login_failed').'</p>'?>
            <?php endif ?>
            
            <!-- Post flash data -->
            <?php if($this->session->flashdata('post_success')): ?>
            <?='<p class="alert alert-success">'.$this->session->flashdata('post_success').'</p>'?>
            <?php endif ?>
            <?php if($this->session->flashdata('post_updated')): ?>
            <?='<p class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>'?>
            <?php endif ?>
            <?php if($this->session->flashdata('post_deleted')): ?>
            <?='<p class="alert alert-success">'.$this->session->flashdata('post_deleted').'</p>'?>
            <?php endif ?>

        </div>

