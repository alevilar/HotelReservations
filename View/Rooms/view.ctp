<div class="rooms view">
<h2><?php echo __('Room'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($room['Room']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($room['Room']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($room['Room']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Room State'); ?></dt>
		<dd>
			<?php echo $this->Html->link($room['RoomState']['name'], array('controller' => 'room_states', 'action' => 'view', $room['RoomState']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($room['Room']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($room['Room']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Room'), array('action' => 'edit', $room['Room']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Room'), array('action' => 'delete', $room['Room']['id']), array(), __('Are you sure you want to delete # %s?', $room['Room']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rooms'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Room States'), array('controller' => 'room_states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room State'), array('controller' => 'room_states', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reservations'), array('controller' => 'reservations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reservation'), array('controller' => 'reservations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Reservations'); ?></h3>
	<?php if (!empty($room['Reservation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Room Id'); ?></th>
		<th><?php echo __('%s Id', Configure::read('Mesa.tituloCliente')); ?></th>
		<th><?php echo __('Observation'); ?></th>
		<th><?php echo __('Passengers'); ?></th>
		<th><?php echo __('Checkin'); ?></th>
		<th><?php echo __('Checkout'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($room['Reservation'] as $reservation): ?>
		<tr>
			<td><?php echo $reservation['id']; ?></td>
			<td><?php echo $reservation['room_id']; ?></td>
			<td><?php echo $reservation['cliente_id']; ?></td>
			<td><?php echo $reservation['observation']; ?></td>
			<td><?php echo $reservation['passengers']; ?></td>
			<td><?php echo $reservation['checkin']; ?></td>
			<td><?php echo $reservation['checkout']; ?></td>
			<td><?php echo $reservation['created']; ?></td>
			<td><?php echo $reservation['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'reservations', 'action' => 'view', $reservation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'reservations', 'action' => 'edit', $reservation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'reservations', 'action' => 'delete', $reservation['id']), array(), __('Are you sure you want to delete # %s?', $reservation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Reservation'), array('controller' => 'reservations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
