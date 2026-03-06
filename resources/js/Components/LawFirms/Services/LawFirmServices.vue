<template>
  <div
    class="tab-pane"
    :class="{ active: active }"
    id="services"
    role="tabpanel"
    aria-labelledby="services-tab"
    tabindex="0"
  >
    <Table v-if="!this.fetching">
      <template #TableHeaderTitle>{{__('all')}} {{ __n('service') }}</template>
      <template #TableHeaderButtons>
        <div class="d-flex align-items-center">

        <div class="form-group me-2">
            <select v-model="filter.column" class="form-select"
                aria-label="column">
                <option v-for="col in this.columns" :key="col.id" :value="col.value">{{
                    col.name
                }}</option>
            </select>
        </div>
        <div class="from-group me-2 position-relative">
            <input v-model="filter.search"
            class=" form-control  px-3"
            placeholder="Search" type="text" />
           <span class="position-absolute" style="top: 4px;
           right: 0px;"><button type="button" class="btn border-0 me-2" @click="getPaginatedData(false)">
            <i class="bi bi-search"></i>
          </button></span>
          </div>
        <button type="button" id="addEditServiceModalButton"   class="btn btn-primary" data-bs-toggle="modal" @click="modal_service = null" data-bs-target="#addEditServiceModal">
            {{__('add')}}
        </button>
        <add-edit-service-modal :key="key" @refreshData="refreshData()" @clearModalData="clearModalData()" :modalData="modal_service" id="addEditServiceModal"></add-edit-service-modal>
      </div>
      </template>
      <template #TableTheadRow>
        <tr>
          <TableTHead v-for="col in this.columns" :key="col.id" :sortable="col.sortable" @onSortChange="onSortChange" :sort="filter.sort" :name="col.value">{{ col.name }} </TableTHead>
        </tr>
      </template>
      <template #TableBody>
        <tr v-if="law_firm_services.data.length == 0">
            <td class="align-middle" :colspan="columns.length">
                {{ __('no record found') }}
            </td>
        </tr>
        <tr v-for="service in law_firm_services.data" :key="service.id">
          <td class="align-middle">{{ service.name }}</td>
          <!-- <td class="align-middle">{{ service.description }}</td> -->
          <td class="align-middle">
            <img v-if="service.image" :src="service.image" width="75" height="75" :alt="service.image" />
            <span v-else>-</span>
          </td>
          <td class="align-middle">{{ service.created_at }}</td>

          <td class="align-middle"><span v-if="service.is_active" class="badge bg-success">{{ __('active') }}</span> <span class="badge bg-danger" v-else> {{ __('inactive') }} </span></td>
          <td class="align-middle">
            <div class="d-flex">
            <button type="button" class="btn btn-link px-1 lh-1 py-1 me-2" data-bs-toggle="modal" @click="modal_service = service" data-bs-target="#viewServiceModal">
              <i class="bi bi-eye-fill"></i>
            </button>
            <button type="button" class="btn btn-link px-1 lh-1 py-1 me-2" data-bs-toggle="modal" @click="modal_service = service;" data-bs-target="#addEditServiceModal">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button type="button" class="btn btn-link text-danger px-1 lh-1 py-1 " data-bs-toggle="modal" @click="modal_service = service" data-bs-target="#deleteServiceModal">
              <i class="bi bi-trash3-fill"></i>
            </button>
            </div>
            <view-service-modal @clearModalData="clearModalData()" :modalData="modal_service" id="viewServiceModal"></view-service-modal>
            <delete-service-modal @refreshData="refreshData()" :modalData="modal_service" id="deleteServiceModal"></delete-service-modal>

         </td>
          <!-- Button trigger modal -->
        </tr>
      </template>
      <template #Pagination>
        <TablePagination @onPageChange="onPageChange" :meta="law_firm_services.meta"></TablePagination>
      </template>
    </Table>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import AddEditServiceModal from "@/Components/LawFirms/Services/AddEditServiceModal.vue";
import ViewServiceModal from "@/Components/LawFirms/Services/ViewServiceModal.vue";
import DeleteServiceModal from "@/Components/LawFirms/Services/DeleteServiceModal.vue";
import Table from "@/Components/Shared/DataTable/Table.vue";
import TableTHead from "@/Components/Shared/DataTable/TableTHead.vue";
import TablePagination from "@/Components/Shared/DataTable/TablePagination.vue";
import PaginationMixin from "@/Mixins/PaginationMixin.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import axios from "axios";

export default defineComponent({
  components: {
    Head,
    Link,
    AddEditServiceModal,
    Table,
    TableTHead,
    TablePagination,
    ViewServiceModal,
    DeleteServiceModal
  },
  props: ["active"],
  mixins: [PaginationMixin],
  data() {
    return {
        law_firm_services:{},
        modal_service:null,
        key:1,
        columns:[
            {
                "id":1,
                'name': this.__('name') ,
                'value':"name",
                'searchable':true,
                'sortable':true
            },
            {
                "id":3,
                'name':this.__('image'),
                'value':"image",
                'searchable':false,
                'sortable':false
            },
            {
                "id":4,
                'name':this.__('created at'),
                'value':"created_at",
                'searchable':false,
                'sortable':false
            },
            {
                "id":5,
                'name':this.__('status'),
                'value':"status",
                'searchable':false,
                'sortable':false
            },
            {
                "id":6,
                'name':this.__('action'),
                'value':"action",
                'searchable':false,
                'sortable':false
            }
        ],
        editorConfig: {
                    toolbar: {
                        items: [
                            'bold',
                            'italic',
                            'link',
                            'undo',
                            'redo'
                        ]
                    }
                }
    };
  },
  mounted(){
      if(this.filter.column == ''){
          this.filter.column = 'name'
      }
    this.getPaginatedData()
  },
  methods: {
    async getPaginatedData(loading_more = false){
        await this.getLawFirmServices(loading_more)
     },
     clearModalData(){
        this.modal_service = null
        this.key++
     },
    getLawFirmServices(loading_more){
    axios.post(this.route('law_firms.law_firm_services.filter'),this.filter).then(res => {
        const data = res.data.data
        if(loading_more){
            this.law_firm_services.data = this.law_firm_services.data.concat(data.data);
        }else{
            this.law_firm_services.data = data.data;
        }
        this.law_firm_services.links = data.links
        this.law_firm_services.meta = data.meta
        this.fetching = false
    });
    },
  }
});
</script>
