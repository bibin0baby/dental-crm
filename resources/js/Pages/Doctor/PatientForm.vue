<template>
  <div>
    <Head title="Schedule Management" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/doctor">Doctor</Link>
      <span class="text-indigo-400 font-medium">/</span> Schedule Management
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <label  class="pb-8 pr-6 w-full lg:w-1/02"  >Availability</label>
          <label style="margin-left: 13px;    margin-right: 7px;"  class="pb-8 pr-6 w-full lg:w-1/02" >Days</label>
          <select-input v-model="form.AvailabilityDays" :error="form.errors.AvailabilityDays"   class="pb-8 pr-6 w-full lg:w-1/02" style="margin-left: -58px;width: 219%;"  >
            
            <option value="Sunday">Sunday</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
          </select-input>
          <label style="margin-left: 13px;    margin-right: 7px;"  class="pb-8 pr-6 w-full lg:w-1/02" >From</label>
          <select-input v-model="form.AvailabilityFrom" :error="form.errors.AvailabilityFrom"  class="pb-8 pr-6 w-full lg:w-1/02" style="margin-left: -58px;width: 219%;"  >
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
          </select-input>
          <label style="margin-left: 13px;    margin-right: 7px;"  class="pb-8 pr-6 w-full lg:w-1/02" >To</label>
          <select-input v-model="form.AvailabilityTo" :error="form.errors.AvailabilityTo" style="margin-left: -58px;width: 219%;"  class="pb-8 pr-6 w-full lg:w-1/02"  >
           
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
          </select-input>
          <label  class="pb-8 pr-6 w-full lg:w-1/02" style="    width: 15%;" > Break Time</label>
          <label  class="pb-8 pr-6 w-full lg:w-1/02" > From</label>
          <select-input v-model="form.BreakFrom" :error="form.errors.BreakFrom" style="margin-left: -54px;width: 219%;"   class="pb-8 pr-6 w-full lg:w-1/02"  >
           
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
          </select-input>
          <label  class="pb-8 pr-6 w-full lg:w-1/02" style="margin-left: 20px;" > To</label>
          <select-input v-model="form.BreakTo" :error="form.errors.BreakFrom"  class="pb-8 pr-6 w-full lg:w-1/02" style="margin-left: -53px;width: 219%;" >
            
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
          </select-input>
          
          <label  class="pb-8 pr-6 w-full lg:w-1/02" style="width: 31%;" > Leave</label>
          <label  class="pb-8 pr-6 w-full lg:w-1/02" style="margin-left: -117px;"> From</label>
          <select-input v-model="form.Leave" :error="form.errors.Leave" style="margin-left: -54px;width: 219%;"   class="pb-8 pr-6 w-full lg:w-1/02"  >
            
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
          </select-input>
          <label  class="pb-8 pr-6 w-full lg:w-1/02" style="margin-left: 20px;" > To</label>
          <select-input v-model="form.Leave" :error="form.errors.Leave"  class="pb-8 pr-6 w-full lg:w-1/02" style="margin-left: -53px;width: 219%;" >
            
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
          </select-input>
          <label  class="pb-8 pr-6 w-full lg:w-1/02" style=" width: 31%;" >Consultaion Time</label>
          <select-input v-model="form.Leave" :error="form.errors.Leave"  class="pb-8 pr-6 w-full lg:w-1/02" style="    margin-left: -76px;width: 219%;" >
            
            <option value="10:00 Min">10:00 Min</option>
            <option value="15:00 Min">15:00 Min</option>
            <option value="30:00 Min">30:00 Min</option>
            <option value="45:00 Min">30:00 Min</option>
          </select-input>
          <datetime format="MM/DD/YYYY" width="300px" v-model="val"></datetime>
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
import datetime from 'vuejs-datetimepicker';

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    datetime 
  },
  layout: Layout,
  props: {
    organizations: Array,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        BreakFrom: '',
        BreakTo: '',
        last_name: '',
        organization_id: null,
        email: '',
        phone: '',
        address: '',
        city: '',
        region: '',
        country: '',
        postal_code: '',
        times: ['9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM'],
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/doctor')
    },
  },
}


</script>
