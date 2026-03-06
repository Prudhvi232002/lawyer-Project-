<template>
      <app-layout>


  <Head title="Secure Area" />

  <authentication-card>
    <template #logo>
      <authentication-card-logo />
    </template>

    <div class="card-body">
      <div class="mb-2">
        This is a secure area of the application. Please confirm your password
        before continuing.
      </div>

      <validation-errors class="mb-2" />

      <form @submit.prevent="submit">
        <div class="mb-3">
          <label for="password" value="Password" />
          <input
            id="password"
            type="password"
            v-model="form.password"
            required
            autocomplete="current-password"
            autofocus
          />
        </div>

        <div class="d-flex justify-content-end mt-2">
          <button
            class="ms-4"
            :class="{ 'text-white-50': form.processing }"
            :disabled="form.processing"
          >
            <div
              v-show="form.processing"
              class="spinner-border spinner-border-sm"
              role="status"
            >
              <span class="visually-hidden">{{ __('loading') }}...</span>
            </div>

            {{ __('confirm') }}
          </button>
        </div>
      </form>
    </div>
  </authentication-card>
      </app-layout>

</template>

<script>
import { defineComponent } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";

export default defineComponent({
  components: {
    Head,
    AuthenticationCard,
    AuthenticationCardLogo,
    Button,
    Input,
    Label,
    ValidationErrors,
    AppLayout,
  },

  data() {
    return {
      form: this.$inertia.form({
        password: "",
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("password.confirm"), {
        onFinish: () => this.form.reset(),
      });
    },
  },
});
</script>
