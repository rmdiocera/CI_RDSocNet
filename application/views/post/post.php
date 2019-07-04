<div class="container mt-3" id="post">

<?php
    $timeAgo = new Westsworld\TimeAgo();
?>

    <div class="my-3">
        <h2><?= $post['posted_by'] ?></h2>
        <span class="post_date text-center px-2 py-1">Posted on <?= $timeAgo->inWordsFromStrings($post['created_at']) ?></span>
        <p class="my-2" name="post-te"><?= $post['body'] ?></p><br>
        <?php if($post['post_image'] != 'noimage.jpg'): ?>
        <div class="col-6 offset-3">
            <img class="post-image" src="<?= site_url(); ?>/assets/images/posts/<?= $post['post_image'] ?>">
        </div>
        <?php endif ?>
        <div class="my-5">
            <?php if ($this->session->userdata('user_id') == $post['user_id']) : ?>
                <a class="btn btn-primary text-white float-left mr-2" id="btnEdit" data-toggle="modal" data-target="#editModal" data="<?= $post['id'] ?>">Edit Post</a>
                <?= form_open('nf_post/delete/' . $post['id']) ?>
                <input type="submit" value="Delete" class="btn btn-danger float-left">
                <?= form_close() ?>
            <?php endif; ?>
        </div>
    </div>

</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="modalForm" action="" method="post" class="form-horizontal">
                    <input type="hidden" name="post-id" value="0">
                    <textarea class="form-control" name="edit-body" rows="3"></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {

        $(document).on('click', '#btnSave', function() {
            var url = $('#modalForm').attr('action');
            var data = $('#modalForm').serialize();
            //validate form
            var editBody = $('textarea[name=edit-body]');
            console.log({
                url,
                data,
                editBody
            });
            var hasText = true;

            if (editBody.val() === '') {
                hasText = false;
            }

            if (hasText) {
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url,
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#editModal').modal('hide');
                            $('#modalForm')[0].reset();
                            if (response.type == 'update') {
                                window.location.href = window.location.href;
                            }
                        } else {
                            alert('Error');
                        }
                    },
                    error: function() {
                        alert('Could not add data');
                    }
                });
            }
        });


        // Edit post
        $(document).on('click', '#btnEdit', function() {
            var id = $(this).attr('data');
            $('#editModal').modal('show');
            $('#editModal').find('.modal-title').text('Edit Post');
            $('#modalForm').attr('action', '<?= base_url() ?>feed/update');
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: '<?php echo base_url() ?>feed/edit',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('textarea[name=edit-body]').val(data.body);
                    $('input[name=post-id]').val(data.id);
                },
                error: function() {
                    alert('Could not Edit Data');
                }
            });
        });
    });
</script>