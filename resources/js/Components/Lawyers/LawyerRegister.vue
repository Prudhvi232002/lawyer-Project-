<template>
  <div
    class="tab-pane"
    :class="{ active: active }"
    id="lawyer-register-pane"
    role="tabpanel"
    aria-labelledby="lawyer-register-pane"
    tabindex="0"
  >
    <form @submit.prevent="submit" class="loginForm">
      <validation-errors class="mb-3" />

      <div class="col-12">
        <div class="row">
          <div class="col-12">
            <div v-if="this.errors.first_name" class="error-validation text-end">
              <span>{{this.errors.first_name}}</span>
            </div>
            <div class="form-group mb-4">
              <div class="form-floating">
                <input
                  id="first_name"
                  class="form-control py-3 border border-primary"
                  :placeholder="__('First name')"
                  type="text"
                  v-model="form.first_name"
                />
             
              </div>
            </div>
            <div v-if="this.errors.last_name" class="error-validation text-end">
              <span>{{this.errors.last_name}}</span>
            </div>
            <div class="form-group mb-4">
              <div class="form-floating">
                <input
                  id="last_name"
                  class="form-control py-3 border border-primary"
                  :placeholder="__('Last name')"
                  type="text"
                  v-model="form.last_name"
                />
            
              </div>
            </div>


            <div v-if="this.errors.user_name" class="error-validation text-end">
              <span>{{this.errors.user_name}}</span>
            </div>
            <div class="form-group mb-4">
              <div class="form-floating">
                <input
                  id="user_name"
                  class="form-control py-3 border border-primary"
                  :placeholder="__('User name')"
                  type="text"
                  v-model="form.user_name"
                />
             
              </div>
            </div>
            <div class="form-group mb-4">
              <div class="form-floating">
                <input
                  id="zip_code"
                  class="form-control py-3 border border-primary"
                  :placeholder="__('Zip code')"
                  type="text"
                  v-model="form.zip_code"
                />
             
              </div>
            </div>
            <div v-if="this.errors.email" class="error-validation text-end">
              <span>{{this.errors.email}}</span>
            </div>
            <div class="form-group mb-4">
              <div class="form-floating">
                <input
                  id="email"
                  class="form-control py-3 border border-primary"
                  placeholder="Email Address"
                  type="email"
                  v-model="form.email"
                />
              
              </div>
            </div>

            <div v-if="this.errors.password" class="error-validation text-end">
              <span>{{this.errors.password}}</span>
            </div>
            <div class="form-group mb-4">
              <div class="form-floating">
                <input
                  id="pass_log_log"
                  class="form-control py-3 border border-primary"
                  type="password"
                  v-model="form.password"
                  name="password"
                  :placeholder="__('Password')"
                />
               
              </div>
              <span
                toggle="#password-field"
                class="fa fa-fw fa-eye field_icon toggle-password-log position-absolute input-icon fs-5"
              ></span>
            </div>

            <div v-if="this.errors.password_confirmation" class="error-validation text-end">
              <span>{{this.errors.password_confirmation}}</span>
            </div>
            <div class="form-group mb-4">
              <div class="form-floating">
                <input
                  id="pass_log_log"
                  class="form-control py-3 border border-primary"
                  type="password"
                  v-model="form.password_confirmation"
                  name="password_confirmation"
                  :placeholder="__('Confirm password')"
                />
               
              </div>
              <span
                toggle="#password-field"
                class="fa fa-fw fa-eye field_icon toggle-password-log position-absolute input-icon fs-5"
              ></span>
            </div>
          </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12 mb-3">
                <div class="form-check">
                  <div v-if="this.errors.terms" class="error-validation text-end">
                    <span>{{this.errors.terms}}</span>
                  </div>
                    <input v-model="form.terms" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" style="font-size: 14px;" for="flexCheckDefault">
                      <!-- {{ __('terms changes') }}
                        <a :href="route('company_pages.display',{slug:'terms'})" target="_blank">Terms of Use & Conditions</a>

                         and the <a :href="route('company_pages.display',{slug:'privacy'})" target="_blank">Privacy Policy</a>
                    </label> -->
                         {{ __('terms changes') }}
                        <a  class="link-primary" :href="route('company_pages.display',{slug:'terms'})" target="_blank">{{ __('terms of use') }} &{{ __('condition') }} </a>

                        {{ __('and the') }}<a  class="link-primary" :href="route('company_pages.display',{slug:'privacy'})" target="_blank"> {{ __('privacy policy') }}</a>
                    </label>
                </div>
            </div>
          <div class="col-md-4">
            <button
              class="submit btn btn-primary"
              :class="{ 'text-white-50': form.processing }"
              :disabled="form.processing"
            >
              <div v-show="form.processing" class="spinner-border spinner-border-sm">
                <span class="visually-hidden">{{ __('loading') }}...</span>
              </div>
              {{ __('register') }}
            </button>
          </div>
          <div class="col-md-8 text-end">
            <p class="mb-0">
              {{ __('already have a account') }}?
              <Link
              
                :href="route('login',{tab:'lawyer'})"
                class="link ms-2 text-capitalize link-primary"
              >{{ __('login') }}</Link>
            </p>
          </div>
        </div>
      </div>
    </form>

    <hr />

    <div class="col-md-12">
      <div class>
        <p>{{ __('social logins') }}</p>

        <a
          :href="route('social_redirect', { provider: 'google', login_as: this.form.login_as })"
          class="customSignIn customGPlusSignIn text-capitalize"
        >
          <span class="icon"></span>
          <span class="buttonText text-black">{{ __('google') }}</span>
        </a>

        <a
          :href="route('social_redirect', { provider: 'facebook', login_as: this.form.login_as })"
          class="customSignIn customFbSignIn text-capitalize"
        >
          <span class="icon"></span>
          <span class="buttonText text-black">{{ __('facebook') }}</span>
        </a>
      </div>
    </div>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import Checkbox from "@/Components/Checkbox.vue";
import Label from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Head,
    Button,
    Input,
    Checkbox,
    Label,
    ValidationErrors,
    Link
  },

  props: {
    canResetPassword: Boolean,
    status: String,
    active: Boolean
  },

  data() {
    return {
      form: this.$inertia.form({
        first_name: "",
        last_name: "",
        user_name: "",
        zip_code: "",
        email: "",
        password: "",
        password_confirmation: "",
        terms: false,
        login_as: "lawyer"
      }),
      errors: {
        first_name: null,
        last_name: null,
        user_name: null,
        email: null,
        zip_code: null,
        password: null,
        password_confirmation: null
      }
    };
  },

  methods: {
    submit() {
        this.emptyErrors();
      if (
        this.form.email &&
        this.form.password &&
        this.form.first_name &&
        this.form.last_name &&
        this.form.password_confirmation
      ) {
        this.form.post(this.route("register"), {
          onFinish: () => this.form.reset("password", "password_confirmation")
        });
      }

      if (!this.form.first_name) {
        this.errors.first_name = "First Name is required.";
      }
      if (!this.form.last_name) {
        this.errors.last_name = "Last Name is required.";
      }
      if (!this.form.user_name) {
        this.errors.user_name = "User Name is required.";
      }

      if (!this.form.email) {
        this.errors.email = "Email is required.";
      }

      if (!this.form.password) {
        this.errors.password = "Password is required.";
      }

      if (!this.form.password_confirmation) {
        this.errors.password_confirmation =
          "Password Confirmation is required.";
      }
      if (!this.form.terms) {
        this.errors.terms =
          "You Must Agree Terms.";
      }
    },
    emptyErrors(){
        this.errors.email = null;
        this.errors.password = null;
        this.errors.first_name = null;
        this.errors.last_name= null;
        this.errors.user_name= null;
        this.errors.password_confirmation = null;
        this.errors.terms = null;
    }

  }
});
</script>
