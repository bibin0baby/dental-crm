<template>
  <div>

    <Head title="Create Schedule" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/availabilitys">Avilability</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-5xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">

        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <label class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;">Availability</label>
          <label class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;    margin-left: -37px;">Days</label>
          <select-input v-model="form.availabilityDays" class="pb-14 pr-14  lg:w-1/05">
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

          <label class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;">From :</label>
          <input type="time" v-model="form.availabilityFrom" :error="form.errors.availabilityFrom" class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;">
          <p v-if="form.errors.availabilityFrom" class="text-red-500">{{ form.errors.availabilityFrom }}</p>
          <!-- <select-input v-model="form.AvailabilityFrom" :error="form.errors.AvailabilityFrom"  class="pb-8 pr-6  lg:w-1/05"   >
            <option value="09:00 AM">09:00 AM</option>
            <option value="09:30 AM">09:30 AM</option>
            <option value="10:00 AM">10:00 AM</option>
            <option value="10:30 AM">10:30 AM</option>
            <option value="11:00 AM">11:00 AM</option>
            <option value="11:30 AM">11:30 AM</option>
            <option value="12:00 AM">12:00 AM</option>
            <option value="12:30 AM">12:30 AM</option>
            <option value="01:00 PM">01:00 PM</option>
            <option value="01:30 PM">01:30 PM</option>
            <option value="02:00 AM">02:00 PM</option> 
            <option value="02:30 AM">02:30 PM</option>
            <option value="03:00 AM">03:00 PM</option>
            <option value="03:30 AM">03:30 PM</option>
            <option value="04:00 AM">04:00 PM</option>
            <option value="04:30 AM">04:00 PM</option>
            <option value="05:00 AM">05:00 PM</option>
            <option value="05:30 AM">05:30 PM</option>
            <option value="06:00 AM">06:00 PM</option>
            <option value="06:30 AM">06:30 PM</option>
            <option value="07:00 AM">07:00 PM</option> 
            <option value="07:30 AM">07:30 PM</option> 
            <option value="08:00 AM">08:00 PM</option>
            <option value="08:30 AM">08:30 PM</option>
            <option value="09:00 AM">09:00 PM</option>
          </select-input> -->
		  
          <label class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;">To :</label>
          <input type="time" v-model="form.availabilityTo" class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;">
          <p v-if="form.errors.availabilityTo" class="text-red-500">{{ form.errors.availabilityTo }}</p>

          <label class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;"> Break Time</label>
          <label class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;    margin-left: -39px;"> From :</label>
          <input type="time" v-model="form.break_Fromtime" style=" margin-right: 22px; margin-left: -6px;" class="pb-14 pr-14  lg:w-1/05">
            <p v-if="form.errors.break_Fromtime" class="text-red-500">{{ form.errors.break_Fromtime }}</p>

          <label class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;"> To :</label>
          <input type="time" v-model="form.break_Totime" style="   margin-left: 13px; margin-right: 20px;"
            class="pb-14 pr-14  lg:w-1/05">
            <p v-if="form.errors.break_Totime" class="text-red-500">{{ form.errors.break_Totime }}</p>

          <label class="pb-14 pr-14  lg:w-1/05" style="width: 36%; font-weight: 500;"> Leave</label>
          <label class="pb-14 pr-14  lg:w-1/05" style="margin-left: -256px;margin-right: 0px; font-weight: 500;"> From
            :</label>
          <input type="date" v-model="form.leave_FromDate" class="pb-14 pr-14  lg:w-1/05"
            style=" margin-right: 18px; margin-left: -11px;">
            <p v-if="form.errors.leave_FromDate" class="text-red-500">{{ form.errors.leave_FromDate }}</p>

          <label class="pb-14 pr-14  lg:w-1/05" style=" margin-left: -23px;margin-right: 0px; font-weight: 500;"> To
            :</label>
          <input type="date" v-model="form.leave_ToDate" class="pb-14 pr-14  lg:w-1/05">
          <p v-if="form.errors.leave_ToDate" class="text-red-500">{{ form.errors.leave_ToDate }}</p>

          <label class="pb-14 pr-14  lg:w-1/05" style="width: 36%; font-weight: 500;">Consultaion </label>
          <label class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;    margin-left: -255px;"> Time :</label>
          <select-input v-model="form.ConsultaionTime" class="pb-14 pr-14  lg:w-1/05" style="    margin-left: -12px; width: 130%;">
            <option :value="null" />
            <option value="05:00">05:00 Min</option>
            <option value="10:00">10:00 Min</option>
            <option value="15:00">15:00 Min</option>
          </select-input>
          <p v-if="form.errors.ConsultaionTime" class="text-red-500">{{ form.errors.ConsultaionTime }}</p>

          <!-- <input type="time" min="0" max="59" step="1" v-model="minutes"> -->
          <!-- <input type="number" v-model="form.ConsultaionTime" :error="form.errors.ConsultaionTime"
          class="pb-14 pr-14  lg:w-1/05" style="margin-left: -157px;margin-right: 100px;"> -->
          <input type="hidden" v-model="form.doctor_id">
          <app-layout>
            <template #header>
              <h1>Calendar</h1>
            </template>

            <calendar></calendar>
          </app-layout>
        </div>
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
    doctor_id: String,
    organization_id: String,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        availabilityDays: null,
        AvailabilityFrom: null,
        AvailabilityTo: null,
        break_Fromtime: null,
        break_Totime: null,
        leave_FromDate: null,
        leave_ToDate: null,
        ConsultaionTime: null,
        organization_id: null,
        doctor_id: '1',
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/availabilitys')
    },
  },
}
</script>
