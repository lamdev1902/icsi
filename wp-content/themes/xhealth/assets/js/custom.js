jQuery(function($){
	$('.menu-toggle').click(function(){
		$(this).toggleClass('exit');
		$('#header').toggleClass('menu-open');
		$('body').toggleClass('no-scroll');
		return false;
	});
	$('#header .header-right .list-menu-header ul li.menu-item-has-children').append('<i class="fa fa-angle-down"></i>');
	$('#header .header-right .list-menu-header ul li.menu-item-has-children i').click(function(){
		$(this).parent().find('.sub-menu').slideToggle();
		$(this).toggleClass('active');
	});
	customer_review_leea();
	
	$('.search-toggle').click(function(){
		$('.header-search-form').slideToggle();
		return false;
	});
});
function customer_review_leea() {
   $('.customer-ftoggle').click(function() {
        $('html').css('overflow','hidden');
        $(this).addClass('ani-right');
        $(this).removeClass('ani-left');
        $('.customer-feedback').addClass('ani-fade');
        $('.form-customer-feedback').addClass('ani-fade');
        return false;
    });
    $('.form-customer-feedback .close-btn').click(function() {
        $('.customer-ftoggle').removeClass('ani-right');
        $('.customer-feedback').removeClass('ani-fade');
        $('.form-customer-feedback').removeClass('ani-fade');
        $('.form-customer-feedback .customer-ftoggle').addClass('ani-left');
        $('html').css('overflow','auto');
    });
    $('.rating-feedback').rating({
        maxRating: 5,
        initialRating: 3,
        readonly: false,
        step: 1,
    });
    $('.rating-feedback').change(function() {
        $('.form-feedback').show();
        $('.form-hidden-rating').val($('.rating-feedback').val());
        $('.form-hidden-link').val($('.link-post-feedback').val());
        $('.form-hidden-ip').val($('.ip-address').val());
        var d = new Date();
        var strDate = d.getDate() + "-" + (d.getMonth()+1) + "-" + d.getFullYear() + " " + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
        $('.form-date-send').val(strDate).attr('value',strDate);
    });
    $('.form-select').parent().addClass('your-option');

    $('.form-select').change(function() {
        if ($('.form-select').val() != "") {
            $('.form-customer-feedback .your-option').addClass('hide-star');
            $('.form-select').css("color", "#000");
        } else {
            $('.form-customer-feedback .your-option').removeClass('hide-star');
        };
        if ($('.form-select').val() == "") {
            $('textarea.form-group').hide();
        } else {
            $('textarea.form-group').slideDown();
        };
        if ($('.form-select').val() == "Questions") {
            $('.form-customer-feedback .form-group-email').slideDown();
            // $(".form-customer-feedback textarea.form-group").attr("placeholder", "New placeholder text");
        } else {
            $('.form-customer-feedback .form-group-email').hide();
        };
        if ($('.form-select').val() == "Report bug") {
            $(".form-customer-feedback textarea.form-group").attr("placeholder", "Where did you have a technical problem?");
        } else {
            $(".form-customer-feedback textarea.form-group").attr("placeholder", "What would you like to share with us?");
        };
    });
    document.addEventListener('wpcf7mailsent', function() {
        $('.form-customer-feedback .mailsent').show();
        $('.form-customer-feedback .form-feedback, .form-customer-feedback .star-rating').hide();
    }, false);
}
$(window).scroll(function() {
  var halfWay = $('body').height()*0.25;
  if ($(window).scrollTop() >= halfWay) {
      $('.form-customer-feedback .customer-ftoggle').addClass('ani-left');
  }
});