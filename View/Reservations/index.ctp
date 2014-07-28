
<div class="row">
	<div class="col-xs-12 dates-range">
		<?php echo $this->Html->link(__('<<'), array('action' => 'index', 'date' => $prev), array('class' => "date left btn btn-primary col-xs-$col_width")); ?>
		<?php foreach($dates as $date): ?>
			<?php echo $this->Html->link($date, array('action' => 'add', 0, $date), array('class' => "date btn btn-" . (($date == date('Y-m-d')) ? 'primary' : 'default') . " col-xs-$col_width", 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
		<?php endforeach; ?>
		<?php echo $this->Html->link(__('>>'), array('action' => 'index', 'date' => $next), array('class' => "date right btn btn-primary col-xs-$col_width")); ?>
	</div>
</div>
<?php foreach ($rooms as $room): ?>	
	<div class="row">
		<div class="col-xs-12 dates-range">
				<?php echo $this->Html->link($room['Room']['name'], array('controller' => 'rooms', 'action' => 'state', $room['Room']['id']), array('class' => "btn btn-default col-xs-$col_width " . $room['RoomState']['color'], 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
				<?php //if ($room['Reservation']): ?>
						<?php foreach ($dates as $date):  ?>
							<div class="col-xs-<?php echo $col_width; ?> reservation-item">
								<?php if (isset($room['ReservationDates'][$date]) && !empty($room['ReservationDates'][$date][0])): ?>
									<?php if (sizeof($room['ReservationDates'][$date]) > 1): ?>
										<?php echo $this->Html->link('
											<button class="btn btn-danger col-xs-12">&nbsp;</button>
										', array('action' => 'edit', $room['ReservationDates'][$date][0]), array('class' => 'col-xs-6', 'escape' => false, 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
										<?php echo $this->Html->link('
											<button class="btn btn-danger col-xs-12">&nbsp;</button>
										', array('action' => 'edit', $room['ReservationDates'][$date][1]), array('class' => 'col-xs-6', 'escape' => false, 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
									<?php else: ?>
										<?php echo $this->Html->link('
											<button class="btn btn-danger col-xs-12">&nbsp;</button>
										', array('action' => 'edit', $room['ReservationDates'][$date][0]), array('class' => 'col-xs-12', 'escape' => false, 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
									<?php endif; ?>
								<?php else: ?>
										<?php echo $this->Html->link('
											<button class="btn btn-default col-xs-12">&nbsp;</button>
										', array('action' => 'add', 0, $date, $room['Room']['id']), array('class' => 'col-xs-12', 'escape' => false, 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
				<?php //endif; ?>
				<?php echo $this->Html->link($room['Room']['name'], array('controller' => 'rooms', 'action' => 'state', $room['Room']['id']), array('class' => "btn btn-default col-xs-$col_width " . $room['RoomState']['color'], 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
		</div>
	</div>
<?php endforeach; ?>