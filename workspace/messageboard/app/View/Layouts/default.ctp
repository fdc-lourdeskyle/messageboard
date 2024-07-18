<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */


?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->css('style.css');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	  <!-- jQuery library -->
	  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- jQuery UI library -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
	<div id="header">
		<h1>Message Board</h1>
		<div id="navbar">
			<?php if ($this->Session->read('Auth.User')): ?>
				<span class="user-name">
                	<?php echo ($this->Session->read('Auth.User.name')); ?>
				</span>
				<?php echo $this->Html->link('LOGOUT', array('controller' => 'users', 'action' => 'logout'), array('class' => 'nav-button')); ?>
			<?php else: ?>
				<?php echo $this->Html->link('LOGIN', array('controller' => 'users', 'action' => 'login'), array('class' => 'nav-button')); ?>
				<?php echo $this->Html->link('REGISTER', array('controller' => 'users', 'action' => 'register'), array('class' => 'nav-button')); ?>
			<?php endif; ?>
    </div>
	</div>
	<div id="container">
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?> 
		</div>
	</div>

</body>
</html>
