var uiModule = require('./_index');

uiModule.controller('taskController',['$scope','rq','toastr',taskController]);

function taskController($scope,rq,toastr) {


    $scope.newTask = {'title':'','body':'','endDate':''};


    $scope.status = {
        isopen: false
    };

    $scope.toggleDropdown = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.status.isopen = !$scope.status.isopen;
    };


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

    $scope.taskLists=[];
    $scope.projectUsers=[]
    //$scope.spaceData=[{},{},{}];
    $scope.currentProject={};
    $scope.userProjects=[];
    $scope.newTaskListName="";
    $scope.showTaskListDelete = false;
    $scope.showTaskCreated=false;
    $scope.selectedDay = Date.today();


    /* Scope functions */

    $scope.createTask = createTask;
    $scope.deleteTask=deleteTask;
    $scope.onDropTaskInList=dropTaskInList;
    $scope.assignTaskToUser = assignTaskToUser;
    $scope.createTaskList = createTaskList;
    $scope.deleteTaskList = deleteTaskList;
    $scope.doCancelButton = doCancelButton;

    /* Init */

    (function() {
        rq.init();
        getProjects(function() {
            getTaskLists();
            getProjectUsers();
            /*for(var t in $scope.tasks) {
                var taskgroup = $scope.tasks[t];
                $scope.spaceData[taskgroup.space-1]=taskgroup;
            }*/
        })

    })();

    /* Controller functions */

    function doCancelButton() {
        if ($scope.showTaskListDelete || $scope.showTaskCreated) {
            $scope.showTaskListDelete = false;
            $scope.showTaskCreated = false;
        }
        else
            $scope.showTaskListDelete=true;
    }



    function createTask(taskListId) {
        $scope.newTask.endDate=$scope.selectedDay.toString();
        $scope.newTask.taskList=taskListId;
        rq.createTask($scope.currentProject.id,$scope.newTask,function() {
            toastr.success(['Tâche',$scope.newTask.title,'créée!'].join(" "));
            $scope.newTask = {'title':'','body':'','endDate':''};
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

    function getProjectUsers() {
        rq.getUsers($scope.currentProject.id,function(res) {
            $scope.projectUsers=res.data
        })
    }

    function getProjects(cb) {
        rq.getProjects(function(res) {
            $scope.currentProject=res.data[0];
            $scope.userProjects = res.data;
            if(cb) cb();
        })
    }

    function assignTaskToUser(taskId,userId) {
        rq.assignTaskToUser(taskId,userId,function(res) {
            getTasks()
        })
    }

    function createTaskList() {
        var data = {'name': $scope.newTaskListName, "project_id":$scope.currentProject.id}
        rq.createTaskList(data,function(res) {
            toastr.success(['Liste de tâches',data.name,'créée.'].join(" "));
            $scope.newTaskListName="";
            getTaskLists()
        })
    }

    function deleteTaskList(taskListId) {
        rq.deleteTaskList(taskListId,function(res) {
            toastr.success('Liste de tâches supprimée.');
            getTaskLists()
        })
    }

    function getTaskLists() {
        rq.getTaskLists($scope.currentProject.id,function(res) {
            $scope.taskLists=res.data;
            console.log(res.data)
        });
    }

}