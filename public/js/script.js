
function pullChild(row) {
	row.detach().appendTo('#attendanceTable')
	row.css('background', '#00de09b5');
}

$('input.attendance').click(function (e) {
	e.preventDefault();
	let tr = $(e.target).parent().parent();
	let form = tr.find('form');
	let url = form.attr('action');
	$.post(
		url,
		{
			submit: 'ok',
			attendanceAmount: form[0].elements.attendanceAmount.value
		},
		function (data) {
			if (data == 'Success') {
				pullChild(tr);
			} else {
				tr.css('background', '#ff0000b5');
			}
		},
		'text'
	);
});