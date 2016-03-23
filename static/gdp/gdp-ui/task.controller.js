var uiModule = require('./_index');

uiModule.controller('taskController',['$scope','rq','toastr',taskController]);

function taskController($scope,rq,toastr) {
    $scope.newTask = {
        'title':'',
        'body':''
    }

    $scope.selectedDay = Date.today()

    /* Temporary */

    $scope.onDragOver = function(data,taskgroup) {
    }

    $scope.tasks=[
        {
            "name":"fait",
            "data":[],
            "space":1
        },
        {
            "name":"à faire",
            "data":[],
            "space":2
        },
        {
            "name":"en cours",
            "data":[],
            "space":3
        }
    ]

    $scope.spaceData=[{},{},{}];

    $scope.taskCreateShow=false;


    $scope.currentProject={
        'id':3,
        'name':'projet_test'
    }

    /* Scope functions */

    $scope.createTask = createTask;
    $scope.deleteTask=deleteTask;
    $scope.onDropTaskInList=dropTaskInList;

    /* Init */

    (function() {
        getTasks()

        for(var t in $scope.tasks) {
            var taskgroup = $scope.tasks[t];
            $scope.spaceData[taskgroup.space-1]=taskgroup;
        }
        console.log($scope.spaceData)
    })();

    /* Controller functions */

    function createTask() {
        rq.createTask($scope.currentProject.id,$scope.newTask,function() {
            $scope.taskCreateShow=false;
            toastr.success(['Task',$scope.newTask.title,'created!'].join(" "));
            $scope.newTask = {'title':'','body':''};
            getTasks();
        })
    }

    function deleteTask(id,title) {
        rq.deleteTask(id,function(res) {
            toastr.success(['Task',title,'has been removed.'].join(" "));
            getTasks();
        });
    }

    function dropTaskInList(data,taskgroup) {
        data = data['json/task'];
        if(!data) return;
        taskgroup.data.push(data.name)
        $scope.tasks[data.sourceGroup].data.splice(data.sourceTask,1);
    }

    function getTasks() {
        rq.getTasks($scope.currentProject.id,function(res) {
            $scope.tasks[0].data=res.data;
        })
    }

}