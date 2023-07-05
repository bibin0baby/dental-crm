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
        <select-input v-model="form.availabilityDays" :error="form.errors.availabilityDays" class="pb-14 pr-14  lg:w-1/05">

          <option value="Sunday">Sunday</option>
          <option value="Monday">Monday</option>
          <option value="Tuesday">Tuesday</option>
          <option value="Wednesday">Wednesday</option>
          <option value="Thursday">Thursday</option>
          <option value="Friday">Friday</option>
          <option value="Saturday">Saturday</option>
        </select-input>
        <label class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;">From :</label>
        <input type="time" v-model="form.availabilityFrom" :error="form.errors.availabilityFrom"
          class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;">

        <label class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;">To :</label>
        <input type="time" v-model="form.availabilityTo" :error="form.errors.availabilityTo"
          class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;">

        <label class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;"> Break Time</label>
        <label class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;    margin-left: -39px;"> From :</label>
        <input type="time" v-model="form.break_Fromtime" :error="form.errors.break_Fromtime"
          style="    margin-right: 22px; margin-left: -6px;" class="pb-14 pr-14  lg:w-1/05">

        <label class="pb-14 pr-14  lg:w-1/05" style="font-weight: 500;"> To :</label>
        <input type="time" v-model="form.break_Totime" :error="form.errors.break_Totime"
          style="   margin-left: 13px; margin-right: 20px;" class="pb-14 pr-14  lg:w-1/05">

        <label class="pb-14 pr-14  lg:w-1/05" style="width: 36%; font-weight: 500;"> Leave</label>
        <label class="pb-14 pr-14  lg:w-1/05" style="margin-left: -256px;margin-right: 0px; font-weight: 500;"> From
          :</label>
        <input type="date" v-model="form.leave_FromDate" :error="form.errors.leave_FromDate"
          class="pb-14 pr-14  lg:w-1/05" style=" margin-right: 18px; margin-left: -11px;">

        <label class="pb-14 pr-14  lg:w-1/05" style=" margin-left: -23px;margin-right: 0px; font-weight: 500;"> To
          :</label>
        <input type="date" v-model="form.leave_ToDate" :error="form.errors.leave_ToDate" class="pb-14 pr-14  lg:w-1/05"
          style="">

        <label class="pb-14 pr-14  lg:w-1/05" style="width: 36%; font-weight: 500;">Consultaion Time :</label>
        <select-input v-model="form.ConsultaionTime" :error="form.errors.ConsultaionTime"
          class="pb-14 pr-14  lg:w-1/05">

          <option value="05:00">05:00 Min</option>
          <option value="10:00">10:00 Min</option>
          <option value="15:00">15:00 Min</option>
        </select-input>
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
    organizations: Array,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        doctor_id: null,
        availabilityDays: '',
        AvailabilityFrom: '',
        AvailabilityTo: '',
        break_Fromtime: '',
        break_Totime: '',
        leave_FromDate: '',
        leave_ToDate: '',
        ConsultaionTime: '',
        organization_id: null,
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
