/*$(document).ready(function(){
  $("#submit").click(function(){
	musicName = $("#musicName").val();
	//alert(musicName);
  htmlobj=$.ajax({url:"baiduMusic.php?q=" + musicName,async:false});
  $("#link").html(htmlobj);
  });
});*/

function showLink() {
	var musicName;
	musicName = document.getElementById("musicName").value;
	
	var xmlhttp;

	if (String(musicName).length == 0) {
		alert("请输入歌曲名称再继续搜索！");
		return;
	} else {
		//alert(musicName);
		if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else { // code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("link").innerHTML = xmlhttp.responseText;
				/*var arr = document.getElementsByClassName("dl");
				for(var i = 0; i < arr.length; i++){
					arr[i].href = arr[i].data;
				}*/
				
			}
		}
		xmlhttp.open("GET", "baiduMusic.php?q=" + String(musicName), false);
		xmlhttp.send();
	}

	return false;

}