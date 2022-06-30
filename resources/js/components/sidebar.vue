<template>
    <CSidebar visible>
        <CSidebarBrand>Sidebar Brand</CSidebarBrand>
        <CSidebarNav>
            <li class="nav-title">Nav Title</li>
            <CNavItem href="#">
            <div  customClassName="nav-icon" icon="cil-speedometer"/>
            Nav item
            </CNavItem>
            <CNavItem href="#">
                <div  customClassName="nav-icon" icon="cil-speedometer"/>
                With badge
                <!--<CBadge color="primary ms-auto">NEW</CBadge>-->
            </CNavItem>
            <CNavGroup>
            <template #togglerContent>
                <div  customClassName="nav-icon" icon="cil-puzzle"/> Nav dropdown
            </template>
            <CNavItem href="#">
                <div  customClassName="nav-icon" icon="cil-puzzle"/> Nav dropdown item
            </CNavItem>
            <CNavItem href="#">
                <div  customClassName="nav-icon" icon="cil-puzzle"/> Nav dropdown item
            </CNavItem>
            </CNavGroup>
        </CSidebarNav>
        <CSidebarToggler/>
    </CSidebar>
</template>
<script>
import '@coreui/coreui/dist/css/coreui.min.css'
import { CSidebar } from '@coreui/vue';
import { CSidebarBrand } from '@coreui/vue';
import { CNavItem } from '@coreui/vue';
import { CBadge } from '@coreui/vue';
import { CNavGroup } from '@coreui/vue';
import { CSidebarNav } from '@coreui/vue';
import { CSidebarToggler } from '@coreui/vue';
export default {
  name: 'FilterSidebar',
  components: {
    CSidebar,
    CSidebarBrand,
    CNavItem,
    CBadge,
    CNavGroup,
    CSidebarNav,
    CSidebarToggler,
  },
}
</script>
