function showsubmenu(id){
	submenu=document.getElementById('s'+id);
	for(i=1;i<9;i++){
		if(i==id){
			submenu.style.display="block";
		} else{
			document.getElementById('s'+i).style.display="none";
		}
	}
}

function formValidation(form){
	if(notEmpty(form.business)){
		if(notEmpty(form.company)){
			if(notEmpty(form.ints)){
				if(notEmpty(form.name)){
					if(notEmpty(form.name2)){
						if(notEmpty(form.country)){
							if(notEmpty(form.countrycode)){
								if(notEmpty(form.areacode)){
										if(notEmpty(form.number)){
											if(notEmpty(form.email)){
												if(notEmpty(form.checkbox)){
												return true;
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	return false;
}

function notEmpty(elem){
	var str = elem.value;
	if(str.length == 0){
		alert("You must fill in all required fields (*)");
		return false;
	} else {
		return true;
	}

}