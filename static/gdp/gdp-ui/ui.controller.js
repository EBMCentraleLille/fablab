var uiModule = require('./_index');

uiModule.controller('uiController',['$scope','rq',uiController]);

function uiController($scope,rq) {
    $scope.newTask = {
        'title':'',
        'body':''
    }

    $scope.currentProject={
        'id':1,
        'name':''
    }

    $scope.createTask = createTask;


    (function() {
    })();


    function createTask() {
        rq.createTask($scope.currentProject.id,$scope.newTask,function() {
            console.log('task created');
            console.log($scope.newTask);
        })
    }

}