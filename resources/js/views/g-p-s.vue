<template>
  <div class="g-p-s-container">
    <div class="g-p-s-image">
      <app-header></app-header>
      <img
        alt="image"
        src="../playground_assets/gray-vector.svg"
        class="g-p-s-image1"
      />
      <div class="g-p-s-bg"></div>
    </div>
    <div class="g-p-s-container1">
      <div class="g-p-s-container2">
        <div class="g-p-s-container3">
          <svg viewBox="0 0 1024 1024" class="g-p-s-icon">
            <path
              d="M512 490q44 0 75-31t31-75-31-75-75-31-75 31-31 75 31 75 75 31zM512 86q124 0 211 87t87 211q0 62-31 142t-75 150-87 131-73 97l-32 34q-12-14-32-37t-72-92-91-134-71-147-32-144q0-124 87-211t211-87z"
            ></path>
          </svg>
          <!--<span class="g-p-s-text textSM"><span>Leiria, Portugal</span></span>-->
          <span id="location" class="g-p-s-text textSM"><span>loading...</span></span>
        </div>
      </div>
      <div class="g-p-s-container4" id="map"></div>
    </div>
    <app-footer></app-footer>
  </div>
</template>

<script>
import AppHeader from '../components/header'
import AppFooter from '../components/footer'
import axios from 'axios';

var map;
var snappedCoordinates = [];
var lastPosition = new Map();
var apiKey = process.env.MIX_API_KEY;
var span;

export default {
  name: 'GPS',
  components: {
    AppHeader,
    AppFooter,
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
        span = document.getElementById("location");
        this.getRouteData();
        },

    getRouteData() {
        var path =  [[39.73988390271169, -8.803012287344243],
                     [39.74084526081704, -8.802359366435601],
                     [39.74004168723268, -8.804373422691963],
                     [39.73980177796016, -8.805855464918467],
                     [39.73957817225259, -8.808845159503642],
                     [39.74023501196083, -8.809599398558404],
                     [39.7413180850293, -8.810380899271072],
                     [39.740947745839435, -8.811389580421277],
                     [39.73975985194463, -8.812580005920537],
                     [39.73943143060917, -8.814724589267373],
                     [39.73937552894832, -8.816905521485008],
                     [39.73873265660185, -8.818931971002364],
                     [39.737243698832735, -8.82156880700348],
                     [39.73528091211661, -8.82357019623503],
                     [39.73387345567432, -8.823229660163358],
                     [39.73263077411064, -8.821333051586823],
                     [39.733978469984486, -8.82185651555642],
                     [39.735069293462466, -8.820662083889975]];
        axios.get('/getData').then(response => {
            //console.log(response);
            //response will be path coordinates of current logged in user

            //snapToRoads takes up to 100 GPS points, current position plus 99 previous positions (slice)
            axios.get('https://roads.googleapis.com/v1/snapToRoads', { params: {
            interpolate: true,
            key: apiKey,
            path: path.slice(-100).join('|')
            }
            }).then(response => {
                //console.log(response.data.snappedPoints);
                //response is a set of coordinates snapped to the nearest road for accuracy purposes
                this.processRoadsResponse(response.data);

                var mapOptions =
                    {
                        zoom : 16,
                        center : {
                            lat: lastPosition.get('lat'),
                            lng: lastPosition.get('lng')
                        }
                    };
                map = new google.maps.Map(document.getElementById("map"), mapOptions); //creates and initializes the map

                this.drawRoute(); //draws the current user's driven path from the previous 100 coordinates

                //get street name
                const geocoder = new google.maps.Geocoder();
                geocoder
                    .geocode({ location: {lat: lastPosition.get('lat'), lng: lastPosition.get('lng') } })
                    .then((response) => {
                        if (response.results[0]) {
                            span.textContent = response.results[0].formatted_address;
                        } else {
                            span.textContent = "Unrecognized location";
                        }
                    })
                    .catch((e) => console.log("Geocoder failed due to: " + e));
            })
            .catch(e => {
                console.log("snapToRoads failed due to: " + e);
            });
        })
        .catch(e => {
            console.log("getData failed due to: " + e);
        });
    },

    processRoadsResponse(data) {
        snappedCoordinates = [];
        for (var i = 0; i < data.snappedPoints.length; i++) {
            var latlng = new google.maps.LatLng(
                data.snappedPoints[i].location.latitude,
                data.snappedPoints[i].location.longitude);
            snappedCoordinates.push(latlng);
        }
        //sets the current user's last coordinates
        lastPosition.set('lat', data.snappedPoints[data.snappedPoints.length-1].location.latitude);
        lastPosition.set('lng', data.snappedPoints[data.snappedPoints.length-1].location.longitude);
    },

    drawRoute() {
        var snappedPolyline = new google.maps.Polyline({
            path: snappedCoordinates,
            strokeColor: '#add8e6',
            strokeWeight: 4,
            strokeOpacity: 0.9,
        });
        //draws the route path
        snappedPolyline.setMap(map);

        var icon = {
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
        //draws marker on the user's last position
        const marker = new google.maps.Marker({
            position: { lat: lastPosition.get('lat'), lng: lastPosition.get('lng') },
            map: map,
            draggable: false,
            icon: icon,
        });
    },
  },
  mounted() {
    this.initMap()
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
  background-image: url('https://images.unsplash.com/photo-1499336315816-097655dcfbda?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1500&q=80');
}
.g-p-s-image1 {
  left: auto;
  right: auto;
  width: 100%;
  bottom: -1px;
  z-index: 100;
  position: absolute;
  object-fit: cover;
}
.g-p-s-bg {
  top: auto;
  flex: 0 0 auto;
  left: auto;
  right: 0px;
  width: 100%;
  bottom: auto;
  height: 100%;
  display: flex;
  opacity: 0.5;
  position: absolute;
  align-items: flex-start;
  flex-direction: column;
  background-color: var(--dl-color-gray-black);
}
.g-p-s-container1 {
  width: 100%;
  height: 623px;
  display: flex;
  z-index: 100;
  box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1),0 10px 10px -5px rgba(0,0,0,0.04);
  margin-top: -12rem;
  align-items: flex-start;
  border-radius: var(--dl-radius-radius-radius75);
  margin-bottom: var(--dl-space-space-tripleunit);
  flex-direction: column;
  background-color: var(--dl-color-gray-white);
}
.g-p-s-container2 {
  width: 100%;
  height: 35px;
  display: flex;
  align-items: center;
  flex-direction: column;
}
.g-p-s-container3 {
  flex: 0 0 auto;
  display: flex;
  align-items: center;
  flex-direction: row;
  justify-content: center;
}
.g-p-s-icon {
  fill: var(--dl-color-secondary-500);
  width: 18px;
  height: 18px;
}
.g-p-s-text {
  color: var(--dl-color-secondary-500);
  margin-top: var(--dl-space-space-halfunit);
  font-weight: 600;
  margin-left: var(--dl-space-space-halfunit);
  margin-bottom: var(--dl-space-space-halfunit);
}
.g-p-s-container4 {
  width: 100%;
  border: 2px dashed rgba(120, 120, 120, 0.4);
  height: 549px;
  display: flex;
  margin-top: 3px;
  align-items: center;
  margin-bottom: var(--dl-space-space-tripleunit);
  flex-direction: column;
}
</style>
