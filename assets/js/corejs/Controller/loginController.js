app.controller('LoginCtrl', ['$scope', '$rootScope', '$stateParams', '$http', '$state', '$timeout', '$cookies', function($scope, $rootScope, $stateParams, $http, $state, $timeout, $cookies) {

    
    $scope.userData = {email:'test@gmail.com', password:'123456'};
    $scope.submited = 0;
    $scope.checkLogin = function() {
        $scope.submited = 1;

        if(!$scope.loginForm.$valid) {
            return true;
        }

        $http({
            method : "POST",
            url : $rootScope.path+"login/check-login",
            data : $scope.userData
        }).then(function mySuccess(response) {
            if(response.data.status==1) {
                $cookies.put('userdata', JSON.stringify(response.data.data));
                $rootScope.userdata = response.data.data;
                $state.go('/projects');
            }
        }, function myError(response) {
            $scope.error = response.statusText;
        });
    }
    
    $scope.reset = function() {
        $scope.userData = {email:'', password:''};
    }

    $scope.logout = function() {
        data = {
            authkey: $rootScope.userdata.authkey,
        }
        $http({
            method: "post",
            url: path + 'login/logout',
            data: data
        }).then(function mySucces(response) {
            if (response.data) {
                $cookies.put('userdata', '');
                $state.go('/login');
            }
        });
        
    }
}]);