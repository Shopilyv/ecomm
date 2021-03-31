   $('.dropdown-toggle.trial').on('click', function (event) {
    $(this).parent().toggleClass('open');
});     
        
    $('body').on('click', function (e) {
    if (!$('li.dropdown.mega-dropdown').is(e.target) 
        && $('li.dropdown.mega-dropdown').has(e.target).length === 0 
        && $('.open').has(e.target).length === 0
    ) {
        $('li.dropdown.mega-dropdown').removeClass('open');
    }
});
$(function() {
	// Get page title
  	var pageTitle = $("title").text();

	// Change page title on blur
	$(window).blur(function() {
	  $("title").text("Don't forget this..."+ pageTitle);
	});

	// Change page title back on focus
	$(window).focus(function() {
	  $("title").text(pageTitle);
	});
});