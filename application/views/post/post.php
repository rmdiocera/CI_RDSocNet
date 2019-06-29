<div class="container mt-3">
    <h2><?= $post['title'] ?></h2>
    <span class="post_date text-center px-2 py-1">Posted on <?= $post['created_at'] ?></span>
    <br><br>
    <p class="my-2"><?= $post['body'] ?></p><br>
    <?= form_open('nf_post/delete/'.$post['id'])?>
    <input type="submit" value="Delete" class="btn btn-danger">;
</div>