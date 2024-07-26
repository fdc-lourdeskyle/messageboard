<div class="con">
        <div class="msg-header">
                <div style="margin-left:10px;">
                    <h4>NEW MESSAGE</h4>
                </div>
                <div class="msg-receiver-input">
                    <?php echo $this->Form->create('Conversation', array('url' => array('action' => 'add'), 'id' => 'ConversationAddForm')); ?>
                    <?php echo $this->Form->input('receiver_id', array('id'=>'receiver_id', 'label'=>false, 'type' => 'select', 'class' => "form-input")); ?>
                </div>
        </div>
        <div class="msg-table">
            <div class="msg">
                <label for="message" class="form__label" style="font-size:18px;">Message:</label>
                <?php echo $this->Form->input('Message.message', array('label' => false, 'type' => 'textarea', 'class' => 'msg-edit-input')); ?>
            </div>
            <div>
                <?php echo $this->Form->submit('Submit', array('class'=>"form-button")); ?>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#receiver_id').select2({
            placeholder: 'Select a receiver',
            minimumInputLength: 1,
            ajax: {
                url: '<?php echo $this->Html->url(array("controller" => "users", "action" => "search")); ?>',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term 
                    }
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            templateResult: function (data) {
                return data.text;
            },
            templateSelection: function (data) {
                $('#receiver_id').val(data.id);
                return data.text;
            }
            })
    });

    $(document).ready(function() {
         $('#ConversationAddForm').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                if (response.response) {
                    response = response.response;
                }
                if (response.status === 'success') {
                    alert(response.message);
                    window.location.href = '/conversations/index';
                } else {
                    alert(response.message);
                }
            },
                error: function(xhr, status, error) {
                console.error('Status:', status);
                console.error('Error:', error);
                console.error('Response:', xhr.responseText);
                alert('An error occurred while sending the conversation.');
            }
            });
        });
    });

</script>