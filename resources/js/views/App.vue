<template>
    <div class="app" style="display: flex">
        <Sidebar/>
        <router-view/>
    </div>

</template>

<script>
import Sidebar from '../components/sidebar'
import '@coreui/coreui/dist/css/coreui.min.css'
export default {
  name: 'AppContainer',
  components: {
    Sidebar,
  },
  data(){
    return {

    }
  },
  methods: {

  },
  watch: {
    '$store.state.adminLogged': {
        handler() {
            this.$store.commit('toggleRandomBoolean'); //fixes bug with adminLogged state not commiting to store
        }
    }
  }
}
</script>
<style scoped>
.flex-container {
    display: flex;
}

.flex-child {
    flex: 1;
}
#sidebar{
    flex: auto;
    overflow-y: auto;
}
#router{
    flex: 100 0 auto;
    display: flex;
    flex-direction: column;
}
</style>
