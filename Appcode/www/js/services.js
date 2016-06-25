'use strict';

angular.module('starter.services', ['ngCookies'])
.service('LoginService', function($q,$http) {
    return {
        loginUser: function(name, pw) {
            var deferred = $q.defer();
            var promise = deferred.promise;
            
            if (name == 'admin' && pw == 'admin') {
                deferred.resolve('Welcome ' + name + '!');
            } else {
                deferred.reject('Wrong credentials.');
            }
            promise.success = function(fn) {
                promise.then(fn);
                return promise;
            }
            promise.error = function(fn) {
                promise.then(null, fn);
                return promise;
            }
            return promise;
        }
    }
})
.factory('GeoAlert', function() {
   console.log('GeoAlert service instantiated');
   var interval;
   var duration = 6000;
   var lng, lat, uid;
   var processing = false;
   var callback;
   var minDistance = 3;
    
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
   
   function hb(uid) {
      console.log('hb running');
      alert(uid);
      //if(processing) return;
      //processing = true;
      navigator.geolocation.getCurrentPosition(function(position) {
        //processing = false;
        console.log(lat, lng);
        console.log(position.coords.latitude, position.coords.longitude);
        var dist = getDistanceFromLatLonInKm(lat, lng, position.coords.latitude, position.coords.longitude);
        console.log("dist in km is "+dist);
        if(dist <= minDistance)
        { 
            var url = 'http://becse2016.com/diet_sa/android/index.php?task=updateLocation';
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data:{staff_id: uid,latitude:position.coords.latitude,longitude:position.coords.longitude,distance:dist},
                dataType: "json",
                success: function(response)
                {
                    
                }
            });  
            callback();
        }
      });
   }
   
   return {
     begin:function(lt,lg,userid,cb) {
       lng = lg;
       lat = lt;
       uid = userid;
       
       callback = cb;
       interval = window.setInterval(hb, duration);
       hb(uid);
     }, 
     end: function() {
       window.clearInterval(interval);
     },
     setTarget: function(lg,lt) {
       lng = lg;
       lat = lt;
     }
   };
   
})
.factory('Auth', function ($cookieStore) {
   var _user = $cookieStore.get('starter.user');
   var setUser = function (user) {
      _user = user;
      $cookieStore.put('starter.user', _user);
   }
 
   return {
      setUser: setUser,
      isLoggedIn: function () {
         return _user ? true : false;
      },
      getUser: function () {
         return _user;
      },
      logout: function () {
         $cookieStore.remove('starter.user');
         _user = null;
      }
   }
});
