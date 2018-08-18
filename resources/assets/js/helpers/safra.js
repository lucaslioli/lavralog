export const getMySafras = (harvestId) => {
  return new Promise( (res, rej) => {
    axios.get(`/api/safra/lavoura/${harvestId}`)
      .then( (response) => {
        res(response.data)
      })
      .catch((err) => {
        rej("Não foi possível buscar suas safras")
      })
  })
}

export const storeSafra = (fields) => {
  return new Promise( (res, rej) => {
    const {titulo, ano, lavoura_id, unidade_id} = fields
    axios.post(`/api/lavoura/store`, {titulo, ano, lavoura_id, unidade_id})
      .then( (response) => {
        res(response.data)
      })
      .catch((err) => {
        rej("Não foi possível cadastrar sua safra")
      })
  })
}

export const updateSafra = (fields) => {
  return new Promise( (res, rej) => {
    const {titulo, ano, lavoura_id, unidade_id} = fields
    axios.put(`/api/safra/${id}`, {titulo, ano, lavoura_id, unidade_id})
      .then( (response) => {
        res(response.data)
      })
      .catch((err) => {
        rej("Não foi possível editar sua safra")
      })
  })
}