import { createStore } from 'vuex'

import user from './user';
import condominia from './condominia'
// import register from './register'

export default createStore({
    state: {
        teste:false
        /*
        user:{
            "name":"Jorge Nunes",
            "email":"jlbnunes@live.com",
            "avatar":"http://localhost:8087/jorgenunes.jpg",
            "token": "usodsaoiuieas2u1293sdoakdiu12"
        }
        */

    },
    getters: {

    },
    mutations: {

    },
    modules: {
        user,
        condominia
    }
})
