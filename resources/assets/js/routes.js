import Home from './components/Home'
import Login from './components/auth/Login'
import RegisterUser from './components/auth/RegisterUser'
export const routes = [
  {
    path: '/',
    component: Home,
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