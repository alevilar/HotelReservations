<div class="roomStates form">
<?php echo $this->Form->create('RoomState'); ?>
	<fieldset>
		<legend><?php echo __('Edit Room State'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('RoomState.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('RoomState.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Room States'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Rooms'), array('controller' => 'rooms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room'), array('controller' => 'rooms', 'action' => 'add')); ?> </li>
	</ul>
</div>
