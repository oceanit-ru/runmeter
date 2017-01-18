$(function () {
	$('.translateModal > *').keypress(function() {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
	});
	$('.modalButton').click(function (e) {
		$('#' + $(e.currentTarget).data("modal")).modal('show');
	});
});


