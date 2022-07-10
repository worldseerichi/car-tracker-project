<template>
  <div class="g-p-s-container">
    <div class="g-p-s-image">
      <app-header rootClassName="header-root-class-name4"></app-header>
      <div class="g-p-s-bg"></div>
    </div>
    <div class="g-p-s-container1" id="map"></div>
    <div id="controlsDiv" style="display: flex; justify-content: space-around; width: 30%; visibility: hidden;">
        <button id="controls" @click="playBtn()">Play</button>
        <button id="controls" @click="pauseBtn()">Pause</button>
        <button id="controls" @click="stopBtn()">Stop</button>
        <!--<button id="controls" @click="rewindBtn()">Rewind</button>-->
    </div>
  </div>
</template>

<script>
import AppHeader from '../components/header'
//import '@coreui/coreui/dist/css/coreui.min.css'
import axios from 'axios';
var map;
/*var controlDiv;
var controlUI;
var controlText;*/
// Button For Inside Of Map
var controlUI;
var controlDiv;
var controlText;
//
var controls;
var timers = new Map();
var snappedCoordinates = [];
var lastPosition = new Map();
var geocoder;
var apiKey = process.env.MIX_API_KEY;
var uniqueRsuIdArray;
const regexExp = /^((\-?|\+?)?\d+(\.\d+)?),\s*((\-?|\+?)?\d+(\.\d+)?)$/i; // regex expression for checking valid latlng
var coords;
var R = 6371.0710; //radius of the earth in kilometers
var locationRange;
var filteredCenter;
var circles = [];
var selectedMarker;
var selectedPolyline;
var markers = new Map();
var polylines = new Map();
var rsuDataMap = new Map();
var rsuDataMapCopy = new Map();
var snappedCoordinatesMap = new Map();
var snappedCoordinates = [];
var counter = 0;


var otherUsersIcon = {
    path: "M29.395,0H17.636c-3.117,0-5.643,3.467-5.643,6.584v34.804c0,3.116,2.526,5.644,5.643,5.644h11.759 "
        +"c3.116,0,5.644-2.527,5.644-5.644V6.584C35.037,3.467,32.511,0,29.395,0z "
        +"M34.05,14.188v11.665l-2.729,0.351v-4.806L34.05,14.188z "
        +"M32.618,10.773c-1.016,3.9-2.219,8.51-2.219,8.51H16.631l-2.222-8.51C14.41,10.773,23.293,7.755,32.618,10.773z "
        +"M15.741,21.713 v4.492l-2.73-0.349V14.502L15.741,21.713z M13.011,37.938V27.579l2.73,0.343v8.196L13.011,37.938z "
        +"M14.568,40.882l2.218-3.336 h13.771l2.219,3.336H14.568z M31.321,35.805v-7.872l2.729-0.355v10.048L31.321,35.805z",
    fillColor: 'black',
    fillOpacity: 1,
    scale: .75,
    anchor: new google.maps.Point(25,25),
    rotation: 55
}
var mainIcon = {
    path: "M29.395,0H17.636c-3.117,0-5.643,3.467-5.643,6.584v34.804c0,3.116,2.526,5.644,5.643,5.644h11.759 "
            +"c3.116,0,5.644-2.527,5.644-5.644V6.584C35.037,3.467,32.511,0,29.395,0z "
            +"M34.05,14.188v11.665l-2.729,0.351v-4.806L34.05,14.188z "
            +"M32.618,10.773c-1.016,3.9-2.219,8.51-2.219,8.51H16.631l-2.222-8.51C14.41,10.773,23.293,7.755,32.618,10.773z "
            +"M15.741,21.713 v4.492l-2.73-0.349V14.502L15.741,21.713z M13.011,37.938V27.579l2.73,0.343v8.196L13.011,37.938z "
            +"M14.568,40.882l2.218-3.336 h13.771l2.219,3.336H14.568z M31.321,35.805v-7.872l2.729-0.355v10.048L31.321,35.805z",
    fillColor: 'red',
    fillOpacity: 1,
    scale: .75,
    anchor: new google.maps.Point(25,25),
    rotation: 55
}

export default {
  name: 'GPS',
  components: {
    AppHeader,
  },
  metaInfo: {
    title: 'GPS - Vehicle Tracker',
    meta: [
      {
        property: 'og:title',
        content: 'GPS - Car_Tracker_V1',
      },
    ],
  },
  methods: {
    initMap() {
        var mapOptions =
            {
                zoom : 1.75,
                center : {
                    lat: 32.7502,
                    lng: 114.7655
                }
            };
        map = new google.maps.Map(document.getElementById("map"), mapOptions); //creates and initializes the map
        const centerFilterControl = this.giveButton(map);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerFilterControl);
        geocoder = new google.maps.Geocoder();
        this.getRouteData();
    },
     giveButton(map){       // Add Button Export To Google Map
      controlDiv = document.createElement('div');
      controlUI = document.createElement('div');
      controlText = document.createElement('div');
      controlUI.style.backgroundColor = '#fff';
      controlUI.style.border = '2px solid #ebebeb';
      controlUI.style.borderRadius = '15px';
      controlUI.style.padding = '10px';
      controlUI.style.cursor = 'pointer';
      controlUI.title = 'Export';
      controlDiv.appendChild(controlUI);  
      controlText.style.fontSize = '16px';
      controlText.style.textAlign = 'center';
      controlText.style.lineHeight = '20px';
      controlText.style.color = '#333';
      controlText.innerHTML = 'Export';
      controlUI.appendChild(controlText);


      controlDiv.addEventListener('click',() => {
            // Chamar aqui funcao para executar o export
            console.log("IM ALIVE");
      });
      
      return controlDiv;
    },

    getRouteData() {
        axios.get('/getData').then(response => {
            //console.log(response);
            //response will be path coordinates of current logged in user
            if(response.data == 'No data found'){
                console.log(response.data);
            }else{
                var self = this;
                uniqueRsuIdArray = new Set();
                rsuDataMap = new Map();
                markers = new Map();
                polylines = new Map();
                var validLocationCheck = true;
                //console.log(response);

                uniqueRsuIdArray = [...new Set(response.data.map(item => item.rsu_id))];
                if (this.$store.getters.isFiltered) {
                    //console.log('filtered');
                    locationRange = this.$store.getters.getLocation;
                    if (locationRange != '') {
                        validLocationCheck = this.centerMap();
                    }
                    if (validLocationCheck && this.$store.getters.getRange > 0) {
                        //console.log('valid location');
                        uniqueRsuIdArray.forEach(function(rsuId) {
                            if (response.data.filter(data => data.rsu_id == rsuId && data.recorded_at >= self.$store.getters.getStartDate && data.recorded_at <= self.$store.getters.getEndDate).length > 0) {
                                rsuDataMap.set(
                                    rsuId,
                                    response.data.filter(data => data.rsu_id == rsuId && data.recorded_at >= self.$store.getters.getStartDate && data.recorded_at <= self.$store.getters.getEndDate)
                                    .map(function (data) { return [data.latitude, data.longitude]; })
                                )
                            }
                        });
                        if (locationRange != '') {
                            const rangeCircle = new google.maps.Circle({
                                strokeColor: "#0096FF",
                                strokeOpacity: 0.4,
                                strokeWeight: 2,
                                fillOpacity: 0,
                                map,
                                center: filteredCenter,
                                radius: this.$store.getters.getRange,
                            });
                            circles.push(rangeCircle);
                            rsuDataMap.forEach((values,keys)=>{
                                var shortestDistance = Number.MAX_VALUE;
                                //check for data out of range and remove it from map
                                values.forEach((value, index)=>{
                                    var rlat1 = value[0] * (Math.PI/180); // Convert degrees to radians
                                    var rlat2 = parseFloat(coords[0]) * (Math.PI/180); // coords -> location filter values
                                    var difflat = rlat2-rlat1; // Radian difference (latitudes)
                                    var difflon = (parseFloat(coords[1])-value[1]) * (Math.PI/180); // Radian difference (longitudes)

                                    var distance = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat/2)*Math.sin(difflat/2)+Math.cos(rlat1)*Math.cos(rlat2)*Math.sin(difflon/2)*Math.sin(difflon/2))) * 1000; // Haversine formula
                                    if (distance < shortestDistance) {
                                        shortestDistance = distance;
                                    };
                                })
                                if (shortestDistance > this.$store.getters.getRange) {
                                    rsuDataMap.delete(keys);
                                }
                            });
                        }

                    }
                }else{ //no filter applied
                    uniqueRsuIdArray.forEach(function(rsuId) {
                        rsuDataMap.set(
                            rsuId,
                            response.data.filter(data => data.rsu_id == rsuId)
                            .map(function (data) { return [data.latitude, data.longitude]; })
                        )
                    });
                }

                //copy of rsuDataMap for use in animations
                rsuDataMapCopy = new Map(JSON.parse(
                    JSON.stringify(Array.from(rsuDataMap)) //copies map and disconnects from original map
                ));

                //if rsuDataMap.size is 0, show toast message about no data found

                //snapToRoads takes up to 100 GPS points, current position plus 99 previous positions (slice)
                counter = 0;
                rsuDataMap.forEach((values,keys)=>{
                    do {
                        axios.get('https://roads.googleapis.com/v1/snapToRoads', { params: {
                        interpolate: true,
                        key: apiKey,
                        path: values.slice(-100).join('|')
                        }
                        }).then(response => {
                            counter++;
                            //response is a set of coordinates snapped to the nearest road for accuracy purposes
                            this.processRoadsResponse(response.data, keys, values.length);

                            if (values.length == 0) { //possible issue with big data due to funky javascript race conditions
                                this.drawRoute(keys);
                            }
                             //draws the current user's driven path from the previous 100 coordinates
                            if (counter == rsuDataMap.size) {
                                if (this.$store.getters.getLocation == '') {
                                    this.centerMap();
                                };
                                rsuDataMapCopy.forEach((values,keys)=>{
                                    timers.set(keys, null);
                                });
                                controls.style.visibility = 'visible';
                            };
                        })
                        .catch(e => {
                            console.log("snapToRoads failed due to: " + e);
                        });
                        if (values.length >= 100) {
                            values.splice(values.length-100, 100);
                        } else {
                            values.splice(0, values.length);
                        }
                    }while (values.length > 0);
                });
            };
        })
        .catch(e => {
            console.log("getData failed due to: " + e);
        });
    },

    processRoadsResponse(data, rsu_id, remainingData) {
        for (var i = 0; i < data.snappedPoints.length; i++) {
            var latlng = new google.maps.LatLng(
                data.snappedPoints[i].location.latitude,
                data.snappedPoints[i].location.longitude);
            snappedCoordinates.push(latlng);
        }
        if (remainingData == 0) {
            snappedCoordinatesMap.set(rsu_id, snappedCoordinates);
            snappedCoordinates = [];
        }
        //sets the current user's last coordinates
        lastPosition.set('lat', data.snappedPoints[data.snappedPoints.length-1].location.latitude);
        lastPosition.set('lng', data.snappedPoints[data.snappedPoints.length-1].location.longitude);
    },

    drawRoute(rsu_id) {
        polylines.set(
          rsu_id,
          new google.maps.Polyline({
              path: snappedCoordinatesMap.get(rsu_id),
              strokeColor: '#000000', //old color: #add8e6 light blue
              strokeWeight: 4,
              strokeOpacity: 0.5,
          })
        );
        //draws the route path
        polylines.get(rsu_id).setMap(map);

        //draws marker on the user's last position
        markers.set(
            rsu_id,
            new google.maps.Marker({
                position: { lat: lastPosition.get('lat'), lng: lastPosition.get('lng') },
                map: map,
                draggable: false,
                icon: otherUsersIcon,
            })
        );
        google.maps.event.addListener(markers.get(rsu_id), 'click', () => {this.selectMarker(rsu_id);});
        google.maps.event.addListener(polylines.get(rsu_id), 'click', () => {this.selectMarker(rsu_id);});
    },

    centerMap() {
        if (this.$store.getters.getLocation == '') {
            filteredCenter = markers.get([...uniqueRsuIdArray].pop()).getPosition();
            map.setCenter(filteredCenter);
            map.setZoom(14);
        }else{
            if (regexExp.test(this.$store.getters.getLocation)) {
                coords = this.$store.getters.getLocation.split(",");
                filteredCenter = new google.maps.LatLng(parseFloat(coords[0]), parseFloat(coords[1]));
                map.setCenter(filteredCenter);
                map.setZoom(14);
                console.log("valid location");
                return true;
            }else{
                console.log("invalid location");
                return false;
            }
            //previous code for centering map on the given address
            /*geocoder.geocode( { 'address': this.$store.getters.getLocation}, function(results, status) {
                if (status == 'OK') {
                    map.setCenter(results[0].geometry.location);
                    map.setZoom(14);
                } else {
                    console.log('Geocode was not successful for the following reason: ' + status);
                }
            });*/
        }
    },

    selectMarker(rsu_id) {
        if(markers.get(rsu_id) == selectedMarker){ //unselect marker when clicking a selected marker
          selectedPolyline = null;
          selectedMarker = null;
          markers.get(rsu_id).setIcon(otherUsersIcon);
          polylines.get(rsu_id).setOptions({strokeColor: '#000000', strokeOpacity: 0.5});
        }else{ //select a marker and unselect others
            markers.forEach((values,keys)=>{
              values.setIcon(otherUsersIcon);
            });
            polylines.forEach((values,keys)=>{
              values.setOptions({strokeColor: '#000000', strokeOpacity: 0.5});
            });
            markers.get(rsu_id).setIcon(mainIcon);
            polylines.get(rsu_id).setOptions({strokeColor: '#FF0000', strokeOpacity: 0.9});
            selectedPolyline = polylines.get(rsu_id);
            selectedMarker = markers.get(rsu_id);
        };
    },

    playBtn(){
        rsuDataMapCopy.forEach((values,keys)=>{
            if (!timers.get(keys)) {
                //line.getPath().clear();
                this.recursiveAnimate(0, keys);

            } else {
                timers.get(keys).resume();
            }
        });
    },

    pauseBtn(){
        rsuDataMapCopy.forEach((values,keys)=>{
            timers.get(keys) && timers.get(keys).pause();
        });
    },

    stopBtn(){
        rsuDataMapCopy.forEach((values,keys)=>{
            timers.get(keys) && timers.get(keys).cancel();
            timers.set(keys, null);
            //line.setPath(pathCoords)
        });
    },

    recursiveAnimate(index, rsu_id) {
        timers.get(rsu_id) && timers.get(rsu_id).cancel()
        //var coordsDeparture = pathCoords[index];
        //var coordsArrival = pathCoords[index + 1];
        var rsuCoords = rsuDataMapCopy.get(rsu_id);
        var currentThis = this;
        var departure = new google.maps.LatLng(rsuCoords[index][0], rsuCoords[index][1]); //Set to whatever lat/lng you need for your departure location
        var arrival = new google.maps.LatLng(rsuCoords[index+1][0], rsuCoords[index+1][1]); //Set to whatever lat/lng you need for your arrival location
        var lastStop = new google.maps.LatLng(rsuCoords[rsuCoords.length-1][0], rsuCoords[rsuCoords.length-1][1]);
        var step = 0;
        var numSteps = 200; //Change this to set animation resolution
        var timePerStep = 8; //Change this to alter animation speed
        timers.set(rsu_id, this.InvervalTimer(function(arg) {
            step += 1;
            if (step > numSteps) {
            //clearInterval(interval);
            step = 0
            timers.get(rsu_id).cancel()
            if (index < rsuCoords.length - 2) {
                currentThis.recursiveAnimate(index + 1, rsu_id)
            }
            } else {
            var are_we_there_yet = google.maps.geometry.spherical.interpolate(departure, arrival, step / numSteps);
            //line.getPath().push(are_we_there_yet);
            currentThis.moveMarker(map, markers.get(rsu_id), departure, are_we_there_yet);
            }
        }, timePerStep));
    },

    moveMarker(map, marker, departure, currentMarkerPos) {
        marker.setPosition(currentMarkerPos);
        //map.panTo(currentMarkerPos);
        var heading = google.maps.geometry.spherical.computeHeading(departure, currentMarkerPos);
        marker.getIcon().rotation = heading;
        marker.setIcon(marker.getIcon());
    },

    InvervalTimer(callback, interval, arg) {
        //console.log(timer)
        var timerId, startTime, remaining = 0;
        var state = 0; //  0 = idle, 1 = running, 2 = paused, 3= resumed
        var timeoutId;
        this.pause = function() {
            if (state != 1) return;

            remaining = interval - (new Date() - startTime);
            window.clearInterval(timerId);
            state = 2;
        };

        this.resume = function() {
            if (state != 2) return;

            state = 3;
            //console.log(remaining)
            timeoutId = window.setTimeout(this.timeoutCallback, remaining, arg);
        };

        this.timeoutCallback = function(timer) {
            if (state != 3) return;
                clearTimeout(timeoutId);
            startTime = new Date();
            timerId = window.setInterval(function() {
            callback(this.arg)
            }, interval);
            state = 1;
        };

        this.cancel = function() {
            clearInterval(timerId)
        }
        startTime = new Date();
        timerId = window.setInterval(function() {
            callback(arg)
        }, interval);
        state = 1;
        return {
            cancel: this.cancel,
            pause: this.pause,
            resume: this.resume,
            timeoutCallback: this.timeoutCallback
        };
    },
  },

  mounted() {
    this.initMap();
    controls = document.getElementById('controlsDiv');
  },
  watch: {
    '$store.state.filter': {deep: true,
        handler() {
            controls.style.visibility = 'hidden';
            //console.log("filter changed");
            markers.forEach((values,keys)=>{
              values.setMap(null);
            });
            polylines.forEach((values,keys)=>{
              values.setMap(null);
            });
            circles.forEach((circle) => {
                circle.setMap(null);
            });
            circles = [];
            timers = new Map();
            this.getRouteData();
        }
    }
  }
}
</script>

<style scoped>
.g-p-s-container {
  width: 100%;
  height: auto;
  display: flex;
  min-height: 100vh;
  align-items: center;
  flex-direction: column;
  justify-content: flex-start;
  background-color: #f2f5f9ff;
}
.g-p-s-image {
  width: 100%;
  height: 301px;
  display: flex;
  position: relative;
  align-items: center;
  flex-direction: column;
  background-size: cover;
}
.g-p-s-bg {
  top: auto;
  left: auto;
  right: 0px;
  width: 100%;
  bottom: auto;
  height: 269px;
  display: flex;
  opacity: 0.5;
  position: absolute;
  align-items: flex-start;
  flex-direction: column;
  background-color: var(--dl-color-gray-black);
}
.g-p-s-container1 {
  width: 100%;
  border: 2px dashed rgba(120, 120, 120, 0.4);
  /*height: 525px;*/
  display: flex;
  flex: 1 1 auto;
  z-index: 100;
  box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1),0 10px 10px -5px rgba(0,0,0,0.04);
  margin-top: -13.5rem;
  align-items: center;
  border-radius: var(--dl-radius-radius-radius75);
  /*margin-bottom: var(--dl-space-space-tripleunit);*/
  flex-direction: column;
  justify-content: center;
  background-color: var(--dl-color-gray-white);
}
#controls {
    background-color: white;
    color: black;
    border: 2px solid #008CBA;
    width: 100%;
    margin: 2px;
}
</style>

