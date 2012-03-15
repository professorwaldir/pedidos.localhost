function chamaFiltro(action,param) {
	
	var controller = document.getElementById('controller').value;
	if (!controller) {
		alert('Escolha a qual sessão pesquisar');
		return false;
	}
	var data =  document.getElementById('filtro').value;
	window.location = '/admin/'+controller+'/'+action+'/'+param+'/'+data;	
}