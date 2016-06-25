angular.module('starter.controllers', [])

.controller('AppCtrl', function($scope, $ionicModal, $timeout, $state, Auth) {

    $scope.logout = function() {
        Auth.logout();
        $state.go("login");
    };
})

.controller('AttendanceCtrl', function($scope, $stateParams, $cordovaGeolocation, $ionicPlatform, $ionicLoading, Auth, $ionicPopup) {
    $scope.attendance = {};
    $ionicLoading.show({
        template: '<ion-spinner icon="bubbles"></ion-spinner><br/>Please Wait!'
    });
    var url = 'http://becse2016.com/diet_sa/android/index.php?task=getWeekAttendance';
    $.ajax({
        url: url,
        type: 'POST',
        cache: false,
        data:{staff_id: Auth.getUser().userid},
        dataType: "json",
        success: function(response)
        {
            $scope.attendance = response;
            $ionicLoading.hide();
         }
    });  
    
    $scope.doAttnRefresh = function() {
        var url = 'http://becse2016.com/diet_sa/android/index.php?task=getWeekAttendance';
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data:{staff_id: Auth.getUser().userid},
            dataType: "json",
            success: function(response)
            {
                $scope.attendance = response;
                $scope.$broadcast('scroll.refreshComplete');
             }
        });  
    };
})
    
.controller('MakeAttendanceCtrl', function($scope, $stateParams, $cordovaGeolocation, $ionicPlatform, $ionicLoading, Auth, $ionicPopup) {
    $scope.attend_info = {};
    
    $scope.getAttend_info = function() {
        var url = 'http://becse2016.com/diet_sa/android/index.php?task=attend_info&id='+Auth.getUser().userid;
        
        //console.log(Auth.getUser().userid);
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data:{},
            dataType: "json",
            success: function(response)
            {
                $scope.attend_info = response;
            }
        });
    }
    
    $scope.updateOuttime = function() {
        var url = 'http://becse2016.com/diet_sa/android/index.php?task=updateOuttime&staff_id='+Auth.getUser().userid;
        
        //console.log(Auth.getUser().userid);
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data:{},
            dataType: "json",
            success: function(response)
            {
                $scope.getAttend_info();
            }
        });
    };
    
    $scope.getAttend_info();
    
     
})

.controller('NoticeCtrl', function($scope, $stateParams, $cordovaGeolocation, $ionicPlatform, $ionicLoading, Auth, $ionicPopup) {
    $scope.notices = {};
    $ionicLoading.show({
        template: '<ion-spinner icon="bubbles"></ion-spinner><br/>Please Wait!'
    });
    var url = 'http://becse2016.com/diet_sa/android/index.php?task=getNotices';
    $.ajax({
        url: url,
        type: 'POST',
        cache: false,
        data:{staff_id: Auth.getUser().userid},
        dataType: "json",
        success: function(response)
        {
            $scope.notices = response;
            $ionicLoading.hide();
         }
    });  
    
    $scope.doRefresh = function() {
        var url = 'http://becse2016.com/diet_sa/android/index.php?task=getNotices';
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data:{staff_id: Auth.getUser().userid},
            dataType: "json",
            success: function(response)
            {
                $scope.notices = response;
                $scope.$broadcast('scroll.refreshComplete');
             }
        });  
    };
})

.controller('HomeCtrl', function($scope, $stateParams, $cordovaGeolocation, $ionicPlatform, $ionicLoading, Auth, $ionicPopup,GeoAlert) {
    
    
    $ionicPlatform.ready(function() {
        
        /*$ionicLoading.show({
            template: '<ion-spinner icon="bubbles"></ion-spinner><br/>Acquiring location!'
        });*/
        
        var mac;
        if(window.MacAddress != undefined)
        {
            window.MacAddress.getMacAddress(function(macAddress){$("#mac").val(macAddress);},function(fail){});
        }
        
        var lat, lng;  
        
        var posOptions = {
            enableHighAccuracy: true,
            timeout: 20000,
            maximumAge: 0
        };
 
        $cordovaGeolocation.getCurrentPosition(posOptions).then(function (position) {
            lat  = position.coords.latitude;
            lng = position.coords.longitude;
             
           // alert("Latitude - "+lat +" Longitude -"+lng+ " Mac -"+$("#mac").val());
            
            var url = 'http://becse2016.com/diet_sa/android/index.php?task=makeattendance';
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data:{staff_id: Auth.getUser().userid,longitude:lng,latitude:lat,mac:$("#mac").val()},
                dataType: "json",
                success: function(response)
                {
                    if(response == 1)
                    {
                         var alertPopup = $ionicPopup.alert({
                            title: 'Attendance',
                            template: 'Thank you for attendance.'
                        });
                    }
                    else if(response == 2)
                    {
                        
                    }
                    else
                    {
                        var alertPopup = $ionicPopup.alert({
                            title: 'Attendance!',
                            template: 'An error occured!'
                        });
                    }
                }
            });  
              
            $ionicLoading.hide();           
             
        }, function(err) {
            $ionicLoading.hide();
            console.log(err);
        });
        
        var mac;
        if(window.MacAddress != undefined)
        {
            window.MacAddress.getMacAddress(function(macAddress){$("#mac").val(macAddress);},function(fail){});
        }
        
        var interval;
        var duration = 5000;
        var callback;
        var lat1 = 17.648583;//17.648636;
        var lng1 = 73.921183;//73.921199;
        function updateLoc(){
                var vm = this;
                var posOptions = {timeout: 20000, enableHighAccuracy: true}
        
                
                $cordovaGeolocation.getCurrentPosition(posOptions)
                .then(function(position){
                    var lat  = position.coords.latitude
                    var lng = position.coords.longitude
                    console.log('lat', lat);
                    console.log('long', lng); 
                    
                    var dist = getDistanceFromLatLonInKm(lat1, lng1, position.coords.latitude, position.coords.longitude); 
                    
                    var url = 'http://becse2016.com/diet_sa/android/index.php?task=updateLocation';
                    $.ajax({
                        url: url,
                        type: 'POST',
                        cache: false,
                        data:{staff_id: Auth.getUser().userid,latitude:lat,longitude:lng,distance:dist,mac:$("#mac").val()},
                        dataType: "json",
                        success: function(response)
                        {
                            
                        }
                    });  
                    
                }, function(error){
                    console.log('error:', error);
                });
        
        };
        
        function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
        var R = 6371; // Radius of the earth in km
        var dLat = deg2rad(lat2-lat1);  // deg2rad below
        var dLon = deg2rad(lon2-lon1); 
        var a = 
          Math.sin(dLat/2) * Math.sin(dLat/2) +
          Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
          Math.sin(dLon/2) * Math.sin(dLon/2)
          ; 
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
        var d = R * c; // Distance in km
        return d;
       }
      
       function deg2rad(deg) {
        return deg * (Math.PI/180)
       }
        
        window.setInterval(updateLoc, duration);
        
    });               
})

.controller('EditProfileCtrl', function($scope, LoginService, $ionicPopup, $state, Auth, $ionicLoading) {
    $scope.data = {};
    
    $ionicLoading.show({
        template: '<ion-spinner icon="bubbles"></ion-spinner><br/>Please Wait!'
    });
    var url = 'http://becse2016.com/diet_sa/android/index.php?task=getprofile';
            
    $.ajax({
        url: url,
        type: 'POST',
        cache: false,
        data:{id:Auth.getUser().userid},
        dataType: "json",
        success: function(response)
        {
            $scope.data = response;
            $ionicLoading.hide();
        }
    });  
   
    
    $scope.editprofile = function() {
        
        var url = 'http://becse2016.com/diet_sa/android/index.php?task=editprofile';
            
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data:{id:Auth.getUser().userid,name: $scope.data.name,email:$scope.data.email,mobile:$scope.data.mobile,address:$scope.data.address,designation:$scope.data.designation,branch:$scope.data.branch,username:$scope.data.username,password:$scope.data.password},
            dataType: "json",
            success: function(response)
            {
                
                if(response)
                {
                     var alertPopup = $ionicPopup.alert({
                        title: 'Update Profile',
                        template: 'Profile Updated Successfully.'
                    });
                }
                else
                {
                    var alertPopup = $ionicPopup.alert({
                        title: 'Profile Not Updated.',
                        template: 'An error occured.'
                    });
                }
            }
        });  
    }
    
})

.controller('RegisterCtrl', function($scope, LoginService, $ionicPopup, $state, Auth) {
    $scope.data = {};
    
    $scope.register = function() {
        
        var url = 'http://becse2016.com/diet_sa/android/index.php?task=register';
        
        var valid_name=/^[ a-z A-Z]+$/;
        var valid_phone=/^([+0-9]{1,3})?([0-9]{10,11})$/;
        var valid_email=/^[a-z0-9._-]+@[a-z.]+.[a-z.]+$/;
        
        
        if($scope.data.name == undefined)
        {
            var alertPopup = $ionicPopup.alert({
                title: 'Register',
                template: 'Please Enter Name.'
            });
            
            return false;
        }
        else if(!valid_name.test($scope.data.name))
        {
            var alertPopup = $ionicPopup.alert({
                title: 'Register',
                template: "Name Should Be Alphabetic"
            });
            return false;
            
        }
        else if($scope.data.email == undefined)
        {
            var alertPopup = $ionicPopup.alert({
                title: 'Register',
                template: 'Please Enter Email.'
            });
            
            return false;
        }
        else if(!valid_email.test($scope.data.email))
        {
            var alertPopup = $ionicPopup.alert({
                title: 'Register',
                template: "Please Enter Valid Email"
            });
            
            return false;
        } 
        else if($scope.data.mobile == undefined)
        {
            var alertPopup = $ionicPopup.alert({
                title: 'Register',
                template: 'Please Enter Mobile.'
            });
            
            return false;
        }
        else if(!valid_phone.test($scope.data.mobile))
        {
            var alertPopup = $ionicPopup.alert({
                title: 'Register',
                template: 'Please Enter Valid Mobile Number.'
            });
        }
        else if($scope.data.address == undefined)
        {
            var alertPopup = $ionicPopup.alert({
                title: 'Register',
                template: 'Please Enter Address.'
            });
            
            return false;
        }
        else if($scope.data.branch == undefined)
        {
            var alertPopup = $ionicPopup.alert({
                title: 'Register',
                template: 'Please Select Branch.'
            });
            
            return false;
        }
        else if($scope.data.designation == undefined)
        {
            var alertPopup = $ionicPopup.alert({
                title: 'Register',
                template: 'Please Select Designation.'
            });
            
            return false;
        }
        else if($scope.data.username == undefined)
        {
            var alertPopup = $ionicPopup.alert({
                title: 'Register',
                template: 'Please Enter Username.'
            });
            
            return false;
        }
        else if($scope.data.password == undefined)
        {
            var alertPopup = $ionicPopup.alert({
                title: 'Register',
                template: 'Please Enter Password.'
            });
            
            return false;
        }
        else
        {
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data:{name: $scope.data.name,email:$scope.data.email,mobile:$scope.data.mobile,address:$scope.data.address,designation:$scope.data.designation,branch:$scope.data.branch,username:$scope.data.username,password:$scope.data.password},
                dataType: "json",
                success: function(response)
                {
                    
                    if(response)
                    {
                         var alertPopup = $ionicPopup.alert({
                            title: 'Register Successfully',
                            template: 'Thank you for registration. You are under admin moderation.'
                        });
                        $("#reg_form")[0].reset();
                        $state.go('login');
                    }
                    else
                    {
                        var alertPopup = $ionicPopup.alert({
                            title: 'Register failed!',
                            template: 'An error occured!'
                        });
                    }
                }
            }); 
        } 
    }
})

.controller('OfficeDutyCtrl', function($scope, $ionicPopup, $state, Auth) {
    $scope.data = {};
    
    $scope.saveReason = function() {
        
        var url = 'http://becse2016.com/diet_sa/android/index.php?task=saveReason';
        if($scope.data.reason == undefined)
        {
            var alertPopup = $ionicPopup.alert({
                title: 'Office Duty',
                template: 'Please Enter Reason.'
            });
            
            return false;
        }
        else
        {
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data:{reason:$scope.data.reason,staff_id:Auth.getUser().userid},
                dataType: "json",
                success: function(response)
                {
                    if(response)
                    {
                        var alertPopup = $ionicPopup.alert({
                            title: 'Thanks',
                            template: 'Reason Saved Successfully'
                        });
                        $("#office_form")[0].reset();
                    }
                    else
                    {
                        var alertPopup = $ionicPopup.alert({
                            title: 'Save failed!',
                            template: 'An Error Occured!'
                        });
                        $("#office_form")[0].reset();
                    }
                }
            });  
        }
    }

})

.controller('LoginCtrl', function($scope, LoginService, $ionicPopup, $state, Auth) {
    $scope.data = {};
    
    var mac;
    if(window.MacAddress != undefined)
    {
        window.MacAddress.getMacAddress(function(macAddress){$("#mac").val(macAddress);},function(fail){});
    }
    
    
    $scope.login = function() {
        
        var url = 'http://becse2016.com/diet_sa/android/index.php?task=checklogin';
        
        if($scope.data.username == undefined)
        {
            var alertPopup = $ionicPopup.alert({
                title: 'Login',
                template: 'Please Enter Username.'
            });
            
            return false;
        }
        else if($scope.data.password == undefined)
        {
            var alertPopup = $ionicPopup.alert({
                title: 'Login',
                template: 'Please Enter Password.'
            });
            
            return false;
        }
        else
        {
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data:{username:$scope.data.username,password:$scope.data.password,mac:$("#mac").val()},
                dataType: "json",
                success: function(response)
                {
                    if(response)
                    {
                        Auth.setUser({
                          userid: response
                        });
                        $("#log_form")[0].reset();
                        $state.go('app.home');
                    }
                    else
                    {
                        var alertPopup = $ionicPopup.alert({
                            title: 'Login failed!',
                            template: 'Please check your credentials!'
                        });
                        $("#log_form")[0].reset();
                    }
                }
            });  
        }
    }

});

