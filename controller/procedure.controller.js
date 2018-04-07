(function () {
    'use strict';
    angular
        .module('app')
        .controller('ProcedureController', ProcedureController);

    ProcedureController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location','$sce'];
    function ProcedureController($cookieStore,UserService, $rootScope, $scope,$http,$location,$sce) {
        var vm = this;
        $scope.catMenu=""
        $scope.proMenu=""
        initController();

        function initController() {

            var param = JSON.stringify({});
                $http({
                    url: getListing,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    $scope.bodyParts = data.data['bodyParts'];
                    $scope.category = data.data['category'];
                    UserService.setBodyParts(data.data['bodyParts']);
                    UserService.setCategoryList(data.data['category']);
                    createMenu(data.data['bodyParts'],data.data['category'],'5aaef3ed54fcd32f8205f9cf')
                }).error(function (data, status, headers, config) {
                    console.log("error")
                   
                });
        }

        
        $scope.clicked = function(val) {
            var parts = UserService.getBodyParts()
            for (var x in parts){
                if (parts[x].name.toString() == val.toString()){
                    alert(parts[x].name);
                    alert(val);
                    UserService.setDotClicked(parts[x].id);
                }
            }
            // console.log(UserService.getDotClicked());
            createMenu(UserService.getBodyParts(),UserService.getCategoryList(),UserService.getDotClicked())
        };

        $scope.procedureClicked = function() {
            $('.modal-backdrop').remove();
            $('.dropdown-backdrop').remove();
            $('#myModal').modal('hide');
            var e = document.getElementById("selProc");
            UserService.setProcedureId(e.value);
            $location.path('/select');
            // createMenu(UserService.getBodyParts(),UserService.setCategoryList,UserService.getDotClicked())
        };

        function createMenu(body,category,selected){
            var bodyMenu = ''
            var catMenu = ''
            bodyMenu=bodyMenu+'<select class="form-control" id="selBody" style="width:100%;">'
            catMenu=catMenu+'<select class="form-control" id="selProc" style="width:100%;">'

            for(var key in category){
                var checked = 0
                // console.log(category[key]["name"]);
                if (category[key]["body_part"] != selected){
                    bodyMenu = bodyMenu+'<option>'+category[key]['name']+'</option>';
                }else{
                    if(checked==0){
                        checked=1;
                        bodyMenu = bodyMenu+'<option selected>'+category[key]['name']+'</option>';
                    }else{
                        bodyMenu = bodyMenu+'<option>'+category[key]['name']+'</option>';
                    }
                    bodyMenu=bodyMenu+'<option>'+category[key]["name"]+'</option>';
                    var procedureCat = category[key]["procudure"]
                    for(var value in procedureCat){
                        catMenu=catMenu+'<option value='+procedureCat[value]["id"]+'>'+procedureCat[value]["name"]+'</option>';
                    }
                    
                }
            }



            bodyMenu=bodyMenu+'</select>'
            catMenu=catMenu+'</select>'
            $scope.bodyFMenu=$sce.trustAsHtml(bodyMenu);
            $scope.catFMenu=$sce.trustAsHtml(catMenu);
        
        }
        
    }

})();
