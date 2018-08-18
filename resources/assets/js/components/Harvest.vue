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
                    <h6 class="subheading mb-0"><b>Unidade:</b> {{safra.unidade.unidade}}</h6>
                  </div>
                  <div>
                    <h6 class="subheading mb-0"><b>Produção:</b> {{safra.producao}}</h6>
                  </div>
                  <div>
                    <h6 class="subheading mb-0"><b>Valor Unitário:</b> {{safra.valor_unitario}}</h6>
                  </div>
                  <div>
                    <h6 class="subheading mb-0"><b>Receita total:</b> R$ {{(parseFloat(safra.producao) || 0.0) * (parseFloat(safra.valor_unitario) || 0.0)}}</h6>
                  </div>
                </v-flex>
              </v-card-title>
              <v-card-actions>
                <v-btn flat color="green" @click="accessInsumo(safra)">Acessar Insumos</v-btn>
                <v-btn flat color="orange" @click="editSafra(safra)">Editar</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </template>
      <template v-else>
        <h6 class="headline text-xs-center myLavouras"> Nenhuma safra cadastrada para esta lavoura</h6>
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
                  v-model="addSafraForm.ano"
                  label="Ano da Safra"
                  :rules="addSafraForm.anoRules"
                  required
                ></v-text-field>
                <v-text-field
                  v-model="addSafraForm.cultura"
                  label="Cultura da Safra"
                  :rules="addSafraForm.culturaRules"
                  required
                ></v-text-field>
                <v-flex xs12>
                  <v-combobox
                    v-model="addSafraForm.unidade_id"
                    :items="allUnits"
                    :rules="addSafraForm.unitRules"
                    required
                    label="Unidade de medida da Produção"
                  ></v-combobox>
                </v-flex>
                <v-text-field
                  if="editModal"
                  v-model="addSafraForm.producao"
                  label="Produção da Safra"
                  :rules="addSafraForm.producaoRules"
                  required
                ></v-text-field>
                <v-text-field
                  if="editModal"
                  v-model="addSafraForm.valor_unitario"
                  label="Valor unitário da Safra"
                  :rules="addSafraForm.valor_unitarioRules"
                  required
                ></v-text-field>
                <v-text-field
                  if="editModal"
                  
                  label="Receita total da Safra"
                  :value="addSafraForm.producao * addSafraForm.valor_unitario"
                  :rules="addSafraForm.receita_totalRules"
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
  import {getUnits} from '../helpers/unit'

  export default {
    
    name: "Home",
    data: () => ({
      fab: false,
      openModal: false,
      editModal: false,
      modalTitle: 'Cadastrar uma Safra',
      valid: false,
      addSafraForm: {
        ano: '',
        anoRules: [
          v => !!v || 'O campo ano é obrigatório',
          v => v.length >= 4 || 'O campo ano precisa ter 4 digitos',
        ],
        unidade_id: '',
        unitRules: [
          v => !!v || 'O campo unidade é obrigatório',
        ],
        cultura: '',
        culturaRules: [
          v => !!v || 'O campo cultura é obrigatório',
        ],
        producao: '',
        producaoRules: [
          v => !!v || 'O campo producao é obrigatório',
        ],
        valor_unitario: '',
        valor_unitarioRules: [
          v => !!v || 'O campo valor unitario é obrigatório',
        ],
        receita_total: '',
        receita_totalRules: [
          v => !!v || 'O campo receita total é obrigatório',
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
        return this.$store.getters.myHarvests.filter(i => i.id == this.$route.params.id)[0] || []
      },
      allUnits(){
        let array = []
        this.$store.getters.units.map(i => array.push({text: i.unidade, value: i.id}))
        return array
      }
      
    },
    methods: {
      getAllUnits(){
        this.$store.dispatch('getUnits')
        getUnits()
          .then(res => {
            this.$store.commit('getSuccessUnit', res)
          })
          .catch(error => {
            this.$store.commit('getUnitsFailed', {error})
          })
      },
      cleanForm(){
        this.addSafraForm.unidade_id = ''
        this.addSafraForm.id = ''
        this.addSafraForm.ano = ''
        this.addSafraForm.cultura = ''
        this.addSafraForm.producao = ''
        this.addSafraForm.valor_unitario = ''
        this.addSafraForm.receita_total = ''
      },
      addSafra() {
        this.openModal = !this.openModal
        this.cleanForm()
      },
      editSafra(values) {
        this.openModal = !this.openModal
        this.editModal = true
        this.modalTitle = 'Editar '+ values.ano,
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
          storeSafra({...this.addSafraForm, lavoura_id: this.$route.params.id, unidade_id: this.addSafraForm.unidade.id})
          .then(res => {
            this.$store.commit('registerSuccessSafras', res)
            this.openModal = false
          })
          .catch(error => {
            this.$store.commit('registerSafraFailed', {error})
            alert(error)
          })
      },
      updateSafra(){
        this.$store.dispatch('updateSafra')
       
        updateSafra({...this.addSafraForm, lavoura_id: this.$route.params.id, unidade_id: this.addSafraForm.unidade_id.value})
          .then(res => {
            this.$store.commit('updateSuccessSafra', res)
            this.openModal = !this.openModal
            this.editModal = false
          })
          .catch(error => {
            this.$store.commit('updateSafraFailed', {error})
            alert(error)
          })

        this.openModal = false
      },
      accessInsumo(safra){
        this.$router.push({path: '/lavoura/'+this.$route.params.id+'/safra/'+safra.id})
      }
    },
    created: function() {
      this.getMySafras();
      this.getAllUnits()
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