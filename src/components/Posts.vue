<script setup>
import { onMounted, reactive } from 'vue';
import { RouterLink } from 'vue-router';
import axios from 'axios';
import Post from '@/components/Post.vue';

const state = reactive({ posts: [] });

onMounted(async () =>
{
    try
    {
        const response = await axios.get('http://localhost:8080/posts');
        state.posts = response.data;
    }
    catch (error)
    {
        console.error('Error:', error);
    }
});
</script>

<template>
    <div>
        <h1>Registros</h1>
        <RouterLink to="/posts/add" class="btn">Añadir Nuevo</RouterLink>
        <table>
        <tr><th>ID</th><th>Título</th><th>Acciones</th></tr>
        <Post v-for="post in state.posts" :key="post.id" :post="post" />
        </table>
    </div>
</template>