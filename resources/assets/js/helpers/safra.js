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
    const { ano, lavoura_id, cultura, unidade_id} = fields
    axios.post(`/api/safra/store`, { ano, lavoura_id, cultura, unidade_id})
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
    const {id, ano, lavoura_id, unidade, cultura, producao, valor_unitario, receita_total} = fields
    axios.put(`/api/safra/${id}`, { ano, lavoura_id, unidade_id : unidade.id, cultura, producao, valor_unitario, receita_total})
      .then( (response) => {
        res(response.data)
      })
      .catch((err) => {
        rej("Não foi possível editar sua safra")
      })
  })
}