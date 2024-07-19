
<div class="convo-container">
    <div class="convo-header">
        <h4>Messages</h4>
        <div class="reply-form">
            <?php echo $this->Form->create('Message', array('url' => array('controller'=>'conversations','action' => 'reply', $conversations['Conversation']['id'])));?>
            <div class="msg">
                <?php echo $this->Form->input('message', array('label'=>'Message', 'placeholder' => 'Type your message here...', 'type' => 'textarea', 'class' => "form-input")); ?>
            </div>
            <?php echo $this->Form->submit('Send', array('class'=>"form-button")); ?>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
    <div class="convo-list" id="messages-container"> 
        <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $message): ?>
                <div class="convo">
                    <div class="convo-content">
                        <div class="msg-mg">
                            <?php 
                                $userPhoto = $message['Sender']['photo'];
                                $userPhotoUrl = !empty($userPhoto)? $this->Html->url('/img/'.$userPhoto) : null;
                            ?>
                            <img id="photoPreview" src="<?php echo $userPhotoUrl; ?>" alt="Sender photo" style="<?php echo $userPhotoUrl ? '' : 'display:none;'; ?> max-width: 100px; max-height: 100px;" />
                        </div>
                        <div class="msg-content">
                                <div class="msg">
                                    <?php echo h($message['Message']['message']); ?>
                                </div>
                                <div class="timestamp">
                                    <?php echo h($message['Message']['created_at']); ?>
                                </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <p> No messages found </p>
        <?php endif; ?>
    </div>
    <?php if ($this->Paginator->hasNext()): ?>
        <button id="load-more" data-url="<?php echo $this->Html->url(array('action' => 'loadMore', $conversations['Conversation']['id'])); ?>">Show More</button>
    <?php endif; ?>
</div>

<script>
$(document).ready(function() {
    var page = 1;
    var limit = 3;

    $('#load-more').on('click', function() {
        page++;
        var url = $(this).data('url') + '?page=' + page + '&limit=' + limit;

        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                if (data.trim().length === 0) {
                    $('#load-more').hide(); // Hide button if no more data
                } else {
                    $('#messages-container').append(data); // Append new messages
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error details:', textStatus, errorThrown);
                alert('An error occurred while loading more messages.');
            }
        });
    });
});
</script>