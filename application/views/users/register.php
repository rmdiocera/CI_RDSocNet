<div class="container mt-3">
    <?= validation_errors(); ?>
    <?= form_open('users/register'); ?>
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-2">
            <h2 class="text-center"><?= $title ?></h2>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="" placeholder="Email">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" id="" placeholder="Username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="" placeholder="Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="confirm_pass" id="" placeholder="Confirm Password">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
    </div>
    <?= form_close(); ?>
</div>