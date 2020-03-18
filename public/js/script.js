
function pullChild(row) {
	row.detach().appendTo('#attendanceTable')
	row.classList.add('haveAttendance');
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
				tr.css('border', '5px dashed #ff0000b5');
			}
		},
		'text'
	);
});