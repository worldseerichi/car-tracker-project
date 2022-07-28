<template>
  <div class="login-container">
    <div class="login-image">
      <app-header></app-header>
      <img
        alt="image"
        src="../playground_assets/gray-vector.svg"
        class="login-image1"
      />
      <div class="login-bg"></div>
    </div>
    <form @submit.prevent="login()" class="login-container1">
      <div class="login-container2"><div class="login-container3"></div></div>
      <div class="login-container4">
        <span class="login-text">
          <span class="login-text01">Vehicle Tracker</span>
          <br />
          <span class="login-text03"><span v-html="rawxe5q"></span></span>
          <span class="login-text04">Login</span>
        </span>
        <label class="login-text05">Username</label>
        <input
          type="text"
          placeholder="username"
          id="username"
          name="username"
          v-model="user.username"
          required
          autofocus
          class="login-textinput input"
        />
        <label class="login-text06">Password</label>
        <input
          type="password"
          placeholder="password"
          id="password"
          name="password"
          v-model="user.password"
          required
          class="login-textinput1 input"
        />
        <button type="submit" class="login-button button">
          <span class="login-text07">
            <span>Login</span>
            <br />
            <span></span>
          </span>
        </button>
        <button type="button" class="login-button1 button" @click="postTestData()">
          <span class="login-text11">
            <span>Recover Password</span>
            <br />
            <span></span>
          </span>
        </button>
       <div>{{$store.getters.getKey}}</div>
      </div>
    </form>

  </div>
</template>

<script>
import AppHeader from '../components/header'
import axios from 'axios';
import { useToast } from 'vue-toastification';

export default {
  name: 'Login',
  components: {
    AppHeader,
  },

  data() {
    return {
      user:{
        username: '',
        password: ''
      },
      rawxe5q: ' ',
    }
  },

  metaInfo: {
    title: 'Login - Car_Tracker_V1',
    meta: [
      {
        property: 'og:title',
        content: 'Login - Car_Tracker_V1',
      },
    ],
  },
  methods: {
        login(){
            this.$store.commit('storeLogin', {user: this.user, self: this});
        },
        postTestData(){
            var self = this;
            var counter = 0;
            this.toast.info("Checking for data...", { id:"seed", timeout: false });
            axios.get('api/getData').then(response => {
                if(response.data == 'No data found'){
                    self.toast.update("seed", { content: "Injecting data for testing...\nPlease don't refresh the page until it is finished.", options: { timeout: false, type: "info" } }, true);
                    var path = [[39.740528602899865, -8.801482462302717],
                                [39.74075160189905, -8.802157352730438],
                                [39.74093330425473, -8.802497483177147],
                                [39.74071443545098, -8.802726623679185],
                                [39.74053135597894, -8.803011259154161],
                                [39.74042260929526, -8.803320956866743],
                                [39.74022433313928, -8.803823735183286],
                                [39.74008417990772, -8.804207564518327],
                                [39.739990574629275, -8.804476286870173],
                                [39.739921447789186, -8.804715156700068],
                                [39.73984572169747, -8.805084600595212],
                                [39.739812130312636, -8.805376157092534],
                                [39.739784513152145, -8.805619951196993],
                                [39.73974912315433, -8.806015857476725],
                                [39.73972009459938, -8.806476896567396],
                                [39.7397034186146, -8.806745969888048],
                                [39.7396719640852, -8.807087331894655],
                                [39.73964725890537, -8.807478492236239],
                                [39.7396145245286, -8.807853588493733],
                                [39.73959167221825, -8.808173263675092],
                                [39.73957808435435, -8.808492135654303],
                                [39.73955893781485, -8.80887446075865],
                                [39.73955893781485, -8.809075261754833],
                                [39.739406382937425, -8.809083293791423],
                                [39.73918496601193, -8.809035509897729],
                                [39.73899473455426, -8.80899454649327],
                                [39.738770788072564, -8.808954233408436],
                                [39.7385874705461, -8.808913337338714],
                                [39.73835429608667, -8.808864461546795],
                                [39.7380942113434, -8.8088304637156],
                                [39.73782888791849, -8.808810844701664],
                                [39.737531325289964, -8.808810666773603],
                                [39.73725517289926, -8.808831816809937],
                                [39.737035607997406, -8.808847679338625],
                                [39.73672381747343, -8.80881947930378],
                                [39.73640783627603, -8.808747617303483],
                                [39.73612019294196, -8.808675755303968],
                                [39.735835382350324, -8.808594680226568],
                                [39.735368995687686, -8.808501908404354],
                                [39.73478850972414, -8.808445010163378],
                                [39.73430731144916, -8.808557796797572],
                                [39.73408469595377, -8.808921255220609],
                                [39.73383569554578, -8.808698248284365],
                                [39.73366172453188, -8.80845379836861],
                                [39.73327067056306, -8.808497054181002]];

                    var path2 = [[39.73385903886764, -8.824208772332776],
                                [39.73395778524304, -8.823491417392402],
                                [39.73359612407674, -8.823071977746904],
                                [39.73256143083124, -8.82233589635804],
                                [39.73260295288116, -8.82161978762878],
                                [39.732960403889145, -8.820824230249205],
                                [39.7339662629056, -8.821831328380538],
                                [39.73414262189743, -8.82266286748996],
                                [39.73476103196309, -8.821842035682156]];

                    var path3 = [[39.73548330389304, -8.798739440748987],
                                [39.735576720252595, -8.799392791087145],
                                [39.73548077912329, -8.80004614139873],
                                [39.73535959013845, -8.800863650073632],
                                [39.73499602190265, -8.801901130960673],
                                [39.73457943093606, -8.803017407850172],
                                [39.73410977344407, -8.804330197557894],
                                [39.733589823817134, -8.805829400031133],
                                [39.73363524790169, -8.806975432547825],
                                [39.73384614886262, -8.807856692419147],
                                [39.734162578853514, -8.808636574572146],
                                [39.734461836891086, -8.809126193835633],
                                [39.735010064430746, -8.809861420163902],
                                [39.735492059540526, -8.81053604214423],
                                [39.7361101857373, -8.811408425654871],
                                [39.73669887220259, -8.812217015122972],
                                [39.737099911979044, -8.81278159238154],
                                [39.73764222654774, -8.813525652869817],
                                [39.7381577963373, -8.814241880236057],
                                [39.73870327553408, -8.814953531052637],
                                [39.738908430592275, -8.815180359137202]];

                    var path4 = [[39.73334723984278, -8.798830952730922],
                                [39.73373623052794, -8.799152065013145],
                                [39.734241041011344, -8.79916911521154],
                                [39.73476551552197, -8.799149223297247],
                                [39.735123904133864, -8.799115122876284],
                                [39.73544295585028, -8.79895314587818],
                                [39.73581226729351, -8.799129331382517],
                                [39.736174414485085, -8.799189736994355],
                                [39.736435075437946, -8.799295559679454],
                                [39.73668302030839, -8.799441065867452],
                                [39.73698818199866, -8.799694048226494],
                                [39.73721959538118, -8.799975139733023],
                                [39.73745736546682, -8.800295914737049],
                                [39.7377409083958, -8.80068448240656],
                                [39.73797104776375, -8.800998643501615],
                                [39.73822534451641, -8.801335953299953],
                                [39.73849362657079, -8.801712946614051],
                                [39.73876953641171, -8.802091593401583],
                                [39.73900475821439, -8.802392526654243],
                                [39.73933533884824, -8.80269511339028],
                                [39.739644303162265, -8.802860461330939],
                                [39.739986323770765, -8.80301588839483],
                                [39.74025968474488, -8.803138245875004],
                                [39.7404069794226, -8.803203182512203],
                                [39.74048115511704, -8.80306017772443],
                                [39.740562533404166, -8.802821577512647],
                                [39.74065204941234, -8.802640703168276],
                                [39.74071123348608, -8.802374202136107],
                                [39.740891004794506, -8.802383823114734],
                                [39.741041923557496, -8.802620499128118],
                                [39.74123131133936, -8.802758079083159],
                                [39.741408861913314, -8.802878341281536],
                                [39.741653644003414, -8.803026642189197]]

                    var path5 = [[39.74009738507197, -8.81253818697498],
                                [39.73991687190323, -8.812471802245193],
                                [39.73961666921884, -8.81272882275513],
                                [39.739411066505355, -8.813370530072214],
                                [39.739404974563996, -8.814129091502863],
                                [39.73941656250524, -8.814963690541724],
                                [39.73942093281391, -8.8159611277519],
                                [39.73938597033566, -8.816958564879238],
                                [39.73938597033566, -8.817512696662671],
                                [39.73939034064613, -8.818081036917992],
                                [39.73910408471437, -8.818359523649672],
                                [39.73888775310789, -8.818143554339207]];

                    var path6 = [[39.7375721622726, -8.824302000803637],
                                [39.737462703109635, -8.824169147226831],
                                [39.73732770323592, -8.82384175805542],
                                [39.73712337859623, -8.823305598999628],
                                [39.73660891566026, -8.822914155448125],
                                [39.736526820154474, -8.82210991684825],
                                [39.737083243325095, -8.821464628076287],
                                [39.73783851218413, -8.82065801712409],
                                [39.73822708931802, -8.819981887358857],
                                [39.738466972420056, -8.81936421080417],
                                [39.73867321243433, -8.818711347811494],
                                [39.73887383009016, -8.818141260936123]];
                    var total = path.length + path2.length + path3.length + path4.length + path5.length + path6.length;
                    var dataArray = [[1, path], [2, path2], [3, path3], [4, path4], [5, path5], [6, path6]]; //1,2,3 -> device_id

                    dataArray.forEach((values) => {
                        //console.log('starting post for device' + values[0]);
                        (async () => {
                            for (const value of values[1]) {
                                //console.log('sending data for device '+values[0]);
                                counter++;
                                self.toast.update("seed", { content: "Injecting data for testing...\nPlease don't refresh the page until it is finished.\nProgress: "+counter+"/"+total, options: { timeout: false, type: "info" } }, true);
                                await Promise.all([
                                axios.post('api/postDataTesting', {latitude: value[0], longitude: value[1], device_id: values[0]}),
                                new Promise(resolve => setTimeout(resolve, 2000))]);
                            }
                        })().then(() => {
                            //console.log('done device ' + values[0]);
                            if(counter == total){
                                self.toast.update("seed", { content: "Data injection complete.", options: { timeout: 5000, type: "success" } }, true);
                            }
                        });
                    });
                }else{
                    self.toast.update("seed", { content: "No data injection required.", options: { timeout: 5000, type: "info" } }, true);
                }
            });
        }
    },
    setup(){
        const toast = useToast();

        return { toast };
    }
}
</script>

<style scoped>
.login-container {
  width: 100%;
  height: auto;
  display: flex;
  min-height: 100vh;
  align-items: center;
  flex-direction: column;
  justify-content: flex-start;
  background-color: #f2f5f9ff;
}
.login-image {
  width: 100%;
  height: 301px;
  display: flex;
  position: relative;
  align-items: center;
  flex-direction: column;
  background-size: cover;
  background-image: url('https://images.unsplash.com/photo-1499336315816-097655dcfbda?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1500&q=80');
}
.login-image1 {
  left: auto;
  right: auto;
  width: 100%;
  bottom: -1px;
  z-index: 100;
  position: absolute;
  object-fit: cover;
}
.login-bg {
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
.login-container1 {
  flex: inital;
  width: 548px;
  height: 566px;
  display: flex;
  z-index: 100;
  box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1),0 10px 10px -5px rgba(0,0,0,0.04);
  margin-top: -12rem;
  align-items: flex-start;
  border-radius: 15%;
  margin-bottom: var(--dl-space-space-tripleunit);
  flex-direction: column;
  background-color: var(--dl-color-gray-white);
}
.login-container2 {
  width: 100%;
  height: 35px;
  display: flex;
  align-items: center;
  flex-direction: column;
}
.login-container3 {
  flex: 0 0 auto;
  border: 2px dashed rgba(120, 120, 120, 0.4);
  display: flex;
  align-items: center;
  flex-direction: row;
  justify-content: center;
}
.login-container4 {
  width: 100%;
  height: 398px;
  display: flex;
  position: relative;
  margin-top: 5.5rem;
  align-items: flex-end;
  margin-bottom: 20rem;
  flex-direction: column;
  justify-content: flex-end;
}
.login-text {
  color: #000000;
  align-self: stretch;
  font-style: normal;
  margin-top: 2rem;
  text-align: center;
  font-weight: 700;
  margin-left: 0px;
  margin-right: 0px;
  text-transform: uppercase;
}
.login-text01 {
  font-style: normal;
  font-weight: 700;
}
.login-text03 {
  font-style: normal;
  font-weight: 700;
}
.login-text04 {
  font-style: normal;
  font-weight: 700;
}
.login-text05 {
  color: #000000;
  align-self: center;
  font-style: normal;
  margin-top: 1rem;
  font-weight: 700;
}
.login-textinput {
  width: 339px;
  align-self: center;
}
.login-text06 {
  color: #000000;
  align-self: center;
  font-style: normal;
  font-weight: 700;
}
.login-textinput1 {
  width: 339px;
  align-self: center;
  margin-bottom: 1rem;
}
.login-button {
  width: 80px;
  height: 41px;
  display: flex;
  position: relative;
  align-self: center;
  padding-top: 0px;
  margin-bottom: 1rem;
  flex-direction: row;
  padding-bottom: 0px;
  background-color: #61ea5c;
}
.login-text07 {
  color: #000000;
  font-style: normal;
  font-weight: 700;
  padding-top: var(--dl-space-space-halfunit);
  padding-bottom: var(--dl-space-space-halfunit);
}
.login-button1 {
  width: 179px;
  height: 62px;
  align-self: center;
  padding-top: 10px;
  padding-left: var(--dl-space-space-unit);
  margin-bottom: var(--dl-space-space-doubleunit);
  padding-right: var(--dl-space-space-unit);
  padding-bottom: 10px;
  background-color: #e85454;
}
.login-text11 {
  color: #000000;
  font-style: normal;
  text-align: center;
  font-weight: 700;
}
</style>
