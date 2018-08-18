import Home from './components/Home'
import Login from './components/auth/Login'
import RegisterUser from './components/auth/RegisterUser'
import Harvest from './components/Harvest'
import Insumo from './components/Insumo'
export const routes = [
  {
    path: '/',
    component: Home,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/lavoura/:id',
    component: Harvest,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/lavoura/:id/safra/:safra_id',
    component: Insumo,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/login',
    component: Login
  },
  {
    path: '/register',
    component: RegisterUser
  }
]