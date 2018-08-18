import {getLocalUser} from "./helpers/auth";

const user = getLocalUser()

export default {
  state: {
    welcomeMessage: 'welcome to my vue app, fat ass hole!',
    currentUser: user,
    isLoggedIn: !!user,
    loading: false,
    auth_error: null,
    myHarvests: [],
    safras: [],
    units: []
  },
  getters: {
    welcome(state) {
      return state.welcomeMessage
    },
    myHarvests(state) {
      return state.myHarvests
    },
    units(state) {
      return state.units
    },
    safras(state) {
      return state.safras
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
    registerSafra(state) {
      state.loading = true
      state.auth_error = null
    },
    updateHarvest(state) {
      state.loading = true
      state.auth_error = null
    },
    updateSafra(state) {
      state.loading = true
      state.auth_error = null
    },
    getMyHarvests(state) {
      state.loading = true
      state.auth_error = null
    },
    getSafras(state) {
      state.loading = true
      state.auth_error = null
    },
    getUnits(state) {
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
    registerSuccessSafras(state, payload) {
      state.loading = false
      state.auth_error = null
      state.safras = [ ...state.safras, payload.safra ? payload.safra : '' ]
    },

    updateSuccessHarvest(state, payload) {
      state.loading = false
      state.auth_error = null
      state.myHarvests = [ ...state.myHarvests.filter(i => i.id !== payload.lavoura.id), payload.lavoura ]
    },
    updateSuccessSafra(state, payload) {
      state.loading = false
      state.auth_error = null
      state.safras = [ ...state.safras.filter(i => i.id !== payload.safra.id), payload.safra ]
    },

    getMyHarvestsSuccess(state, payload) {
      state.loading = false
      state.auth_error = null
      state.myHarvests = [ ...payload]
    },
    getSuccessUnit(state, payload) {
      state.loading = false
      state.auth_error = null
      state.units = [ ...state.units, payload.unidades ? payload.unidades : null ]
    },
    getSuccessSafra(state, payload) {
      state.loading = false
      state.auth_error = null
      state.safras = payload
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
    registerSafraFailed(state, payload) {
      state.loading = false
      state.auth_error = payload.error
    },
    updateHarvestFailed(state, payload) {
      state.loading = false
      state.auth_error = payload.error
    },
    updateSafraFailed(state, payload) {
      state.loading = false
      state.auth_error = payload.error
    },
    getMyHarvestsFailed(state, payload) {
      state.loading = false
      state.auth_error = payload.error
    },
    getUnitsFailed(state, payload) {
      state.loading = false
      state.auth_error = payload.error
    },
    getSafraFailed(state, payload) {
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

    registerSafra(context) {
      context.commit("registerSafra")
    },

    updateSafra(context) {
      context.commit("updateSafra")
    },

    getMyHarvests(context){
      context.commit("getMyHarvests")
    },

    getUnits(context){
      context.commit("getUnits")
    },

    getSafras(context){
      context.commit("getSafras")
    }
  }
}