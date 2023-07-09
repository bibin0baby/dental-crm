<template>
  <div>

    <Head :title="`${form.title} `" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/consultations">Consultation</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.title }}
    </h1>
    <!-- <trashed-message v-if="appointment.deleted_at" class="mb-6" @restore="restore"> This appointment has been deleted.
    </trashed-message> -->
    <div class="max-w-5xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <input type="hidden" v-model="form.contact_id">
          <input type="hidden" v-model="form.doctor_id">
          <input type="hidden" v-model="form.account_id">
          
          <text-input v-model="form.patientname" :error="form.errors.patientname" class="pb-8 pr-6 w-full lg:w-1/2" label="Patient Name" />
          <label class="pb-8 pr-6 w-full lg:w-1/2">Scheduled at: <br><br>
            <input type="datetime-local" v-model="form.scheduled_at" :error="form.errors.scheduled_at"
              class="pb-8 pr-6 w-full lg:w-1/2">
          </label>
          <text-input v-model="form.title" :error="form.errors.title" class="pb-8 pr-6 w-full lg:w-1/2"
            label="Treatment Type" />
          <text-input v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full lg:w-1/2"
            label="Description" />

            <text-input v-model="form.chiefcomplaint" :error="form.errors.chiefcomplaint" class="pb-8 pr-6 w-full lg:w-1/2"
            label="Chief Complaint"  style="height: 110px;"/>

            <text-input v-model="form.medicalhistory" :error="form.errors.medicalhistory" class="pb-8 pr-6 w-full lg:w-1/2"
            label="Medical History" style="height: 110px;"/>

            <text-input v-model="form.diagnosis" :error="form.errors.diagnosis" class="pb-8 pr-6 w-full lg:w-1/2"
            label="Diagnosis" style="height: 110px;"/>

            <text-input v-model="form.prescription" :error="form.errors.prescription" class="pb-8 pr-6 w-full lg:w-1/2"
            label="Prescription" style="height: 110px;"/>
           
            <text-input v-model="form.otherdetails" :error="form.errors.otherdetails" class="pb-8 pr-6 w-full lg:w-1/2"
            label="Other Details" style="height: 50px;"/>

        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <!-- <button v-if="!appointment.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button"
            @click="destroy">Delete Appointment</button> -->
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Save Consultation</loading-button>
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
    consultation: Object,
    doctor_name : String,
    patientname: String,
    appointment_id: Number,
    doctor_id: Number,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        title: this.appointment.title,
        description: this.appointment.description,
        contact_id: this.appointment.contact_id,
        duration: this.appointment.duration,
        photo_path: this.appointment.photo_path,
        scheduled_at: this.appointment.scheduled_at,
        doctor_id: this.appointment.doctor_id,
        chiefcomplaint : this.appointment.chiefcomplaint,
        medicalhistory: this.appointment.medicalhistory,
        diagnosis: this.appointment.diagnosis,
        prescription: this.appointment.prescription,
        otherdetails: this.appointment.otherdetails,
        appointment_id: this.appointment.id,
        doctor_name : this.doctor_name,
        patientname : this.appointment.contact.name,
        account_id: this.appointment.account_id,

        // doctor_id: this.doctor_id,
        // contact_id: this.contact_id,
        // account_id: this.account_id,
        // chiefcomplaint : this.chiefcomplaint,
        // medicalhistory: this.medicalhistory,
        // diagnosis: this.diagnosis,
        // prescription: this.prescription,
        // otherdetails: this.otherdetails,
        // appointment_id: this.form.id,
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/consultations').then(() => {
        // Handle success or redirect
      }).catch(() => {
        // Handle error or display error message
      });

      // this.form.post('/availabilitys')
    },
    update() {
      this.form.put(`/consultations/${this.doctor_id}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this appointment?')) {
        this.$inertia.delete(`/consultations/${this.appointment.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this appointment?')) {
        this.$inertia.put(`/consultations/${this.appointment.id}/restore`)
      }
    },
  },
}
</script>
