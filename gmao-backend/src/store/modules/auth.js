export default {
  state: {
    user: null,
    token: localStorage.getItem('token') || null
  },
  mutations: {
    SET_USER(state, user) {
      state.user = user
    },
    SET_TOKEN(state, token) {
      state.token = token
      localStorage.setItem('token', token)
    }
  },
  actions: {
    async login({ commit }, credentials) {
      try {
        const response = await axios.post('/api/login', credentials)
        const { user, access_token, redirect } = response.data
        
        commit('SET_USER', user)
        commit('SET_TOKEN', access_token)
        
        return redirect // Retorna la ruta a la que debe redirigir
      } catch (error) {
        throw error
      }
    }
  }
} 