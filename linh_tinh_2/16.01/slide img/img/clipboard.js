var mouseX;
var mouseY;
function copy(text2copy,e) {
	if (window.clipboardData) {
		window.clipboardData.setData("Text",text2copy);
	}
	else {
		var flashcopier = 'flashCopier';
		if(!document.getElementById(flashcopier)) {
			var divholder = document.createElement('div');
			divholder.id = flashcopier;
			document.body.appendChild(divholder);
		}
		document.getElementById(flashcopier).innerHTML = '';
		var divinfo = '<embed src="img/clipboard.swf" FlashVars="clipboard='+escape(text2copy)+'" width="0" height="0" type="application/x-shockwave-flash"></embed>';
		document.getElementById(flashcopier).innerHTML = divinfo;
	}
	if (e.pageX || e.pageY) {
		mouseX = e.pageX;
		mouseY = e.pageY;
	}
	else if (e.clientX || e.clientY) {
		mouseX = e.clientX + document.body.scrollLeft;
		mouseY = e.clientY + document.body.scrollTop;
	}
	mouseX += 10;
	showCopiedMsg();
}

function showCopiedMsg() {
	var copied = document.getElementById('copiedMsg');
	copied.style.display = 'block';
    copied.style.top = mouseY +'px';
    copied.style.left = mouseX +'px';
}

function hideCopiedMsg() {
	document.getElementById('copiedMsg').style.display='none';
}