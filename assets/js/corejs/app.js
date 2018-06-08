
var app = angular.module('TestApp', ['ngCookies', 'ui.router', 'ngMaterial', 'ngMessages', 'material.svgAssetsCache'])
app.config(['$stateProvider', '$urlRouterProvider', '$locationProvider',
    function($stateProvider, $urlRouterProvider, $locationProvider) {

        $urlRouterProvider.otherwise('/login');

        $stateProvider
            .state('/login', {
                url: '/login',
                templateUrl: 'views/login.html',
                controller: 'LoginCtrl',
                currentPage:'login'
            })
            .state('/projects', {
                url: '/projects',
                templateUrl: 'views/projects.html',
                controller: 'ProjectsCtrl',
                currentPage:'projects'
            })
            .state('/project/:authkey', {
                url: '/project/:authkey',
                templateUrl: 'views/project.html',
                controller: 'ProjectCtrl',
                currentPage:'projectEdit'
            })
            .state('/project', {
                url: '/project',
                templateUrl: 'views/project.html',
                controller: 'ProjectCtrl',
                currentPage:'projectNew'
            })
            .state('/tasks/:project', {
                url: '/tasks/:project',
                templateUrl: 'views/tasks.html',
                controller: 'TasksCtrl',
                currentPage:'tasks'
            })
            .state('/task/:project/:authkey', {
                url: '/task/:project/:authkey',
                templateUrl: 'views/task.html',
                controller: 'TaskCtrl',
                currentPage:'taskEdit'
            })
            .state('/task/:project', {
                url: '/task/:project',
                templateUrl: 'views/task.html',
                controller: 'TaskCtrl',
                currentPage:'taskNew'
            });

        $locationProvider.html5Mode(true).hashPrefix('');
}]);


app.run(['$rootScope', '$cookies', '$state', '$http', '$timeout', '$transitions', '$stateParams', function($rootScope, $cookies, $state, $http, $timeout, $stateParams ) {
    if($rootScope.userdata === undefined) {
        $state.go('login');
    }
    if ($rootScope.userdata === undefined && $cookies.get('userdata') !== undefined) {
        $rootScope.userdata = JSON.parse($cookies.get('userdata'));
    }
    
    $rootScope.pagepath = window.location.pathname.split('/')[2];

    $rootScope.imagePath = 'assets/images/';
    $rootScope.path = 'api/web/v1/';

    /*$transitions.onSuccess( { to: '*', from: '*' }, function($state) {
        // console.log('onSuccess');
        $rootScope.currentPage = "";
        if ($state.$current.currentPage !== undefined) {
            $rootScope.currentPage = $state.$current.currentPage;
        }
        // $state.go('/projects');
    });*/
}]);


