<script setup>
import { ref, onMounted, watch } from 'vue'
import BookForm from './components/BookForm.vue'
import BookList from './components/BookList.vue'

// Referencia reactiva que contendrá nuestra lista de libros
const books = ref([])

// Operación: CREAR (Añadir un libro)
const handleAddBook = (newBook) =>
{
  books.value.push(newBook)
}

// Operación: ACTUALIZAR (Cambiar estado leído/no leído)
const handleToggleRead = (id) =>
{
  const book = books.value.find(b => b.id === id)
  if (book)
  {
    book.leido = !book.leido
  }
}

// Operación: ELIMINAR
const handleDeleteBook = (id) =>
{
  books.value = books.value.filter(b => b.id !== id)
}

// Relación con Local Storage: Vigilamos el array "books". 
// Cada vez que cambie, se guarda automáticamente en el navegador.
watch(books, (newBooks) =>
{
  localStorage.setItem('inventario_libros', JSON.stringify(newBooks))
}, { deep: true }) // 'deep: true' sirve para escuchar cambios dentro de los objetos

// Relación con Local Storage: Al cargar la app, leemos la memoria local
onMounted(() =>
{
  const savedBooks = localStorage.getItem('inventario_libros')
  if (savedBooks)
  {
    books.value = JSON.parse(savedBooks)
  }
})
</script>

<template>
  <div class="app-container">
    <header class="app-header">
      <h1>📚 El Trabajo 4</h1>
      <p>Gestión de Inventario Local de Libros (este es el que mejor me salio)</p>
    </header>

    <main class="app-main">
      <section class="sidebar">
        <BookForm @add-book="handleAddBook" />
      </section>

      <section class="content">
        <BookList 
          :books="books" 
          @toggle-read="handleToggleRead" 
          @delete-book="handleDeleteBook" 
        />
      </section>
    </main>
  </div>
</template>

<style>
body
/* Layour 50% Mio y 50% IA */
{
  background-color: #f8fafc;
  margin: 0;
  font-family: system-ui, -apple-system, sans-serif;
}

.app-container
{
  max-width: 1100px;
  margin: 0 auto;
  padding: 2rem 1rem;
}

.app-header
{
  margin-bottom: 2.5rem;
  text-align: center;
}

.app-header h1
{
  color: #0f172a;
  font-size: 2.5rem;
  font-weight: 800;
}

.app-header p
{
  color: #64748b;
  font-size: 1.1rem;
}

.app-main
{
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

@media (min-width: 768px)
{
  .app-main
  {
    display: grid;
    grid-template-columns: 350px 1fr;
    align-items: start;
  }
}

.empty-state
{
  text-align: center;
  padding: 3rem;
  background: #fff;
  border: 2px dashed #cbd5e1;
  border-radius: 12px;
  color: #64748b;
}
</style>
