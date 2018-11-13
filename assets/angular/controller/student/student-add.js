(function() {
    'use strict';
    angular
        .module('schoolApp')
        .filter('propsFilter', propsFilter)
        .controller('StudentDetails', StudentDetails)
        .directive('fileUpload',fileUpload)
        .directive("tabClick",tabClick)
        .factory('StudentService', StudentService);
        
        function propsFilter() {
            return filter;
            function filter(items, props) {
                var out = [];

                if (angular.isArray(items)) {
                  items.forEach(function(item) {
                    var itemMatches = false;

                    var keys = Object.keys(props);
                    for (var i = 0; i < keys.length; i++) {
                      var prop = keys[i];
                      var text = props[prop].toLowerCase();
                      if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
                        itemMatches = true;
                        break;
                      }
                    }

                    if (itemMatches) {
                      out.push(item);
                    }
                  });
                } else {
                  // Let the output be the input untouched
                  out = items;
                }

                return out;
            };
        }
        
        angular.module('schoolApp').requires.push('ui.select');

        StudentDetails.$inject = ['$scope', '$http', '$filter','StudentService','$mdDateLocale'];
        function StudentDetails($scope, $http, $filter,StudentService,$mdDateLocale) {
            var vm = $scope;
            vm.StudentService = StudentService;
            vm.rowCollectionStudet = [];
            vm.student_add = {};
            vm.parent_add = {};
            vm.formValidation = false;
            vm.isLoading = false;
            vm.AjaxRequestStatus = '';
            vm.AjaxRequestCode = '';
            vm.student_add.admission_date = '';
            vm.today = new Date();
            vm.addNewStudentSubmission = addNewStudentSubmission;
            vm.addNewParentSubmission = addNewParentSubmission;
            vm.student_add.customs = {};
            vm.student_add.country = '';
            vm.student_add.student_category = '1';
            vm.student_add.first_name = '';
            vm.student_add.middle_name = '';
            vm.student_add.last_name = '';
            vm.student_add.roll_number = '';
            vm.student_add.class = '';
            vm.student_add.dob = '';
            vm.student_add.gender = '';
            vm.student_add.blood_group = '';
            vm.student_add.birth_place = '';
            vm.student_add.language = '';
            vm.student_add.religion = '';
            vm.student_add.nationality = '';
            vm.student_add.is_handicapped = 'No';
            vm.student_add.password = 'Welcome@123';
            vm.student_add.address = '';
            vm.student_add.state = '';
            vm.student_add.city = '';
            vm.student_add.pincode = '';
            vm.student_add.mobile = '';
            vm.student_add.email = '';
            
            vm.getStates = getStates;
            vm.getCities = getCities;
            vm.getPStates = getPStates;
            vm.getPCities = getPCities;
            vm.form = {};
            vm.form.states = [];
            vm.form.cities = [];
            vm.form.p_states = [];
            vm.form.p_cities = [];
            vm.form.relation = ['Father','Mother','Others'];
            vm.parent_search = {};
            vm.parent_search.sibiling = {};
            vm.parent_search.sibiling.selected = '';
            vm.parent_search.name = {};
            vm.parent_search.name.selected = '';
            
            vm.parent_search.email = {};
            vm.parent_search.email.selected = '';
            vm.parent_search.name = {};
            vm.parent_search.name.selected = '';
            vm.student_name = [];
            vm.parent_name = [];
            vm.parent_mobile = [];
            vm.parent_email = [];
            vm.assign_parent_list = {};
            
            vm.parent_add.country = '';
            vm.parent_add.first_name = '';
            vm.parent_add.last_name = '';
            vm.parent_add.dob = '';
            vm.parent_add.gender = '';
            vm.parent_add.password = 'Welcome@123';
            vm.parent_add.address = '';
            vm.parent_add.state = '';
            vm.parent_add.city = '';
            vm.parent_add.pincode = '';
            vm.parent_add.mobile = '';
            vm.parent_add.email = '';
            vm.assigned_parent_list = [];
            
            vm.$watch('student_add.admission_date',function(newVal,oldVal){
                if(newVal !== oldVal){
                    //vm.student_add.admission_date = $filter('date')(vm.student_add.admission_date,"mediumDate");
                }
            });
            
            vm.refreshSibilings = function(name) {
                try{
                var params = {name: name};
                return StudentService.getStudentList(params).then(function (resp) {
                        vm.student_name = resp.items;
                    });
                }catch(err){
                    vm.student_name = [];
                    console.log(err);
                }
            };
            
            vm.refreshParentName = function(name) {
                try{
                var params = {name: name};
                return StudentService.getParentsList(params).then(function (resp) {
                        vm.parent_name = resp.items;
                    });
                }catch(err){
                    vm.parent_name = [];
                    console.log(err);
                }
            };
            
            vm.refreshParentMobile = function(mobile) {
                try{
                var params = {mobile: mobile};
                return StudentService.getParentsList(params).then(function (resp) {
                        vm.parent_mobile = resp.items;
                    });
                }catch(err){
                    vm.parent_mobile = [];
                    console.log(err);
                }
            };
            
            vm.refreshParentEmail = function(email) {
                try{
                var params = {email: email};
                return StudentService.getParentsList(params).then(function (resp) {
                        vm.parent_email = resp.items;
                    });
                }catch(err){
                    vm.parent_email = [];
                    console.log(err);
                }
            };
            
            function addNewStudentSubmission(){
                vm.formValidation = true;
                if(vm.addStudentForm.$valid){
                    try{
                        vm.isLoading = true;
                        var file = $scope.studentPhoto;
                        StudentService.AddNewStudent(vm.student_add,file).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = resp.message;
                            vm.AjaxRequestCode = resp.code;
                            if(resp.code == '200'){
                                window.open('edit-student/parent/'+resp.items,'_blank');
                            }
                        });
                    }catch(err){
                        vm.isLoading = false;
                        vm.AjaxRequestStatus = '';
                        vm.AjaxRequestCode = '';
                        console.log(err);
                    }
                vm.formValidation = false;
                }
                return false;
            }
            
            function addNewParentSubmission(){
                vm.formValidation = true;
                if(vm.AddParentForm.$valid){
                    try{
                        vm.isLoading = true;
                        StudentService.addNewParent(vm.parent_add).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = resp.message;
                            vm.AjaxRequestCode = resp.code;
                        });
                    }catch(err){
                        vm.isLoading = false;
                        vm.AjaxRequestStatus = '';
                        vm.AjaxRequestCode = '';
                        console.log(err);
                    }
                vm.formValidation = false;
                }
                return false;
            }
            
            function getStates(){
                try{
                    StudentService.getStates(vm.student_add.country).then(function (resp) {
                        vm.isLoading = false;
                        vm.student_add.state = '';
                        vm.student_add.city = '';
                        vm.form.states = resp.items;
                    }.bind());
                }catch(err){
                    vm.isLoading = false;
                    vm.form.states = [];
                    console.log(err);
                }
            }
            
            function getCities(){
                try{
                    StudentService.getCities(vm.student_add.state).then(function (resp) {
                        vm.isLoading = false;
                        vm.student_add.city = '';
                        vm.form.cities = resp.items;
                    }.bind());
                }catch(err){
                    vm.isLoading = false;
                    vm.form.cities = [];
                    console.log(err);
                }
            }
            
            function getPStates(){
                try{
                    StudentService.getStates(vm.parent_add.country).then(function (resp) {
                        vm.isLoading = false;
                        vm.parent_add.state = '';
                        vm.parent_add.city = '';
                        vm.form.states = resp.items;
                    }.bind());
                }catch(err){
                    vm.isLoading = false;
                    vm.form.states = [];
                    console.log(err);
                }
            }
            
            function getPCities(){
                try{
                    StudentService.getCities(vm.parent_add.state).then(function (resp) {
                        vm.isLoading = false;
                        vm.parent_add.city = '';
                        vm.form.cities = resp.items;
                    }.bind());
                }catch(err){
                    vm.isLoading = false;
                    vm.form.cities = [];
                    console.log(err);
                }
            }
            
            function getStatusVal(data,Student_id) {
                StudentService.UpdateStudentStatus(Student_id,data).then(function (resp) {
                    vm.isLoading = false;
                }.bind());
            };

    }
        
    function StudentService($http,$rootScope) {
        var dataObj = {
            getStates: getStates,
            getCities: getCities,
            UpdateStudentStatus:UpdateStudentStatus,
            DeleteStudentDetails : DeleteStudentDetails,
            getStudentList : getStudentList,
            getParentsList : getParentsList,
            AddNewStudent : AddNewStudent,
            addNewParent : addNewParent,
        };
        
        function AddNewStudent(data,file) {
            var file_data = new FormData();
            file_data.append('file', file);
            angular.forEach(data, function(value, key) {
              file_data.append(key, value);
            });
            return $http({
                method: "POST",
                url: 'api/add-student',
                data: file_data,
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined,'Process-Data': false}
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            }, function(response) {
                console.log(response);
            });
      }
      
    function addNewParent(data) {
            return $http({
                method: "POST",
                url: 'api/add-parent',
                data: data,
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            }, function(response) {
                console.log(response);
            });
      }
        
    function getStudentList(data) {
        return $http({
            method: "POST",
            url: 'api/get_all_student',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
        });
      }
      
      function getParentsList(data) {
        return $http({
            method: "POST",
            url: 'api/get_parents_list',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
        });
      }
        
      function getStates(data) {
        return $http({
            method: "POST",
            url: 'api/get_states_by_country',
            data: {'country_id':data},
            }).then(function (response) {
                console.log(response);
                return response.data;
        });
      }
      
      function getCities(data) {
          return $http({
            method: "POST",
            url: 'api/get_cities_by_state',
            data: {"state_id":data},
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);   
        });
      }
      
      function UpdateStudentStatus(Student_id,status) {
        return $http({
            method: "POST",
            url: 'api/update_student_status',
            data: { "Student_id": Student_id, "status":status }
            }).then(function (response) {
            return response.data;
        }, function(response) {
            console.log(response);   
        });
      }
      
      function DeleteStudentDetails(id){
          return $http({
            method: "POST",
            url: 'api/delete_student',
            data: {"id":id},
            }).then(function (response) {
                return response.data;
        }, function(response) {
            console.log(response);   
        });
      }
      
    return dataObj;
    }
    
    function tabClick(){
        return {
        restrict: 'A',
        controller: 'StudentDetails',
        link: function postLink(scope, elem, attrs, ctrl) {
            elem.on('click', function (evt) {
                scope.formValidation = false;
                scope.$apply(function () {
                    scope.tabs = attrs.tabClick;
                });
            });
        }
    }
    }
    
    
    function fileUpload($parse){
         return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                var model = $parse(attrs.fileUpload);
                var modelSetter = model.assign;
        
                element.bind('change', function(){
                    scope.$apply(function(){
                        modelSetter(scope, element[0].files[0]);
                    });
                });
            }
        };
    }
    
})();
