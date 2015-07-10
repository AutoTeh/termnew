	function FullTabel(Flag) {	if (Flag.checked){
		tf2.paging = false;
        tf2.RemovePaging();
		tf2.RefreshGrid();
		} else {
		tf2.AddPaging(true);
		tf2.RefreshGrid();
    }
	}
	function ReceiveTabelFilterID(ID, NameTabel, NameTabelHead, Field) {
		$.ajax({
		  cache: false,
		  type: 'POST',
		  url: '/' + NameTabel + '/filterid',
		  data: {'searchfild':Field,
				 'searchtable':NameTabelHead,
		  		 'search':ID},
		  dataType:	'html',
		  success: function(data){           var Temp = data != '<br>' ? data : '<br><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Нет данных в БД</div>';
		    $('.' + NameTabelHead + '_' + ID).html(Temp);
		  }
		});
	}

	function clean(NameTabelHead) {
		    $('.' + NameTabelHead).html('');
	}

	function editselect(response, Name){            if (response != ""){            	resp_obj = JSON.parse(response);				if(typeof resp_obj.area != 'undefined') {$('.controls_' + Name + '_area').html(resp_obj.area);}
				if(typeof resp_obj.city != 'undefined') {$('.controls_' + Name + '_city').html(resp_obj.city);}
				if(typeof resp_obj.city_area != 'undefined') {$('.controls_' + Name + '_city_area').html(resp_obj.city_area);}
				if(typeof resp_obj.locality != 'undefined') {$('.controls_' + Name + '_locality').html(resp_obj.locality);}
				if(typeof resp_obj.street != 'undefined') {$('.controls_' + Name + '_street').html(resp_obj.street);}
				if(typeof resp_obj.add_area != 'undefined') {$('.controls_' + Name + '_add_area').html(resp_obj.add_area);}
				if(typeof resp_obj.street_add_area != 'undefined') {$('.controls_' + Name + '_street_add_area').html(resp_obj.street_add_area);}
			} else {				var flag = false;
				var myArray = [ "region", "area", "city", "city_area", "locality", "street", "add_area", "street_add_area" ];
				for(var i = 0; i < myArray.length; i++)
				{
					 if (flag == true) $('.controls_' + Name + '_' + myArray[i]).html('<select name=""><option value=""></option></select>');					 if (myArray[i] ==	'region') flag = true;
				}
			}
	}

	function get_address(ID, Page, Name){
		$.ajax({
		    url: '/address/' + Page,
		    type: "post",
		    data: {'search': ID,
		    	   'NameField': Name},
		    dataType: "html",
		    success: function(response){
		    	editselect(response, Name);
		    }
		});
	}

	function get_View(ID, Page){
		$.ajax({
		    url: '/' + Page + '/View',
		    type: "post",
		    data: {'id': ID},
		    dataType: "html",
		    success: function(response){
		    	$('.modal-body').html(response);
		    	$('#myModal').modal({
				  keyboard: false
				});
		    }
		});
	}

	function get_Flt(Page, NumPage){		if (NumPage === undefined || NumPage < 0) {
		    NumPage = 1;
		}
		document.getElementById("load").setAttribute('class', "loading");
		//$("#head").slideUp();
		//var Tbody = document.getElementById('head').getElementsByTagName('tbody')[0];
		//var Trow = Tbody.getElementsByTagName("tr")[0];
		//Trow.getElementsByTagName("td")[0].innerHTML = '<span class="loading">';
		//Trow.getElementsByTagName("td")[0].bgColor ='#FFFFFF';
		//Tbody.innerHTML = '';
		//Tbody.appendChild(Trow);
		var flt = $("input[id=Flt]");
		var myArray = {};
		for(var i = 0; i < flt.length; i++)
		{
			if (flt[i].value !== '') myArray[flt[i].name] = flt[i].value;
		}

		$.ajax({
		    url: '/' + Page + '/Filter/' + NumPage,
		    type: "post",
		    data: {'Flt': myArray},
		    dataType: "html",
		    success: function(response){		    	document.getElementById('head').getElementsByTagName('tbody')[0].innerHTML = response;
		    	document.getElementById("load").setAttribute('class', "");
		    	//$("#head").slideDown();
		    }
		});
		return false;
	}

	function get_Flt_arr(ID, Page){		$.ajax({
		    url: '/' + Page + '/FilterArr',
		    type: "post",
		    data: {'id': ID, 'Flt': $("input[id=Flt]").map(function(){return $(this).val();}).get()},
		    dataType: "html",
		    success: function(response){
		    	$('#Select_' + ID).html(response);

		    }
		});
		return false;
	}