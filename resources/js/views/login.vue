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
                    var path = [[39.741342837418635, -8.799732829421936, 110, 55],
                                [39.74111751641062, -8.799342125175528, 170, 30],
                                [39.74062180756493, -8.799381195606452, 185, 45],
                                [39.74015613843143, -8.799654688622917, 225, 25],
                                [39.74012609515348, -8.800182139440388, 290, 40],
                                [39.74028382221663, -8.800748660688782, 285, 60],
                                [39.740636829087904, -8.801832865107905, 293, 40],
                                [39.740922237584456, -8.802497062433607, 270, 30],
                                [39.74068940442607, -8.802751020234613, 240, 45],
                                [39.7400509868869, -8.804352907719064, 242, 55],
                                [39.73987996672344, -8.805047873437607, 260, 58],
                                [39.739763009805245, -8.806194461750371, 265, 50],
                                [39.73958307569825, -8.808698236187993, 265, 0],
                                [39.73958307569825, -8.808698236187993, 265, 0],
                                [39.73958307569825, -8.808698236187993, 265, 0],
                                [39.73958307569825, -8.808698236187993, 265, 0],
                                [39.73958307569825, -8.808698236187993, 265, 5],
                                [39.73943013130847, -8.809131131760898, 170, 25],
                                [39.738638413895714, -8.808955633549761, 170, 56],
                                [39.73778370873563, -8.808815234948073, 180, 54],
                                [39.73669506891362, -8.808826934822745, 170, 60],
                                [39.734400771692094, -8.808522737896732, 225, 15],
                                [39.73411641811329, -8.808916917984066, 170, 30],
                                [39.73375518374231, -8.808773955839433, 195, 26],
                                [39.733431411806414, -8.80916687702066, 225, 50],
                                [39.73300783434703, -8.809563689085754, 200, 58]];

                    var path2 = [[39.732358573362035, -8.795186137284627, 315, 40],
                                [39.73292167223155, -8.796189804826678, 295, 45],
                                [39.73318082190871, -8.796822922745914, 293, 40],
                                [39.733327411190984, -8.797479867660325, 270, 55],
                                [39.7333300288568, -8.798708661018182, 270, 35],
                                [39.733604882909, -8.799113720326472, 340, 30],
                                [39.73396873564251, -8.799188605193592, 0, 50],
                                [39.73448888288774, -8.799158339307466, 3, 55],
                                [39.73510930235922, -8.7991581488922, 20, 3],
                                [39.735421271173436, -8.798942261841953, 0, 25],
                                [39.73564749329191, -8.799101211647827, 354, 35],
                                [39.73596493275444, -8.799160521282538, 350, 45],
                                [39.73661514608954, -8.799382969108573, 330, 40],
                                [39.73722045581602, -8.799956992779629, 315, 60],
                                [39.7377798709109, -8.800738460649567, 315, 85],
                                [39.73825495629932, -8.80139084648817, 314, 57],
                                [39.738680020858574, -8.801967331993009, 314, 46],
                                [39.73901386487446, -8.80240859563815, 323, 44],
                                [39.73950277012884, -8.802802411574582, 340, 40],
                                [39.74012849082187, -8.803075235869692, 340, 35],
                                [39.74039094660201, -8.803198516156762, 345, 0],
                                [39.74039094660201, -8.803198516156762, 345, 0],
                                [39.74039094660201, -8.803198516156762, 345, 4],
                                [39.7405152201425, -8.802920065360556, 64, 40],
                                [39.740648258757936, -8.802547080560418, 88, 30],
                                [39.74086270722246, -8.802332729689432, 305, 35],
                                [39.74102152320243, -8.8025898229016, 305, 40],
                                [39.741238628938255, -8.802766143778546, 333, 45]];

                    var path3 = [[39.743087996484185, -8.793262558015735, 165, 15],
                                [39.742840078588685, -8.793505323847034, 185, 40],
                                [39.74223048844191, -8.793562222095488, 160, 58],
                                [39.74165664131555, -8.793301854132661, 190, 4],
                                [39.741141632798836, -8.793334685812031, 155, 40],
                                [39.74068216117267, -8.793186943279052, 185, 65],
                                [39.739623970651536, -8.793368247100409, 185, 80],
                                [39.73831599731251, -8.79358407070962, 185, 75],
                                [39.737222256123104, -8.793960762096736, 200, 45],
                                [39.73668064967503, -8.794391142483464, 232, 55],
                                [39.736271997094, -8.795172494876132, 245, 60],
                                [39.7358958099084, -8.796354435143456, 248, 58],
                                [39.73558021504662, -8.797588906077948, 265, 52],
                                [39.735504472064115, -8.798669068136395, 275, 34],
                                [39.73549942252912, -8.7988660581881, 276, 2],
                                [39.73549942252912, -8.7988660581881, 276, 0],
                                [39.73549942252912, -8.7988660581881, 276, 0],
                                [39.73549942252912, -8.7988660581881, 276, 3],
                                [39.73564080937082, -8.799187808592773, 260, 35],
                                [39.73548427392136, -8.799716398525511, 270, 45],
                                [39.73541610514457, -8.800717764575358, 247, 60],
                                [39.734898525207846, -8.80219190674079, 245, 75],
                                [39.73430599467313, -8.803809587889635, 245, 80],
                                [39.73365511319296, -8.805632120168578, 250, 65],
                                [39.73355531081755, -8.806608275166832, 287, 60],
                                [39.73385757980487, -8.807853776163583, 294, 63],
                                [39.73441051486756, -8.809052132291198, 312, 68],
                                [39.734948296775926, -8.809777712269339, 312, 70],
                                [39.73578844787007, -8.810954777951942, 313, 70],
                                [39.73676986536124, -8.812306416410996, 313, 65],
                                [39.73771718481496, -8.813575353329787, 312, 70],
                                [39.738890255376084, -8.815322151027168, 275, 55],
                                [39.73910484987021, -8.817164294648489, 272, 29],
                                [39.739109899142896, -8.817512310390324, 287, 0],
                                [39.739109899142896, -8.817512310390324, 287, 0],
                                [39.739109899142896, -8.817512310390324, 287, 0],
                                [39.739109899142896, -8.817512310390324, 287, 0],
                                [39.739109899142896, -8.817512310390324, 287, 0]];

                    var path4 = [[39.727201754879694, -8.835031795254709, 67, 110],
                                [39.72783569753179, -8.832915846289058, 78, 75],
                                [39.727848716319755, -8.831115884044774, 86, 55],
                                [39.72838827034319, -8.830357393279206, 358, 60],
                                [39.72968881060256, -8.830432113800784, 5, 38],
                                [39.729967062541554, -8.829649514699542, 101, 56],
                                [39.72976744713379, -8.82822195965108, 105, 60],
                                [39.72915347491346, -8.82622023638598, 104, 45],
                                [39.72933192060307, -8.825299994285944, 8, 40],
                                [39.7299035486144, -8.825453367989713, 333, 45],
                                [39.73076551839524, -8.825583145743108, 9, 65],
                                [39.73167913589273, -8.825357093601227, 2, 70],
                                [39.73318487555922, -8.825261170863943, 3, 67],
                                [39.73424088538286, -8.824763432673798, 54, 54],
                                [39.73451004613467, -8.824232523770899, 84, 12],
                                [39.73451307040672, -8.82403195817188, 93, 0],
                                [39.73451307040672, -8.82403195817188, 93, 0],
                                [39.73451307040672, -8.82403195817188, 93, 0],
                                [39.73451307040672, -8.82403195817188, 93, 0],
                                [39.73451307040672, -8.82403195817188, 93, 7],
                                [39.73440337173929, -8.823631542005236, 134, 30],
                                [39.73384615214406, -8.823193105011502, 156, 45],
                                [39.733126572350194, -8.822835239781215, 155, 50],
                                [39.73258625136063, -8.822339481504686, 156, 10],
                                [39.732399410406806, -8.822149057799622, 96, 23],
                                [39.73263169908299, -8.821469442141856, 90, 20],
                                [39.73279329074763, -8.820734012658743, 46, 8],
                                [39.73326543921479, -8.821134559083248, 321, 29],
                                [39.73385877628451, -8.82173209555707, 322,  26],
                                [39.73415165568358, -8.821824024239861, 51, 25],
                                [39.73448240591382, -8.821305283749933, 51, 24]]

                    var path5 = [[39.73731545028931, -8.823808409142316, 113, 54],
                                [39.73711003919351, -8.823259960760797, 137, 67],
                                [39.736592138292814, -8.822876331063904, 127, 55],
                                [39.73649626838376, -8.822219050747147, 54, 62],
                                [39.73698035132304, -8.821638343898142, 50, 73],
                                [39.737878546707705, -8.820615179658612, 51, 99],
                                [39.73849811886665, -8.819293701808325, 65, 115],
                                [39.73882127430586, -8.818453210951366, 78, 94],
                                [39.7388793411384, -8.81814459323691, 95, 0],
                                [39.7388793411384, -8.81814459323691, 95, 0],
                                [39.7388793411384, -8.81814459323691, 95, 0],
                                [39.7388793411384, -8.81814459323691, 95, 0],
                                [39.7388793411384, -8.81814459323691, 95, 0],
                                [39.7388793411384, -8.81814459323691, 95, 0],
                                [39.7388793411384, -8.81814459323691, 95, 0]];

                    var path6 = [[39.740074248756564, -8.816229549268176, 144, 35],
                                [39.739786534564416, -8.816096971829106, 180, 32],
                                [39.739458040516055, -8.816096971827882, 182, 0],
                                [39.73941273086565, -8.816120541150447, 258, 28],
                                [39.73938072416132, -8.81687916056579, 270, 55],
                                [39.73937619319292, -8.817618648021169, 274, 38],
                                [39.739379218803855, -8.818095345690587, 246, 45],
                                [39.739109083348914, -8.818328450585106, 152, 38],
                                [39.7388793411384, -8.81814459323691, 114, 0],
                                [39.7388793411384, -8.81814459323691, 114, 0],
                                [39.7388793411384, -8.81814459323691, 114, 0],
                                [39.7388793411384, -8.81814459323691, 114, 0],
                                [39.7388793411384, -8.81814459323691, 114, 0],
                                [39.7388793411384, -8.81814459323691, 114, 0],
                                [39.7388793411384, -8.81814459323691, 114, 0]];
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
                                axios.post('api/postDataTesting', {latitude: value[0], longitude: value[1], bearing: value[2], velocity: value[3], device_id: values[0]}),
                                new Promise(resolve => setTimeout(resolve, 2000))]);
                            }
                        })().then(() => {
                            //console.log('done device ' + values[0]);
                            if(counter == total){
                                self.toast.update("seed", { content: "Data injection complete.", options: { timeout: 5000, type: "success" } }, true);
                                this.$store.commit('resetFilter');
                            }
                        });
                    });
                }else{
                    self.toast.update("seed", { content: "No data injection required.", options: { timeout: 5000, type: "info" } }, true);
                }
            }).catch(err => {
                self.toast.update("seed", { content: "Error: "+err, options: { timeout: 5000, type: "error" } }, true);
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
