var uiModule = require('./_index');

uiModule.factory('rq',['$http',getRequester]);

function getRequester($http) {
    var service = {
        'createTask': createTask,
        'getTasks': getTasks
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

    function Resolver(id) {
        return {
            'tasks':'/gdp/api/projects/'+id+'/tasks'
        }
    }

    /* :::::::::::::::::::::::::::::::::::::::: */

    function createTask(project_id,data,cb) {
        var r = new Resolver(project_id);
        post_request(r.tasks,data,cb);
    }

    function getTasks(project_id,cb) {
        var r = new Resolver(project_id);
        get_request(r.tasks,cb);
    }
    /*function getPosts(cb) {
        var r = new Resolver();
        get_request(r.posts, cb);
    }*/

    /* :::::::::::::::::::::::::::::::::::::::: */


    function handleError(err) {
        console.log(err);
    }
}