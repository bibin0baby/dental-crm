<template>
  <div>
    <Head :title="`${form.title} `" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/appointments">Appointments</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.title }} 
    </h1>
    <trashed-message v-if="appointment.deleted_at" class="mb-6" @restore="restore"> This appointment has been deleted. </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.title" :error="form.errors.title" class="pb-8 pr-6 w-full lg:w-1/2" label="Treatment Type" />
          <text-input v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full lg:w-1/2" label="Description" />
          <label class="pb-8 pr-6 w-full lg:w-1/2" >Scheduled at: <br><br>

          <input type="datetime-local" v-model="form.scheduled_at" :error="form.errors.scheduled_at"  class="pb-8 pr-6 w-full lg:w-1/2" > 
          </label>
          <select-input v-model="form.duration" :error="form.errors.duration" class="pb-8 pr-6 w-full lg:w-1/2" label="Duration" >
          <option :value="null" />
            <option > 15 minutes</option>
            <option > 30 minutes</option>
            <option > 45 minutes</option>
            <option > 1 hour</option>
            <option > 1 hour 30 minutes</option>
            <option > 2 hours</option>
            <option > 3 hours</option>

          </select-input>
         
         <text-input v-model="form.photo_path" :error="form.errors.photo_path" class="pb-8 pr-6 w-full lg:w-1/2"  accept="image/*" label="photo Path" />
         <select-input v-model="form.contact_id" :error="form.errors.contact_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Patient Name">
            <option :value="null" />
            <option v-for="contact in contacts" :key="contact.id" :value="contact.id">{{ contact.name }}</option>
          </select-input>
          <select-input v-model="form.doctor_id" :error="form.errors.doctor_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Doctor Name">
            <option :value="null" />
            <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
          </select-input>
          </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!appointment.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Appointment</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Appointment</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    appointment: Object,
    contacts: Array,
    users: Array,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        title: this.appointment.title,
        description: this.appointment.description,
        contact_id: this.appointment.contact_id,
        duration: this.appointment.duration,
        photo_path:this.appointment.photo_path,
        scheduled_at: this.appointment.scheduled_at,
        doctor_id:this.appointment.doctor_id,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(`/appointments/${this.appointment.id}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this appointment?')) {
        this.$inertia.delete(`/appointments/${this.appointment.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this appointment?')) {
        this.$inertia.put(`/appointments/${this.appointment.id}/restore`)
      }
    },
  },
}
</script>
