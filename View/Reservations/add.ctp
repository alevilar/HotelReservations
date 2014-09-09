<div class="modal-content">
	<div class="reservations form">
	<?php echo $this->Form->create('Reservation'); ?>
		<fieldset>
			<legend><?php echo __('Add Reservation'); ?></legend>
		<?php
			if ($room_id) {
				echo $this->Form->input('room_id', array('type' => 'hidden', 'value' => $room_id));
				echo "<label>Room</label>: ";
				echo "<strong>" . $room['Room']['name'] . "</strong><br />";
			} else {
				echo $this->Form->input('room_id', array('value' => $room_id));
			}

			if ($cliente_id) {
				echo $this->Form->input('cliente_id', array('type' => 'hidden', 'value' => $cliente_id));
				?>
				<label><?php echo Configure::read('Mesa.tituloCliente') ?></label>: 
				<?php
				echo "<strong>" . $cliente['Cliente']['nombre'] . "</strong> <br />";
				echo $this->Html->link(__('Cambiar %s', Configure::read('Mesa.tituloCliente') ), array('action' => 'select_client'));
			} else {
				echo $this->Html->link(__('Seleccionar %s', Configure::read('Mesa.tituloCliente') ), array('action' => 'select_client'));
				echo $this->Form->input('cliente_id');
			}
			echo $this->Form->input('observation');
			echo $this->Form->input('passengers', array('value' => ($cliente_id) ? 1 : ''));
			echo $this->Form->input('checkin', array('type' => 'text', 'value' => ($checkin) ? $checkin . ' ' . date('H:i:s') : date('Y-m-d H:i:s')));
			echo $this->Form->input('checkout', array('type' => 'text', 'value' => ($checkin) ? $checkin . ' ' . date('H:i:s') : date('Y-m-d H:i:s')));
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</div>
</div>