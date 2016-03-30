var uiModule = require('./_index');

uiModule.factory('rq',['$http','toastr',getRequester]);

function getRequester($http,toastr) {
    var service = {
        'init':init,
        'createTask': createTask,
        'getTasks': getTasks,
        'deleteTask': deleteTask,
        'getUsers': getUsers,
        'getProjects':getProjects,
        'assignTaskToUser':assignTaskToUser,
        'getTaskLists':getTaskLists,
        'createTaskList': createTaskList,
        'getTaskLists': getTaskLists,
        'addTaskToList': addTaskToList,
        'deleteTaskList':deleteTaskList,
        'saveEditTask':saveEditTask
    }

    return service;

    /* :::::::::::::::::::::::::::::::::::::::: */

    function get_request(url, cb) {
        $http.get(url).then(cb, handleError);
    }

    function post_request(url, data, cb) {
        $http.post(url, data).then(cb, handleError);
    }

    function put_request(url, data, cb) {
        $http.put(url, data).then(cb, handleError);
    }

    function del_request(url, cb) {
        $http.delete(url).then(cb, handleError);
    }

    /* :::::::::::::::::::::::::::::::::::::::: */

    function Resolver(id,id2) {
        return {
            'login':'/api/login_check',
            'tasks':'/gdp/api/projects/'+id+'/tasks',
            'taskEdit':'/gdp/api/tasks/'+id,
            'listCreate':'/gdp/api/lists',
            'lists':'/gdp/api/projects/'+id+'/lists',
            'deleteTask': '/gdp/api/tasks/'+id,
            'users': '/gdp/api/projects/'+id+'/users',
            'projects' :'/gdp/api/users/project',
            'assignTask': '/gdp/api/tasks/'+id+'/users/'+id2,
            'taskListAdd': '/gdp/api/lists/'+id+'/adds/'+id2,
            'taskListDelete': '/gdp/api/lists/'+id
        }
    }

    /* :::::::::::::::::::::::::::::::::::::::: */


    function init() {
        if(JWTTOKEN) // JWTOKEN is declared by Symfony
            $http.defaults.headers.common.Authorization = 'Bearer '+JWTTOKEN;
    }

    function getUsers(id,cb) {
        var r = new Resolver(id);
        get_request(r.users,cb);
    }

    function getProjects(cb) {
        var r = new Resolver(null);
        get_request(r.projects,cb);
    }

    /* ::::::   Task related routes  :::::: */

    function createTask(project_id,data,cb) {
        var r = new Resolver(project_id);
        post_request(r.tasks,data,cb);
    }

    function getTasks(project_id,cb) {
        var r = new Resolver(project_id);
        get_request(r.tasks,cb);
    }

    function deleteTask(id,cb) {
        var r = new Resolver(id);
        del_request(r.deleteTask,cb);
    }

    function saveEditTask(id,data,cb) {
        var r = new Resolver(id);
        put_request(r.taskEdit,data,cb);
    }


    function assignTaskToUser(taskId,userId,cb) {
        var r = new Resolver(taskId,userId);
        put_request(r.assignTask,{},cb);
    }

    /* ::::::   TaskList related routes  :::::: */

    function createTaskList(data,cb) {
        var r = new Resolver(null);
        post_request(r.listCreate,data,cb);
    }

    function getTaskLists(project_id,cb) {
        var r = new Resolver(project_id);
        get_request(r.lists,cb);
    }

    function addTaskToList(taskListId,taskId,cb) {
        var r = new Resolver(taskListId,taskId);
        put_request(r.taskListAdd,{},cb);
    }

    function deleteTaskList(taskListId,cb) {
        var r = new Resolver(taskListId);
        del_request(r.taskListDelete,cb);
    }

    /* :::::::::::::::::::::::::::::::::::::::: */


    function handleError(err) {
        console.log(err)
        toastr.error(['Erreur:',err].join(" "));
    }
}