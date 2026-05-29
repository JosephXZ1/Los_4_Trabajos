<script setup>
import axios from 'axios';
import { reactive } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const form = reactive({ title: '', description: '' });

const handleSubmit = async () =>
{
    try
    {
        await axios.post('http://localhost:8080/posts', form);
        router.push('/posts');
    }
    catch (error)
    {
        console.error("Error:", error);
    }
}
</script>

<template>
    <div>
        <h2>Añadir Registro</h2>
        <form @submit.prevent="handleSubmit">
        <input v-model="form.title" placeholder="Título" required />
        <textarea v-model="form.description" placeholder="Descripción"></textarea>
        <button type="submit">Guardar</button>
        </form>
    </div>
</template>