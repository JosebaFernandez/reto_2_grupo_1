<template>
    <div>
      <h2 class="section-title">Usuarios</h2>
      <div v-for="usuario in users" :key="usuario.idUsuario" class="card">
        <div class="card-body">
          <h5 class="card-title">
            {{ usuario.nombre }} {{ usuario.apellido }}
          </h5>
          <p class="card-text text-muted">
            <small>{{ usuario.email }}</small>
          </p>
          <p class="card-text">
            {{ formatRol(usuario.rol) }}
          </p>
          <button 
            @click="openRoleModal(usuario)" 
            class="btn btn-registrar">
            Cambiar rol
          </button>
          <button @click="toggleUserStatus(usuario)" class="btn disable-btn">
            Deshabilitar
          </button>
        </div>
      </div>

      <div class="modal fade" id="roleModal" tabindex="-1" ref="roleModal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Cambiar rol de usuario</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p class="user-name mb-2">
                <strong>Usuario:</strong> {{ selectedUser ? `${selectedUser.nombre} ${selectedUser.apellido}` : '' }}
              </p>
              <p class="mb-3">
                <strong>Rol actual:</strong> {{ formatRol(selectedUser?.rol) }}
              </p>
              <select v-model="selectedRole" class="form-select">
                <option 
                  v-for="(label, value) in availableRoles" 
                  :key="value" 
                  :value="value"
                >
                  {{ label }}
                </option>
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-registrar" @click="updateUserRole">Guardar cambios</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    name: "UsuarioList",
    data() {
      return {
        users: [],
        selectedUser: null,
        selectedRole: '',
        modal: null,
        roles: {
          admin: 'Administrador',
          tecnico: 'Técnico',
          operario: 'Operario'
        },
      };
    },
    created() {
      this.fetchUsuarios();
    },
    computed: {
      availableRoles() {
        if (!this.selectedUser) return {};
        return Object.entries(this.roles)
          .filter(([value]) => value !== this.selectedUser.rol)
          .reduce((acc, [value, label]) => {
            acc[value] = label;
            return acc;
          }, {});
      }
    },
    methods: {
      async fetchUsuarios() {
        try {
          const response = await axios.get("http://127.0.0.1:8000/api/users"); // Ajusta la URL según tu API
          this.users = response.data; 
        } catch (error) {
          console.error("Error al obtener los usuarios:", error);
        }
      },
      updateList(newUser) {
        this.users.push(newUser);
      },
      formatRol(rol) {
        return this.roles[rol] || rol;
      },
      openRoleModal(usuario) {
        this.selectedUser = usuario;
        const availableRoleKeys = Object.keys(this.availableRoles);
        this.selectedRole = availableRoleKeys.length > 0 ? availableRoleKeys[0] : '';
        this.modal.show();
      },
      async updateUserRole() {
        try {
          await axios.post(`http://127.0.0.1:8000/api/users/cambiarRol/${this.selectedUser.idUsuario}`, {
            rol: this.selectedRole
          });
          
          const userIndex = this.users.findIndex(u => u.idUsuario === this.selectedUser.idUsuario);
          if (userIndex !== -1) {
            this.users[userIndex].rol = this.selectedRole;
          }
          
          this.modal.hide();
        } catch (error) {
          console.error("Error al actualizar el rol:", error);
          this.fetchUsuarios();
        }
      },
      toggleUserStatus(user) {
        // Implementa la lógica para deshabilitar el usuario
        console.log("Deshabilitar usuario:", user);
      }
    },
    mounted() {
      // Inicializar el modal de Bootstrap
      this.modal = new bootstrap.Modal(this.$refs.roleModal);
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
  
  .card-title a {
    text-decoration: none;
    color: #007bff;
  }
  
  .card-title a:hover {
    text-decoration: underline;
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
.disable-btn {
  background-color: #dc3545;
  color: white;
  margin-right: 10px;
}
/* Estilos adicionales para el modal */
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
  