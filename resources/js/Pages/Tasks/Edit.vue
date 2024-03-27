<script setup>
import { defineProps } from 'vue';
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BreezeLabel from '@/Components/InputLabel.vue';
import BreezeInput from '@/Components/TextInput.vue';
import BreezeTextArea from '@/Components/TextArea.vue';
import BreezeDropDown from '@/Components/Dropdown.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const setStatus = (status) => {
    form.status = status;
};

const props = defineProps({
  task: Object,
});

const form = useForm({
  title: props.task.title,
  description: props.task.description,
  status: props.task.status,
  priority: props.task.priority
});

const submit = () => {
  form.put(route('tasks.update', props.task.id));
};
</script>

<template>
  <Head title="Dashboard" />
  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Task</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex items-center justify-between mb-6">
              <Link class="px-6 py-2 text-white bg-blue-500 rounded-md focus:outline-none" :href="route('tasks.index')">Back</Link>
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
                <div class="mb-4">
                  <BreezeLabel for="status" value="Status" />
                  <BreezeDropDown align="left" width="48">
                      <template #trigger>
                        <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm font-medium text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                          {{ form.status || 'Status' }} <!-- Show selected value or 'Status' if none selected -->
                        </button>
                      </template>

                      <template #content>
                          <ul class="py-1 bg-white">
                              <li @click="setStatus('pending')" class="cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white">Pending</li>
                              <li @click="setStatus('in_progress')" class="cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white">In Progress</li>
                              <li @click="setStatus('completed')" class="cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white">Completed</li>
                          </ul>
                      </template>
                  </BreezeDropDown>
                  <span class="text-red-600" v-if="form.errors.status">
                    {{ form.errors.status[0] }}
                  </span>
                </div>
                 <div class="mb-4">
                  <BreezeLabel for="priority" value="Priority" />
                  <BreezeInput
                    id="priority"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.priority"
                    autofocus
                  />
                  <span class="text-red-600" v-if="form.errors.priority">
                    {{ form.errors.priority[0] }}
                  </span>
                </div>
              </div>
              <div class="mt-4">
                <button type="submit" class="px-6 py-2 font-bold text-white bg-green-500 rounded">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
