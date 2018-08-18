export const getUnits = () => {
  return new Promise( (res, rej) => {
    axios.get(`/api/unidade`)
      .then( (response) => {
        res(response.data)
      })
      .catch((err) => {
        rej("Não foi possível buscar as unidades")
      })
  })
}