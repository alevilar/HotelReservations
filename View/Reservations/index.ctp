
<div class="row">
	<div class="col-xs-12 dates-range">
		<?php echo $this->Html->link(__('<<'), array('action' => 'index', 'date' => $prev), array('class' => "date left btn btn-primary", 'style' => "width: $col_width%")); ?>
		<?php foreach($dates as $date): ?>
			<?php echo $this->Html->link($date, array('action' => 'add', 0, $date), array('class' => "date btn btn-" . (($date == date('Y-m-d')) ? 'primary' : 'default'), 'style' => "width: $col_width%", 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
		<?php endforeach; ?>
		<?php echo $this->Html->link(__('>>'), array('action' => 'index', 'date' => $next), array('class' => "date right btn btn-primary", 'style' => "width: $col_width%")); ?>
	</div>
</div>
<?php foreach ($rooms as $room): ?>	
	<div class="row">
		<div class="col-xs-12 dates-range">
				<?php echo $this->Html->link($room['Room']['name'], array('controller' => 'rooms', 'action' => 'state', $room['Room']['id']), array('class' => "btn btn-default " . $room['RoomState']['color'], 'style' => "width: $col_width%", 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
				<?php //if ($room['Reservation']): ?>
					<?php $aux = (isset($room['ReservationDates'][$dates[0]][0])) ? $room['ReservationDates'][$dates[0]][0] : null; ?>
						<?php for ($i = 0; $i < sizeof($dates);  $i++):  ?>
							<?php if ( isset($room['ReservationDates'][$dates[$i]][0]) && ($aux != $room['ReservationDates'][$dates[$i]][0])): ?>
								<?php $aux = $room['ReservationDates'][$dates[$i]][0]; ?>
								<?php $border = 'no-border-right'; ?>
								<?php if (sizeof($room['ReservationDates'][$dates[$i - 1]]) != 1): ?>
									<?php $border = 'no-border-left no-border-right'; ?>
								<?php endif; ?>
							<?php elseif ( isset($room['ReservationDates'][$dates[$i]][0]) && (isset($dates[$i + 1])) && !isset($room['ReservationDates'][$dates[$i + 1]][0])): ?>
								<?php $border = 'no-border-left'; ?>
							<?php else: ?>
								<?php $border = 'no-border-left no-border-right'; ?>
							<?php endif; ?>
							<div style="width:<?php echo $col_width; ?>%" class="reservation-item">
								<?php if (isset($room['ReservationDates'][$dates[$i]]) && !empty($room['ReservationDates'][$dates[$i]][0])): ?>
									<?php if (sizeof($room['ReservationDates'][$dates[$i]]) > 1): ?>
										<?php echo $this->Html->link('
											<button class="btn btn-danger no-border-left col-xs-12">&nbsp;</button>
										', array('action' => 'edit', $room['ReservationDates'][$dates[$i]][0]), array('class' => 'col-xs-6', 'escape' => false, 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
										<?php echo $this->Html->link('
											<button class="btn btn-danger no-border-right col-xs-12">&nbsp;</button>
										', array('action' => 'edit', $room['ReservationDates'][$dates[$i]][1]), array('class' => 'col-xs-6', 'escape' => false, 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
									<?php else: ?>
										<?php echo $this->Html->link('
											<button class="btn btn-danger col-xs-12 ' . $border . '">&nbsp;</button>
										', array('action' => 'edit', $room['ReservationDates'][$dates[$i]][0]), array('class' => 'col-xs-12', 'escape' => false, 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
									<?php endif; ?>
								<?php else: ?>
										<span class="col-xs-12">&nbsp;</span>
								<?php endif; ?>
							</div>
						<?php endfor; ?>
				<?php //endif; ?>
				<?php echo $this->Html->link($room['Room']['name'], array('controller' => 'rooms', 'action' => 'state', $room['Room']['id']), array('class' => "btn btn-default " . $room['RoomState']['color'], 'style' => "width: $col_width%", 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
		</div>
	</div>
<?php endforeach; ?>