<div class="rooms form">
<?php echo $this->Form->create('Room'); ?>
	<fieldset>
		<legend><?php echo __('Change State'); ?></legend>

	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('room_state_id', array('type' => 'radio'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Change state')); ?>
</div>