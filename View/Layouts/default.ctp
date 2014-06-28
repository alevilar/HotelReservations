<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */

$cakeDescription = __d('cake_dev', 'Reservation Manager Plugin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array(
			'ReservationManager.bootstrap.min',
			'ReservationManager.bootstrap-theme.min',
			'ReservationManager.main'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php echo $this->Html->link('Reservation Manager', array('controller' => 'reservations', 'action' => 'index'), array('class' => 'navbar-brand')); ?>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><?php echo $this->Html->link(__('New Reservation'), array('controller' => 'reservations', 'action' => 'add'), array('data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<div class="container-fluid">
			<?php echo $this->fetch('content'); ?>
			<?php echo $this->Session->flash(); ?>
	</div>
	<!-- Large modal -->
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				...
			</div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
	<?php
		echo $this->Html->script(array(
			'http://code.jquery.com/jquery-1.11.0.min.js',
			'ReservationManager.bootstrap.min',
			'ReservationManager.main'
		));
	?>
</body>
</html>
