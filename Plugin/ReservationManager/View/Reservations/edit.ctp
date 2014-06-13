<div class="reservations form">
<?php echo $this->Form->create('Reservation'); ?>
	<fieldset>
		<legend><?php echo __('Edit Reservation'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('room_id');
		echo $this->Form->input('cliente_id');
		echo $this->Form->input('observation');
		echo $this->Form->input('passengers');
		echo $this->Form->input('checkin');
		echo $this->Form->input('checkout');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Reservation.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Reservation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Reservations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Rooms'), array('controller' => 'rooms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room'), array('controller' => 'rooms', 'action' => 'add')); ?> </li>
	</ul>
</div>
