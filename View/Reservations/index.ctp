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
<ul class="dates-range block">
	<?php foreach ($reservations as $reservation): ?>
		<li class="reservation-item days_<?php echo $reservation['Reservation']['showed_days']; ?> width_<?php echo $reservation['Reservation']['showed_width']; ?>">&nbsp;</li>
	<?php endforeach; ?>
</ul>
<div class="reservations">
	<h2><?php echo __('Reservations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('room_id'); ?></th>
			<th><?php echo $this->Paginator->sort('cliente_id'); ?></th>
			<th><?php echo $this->Paginator->sort('observation'); ?></th>
			<th><?php echo $this->Paginator->sort('passengers'); ?></th>
			<th><?php echo $this->Paginator->sort('checkin'); ?></th>
			<th><?php echo $this->Paginator->sort('checkout'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($reservations as $reservation): ?>
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
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Reservation'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Rooms'), array('controller' => 'rooms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room'), array('controller' => 'rooms', 'action' => 'add')); ?> </li>
	</ul>
</div>
