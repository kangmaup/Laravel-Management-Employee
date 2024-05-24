import { createI18n } from 'vue-i18n';
import App from '~/app.vue';
import Router from '~/router';

const i18n = createI18n({ locale: 'id', messages, missingWarn: false, fallbackWarn: false })

const app = createApp({extends: App, created() {}})

app.use(i18n)
app.use(Router)
app.mount('#app')