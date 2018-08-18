<template>
  <v-container fluid fill-height>
    <v-layout align-space-around column>
      
      <div class="headline"> Minhas Lavouras </div>
      <hr>
      <br>
      
      <v-layout v-for="(harvest, key) in myHarvests" :key=key>
        <v-flex xs12>
          <v-card>
            <v-card-title primary-title>
              <div>
                <h3 class="headline mb-0">{{harvest.name}}</h3>
              </div>
            </v-card-title>
          </v-card>
        </v-flex>
      </v-layout>
      
      <v-content>
        <v-container fill-height align-center justify-center>
          <div id="lateral">
            <v-fab-transition>
              <v-btn
                @click.prevent="addHarvest"
                color="green"
                v-model="fab"
                dark
                fab
                fixed
                bottom
                right
                justify-center
              >
                <v-icon>add</v-icon>
              </v-btn>
            </v-fab-transition>
          </div>
        </v-container>
      </v-content>
    
    
    </v-layout>
  </v-container>
</template>

<script>
  import {getMyHarvests} from '../helpers/harvest'

  export default {
    
    name: "Home",
    data: () => ({
      fab: false,
    }),
    computed: {
      myHarvests() {
        return this.$store.getters.myHarvests
      },
      currentUser(){
        return this.$store.getters.currentUser
      }
    },
    methods: {
      addHarvest() {
      
      },
      getMyHarvests() {
        this.$store.dispatch('getMyHarvests')
        let user  = this.$store.getters.currentUser
        getMyHarvests(user)
          .then(res => {
            this.$store.commit('getMyHarvestsSuccess', res)
          })
          .catch(error => {
            this.$store.commit('getMyHarvestsFailed', {error})
          })
      }
    },
    created: function() {
      this.getMyHarvests();
    }
  }
</script>

<style scoped>
  #lateral .v-btn--floating {
    margin: 0 0 16px 16px;
  }

</style>