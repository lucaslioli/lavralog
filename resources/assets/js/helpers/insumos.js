export const getInsumos = (id) => {
  return new Promise( (res, rej) => {

    axios.get(`/api/safra/insumos/${id}`)
      .then( (response) => {
        res(response.data)
      })
      .catch((err) => {
        rej("Não foi possível buscar os insumos")
      })
  })
}

export const getTypesInsumos = () => {
  return new Promise( (res, rej) => {

    axios.get(`/api/insumo_tipo`)
      .then( (response) => {
        res(response.data)
      })
      .catch((err) => {
        rej("Não foi possível buscar os tipos de insumos")
      })
  })
}