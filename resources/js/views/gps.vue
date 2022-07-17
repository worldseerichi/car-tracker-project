<template>
  <div class="g-p-s-container">
    <div class="g-p-s-image">
      <app-header rootClassName="header-root-class-name4"></app-header>
      <div class="g-p-s-bg"></div>
    </div>
    <div class="g-p-s-container1" id="map"></div>
    <div id="controlsDiv" style="display: flex; justify-content: space-around; width: 100%; visibility: hidden;">
        <button id="controls" @click="setExportStart()">Set Slider Start</button>
        <vue-slider style="width: 60%; padding: 31px 0px;"
            v-model="slider.value"
            :min="slider.min"
            :max="slider.max"
            :drag-on-click="true"
            :disabled="slider.disabled"
            :tooltip="'none'"
            @change="val => this.sliderChangeHandler(val)"
        ></vue-slider> <!-- 18px de padding preferivel -->
        <button id="controls" @click="setExportEnd()">Set Slider End</button>
    </div>
  </div>
</template>

<script>
import AppHeader from '../components/header'
import VueSlider from 'vue-slider-component'
import 'vue-slider-component/theme/default.css'
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
var snappedCoordinatesArrayMap = new Map();
var firstPositionMap = new Map();
var lastPositionMap = new Map();
var deviceFullDataMap = new Map();
var geocoder;
var apiKey = process.env.MIX_API_KEY;
var uniqueDeviceIdArray = new Set();
const regexExp = /^((\-?|\+?)?\d+(\.\d+)?),\s*((\-?|\+?)?\d+(\.\d+)?)$/i; // regex expression for checking valid latlng
var coords;
var R = 6371.0710; //radius of the earth in kilometers
var locationRange;
var filteredCenter;
var circles = [];
var selectedMarker;
var selectedPolyline;
var startPosMarkers = new Map();
var markers = new Map();
var polylines = new Map();
var deviceDataMap = new Map();
var deviceDataMapCopy = new Map();
var snappedCoordinatesMap = new Map();
var snappedCoordinates = [];
var counter = 0;
var axiosRequestsRequired = 0;
var deviceRequestsRequiredMap = new Map();
var deviceRequestCounterMap = new Map();
var exportTimestampStart = 0;
var exportTimestampEnd = 0;
var deviceExportData = new Map();
var infowindow;


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
var startPosIcon = {
    path: "M1045 5114 c-128 -27 -207 -68 -287 -147 -32 -33 -73 -87 -89 -120 " +
        "-61 -121 -59 -30 -59 -1937 l-1 -1745 -72 -34 c-129 -62 -246 -199 -296 -348 "+
        "-111 -331 102 -696 449 -769 143 -30 238 -3 291 83 19 30 24 52 24 103 0 117 "+
        "-62 181 -195 200 -85 12 -130 38 -170 97 -20 30 -25 49 -25 103 0 77 24 122 "+
       "89 168 33 23 50 27 106 27 56 0 73 -4 106 -27 58 -41 82 -83 94 -167 12 -87 "+
        "37 -132 93 -169 34 -23 52 -27 107 -27 55 0 73 4 107 27 22 15 51 44 64 65 21 "+
        "33 24 49 23 128 -2 155 -58 281 -178 401 -51 50 -92 80 -143 105 l-73 34 3 "+
        "1747 2 1748 28 27 c55 55 33 64 982 -379 479 -223 887 -414 908 -424 41 -20 "+
        "47 -38 17 -54 -10 -5 -346 -147 -746 -315 -493 -207 -737 -314 -757 -333 -105 "+
        "-98 -81 -258 47 -324 80 -41 84 -40 896 301 410 172 767 326 793 343 81 52 "+
        "153 158 176 258 34 146 -17 301 -132 406 -48 44 -152 95 -988 483 -514 239 "+
        "-963 443 -999 452 -61 17 -149 22 -195 13z",
    fillColor: 'blue',
    fillOpacity: 1,
    scale: .006,
    anchor: new google.maps.Point(25,25),
    rotation: 180
}

export default {
  name: 'GPS',
  components: {
    AppHeader,
    VueSlider
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
  data() {
    return {
      slider:{
        min: 0,
        max: 0,
        value: 0,
        disabled: true
      },
    }
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
        const centerFilterControl = this.giveButton();
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerFilterControl);
        geocoder = new google.maps.Geocoder();
        infowindow = new google.maps.InfoWindow({
            content: '<strong>Selected Vehicle Data: </strong>' +
                    '<br/>Latitude: ' +
                    '<br/>Longitude: ' +
                    '<br/>Velocity: ' +
                    '<br/>Bearing: ' +
                    '<br/>Recorded at: '
        });
        this.getRouteData();
    },

    giveButton(){       // Add Button Export To Google Map
      controlDiv = document.createElement('div');
      controlUI = document.createElement('div');
      controlText = document.createElement('div');
      controlUI.style.backgroundColor = '#fff';
      controlUI.style.border = '2px solid #ebebeb';
      controlUI.style.borderRadius = '15px';
      controlUI.style.padding = '10px';
      controlUI.style.cursor = 'pointer';
      controlUI.title = 'Export Data';
      controlDiv.appendChild(controlUI);
      controlText.style.fontSize = '16px';
      controlText.style.textAlign = 'center';
      controlText.style.lineHeight = '20px';
      controlText.style.color = '#333';
      controlText.innerHTML = 'Export Data';
      controlUI.appendChild(controlText);


      controlDiv.addEventListener('click',() => {
            if(deviceFullDataMap.size === 0){
                console.log("No Data To Export");
            }else{
                this.exportData();
            }

      });

      return controlDiv;
    },

    getRouteData() {
        var self = this;
        axios.get('api/getData').then(response => {
            //console.log('------------------------------');
            //console.log(response);
            //response will be path coordinates of current logged in user
            if(response.data == 'No data found'){
                console.log(response.data);
            }else{
                uniqueDeviceIdArray = new Set();
                deviceDataMap = new Map();
                startPosMarkers = new Map();
                markers = new Map();
                polylines = new Map();
                deviceFullDataMap = new Map();
                deviceRequestsRequiredMap = new Map();
                deviceRequestCounterMap = new Map();
                snappedCoordinatesArrayMap = new Map();
                lastPositionMap = new Map();
                firstPositionMap = new Map();
                var validLocationCheck = true;
                this.slider.disabled = true;
                //console.log(response);

                uniqueDeviceIdArray = [...new Set(response.data.map(item => item.device_id))];
                if (self.$store.getters.isFiltered) {
                    //console.log('filtered');
                    locationRange = self.$store.getters.getLocation;
                    if (locationRange != '') {
                        validLocationCheck = this.centerMap();
                    }
                    if (validLocationCheck && self.$store.getters.getRange > 0) {
                        //console.log('valid location');
                        uniqueDeviceIdArray.forEach(function(deviceId) {
                            if (response.data.filter(data => data.device_id == deviceId && new Date(data.recorded_at) >= new Date(self.$store.getters.getStartDate) && new Date(data.recorded_at) <= new Date(self.$store.getters.getEndDate)).length > 0) {
                                deviceDataMap.set(
                                    deviceId,
                                    response.data.filter(data => data.device_id == deviceId && new Date(data.recorded_at) >= new Date(self.$store.getters.getStartDate) && new Date(data.recorded_at) <= new Date(self.$store.getters.getEndDate))
                                    .map(function (data) { return [data.latitude, data.longitude]; })
                                )
                                deviceFullDataMap.set(
                                    deviceId,
                                    response.data.filter(data => data.device_id == deviceId && new Date(data.recorded_at) >= new Date(self.$store.getters.getStartDate) && new Date(data.recorded_at) <= new Date(self.$store.getters.getEndDate))
                                    .map(function (data) { return data; })
                                )
                            }
                            //console.log('filtering');
                        });
                        if (locationRange != '') {
                            const rangeCircle = new google.maps.Circle({
                                strokeColor: "#0096FF",
                                strokeOpacity: 0.4,
                                strokeWeight: 2,
                                fillOpacity: 0,
                                map,
                                center: filteredCenter,
                                radius: self.$store.getters.getRange,
                            });
                            circles.push(rangeCircle);
                            deviceDataMap.forEach((values,keys)=>{
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
                                //console.log('key: ' + keys + ' shortestDistance: ' + shortestDistance);
                                if (shortestDistance > self.$store.getters.getRange) {
                                    deviceDataMap.delete(keys);
                                    deviceFullDataMap.delete(keys);
                                }
                            });
                        }

                    }else{
                        console.log('No data found through current filters');
                    }
                }else{ //no filter applied
                    uniqueDeviceIdArray.forEach(function(deviceId) {
                        deviceDataMap.set(
                            deviceId,
                            response.data.filter(data => data.device_id == deviceId)
                            .map(function (data) { return [data.latitude, data.longitude]; })
                        )
                        deviceFullDataMap.set(
                            deviceId,
                            response.data.filter(data => data.device_id == deviceId)
                            .map(function (data) { return data; })
                        )
                    });
                }

                //if deviceDataMap.size is 0, show toast message about no data found

                deviceDataMap.forEach((values,keys)=>{
                    deviceRequestsRequiredMap.set(keys,Math.ceil(values.length/100));
                    deviceRequestCounterMap.set(keys,0);
                    snappedCoordinatesArrayMap.set(keys,[]);
                });
                //snapToRoads takes up to 100 GPS points at a time, so we need to make multiple requests to snapToRoads API
                (async () => {
                    for (const [key, values] of deviceDataMap.entries()) {
                        do {
                            try {
                                deviceRequestCounterMap.set(key,deviceRequestCounterMap.get(key)+1);
                                //console.log('starting axios of device ' + key);
                                let response = await axios.get('https://roads.googleapis.com/v1/snapToRoads', { params: {
                                    interpolate: true,
                                    key: apiKey,
                                    path: values.slice(-100).join('|')
                                    }
                                });
                                if (response.status == 200) {
                                    //console.log('inside axios of device ' + key);
                                    //response is a set of coordinates snapped to the nearest road for accuracy purposes
                                    this.processRoadsResponse(response.data, key);

                                }else{
                                    console.log('Some error occurred in snapToRoads: ' + response);
                                }
                            } catch (error) {
                                console.log("snapToRoads failed due to: " + error);
                            };
                            //console.log('after awaited axios of device '+ key);
                            if (values.length >= 100) {
                                values.splice(values.length-100, 100);
                            } else {
                                values.splice(0, values.length);
                                this.drawRoute(key); //draw route once all data is processed
                            }
                        }while (values.length > 0);
                    }
                })().then(() => {
                    //runs after all axios requests are completed
                    if (self.$store.getters.getLocation == '') {
                        this.centerMap();
                    };

                    this.setMarkerRotations();

                    if (self.$store.getters.isFiltered) {
                        controls.style.visibility = 'visible';
                        this.setSliderValues();
                    }
                }).catch(error => {
                    console.log('Error in async anonymous function: ' + error);
                });
            };
        })
        .catch(e => {
            console.log("getData failed due to: " + e);
        });
    },

    processRoadsResponse(data, device_id) {
        for (var i = data.snappedPoints.length-1; i >= 0; i--) {
            var latlng = new google.maps.LatLng(
                data.snappedPoints[i].location.latitude,
                data.snappedPoints[i].location.longitude
            );
            snappedCoordinatesArrayMap.get(device_id).unshift(latlng);
        }
        if (deviceRequestCounterMap.get(device_id) == deviceRequestsRequiredMap.get(device_id)) {
            lastPositionMap.set(
                device_id,
                [parseFloat(snappedCoordinatesArrayMap.get(device_id)[snappedCoordinatesArrayMap.get(device_id).length-1].toString().split(', ')[0].replace('(','')),
                parseFloat(snappedCoordinatesArrayMap.get(device_id)[snappedCoordinatesArrayMap.get(device_id).length-1].toString().split(', ')[1].replace(')',''))]
            );
            firstPositionMap.set(
                device_id,
                [parseFloat(snappedCoordinatesArrayMap.get(device_id)[0].toString().split(', ')[0].replace('(','')),
                parseFloat(snappedCoordinatesArrayMap.get(device_id)[0].toString().split(', ')[1].replace(')',''))]
            );
            snappedCoordinatesMap.set(device_id, snappedCoordinatesArrayMap.get(device_id));
        }
    },

    drawRoute(device_id) {
        startPosMarkers.set(
            device_id,
            new google.maps.Marker({
                position: { lat: firstPositionMap.get(device_id)[0], lng: firstPositionMap.get(device_id)[1] },
                map: map,
                draggable: false,
                icon: startPosIcon,
            })
        );

        polylines.set(
          device_id,
          new google.maps.Polyline({
              path: snappedCoordinatesMap.get(device_id),
              strokeColor: '#000000', //old color: #add8e6 light blue
              strokeWeight: 4,
              strokeOpacity: 0.5,
          })
        );
        //draws the route path
        polylines.get(device_id).setMap(map);

        //draws marker on the user's last position
        markers.set(
            device_id,
            new google.maps.Marker({
                position: { lat: lastPositionMap.get(device_id)[0], lng: lastPositionMap.get(device_id)[1] },
                map: map,
                draggable: false,
                icon: otherUsersIcon,
            })
        );
        google.maps.event.addListener(startPosMarkers.get(device_id), 'click', () => {this.selectMarker(device_id);});
        google.maps.event.addListener(markers.get(device_id), 'click', () => {this.selectMarker(device_id);});
        google.maps.event.addListener(polylines.get(device_id), 'click', () => {this.selectMarker(device_id);});
    },

    centerMap() {
        if (this.$store.getters.getLocation == '') {
            filteredCenter = markers.get([...uniqueDeviceIdArray].pop()).getPosition();
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
        }
    },

    getDataClosestToSliderPosition(data, target){
        return data.reduce((acc, obj) =>
            Math.abs(target - new Date(obj.recorded_at).getTime()/1000) < Math.abs(target - new Date(acc.recorded_at).getTime()/1000) ? obj : acc
        );
    },

    setSliderValues() {
        var startDate = new Date(this.$store.getters.getStartDate);
        var endDate = new Date(this.$store.getters.getEndDate);

        this.slider.max = endDate.getTime()/1000.0; //epoch time in seconds
        this.slider.value = endDate.getTime()/1000.0;
        this.slider.min = startDate.getTime()/1000.0;

        exportTimestampStart = this.$store.getters.getStartDate;
        exportTimestampEnd = this.$store.getters.getEndDate;

        this.slider.disabled = false;
    },

    sliderChangeHandler(val){
        //console.log(val);
        if (selectedMarker != null) {
            markers.forEach((value, key) => {
                if (value == selectedMarker) {
                    this.updateInfoWindowValues(key);
                }
            });
        }
        deviceFullDataMap.forEach((values,keys)=>{
            var sliderPosition = this.getDataClosestToSliderPosition(values, val);
            var sliderPositionIndex = values.indexOf(sliderPosition);
            var sliderPositionLatLng = new google.maps.LatLng(sliderPosition.latitude, sliderPosition.longitude);

            if (sliderPositionIndex == values.length-1) {
                var previousPosition = values[sliderPositionIndex-1];
                var previousPositionLatLng = new google.maps.LatLng(previousPosition.latitude, previousPosition.longitude);
                var heading = google.maps.geometry.spherical.computeHeading(previousPositionLatLng, sliderPositionLatLng);

                this.moveMarker(markers.get(keys), sliderPositionLatLng, heading);
            }else{
                var nextPosition = values[sliderPositionIndex+1];
                var nextPositionLatLng = new google.maps.LatLng(nextPosition.latitude, nextPosition.longitude);
                var heading = google.maps.geometry.spherical.computeHeading(sliderPositionLatLng, nextPositionLatLng);

                this.moveMarker(markers.get(keys), sliderPositionLatLng, heading);
            }
        });
    },

    moveMarker(marker, position, heading) {
        marker.setPosition(position);
        //map.panTo(currentMarkerPos);
        marker.getIcon().rotation = heading;
        marker.setIcon(marker.getIcon());
    },

    setMarkerRotations(){
        deviceFullDataMap.forEach((values,keys)=>{
            if (values.length > 1) {
                var currentPos = values[values.length-1];
                var previousPos = values[values.length-2];
                var currentPosLatLng = new google.maps.LatLng(currentPos.latitude, currentPos.longitude);
                var previousPosLatLng = new google.maps.LatLng(previousPos.latitude, previousPos.longitude);
                var heading = google.maps.geometry.spherical.computeHeading(previousPosLatLng, currentPosLatLng);
                markers.get(keys).getIcon().rotation = heading;
                markers.get(keys).setIcon(markers.get(keys).getIcon());
            }
        });
    },

    selectMarker(device_id) {
        if(markers.get(device_id) == selectedMarker){ //unselect marker when clicking a selected marker
            infowindow.close();
            selectedPolyline = null;
            selectedMarker = null;
            markers.get(device_id).setIcon(otherUsersIcon);
            polylines.get(device_id).setOptions({strokeColor: '#000000', strokeOpacity: 0.5});
        }else{ //select a marker and unselect others
            infowindow.close();
            markers.forEach((values,keys)=>{
              values.setIcon(otherUsersIcon);
            });
            polylines.forEach((values,keys)=>{
              values.setOptions({strokeColor: '#000000', strokeOpacity: 0.5});
            });
            markers.get(device_id).setIcon(mainIcon);
            polylines.get(device_id).setOptions({strokeColor: '#FF0000', strokeOpacity: 0.9});
            selectedPolyline = polylines.get(device_id);
            selectedMarker = markers.get(device_id);

            this.updateInfoWindowValues(device_id);
            infowindow.open(map, selectedMarker);
        };
        this.setMarkerRotations();
        if (this.$store.getters.isFiltered) {
            this.sliderChangeHandler(this.slider.value);
        }
    },

    updateInfoWindowValues(device_id){
        var currentInfo = deviceFullDataMap.get(device_id).reduce(function (prev, curr) {
                var currPos = google.maps.geometry.spherical.computeDistanceBetween(selectedMarker.getPosition(), new google.maps.LatLng(curr.latitude, curr.longitude));
                var prevPos = google.maps.geometry.spherical.computeDistanceBetween(selectedMarker.getPosition(), new google.maps.LatLng(prev.latitude, prev.longitude));
                return currPos < prevPos ? curr : prev;
        });
        infowindow.setContent(
            '<strong>Selected Vehicle Data: </strong>' +
            '<br/>Latitude: ' + currentInfo.latitude +
            '<br/>Longitude: ' + currentInfo.longitude +
            '<br/>Velocity: ' + currentInfo.velocity + ' km/h' +
            '<br/>Bearing: ' + currentInfo.bearing + '&#176;' +
            '<br/>Recorded at: ' + currentInfo.recorded_at
        );
    },

    setExportStart(){
        //console.log("setExportStart");
        if (new Date(exportTimestampEnd).getTime()/1000 < this.slider.value) {
            console.log('Export Date Start must be lower than the Export Date End');
        }else{
            var startDate = new Date(this.slider.value * 1000);
            exportTimestampStart = startDate.toISOString().slice(0, 16);
        }
    },

    setExportEnd(){
        //console.log("setExportEnd");
        if (new Date(exportTimestampStart).getTime()/1000 > this.slider.value) {
            console.log('Export Date End must be higher than the Export Date Start');
        }else{
            var endDate = new Date(this.slider.value * 1000);
            exportTimestampEnd = endDate.toISOString().slice(0, 16);
        }
    },

    exportData(){
        if (this.$store.getters.isFiltered) {
            deviceExportData = new Map();
            deviceFullDataMap.forEach((values,keys)=>{
                deviceExportData.set(
                    keys,
                    values.filter(data => new Date(data.recorded_at) >= new Date(exportTimestampStart) && new Date(data.recorded_at) <= new Date(exportTimestampEnd))
                    .map(function (data) { return data; })
                    );
            });
            deviceExportData.forEach((values,keys)=>{
                if (values.length == 0) {
                    deviceExportData.delete(keys);
                }
            });
            this.downloadObjectAsJson({ Data: Array.from(deviceExportData)} ,"TrackingData");
        }else{
            this.downloadObjectAsJson({ Data: Array.from(deviceFullDataMap)} ,"TrackingData");
        }
    },

    downloadObjectAsJson(exportObj, exportName){
        var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(exportObj,null,4));
        var downloadAnchorNode = document.createElement('a');
        downloadAnchorNode.setAttribute("href",     dataStr);
        downloadAnchorNode.setAttribute("download", exportName + ".json");
        document.body.appendChild(downloadAnchorNode); // required for firefox
        downloadAnchorNode.click();
        downloadAnchorNode.remove();
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
            selectedMarker = null;
            startPosMarkers.forEach((values,keys)=>{
                values.setMap(null);
            });
            markers.forEach((values,keys)=>{
              values.setMap(null);
            });
            markers = new Map();
            polylines.forEach((values,keys)=>{
              values.setMap(null);
            });
            polylines = new Map();
            circles.forEach((circle) => {
                circle.setMap(null);
            });
            circles = [];
            this.getRouteData();
        }
    },
    '$store.state.adminLogged': {
        handler() {
            if (this.$store.getters.getAdminLogged == false) {
                this.$router.push('/login');
            };
        }
    },
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
    width: 15%;
    margin: 4px;
}
</style>

