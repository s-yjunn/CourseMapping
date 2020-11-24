// CSS Bookshelf JS
// Modified by BooksxMerch group (CSC220)
// By Steve Workman - www.steveworkman.com/bookshelf
// Requires jQuery
$(function bookshelf() {
	var className = '';
	if (!$(this).hasClass('showBook')) {
		className = $(this).attr('class');
		$('.bookshelf .' + className).addClass('showBook');
	} else {
		$(this).removeClass('showBook');
		className = $(this).attr('class');
		$('.bookshelf .' + className).removeClass('showBook');
	}
});
$('.bookshelf dt').click(bookshelf);