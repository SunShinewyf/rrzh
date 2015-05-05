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

   $(function() {
                $("#scroller_roll1").scroller_roll({
                    title_show: 'enable',//enable  disable
                    time_interval: '15',
                    window_background_color: "#C1F0FF",
                    window_padding: '1',
                    border_size: '1',
                    border_color: '#0099CC',
                    images_width: '160',
                    images_height: '120',
                    images_margin: '5',
                    title_size: '12',
                    title_color: 'black',
                    show_count: '3'
                });
            });