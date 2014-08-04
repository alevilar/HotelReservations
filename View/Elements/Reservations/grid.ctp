<table class="table table-bordered">
	<tbody>
		<thead>
			<tr>
				<th style="width: <?php echo $col_width; ?>%"><?php echo $this->Html->link(__('<<'), array('action' => 'build_grid', 'date' => $prev), array('class' => "date prev")); ?></th>
				<?php foreach($dates as $date): ?>
					<th style="width: <?php echo $col_width; ?>%" class="text-center<?php echo (($date == date('Y-m-d')) ? ' active' : ''); ?>"><small><?php echo $this->Html->link(strftime('%a<br />%d<br />%b', strtotime($date)), array('action' => 'add', 0, $date), array('class' => "date", 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg', 'escape' => false)); ?></small></th>
				<?php endforeach; ?>

				<th style="width: <?php echo $col_width; ?>%"><?php echo $this->Html->link(__('>>'), array('action' => 'build_grid', 'date' => $next), array('class' => "date next")); ?></th>
			</tr>
		</thead>
		<?php foreach ($rooms as $room): ?>	
			<tr>
				<td style="width: <?php echo $col_width; ?>" class="<?php echo $room['RoomState']['color']; ?>">
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
				<td style="width: <?php echo $col_width; ?>" class="<?php echo $room['RoomState']['color']; ?>">
					<?php echo $this->Html->link($room['Room']['name'], array('controller' => 'rooms', 'action' => 'state', $room['Room']['id']), array('style' => 'color:#fff;width:' . $col_width . '%', 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg')); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<script type="text/javascript">
	$(function () {
		$(".prev, .next").click(function (e) {
			e.preventDefault();
			target = $(".reservation-grid");
			target.load(this.href);
		})
	})
</script>