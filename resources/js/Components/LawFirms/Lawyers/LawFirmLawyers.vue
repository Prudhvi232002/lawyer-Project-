<template>
  <div
    class="tab-pane"
    :class="{ active: active }"
    id="lawyers"
    role="tabpanel"
    aria-labelledby="lawyers-tab"
    tabindex="0"
  >
    <Table v-if="!this.fetching">
      <template #TableHeaderTitle>{{__('all')}} {{ __n('lawyer') }}</template>
      <template #TableHeaderButtons>
        <div class="d-flex align-items-center">

        <div class="form-group me-2">
            <select v-model="filter.column" class="form-select h-auto"
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
        <button type="button" id="addEditLawyerModalButton"   class="btn btn-primary" data-bs-toggle="modal" @click="modal_lawyer = null" data-bs-target="#addEditLawyerModal">
            {{__('add')}}
        </button>
        <add-edit-lawyer-modal :key="key" @refreshData="refreshData()" @clearModalData="clearModalData()" :modalData="modal_lawyer" id="addEditLawyerModal"></add-edit-lawyer-modal>
      </div>
      </template>
      <template #TableTheadRow>
        <tr>
          <TableTHead v-for="col in this.columns" :key="col.id" :sortable="col.sortable" @onSortChange="onSortChange" :sort="filter.sort" :name="col.value">{{ col.name }} </TableTHead>
        </tr>
      </template>
      <template #TableBody>
        <tr v-if="law_firm_lawyers.data.length == 0">
            <td class="align-middle" :colspan="columns.length">
                {{ __('no record found') }}
            </td>
        </tr>
        <tr v-for="lawyer in law_firm_lawyers.data" :key="lawyer.id">
          <td class="align-middle">{{ lawyer.first_name }}</td>
          <td class="align-middle">{{ lawyer.last_name }}</td>
          <td class="align-middle" v-html="lawyer.user.email"></td>
          <td class="align-middle" v-html="lawyer.speciality"></td>
          <td class="align-middle"><span v-if="lawyer.is_active" class="badge bg-success">{{ __('active') }}</span> <span class="badge bg-danger" v-else> {{ __('inactive') }} </span></td>
          <td class="align-middle">
            <div class="d-flex">
            <button type="button" class="btn btn-link px-1 lh-1 py-1 me-2" data-bs-toggle="modal" @click="modal_lawyer = lawyer" data-bs-target="#viewLawyerModal">
              <i class="bi bi-eye-fill"></i>
            </button>
            <button type="button" class="btn btn-link px-1 lh-1 py-1 me-2" data-bs-toggle="modal" @click="modal_lawyer = lawyer;" data-bs-target="#addEditLawyerModal">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button type="button" class="btn btn-link text-danger px-1 lh-1 py-1 " data-bs-toggle="modal" @click="modal_lawyer = lawyer" data-bs-target="#deleteLawyerModal">
              <i class="bi bi-trash3-fill"></i>
            </button>
            </div>
            <view-lawyer-modal :modalData="modal_lawyer" id="viewLawyerModal"></view-lawyer-modal>
            <delete-lawyer-modal @refreshData="refreshData()" :modalData="modal_lawyer" id="deleteLawyerModal"></delete-lawyer-modal>

         </td>
          <!-- Button trigger modal -->
        </tr>
      </template>
      <template #Pagination>
        <TablePagination @onPageChange="onPageChange" :meta="law_firm_lawyers.meta"></TablePagination>
      </template>
    </Table>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import AddEditLawyerModal from "@/Components/LawFirms/Lawyers/AddEditLawyerModal.vue";
import ViewLawyerModal from "@/Components/LawFirms/Lawyers/ViewLawyerModal.vue";
import DeleteLawyerModal from "@/Components/LawFirms/Lawyers/DeleteLawyerModal.vue";
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
    AddEditLawyerModal,
    Table,
    TableTHead,
    TablePagination,
    ViewLawyerModal,
    DeleteLawyerModal
  },
  props: ["active"],
  mixins: [PaginationMixin],
  data() {
    return {
        law_firm_lawyers:{},
        modal_lawyer:null,
        key:1,
        columns:[
            {
                "id":1,
                'name': this.__('first name') ,
                'value':"first_name",
                'searchable':true,
                'sortable':true
            },
            {
                "id":2,
                'name':this.__('last name'),
                'value':"last_name",
                'searchable':true,
                'sortable':true
            },
            {
                "id":3,
                'name':this.__('email'),
                'value':"email",
                'searchable':true,
                'sortable':true
            },

            {
                "id":4,
                'name':this.__('experience'),
                'value':"experience",
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
    this.filter.search = ''
    this.getPaginatedData()
  },
  methods: {
    async getPaginatedData(loading_more = false){
        await this.getLawFirmLawyers(loading_more)
     },
     clearModalData(){
        this.filter.search = ''
        this.modal_lawyer = null
        this.key++
     },
    getLawFirmLawyers(loading_more){
    axios.post(this.route('law_firms.law_firm_lawyers.filter'),this.filter).then(res => {
        const data = res.data.data
        if(loading_more){
            this.law_firm_lawyers.data = this.law_firm_lawyers.data.concat(data.data);
        }else{
            this.law_firm_lawyers.data = data.data;
        }
        this.law_firm_lawyers.links = data.links
        this.law_firm_lawyers.meta = data.meta
        this.fetching = false
    });
    },
  }
});
</script>
