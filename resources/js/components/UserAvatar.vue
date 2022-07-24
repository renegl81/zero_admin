<script setup>
import { computed } from 'vue'
import {usePage} from "@inertiajs/inertia-vue3";


const avatar = computed(
  () => usePage().props.value.user.data.picture ?? ''
)

const username = computed(() => usePage().props.value.user.data.name)
</script>

<template>
  <div>
    <img
      :src="avatar"
      :alt="username"
      class="rounded-full block h-auto w-full max-w-full bg-gray-100 dark:bg-gray-800"
    >
  </div>
</template>
