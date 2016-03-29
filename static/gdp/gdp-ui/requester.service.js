var uiModule = require('./_index');

uiModule.factory('rq',['$http',getRequester]);

function getRequester($http) {
    var service = {
        'init':init,
        'createTask': createTask,
        'getTasks': getTasks,
        'deleteTask': deleteTask,
        'getUsers': getUsers,
        'getProjects':getProjects,
        'assignTaskToUser':assignTaskToUser,
        'createTaskList': createTaskList

        /*'getPosts': getPosts,
        'deletePost': deletePost,
        'savePost': savePost,
        'addPost': addPost,
        'validatePost': validatePost,
        'rejectPost': rejectPost,
        'getVersion':getVersion*/
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
            'lists':'/gdp/api/lists',
            'deleteTask': '/gdp/api/tasks/'+id,
            'users': '/gdp/api/projects/'+id+'/users',
            'projects' :'/gdp/api/users/project',
            'assignTask': '/gdp/api/tasks/'+id+'/users/'+id2
        }
    }

    /* :::::::::::::::::::::::::::::::::::::::: */


    function init() {
        if(JWTTOKEN)
            $http.defaults.headers.common.Authorization = 'Bearer '+JWTTOKEN;
        else
            console.log("WARNING: NO TOKEN FOUND")
    }

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

    function getUsers(id,cb) {
        var r = new Resolver(id);
        get_request(r.users,cb);
    }

    function getProjects(cb) {
        var r = new Resolver(null);
        get_request(r.projects,cb);
    }

    function assignTaskToUser(taskId,userId,cb) {
        var r = new Resolver(taskId,userId);
        put_request(r.assignTask,{},cb)
    }

    function createTaskList(data,cb) {
        var r = new Resolver(null);
        post_request(r.lists,data,cb);
    }

    /* :::::::::::::::::::::::::::::::::::::::: */


    function handleError(err) {
        console.log(err);
    }
}