<script setup>
import { computed, defineProps, defineEmits } from 'vue'

// Recibimos las propiedades desde el componente Padre
const props = defineProps({
  id: [String, Number],
  name: String,
  color: String
})

// Emitimos los eventos hacia el Padre cuando el usuario interactúe
const emit = defineEmits(['update-color', 'delete-item'])

// Computed property para manejar clases CSS dinámicas según el color ('red' o 'green')
const cardClass = computed(() => {
  return props.color === 'green' ? 'card-green' : 'card-red';
})

const handleColorChange = (event) => {
  emit('update-color', props.id, event.target.value)
}
</script>

<template>
  <div class="crud-card" :class="cardClass">
    <div class="card-info">
      <h3>Visual ID: #{{ id }}</h3>
      <p class="alien-name">Nombre: <strong>{{ name }}</strong></p>
    </div>
    
    <div class="card-actions">
      <select :value="color" @change="handleColorChange" class="select-ux">
        <option value="red">Rojo</option>
        <option value="green">Verde</option>
      </select>
      
      <button @click="emit('delete-item', id)" class="btn-delete">
        Eliminar
      </button>
    </div>
  </div>
</template>

<style scoped>
.crud-card {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem;
  margin-bottom: 1rem;
  border-radius: 12px;
  border-left: 6px solid #cbd5e1;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
}

/* Cambios de estado visuales dinámicos para mitigar fatiga visual */
.card-red {
  background-color: #fff5f5;
  border-left-color: #f56565;
}
.card-green {
  background-color: #f0fff4;
  border-left-color: #48bb78;
}

.crud-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

.alien-name {
  font-size: 1.1rem;
  text-transform: capitalize;
}

.card-actions {
  display: flex;
  gap: 1rem;
}

.select-ux {
  padding: 0.5rem 1rem;
  border-radius: 8px;
  border: 2px solid #e2e8f0;
  background-color: white;
  font-family: inherit;
  cursor: pointer;
}

.btn-delete {
  background-color: #fee2e2;
  color: #ef4444;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s;
}

.btn-delete:hover {
  background-color: #ef4444;
  color: white;
}
</style>