<table>
	<tbody>
			<?php foreach ($rooms as $room): ?>	
				<tr>
					<td class="<?php echo ($room['RoomState']['color']) ? $room['RoomState']['color'] : 'btn-success'; ?>">
						<?php echo $this->Html->link($room['Room']['name'], array('controller' => 'rooms', 'action' => 'state', $room['Room']['id']), array('style' => 'color:#fff;width:' . $col_width . '%', 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
					</td>
					
					<?php for ($i = 0; $i < sizeof($dates);  $i++):  ?>
						<?php $border = 'checkin checkout'; ?>
						<?php if ( isset($dates[$i - 1]) &&  isset($dates[$i + 1]) && isset($room['ReservationDates'][$dates[$i]][0]) && isset($room['ReservationDates'][$dates[$i - 1]][0]) && isset($room['ReservationDates'][$dates[$i + 1]][0]) && ($room['ReservationDates'][$dates[$i]][0] == $room['ReservationDates'][$dates[$i - 1]][0]) && ($room['ReservationDates'][$dates[$i]][0] == $room['ReservationDates'][$dates[$i + 1]][0])): ?>
								<?php $border = 'no-border-left no-border-right'; ?>
						<?php elseif ( isset($dates[$i - 1]) &&  isset($dates[$i + 1]) && isset($room['ReservationDates'][$dates[$i]][0]) && isset($room['ReservationDates'][$dates[$i - 1]][0]) && isset($room['ReservationDates'][$dates[$i + 1]][0]) && ($room['ReservationDates'][$dates[$i]][0] == $room['ReservationDates'][$dates[$i - 1]][0]) && ($room['ReservationDates'][$dates[$i]][0] != $room['ReservationDates'][$dates[$i + 1]][0])): ?>
								<?php $border = 'no-border-left checkout'; ?>
						<?php elseif ( isset($dates[$i - 1]) &&  isset($dates[$i + 1]) && isset($room['ReservationDates'][$dates[$i]][0]) && isset($room['ReservationDates'][$dates[$i - 1]][0]) && isset($room['ReservationDates'][$dates[$i + 1]][0]) && ($room['ReservationDates'][$dates[$i]][0] != $room['ReservationDates'][$dates[$i - 1]][0]) && ($room['ReservationDates'][$dates[$i]][0] == $room['ReservationDates'][$dates[$i + 1]][0])): ?>
								<?php $border = 'no-border-right checkin'; ?>
						<?php elseif ( isset($dates[$i - 1]) &&  isset($dates[$i + 1]) && isset($room['ReservationDates'][$dates[$i]][0]) && isset($room['ReservationDates'][$dates[$i - 1]][0]) && !isset($room['ReservationDates'][$dates[$i + 1]][0]) && ($room['ReservationDates'][$dates[$i]][0] == $room['ReservationDates'][$dates[$i - 1]][0])): ?>
								<?php $border = 'no-border-left checkout'; ?>
						<?php elseif ( isset($dates[$i - 1]) &&  isset($dates[$i + 1]) && isset($room['ReservationDates'][$dates[$i]][0]) && !isset($room['ReservationDates'][$dates[$i - 1]][0]) && isset($room['ReservationDates'][$dates[$i + 1]][0]) && ($room['ReservationDates'][$dates[$i]][0] == $room['ReservationDates'][$dates[$i + 1]][0])): ?>
								<?php $border = 'no-border-right checkin'; ?>
						<?php elseif ( isset($dates[$i - 1]) &&  isset($dates[$i + 1]) && isset($room['ReservationDates'][$dates[$i]][0]) && isset($room['ReservationDates'][$dates[$i - 1]][0]) && !isset($room['ReservationDates'][$dates[$i + 1]][0]) && ($room['ReservationDates'][$dates[$i]][0] == $room['ReservationDates'][$dates[$i + 1]][0])): ?>
								<?php $border = 'no-border-left checkout'; ?>
						<?php elseif ( !isset($dates[$i - 1]) &&  isset($dates[$i + 1]) && isset($room['ReservationDates'][$dates[$i]][0]) && isset($room['ReservationDates'][$dates[$i + 1]][0]) && ($room['ReservationDates'][$dates[$i]][0] == $room['ReservationDates'][$dates[$i + 1]][0])): ?>
								<?php $border = 'no-border-right checkin'; ?>
						<?php elseif ( isset($dates[$i - 1]) &&  !isset($dates[$i + 1]) && isset($room['ReservationDates'][$dates[$i]][0]) && isset($room['ReservationDates'][$dates[$i - 1]][0]) && ($room['ReservationDates'][$dates[$i]][0] == $room['ReservationDates'][$dates[$i - 1]][0])): ?>
								<?php $border = 'no-border-left checkout'; ?>
						<?php elseif ( !isset($dates[$i - 1]) &&  isset($dates[$i + 1])): ?>
								<?php $border = 'checkin checkout'; ?>
						<?php endif; ?>

						<?php if (isset($room['ReservationDates'][$dates[$i]]) && !empty($room['ReservationDates'][$dates[$i]][0])): ?>
								<td style="width: <?php echo $col_width; ?>%" class="active <?php echo $border; ?>">
									<?php echo $this->Html->link('&nbsp;', array('action' => 'edit', $room['ReservationDates'][$dates[$i]][0]), array('data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg', 'escape' => false, 'class' => 'col-xs-12')); ?>
								</td>
						<?php else: ?>
								<td style="width: <?php echo $col_width; ?>%">&nbsp;</td>
						<?php endif; ?>
					<?php endfor; ?>
					<td style="width: <?php echo $col_width; ?>%" class="<?php echo ($room['RoomState']['color']) ? $room['RoomState']['color'] : 'btn-success'; ?>">
						<?php echo $this->Html->link($room['Room']['name'], array('controller' => 'rooms', 'action' => 'state', $room['Room']['id']), array('style' => 'color:#fff;width:' . $col_width . '%', 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>

</table>