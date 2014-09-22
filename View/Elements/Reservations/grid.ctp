<div class="col-md-1">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
				<?php echo $this->Html->link(__('<<'), array('action' => 'build_grid', 'date' => $prev), array('class' => "date prev")); ?></th>
				<?php foreach($dates as $date): ?>
					<th class="text-center<?php echo (($date == date('Y-m-d')) ? ' active' : ''); ?>"><small><?php echo $this->Html->link(strftime('%a<br />%d<br />%b', strtotime($date)), array('action' => 'add', 0, $date), array('class' => "date", 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg', 'escape' => false)); ?></small></th>
				<?php endforeach; ?>		
			</tr>
		</thead>
	</table>
</div>


<div class="col-md-11">
	<?php echo $this->element('ReservationManager'); ?>
</div>



<script type="text/javascript">
	$(function () {
		$(".prev, .next").click(function (e) {
			e.preventDefault();
			target = $(".reservation-grid");
			target.load(this.href);
		})
	})
</script>