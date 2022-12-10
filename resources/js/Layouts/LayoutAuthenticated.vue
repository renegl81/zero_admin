<script setup>
import { computed,onMounted } from 'vue'
import { useLayoutStore } from '@/stores/layout.js'
import { useStyleStore } from '@/stores/style.js'
import NavBar from '@/components/NavBar.vue'
import AsideMenu from '@/components/AsideMenu.vue'
import FooterBar from '@/components/FooterBar.vue'
import OverlayLayer from '@/components/OverlayLayer.vue'
import axios from "axios";
import { usePage } from '@inertiajs/inertia-vue3'


const styleStore = useStyleStore()
const layoutStore = useLayoutStore()

const isAsideLgActive = computed(() => layoutStore.isAsideLgActive)
onMounted(() => {
    axios.get(usePage().props.value.zero.routePrefix+'/zero/menu-items').then(res => {
        layoutStore.setMenuItems(res.data)
    }).catch(error => {
        console.log(error)
    })
})
const overlayClick = () => {
  layoutStore.asideLgToggle(false)
}
</script>

<template>
  <div style="height: 100vh;" :class="{ 'dark': styleStore.darkMode, 'overflow-hidden lg:overflow-visible': layoutStore.isAsideMobileExpanded }">
    <div
      :class="[styleStore.appStyle, { 'ml-60 lg:ml-0': layoutStore.isAsideMobileExpanded }]"
      class="min-h-full pt-14 xl:pl-60 w-screen transition-position lg:w-auto"
    >
      <NavBar />
      <AsideMenu :menu="layoutStore.menuItems" />
      <slot />
      <FooterBar />
      <OverlayLayer
        v-show="isAsideLgActive"
        z-index="z-30"
        @overlay-click="overlayClick"
      />
    </div>
  </div>
</template>
