<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
  tasks: Array,
});

const form = useForm();

function destroy(id) {
  if (confirm("Are you sure you want to Delete")) {
    form.delete(route('tasks.destroy', id));
  }
}
</script>

<template>
  <Head title="Dashboard" />
  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laravel 9 Vue JS CRUD App -Tasks Management</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div v-if="$page.props.success" class="mb-4 text-green-500">{{ $page.props.success }}</div>
            <div class="flex items-center justify-between mb-6">
              <Link class="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none" :href="route('tasks.create')">Create Task</Link>
            </div>
            <table class="table-fixed w-full">
              <thead>
                <tr class="bg-gray-100">
                  <th class="px-4 py-2 w-20">No.</th>
                  <th class="px-4 py-2">Title</th>
                  <th class="px-4 py-2">Description</th>
                  <th class="px-4 py-2">Status</th>
                  <th class="px-4 py-2">Priority</th>
                  <th class="px-4 py-2">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="task in tasks" :key="task.id">
                  <td class="border px-4 py-2">{{ task.id }}</td>
                  <td class="border px-4 py-2">{{ task.title }}</td>
                  <td class="border px-4 py-2">{{ task.description }}</td>
                  <td class="border px-4 py-2">{{ task.status }}</td>
                  <td class="border px-4 py-2">{{ task.priority }}</td>
                  <td class="border px-4 py-2">
                    <Link tabIndex="1" class="px-4 py-2 text-sm text-white bg-blue-500 rounded" :href="route('tasks.edit', task.id)">Edit</Link>
                    <button @click="destroy(task.id)" tabIndex="-1" type="button" class="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>