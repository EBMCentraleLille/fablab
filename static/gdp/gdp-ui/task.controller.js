var uiModule = require('./_index');

uiModule.controller('taskController',['$scope','rq','toastr',taskController]);

function taskController($scope,rq,toastr) {

    $scope.newTask = {'title':'','body':'','endDate':''};
    $scope.taskLists=[];
    $scope.projectUsers=[]
    $scope.currentProject={};
    $scope.editTask={};
    $scope.userProjects=[];
    $scope.newTaskListName="";
    $scope.showTaskListDelete = false;
    $scope.showTaskCreated=false;
    $scope.taskEdit={};
    $scope.selectedDay = Date.today();
    $scope.status = {isopen: false};


    /* Scope functions */

    $scope.createTask = createTask;
    $scope.deleteTask=deleteTask;
    $scope.onDropTaskInList=dropTaskInList;
    $scope.assignTaskToUser = assignTaskToUser;
    $scope.createTaskList = createTaskList;
    $scope.deleteTaskList = deleteTaskList;
    $scope.doCancelButton = doCancelButton;
    $scope.setTaskEdit = setTaskEdit;
    $scope.saveEditTask = saveEditTask;
    $scope.toggleDropdown = toggleDropdown;
    $scope.cancelEditTask = cancelEditTask;


    /* Init */

    (function() {
        rq.init();
        getProjects(function() {
            getTaskLists();
            getProjectUsers();
        })

    })();

    /* Controller functions */

    function toggleDropdown($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.status.isopen = !$scope.status.isopen;
    }

    function doCancelButton() {
        if ($scope.showTaskListDelete || $scope.showTaskCreated) {
            $scope.showTaskListDelete = false;
            $scope.showTaskCreated = false;
        }
        else
            $scope.showTaskListDelete=true;
    }

    function setTaskEdit(task,taskgroup) {
       $scope.editTask=task;
       $scope.taskEdit[taskgroup.id]=true;
       $scope.selectedDay = new Date(task.end_date);
    }

    function saveEditTask() {
        $scope.editTask.endDate=$scope.selectedDay.toString();
        rq.saveEditTask($scope.editTask.id,$scope.editTask,function(res) {
            $scope.editTask = {};
            $scope.taskEdit={};
            $scope.selectedDay=Date.today();
            getTaskLists();
        })
    }

    function cancelEditTask(e,taskgroup) {
        e.preventDefault();
        $scope.editTask = {};
        $scope.selectedDay=Date.today();
        $scope.taskEdit[taskgroup.id]=false;
        $scope.taskEdit={};
    }

    function createTask(taskListId) {
        $scope.newTask.endDate=$scope.selectedDay.toString();
        $scope.newTask.taskList=taskListId;
        rq.createTask($scope.currentProject.id,$scope.newTask,function() {
            toastr.success(['Tâche',$scope.newTask.title,'créée!'].join(" "));
            $scope.newTask = {'title':'','body':'','endDate':''};
            getTaskLists()
        })
    }

    function deleteTask(id,title) {
        rq.deleteTask(id,function(res) {
            toastr.success(['Task',title,'has been removed.'].join(" "));
            getTaskLists()
        });
    }

    function dropTaskInList(data,taskgroup) {
        data = data['json/task'];
        if(!data) return;
        rq.addTaskToList(taskgroup.id,data.id,function(res) {
            getTaskLists()
        })
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
            getTaskLists()
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
        });
    }

}