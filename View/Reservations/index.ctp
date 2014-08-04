<div class="container-fluid">
	<div class="row">
		<div class="col-xs-2 col-xs-offset-10 text-right">
			<?php echo $this->Html->link(__('New Reservation'), array('controller' => 'reservations', 'action' => 'add'), array('class' =>'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
		</div>
	</div>
	<br />
	<div class="row">
		<div class="col-xs-12 reservation-grid" data-url="<?php echo $this->Html->url(array('controller' => 'reservations', 'action' => 'build_grid')); ?>"></div>
	</div>

	<!-- Large modal -->
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				Loading...
			</div>
		</div>
	</div>
</div>

<?php
	echo $this->Html->css(array(
		'ReservationManager.bootstrap.min',
		'ReservationManager.bootstrap-theme.min',
		'ReservationManager.main')
	);
?>

<?php
	echo $this->Html->script(array(
		'http://code.jquery.com/jquery-1.11.0.min.js',
		'ReservationManager.bootstrap.min',
		'ReservationManager.main'
	));
?>