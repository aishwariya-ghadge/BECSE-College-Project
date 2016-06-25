// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.controllers' is found in controllers.js
angular.module('starter', ['ionic', 'ngCordova', 'starter.controllers', 'starter.services', 'ngCookies'])

.run(function($ionicPlatform, GeoAlert, $ionicPopup, Auth) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if (window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      cordova.plugins.Keyboard.disableScroll(true);

    }
    if (window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }
    
     //Begin the service
    /*var lat = 17.685734;
    var lng = 74.0123737;
    function onConfirm(idx) {
      console.log('button '+idx+' pressed');
    }
    
    if(Auth.isLoggedIn())
    {   
        var userid = Auth.getUser().userid;
        GeoAlert.begin(lat,lng,userid, function() {
          console.log('TARGET');
          //GeoAlert.end();
        });
    }*/
    
    
  });
})

.config(function($stateProvider, $urlRouterProvider) {
  $stateProvider

    .state('app', {
        url: '/app',
        abstract: true,
        templateUrl: 'templates/menu.html',
        controller: 'AppCtrl',
        onEnter: function($state, Auth){
            if(!Auth.isLoggedIn()){
               $state.go('login');
            }
        }
    })
    
    .state('app.home', {
        url: '/home',
            views: {
            'menuContent': {
              templateUrl: 'templates/home.html',
              controller: 'HomeCtrl'
            }
        }
    })

    .state('app.editprofile', {
        url: '/editprofile',
            views: {
            'menuContent': {
              templateUrl: 'templates/editprofile.html',
              controller: 'EditProfileCtrl'
            }
        }
    })
    
    .state('app.attendance', {
        url: '/attendance',
            views: {
            'menuContent': {
              templateUrl: 'templates/attendance.html',
              controller: 'AttendanceCtrl'
            }
        }
    })
    
    .state('app.notice', {
        url: '/notice',
            views: {
            'menuContent': {
              templateUrl: 'templates/notice.html',
              controller: 'NoticeCtrl'
            }
        }
    })
    
    .state('app.officeduty', {
        url: '/officeduty',
            views: {
            'menuContent': {
              templateUrl: 'templates/officeduty.html',
              controller: 'OfficeDutyCtrl'
            }
        }
    })
    
    .state('app.makeattendance', {
        url: '/makeattendance',
            views: {
            'menuContent': {
              templateUrl: 'templates/makeattendance.html',
              controller: 'MakeAttendanceCtrl'
            }
        }
    })
    
    .state('login', {
      url: '/login',
      templateUrl: 'templates/login.html',
      controller: 'LoginCtrl'
    })
    
    .state('register', {
      url: '/register',
      templateUrl: 'templates/register.html',
      controller: 'RegisterCtrl'
    })
    
    ;
    // if none of the above states are matched, use this as the fallback
    $urlRouterProvider.otherwise('/login');
});
