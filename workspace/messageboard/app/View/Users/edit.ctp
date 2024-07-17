<html>
    <head>
        <!-- jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- jQuery UI library -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
            $('#birthdate').datepicker({
                dateFormat: 'yy-mm-dd',
                showOn: "button",
                buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
                buttonImageOnly: true,
                buttonText: "Select date"
            });

            $('#photo').on('change', function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var img = document.getElementById('photoPreview');
                    img.src = reader.result;
                    img.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            });
        });
        </script>
    </head>

    <h1>Update Information</h1>

    <?php 
        echo $this->Form->create('User', array('type' => 'file'));
        echo $this->Form->input('name');
        echo $this->Form->input('birthdate', array('id' => 'birthdate',  'type' => 'text'));
        echo $this->Form->input('gender');
        echo $this->Form->input('hobby');
    ?>
    <div>
    <img id="photoPreview" 
             src="<?php echo !empty($user['User']['photo']) ? $this->Html->url('/img/' . $user['User']['photo']) : '#'; ?>" 
             alt="Your image" 
             style="<?php echo !empty($user['User']['photo']) ? '' : 'display:none;'; ?> max-width: 300px; max-height: 300px;"/>
    </div>
   
    <?php
        echo $this->Form->input('photo', array('type' => 'file', 'id' => 'photo'));
        echo $this->Form->input('id', array('type' => 'hidden'));
        echo $this->Form->end('Update');

    ?>

<script type="text/javascript">
        $(document).ready(function(){
            $('#birthdate').datepicker({
                dateFormat: 'yy-mm-dd'
            });

            $('#photo').on('change', function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var img = document.getElementById('photoPreview');
                    img.src = reader.result;
                    img.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            });
        });
        </script>
</html>