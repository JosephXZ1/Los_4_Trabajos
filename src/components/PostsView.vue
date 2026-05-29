<script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const state = reactive({ post: {} });

onMounted(async () =>
{
    const response = await axios.get(`http://localhost:8080/posts/${route.params.id}`);
    state.post = response.data;
});
</script>

<template>
    <div>
        <h1>{{ state.post.title }}</h1>
        <p>{{ state.post.description }}</p>
        <RouterLink to="/posts">Volver</RouterLink>
    </div>
</template>