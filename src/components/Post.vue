<script setup>
import axios from 'axios';
import { defineProps } from 'vue';
import { RouterLink, useRouter } from 'vue-router';

const router = useRouter();
const props = defineProps({ post: Object });

const deletePost = async (postId) =>
{
    if(window.confirm('¿Eliminar registro?'))
    {
        await axios.delete(`http://localhost:8080/posts/${postId}`);
        router.go(0); // Recarga simple para actualizar la vista
    }
}
</script>

<template>
    <tr>
        <td>{{ post.id }}</td>
        <td>{{ post.title }}</td>
        <td>
        <RouterLink :to="`/posts/${post.id}`">Ver</RouterLink> | 
        <RouterLink :to="`/posts/edit/${post.id}`">Editar</RouterLink> | 
        <button @click="deletePost(post.id)">Eliminar</button>
        </td>
    </tr>
</template>