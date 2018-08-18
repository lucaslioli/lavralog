<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm6 md6>
        <v-card>
          <v-card-title primary-title>
            <h3 class="headline mb-0">Seu dados</h3>
          </v-card-title>
            <div class="pa-2">
              <v-form v-model="valid" @submit.prevent="register">
                <v-text-field
                  v-model="name"
                  :rules="nameRules"
                  label="Seu nome"
                  required
                ></v-text-field>
                <v-text-field
                  v-model="email"
                  :rules="emailRules"
                  label="Seu endereço de e-mail"
                  required
                ></v-text-field>
                <v-text-field
                  v-model="password"
                  :append-icon="show ? 'visibility_off' : 'visibility'"
                  :rules="passwordRules"
                  :type="show ? 'text' : 'password'"
                  name="input-10-1"
                  label="Sua senha"
                  hint="pelo menos 6 caracteres"
                  counter
                  @click:append="show = !show"
                ></v-text-field>
  
                <v-btn
                  :disabled="!valid"
                  type="submit"
                >
                  Registrar
                </v-btn>
              </v-form>
            </div>
          
        </v-card>
  
        <v-alert
          :value="!!authError"
          type="error"
        >
          {{authError}}
        </v-alert>
        
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
  import {register} from '../../helpers/auth'
  
  export default {
    name: 'register-user',
    data: () => ({
      valid: false,
      show: false,
      password: '',
      passwordRules: [
        v => !!v || 'O campo senha é obrigatório',
        v => v.length >= 6 || 'este campo precisa de pelo menos 6 caracteres'
      ],
      email: '',
      emailRules: [
        v => !!v || 'O campo e-mail é obrigatório',
        v => /.+@.+/.test(v) || 'e-mail inválido'
      ],
      name: '',
      nameRules: [
        v => !!v || 'O campo nome é obrigatório',
      ],
      error: null
    }),
    methods: {
      register() {
        this.$store.dispatch('register')
        register(this.$data)
          .then(res => {
            this.$store.commit('registerSuccess', res)
            this.$router.push({path: '/login'})
          })
          .catch(error => {
            this.$store.commit('registerFailed', {error})
          })
      }
    },
    computed: {
      authError() {
        return this.$store.getters.authError
      }
    }
  }
</script>

<style scoped>

</style>