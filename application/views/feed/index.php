<div class="container">
    <header class="feed-header mt-3">
        <h2>Latest Posts</h2>
    </header>
</div>

<div class="container mt-3 mb-5">
    <?= validation_errors(); ?>
    <?= form_open('feed/index'); ?>
    <div class="form-group">
        <div class="form-group">
            <label>Post your message here!</label>
            <textarea class="form-control" name="post-text" rows="3" placeholder="Share what's happening"></textarea>
        </div>
        <button type="submit" class="btn btn-dark float-right">Post</button>
    </div>
    </form>
</div>

<!-- </?php foreach ($feed as $post) : ?> -->
    <div class="container mt-3" id="nf-post">
        
    </div>
<!-- </?php endforeach ?>  -->


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
        showFeed();

        $(document).on('click', '#btnSave', function() {
            var url = $('#modalForm').attr('action');
			var data = $('#modalForm').serialize();
			//validate form
			var editBody = $('textarea[name=edit-body]');
			console.log({url, data, editBody});
            var hasText = true;

            if(editBody.val() === ''){
                hasText = false;
			}

			if(hasText){
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: url,
					data: data,
					async: false,
					dataType: 'json',
					success: function(response){
						if(response.success){
							$('#editModal').modal('hide');
							$('#modalForm')[0].reset();
							if (response.type=='add') {
								// var type = 'added'
                                alert('Added');
							} else if (response.type=='update'){
								alert('Updated');
                                showFeed();
							}
							// $('.alert-success').html('Employee '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
						} else {
							alert('Error');
						}
					},
					error: function(){
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


        function showFeed() {
            $.ajax({
                type: 'ajax',
                url: '<?= base_url()?>feed/showfeed',
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<h2>'+ data[i]['title'] + '</h2>' +
                        '<span class="post_date text-center px-2 py-1"> Posted on ' + data[i]['created_at'] + ' </span>' +
                        '<br><br>' +
                        '<p class="my-2">' + data[i]['body'] + '</p><br>' +
                        '<a class="btn btn-dark" href="localhost/ci-socmed/post' + data[i]['slug'] +'">Read More</a>' +
                        '<form action="http://localhost/ci-socmed/feed/delete' + data[i]['id'] + '"method="post" accept-charset="utf-8">' +
                        '<input type="submit" value="Delete" class="btn btn-danger">' +
                        '</form>' +
                        '<a class="btn btn-primary" id="btnEdit" data-toggle="modal" data-target="#editModal" data="' + data[i]['id'] + '">Edit Post</a>'
                    }
                    $('#nf-post').html(html);
                },
                error: function() {
                    alert('Error');
                }
            });
        }
    });
</script>