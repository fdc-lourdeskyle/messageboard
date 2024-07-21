<div class="convo-container">
    <div class="convo-header">
        <div>
            <!-- Add any additional header content here if needed -->
        </div>
        <div class="reply-form">
            <?php echo $this->Form->create('Message', array('url' => array('controller' => 'conversations', 'action' => 'reply', $conversation['Conversation']['id']))); ?>
            <div class="msg">
                <?php echo $this->Form->input('message', array('label' => false, 'placeholder' => 'Type your message here...', 'type' => 'textarea', 'class' => "msg-input")); ?>
            </div>
            <?php echo $this->Form->submit('Send', array('class' => "form-button")); ?>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
    <div class="convo-list" id="message-list">
        <!-- Include the messages partial view here -->
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

                // Check if there are more messages to load
                var hasMoreMessages = $(response).find('#has-more-messages').val() === 'true';

                if (!hasMoreMessages) {
                    button.hide(); // Hide button if no more messages
                } else {
                    button.data('page', page + 1); // Update page number for next request
                }
            },
            error: function() {
                alert('An error occurred while loading more messages.');
            }
        });
    });
});
</script>
