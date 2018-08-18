import Home from './components/Home'
import Login from './components/auth/Login'
import RegisterUser from './components/auth/RegisterUser'
import Harvest from './components/Harvest'
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
    path: '/login',
    component: Login
  },
  {
    path: '/register',
    component: RegisterUser
  }
]