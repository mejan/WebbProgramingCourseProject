$(document).ready(function(){
	//adds a random header in admin text editing window
	$('#textRandomHeader').click(function(){
		//get the input text fields text to variabel tmp
		var tmp = $('#newPostInputText').val();
		//set variabel header to header tag that is wanted.
		var header = '<h1 class="postRandomHeader"></h1>';
		//remove current content in textarea and and the tmp + header variable.
		$('#newPostInputText').val(tmp + header);
	});

	//adds bold in admin text editing window
	$('#textBig').click(function(){
		//get the input text fields text to variabel tmp
		var tmp = $('#newPostInputText').val();
		//variable biggest get html tags for bold text.
		var biggest = '<strong></strong>';
		//remove current content in textarea and and the tmp + header variable.
		$('#newPostInputText').val(tmp + biggest);
	});

	//adds italic in admin text editing window
	$('#textItalic').click(function(){
		//get the input text fields text to variabel tmp
		var tmp = $('#newPostInputText').val();
		//variable ita get italic tags for italic text.
		var ita = '<em></em>';
		//remove current content in textarea and and the tmp + header variable.
		$('#newPostInputText').val(tmp + ita);
	});

	//fancybox for the images
	$(".FancyPhotos").fancybox({
		prevEffect: 'none',
		nextEffect: 'none'
	});

	//check if enter is pressed and add <br> for breakrow
	$('#newPostInputText').keypress(function (event) {
      if (event.keyCode == 10 || event.keyCode == 13) {
      		console.log("hejsan!!!!");
			//get the input text from textfield to variabel tmp
			var tmp = $('#newPostInputText').val();
			//variable endl get the tag for break row
			var endl = '<br>\n';
			//add old text with break line.
			$('#newPostInputText').val(tmp+endl);
			event.preventDefault();
		}
	});
});

//append