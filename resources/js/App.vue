<script setup>
import { ref, onMounted, computed } from 'vue';
import AppNavbar from './components/admin/AppNavbar.vue';
import SidebarLeft from './components/admin/SidebarLeft.vue';
import AppFooter from './components/admin/AppFooter.vue';
import { useAuthUserStore } from './stores/AuthUserStore';
import { useSettingStore } from './stores/SettingStore';

const authUserStore = useAuthUserStore();
const settingStore = useSettingStore();

const currentThemeMode = computed(() => {
    return settingStore.theme === 'dark' ? 'dark-mode' : '';
});
</script>

<template>
<div v-if="authUserStore.user.name !== ''" class="wrapper" :class="currentThemeMode" id="app">
        <AppNavbar />
        <SidebarLeft/>
        <div class="content-wrapper">
            <router-view></router-view>
        </div>
        <AppFooter />
</div>
<div v-else class="login-page" :class="currentThemeMode">
    <router-view></router-view>
</div>
</template>
