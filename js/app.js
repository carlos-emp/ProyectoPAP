(function() {
	listdata = [];
	lisColor = ["#3C8DBC","#36936F","#3F6AAE","#00a65a","#3C8DBC","#36936F","#3F6AAE","#00a65a"];
	positionColor=0;
	'use strict';
	var todosPAP = {};
	var module = angular.module('app', ['onsen']);

	module.controller('AppController', function($scope, $data) {
		$scope.doSomething = function() {
			setTimeout(function() {
				alert('' + device.uuid);
			}, 100);
		};
	});

	module.factory('$data', function() {
		var data = {};

		data.items = todosPAP;

		return data;
	});

	/*constructor metodo principa*/
	module.controller('initializeApp', function($scope, $data, $http) {



			$(document).ready(function(){
			    $('[data-toggle="tooltip"]').tooltip();   
			});
		/*muestra ventana para crear proyecto*/
		$scope.CreateProyect = function(id) {
			selectData("create-Proyect");
		}
		/*muestra ventana para ve proyecto*/
		$scope.Show_Proyect = function(e) {
			selectData("view-proyect");
		}
		/*muestra los datos del proyecto pap*/
		$scope.ViewPAP = function() {
			/*$("#myModal").attr("style","padding-left:0px;display:block");*//*quito el borde*/
			showData();
			selectData("View_Project_Data");
		}
		//mostrar los proyectos al inicio
		$scope.Show_Proyect();
		hide();

		$http.get('http://www.empowerlabs.com/intellibanks/data/Sandbox/CarlosVazquez/proyectPAP/php/get_planes.php').success(function(data, status, headers, config) {

			for (var i = 0; i < data.length; i++) {
				listdata.push(data[i]);
			};

		}).error(function(data, status, headers, config) {

		});

	});

})();

/*funcion para seleccionar un metodo*/
function selectData(class_) {
	/*primero quito a los demas menus el evento active para que no se ponga doble*/
	$("li.treeview.active").removeClass("active");
	/*muestro la nueva selección*/
	$("." + class_).addClass("active")
	/*esconde los contenedores*/
	$(".High_Project").addClass("hide");
	$(".View_Project").addClass("hide");
	$(".View_Project_Data").addClass("hide");

	$("." + $("." + class_).attr("data-content")).removeClass("hide");
	if ($(".sidebar-open").length == 1) {
		$(".sidebar-toggle").click();
	}

}

/*metodo get http://www.empowerlabs.com/intellibanks/data/Sandbox/CarlosVazquez/parametros.php?prefijo=PAP-E&longitud=10*/

/*muestra los datos del proyecto PAP*/
function showData() {
	/*se limpian todos los datos*/
	var contentInyect = $(".showDataPap");
	contentInyect.html("");
	if (listdata.length > 0) {
		listdata.forEach(function(item_) {
			inyectWithEvent(contentInyect, item_);
		});
	}
}

/*funcion para inyectar con un evento click*/
function inyectWithEvent(contentInyect, item_) {
	var inyectData = '<div class="conten-result title-table " ">' + 
                     	'<span class="item-data fondoAzul colorBlanco click-more  glyphicon glyphicon-chevron-down" data-id="' + item_.ID + '" style="text-align: left;width: 100% !important;" title="Estrategias/Acciones" data-toggle="tooltip">' + '' + item_.Title + ' </span>' +    
                        '<span class="item-data center-data" title="Área" data-toggle="tooltip"> ' + item_.Harea + ' </span>' + 
                        '<span class="item-data center-data" title="Responsable" data-toggle="tooltip"> '+ item_.Pilot +' </span>' + 
                        '<span class="item-data center-data" title="Encargado Ahora" data-toggle="tooltip"> ' + item_.Player_Now.replace('Main.',' ').trim() + ' </span>' + 
                        '<span class="item-data center-data" title="Estatus" data-toggle="tooltip"> ' + item_.Status + '</span>' + 
                        '<span class="item-data center-data" title="% Avance" data-toggle="tooltip"> ' + item_.PercentComplete + '%</span>' + 
                        '<span class="item-data center-data" title="Tiempo" data-toggle="tooltip"> ' + item_.Timing + '</span>' + 
                        '<span class="item-data center-data" title="Fecha Inicio" data-toggle="tooltip"> ' + item_.StartDate + '</span>' + 
                        '<span class="item-data center-data" title="Fecha Término" data-toggle="tooltip"> ' + item_.TargetCloseDate + '  </span>' + 
                        '<span class="item-data center-data" title="Prioridad" data-toggle="tooltip"> ' + item_.Priority + '  </span>' + 
                    '</div>'+
                      '<div class="hide ' + item_.ID + '">' + 
                        
                       '</div>';
	contentInyect.append(inyectData);
	var eventClick = $(contentInyect.children()[contentInyect.children().length - 2]).find(".click-more");
	clickMoreData(eventClick);
}

function clickMoreData(eventClick) {

	eventClick.click(function() {
		var nameTxt = $(this).attr("data-id");
		/*obtengo el id del archivo*/
		var contentSun = $("." + nameTxt);
		positionColor=0;
		var getObject = getChildren(nameTxt);
		/*obtengo los hijos*/
		renderSun(getObject, contentSun);
		/*tengo que mandar a renderear los datos*/
		// inyectWithEvent(contentSun,getObject);
		/*solo es para mostrar o no mostrar el contenedor de los hijos*/
		if (contentSun.hasClass("hide")) {
			contentSun.removeClass("hide");
		} else {
			contentSun.addClass("hide");
		}

	});
}

function renderSun(RenderSun, contentSun) {
	contentSun.html("");
	if (RenderSun != null) {
		RenderSun.forEach(function(item_) {


			var inyectData = '<div  class=" conten-result " "> ' + 
                          '<div class="item-data  colorBlanco glyphicon glyphicon-chevron-down click-more" data-id="' + item_.ID + '" style="text-align: left;width: 100% !important; background-color:'+lisColor[positionColor]+';" title="Estrategias/Acciones" data-toggle="tooltip" >' + '' + item_.Title + ' </div>' + 
                          '<div class="item-data center-data" title="Área" data-toggle="tooltip"> ' + item_.Harea + '</div>' + 
                          '<div class="item-data center-data" title="Responsable" data-toggle="tooltip"> '+ item_.Pilot +' </div>' + 
                          '<div class="item-data center-data" title="Encargado Ahora" data-toggle="tooltip"> ' + item_.Player_Now.replace('Main.',' ').trim() + ' </div>' + 
                          '<div class="item-data center-data" title="Estatus" data-toggle="tooltip"> ' + item_.Status + '</div>' + 
                          '<div class="item-data center-data" title="% Avance" data-toggle="tooltip"> ' + item_.PercentComplete + '%</div>' + 
                          '<div class="item-data center-data" title="Tiempo" data-toggle="tooltip"> ' + item_.Timing + '</div>' + 
                          '<div class="item-data center-data" title="Fecha Inicio" data-toggle="tooltip"> ' + item_.StartDate + '</div>' + 
                          '<div class="item-data center-data" title="Fecha Término" data-toggle="tooltip"> ' + item_.TargetCloseDate + '  </div>' + 
                          '<div class="item-data center-data" title="Prioridad" data-toggle="tooltip"> ' + item_.Priority + '  </div>' + 

                        '</div>' + 
                        '<div class="hide ' + item_.ID + '"></div>';

			contentSun.append(inyectData);
			var eventClick = $(contentSun.children()[contentSun.children().length - 2]).find(".click-more");
			clickMoreData(eventClick);

		});
	}

}

/*método para obtener los hijos de un id proporcionado*/
function getChildren(id_) {
	SearchID = id_/*guardo el id en una variable remporal*/
	Object_ = null;
	
	/*obejto que me dira cual son los hijos*/
	for (var i = 0; i < listdata.length; i++) {/*recorro todos los padres*/
		positionColor++;
		Object_ = searchParent(listdata[i], SearchID);
		if (Object_ != null) {
			break;
		}
	};

	return Object_;
}

/*metodo para hacer de forma recursiva la busqueda*/
/*tengo el parameteo i
 * itemParent_ es el padre princiapl
 * SearchID es el id que busco
 */
function searchParent(itemParent_, SearchID) {
	Object_ = null;
	
	if (SearchID === itemParent_.ID)/*comparo si es igual al id del padre entonces regreso los hijos*/
	{
		return itemParent_.Hijos;
	} else {/*si no entonces checa con los hijos*/
		if ( typeof (itemParent_.Hijos) != "undefined")/*para buscar en los hijo checa que esten definidos */
		{
			positionColor++;
			/*checa los hijos de forma recursiva*/
			for (var i = 0; i < itemParent_.Hijos.length; i++) {
				Object_ = searchParent(itemParent_.Hijos[i], SearchID)
				if (Object_ != null) {
					break;
				}
			};
		}
	}
	return Object_;

}

function hide() {
	setTimeout(function() {
		$(".carga").hide('fade', {}, 500)
	}, 1500);
}
