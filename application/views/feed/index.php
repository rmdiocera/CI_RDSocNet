<div class="container">
    <header class="feed-header mt-3">
        <h2>Latest Posts</h2>
    </header>
</div>

<?php foreach ($feed as $post) : ?>
    <div class="container mt-3">
        <h2><?= $post['title'] ?></h2>
        <span class="post_date text-center px-2 py-1">Posted on <?= $post['created_at'] ?></span>
        <br><br>
        <p class="my-2"><?= $post['body'] ?></p><br>
        <a class="btn btn-dark" href="<?= site_url('post/'.$post['slug'])?>">Read More</a>
        <!-- replace with /feed/ -->
    </div>
<?php endforeach ?>