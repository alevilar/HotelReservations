<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Reservation'), array('action' => 'add')); ?></li>
	</ul>
</div>
<ul class="dates-range">
	<li><?php echo $this->Html->link(__('left'), array('action' => 'index', 'date' => $prev)); ?></li>
	<?php foreach($dates as $date): ?>
		<?php if ($date == date('Y-m-d')): ?>
			<li><strong><?php echo $date; ?></strong></li>
		<?php else: ?>
			<li><?php echo $date; ?></li>
		<?php endif; ?>
	<?php endforeach; ?>
	<li><?php echo $this->Html->link(__('next'), array('action' => 'index', 'date' => $next)); ?></li>
</ul>
<ul class="rooms">
	<?php foreach ($rooms as $room): ?>
		<li>
			<?php echo $this->Html->link($room['Room']['name'] . ' ' . $roomStates[$room['Room']['today_state']], array('controller' => 'rooms', 'action' => 'state', $room['Room']['id'])); ?>
			<?php if ($room['Reservation']): ?>
				<ul class="reservations">
					<?php foreach ($room['Reservation'] as $reservation): ?>
						<li class="reservation-item days_<?php echo $reservation['Reservation']['showed_days']; ?> width_<?php echo $reservation['Reservation']['showed_width']; ?>"><?php echo $this->Html->link('&nbsp;', array('action' => 'edit', $reservation['Reservation']['id']), array('escape' => false)); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
</ul>
<div class="reservations">
	<h2><?php echo __('Reservations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo 'id'; ?></th>
			<th><?php echo 'room_id'; ?></th>
			<th><?php echo 'cliente_id'; ?></th>
			<th><?php echo 'observation'; ?></th>
			<th><?php echo 'passengers'; ?></th>
			<th><?php echo 'checkin'; ?></th>
			<th><?php echo 'checkout'; ?></th>
			<th><?php echo 'created'; ?></th>
			<th><?php echo 'modified'; ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($rooms as $room): ?>
		<?php foreach($room['Reservation'] as $reservation): ?>
			<tr>
				<td><?php echo h($reservation['Reservation']['id']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($reservation['Room']['name'] . ' => ' . $reservation['Reservation']['showed_width'] . ' ' . $reservation['Reservation']['showed_days'], array('controller' => 'rooms', 'action' => 'view', $reservation['Room']['id'])); ?>
				</td>
				<td><?php echo h($reservation['Reservation']['cliente_id']); ?>&nbsp;</td>
				<td><?php echo h($reservation['Reservation']['observation']); ?>&nbsp;</td>
				<td><?php echo h($reservation['Reservation']['passengers']); ?>&nbsp;</td>
				<td><?php echo h($reservation['Reservation']['checkin']); ?>&nbsp;</td>
				<td><?php echo h($reservation['Reservation']['checkout']); ?>&nbsp;</td>
				<td><?php echo h($reservation['Reservation']['created']); ?>&nbsp;</td>
				<td><?php echo h($reservation['Reservation']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $reservation['Reservation']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $reservation['Reservation']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $reservation['Reservation']['id']), array(), __('Are you sure you want to delete # %s?', $reservation['Reservation']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
<?php endforeach; ?>
	</table>
</div>
