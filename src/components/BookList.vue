<script setup>
import { defineProps, defineEmits } from 'vue'

defineProps(
{
    books: Array
})

defineEmits(['toggle-read', 'delete-book'])
</script>

<template>
    <div class="list-container">
        <h2>Mis Libros ({{ books.length }})</h2>
        
        <div v-if="books.length === 0" class="empty-state">
            Inventario está vacío. Agrega un libro
        </div>

        <div v-else class="books-grid">
            <div v-for="book in books" :key="book.id" class="book-card" :class="{ 'is-read': book.leido }">
                <div class="book-info">
                    <h3>{{ book.titulo }}</h3>
                    <p class="author">por <span>{{ book.autor }}</span></p>
                    <p class="isbn">ISBN: {{ book.isbn }}</p>
                </div>
                
                <div class="card-actions">
                    <button @click="$emit('toggle-read', book.id)" class="btn-status">
                        {{ book.leido ? '✓ Leído' : ' marcar como leído' }}
                    </button>
                    <button @click="$emit('delete-book', book.id)" class="btn-delete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.books-grid
{
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-top: 1rem;
}

.book-card
{
    background: #eaf2ff;
    border-radius: 12px;
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    transition: transform 0.2s, border-color 0.2s;
}

.book-card.is-read
{
    border-top-color: #10b981;
    background-color: #f0fdf4;
}

h3
{
    font-size: 1.2rem;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.author
{
    color: #64748b;
    font-size: 0.95rem;
    margin-bottom: 0.25rem;
}

.author span { font-weight: 500; color: #334155; }

.isbn
{
    font-size: 0.85rem;
    color: #94a3b8;
    font-family: monospace;
}

.card-actions
{
    display: flex;
    gap: 0.5rem;
    margin-top: 1.5rem;
}

button
{
    flex: 1;
    padding: 0.5rem;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.85rem;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-status
{
    background-color: #e2e8f0;
    color: #475569;
}

.is-read .btn-status
{
    background-color: #d1fae5;
    color: #065f46;
}

.btn-delete
{
    background-color: #fee2e2;
    color: #991b1b;
}

.btn-delete:hover { background-color: #fca5a5; }
</style>