<script setup>
import { onMounted, reactive } from 'vue'
import CrudComponent from '@/components/crudComponent.vue'

const state = reactive(
{
  cruds: [],
  mute: false // Bloqueo UX para evitar dobles clics asíncronos
})

// LEER (Fetch de la API de Laravel)
const fetchCruds = async () =>
{
  try
  {
    const { data } = await window.axios.get('/api/cruds')
    state.cruds = data
  }
  catch (error)
  {
    console.error("Error cargando la API de Laravel:", error)
  }
}

// CREAR
const createCrud = async () =>
{
  state.mute = true
  try
  {
    const { data } = await window.axios.get('/api/cruds/create')
    state.cruds.push(data)
  } 
  catch (error)
  {
    console.error("Error creando registro:", error)
  }
  finally
  {
    state.mute = false
  }
}

// ACTUALIZAR
const updateCrudColor = async (id, newColor) =>
{
  state.mute = true
  try
  {
    await window.axios.put(`/api/cruds/${id}`, { color: newColor })
    // Sincronizamos el estado local únicamente si el servidor aceptó el cambio
    const item = state.cruds.find(c => c.id === id)
    if (item) item.color = newColor
  }
  catch (error)
  {
    console.error("Error actualizando color:", error)
  }
  finally
  {
    state.mute = false
  }
}

// ELIMINAR
const deleteCrud = async (id) =>
{
  if (!window.confirm("¿Deseas eliminar este elemento de forma permanente?")) return
  state.mute = true
  try
  {
    await window.axios.delete(`/api/cruds/${id}`)
    state.cruds = state.cruds.filter(c => c.id !== id)
  }
  catch (error)
  {
    console.error("Error eliminando registro:", error)
  }
  finally
  {
    state.mute = false
  }
}

onMounted(() =>
{
  fetchCruds()
})
</script>

<template>
  <div class="app-viewport">
    <div v-if="state.mute" class="ux-overlay">
      <div class="spinner"></div>
    </div>

    <div class="dashboard-container">
      <header class="dash-header">
        <h1>Trabajo2 - CRUD Con el coso de Laravel</h1>
        <p>Se intento (puede que no funcione por cosas del PHP.ini segun el sistema)</p>
      </header>

      <main class="dash-content">
        <div class="action-bar">
          <button @click="createCrud" class="btn-add"> Generar Registro Aleatorio </button>
        </div>

        <div class="cards-grid">
          <div v-if="state.cruds.length === 0" class="empty-state">
            No hay registros disponibles en la base de datos SQLite.
          </div>
          
          <CrudComponent 
            v-for="item in state.cruds" 
            :key="item.id"
            :id="item.id"
            :name="item.name"
            :color="item.color"
            @update-color="updateCrudColor"
            @delete-item="deleteCrud"
          />
        </div>
      </main>
    </div>
  </div>
</template>

<style>
:root
{
  --primary-ux: #4f46e5;
  --primary-ux-hover: #4338ca;
  --bg-app: #f8fafc;
}

body
{
  margin: 0;
  font-family: 'Inter', system-ui, -apple-system, sans-serif;
  background-color: var(--bg-app);
  color: #1e293b;
}

.app-viewport
{
  position: relative;
  min-height: 100vh;
}

.dashboard-container
{
  max-width: 800px;
  margin: 0 auto;
  padding: 3rem 1.5rem;
}

.dash-header h1
{
  font-size: 2rem;
  font-weight: 800;
  letter-spacing: -0.025em;
  color: #0f172a;
}

.dash-header p
{
  color: #64748b;
  margin-top: 0.25rem;
}

.action-bar
{
  margin: 2rem 0;
}

.btn-add
{
  background-color: var(--primary-ux);
  color: white;
  border: none;
  padding: 0.75rem 1.5rem;
  border-radius: 8px;
  font-weight: 600;
  font-size: 1rem;
  cursor: pointer;
  transition: background 0.2s;
}

.btn-add:hover
{
  background-color: var(--primary-ux-hover);
}

.empty-state
{
  text-align: center;
  padding: 3rem;
  background-color: white;
  border: 2px dashed #cbd5e1;
  border-radius: 12px;
  color: #64748b;
}

/* Estilos de la capa UX Overlay (Mute) */
.ux-overlay
{
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255, 255, 255, 0.7);
  z-index: 9999;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: not-allowed;
}

.spinner
{
  width: 40px;
  height: 40px;
  border: 4px solid #e2e8f0;
  border-top-color: var(--primary-ux);
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
}

@keyframes spin
{
  to { transform: rotate(360deg); }
}
</style>