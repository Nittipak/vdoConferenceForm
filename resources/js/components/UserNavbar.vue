<script setup>
import { useSettingStore } from '../stores/SettingStore';
import { useAuthUserStore } from '../stores/AuthUserStore';
import { useRouter } from 'vue-router';

const router = useRouter();
const authUserStore = useAuthUserStore();

const settingStore = useSettingStore();

const logout = () => {
    axios.post('/logout')
    .then((response) => {
        authUserStore.user.name = '';
        router.push('/login');
    });
};
</script>

<template>
    <nav class="navbar navbar-expand" :class="settingStore.theme === 'dark' ? 'navbar-dark': 'navbar-light'">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="/home" active-class="active" class="nav-link">
                    <p>
                        Home
                    </p>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="/form/create" active-class="active" class="nav-link">
                    <p>
                        Video Conference Form
                    </p>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item d-none d-sm-inline-block">
                <a @click.prevent="settingStore.changeTheme" href="#" class="nav-link">
                    <i class="far" :class="settingStore.theme === 'dark' ? 'fa-moon' : 'fa-sun'"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>

            <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <p class="nav-link">
                                {{ authUserStore.user.name }}
                        </p>
                    </li>
                    <li class="nav-item">
                        <a href="#" @click.prevent="logout" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>                             
                        </a>
                    </li>
                </ul>
            </div>
        </ul>
        
    </nav>
</template>
