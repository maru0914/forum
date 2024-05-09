<template>
    <AppLayout title="投稿の作成">
        <Container>
            <h1 class="text-2xl font-bold">投稿の作成</h1>

            <form @submit.prevent="createPost" class="mt-6">
                <div>
                    <InputLabel for="title" class="sr-only">Title</InputLabel>
                    <TextInput id="title" class="w-full" v-model="form.title" placeholder="タイトルを入力してください"/>
                    <InputError :message="form.errors.title" class="mt-1"/>
                </div>

                <div class="mt-3">
                    <InputLabel for="body" class="sr-only">本文</InputLabel>
                    <TextArea id="body" v-model="form.body" rows="25"/>
                    <InputError :message="form.errors.body" class="mt-1"/>
                </div>

                <div class="mt-3">
                    <PrimaryButton type="submit">投稿の作成</PrimaryButton>
                </div>
            </form>

        </Container>
    </AppLayout>
</template>
<script setup>
import {useForm} from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import TextArea from "@/Components/TextArea.vue";

const form = useForm({
    title: '',
    body: '',
})

const createPost = () => form.post(route('posts.store'))
</script>
