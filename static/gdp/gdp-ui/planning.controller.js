var uiModule = require('./_index');

uiModule.controller('planningController',['$scope','rq','toastr',planningController]);

function planningController($scope,rq,toastr) {

    $scope.tasks={};
    $scope.shiftMonth=shiftMonth;
    $scope.getDays=getDays;
    $scope.processWeek = processWeek;

    $scope.currentDate=null;
    $scope.dateSelection=false;
    $scope.days=[];
    $scope.startWeek=0;
    $scope.daysWeek=[];
    $scope.currentWeek=0;
    //$scope.max=(attrs.max!=null)?Date.today().addDays(parseInt(attrs.max-1)):null;
    //$scope.min=(attrs.min!=undefined)?Date.today().addDays(parseInt(attrs.min)):null;
    $scope.today=Date.today();
    $scope.getDays = getDays;


    function shiftMonth(dir) {
        $scope.currentDate.addMonths(dir);
        generateCalendar();
    }

    function shiftWeek() {

    }

    $scope.currentProject={};


    (function() {
        console.log('test')
        rq.init();
        getProjects(function() {
            getTasks();
            generateCalendar();
        });
    })()

    function getProjects(cb) {
        rq.getProjects(function(res) {
            $scope.currentProject=res.data[0];
            $scope.userProjects = res.data;
            if(cb) cb();
        })
    }

    function getTasks() {
        rq.getTasks($scope.currentProject.id,function(res) {
            for (var task in res.data) {
                var date = new Date(res.data[task].end_date);
                if(!$scope.tasks[date])
                    $scope.tasks[date]=[];
                $scope.tasks[date].push(res.data[task]);
            }
            processWeek(0);
        })
    }

    function getDays() {
        var start=Date.today().monday();
        var res = [];
        var i=0;
        while(i++<7) {
            res.push(start.toString('dddd').slice(0,2));
            start.addDays(1);
        }
        return res;
    }

    function generateCalendar() {
        if(!$scope.currentDate)
            $scope.currentDate= Date.today();

        var monthStart = $scope.currentDate.moveToFirstDayOfMonth();
        var days=new Array(Date.getDaysInMonth($scope.currentDate.getFullYear(),$scope.currentDate.getMonth())).length;
        days+=(days%7==0)?0:(7-days%7);
        var resultArray = [];

        var shift = angular.copy(monthStart).addDays(1).getDay()-1;
        if(shift==-1) shift=6;

        var indexDate = angular.copy(monthStart).addDays(-shift);

        days+=($scope.currentDate.getMonth()==angular.copy(indexDate).addDays(days+1).getMonth())?7:0;

        var i=0;
        while(i++<days) {
            indexDate.addDays(1);
            if(indexDate.toString() == Date.today().toString()) {
                $scope.startWeek = Math.floor(i / 7);
            }
            resultArray.push(angular.copy(indexDate));
        }
        $scope.days = resultArray;
        return;
    }

    function processWeek(relative) {
        if(!relative) {
            $scope.currentWeek=$scope.startWeek;
        }
        else if($scope.currentWeek+relative<0) {
            var t=$scope.days[0].getDate();
            shiftMonth(-1);
            var d = Math.floor(($scope.days.length-1)/7)-1;
            $scope.currentWeek=(t==$scope.days.length-7)?d-1:d;
        }
        else if($scope.days.length<($scope.currentWeek+1+relative)*7) {
            var t=$scope.days[$scope.days.length-7].getDate();
            shiftMonth(1)
            $scope.currentWeek=($scope.days[0].getDate()==t)?1:0;
        } else {
            $scope.currentWeek+=relative;
        }
        var week = $scope.currentWeek;
        $scope.daysWeek=[];
        for(var i=week*7;i<(week+1)*7;i++) {
            $scope.daysWeek[i-week*7]=$scope.days[i];
        }
        return true;
    }


}