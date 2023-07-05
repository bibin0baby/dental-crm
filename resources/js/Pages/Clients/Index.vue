<template>
  <div>
    <Head title="Appointments" />
    <h1 class="mb-8 text-3xl font-bold">Client scheduler</h1>
    <FullCalendar :options="calendarOptions" />
    <Teleport to="body">
      <!-- use the modal component, pass in the prop -->
      <modal :show="showModal" @close="showModal = false">
        <template #header>
          <h3>Let us know more about you...</h3>
          <h3>Appointment Date Time is: {{ appointments_dt_start.dateStr }}</h3>
        </template>
        <template #body>
          <form @submit.prevent="store">
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
              <input type="hidden" v-model="form.userId">
              <text-input v-model="form.first_name" :error="form.errors.first_name" class="pb-8 pr-6 w-full lg:w-1/2" label="First name" />
              <text-input v-model="form.last_name" :error="form.errors.last_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Last name" />
              <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
              <text-input v-model="form.phone" :error="form.errors.phone" class="pb-8 pr-6 w-full lg:w-1/2" label="Phone" />
              <text-input v-model="form.address" :error="form.errors.address" class="pb-8 pr-6 w-full lg:w-1/2" label="Address" />
              <text-input v-model="form.city" :error="form.errors.city" class="pb-8 pr-6 w-full lg:w-1/2" label="City" />
              <text-input v-model="form.region" :error="form.errors.region" class="pb-8 pr-6 w-full lg:w-1/2" label="Province/State" />
              <select-input v-model="form.country" :error="form.errors.country" class="pb-8 pr-6 w-full lg:w-1/2" label="Country">
                <option :value="null" />
                <option value="UK">UK</option>
                <option value="US">United States</option>
              </select-input>
              <text-input v-model="form.postal_code" :error="form.errors.postal_code" class="pb-8 pr-6 w-full lg:w-1/2" label="Postal code" />
              <text-input v-model="form.title" :error="form.errors.title" class="pb-8 pr-6 w-full lg:w-1/2" label="Title" />
              <textarea-input v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full lg:w-1/2" label="Description" />
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
              <loading-button :loading="form.processing" class="btn-indigo" type="submit">Schedule My appointment</loading-button>
            </div>
          </form>
        </template>
      </modal>
    </Teleport>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import TextInput from '@/Shared/TextInput'
import TextareaInput from '@/Shared/TextareaInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import ClientLayout from '@/Shared/ClientLayout'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import Modal from '@/Shared/Modal.vue'
import { ref } from 'vue'
import Datetime from 'vuejs-datetimepicker'
import { router } from '@inertiajs/vue3'

const showModal = ref(false)

export default {
  components: {
    Head,
    Icon,
    Link,
    FullCalendar,
    Modal,
    Datetime,
    LoadingButton,
    SelectInput,
    TextInput,
    TextareaInput
  },
  layout: ClientLayout,
  props: {
    //showModal : false
    //filters: Object,
    appointments: Object,
    doctor_id: String,
  },
  remember: 'form',
  data() {
    return {
      showModal : false,
      appointments_dt_start: '',
      appointments_dt_end: '',
      calendarOptions: {
        plugins: [ dayGridPlugin, interactionPlugin, timeGridPlugin ],
        initialView: 'timeGridWeek',
        headerToolbar: {
          left: 'prev,next',
          center: 'title',
          right: 'timeGridWeek,timeGridDay' // user can switch between the two
        },
        slotEventOverlap: false,
        selectable: true,
        select: this.handleDrop,
        selectOverlap: false,
        selectMinDistance: 1,
        dateClick: this.handleDateClick,
        slotDuration: '00:15:00',
        events: this.appointments
      },
      form: this.$inertia.form({
        first_name: '',
        last_name: '',
        organization_id: null,
        email: '',
        phone: '',
        address: '',
        city: '',
        region: '',
        country: '',
        postal_code: '',
        title: '',
        description: '',
      }),
    }
  },
  watch: {
    // form: {
    //   deep: true,
    //   handler: throttle(function () {
    //     this.$inertia.get('/appointments', pickBy(this.form), { preserveState: true })
    //   }, 150),
    // },
  },
  methods: {
    handleDateClick: function(arg) {
      //alert('date click! ' + arg.dateStr);
      console.log(arg);
      this.appointments_dt_start = arg.dateStr
      this.showModal = true;
    },
    handleDrop: function(arg) {
      //alert('date click! ' + arg.dateStr);
      console.log(arg);
      this.appointments_dt_start = arg.startStr
      this.appointments_dt_end = arg.endStr
      this.showModal = true;
    },
    store() {
      var frm = this.form;
      frm.appointments_dt_start = this.appointments_dt_start;
      frm.appointments_dt_end = this.appointments_dt_end;
      frm.duration = this.calendarOptions.slotDuration;
      frm.doctor_id = this.doctor_id;
      router.post('/client', frm);
      //this.form.post('/client', ['data'])
    },
  },
}
</script>
