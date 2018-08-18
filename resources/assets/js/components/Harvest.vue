<template>
  <v-container fluid fill-height>
    <v-layout align-space-between column>
      
      <h6 class="headline text-xs-center myLavouras"> Lavoura {{currentHarvest.titulo}} </h6>
      <br>
      
      <template v-if="mySafras.length">
        <v-layout v-for="(safra, key) in mySafras" :key=key>
          <v-flex xs12 class="pa-2">
            <v-card>
              <v-card-title primary-title>
                <v-flex column>
                  <div>
                    <h3 class="headline mb-0">{{safra.ano}}</h3>
                  </div>
                  <div>
                    <h6 class="subheading mb-0"><b>Cultura:</b> {{safra.cultura}}</h6>
                  </div>
                  <div>
                    <h6 class="subheading mb-0"><b>Unidade:</b> {{safra}}</h6>
                  </div>
                </v-flex>
              </v-card-title>
              <v-card-actions>
                <!--<v-btn flat color="green" @click="">Acessar</v-btn>-->
                <v-btn flat color="orange" @click="editSafra(safra)">Editar</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </template>
      <template v-else>
        <h6 class="headline text-xs-center myLavouras"> Nenhuma Safra cadastrada para esta lavoura</h6>
      </template>
      
      
      <v-content>
        <v-container fill-height align-center justify-center>
          <div id="lateral">
            <v-fab-transition>
              <v-btn
                @click.stop="addSafra"
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
              <v-form v-model="valid" @submit.prevent="editModal ? updateSafra() : registerSafra()">
                <v-text-field
                  v-model="addSafraForm.titulo"
                  :rules="addSafraForm.tituloRules"
                  label="Titulo da Safra"
                  required
                ></v-text-field>
                <v-text-field
                  v-model="addSafraForm.ano"
                  label="Ano da Safra"
                  :rules="addSafraForm.anoRules"
                  required
                ></v-text-field>
                <v-text-field
                  v-model="addSafraForm.unit"
                  label="Unidade de medida da Produção"
                  :rules="addSafraForm.unitRules"
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
  import {getMySafras, storeSafra, updateSafra} from '../helpers/safra'

  export default {
    
    name: "Home",
    data: () => ({
      fab: false,
      openModal: false,
      editModal: false,
      modalTitle: 'Cadastrar uma Lavoura',
      valid: false,
      addSafraForm: {
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
      mySafras() {
        return this.$store.getters.safras
      },
      currentUser(){
        return this.$store.getters.currentUser
      },
      currentHarvest(){
        return this.$store.getters.myHarvests.filter(i => i.id == this.$route.params.id)[0]
      }
    },
    methods: {
      cleanForm(){
        this.addSafraForm.descricao = ''
        this.addSafraForm.titulo = ''
        this.addSafraForm.area = ''
      },
      addSafra() {
        this.openModal = !this.openModal
        this.cleanForm()
      },
      editSafra(values) {
        this.openModal = !this.openModal
        this.editModal = true
        this.modalTitle = 'Editar '+ values.titulo,
        this.addSafraForm = values
      },
      getMySafras() {
        this.$store.dispatch('getSafras')
        
        getMySafras(this.$route.params.id)
          .then(res => {
            this.$store.commit('getSuccessSafra', res)
          })
          .catch(error => {
            this.$store.commit('getSafraFailed', {error})
          })
      },
      registerSafra(){
        this.$store.dispatch('registerSafra')
        let user  = this.$store.getters.currentUser
        storeSafra({...this.addSafraForm, user_id: user.id})
          .then(res => {
            this.$store.commit('registerSuccessSafra', res)
            this.openModal = false
          })
          .catch(error => {
            this.$store.commit('registerSafraFailed', {error})
            alert(error)
          })
      },
      updateSafra(){
        this.$store.dispatch('updateSafra')
        let user  = this.$store.getters.currentUser
        updateSafra({...this.addSafraForm, user_id: user.id})
          .then(res => {
            this.$store.commit('updateSuccessSafra', res)
            this.openModal = false
          })
          .catch(error => {
            this.$store.commit('updateSafraFailed', {error})
            alert(error)
          })
      }
    },
    created: function() {
      this.getMySafras();
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