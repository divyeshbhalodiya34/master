app.controller('ProjectsCtrl', ['$scope', '$rootScope', '$http', '$mdDialog', function($scope, $rootScope, $http, $mdDialog) {

    $scope.projects = [];
    $scope.getProjects = function(){
        $http({
            method : "POST",
            url : $rootScope.path+"projects/list-projects"
        }).then(function mySuccess(response) {
            if(response.data.status==1) {
                $scope.projects = response.data.data;
            } else {
                $scope.projects = [];
            }

        }, function myError(response) {
            $scope.error = response.statusText;
        });
    };
    $scope.getProjects();

    $scope.deleteProject = function(ev, authkey, index) {
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
                url : $rootScope.path+"projects/delete-project",
                data : {
                    authkey: authkey
                }
            }).then(function mySuccess(response) {
                if(response.data.status==1) {
                    $scope.projects.splice(index, 1);
                }
            }, function myError(response) {
                $scope.error = response.statusText;
            });
        }, function() {
        });
    };
}]);

app.controller('ProjectCtrl', ['$scope', '$rootScope', '$stateParams', '$http', '$state', '$timeout', function($scope, $rootScope, $stateParams, $http, $state, $timeout) {

    $scope.projectData = {authkey:'', name:''};
    $scope.authkey = $stateParams.authkey ? $stateParams.authkey:'';

    if($stateParams.authkey) {
        $http({
            method : "POST",
            url : $rootScope.path+"projects/project-detail",
            data : {
                authkey: $stateParams.authkey
            }
        }).then(function mySuccess(response) {
            if(response.data.status==1) {
                $scope.projectData = response.data.data;
            }
        }, function myError(response) {
            $scope.error = response.statusText;
        });
    }

    $scope.saveProject = function() {

        if(!$scope.projectForm.$valid) {
            return true;
        }

        $http({
            method : "POST",
            url : $rootScope.path+"projects/save-project",
            data : $scope.projectData
        }).then(function mySuccess(response) {
            if(response.data.status==1) {
                $state.go('/projects');
            }
        }, function myError(response) {
            $scope.error = response.statusText;
        });
    }
    
}]);