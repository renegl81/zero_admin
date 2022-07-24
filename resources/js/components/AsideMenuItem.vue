<script setup>
import { ref, computed } from 'vue'
import { useStyleStore } from '@/stores/style.js'
import { mdiMinus, mdiPlus } from '@mdi/js'
import BaseIcon from '@/components/BaseIcon.vue'
import AsideMenuList from '@/components/AsideMenuList.vue'
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps({
  item: {
    type: Object,
    required: true
  },
  isSubmenuList: Boolean
})

const emit = defineEmits(['menu-click'])

const styleStore = useStyleStore()

const isDropdownActive = ref(false)

const hasDropdown = computed(() => !!props.item.menu)

const menuClick = event => {
  emit('menu-click', event, props.item)

  if (hasDropdown.value) {
    isDropdownActive.value = !isDropdownActive.value
  }
}
</script>

<template>
  <li>
    <component
      :is="item.to ? Link : 'a'"
      v-slot="vSlot"
      :to="item.to || null"
      :href="item.to || null"
      :target="item.target || null"
      class="flex cursor-pointer dark:hover:bg-gray-700/50"
      :class="[ styleStore.asideMenuItemStyle, isSubmenuList ? 'p-3 text-sm' : 'py-2' ]"
      @click="menuClick"
    >
      <BaseIcon
        v-if="item.icon"
        :path="item.icon"
        class="flex-none"
        :class="[ vSlot && vSlot.isExactActive ? styleStore.asideMenuItemActiveStyle : styleStore.asideMenuItemInactiveStyle ]"
        w="w-12"
      />
      <span
        class="grow"
        :class="[ vSlot && vSlot.isExactActive ? styleStore.asideMenuItemActiveStyle : styleStore.asideMenuItemInactiveStyle ]"
      >{{ item.label }}</span>
      <BaseIcon
        v-if="hasDropdown"
        :path="isDropdownActive ? mdiMinus : mdiPlus"
        class="flex-none"
        :class="[ vSlot && vSlot.isExactActive ? styleStore.asideMenuItemActiveStyle : styleStore.asideMenuItemInactiveStyle ]"
        w="w-12"
      />
    </component>
    <AsideMenuList
      v-if="hasDropdown"
      :menu="item.menu"
      :class="[ styleStore.asideSubmenuListStyle, isDropdownActive ? 'block dark:bg-gray-800/50' : 'hidden' ]"
      is-submenu-list
    />
  </li>
</template>
