<template>
  <v-container fluid fill-height>
    <v-layout align-space-between column>
      
      <h6 class="headline text-xs-center myLavouras"> Insumos </h6>
      <br>
      
      <template v-if="myInsumos">
        <v-layout v-for="(insumo, key) in myInsumos" :key=key>
          <v-flex xs12 class="pa-2">
            <v-card>
              <v-card-title primary-title>
                <v-flex column>
                  <div>
                    <h3 class="headline mb-0">{{insumo}}</h3>
                  </div>
                </v-flex>
              </v-card-title>
            </v-card>
          </v-flex>
        </v-layout>
      </template>
      <template v-else>
        <h6 class="headline text-xs-center">Nenhum insumo cadastrado</h6>
      </template>
      
      
      <v-content>
        <v-container fill-height align-center justify-center>
          <div id="lateral">
            <v-fab-transition>
              <v-btn
                @click.stop="addInsumo"
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
              <v-form v-model="valid" @submit.prevent="registerInsumo()">
                <v-text-field
                  v-model="addInsumoForm.descricao"
                  label="Descrição do insumo"
                  :rules="addInsumoForm.descricaoRules"
                  required
                ></v-text-field>
                <v-flex xs12>
                  <v-combobox
                    v-model="addInsumoForm.insumos_tipo_id"
                    :items="insumoTypes"
                    :rules="addInsumoForm.insumos_tipo_id_rules"
                    required
                    label="Tipos de insumo"
                  ></v-combobox>
                </v-flex>
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
  import {getInsumos, getTypesInsumos} from '../helpers/insumos'

  export default {
    
    name: "Home",
    data: () => ({
      fab: false,
      openModal: false,
      editModal: false,
      modalTitle: 'Cadastrar um insumo',
      valid: false,
      addInsumoForm: {
        insumos_tipo_id: '',
        insumos_tipo_id_rules: [
          v => !!v || 'O campo tipo de insumo é obrigatório',
        ],
        descricao: '',
        descricaoRules: [
          v => !!v || 'O campo titulo é obrigatório',
        ],
      }
    }),
    computed: {
      myInsumos() {
        getInsumos(this.$route.params.safra_id)
          .then(res => {
            return res
          })
          .catch(error => {
            return error
          })
      },
      currentUser(){
        return this.$store.getters.currentUser
      },
      insumoTypes(){
        getTypesInsumos()
          .then(res => {
            let array = []
            res.map(i => array.push({text: i.descricao, value: i.id }))
            return array
          })
          .catch(error => {
            return error
          })
      }
    },
    methods: {
      cleanForm(){
        this.addInsumoForm.descricao = ''
        this.addInsumoForm.insumos_tipo_id = ''
      },
      addInsumo() {
        this.openModal = !this.openModal
        this.cleanForm()
      },
      registerInsumo(){
      
      },
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