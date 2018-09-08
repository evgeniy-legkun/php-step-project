import Vue from 'vue';
import VueRouter  from 'vue-router';

import MainPage from '@/components/MainPage';
import Authorisation from '@/components/Authorisation';
import Registration from '@/components/Registration';

Vue.use(VueRouter );

export default new VueRouter ({
    routes: [
        {
            path: '/',
            name: 'MainPage',
            component: MainPage
        },
        {
            path: '/auth',
            name: 'Authorisation',
            component: Authorisation
        },
        {
            path: '/registration',
            name: 'Registration',
            component: Registration
        }
    ]
})
