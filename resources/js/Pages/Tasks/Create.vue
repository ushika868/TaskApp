<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BreezeLabel from '@/Components/InputLabel.vue';
import BreezeInput from '@/Components/TextInput.vue';
import BreezeTextArea from '@/Components/TextArea.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
  title: '',
  description: ''
});

const submit = () => {
  form.post(route('tasks.store'));
};
</script>

<template>
  <Head title="Dashboard"/>
  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create Task
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex items-center justify-between mb-6">
              <Link
                class="px-6 py-2 text-white bg-blue-500 rounded-md focus:outline-none"
                :href="route('tasks.index')">Back</Link>
            </div>
            <form name="createForm" @submit.prevent="submit">
              <div class="flex flex-col">
                <div class="mb-4">
                  <BreezeLabel for="title" value="Title" />
                  <BreezeInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    autofocus
                  />
                  <span class="text-red-600" v-if="form.errors.title">
                    {{ form.errors.title[0] }}
                  </span>
                </div>
                <div class="mb-4">
                  <BreezeLabel for="description" value="Description" />
                  <BreezeTextArea
                    id="description"
                    class="mt-1 block w-full"
                    v-model="form.description"
                  />
                  <span class="text-red-600" v-if="form.errors.description">
                    {{ form.errors.description[0] }}
                  </span>
                </div>
              </div>
              <div class="mt-4">
                <button
                  type="submit"
                  class="px-6 py-2 font-bold text-white bg-green-500 rounded"
                >
                  Save
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
