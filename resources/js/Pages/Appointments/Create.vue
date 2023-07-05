<template>
  <div>
    <Head title="Book Appointents"/>
   
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/appointments">Appointments</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
         
          <text-input v-model="form.title" :error="form.errors.title" class="pb-8 pr-6 w-full lg:w-1/2" label="Treatment Type" />
          <text-input v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full lg:w-1/2" label="Description" />
          <!-- <text-input v-model="form.scheduled_at" :error="form.errors.scheduled_at"  class="pb-8 pr-6 w-full lg:w-1/2" label="scheduled at" /> -->
          <label class="pb-8 pr-6 w-full lg:w-1/2" >Scheduled at: <br><br>

        <input type="datetime-local" v-model="form.scheduled_at" :error="form.errors.scheduled_at"  class="pb-8 pr-6 w-full lg:w-1/2" label="scheduled at"/>
      </label><!-- <datetime type='atetime-local' v-model="form.scheduled_at" :error="form.errors.scheduled_at" class="pb-8 pr-6 w-full lg:w-1/2" label="scheduled at"  >scheduled at</datetime> -->
      <select-input v-model="form.duration" :error="form.errors.duration" class="pb-8 pr-6 w-full lg:w-1/2" label="duration">
            <option :value="null" />
            <option > 15 minutes</option>
            <option > 30 minutes</option>
            <option > 45 minutes</option>
            <option > 1 hour</option>
            <option > 1 hour 30 minutes</option>
            <option > 2 hours</option>
            <option > 3 hours</option>

          </select-input>
          <text-input v-model="form.photo_path" :error="form.errors.photo_path" class="pb-8 pr-6 w-full lg:w-1/2" label="Photo" />
          <text-input v-model="form.doctor_id" :error="form.errors.doctor_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Doctor" />
          <select-input v-model="form.contact_id" :error="form.errors.contact_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Patient Name">
            <option :value="null" />
            <option v-for="contact in contacts" :key="contact.id" :value="contact.id">{{ contact.name }}</option>
          </select-input>
       

        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Book Appointment</loading-button>
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

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  props: {
    contacts: Array,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        title: '',    
        description: '',      
        scheduled_at: '', 
        duration: '', 
        photo_path:'',
        doctor_id:'',
        contact_id: '',
        
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/appointments')
    },
  },
}
</script>
