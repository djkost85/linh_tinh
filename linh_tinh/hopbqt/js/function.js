
function addsmile(kitu)
{
	window.opener.document.adminkute_chatbox.text.value = opener.document.adminkute_chatbox.text.value + kitu;
}


function c_style(element)
	{
		if (element == 'b')
		{
			if (document.adminkute_chatbox.cbold.value == 'B')
			{
				document.adminkute_chatbox.cbold.value = 'B*';
				document.adminkute_chatbox.upbold.value = 'B*';
				textstyle.style.fontWeight = 'bold';
			}
			else
			{
				document.adminkute_chatbox.cbold.value = 'B';
				document.adminkute_chatbox.upbold.value = 'B';
				textstyle.style.fontWeight = 'normal';
			}
			
		}
		else if (element == 'i')
		{
			if (document.adminkute_chatbox.citalic.value == 'I')
			{
				document.adminkute_chatbox.citalic.value = 'I*';
				document.adminkute_chatbox.upitalic.value = 'I*';
				textstyle.style.fontStyle = 'italic';
			}
			else
			{
				document.adminkute_chatbox.citalic.value = 'I';
				document.adminkute_chatbox.upitalic.value = 'I';
				textstyle.style.fontStyle = 'normal';
			}
			
		}
		else if (element == 'u')
		{
			if (document.adminkute_chatbox.cunderline.value == 'U')
			{
				document.adminkute_chatbox.cunderline.value = 'U*';
				document.adminkute_chatbox.upunderline.value = 'U*';
				textstyle.style.textDecoration = 'underline';
			}
			else
			{
				document.adminkute_chatbox.cunderline.value = 'U';
				document.adminkute_chatbox.upunderline.value = 'U';
				textstyle.style.textDecoration = 'none';
			}
			
		}
		else if (element == 'color')
		{
			textstyle.style.color = document.adminkute_chatbox.ccolor.value;
			document.adminkute_chatbox.upcolor.value = document.adminkute_chatbox.ccolor.value;;
		}


	}
	function validate()
	{
		//if(document.adminkute_chatbox.text.value=='')
		//{
		//	alert("Bạn chưa nhập nội dung");
		//	document.adminkute_chatbox.text.focus();
		//	return false;
		//}	
		if(document.adminkute_chatbox.text.value.length>255)
		{
			alert("Nội dung ko được dài quá 255 ký tự");
			document.adminkute_chatbox.text.value = document.adminkute_chatbox.text.value.substring(0,255);
			document.adminkute_chatbox.text.focus();
			return false;
		}
	}
	
	function smiliepopup()
	{
		window.open("?adminkute_smilies", "", "location=no,scrollbars=yes,width=500,height=500");
	}
