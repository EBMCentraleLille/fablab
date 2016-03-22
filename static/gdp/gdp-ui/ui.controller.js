var uiModule = require('./_index');

uiModule.controller('uiController',['$scope','rq','toastr',uiController]);

function uiController($scope,rq,toastr) {
    $scope.newTask = {
        'title':'',
        'body':''
    }

    $scope.tasks=[
        {
            "name":"fait",
            "data":['Tâche 1','Tâche 2','Tâche 3'],
            "space":1
        },
        {
            "name":"à faire",
            "data":['4','5','6'],
            "space":2
        },
        {
            "name":"en cours",
            "data":['7','8','9'],
            "space":3
        }
    ]

    $scope.spaceData=[{},{},{}];



    $scope.taskCreateShow=false;


    $scope.currentProject={
        'id':3,
        'name':'projet_test'
    }


    $scope.onDropTaskInList = function(data,taskgroup) {
        data = data['json/task'];
        if(!data) return;
        taskgroup.data.push(data.name)
        $scope.tasks[data.sourceGroup].data.splice(data.sourceTask,1);
    }

    $scope.onDragOver = function(data,taskgroup) {
    }

    $scope.createTask = createTask;


    (function() {
        //getTasks()

        for(var t in $scope.tasks) {
            var taskgroup = $scope.tasks[t];
            $scope.spaceData[taskgroup.space-1]=taskgroup;
        }
        console.log($scope.spaceData)
    })();


    function createTask() {
        rq.createTask($scope.currentProject.id,$scope.newTask,function() {
            $scope.taskCreateShow=false;
            toastr.success(['Task',$scope.newTask.title,'created!'].join(" "));
            $scope.newTask = {'title':'','body':''};
            getTasks();
        })
    }

    function getTasks() {
        rq.getTasks($scope.currentProject.id,function(res) {
            $scope.tasks=res.data;
        })
    }
}