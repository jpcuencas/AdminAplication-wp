function cambiarcolor(id)
{
	var obj=document.getElementById(id);
	//obtenemos el color seleccionado por el usuario
	var strColorSeleccionado=obj.value;
	document.getElementById(id).value=strColorSeleccionado;
	//seleccionamos la capa que vamos a cambiar de color
	var objCapa = $('#'+id).next();
	
	objCapa.html('');
	//le colocamos el nuevo color de fondo a la capa
	objCapa.css('backgroundColor',strColorSeleccionado)
	//objCapa.style.backgroundColor=strColorSeleccionado;
	//mostramos el codigo del color seleccionado
	//objCapa.innerHTML=strColorSeleccionado;
	objCapa.html(strColorSeleccionado);
	
}
