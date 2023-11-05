import './bootstrap';

import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte/dist/js/adminlte.min.js';

import {createApp} from 'vue/dist/vue.esm-bundler.js';
import { createPinia } from 'pinia';
import { createRouter, createWebHistory } from 'vue-router';
import Routes from './routes.js';
import App from './App.vue';
// Vuetify
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import Login from './pages/auth/Login.vue';
import { useAuthUserStore } from './stores/AuthUserStore';
import { useSettingStore } from './stores/SettingStore';

const vuetify = createVuetify({
    components,
    directives
  })

const pinia = createPinia();
const app = createApp(App);

const router = createRouter({
    routes: Routes,
    history: createWebHistory(),
});

router.beforeEach(async (to, from) => {
  const authUserStore = useAuthUserStore();
  if (authUserStore.user.name === '' && to.name !== 'login') {
      const settingStore = useSettingStore();
      await Promise.all([
          authUserStore.getAuthUser(),
          settingStore.getSetting(),
      ]);
  }
});

app.use(pinia);
app.use(router);
app.use(vuetify);


app.mount('#app');
