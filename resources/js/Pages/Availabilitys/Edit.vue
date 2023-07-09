<template>
  <div>

    <Head :title="`${form.first_name} ${form.last_name}`" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/availabilitys">Doctor Schedule</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.first_name }} {{ form.last_name }}
    </h1>
    <trashed-message v-if="availability.deleted_at" class="mb-6" @restore="restore"> This schedule has been deleted.
    </trashed-message>
    <div class="max-w-5xl bg-white rounded-md shadow overflow-hidden" style="padding-top: 33px;">
      <form @submit.prevent="update">
        <div class="max-w-5xl bg-white rounded-md shadow overflow-hidden">
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
                  <select-input v-model="form.ConsultaionTime" :error="form.errors.ConsultaionTime" class="w-full">
                    <option value="15:00">15:00 Min</option>
                    <option value="30:00">30:00 Min</option>
                  </select-input>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="px-8 py-4 bg-gray-50 border-t border-gray-100">
            <button v-if="!availability.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button"
              @click="destroy">Delete Schedule</button>
            <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update
              Schedule</loading-button>
          </div>
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
    availability: Object,
    organizations: Array,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        availabilityDays: this.availability.availabilityDays,
        availabilityFrom: this.availability.availabilityFrom,
        availabilityTo: this.availability.availabilityTo,
        organization_id: this.availability.organization_id,
        emavailabilityToail: this.availability.availabilityTo,
        break_Fromtime: this.availability.break_Fromtime,
        break_Totime: this.availability.break_Totime,
        leave_FromDate: this.availability.leave_FromDate,
        leave_ToDate: this.availability.leave_ToDate,
        ConsultaionTime: this.availability.ConsultaionTime,
        doctor_id: this.availability.doctor_id,
        id: this.availability.id,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(`/availabilitys/${this.availability.id}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this schedule?')) {
        this.$inertia.delete(`/availabilitys/${this.availability.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this schedule?')) {
        this.$inertia.put(`/availabilitys/${this.availability.id}/restore`)
      }
    },
  },
}
</script>
