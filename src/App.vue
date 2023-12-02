<script setup>
import { provide, ref } from 'vue';
import { RouterView } from 'vue-router';

const isRouterAlive = ref(true);

const reload = () => {
  isRouterAlive.value = false;
  isRouterAlive.value = true; // 直接更新响应式对象
};

provide('reload', reload);
</script>

<template>
  <div id="app" v-if="isRouterAlive">
    <KeepAlive v-if="$route.meta.KeepAlive">
      <RouterView />
    </KeepAlive>
    <RouterView v-else />
  </div>
</template>

<style scoped></style>