<template>
  <div>

    <Head title="Create Doctor" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/doctors">Doctors</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.first_name" class="pb-8 pr-6 w-full lg:w-1/2" label="First name" />
          <p v-if="errorBag.first_name" class="text-red-500">{{ errorBag.first_name }}</p>

          <text-input v-model="form.last_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Last name" />
          <p v-if="errorBag.last_name" class="text-red-500">{{ errorBag.last_name }}</p>

          <text-input v-model="form.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
          <p v-if="errorBag.email" class="text-red-500">{{ errorBag.email }}</p>

          <text-input v-model="form.password" class="pb-8 pr-6 w-full lg:w-1/2" type="password"
            autocomplete="new-password" label="Password" />
          <p v-if="errorBag.password" class="text-red-500">{{ errorBag.password }}</p>

          <select-input v-model="form.owner" class="pb-8 pr-6 w-full lg:w-1/2" label="Owner">
            <option :value="true">Yes</option>
            <option :value="false">No</option>
          </select-input>
          <p v-if="errorBag.owner" class="text-red-500">{{ errorBag.owner }}</p>

          <file-input v-model="form.photo_path" class="pb-8 pr-6 w-full lg:w-1/2" type="file" accept="image/*"
            label="Photo" />
          <p v-if="errorBag.photo_path" class="text-red-500">{{ errorBag.photo_path }}</p>
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create User</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import FileInput from '@/Shared/FileInput'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        first_name: '',
        last_name: '',
        email: '',
        password: '',
        owner: false,
        photo_path: null,
        role:'doctor',
      }),
      errorBag: {},
    }
  },
  methods: {
    async store() {
      try {
        await this.form.post('/doctors');
      } catch (error) {
        this.errorBag = error.response.data.errors; // Update this line
      }
    },
  },
}
</script>
