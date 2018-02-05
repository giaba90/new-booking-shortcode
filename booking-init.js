(function ($) {
	var email 	= "",
		checkin	= "",
		checkout = "",
		n_rooms = 0,
		n_adults = 0,
		n_children = 0;

//('#room :selected').text()



$('#book-now').on('click',function(){

	checkin 	= moment( $('#checkin').val() ,"MM/DD/YYYY");
	checkout 	= moment( $('#checkout').val(),"MM/DD/YYYY");
	n_rooms 	= parseInt($('#room').val(),10);
	n_adults 	= parseInt($('#adults').val(),10);
	n_children 	= parseInt($('#children').val(),10);


	var urlcheckin = "&checkin=" + checkin.format('YYYY-MM-DD');
    var urlcheckout = "&checkout=" + checkout.format('YYYY-MM-DD');

    var guest = "";
    for(i = 1; i <= n_rooms; i++){
    	if(i > 1) guest += "-";
    	guest += n_adults;

    	if(n_children > 0){
    		for(i=1; i <= n_children;i++){
    			guest +=",";
    		}
    	}
    }

	var url = "https://secure.begenius.it/bookingenius/hotel_web/"+bgconfig.lang+"/ilborgo/?v=1";

    var urlrooms = "&rooms=" + guest;
    var fullurl = url + urlcheckin + urlcheckout + urlrooms;

    window.open(fullurl);

    invia_mail();
});

function invia_mail(){
	email 		= $('#email').val();
	checkin 	= $('#checkin').val();
	checkout 	= $('#checkout').val();
var	t_rooms 	= $('#room :selected').text();
	n_adults 	= parseInt($('#adults').val(),10);
	n_children 	= parseInt($('#children').val(),10);

	$.post( "/wp-content/plugins/new-booking-shortcode/reservation.php", {
		email: email,
		checkin: checkin,
		checkout: checkout,
		room: t_rooms,
		adults: n_adults,
		children: n_children
	})
	.done(function( data ) {
    		console.log(data);
  		})
  	.fail(function() {
    console.log( "error" );
  });
}

})(jQuery);