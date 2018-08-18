<template>
  <v-container fluid fill-height>
    <v-layout align-space-between column>
      
      <h6 class="headline text-xs-center myLavouras"> Minhas Lavouras </h6>
      <br>
      
      <v-layout v-for="(harvest, key) in myHarvests" :key=key>
        <v-flex xs12 class="pa-2">
          <v-card>
            <v-card-title primary-title>
              <v-flex column>
                <div>
                  <h3 class="headline mb-0">{{harvest.titulo}}</h3>
                </div>
                <div>
                  <h6 class="subheading mb-0"><b>Área:</b> {{harvest.area}} hectares</h6>
                </div>
              </v-flex>
            </v-card-title>
            <v-card-actions>
              <v-btn flat color="green" @click="accessHarvest(harvest)">Acessar</v-btn>
              <v-btn flat color="orange" @click="editHarvest(harvest)">Editar</v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
      
      <v-content>
        <v-container fill-height align-center justify-center>
          <div id="lateral">
            <v-fab-transition>
              <v-btn
                @click.stop="addHarvest"
                color="amber darken-1"
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
  
      <v-dialog
        v-model="openModal"
      >
        <v-flex xs12>
          <v-card>
            <v-card-title primary-title>
              <h3 class="headline mb-0">{{modalTitle}}</h3>
            </v-card-title>
            <div class="pa-2">
              <v-form v-model="valid" @submit.prevent="editModal ? updateHarvest() : registerHarvest()">
                <v-text-field
                  v-model="addHarvestForm.titulo"
                  :rules="addHarvestForm.tituloRules"
                  label="Titulo da Lavoura"
                  required
                ></v-text-field>
                <v-text-field
                  v-model="addHarvestForm.descricao"
                  label="Descrição da Lavoura"
                  :rules="addHarvestForm.descricaoRules"
                  required
                ></v-text-field>
                <v-text-field
                  v-model="addHarvestForm.area"
                  label="Área da Lavoura"
                  :rules="addHarvestForm.areaRules"
                  required
                ></v-text-field>
                <v-btn
                  :disabled="!valid"
                  type="submit"
                >
                  Salvar
                </v-btn>
              </v-form>
            </div>
          </v-card>
        </v-flex>
      </v-dialog>
    
    
    </v-layout>
  </v-container>
</template>

<script>
  import {getMyHarvests, storeHarvest, updateHarvest} from '../helpers/harvest'

  export default {
    
    name: "Home",
    data: () => ({
      fab: false,
      openModal: false,
      editModal: false,
      modalTitle: 'Cadastrar uma Lavoura',
      valid: false,
      addHarvestForm: {
        titulo: '',
        tituloRules: [
          v => !!v || 'O campo titulo é obrigatório',
        ],
        descricao: '',
        descricaoRules: [
          v => !!v || 'O campo titulo é obrigatório',
        ],
        area: '',
        areaRules: [
          v => !!v || 'O campo titulo é obrigatório',
        ],
      }
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
      cleanForm(){
        this.addHarvestForm.descricao = ''
        this.addHarvestForm.titulo = ''
        this.addHarvestForm.area = ''
      },
      addHarvest() {
        this.openModal = !this.openModal
        this.cleanForm()
      },
      accessHarvest(harvest) {
        this.$router.push({path: '/lavoura/'+harvest.id})
      },
      editHarvest(values) {
        this.openModal = !this.openModal
        this.editModal = true
        this.modalTitle = 'Editar '+ values.titulo,
        this.addHarvestForm = values
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
      },
      registerHarvest(){
        this.$store.dispatch('registerHarvest')
        let user  = this.$store.getters.currentUser
        storeHarvest({...this.addHarvestForm, user_id: user.id})
          .then(res => {
            this.$store.commit('registerSuccessHarvest', res)
            this.openModal = false
          })
          .catch(error => {
            this.$store.commit('registerHarvestFailed', {error})
            alert(error)
          })
      },
      updateHarvest(){
        this.$store.dispatch('updateHarvest')
        let user  = this.$store.getters.currentUser
        updateHarvest({...this.addHarvestForm, user_id: user.id})
          .then(res => {
            this.$store.commit('updateSuccessHarvest', res)
            this.openModal = false
          })
          .catch(error => {
            this.$store.commit('updateHarvestFailed', {error})
            alert(error)
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
  
  .myLavouras {
    font-size: 1.5rem !important;
  }

</style>