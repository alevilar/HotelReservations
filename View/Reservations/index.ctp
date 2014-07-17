<div class="row">
	<table class="text-center table table-striped table-condensed">
		<tbody>
			<tr class="dates-range">
				<td style="width:<?php echo $col_width; ?>%"><?php echo $this->Html->link(__('<<'), array('action' => 'index', 'date' => $prev), array('class' => "date left")); ?></td>

				<?php foreach($dates as $date): ?>
					<td style="width:<?php echo $col_width; ?>%"><?php echo $this->Html->link($this->Time->format('D d M', $date), array('action' => 'add', 0, $date), array('class' => "date " . (($date == date('Y-m-d')) ? 'active' : ''), 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?></td>
				<?php endforeach; ?>

				<td style="width:<?php echo $col_width; ?>%"><?php echo $this->Html->link(__('>>'), array('action' => 'index', 'date' => $next), array('class' => "date right")); ?></td>
			</tr>
			<?php foreach ($rooms as $room): ?>
				<tr class="dates-range">
					<td style="width:<?php echo $col_width; ?>%">
						<?php echo $this->Html->link($room['Room']['name'], array('controller' => 'rooms', 'action' => 'state', $room['Room']['id']), array('class' => ' ' . $room['RoomState']['color'], 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
					</td>
					<?php foreach ($dates as $date):  ?>
						<td style="width:<?php echo $col_width; ?>%" class="reservation-item">
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
							<?php endif; ?>
						</td>
					<?php endforeach; ?>
					<td style="width:<?php echo $col_width; ?>%">&nbsp;</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>