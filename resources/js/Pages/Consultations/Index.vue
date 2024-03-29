<template>
  <div>
    <Head title="Appointment List" />
    <h1 class="mb-8 text-3xl font-bold">Appointments List</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>
     
    </div>
   
    <div class="bg-white rounded-md shadow overflow-x-auto">
    

      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Patient Name</th>
          <th class="pb-4 pt-6 px-6">Treatment Type</th>
          <th class="pb-4 pt-6 px-6">Scheduled</th>      
       </tr>
        
        <tr v-for="appointment in appointments.data" :key="appointment.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/consultations/${appointment.id}/edit`" tabindex="-1">
              <div v-if="appointment.contact">
                {{ appointment.contact.name }}
              </div>
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/consultations/${appointment.id}/edit`">
              {{ appointment.title }}
              <icon v-if="appointment.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
            </Link>
          </td> 
         
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/consultations/${appointment.id}/edit`">
              {{ appointment.scheduled_at }}
              <icon v-if="appointment.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
            </Link>
          </td>         
          
           <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/consultations/${appointment.id}/edit`" tabindex="-1">
              <div v-if="appointment.organization">
                {{ appointment.organization.name }}
              </div>
            </Link>
          </td>
          
           <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/consultations/${appointment.id}/edit`" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
          </td>
        </tr>
        <tr v-if="appointments.data.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No Appointments found.</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-6" :links="appointments.links" />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {
  components: {
    Head,
    Icon,
    Link,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    filters: Object,
    appointments: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/consultations', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>
