<template>
  <div
    class="tab-pane"
    :class="{ active: active }"
    id="broadcasts"
    role="tabpanel"
    aria-labelledby="broadcasts-tab"
    tabindex="0"
  >
    <Table v-if="!this.fetching">
      <template #TableHeaderTitle>{{__('all')}} {{ __n('broadcast') }}</template>
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
        <button type="button" id="addEditBroadcastModalButton"    class="btn  btn-primary" data-bs-toggle="modal" @click="modal_broadcast = null" data-bs-target="#addEditBroadcastModal">
            {{__('add')}}
        </button>
        <add-edit-broadcast-modal :key="key" @refreshData="refreshData()" @clearModalData="clearModalData()" :modalData="modal_broadcast" id="addEditBroadcastModal"></add-edit-broadcast-modal>
      </div>
      </template>
      <template #TableTheadRow>
        <tr>
          <TableTHead v-for="col in this.columns" :key="col.id" :sortable="col.sortable" @onSortChange="onSortChange" :sort="filter.sort" :name="col.value">{{ col.name }} </TableTHead>
        </tr>
      </template>
      <template #TableBody>
        <tr v-if="law_firm_broadcasts.data.length == 0">
            <td class="align-middle" :colspan="columns.length">
                {{ __('no record found') }}
            </td>
        </tr>
        <tr v-for="broadcast in law_firm_broadcasts.data" :key="broadcast.id">
          <td class="align-middle">{{ broadcast.name }}</td>
          <!-- <td class="align-middle">{{ broadcast.description }}</td> -->
          <td class="align-middle">
            <img v-if="broadcast.image" :src="broadcast.image" width="75" height="75" :alt="broadcast.image" />
            <span v-else>-</span>
          </td>
          <td class="align-middle">{{ broadcast.created_at }}</td>

          <td class="align-middle"><span v-if="broadcast.is_active" class="badge bg-success">{{ __('active') }}</span> <span class="badge bg-danger" v-else> {{ __('inactive') }} </span></td>
          <td class="align-middle">
            <div class="d-flex">
            <button type="button" class="btn btn-link px-1 lh-1 py-1 me-2" data-bs-toggle="modal" @click="modal_broadcast = broadcast" data-bs-target="#viewBroadcastModal">
              <i class="bi bi-eye-fill"></i>
            </button>
            <button type="button" class="btn btn-link px-1 lh-1 py-1 me-2" data-bs-toggle="modal" @click="modal_broadcast = broadcast;" data-bs-target="#addEditBroadcastModal">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button type="button" class="btn btn-link text-danger px-1 lh-1 py-1 " data-bs-toggle="modal" @click="modal_broadcast = broadcast" data-bs-target="#deleteBroadcastModal">
              <i class="bi bi-trash3-fill"></i>
            </button>
            </div>
            <view-broadcast-modal @clearModalData="clearModalData()" :modalData="modal_broadcast" id="viewBroadcastModal"></view-broadcast-modal>
            <delete-broadcast-modal @refreshData="refreshData()" :modalData="modal_broadcast" id="deleteBroadcastModal"></delete-broadcast-modal>

         </td>
          <!-- Button trigger modal -->
        </tr>
      </template>
      <template #Pagination>
        <TablePagination @onPageChange="onPageChange" :meta="law_firm_broadcasts.meta"></TablePagination>
      </template>
    </Table>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import AddEditBroadcastModal from "@/Components/LawFirms/Broadcasts/AddEditBroadcastModal.vue";
import ViewBroadcastModal from "@/Components/LawFirms/Broadcasts/ViewBroadcastModal.vue";
import DeleteBroadcastModal from "@/Components/LawFirms/Broadcasts/DeleteBroadcastModal.vue";
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
    AddEditBroadcastModal,
    Table,
    TableTHead,
    TablePagination,
    ViewBroadcastModal,
    DeleteBroadcastModal
  },
  props: ["active"],
  mixins: [PaginationMixin],
  data() {
    return {
        law_firm_broadcasts:{},
        modal_broadcast:null,
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
        await this.getLawFirmBroadcasts(loading_more)
     },
     clearModalData(){
        this.modal_broadcast = null
        this.key++
     },
    getLawFirmBroadcasts(loading_more){
    axios.post(this.route('law_firms.law_firm_broadcasts.filter'),this.filter).then(res => {
        const data = res.data.data
        if(loading_more){
            this.law_firm_broadcasts.data = this.law_firm_broadcasts.data.concat(data.data);
        }else{
            this.law_firm_broadcasts.data = data.data;
        }
        this.law_firm_broadcasts.links = data.links
        this.law_firm_broadcasts.meta = data.meta
        this.fetching = false
    });
    },
  }
});
</script>
