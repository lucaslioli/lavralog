export const login = (credentials) => {
  return new Promise( (res, rej) => {
    const {email, password} = credentials
   axios.post('/api/auth/login', {email, password} )
     .then( (response) => {
       res(response.data)
     })
     .catch((err) => {
       rej("Sua senha ou e-mail estão incorretos")
     })
  })
}

export const register = (credentials) => {
  return new Promise( (res, rej) => {
    const {email, password, name} = credentials
    axios.post('/api/auth/register', {email, password, name} )
      .then( (response) => {
        res(response.data)
      })
      .catch((err) => {
        rej("Erro ao registrar seu usuário")
      })
  })
}

export const getLocalUser = () => {
  const userStr = localStorage.getItem("user")

  if (!userStr) {
    return null
  }

  return JSON.parse(userStr)
}