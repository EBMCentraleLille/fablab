var uiModule = require('./_index');

uiModule.controller('taskController',['$scope','rq','toastr',taskController]);

function taskController($scope,rq,toastr) {
    $scope.showTaskCreated=false;


    $scope.newTask = {
        'title':'',
        'body':''
    }

    $scope.status = {
        isopen: false
    };

    $scope.toggleDropdown = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.status.isopen = !$scope.status.isopen;
    };

    $scope.selectedDay = Date.today()

    /* Temporary */

    $scope.onDragOver = function(data,taskgroup) {
    }

    $scope.tasks=[
        {
            "name":"à faire",
            "data":[],
            "space":1
        },
        {
            "name":"en cours",
            "data":[],
            "space":2
        },
        {
            "name":"fait",
            "data":[],
            "space":3
        }
    ]

    $scope.projectUsers=[]

    $scope.spaceData=[{},{},{}];


    $scope.currentProject={
        'id':2,
        'name':'projet_test'
    }

    /* Scope functions */

    $scope.createTask = createTask;
    $scope.deleteTask=deleteTask;
    $scope.onDropTaskInList=dropTaskInList;
    $scope.assignTaskToUser = assignTaskToUser;

    /* Init */

    (function() {
        rq.init();
        getTasks()
        getProjectUsers()
        for(var t in $scope.tasks) {
            var taskgroup = $scope.tasks[t];
            $scope.spaceData[taskgroup.space-1]=taskgroup;
        }
    })();

    /* Controller functions */


    function createTask() {

        rq.createTask($scope.currentProject.id,$scope.newTask,function() {
            toastr.success(['Tâche',$scope.newTask.title,'créée!'].join(" "));
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
            console.log(res.data)
        })
    }

    function getProjectUsers() {
        rq.getUsers($scope.currentProject.id,function(res) {
            $scope.projectUsers=res.data;
        })
    }

    function getProjects() {
        rq.getProjects(function(res) {
            console.log(res.data)
        })
    }

    function assignTaskToUser(taskId,userId) {
        rq.assignTaskToUser(taskId,userId,function(res) {
            getTasks()
        })
    }

}