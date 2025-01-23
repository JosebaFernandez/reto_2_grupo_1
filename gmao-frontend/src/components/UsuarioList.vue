<template>
  <div>
    <!-- Sección principal que lista los usuarios -->
    <h2 class="section-title">Usuarios</h2>
    <div v-for="usuario in usuarios" :key="usuario.idUsuario" class="card">
      <div class="card-body">
        <h5 class="card-title">
          {{ usuario.nombre }} {{ usuario.apellido }}
        </h5>
        <p class="card-text text-muted">
          <small>{{ usuario.email }}</small>
        </p>
        <p class="card-text">
          {{ formatearRol(usuario.rol) }}
        </p>
        <button @click="abrirModalRol(usuario)" class="btn btn-registrar">
          Cambiar rol
        </button>
        <button @click="abrirModalDeshabilitar(usuario)" class="btn btn-deshabilitar">
          Deshabilitar
        </button>
      </div>
    </div>

    <!-- Modal para cambio de rol -->
    <div class="modal" id="roleModal" tabindex="-1" ref="roleModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Cambiar rol de usuario</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p class="mb-2">
              <strong>Usuario:</strong> {{ usuarioSeleccionado ? `${usuarioSeleccionado.nombre} ${usuarioSeleccionado.apellido}` : '' }}
            </p>
            <p class="mb-3">
              <strong>Rol actual:</strong> {{ formatearRol(usuarioSeleccionado?.rol) }}
            </p>
            <select v-model="rolSeleccionado" class="form-select">
              <option v-for="(etiqueta, valor) in rolesDisponibles" :key="valor" :value="valor">
                {{ etiqueta }}
              </option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-registrar" @click="actualizarRolUsuario">Guardar cambios</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal para deshabilitar usuario -->
    <div class="modal" id="disableModal" tabindex="-1" ref="disableModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Deshabilitar usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p class="mb-2">
              <strong>Usuario:</strong> {{ usuarioSeleccionado ? `${usuarioSeleccionado.nombre} ${usuarioSeleccionado.apellido}` : '' }}
            </p> 
            <p class="mb-3">
              <strong>Rol actual:</strong> {{ formatearRol(usuarioSeleccionado?.rol) }}
            </p>
            <p class="mb-3">
              <strong>¿Estás seguro de que deseas deshabilitar este usuario?</strong>
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-registrar" @click="deshabilitarUsuario">Deshabilitar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "ListaUsuarios",
  data() {
    return {
      // Lista de usuarios obtenidos de la API
      usuarios: [],
      // Usuario seleccionado para cambiar rol o deshabilitar
      usuarioSeleccionado: null,
      // Rol seleccionado en el modal de cambio de rol
      rolSeleccionado: '',
      // Referencias a las instancias de los modales
      modalRol: null,
      modalDeshabilitar: null,
      // Mapeo de roles del sistema a nombres legibles e inclusivos
      roles: {
        admin: 'Administrador/a',
        tecnico: 'Técnico/a',
        operario: 'Operario/a'
      },
    };
  },
  created() {
    this.obtenerUsuarios();
  },
  computed: {
    // Calcula los roles disponibles excluyendo el rol actual del usuario
    rolesDisponibles() {
      if (!this.usuarioSeleccionado) return {};
      return Object.entries(this.roles)
        .filter(([valor]) => valor !== this.usuarioSeleccionado.rol)
        .reduce((acumulador, [valor, etiqueta]) => {
          acumulador[valor] = etiqueta;
          return acumulador;
        }, {});
    }
  },
  methods: {
    // Obtiene la lista de usuarios desde la API
    async obtenerUsuarios() {
      try {
        const respuesta = await axios.get("http://127.0.0.1:8000/api/users"); 
        this.usuarios = respuesta.data; 
      } catch (error) {
        console.error("Error al obtener los usuarios:", error);
      }
    },

    // Añade un nuevo usuario a la lista local
    actualizarLista(nuevoUsuario) {
      this.usuarios.push(nuevoUsuario);
    },

    // Convierte el código del rol a su nombre legible
    formatearRol(rol) {
      return this.roles[rol] || rol;
    },

    // Configura y muestra el modal de cambio de rol
    abrirModalRol(usuario) {
      this.usuarioSeleccionado = usuario;
      const clavesRolesDisponibles = Object.keys(this.rolesDisponibles);
      this.rolSeleccionado = clavesRolesDisponibles.length > 0 ? clavesRolesDisponibles[0] : '';
      this.modalRol.show();
    },

    // Envía la solicitud de actualización de rol a la API
    async actualizarRolUsuario() {
      try {
        await axios.post(`http://127.0.0.1:8000/api/users/cambiarRol/${this.usuarioSeleccionado.idUsuario}`, {
          rol: this.rolSeleccionado
        });
        
        // Actualiza el rol en la lista local sin necesidad de recargar
        const indiceUsuario = this.usuarios.findIndex(usuario => usuario.idUsuario === this.usuarioSeleccionado.idUsuario);
        if (indiceUsuario !== -1) {
          this.usuarios[indiceUsuario].rol = this.rolSeleccionado;
        }
        
        this.modalRol.hide();
      } catch (error) {
        console.error("Error al actualizar el rol:", error);
        // Si hay un error, recarga la lista completa para asegurar consistencia
        this.obtenerUsuarios();
      }
    },

    // Configura y muestra el modal de deshabilitación
    abrirModalDeshabilitar(usuario) {
      this.usuarioSeleccionado = usuario;
      this.modalDeshabilitar.show();
    },

    // Envía la solicitud de deshabilitación a la API
    async deshabilitarUsuario() {
      try {
        await axios.post(`http://127.0.0.1:8000/api/users/deshabilitar/${this.usuarioSeleccionado.idUsuario}`);
        this.usuarios = this.usuarios.filter(usuario => usuario.idUsuario !== this.usuarioSeleccionado.idUsuario);
        this.modalDeshabilitar.hide();
      } catch (error) {
        console.error("Error al deshabilitar el usuario:", error);
      }
    }
  },
  mounted() {
    this.modalRol = new bootstrap.Modal(this.$refs.roleModal);
    this.modalDeshabilitar = new bootstrap.Modal(this.$refs.disableModal);
  },
};
</script>

<style scoped>
.card {
  background-color: white;
  border: none;
  border-top: 1px solid #414d5b;
  margin-bottom: 1em;
  border-radius: 0;
}

.card-body {
  padding: 20px;
}

.card-title {
  font-size: 1.25rem;
  font-weight: bold;
}

.btn-sm {
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
}

.ms-2 {
  margin-left: 0.5rem;
}
.btn-registrar {
background-color: #84005d;
color: white;
margin-right: 10px;
}
.btn-deshabilitar {
background-color: #dc3545;
color: white;
margin-right: 10px;
}

.modal-dialog {
  max-width: 400px;
}

:deep(.modal-backdrop.show) {
  opacity: 0.5;
}

:deep(.modal.fade .modal-dialog) {
  transform: translate(0, 0);
}

.mb-3 {
  margin-bottom: 1rem;
}

.mb-2 {
  margin-bottom: 0.5rem;
}

.user-name {
  font-size: 1.1em;
}

</style>
  