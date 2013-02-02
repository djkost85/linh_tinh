function $(id) {
	return document.getElementById(id);
}

function showCode(what) {
	var max_width = 200;
	var max_height = 200;
	var ratio;
	
	var img = what.getElementsByTagName('img')[0];
	var codeBox = $('codeBox');
	codeBox.style.display = 'block';

	var codeEmo = $('codeEmo');
	var codeDirect = $('codeDirect');
	var codeBB = $('codeBB');
	var codeHTML = $('codeHTML');
	
	
	if (codeEmo.src && codeEmo.src == img.src) {
		codeEmo.src = '';
		hideCode();
		return false;
	}
	
	codeEmo.src = img.src;
	codeEmo.width = img.width;
	codeEmo.height = img.height;
	codeEmo.title = 'ChipLove.Biz';
	
	if (codeEmo.width > max_width) {
		ratio = max_width/codeEmo.width;
		codeEmo.width = Math.round(codeEmo.width * ratio);
		codeEmo.height = Math.round(codeEmo.height * ratio);
	}
	if (codeEmo.height > max_height) {
		ratio = max_height/codeEmo.height;
		codeEmo.width = Math.round(codeEmo.width * ratio);
		codeEmo.height = Math.round(codeEmo.height * ratio);
	}
	
	codeDirect.value = img.src;
	codeBB.value = '[url=http://ChipLove.Biz][img]'+img.src+'[/img][/url]';
	codeHTML.value = '<a href="http://ChipLove.Biz"><img src="'+img.src+'" width="'+img.width+'" height="'+img.height+'" border="0" alt="ChipLove.Biz" title="ChipLove.Biz" /></a>';
	
	return false;
}

function hideCode() {
	var codeBox = $('codeBox');
	codeBox.style.display = 'none';
	return false;
}