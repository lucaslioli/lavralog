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

export const storeHarvest = (fields) => {
  return new Promise( (res, rej) => {
    const {titulo, descricao, area, user_id} = fields
    axios.post(`/api/lavoura/store`, {titulo, descricao, area, user_id})
      .then( (response) => {
        res(response.data)
      })
      .catch((err) => {
        rej("Não foi possível cadastrar sua lavoura")
      })
  })
}

export const updateHarvest = (fields) => {
  return new Promise( (res, rej) => {
    const {titulo, descricao, area, user_id, id} = fields
    axios.put(`/api/lavoura/${id}`, {titulo, descricao, area, user_id})
      .then( (response) => {
        res(response.data)
      })
      .catch((err) => {
        rej("Não foi possível cadastrar sua lavoura")
      })
  })
}