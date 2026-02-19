<template>
  <div
    class="tab-pane"
    :class="{ active: active }"
    id="blogs"
    role="tabpanel"
    aria-labelledby="blogs-tab"
    tabindex="0"
  >
    <Table v-if="!this.fetching">
      <template #TableHeaderTitle>{{__('all')}} {{ __n('post') }}</template>
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
        <button type="button" id="addEditPostModalButton"   class="btn btn-primary" data-bs-toggle="modal" @click="modal_post = null" data-bs-target="#addEditPostModal">
            {{__('add')}}
        </button>
        <add-edit-post-modal :key="key" @refreshData="refreshData()" @clearModalData="clearModalData()" :modalData="modal_post" id="addEditPostModal"></add-edit-post-modal>
      </div>
      </template>
      <template #TableTheadRow>
        <tr>
          <TableTHead v-for="col in this.columns" :key="col.id" :sortable="col.sortable" @onSortChange="onSortChange" :sort="filter.sort" :name="col.value">{{ col.name }} </TableTHead>
        </tr>
      </template>
      <template #TableBody>
        <tr v-if="law_firm_posts.data.length == 0">
            <td class="align-middle" :colspan="columns.length">
                {{ __('no record found') }}
            </td>
        </tr>
        <tr v-for="post in law_firm_posts.data" :key="post.id">
          <td class="align-middle">{{ post.name }}</td>
          <td class="align-middle">
            <img v-if="post.image" :src="post.image" width="75" height="75" :alt="post.image" />
            <span v-else>-</span>
          </td>
          <td class="align-middle">{{ post.created_at }}</td>

          <td class="align-middle"><span v-if="post.is_active" class="badge bg-success">{{ __('active') }}</span> <span class="badge bg-danger" v-else> {{ __('inactive') }} </span></td>
          <td class="align-middle">
             <div class="d-flex">
            <button type="button" class="btn btn-link px-1 lh-1 py-1 me-2" data-bs-toggle="modal" @click="modal_post = post" data-bs-target="#viewPostModal">
              <i class="bi bi-eye-fill"></i>
            </button>
            <button type="button" class="btn btn-link px-1 lh-1 py-1 me-2" data-bs-toggle="modal" @click="modal_post = post;" data-bs-target="#addEditPostModal">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button type="button" class="btn btn-link text-danger px-1 lh-1 py-1 " data-bs-toggle="modal" @click="modal_post = post" data-bs-target="#deletePostModal">
              <i class="bi bi-trash3-fill"></i>
            </button>
        </div>
            <view-post-modal :modalData="modal_post" id="viewPostModal"></view-post-modal>
            <delete-post-modal @refreshData="refreshData()" :modalData="modal_post" id="deletePostModal"></delete-post-modal>

         </td>
          <!-- Button trigger modal -->
        </tr>
      </template>
      <template #Pagination>
        <TablePagination @onPageChange="onPageChange" :meta="law_firm_posts.meta"></TablePagination>
      </template>
    </Table>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import AddEditPostModal from "@/Components/LawFirms/Posts/AddEditPostModal.vue";
import ViewPostModal from "@/Components/LawFirms/Posts/ViewPostModal.vue";
import DeletePostModal from "@/Components/LawFirms/Posts/DeletePostModal.vue";
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
    AddEditPostModal,
    Table,
    TableTHead,
    TablePagination,
    ViewPostModal,
    DeletePostModal
  },
  props: ["active"],
  mixins: [PaginationMixin],
  data() {
    return {
        law_firm_posts:{},
        modal_post:null,
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
        await this.getLawFirmPosts(loading_more)
     },
     clearModalData(){
        this.modal_post = null
        this.key++
     },
    getLawFirmPosts(loading_more){
    axios.post(this.route('law_firms.law_firm_posts.filter'),this.filter).then(res => {
        const data = res.data.data
        if(loading_more){
            this.law_firm_posts.data = this.law_firm_posts.data.concat(data.data);
        }else{
            this.law_firm_posts.data = data.data;
        }
        this.law_firm_posts.links = data.links
        this.law_firm_posts.meta = data.meta
        this.fetching = false
    });
    },
  }
});
</script>
