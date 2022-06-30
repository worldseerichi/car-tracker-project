<template>
    <div class="flex-container">
        <div class="flex-child" id="sidebar"><FilterSidebar/></div>
        <div class="flex-child" id="router"><router-view/></div>
    </div>
</template>

<script>
import FilterSidebar from '../components/sidebar'
import '@coreui/coreui/dist/css/coreui.min.css'
export default {
  name: 'AppContainer',
  components: {
    FilterSidebar,
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
