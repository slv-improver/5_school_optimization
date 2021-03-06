
function pullChild(row, submit) {
	row.detach().appendTo('#attendanceTable');
	row.addClass('haveAttendance');
	submit.src = 'images/resave.png';
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
				pullChild(tr, e.target);
			} else {
				tr.css('border', '3px dashed #ff0000b5');
			}
		},
		'text'
	);
});

$('a.delete').click(function (e) {
	if (!confirm('Voulez-vous vraiment supprimer l\'enfant ?' +
		'\n\n' + 'Cette action est irréversible !')) {
		e.preventDefault();
	}
})