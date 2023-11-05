<script setup>
import { useAuthUserStore } from '../../stores/AuthUserStore';
import { useRouter } from 'vue-router';
import { useSettingStore } from '../../stores/SettingStore';

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
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar mt-2">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">{{ authUserStore.user.name }}</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <router-link to="/admin/dashboard" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Dashboard
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/forms_list" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                รายการคำขอ
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/users_list" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                All Users
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/profile" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Profile
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <form class="nav-link">
                            <a href="#" @click.prevent="logout">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </form>

                    </li>
                </ul>
            </nav>
            

        </div>

    </aside>
</template>
