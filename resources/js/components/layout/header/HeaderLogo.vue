<template>
    <router-link to="/" class="lg:hidden">
        <img
            class="dark:hidden"
            src="/public/images/logo/logo.svg"
            alt="Logo"
        />
        <img
            class="hidden dark:block"
            src="/public/images/logo/logo-dark.svg"
            alt="Logo"
        />
    </router-link>
</template>

<script setup>
import { RouterLink } from "vue-router";
</script>
