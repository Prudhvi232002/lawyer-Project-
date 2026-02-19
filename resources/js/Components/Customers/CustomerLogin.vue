<template>
  <div
    class="tab-pane"
    :class="{ active: active }"
    id="customer-login-pane"
    role="tabpanel"
    aria-labelledby="customer-login-tab"
    tabindex="0"
  >
    <!-- <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a vestibulum metus,
    sed ultrices tellus. Etiam finibus elit non condimentum auctor. </p>-->
    <form @submit.prevent="submit" class="loginForm">
      <validation-errors class="mb-3" />

      <div class="col-12">
        <div class="row">
          <div class="col-12">
            <div v-if="this.errors.email" class="error-validation text-end">
                <span >{{this.errors.email}}</span>
            </div>
            <div class="input-group mb-4">
              <div class="form-floating">
                <input
                  id="email"
                  class="form-control border py-3 border-primary" style="border-top-right-radius: 0px !important; border-bottom-right-radius: 0px !important;"
                  :placeholder="__('email address')"
                  type="email"
                  v-model="form.email"
                />
              
              </div>

              <span class="input-group-text" id="basic-addon2">
                <i class="bi bi-envelope fs-5"></i>
              </span>
            </div>


            <div v-if="this.errors.password" class="error-validation text-end">
                <span >{{this.errors.password}}</span>
            </div>
            <div class="input-group mb-4">
              <div class="form-floating">
                <!-- <label for="password">{{ __('password') }}</label> -->
                <input
                  id="pass_log_log"
                  class="form-control py-3 border border-primary" style="border-top-right-radius: 0px !important; border-bottom-right-radius: 0px !important;"
                  type="password"
                  v-model="form.password"
                  name="password"
                  :placeholder="__('password')"
                />
             
              </div>
              <span class="input-group-text" toggle="#password-field">
                <Link
                 style="color: var(--bs-primary);"
                  class="text-decoration-none me-3"
                  :href="route('forgot_password')"
                >{{ __('forgot password') }}?</Link>
                <i class="bi bi-key field_icon toggle-password-log input-icon fs-5"></i>
              </span>
            </div>


          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-md-4">
            <button
              class="submit btn btn-primary"
              :class="{ 'text-white-50': form.processing }"
              :disabled="form.processing"
            >
            <SpinnerLoader v-if="form.processing" />
              {{ __('login') }}
            </button>
          </div>
          <div class="col-md-8 text-end">
            <p class="mb-0">
              {{ __('dont have a account') }}?
              <Link
                :href="route('register',{tab:'user'})"
                class="link ms-2 text-capitalize link-primary"
              >{{ __('register') }}</Link>
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
import SpinnerLoader from "@/Components/Shared/SpinnerLoader.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Button,
    Input,
    Checkbox,
    SpinnerLoader,
    Label,
    ValidationErrors,
    Link
  },

  props: {
    canResetPassword: Boolean,
    status: String,
    active: Boolean,
    redirectUrl : String
  },

  data() {
    return {
      form: this.$inertia.form({
        email: "",
        password: "",
        remember: false,
        login_as: "customer",
        redirectUrl: null
      }),
      errors: {
        email: null,
        password: null,
      }
    };
  },

  methods: {
    submit() {
        this.emptyErrors();
      if (this.form.email && this.form.password) {
        if(this.redirectUrl && this.redirectUrl != ''){
            this.form.redirectUrl = this.redirectUrl
              }
        this.form
        .transform(data => ({
          ...data,
          remember: this.form.remember ? "on" : ""
        }))
        .post(this.route("submit.login"), {
            onFinish: () => {
              this.form.reset("password")
              if(this.redirectUrl && this.redirectUrl != ''){
                  this.$inertia.visit(this.redirectUrl)
              }
          },
        });
      }

      if (!this.form.email) {
        this.errors.email = 'Email is required.';
      }
      if (!this.form.password) {
        this.errors.password = 'Password is required.';
      }
    },
    emptyErrors(){
        this.errors.email = null;
        this.errors.password = null;
    }
  }
});
</script>
<style >

</style>
