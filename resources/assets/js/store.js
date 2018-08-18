import {getLocalUser} from "./helpers/auth";

const user = getLocalUser()

export default {
  state: {
    welcomeMessage: 'welcome to my vue app, fat ass hole!',
    currentUser: user,
    isLoggedIn: !!user,
    loading: false,
    auth_error: null,
    myHarvests: []
  },
  getters: {
    welcome(state) {
      return state.welcomeMessage
    },
    myHarvests(state) {
      return state.myHarvests
    },
    isLoading(state) {
      return state.loading
    },
    isLoggedIn(state) {
      return state.isLoggedIn
    },
    currentUser(state){
      return state.currentUser
    },
    authError(state){
      return state.auth_error
    }
  },
  mutations: {
    login(state) {
      state.loading = true
      state.auth_error = null
    },
    register(state) {
      state.loading = true
      state.auth_error = null
    },
    registerHarvest(state) {
      state.loading = true
      state.auth_error = null
    },
    updateHarvest(state) {
      state.loading = true
      state.auth_error = null
    },
    getMyHarvests(state) {
      state.loading = true
      state.auth_error = null
    },

    loginSuccess(state, payload) {
      state.loading = false
      state.auth_error = null
      state.isLoggedIn = true
      state.currentUser = Object.assign({}, payload.user, { token: payload.access_token })

      localStorage.setItem("user", JSON.stringify(state.currentUser))
    },
    registerSuccess(state, payload) {
      state.loading = false
      state.auth_error = null
    },
    registerSuccessHarvest(state, payload) {
      state.loading = false
      state.auth_error = null
      state.myHarvests = [ ...state.myHarvests, payload.lavoura ? payload.lavoura : '' ]
    },
    updateSuccessHarvest(state, payload) {
      state.loading = false
      state.auth_error = null
      state.myHarvests = [ ...state.myHarvests.filter(i => i.id !== payload.lavoura.id), payload.lavoura ]
    },

    getMyHarvestsSuccess(state, payload) {
      state.loading = false
      state.auth_error = null
      state.myHarvests = [...state.myHarvests, ...payload]
    },

    loginFailed(state, payload) {
      state.loading = false
      state.auth_error = payload.error
    },
    registerFailed(state, payload) {
      state.loading = false
      state.auth_error = payload.error
    },
    registerHarvestFailed(state, payload) {
      state.loading = false
      state.auth_error = payload.error
    },
    updateHarvestFailed(state, payload) {
      state.loading = false
      state.auth_error = payload.error
    },
    getMyHarvestsFailed(state, payload) {
      state.loading = false
      state.auth_error = payload.error
    },

    logout(state) {
      localStorage.removeItem("user")
      state.isLoggedIn = false
      state.currentUser = null
    }
  },
  actions: {
    login(context) {
      context.commit("login")
    },

    register(context) {
      context.commit("register")
    },

    registerHarvest(context) {
      context.commit("registerHarvest")
    },

    updateHarvest(context) {
      context.commit("updateHarvest")
    },

    getMyHarvests(context){
      context.commit("getMyHarvests")
    }
  }
}