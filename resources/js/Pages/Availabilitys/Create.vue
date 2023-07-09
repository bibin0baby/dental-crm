<template>
  <div>

    <Head title="Create Schedule" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/availabilitys">Availability</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-5xl bg-white rounded-md shadow overflow-hidden" style="padding-top: 33px;">
      <form @submit.prevent="store">
  <table class="w-full">
    <tbody>
      <tr >
        <td class="pb-8 pr-6 w-1/4">
          <label class="font-bold" style="padding-left: 20px;">Availability Days</label>
          </td>
          <td class="pb-8 pr-6 w-1/4">
          <select-input v-model="form.availabilityDays">
            <option :value="null" />
            <option value="Sunday">Sunday</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
          </select-input>
          <p v-if="form.errors.availabilityDays" class="text-red-500">{{ form.errors.availabilityDays }}</p>
        </td>
        <td class="pb-8 pr-6 w-1/4">
          <label class="font-bold">From      </label>
          <input type="time" v-model="form.availabilityFrom">
          <p v-if="form.errors.availabilityFrom" class="text-red-500">{{ form.errors.availabilityFrom }}</p>
        </td>
        <td class="pb-8 pr-6 w-1/4">
          <label class="font-bold">To      </label>
          <input type="time" v-model="form.availabilityTo">
          <p v-if="form.errors.availabilityTo" class="text-red-500">{{ form.errors.availabilityTo }}</p>
        </td>
        </tr>
        <tr>
        <td class="pb-8 pr-6 w-1/4">
          <label class="font-bold" style="padding-left: 20px;">Break Time </label>
          </td>
        <td class="pb-8 pr-6 w-1/4">
          <label class="font-bold">From      </label>
          <input type="time" v-model="form.break_Fromtime">
          <p v-if="form.errors.break_Fromtime" class="text-red-500">{{ form.errors.break_Fromtime }}</p>
        </td>

        <td class="pb-8 pr-6 w-1/4">
          <label class="font-bold">To      </label>
          <input type="time" v-model="form.break_Totime">
          <p v-if="form.errors.break_Totime" class="text-red-500">{{ form.errors.break_Totime }}</p>
        </td>
        
        </tr>
        <tr>
        <td class="pb-8 pr-6 w-1/4">
          <label class="font-bold" style="padding-left: 20px;">Leave </label>
         </td>

         <td class="pb-8 pr-6 w-1/4">
          <label class="font-bold">From      </label>
          <input type="date" v-model="form.leave_FromDate">
          <p v-if="form.errors.leave_FromDate" class="text-red-500">{{ form.errors.leave_FromDate }}</p>
        </td>


        <td class="pb-8 pr-6 w-1/4">
          <label class="font-bold">To      </label>
          <input type="date" v-model="form.leave_ToDate">
          <p v-if="form.errors.leave_ToDate" class="text-red-500">{{ form.errors.leave_ToDate }}</p>
        </td>

        
        <td>

        </td>
      </tr>
      <tr>
        <td class="pb-8 pr-6 w-1/4">
          <label class="font-bold" style="padding-left: 20px;">Consultaion Time</label>
        </td>
        <td class="pb-8 pr-6 w-1/4">
          <select-input v-model="form.ConsultaionTime">
            <option :value="null" />
            <option value="15:00">15:00 Min</option>
            <option value="30:00">30:00 Min</option>
          </select-input>
          </td>
          <td class="pb-8 pr-6 w-1/4">
          <p v-if="form.errors.ConsultaionTime" class="text-red-500">{{ form.errors.ConsultaionTime }}</p>
          <input type="hidden" v-model="form.doctor_id">
        </td>
      </tr>
    </tbody>
  </table>

  <app-layout>
    <template #header>
      <h1>Calendar</h1>
    </template>
    <calendar></calendar>
  </app-layout>

  <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
    <loading-button :loading="form.processing" class="btn-indigo" type="submit">Save</loading-button>
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
    //availabilitys: Array,
    availabilitys: Object,
    doctor_id: Number,
    organization_id: String,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        availabilityDays: null,
        availabilityFrom: null,
        availabilityTo: null,
        break_Fromtime: null,
        break_Totime: null,
        leave_FromDate: null,
        leave_ToDate: null,
        ConsultaionTime: null,
        organization_id: null,
        doctor_id: this.doctor_id,
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/availabilitys').then(() => {
        // Handle success or redirect
      }).catch(() => {
        // Handle error or display error message
      });

      // this.form.post('/availabilitys')
    },
  },
}
</script>
