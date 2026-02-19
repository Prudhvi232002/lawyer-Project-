<template>
    <div>
    <!-- Modal -->
    <Modal maxWidth="lg" :id="id">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ modalData ? __('update'):__('create') }} {{__('event')}}</h5>
                <button :id="id+'close'" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li v-for="(lang, index) in $page.props.translation_languages" :key="lang.id" class="nav-item" role="presentation">
                            <button :class="{'active': index == 0}" class="nav-link mr-1" :id="`events-nav-${lang.code}-tab`" data-bs-toggle="tab" :data-bs-target="`#events-nav-${lang.code}`" type="button" role="tab" :aria-controls="`events-nav-${lang.code}`" aria-selected="true">{{ lang.name }}</button>
                        </li>
                    </ul>
                    <div v-for="(lang, secondIndex) in $page.props.translation_languages" :key="lang.id" class="tab-content mt-1" id="myTabContent">
                        <div :class="{'show active': secondIndex == 0}" class="tab-pane fade mb-2" :id="`events-nav-${lang.code}`" role="tabpanel" :aria-labelledby="`events-nav-${lang.code}-tab`">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="name">{{__('name')}} ({{ lang.code }})</label>
                                <input v-model="form.name[lang.code]"
                                    class="w-100 form-control  px-3"
                                    :class="{'is-invalid':form.errors[`name.${lang.code}`]}"
                                    placeholder="Please Enter" type="text" />
                                    <span v-if="form.errors[`name.${lang.code}`]">
                                        {{ form.errors[`name.${lang.code}`] }}
                                    </span>
                            </div>
                            <div class="form-group mb-3">
                            <label for="description">{{__('description')}} ({{ lang.code }})</label>
                            <textarea :class="{'is-invalid':form.errors[`description.${lang.code}`]}" v-model="form.description[lang.code]" class="form-control"></textarea>
                            <!-- <ckeditor :editor="editor" v-model="form.description" :config="editorConfig"></ckeditor> -->
                            <span v-if="form.errors[`description.${lang.code}`]">

                                    {{ form.errors[`description.${lang.code}`] }}
                                </span>
                        </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="category">{{ __('choose') }} {{ __('category') }}</label>
                            <select v-model="form.event_category_id" class="form-select"
                                aria-label="category">
                                <option value="">{{ __('select') }}</option>
                                <option v-for="cat in this.event_categories" :key="cat.id" :value="cat.id">{{
                                    cat.name
                                }}</option>
                            </select>
                        </div>
              </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tag">{{ __('choose') }} {{ __('tag') }}</label>
                            <Multiselect v-model="form.tag_ids" valueProp="id" label="name" mode="tags" :close-on-select="false" :searchable="true"
                                                :create-option="true" :options="this.tags" />
                        </div>
                    </div>
                    <div class="col-md-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <label for="sponsor">{{ __("sponsors") }}:</label>
                        <button type="button" class="btn btn-primary float-end btn-sm" @click="addSponser">
                        {{ __("add sponser") }}
                        </button>
                    </div>
                    <div >
                        <div  class="row my-3 align-items-center" v-for="(sponser, index) in form.sponsers" :key="index">
                        <div class="col-md-6">
                            <div class="form-group">
                            <input class="form-control px-3" v-model="form.sponsers[index].name"
                                placeholder="Please Enter" type="text" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                            <div class="form-group">
                                <input type="file" @change="onSponserFileChange($event,index)"
                                class="custom-file-input px-3 w-100 border form-control" name="" id="" />
                            </div>
                            <img v-if="sponser.previous_image" :src="sponser.previous_image" width="75" height="75">
                            <div class="">
                                <div class="form-group ms-2" @click="() => this.form.sponsers.splice(index, 1)">
                                <i class="bi bi-trash3-fill"></i>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>

                    <!-- <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="sponsor">{{__('sponsor')}}</label>
                            <input v-model="form.sponsor"
                                class="w-100 form-control  px-3"
                                :class="{'is-invalid':form.errors.sponsor}"
                                placeholder="Please Enter" type="text" />
                            <span v-if="form.errors.sponsor">
                                    {{ form.errors.sponsor }}
                                </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                    <label for="sponser_image">{{__('sponser image')}}</label>
                    <input id="lawyer-sponser_image" ref="formSponserImage" class="w-100 custom-file-input"   @change="onSponserFileChange" type="file" />
                        </div>
                    </div> -->
                    <div>
                    <!-- Cropped image previewer -->
                        <ImageCropperModal :show="showSponserImportModal" id="eventSponserImageCropModal" :image_url="sponser_image_url" @cropImage="cropSponserImage" ></ImageCropperModal>
                        <img class="mx-auto m-2 w-50 bg-light" :src="croppedSponserImageSrc" />
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="starts_at">{{__('starts at')}}</label>
                            <VueDatePicker :is24="false" v-model="form.starts_at"></VueDatePicker>
                            <span v-if="form.errors.starts_at">
                                    {{ form.errors.starts_at }}
                                </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="ends_at">{{__('ends_at')}}</label>
                            <VueDatePicker :is24="false" v-model="form.ends_at"></VueDatePicker>
                            <span v-if="form.errors.ends_at">
                                    {{ form.errors.ends_at }}
                                </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="address_line_1">{{__('address line 1')}}</label>
                            <input v-model="form.address_line_1"
                                class="w-100 form-control  px-3"
                                :class="{'is-invalid':form.errors.address_line_1}"
                                placeholder="Please Enter" type="text" />
                                <span v-if="form.errors.address_line_1">
                                    {{ form.errors.address_line_1 }}
                                </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="address_line_2">{{__('address line 2')}}</label>
                            <input v-model="form.address_line_2"
                                class="w-100 form-control  px-3"
                                :class="{'is-invalid':form.errors.address_line_2}"
                                placeholder="Please Enter" type="text" />
                                <span v-if="form.errors.address_line_2">
                                    {{ form.errors.address_line_2 }}
                                </span>
                        </div>
                    </div>


                </div>
                <div v-if="modalData && modalData.image" class="form-group mb-3">
                    <label for="previous_image">{{__('previous image')}}</label>
                     <img width="250" height="250" v-if="modalData && modalData.image" class="img-fluid"
                                :src="modalData.image" alt="logo">
                      <span v-if="form.errors.image">
                            {{ form.errors.image }}
                        </span>
                </div>
                <div class="form-group mb-3">
                    <label for="image">{{__('image')}}</label>
                    <input id="law_firm-image" ref="formImage" class="custom-file-input w-100"  @change="onFileChange" type="file" />
                </div>
                <div>
                    <!-- Cropped image previewer -->
                        <ImageCropperModal :show="showImportModal" id="eventImageCropModal" :image_url="image_url" @cropImage="cropImage" ></ImageCropperModal>
                        <img class="mx-auto m-2 w-50 bg-light" :src="croppedImageSrc" />
                    </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" v-model="form.is_active" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                   <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('active') }}?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">{{__('close')}}</button>
                <button :class="{ 'text-white-50': form.processing }" :disabled="form.processing" type="button" class="btn btn-primary" @click="modalData ? update():create()">
                    <div v-show="form.processing" class="spinner-border spinner-border-sm">
                     <span class="visually-hidden">{{ __('loading') }}...</span>
                    </div>
                    <span v-if="modalData">
                    {{__('save changes') }}
                    </span>
                    <span v-else>
                    {{__('create') }}
                    </span>
                </button>
            </div>
            </div>
        </Modal>
    </div>
</template>
<script>
import Modal from "@/Components/Modal.vue";
import { defineComponent } from "vue";
// import CKEditor from '@ckeditor/ckeditor5-vue';
// import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor';
import ImageCropperModal from "@/Components//Shared/ImageCropperModal.vue";
import Multiselect from '@vueform/multiselect'


export default defineComponent({
    components: {
        Modal,
        // ckeditor: CKEditor.component,
        // ClassicEditor,
        ImageCropperModal,
        Multiselect
    },
    data(){
        return {
            form: this.$inertia.form({
                name:{},
                description:{},
                sponsor:"",
                starts_at:"",
                ends_at:"",
                address_line_1:"",
                address_line_2:"",
                is_active:false,
                image:null,
                sponser_image:null,
                tag_ids:[],
                sponsers: [],
                event_category_id:''
             }),
            event_categories: this.$page.props.event_categories,
            tags:this.$page.props.tags,
             showImportModal:false,
            image_url: null,
            croppedImageSrc: null,
            showSponserImportModal:false,
            sponser_image_url:null,
            croppedSponserImageSrc: null,
            // editor:ClassicEditor,
            editorConfig: {
                toolbar: {
                  items: ['heading','bold','italic','link','numberedList','bulletedList','undo','redo']
                  }
                },
        }
    },
    props: {
      id: {
        type: String,
        required: true
      },
      modalData:{
      },
    },
    mounted(){

    },
    methods:{
        onFileChange(e) {
            this.image_url = null
            const file = e.target.files[0];
            this.image_url = URL.createObjectURL(file);
            this.croppedImageSrc = null
            this.showImportModal = true
        },

        cropImage(image){
            this.croppedImageSrc = image
            this.form.image = image
            this.image_url = null
            this.showImportModal = false
        },
        onSponserFileChange(e) {
            this.sponser_image_url = null
            const file = e.target.files[0];
            this.sponser_image_url = URL.createObjectURL(file);
            this.croppedSponserImageSrc = null
            this.showSponserImportModal = true
        },

        cropSponserImage(image){
            this.croppedSponserImageSrc = image
            this.form.sponser_image = image
            this.sponser_image_url = null
            this.showSponserImportModal = false
        },
        close(){
            document.getElementById(this.id+'close').click()
        },
        computed: {
        },
        create(){
            this.form.post(this.route('law_firms.law_firm_events.store'), {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    this.$toast.show("Created Successfully")
                    this.$emit('refreshData')
                    this.$emit('clearModalData')
                    this.close()
                },
            })
        },
        addSponser() {
        this.form.sponsers.push(
            {
            name: '',
            image: '',
            }
        )
        },
        onSponserFileChange(e, index) {
      const file = e.target.files[0];
      this.form.sponsers[index].image = file
    },
        update(){
            this.form.transform((data) => ({
                    ...data,
                    _method: "PUT",
                })).post(this.route('law_firms.law_firm_events.update',{law_firm_event:this.modalData.id}), {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    this.$toast.show("Updated Successfully")
                    this.$emit('refreshData')
                    this.$emit('clearModalData')
                    this.close()
                },
            })
         },
    },
    watch: {
    modalData: {
      handler() {
        this.form = null
        this.croppedImageSrc = null
        this.$refs.formImage.value = null;
        this.$refs.formSponserImage.value = null;
        if(!this.modalData){
            // set defaults
            this.form = this.$inertia.form({
                name:{},
                description:{},
                is_active:false,
                image:null,
                sponser_image:null,
                sponsor:"",
                starts_at:"",
                ends_at:"",
                address_line_1:"",
                address_line_2:"",
                tag_ids:[],
                sponsers:[]
            })
            this.image_url = null
            this.sponser_image_url = null

        }else{
            // set modal editable data
            this.form = this.$inertia.form(this.modalData)
            this.form.image = null
            this.form.sponser_image = null
            this.form.name = this.modalData.name_translations
            this.form.description = this.modalData.description_translations
            if(this.form.is_active){
                this.form.is_active = true
            }else{
                this.form.is_active = false
            }
            this.image_url = null
            this.sponser_image_url = null
        }
      },
      deep: true,
    }
},
})
</script>
