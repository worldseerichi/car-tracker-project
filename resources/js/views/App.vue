<template>
    <!--<div class="flex-container">
        <div class="flex-child" id="sidebar"><FilterSidebar/></div>
        <div class="flex-child" id="router"><router-view/></div>
    </div>-->
    <!--<div style="width: 100%; display: table;">
        <div style="display: table-row">
            <div style="width: 1px; display: table-cell;"><Sidebar/></div>
            <div style="display: table-cell;"><router-view/></div>
        </div>
    </div>-->
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
