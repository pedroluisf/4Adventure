function logoover(){
	while(true){
		document.getElementById('logotipo').width = document.getElementById('logotipo').width + 6
		document.getElementById('logotipo').heigth = document.getElementById('logotipo').heigth + 6
		if (document.getElementById('logotipo').width > 290) { break;}
	}
}
function logoout(){
	while(true){
		document.getElementById('logotipo').width = document.getElementById('logotipo').width - 6
		document.getElementById('logotipo').heigth = document.getElementById('logotipo').heigth - 6
		if (document.getElementById('logotipo').width < 252) { 
			document.getElementById('logotipo').width = 252
			document.getElementById('logotipo').heigth = 136
			break;
		}
	}
}
