
$(document).ready(function() {
	$(".alert-notice").alert();
	window.setTimeout(function() {
		$(".alert-notice").alert('close');
	}, 7000);
	$(".alert-error").alert();
	window.setTimeout(function() {
		$(".alert-error").alert('close');
	}, 7000);
	$(".alert-success").alert();
	window.setTimeout(function() {
		$(".alert-success").alert('close');
	}, 7000);

    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Debe completar el campo.");
            }
        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }

})