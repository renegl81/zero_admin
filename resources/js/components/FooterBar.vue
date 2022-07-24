<script setup>
import { computed } from 'vue'
import BaseLevel from '@/components/BaseLevel.vue'

const year = computed(() => new Date().getFullYear())
</script>

<template>
  <footer
    class="bg-white py-2 px-6 dark:bg-gray-900/70"
  >
    <BaseLevel>
      <div class="text-center md:text-left">
        <b>&copy; {{ year }}, <a
          href="/"
          target="_blank"
        >Zero Admin</a>.</b>
      </div>
      <div class="md:py-2">
        <a href="/e">
          <img src="/images/logo.png" class="w-auto h-8 md:h-6" />
        </a>
      </div>
    </BaseLevel>
  </footer>
</template>
