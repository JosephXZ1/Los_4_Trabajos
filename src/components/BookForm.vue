<script setup>
import { reactive, defineEmits } from 'vue'

const emit = defineEmits(['add-book'])

//Estado inicial del formulario vacío
const form = reactive(
{
    titulo: '',
    autor: '',
    isbn: ''
})

const handleSubmit = () =>
{
    //Se crea el nuevo objeto de libro con un ID único basado en el tiempo actual
    const newBook = 
    {
        id: Date.now(),
        titulo: form.titulo,
        autor: form.autor,
        isbn: form.isbn,
        leido: false // Por defecto inicia como no leído
    }  
    //Se envia el libro al componente padre
    emit('add-book', newBook)
    
    //Se limpia los campos del formulario
    form.titulo = ''
    form.autor = ''
    form.isbn = ''
}
</script>

<template>
    <div class="form-container">
        <h2>Añadir Nuevo Libro</h2>
        <form @submit.prevent="handleSubmit">
            <div class="input-group">
                <label for="titulo">Título del Libro/Manga</label>
                <input v-model="form.titulo" type="text" id="titulo" placeholder="Ej: Yuru's Camp" required />
            </div>

            <div class="input-group">
                <label for="autor">Autor</label>
                <input v-model="form.autor" type="text" id="autor" placeholder="Ej: Afro" required />
            </div>

            <div class="input-group">
                <label for="isbn">ISBN / Código</label>
                <input v-model="form.isbn" type="text" id="isbn" placeholder="Ej: 978-3-16-148410-0" required />
            </div>

            <button type="submit" class="btn-submit">Guardar en Inventario</button>
        </form>
    </div>
</template>

<style scoped>
.form-container
{
    background: #fff;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    margin-bottom: 2rem;
}

.input-group
{
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

label
{
    font-weight: 600;
    font-size: 0.9rem;
    color: #475569;
}

input
{
    padding: 0.75rem;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.2s;
}

input:focus
{
    outline: none;
    border-color: #3b82f6;
}

.btn-submit
{
    width: 100%;
    background-color: #3b82f6;
    color: #fff;
    border: none;
    padding: 0.75rem;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-submit:hover {background-color: #2563eb;}
</style>