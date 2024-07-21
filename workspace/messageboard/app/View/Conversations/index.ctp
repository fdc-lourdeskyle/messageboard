<div class="convo-container">
    <div class="convo-header">
        <div class="msg-header">
            <h4>Your Messages</h4>
        </div>
        <div>
            <?php echo $this->Html->link('New Message', array('controller' => 'conversations', 'action' => 'add'), array('class' => 'new-message-button')); ?>
        </div>
    </div>
    <div class="convo-list" id="messages-container">
        <!-- Include the conversations partial view here -->
        <?php echo $this->element('conversations_list', array('conversations' => $conversations)); ?>
    </div>
    <?php if ($hasMoreConversations): ?>
        <button id="show-more-conversations" data-page="2">Show More</button>
    <?php endif; ?>
</div>


<script>
$(document).ready(function() {
    $('#show-more-conversations').on('click', function() {
        var button = $(this);
        var page = button.data('page');

        $.ajax({
            url: '/conversations/index',
            data: { page: page },
            dataType: 'html',
            success: function(response) {
                // Log the entire response for debugging
                console.log(response);

                // Extract the new conversations from the response
                var newConversations = $(response).find('.convo-list').html();
                console.log("New Conversations: ", newConversations);

                // Append the new conversations to the container
                // Insert new conversations at the top of the container
                $('#messages-container').prepend(newConversations);

                // Check if there are more conversations to load
                var hasMoreConversations = $(response).find('#has-more-conversations').val() === 'true';
                if (!hasMoreConversations) {
                    button.hide(); // Hide button if no more conversations
                } else {
                    button.data('page', page + 1); // Update page number for next request
                }
            },
            error: function() {
                alert('An error occurred while loading more conversations.');
            }
        });
    });
});

</script>

