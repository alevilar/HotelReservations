<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Back'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Add Client'), array('action' => 'add')); ?></li>
	</ul>
</div>
<div class="reservations form">
	<fieldset>
		<legend><?php echo __('Select %s', Configure::read('Mesa.tituloCliente')); ?></legend>
		<ul>
			<?php foreach ($clientes as $client): ?>
				<li><?php echo $this->Html->link($client['Cliente']['nombre'], array('action' => 'add', $client['Cliente']['id'])); ?></li>
			<?php endforeach; ?>
		</ul>
	</fieldset>
</div>
