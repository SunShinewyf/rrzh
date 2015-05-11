$(document).ready(function(e) {
    var unslider04 = $('#slide').unslider({
		dots: true
	}),
	data04 = unslider04.data('unslider');
	
	$('.unslider-arrow04').click(function() {
        var fn = this.className.split(' ')[1];
        data04[fn]();
    });
});
