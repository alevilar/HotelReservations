<div class="rooms form">
<?php echo $this->Form->create('Room'); ?>
	<fieldset>
		<legend><?php echo __('Edit Room'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('room_state_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Room.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Room.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Rooms'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Room States'), array('controller' => 'room_states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room State'), array('controller' => 'room_states', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reservations'), array('controller' => 'reservations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reservation'), array('controller' => 'reservations', 'action' => 'add')); ?> </li>
	</ul>
</div>
