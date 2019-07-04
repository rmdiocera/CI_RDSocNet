<?= validation_errors(); ?>
<?= form_open('users/login'); ?>
<div class="row">
    <div class="col-md-4 offset-md-4 mt-5">
        <h2><?= $title; ?></h2>
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </div>
</div>
<?= form_close(); ?>