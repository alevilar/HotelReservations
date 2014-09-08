<div class="reservations view">
<h2><?php echo __('Reservation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($reservation['Reservation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Room'); ?></dt>
		<dd>
			<?php echo $this->Html->link($reservation['Room']['name'], array('controller' => 'rooms', 'action' => 'view', $reservation['Room']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('%s Id', Configure::read('Mesa.tituloCliente')); ?></dt>
		<dd>
			<?php echo h($reservation['Reservation']['cliente_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Observation'); ?></dt>
		<dd>
			<?php echo h($reservation['Reservation']['observation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Passengers'); ?></dt>
		<dd>
			<?php echo h($reservation['Reservation']['passengers']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Checkin'); ?></dt>
		<dd>
			<?php echo h($reservation['Reservation']['checkin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Checkout'); ?></dt>
		<dd>
			<?php echo h($reservation['Reservation']['checkout']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($reservation['Reservation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($reservation['Reservation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Reservation'), array('action' => 'edit', $reservation['Reservation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Reservation'), array('action' => 'delete', $reservation['Reservation']['id']), array(), __('Are you sure you want to delete # %s?', $reservation['Reservation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Reservations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reservation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rooms'), array('controller' => 'rooms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room'), array('controller' => 'rooms', 'action' => 'add')); ?> </li>
	</ul>
</div>
