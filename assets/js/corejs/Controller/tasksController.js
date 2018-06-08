app.controller('TasksCtrl', ['$scope', '$rootScope', '$http', '$mdDialog', '$stateParams', function($scope, $rootScope, $http, $mdDialog, $stateParams) {
    $scope.project_authkey = $stateParams.project ? $stateParams.project : '';

    $scope.tasks = [];
    $scope.getTasks = function(){
        $http({
            method : "POST",
            url : $rootScope.path+"tasks/list-tasks",
            data : {
                project_authkey: $scope.project_authkey
            }
        }).then(function mySuccess(response) {
            if(response.data.status==1) {
                $scope.tasks = response.data.data;
            } else {
                $scope.tasks = [];
            }

        }, function myError(response) {
            $scope.error = response.statusText;
        });
    };
    $scope.getTasks();

    $scope.deleteTask = function(ev, authkey, index) {
        var confirm = $mdDialog.confirm()
            .title('Warning!')
            .textContent('Would you like to delete task?')
            .ariaLabel('delete task')
            .targetEvent(ev)
            .ok('Yes')
            .cancel('No');

        $mdDialog.show(confirm).then(function() {
            $http({
                method : "POST",
                url : $rootScope.path+"tasks/delete-task",
                data : {
                    authkey: authkey
                }
            }).then(function mySuccess(response) {
                if(response.data.status==1) {
                    $scope.tasks.splice(index, 1);
                }
            }, function myError(response) {
                $scope.error = response.statusText;
            });
        }, function() {
        });
    };

    $scope.commentTask = function(ev, authkey, index) {
        var confirm = $mdDialog.prompt()
          .title('Add comment for this task.')
          // .textContent('Bowser is a common name.')
          .placeholder('Add comment')
          .ariaLabel('comment')
          .initialValue('')
          .targetEvent(ev)
          .required(true)
          .ok('Add')
          .cancel('Cancel');

        $mdDialog.show(confirm).then(function(result) {
            $http({
                method : "POST",
                url : $rootScope.path+"tasks/add-comment",
                data : {
                    comment: result,
                    task_authkey: authkey
                }
            }).then(function mySuccess(response) {
                if(response.data.status==1) {
                    
                }
            }, function myError(response) {
                $scope.error = response.statusText;
            });
        }, function() {
        });

    };
}]);

app.controller('TaskCtrl', ['$scope', '$rootScope', '$stateParams', '$http', '$state', '$timeout', function($scope, $rootScope, $stateParams, $http, $state, $timeout) {
    $scope.taskData = {authkey:'', name:'', project_authkey:$stateParams.project};
    $scope.authkey = $stateParams.authkey ? $stateParams.authkey:'';

    if($stateParams.authkey) {
        $http({
            method : "POST",
            url : $rootScope.path+"tasks/task-detail",
            data : {
                authkey: $stateParams.authkey
            }
        }).then(function mySuccess(response) {
            if(response.data.status==1) {
                $scope.taskData = response.data.data;
            }
        }, function myError(response) {
            $scope.error = response.statusText;
        });
    }

    $scope.saveTask = function() {

        if(!$scope.taskForm.$valid) {
            return true;
        }

        $http({
            method : "POST",
            url : $rootScope.path+"tasks/save-task",
            data : $scope.taskData
        }).then(function mySuccess(response) {
            if(response.data.status==1) {
                // $state.go('/tasks');
                history.back();
            }
        }, function myError(response) {
            $scope.error = response.statusText;
        });
    }
    
}]);