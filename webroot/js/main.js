$(function () {
	$('body').on('hidden.bs.modal', '.modal', function () {
		$(this).removeData('bs.modal');
	});
	if ($(".reservation-grid").length) {
		$(".reservation-grid").load($(".reservation-grid").data('url'));
	}
})