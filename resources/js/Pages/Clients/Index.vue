<template>
  <div>
    <Head title="Appointments" />
    <h1 class="mb-8 text-3xl font-bold">Client scheduler</h1>
    <FullCalendar :options="calendarOptions" />
    <Teleport to="body">
      <!-- use the modal component, pass in the prop -->
      <modal :show="showModal" @close="showModal = false">
        <template #header>
          <h3>custom header</h3>
          <form @submit.prevent="store">
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
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
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
              <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Contact</loading-button>
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
  },
  layout: ClientLayout,
  props: {
    //showModal : false
    //filters: Object,
    //appointments: Object,
  },
  remember: 'form',
  data() {
    return {
      showModal : false,
      calendarOptions: {
        plugins: [ dayGridPlugin, interactionPlugin, timeGridPlugin ],
        initialView: 'timeGridWeek',
        headerToolbar: {
          left: 'prev,next',
          center: 'title',
          right: 'timeGridWeek,timeGridDay' // user can switch between the two
        },
        slotEventOverlap: false,
        selectable: false,
        selectOverlap: false,
        selectMinDistance: 1,
        dateClick: this.handleDateClick,
        slotDuration: '00:15:00',
        events: this.$inertia.get('/calendar_appointments')
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
      this.showModal = true;
    },
    handleSlotClick: function(selectionInfo) {
      alert('date click! ' + selectionInfo.dateStr)
    },
    store() {
      this.form.post('/client')
    },
  },
}
</script>
