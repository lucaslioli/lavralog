<template>
  <v-app id="main">
    <!--navigation toolbar content -->
    <template v-if="currentUser">
      <v-navigation-drawer app v-model="drawer" fixed>
        <v-list dense>
          <v-list-tile @click="home">
            <v-list-tile-action>
              <v-icon>home</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Home</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          
          <v-list-tile v-if="currentUser" @click.prevent="logout">
            <v-list-tile-action>
              <v-icon>lock_open</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Sair</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-navigation-drawer>
    </template>
    
    <v-toolbar app fixed dark color="light-green darken-4">
      <v-toolbar-side-icon @click.stop="drawer = !drawer" v-if="currentUser"></v-toolbar-side-icon>
      <v-toolbar-title>Lavralog - {{currentUser ? currentUser.name : ''}} </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items>
        
        <template v-if="!currentUser">
          
          <v-btn flat>
            <router-link to="/login" >Entrar</router-link>
          </v-btn>
          <v-btn flat>
            <router-link to="/register">Cadastre-se</router-link>
          </v-btn>
        
        </template>
        <!--<template v-else>-->
          <!---->
          <!--<v-btn flat @click.prevent="logout">Sair</v-btn>-->
        <!---->
        <!--</template>-->
        <img src="../../../images/wSymbol48.png" :width="40" :height="40">
      </v-toolbar-items>
    </v-toolbar>
    
    <!--Main content app-->
    <v-content id="content">
      <router-view/>
    </v-content>
    
    <!-- footer content-->
    <v-footer app></v-footer>
  </v-app>
</template>

<script>
  export default {
    name: 'main-app',
    mounted() {
      console.log('Component mounted.')
    },
    data: () => ({
      drawer: null
    }),
    methods: {
      logout() {
        this.$store.commit('logout')
        this.$router.push('/login')
      },
      home(){
        this.$router.push('/')
      }
    },
    computed:{
      currentUser(){
        return this.$store.getters.currentUser
      }
    },
    props: {
      source: String
    }
  }
</script>
<style scoped>
  .v-btn__content a {
    text-decoration: none;
    color: #fff;
  }
</style>
