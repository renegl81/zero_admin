<template>
    <div
        id="login-left-splash"
        :style="{ 'background-image': `url(${backUrl})` }"
        class="sticky flex-col justify-between hidden p-16 w-full overflow-hidden sm:flex bg-cover bg-center bg-no-repeat"
    >
    </div>
</template>

<script setup>
import {computed} from "vue";
const backUrl = computed(() => {
        let n = Math.floor(Math.random() * 4)
        return "/images/splash/" + n + ".jpg";
});
</script>
