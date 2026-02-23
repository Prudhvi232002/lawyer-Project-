<template>
  <nav
    class="navbar navbar-expand-lg navbar-light bg-transparent"
    :class="{ sticky: !view.topOfPage }"
  >
    <div class="container">
      <a class="navbar-brand" href="#">
        <Link :href="route('home')">
          <img v-if="$page.props && $page.props.settings && $page.props.settings.logo" width="200" :src="$page.props.settings.logo" alt="logo">
                <span v-else class="text-white mt-4">
                  {{ $page.props && $page.props.settings && $page.props.settings.site_title ?  $page.props.settings.site_title : __('lawyer consultant') }}
                </span>
        </Link>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div
        class="collapse navbar-collapse"
        id="navbarSupportedContent"
        style="flex-grow: inherit"
      >
        <ul class="navbar-nav ml-auto">
          <li class="nav-item" :class="{ active: route().current('home') }">
            <Link class="nav-link" :href="route('home')">
              {{ __("home") }}
            </Link>
          </li>
          <li class="nav-item">
            <Link
              class="nav-link"
              :href="route('company_pages.display', { slug: 'about' })"
            >
              {{ __("about") }}
            </Link>
          </li>
          <li class="nav-item">
            <Link
              class="nav-link"
              :href="route('categories')"
            >
              {{ __("Categories") }}
            </Link>
          </li>
          <li class="nav-item" :class="{ active: route().current('about') }">
            <Link class="nav-link" :href="route('lawyers.listing')">
              {{ __n("lawyer") }}
            </Link>
          </li>
          <li class="nav-item">
            <Link class="nav-link" :href="route('events.listing')">
              {{ __n("event") }}
            </Link>
          </li>

          <li class="nav-item">
            <Link class="nav-link" :href="route('law_firms.listing')">
              {{ __n("law_firm") }}
            </Link>
          </li>
          <li v-if="$page.props.settings.is_community_form_show == 1"
            class="nav-item"
            :class="{ active: route().current('community') }"
          >
            <Link class="nav-link" :href="route('community')">
              {{ __n("Community") }}
            </Link>
          </li>
          <!-- <li class="nav-item">
            <Link class="nav-link" :href="route('forum')">
              {{ __("forum") }}
            </Link>
          </li> -->
          <li class="nav-item" v-if="!$page.props.auth">
            <Link :href="route('login')" class="nav-link"
              ><i class="bi bi-box-arrow-in-right"></i> {{ __("login") }}</Link
            >
          </li>
          <li
            class="nav-item"
            v-if="
              $page.props.auth && $page.props.auth.logged_in_as != 'super_admin'
            "
          >
            <div class="dropdown">
              <button
                class="dropdown-toggle d-flex align-items-center nav-link position-relative bg-transparent border-0"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <span class="position-absolute badge rounded-pill bg-primary" style="right: 0px; top: -10px;">{{ __($page.props.auth.logged_in_as) }}</span>
                {{ $page.props.auth[$page.props.auth.logged_in_as].name }}
              </button>
              <ul class="dropdown-menu">
                <li>
                  <Link :href="route('account')" class="dropdown-item">
                    {{ __("account") }}
                  </Link>
                </li>
                <li
                  v-if="
                    ($page.props.auth.user.email_verified_at &&
                      hasRole('customer') &&
                      $page.props.auth.logged_in_as == 'customer') ||
                    (hasRole('lawyer') &&
                      $page.props.auth.logged_in_as == 'lawyer') ||
                    (hasRole('law_firm') &&
                      $page.props.auth.logged_in_as == 'law_firm')
                  "
                >
                  <Link
                    :href="route('appointment_log')"
                    class="dropdown-item"
                    >{{ __("my appointments") }}</Link
                  >
                </li>
                <li
                  v-if="
                    ($page.props.auth.user.email_verified_at &&
                      hasRole('customer') &&
                      $page.props.auth.logged_in_as == 'customer') ||
                    (hasRole('lawyer') &&
                      $page.props.auth.logged_in_as == 'lawyer') ||
                    (hasRole('law_firm') &&
                      $page.props.auth.logged_in_as == 'law_firm')
                  "
                >
                  <Link
                    :href="route('service_log')"
                    class="dropdown-item"
                    >{{ __("my services") }}</Link
                  >
                </li>
                <li
                  v-if="
                    $page.props.auth.user.email_verified_at &&
                    hasRole('lawyer') &&
                    $page.props.auth.logged_in_as == 'lawyer'
                    && $page.props.settings.commission_type == 'subscription_base'
                  "
                >
                  <Link
                    :href="route('pricing', { type: 'lawyer' })"
                    class="dropdown-item"
                    >{{ __("subscription") }}</Link
                  >
                </li>
                <li
                  v-if="
                    $page.props.auth.user.email_verified_at &&
                    hasRole('law_firm') &&
                    $page.props.auth.logged_in_as == 'law_firm'
                    && $page.props.settings.commission_type == 'subscription_base'
                  "
                >
                  <Link
                    :href="route('pricing', { type: 'law_firm' })"
                    class="dropdown-item"
                    >{{ __("subscription") }}</Link
                  >
                </li>

                <li
                  v-if="
                    $page.props.auth.user.email_verified_at &&
                    hasRole('lawyer') &&
                    $page.props.auth.logged_in_as != 'lawyer'
                  "
                >
                  <button @click="switchRole('lawyer')" class="dropdown-item">
                    {{ __("switch to lawyer") }}
                  </button>
                </li>
                <li
                  v-if="
                    $page.props.auth.user.email_verified_at &&
                    !hasRole('lawyer') &&
                    $page.props.auth.logged_in_as != 'lawyer'
                  "
                >
                  <button @click="becomeLawyer()" class="dropdown-item">
                    {{ __("become a lawyer") }}
                  </button>
                </li>

                <li
                  v-if="
                    $page.props.auth.user.email_verified_at &&
                    hasRole('customer') &&
                    $page.props.auth.logged_in_as != 'customer'
                  "
                >
                  <button @click="switchRole('customer')" class="dropdown-item">
                    {{ __("switch to user") }}
                  </button>
                </li>
                <li
                  v-if="
                    $page.props.auth.user.email_verified_at &&
                    !hasRole('customer') &&
                    $page.props.auth.logged_in_as != 'customer'
                  "
                >
                  <button @click="becomeUser()" class="dropdown-item">
                    {{ __("become a user") }}
                  </button>
                </li>

                <li
                  v-if="
                    $page.props.auth.user.email_verified_at &&
                    hasRole('law_firm') &&
                    $page.props.auth.logged_in_as != 'law_firm'
                  "
                >
                  <button @click="switchRole('law_firm')" class="dropdown-item">
                    {{ __("switch to law_firm") }}
                  </button>
                </li>
                <li
                  v-if="
                    $page.props.auth.user.email_verified_at &&
                    !hasRole('law_firm') &&
                    $page.props.auth.logged_in_as != 'law_firm'
                  "
                >
                  <button @click="becomeLawFirm()" class="dropdown-item">
                    {{ __("become a law_firm") }}
                  </button>
                </li>
                <li
                  v-if="(parseInt(this.$page.props.settings.enable_wallet_system) && $page.props.auth.user.email_verified_at && hasRole('customer') && $page.props.auth.logged_in_as == 'customer') || (hasRole('lawyer') && $page.props.auth.logged_in_as == 'lawyer') || (hasRole('law_firm') && $page.props.auth.logged_in_as == 'law_firm')
                  "
                >
                  <Link
                    :href="route('wallet')"
                    class="dropdown-item"
                    >{{ __("wallet") }}</Link
                  >
                </li>
                <li>
                  <!-- <Link :href="route('logout')" class="dropdown-item">
                  <i class="bi bi-box-arrow-in-left"></i>
                    {{__("logout")}}
                  </Link> -->
                  <button
                    style="pointer: cursor"
                    @click="logout()"
                    class="dropdown-item"
                  >
                    <i class="bi bi-box-arrow-in-left"></i> {{ __("logout") }}
                  </button>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item dropdown" v-if="$page.props.company_pages && $page.props.company_pages.length > 0">

          <a class="nav-link dropdown-toggle" href="#" id="companyPagesDropDown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
             {{ __("Company Pages") }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="companyPagesDropDown">
              <li v-for="company_page in $page.props.company_pages" :key="company_page.id">
                  <Link class="dropdown-item" :href="route('company_pages.display',{slug:company_page.slug})">
                      {{ company_page.name }}
                  </Link>
              </li>

          </ul>
        </li>
          <!-- <li class="nav-item">
            <Link class="btn btn-sm rounded-4 fw-semibold btn-light" :href="route('donation')" type="submit"><i
              class="bi me-1 text-danger bi-emoji-heart-eyes"></i> {{__n("donation")}}</Link>
          </li> -->
          <li class="nav-item dropdown" v-if="$page.props.translation_languages">

          <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
              {{ getSelectedLocate }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown">
              <li v-for="lang in $page.props.translation_languages" :key="lang.id">
                  <Link class="dropdown-item" :href="route('language', { language: lang.code })">
                      {{ lang.name }}
                  </Link>
              </li>

          </ul>
            <!-- <select class="bg-transparent border-0 nav-link" style="width:110px;" @change="this.switchLanguage()" v-model="locale">
                          <option v-for="lang in this.$page.props.translation_languages" :key="lang.id" :value="lang.code">
                              {{ lang.name }}
                          </option>
                        </select> -->
            </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
  components: {
    Link,
  },
  data() {
    return {
      locale: this.$page.props.locale,
      view: {
        topOfPage: true,
        pusherDeviceId: "",
      },
    };
  },
  beforeMount() {
    window.addEventListener("scroll", this.handleScroll);
  },
  methods: {
    logout() {
        if (this.$page.props.settings.pusher_beams_instance_id) {
            const VITE_PUSHER_BEAMS_INSTANCE_ID = this.$page.props.settings.pusher_beams_instance_id;
            const beamsClient = new PusherPushNotifications.Client({
                instanceId: VITE_PUSHER_BEAMS_INSTANCE_ID,
            });
            //   beamsClient
            //     .start()
            //     .then((beamsClient) => beamsClient.getDeviceId())
            //     .then((deviceId) => {
            //         console.log("Successfully registered with Beams. Device ID:", deviceId);
            //         this.pusherDeviceId = deviceId
            //     })
            beamsClient
                .clearAllState()
                .then(async () => {
                console.log("Beams state has been cleared");
                })
                .catch((e) => console.error("Could not clear Beams state", e));
        }

      this.$inertia.get(route("logout"));
    },
    switchLanguage() {
      this.$inertia.get(route("language", { language: this.locale }));
    },
    switchRole(role) {
      this.$emit('showLoaderEvent', 1);
      if (this.$page.props.settings.pusher_beams_instance_id) {

      const VITE_PUSHER_BEAMS_INSTANCE_ID = this.$page.props.settings.pusher_beams_instance_id;
      const beamsClient = new PusherPushNotifications.Client({
        instanceId: VITE_PUSHER_BEAMS_INSTANCE_ID,
      });
      beamsClient
        .clearAllState()
        .then(() => {
          console.log("Beams state has been cleared");
        })
        .catch((e) => console.error("Could not clear Beams state", e));
    }
      this.$inertia.post(this.route("account.switch_role", { role: role }), {
        onFinish: () => this.$toast.show("Switched To " + role),
      });
    },
    becomeLawyer() {
      this.$emit('showLoaderEvent', 1);
      this.$inertia.post(this.route("account.become_lawyer"), {
        onFinish: () => this.$toast.show("You are now a Lawyer"),
      });
    },
    becomeUser() {
      this.$emit('showLoaderEvent', 1);
      this.$inertia.post(this.route("account.become_user"), {
        onFinish: () => this.$toast.show("You are now a Customer"),
      });
    },
    becomeLawFirm() {
      this.$emit('showLoaderEvent', 1);
      this.$inertia.post(this.route("account.become_law_firm"), {
        onFinish: () => this.$toast.show("You are now a law_firm User"),
      });
    },
    handleScroll() {
      if (window.pageYOffset > 0) {
        if (this.view.topOfPage) this.view.topOfPage = false;
      } else {
        if (!this.view.topOfPage) this.view.topOfPage = true;
      }
    },
  },
  computed: {
        getSelectedLocate() {
            var index = this.$page.props.translation_languages.findIndex((obj) => obj.code === this.locale);
            if (index >= 0) {
                return this.$page.props.translation_languages[index].name
            }
        }
    }
};
</script>

