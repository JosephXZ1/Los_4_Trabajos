<script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();
const form = reactive({ title: '', description: '' });

onMounted(async () =>
{
    const response = await axios.get(`http://localhost:8080/posts/${route.params.id}`);
    form.title = response.data.title;
    form.description = response.data.description;
});

const handleSubmit = async () =>
{
    await axios.put(`http://localhost:8080/posts/${route.params.id}`, form);
    router.push('/posts');
}
</script>

<template>
    <div>
        <h2>Editar Registro</h2>
        <form @submit.prevent="handleSubmit">
        <input v-model="form.title" required />
        <textarea v-model="form.description"></textarea>
        <button type="submit">Actualizar</button>
        </form>
    </div>
</template>