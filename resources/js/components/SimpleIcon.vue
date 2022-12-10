<script setup>
import { computed } from 'vue'

const props = defineProps({
    icon: {
    type: String,
    required: true
  },
  w: {
    type: String,
    default: 'w-6'
  },
  h: {
    type: String,
    default: 'h-6'
  },
  size: {
    type: [String, Number],
    default: 16
  }
})

const spanClass = computed(() => `inline-flex justify-center items-center ${props.w} ${props.h}`)
</script>

<template>
  <span :class="`${spanClass} mdi mdi-${icon}`"></span>
</template>
