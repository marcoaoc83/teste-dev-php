import Vue from 'vue'
import Router from 'vue-router'
import Main from '@/components/Main'
import Carro from '../components/Paginas/Carro'

import NotFound from '@/components/NotFound'

Vue.use(Router)

export default new Router({
  routes: [
    { path: '/', name: 'Main', component: Main},
    { path: '/carros',  component:Carro },
    { path: '/*', component:NotFound },
  ],
  mode:'history'
})
