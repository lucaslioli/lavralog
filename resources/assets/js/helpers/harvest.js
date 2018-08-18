export const getMyHarvests = (user) => {
  return new Promise( (res, rej) => {
    axios.get(`/api/lavoura/user/${user.id}`)
      .then( (response) => {
        res(response.data)
      })
      .catch((err) => {
        rej("Não foi possível buscar suas lavouras")
      })
  })
}