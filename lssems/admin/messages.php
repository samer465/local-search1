<?php include 'db_connect.php'; ?>
<style>
    .message-preview {
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .reply-area {
        margin-top: 10px;
        padding: 10px;
        background: #f8f9fa;
        border-left: 3px solid #4f46e5;
    }
</style>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="card-tools">
                <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat border-primary" id="refreshMessages">
                    <i class="fas fa-sync-alt"></i> Refresh
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered" id="messageList">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="15%">
                    <col width="20%">
                    <col width="25%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $messages = $conn->query("SELECT * FROM messages ORDER BY date_created DESC");
                    while($row = $messages->fetch_assoc()):
                        $status_badge = $row['status'] == 0 ? '<span class="badge badge-warning">Unread</span>' : '<span class="badge badge-success">Read</span>';
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td><?php echo htmlspecialchars($row['sender_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['sender_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td class="message-preview"><?php echo htmlspecialchars(strip_tags($row['message'])); ?></td>
                        <td class="text-center"><?php echo $status_badge; ?></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="javascript:void(0)" class="btn btn-info btn-flat view_message" data-id="<?php echo $row['id']; ?>">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-primary btn-flat reply_message" data-id="<?php echo $row['id']; ?>" data-email="<?php echo $row['sender_email']; ?>" data-name="<?php echo htmlspecialchars($row['sender_name']); ?>" data-subject="<?php echo htmlspecialchars($row['subject']); ?>" data-message="<?php echo htmlspecialchars($row['message']); ?>" data-reply="<?php echo htmlspecialchars($row['reply']); ?>">
                                    <i class="fas fa-reply"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-flat delete_message" data-id="<?php echo $row['id']; ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: View Message -->
<div class="modal fade" id="viewMessageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Message Details</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="viewMessageContent">
                <!-- dynamic content -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Reply Message -->
<div class="modal fade" id="replyMessageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Reply to Message</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="replyAlert"></div>
                <div class="form-group">
                    <label>From (Admin):</label>
                    <input type="text" class="form-control" value="<?php echo $_SESSION['system']['email']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>To:</label>
                    <input type="text" class="form-control" id="replyToEmail" readonly>
                </div>
                <div class="form-group">
                    <label>Subject:</label>
                    <input type="text" class="form-control" id="replySubject" readonly>
                </div>
                <div class="form-group">
                    <label>Original Message:</label>
                    <div class="reply-area" id="originalMessage"></div>
                </div>
                <div class="form-group">
                    <label>Your Reply:</label>
                    <textarea name="reply" id="replyMessage" rows="5" class="form-control" placeholder="Type your reply here..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="sendReply">Send Reply</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#messageList').DataTable({
        "order": [[0, "desc"]],
        "columnDefs": [{ "orderable": false, "targets": [5,6] }]
    });

    // View Message
    $('.view_message').click(function(){
        var id = $(this).data('id');
        $.ajax({
            url: 'ajax.php?action=get_message',
            method: 'POST',
            data: {id: id},
            dataType: 'json',
            success: function(resp){
                if(resp){
                    var content = `
                        <div class="mb-3">
                            <strong>From:</strong> ${resp.sender_name} (${resp.sender_email})
                        </div>
                        <div class="mb-3">
                            <strong>Subject:</strong> ${resp.subject}
                        </div>
                        <div class="mb-3">
                            <strong>Message:</strong><br>
                            ${resp.message}
                        </div>
                        ${resp.reply ? `<div class="mb-3"><strong>Your Reply:</strong><br>${resp.reply}</div>` : ''}
                        <div class="text-muted small">Received: ${resp.date_created}</div>
                    `;
                    $('#viewMessageContent').html(content);
                    $('#viewMessageModal').modal('show');
                }
            }
        });
    });

    // Reply Message
    $('.reply_message').click(function(){
        var id = $(this).data('id');
        var email = $(this).data('email');
        var name = $(this).data('name');
        var subject = $(this).data('subject');
        var message = $(this).data('message');
        var reply = $(this).data('reply') || '';

        $('#replyToEmail').val(email);
        $('#replySubject').val('Re: ' + subject);
        $('#originalMessage').html('<strong>' + name + ' wrote:</strong><br>' + message);
        $('#replyMessage').val(reply);
        $('#sendReply').data('id', id);
        $('#replyMessageModal').modal('show');
    });

    // Send Reply
    $('#sendReply').click(function(){
        var id = $(this).data('id');
        var reply = $('#replyMessage').val().trim();
        if(reply == ''){
            $('#replyAlert').html('<div class="alert alert-danger">Please enter a reply message.</div>');
            return;
        }
        $('#replyAlert').html('');
        start_load();
        $.ajax({
            url: 'ajax.php?action=reply_message',
            method: 'POST',
            data: {id: id, reply: reply},
            success: function(resp){
                if(resp == 1){
                    alert_toast('Reply sent successfully', 'success');
                    $('#replyMessageModal').modal('hide');
                    setTimeout(function(){ location.reload(); }, 1000);
                } else {
                    alert_toast('Error sending reply', 'error');
                }
                end_load();
            },
            error: function(){
                alert_toast('Connection error', 'error');
                end_load();
            }
        });
    });

    // Delete Message
    $('.delete_message').click(function(){
        var id = $(this).data('id');
        _conf("Are you sure you want to delete this message?", "delete_message", [id]);
    });

    // Refresh button
    $('#refreshMessages').click(function(){
        location.reload();
    });
});

function delete_message(id){
    start_load();
    $.ajax({
        url: 'ajax.php?action=delete_message',
        method: 'POST',
        data: {id: id},
        success: function(resp){
            if(resp == 1){
                alert_toast("Message deleted successfully", 'success');
                setTimeout(function(){ location.reload(); }, 1000);
            } else {
                alert_toast("Error deleting message", 'error');
            }
            end_load();
        }
    });
}
</script>