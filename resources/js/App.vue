<!-- <template>
    <router-view v-slot="{ Component, route }">
        <div :key="route.name">
            <Component :is="Component" />
        </div>
    </router-view>
</template> -->

<template>
    <ThemeProvider>
        <SidebarProvider>
            <RouterView />
        </SidebarProvider>
    </ThemeProvider>
</template>

<script setup lang="js">
import ThemeProvider from "./components/layout/ThemeProvider.vue";
import SidebarProvider from "./components/layout/SidebarProvider.vue";
</script>
