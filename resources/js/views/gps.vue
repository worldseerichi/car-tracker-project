<template>
  <div class="g-p-s-container">
    <div class="g-p-s-image">
      <app-header rootClassName="header-root-class-name4"></app-header>
      <div class="g-p-s-bg"></div>
    </div>
    <div class="g-p-s-container1" id="map"></div>
    <div id="controlsDiv" style="width: 68%; visibility: hidden;">
        <input type="text" id="rangeSlider_id" name="rangeSlider" value="" />
    </div>
  </div>
</template>

<script>
import AppHeader from '../components/header'
import axios from 'axios';
import * as slider from '../plugins/rangeslider.js';
import { useToast } from "vue-toastification";

var map;
var controller;
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
var apiKey = process.env.MIX_API_KEY;
var uniqueDeviceIdArray = [];
const regexExp = /^((\-?|\+?)?\d+(\.\d+)?),\s*((\-?|\+?)?\d+(\.\d+)?)$/i; // regex expression for checking valid latlng
var coords;
var filteredCenter;
var circles = [];
var selectedMarker;
var startPosMarkers = new Map();
var markers = new Map();
var polylines = new Map();
var deviceDataMap = new Map();
var snappedCoordinatesMap = new Map();
var deviceRequestsRequiredMap = new Map();
var deviceRequestCounterMap = new Map();
var exportTimestampStart = 0;
var exportTimestampEnd = 0;
var deviceExportData = new Map();
var infowindow;
var rangeSlider = null;
var toastId = null;


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
    AppHeader
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
        max: 0
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
        toastId = this.toast.info("Loading data...", { timeout: false });
        var self = this;
        controller = new AbortController();
        console.log(this.$store.getters.getLocation);
        console.log(this.$store.getters.getRange);
        console.log(this.$store.getters.getStartDate);
        console.log(this.$store.getters.getEndDate);
        axios.get('api/getDataFiltered', {signal: controller.signal,
                                            params: {location: this.$store.getters.getLocation,
                                                    range: this.$store.getters.getRange,
                                                    start_date: this.$store.getters.getStartDate,
                                                    end_date: this.$store.getters.getEndDate}}).then(response => {
            if(typeof response.data === 'string'){
                this.toast.update(toastId, { content: response.data, options: { timeout: 5000, type: "error" } });
            }else{
                uniqueDeviceIdArray = [];
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
                //console.log(response.data);

                uniqueDeviceIdArray = Object.keys(response.data);
                uniqueDeviceIdArray.forEach(function(deviceId) {
                    deviceDataMap.set(
                        deviceId,
                        Object.values(response.data[deviceId]).map(function (data) { return [data.latitude, data.longitude]; })
                    )
                    deviceFullDataMap.set(
                        deviceId,
                        Object.values(response.data[deviceId]).map(function (data) { return data; })
                    )
                });

                this.centerMap();

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
                                let response = await axios.get('https://roads.googleapis.com/v1/snapToRoads', { params: {
                                    interpolate: true,
                                    key: apiKey,
                                    path: values.slice(-100).join('|')
                                    },
                                    signal: controller.signal
                                });
                                if (response.status == 200) {
                                    //response is a set of coordinates snapped to the nearest road for accuracy purposes
                                    this.processRoadsResponse(response.data, key);

                                }else{
                                    console.log('Some error occurred in snapToRoads axios request: ' + response);
                                }
                            } catch (error) {
                                this.toast.update(toastId, { content: "Something went wrong...", options: { timeout: 3000, type: "error" } });
                                console.log("snapToRoads failed due to: " + error);
                            };
                            if (values.length >= 100) {
                                values.splice(values.length-100, 100);
                            } else {
                                values.splice(0, values.length);
                                this.drawRoute(key); //draw route once all data is processed
                            }
                        }while (values.length > 0);
                    }
                })().then(() => {
                    //runs after all data is processed
                    this.setMarkerRotations();

                    controls.style.visibility = 'visible';
                    this.setSliderValues();

                    this.toast.update(toastId, { content: "Data loaded.", options: { timeout: 5000, type: "success" } });
                }).catch(error => {
                    this.toast.update(toastId, { content: "Something went wrong...", options: { timeout: 3000, type: "error" } });
                    console.log('Error in async anonymous function: ' + error);
                });
            };
        })
        .catch(e => {
            this.toast.update(toastId, { content: "Something went wrong...", options: { timeout: 3000, type: "error" } });
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
        //draws marker on the device's starting position
        startPosMarkers.set(
            device_id,
            new google.maps.Marker({
                position: { lat: firstPositionMap.get(device_id)[0], lng: firstPositionMap.get(device_id)[1] },
                map: map,
                draggable: false,
                icon: startPosIcon,
            })
        );
        //draws polyline route
        polylines.set(
          device_id,
          new google.maps.Polyline({
              path: snappedCoordinatesMap.get(device_id),
              strokeColor: '#000000', //old color: #add8e6 light blue
              strokeWeight: 4,
              strokeOpacity: 0.5,
          })
        );
        polylines.get(device_id).setMap(map);

        //draws marker on the device's last position
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
        coords = this.$store.getters.getLocation.split(",");
        filteredCenter = new google.maps.LatLng(parseFloat(coords[0]), parseFloat(coords[1]));
        map.setCenter(filteredCenter);
        map.setZoom(14);
    },

    getDataClosestToSliderPosition(data, target){
        return data.reduce((acc, obj) =>
            Math.abs(target - new Date(obj.recorded_at).getTime()/1000) < Math.abs(target - new Date(acc.recorded_at).getTime()/1000) ? obj : acc
        );
    },

    setSliderValues() {
        this.slider.min = new Date(this.$store.getters.getStartDate).getTime()/1000.0; //epoch time in seconds
        this.slider.max = new Date(this.$store.getters.getEndDate).getTime()/1000.0;
        //for date debugging
        /*console.log('store startdate: ' + this.$store.getters.getStartDate);
        console.log('store enddate: ' + this.$store.getters.getEndDate);
        console.log('slider min: ' + this.slider.min);
        console.log('slider max: ' + this.slider.max);
        console.log('slider min date: ' + new Date(this.slider.min*1000));
        console.log('slider max date: ' + new Date(this.slider.max*1000));
        console.log('slider iso min: ' + new Date(this.slider.min*1000).toISOString().slice(0, 16));
        console.log('slider iso max: ' + new Date(this.slider.max*1000).toISOString().slice(0, 16));*/
        rangeSlider = slider.ionRangeSlider('#rangeSlider_id', {
            skin: "round",
            type: "double",
            min: this.slider.min,
            max: this.slider.max,
            from: this.slider.min,
            to: this.slider.max,
            prettify_enabled: true,
            prettify: function prettify(num) {
                return new Date(num*1000).toLocaleString('pt-PT'); //show data in datetime format
            },
            onChange: pos => this.sliderChangeHandler(pos)
        });
        rangeSlider.update({
            from: this.slider.min,
            to: this.slider.max
        })
        exportTimestampStart = this.slider.min;
        exportTimestampEnd = this.slider.max;
    },

    sliderChangeHandler(pos){
        exportTimestampStart = pos.from;
        exportTimestampEnd = pos.to;
        deviceFullDataMap.forEach((values,keys)=>{
            var sliderPositionTo = this.getDataClosestToSliderPosition(values, pos.to);
            var sliderPositionToIndex = values.indexOf(sliderPositionTo);
            var sliderPositionToLatLng = new google.maps.LatLng(sliderPositionTo.latitude, sliderPositionTo.longitude);

            var sliderPositionFrom = this.getDataClosestToSliderPosition(values, pos.from);
            var sliderPositionFromLatLng = new google.maps.LatLng(sliderPositionFrom.latitude, sliderPositionFrom.longitude);
            this.moveMarker(startPosMarkers.get(keys), sliderPositionFromLatLng, 180);

            if (sliderPositionToIndex == values.length-1) {
                var previousPosition = values[sliderPositionToIndex-1];
                var previousPositionLatLng = new google.maps.LatLng(previousPosition.latitude, previousPosition.longitude);
                var heading = google.maps.geometry.spherical.computeHeading(previousPositionLatLng, sliderPositionToLatLng);

                this.moveMarker(markers.get(keys), sliderPositionToLatLng, heading);
            }else{
                var nextPosition = values[sliderPositionToIndex+1];
                var nextPositionLatLng = new google.maps.LatLng(nextPosition.latitude, nextPosition.longitude);
                var heading = google.maps.geometry.spherical.computeHeading(sliderPositionToLatLng, nextPositionLatLng);

                this.moveMarker(markers.get(keys), sliderPositionToLatLng, heading);
            }
        });
        if (selectedMarker != null) {
            markers.forEach((value, key) => {
                if (value == selectedMarker) {
                    this.updateInfoWindowValues(key);
                }
            });
        }
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
            selectedMarker = markers.get(device_id);

            this.updateInfoWindowValues(device_id);
            infowindow.open(map, selectedMarker);
        };
        this.setMarkerRotations();
        this.sliderChangeHandler({from: exportTimestampStart, to: exportTimestampEnd});
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
            '<br/>Recorded at: ' + new Date(currentInfo.recorded_at).toLocaleString('pt-PT')
        );
    },

    exportData(){
        deviceExportData = new Map();
        deviceFullDataMap.forEach((values,keys)=>{
            deviceExportData.set(
                keys,
                values.filter(data => new Date(data.recorded_at) >= new Date(exportTimestampStart*1000) && new Date(data.recorded_at) <= new Date(exportTimestampEnd*1000))
                .map(function (data) { return data; })
                );
        });
        deviceExportData.forEach((values,keys)=>{
            if (values.length == 0) {
                deviceExportData.delete(keys);
            }
        });
        this.downloadObjectAsJson({ Data: Array.from(deviceExportData)} ,"TrackingData");
        this.toast.success('Data exported successfully.', { timeout: 5000 });
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

    setup(){
        const toast = useToast();

        return { toast };
    },

    watch: {
        '$store.state.filter': {deep: true,
            handler() {
                controller.abort(); //cancel all axios requests
                controls.style.visibility = 'hidden';
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
                if (rangeSlider != null) {
                    rangeSlider.destroy();
                }
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
@import '../plugins/rangeslider.css';
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

