<script setup>
import { RouterLink } from 'vue-router';
</script>

<template>
    <div class="center-container home-page">
        <header class="home-header">
            <h1>Trabajo 1 - Sistema de gestión</h1>
            <p class="subtitle">
                Aplicación CRUD desarrollada con Vue 3 (Composition API), Vue Router y Axios.
            </p>
        </header>

        <main class="home-content">
            <div class="card">
                <h3>Panel de Control</h3>
                <p>Con la API simulada se pueden añadir, ver y quitar registros y eso que se hace en los CRUD.</p>

                <RouterLink to="/posts" class="btn btn-blue btn-large"> Gestionar Registros </RouterLink>
            </div>
        </main>

        <footer class="home-footer">
            <p>Rama1 del repositorio Github</p>
        </footer>
    </div>
</template>

<style scoped>
/* Unos estilos rápidos y limpios para que no se vea plano (estos fueron generados por IA, debo admitir) */
.home-page
{
    text-align: center;
    padding: 2rem;
    font-family: sans-serif;
    max-width: 800px;
    margin: 0 auto;
}

.home-header h1
{
    color: #2c3e50;
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}

.subtitle
{
    color: #7f8c8d;
    font-size: 1.1rem;
}

.home-content {margin: 3rem auto;}

.card
{
    background: #f8f9fa;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.card h3
{
    color: #34495e;
    margin-top: 0;
}

.card p
{
    color: #5a6c7d;
    margin-bottom: 2rem;
    line-height: 1.5;
}

.btn-large
{
    font-size: 1.2rem;
    padding: 0.8rem 2rem;
    display: inline-block;
    text-decoration: none;
}

.home-footer
{
    margin-top: 5rem;
    font-size: 0.9rem;
    color: #bdc3c7;
    border-top: 1px solid #ecf0f1;
    padding-top: 1rem;
}
</style>