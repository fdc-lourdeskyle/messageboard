<div class="convo-container">
    <div class="convo-header">
        <div>
        </div>
        <div class="reply-form">
            <?php echo $this->Form->create('Message', array('url' => array('controller' => 'conversations', 'action' => 'reply', $conversation['Conversation']['id']))); ?>
            <div class="msg">
                <?php echo $this->Form->input('message', array('label' => false, 'placeholder' => 'Type your message here...', 'type' => 'textarea', 'class' => "msg-input")); ?>
            </div>
            <div class="message-btns-container">
                <?php echo $this->Form->submit('Send', array('class' => "form-button")); ?>
                <?php echo $this->Form->end(); ?>
                <div class="form-actions" style="margin-left: 10px;">
                    <?php echo $this->Form->button('Back', array('type' => 'button', 'onclick' => "location.href='" . $this->Html->url(array('controller' => 'conversations', 'action' => 'index')) . "'", 'class' => 'form-button')); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="convo-list" id="message-list">
        <?php echo $this->element('Messages', array('messages' => $messages, 'hasMoreMessages' => $hasMoreMessages)); ?>
    </div>
    <?php if ($hasMoreMessages): ?>
        <button id="show-more" data-conversation-id="<?php echo h($id); ?>" data-page="2">Show More</button>
    <?php endif; ?>
</div>

<script>
$(document).ready(function() {
    $('#show-more').on('click', function() {
        var button = $(this);
        var conversationId = button.data('conversation-id');
        var page = button.data('page');

        $.ajax({
            url: '/conversations/view/' + conversationId,
            data: { page: page },
            dataType: 'html',
            success: function(response) {

                var newMessages = $(response).find('#message-list').html();
                
                $('#message-list').append(newMessages);

                var hasMoreMessages = $(response).find('#has-more-messages').val() === 'true';

                if (!hasMoreMessages) {
                    button.hide(); 
                } else {
                    button.data('page', page + 1); 
                }
            },
            error: function() {
                alert('An error occurred while loading more messages.');
            }
        });
    });
});

$(document).ready(function() {
        $(document).on('click', '.delete-message', function(e) {
        e.preventDefault();
        var $this = $(this);
        var messageId = $this.data('id');
        var messageElement = $('#message-' + messageId);
        console.log(messageElement);

        $.ajax({
            url: '/conversations/deleteMsg/' + messageId,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    messageElement.fadeOut(500, function() {
                        $(this).remove();
                    });
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
                console.log('Status:', status);
                console.dir(xhr);
                alert('Error deleting conversation');
            }
            });
        });
    });
</script>
