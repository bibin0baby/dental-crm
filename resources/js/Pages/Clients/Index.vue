<template>
  <div>
    <Head title="Appointments" />
    <h1 class="mb-8 text-3xl font-bold">Client scheduler</h1>
    <button id="show-modal" @click="showModal = true">Show Modal</button>
    <FullCalendar :options="calendarOptions" />
    <Teleport to="body">
      <!-- use the modal component, pass in the prop -->
      <modal :show="showModal" @close="showModal = false">
        <template #header>
          <h3>custom header</h3>
        </template>
      </modal>
    </Teleport>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import ClientLayout from '@/Shared/ClientLayout'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import Modal from '@/Shared/Modal.vue'
import { ref } from 'vue'

const showModal = ref(false)

export default {
  components: {
    Head,
    Icon,
    Link,
    FullCalendar,
    Modal
  },
  layout: ClientLayout,
  props: {
    showModal : false
    //filters: Object,
    //appointments: Object,
  },
  data() {
    return {
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
        events: [
          { title: 'event 1', start: '2023-07-03T10:00:00', end: '2023-07-03T10:15:00', display: 'background'},
          { title: 'event 2', start: '2023-07-04T10:00:00', end: '2023-07-04T10:15:00', display: 'background' }
        ]
      }
      // form: {
      //   search: this.filters.search,
      //   trashed: this.filters.trashed,
      // },
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
      alert('date click! ' + arg.dateStr);
      this.showModal = true;
    },
    handleSlotClick: function(selectionInfo) {
      alert('date click! ' + selectionInfo.dateStr)
    }
  },
}
</script>
