<template>
  <footer class="footer pt-4 position-relative" style="background-color:#282D2D;">
    <!-- <div class="custom-bg"></div> -->
    <div class="container ">
   
      <div class="row pb-3">
        <div class="col-12">
          <div class="row  pt-5">

            <div class="col-md-3">
              <Link :href="route('home')">
                <img v-if="$page.props && $page.props.settings && $page.props.settings.logo" width="150" :src="$page.props.settings.logo" alt="logo">
                <span v-else class="text-white mt-4">
                  {{ $page.props && $page.props.settings && $page.props.settings.site_title ?  $page.props.settings.site_title : __('lawyer consultant') }}
                </span>
              </Link>
              <div class="text-white" v-if="getPageContentType('footer_section_description') == 'textarea'">
                <div v-html="getPageContent('footer_section_description')"> </div>
                </div>
                <div class="text-white"  v-else-if="getPageContentType('footer_section_description') == 'text'">
                    <p> {{getPageContent('footer_section_description') ?? '-'}} </p>
                </div>
                <div class="text-white" v-else>
                    <p>{{ __('footer_tagline_1') }}</p>
                </div>

            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-5">
                  <div class="widget">
                    <h4 class="text-white">{{__("browse")}}
                    </h4>

                    <div class="row">
                      <div class="col-md-7">
                        <ul>
                          <li>
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link class="nav-link" :href="route('home')">{{__("home")}}</Link>
                          </li>
                          <li>
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link class="nav-link" :href="route('company_pages.display',{slug:'about'})"> {{ __('about') }}</Link>
                          </li>




                          <li>
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link class="nav-link" :href="route('events.listing')">{{__("events")}}</Link>
                          </li>
                          <!-- <li> -->
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <!-- <Link class="nav-link" :href="route('our-story')">{{__("our success stories")}}</Link>
                          </li> -->
                          <li>
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link class="nav-link" :href="route('law_firms.listing')">{{__("law_firms")}}</Link>
                          </li>
                        </ul>
                      </div>
                      <div class="col-md-5">
                        <ul>
                          <li>
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link class="nav-link" :href="route('broadcasts.listing')">{{__n("broadcast")}}</Link>
                          </li>
                          <li>
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link class="nav-link" :href="route('blogs.listing')">{{__n("blog")}}</Link>
                          </li>

                          <li>
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link class="nav-link" :href="route('archives.listing')">{{__n("archive")}}</Link>
                          </li>

                          <!-- <li>

                            <Link class="nav-link" :href="route('forum')">{{__("forum")}}</Link>
                          </li> -->

                         <li>
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link class="nav-link" :href="route('podcasts.listing')">{{__("podcast")}}</Link>
                          </li>

                          <li>
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link class="nav-link" :href="route('contact')">{{ __('contact') }}</Link>
                          </li>
                          <li>
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link class="nav-link" :href="route('company_pages.display',{slug:'support'})">{{ __('support') }}</Link>
                          </li>

                           <!-- <li>

                            <Link class="nav-link" :href="route('shop')">{{__("shop")}}</Link>
                          </li> -->

                           <!-- <li>
                             <img src="@/images/common/bullter-1.png" alt="icon">
                            <Link class="nav-link" :href="route('login')">{{__("login")}}</Link>
                          </li>
                          <li>
                             <img src="@/images/common/bullter-1.png" alt="icon">
                            <Link class="nav-link" :href="route('donation')">{{__n("donation")}}</Link>
                          </li> -->

                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="widget">
                    <h4 class="text-white">{{__n("resource")}}</h4>
                    <div class="row">
                      <div class="col-md-12">
                        <ul>
                          <li>
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link :href="route('lawyers.listing')" class="nav-link">{{__n('lawyer')}}</Link>
                          </li>
                          <li v-if="$page.props.settings.commission_type == 'subscription_base'">
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link class="nav-link" v-if="$page.props.auth && hasRole('lawyer') && $page.props.auth.logged_in_as == 'lawyer'" :href="route('pricing',{type:'lawyer'})">{{ __('pricing plan') }}</Link>
                            <Link class="nav-link" v-else-if="$page.props.auth && hasRole('law_firm') && $page.props.auth.logged_in_as == 'law_firm'" :href="route('pricing',{type:'law_firm'})">{{ __('pricing plan') }}</Link>
                            <Link class="nav-link" v-else :href="route('pricing',{type:'lawyer'})">{{ __('pricing plan') }}</Link>

                          </li>

                          <li>
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link class="nav-link" :href="route('faqs')">{{  __('faq') }}</Link>
                          </li>

                        </ul>
                      </div>
                    </div>


                  </div>
                </div>
                <div class="col-md-4">
                  <div class="widget">
                    <h4 class="text-white">{{ __('company') }}</h4>
                    <div class="row">

                      <div class="col-md-6">
                        <ul>
                          <li>
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link class="nav-link" :href="route('company_pages.display',{slug:'terms'})">{{ __('terms of use')}}</Link>
                          </li>
                          <li>
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link class="nav-link" :href="route('company_pages.display',{slug:'privacy'})">{{ __('privacy policy') }}</Link>
                          </li>
                          <li>
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link class="nav-link" :href="route('company_pages.display',{slug:'cookies'})">{{ __('cookies policy') }}</Link>
                          </li>
                          <li>
                            <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                            <Link class="nav-link" :href="route('company_pages.display',{slug:'disclaimer'})">{{ __('disclaimer') }}</Link>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="row mb-4 align-items-center">
            <div class="col-md-12">
              <h4 class="mb-0 text-white">{{__("crisis support")}}</h4>
              <div class="d-flex align-items-center">
                <p class="text-white mb-0" ><b> {{ __('dont use this site if')}}:</b> {{ __('crisis_support_statement') }}. <Link :href="route('company_pages.display',{slug:'crisis-support'})">{{ __('use these resources') }} </Link></p>
                <Link :href="route('company_pages.display',{slug:'support'})" class="btn btn-sm ms-5 btn-primary">
                  {{('support')}} <i class="bi bi-headset"></i>
                </Link>
              </div>

            </div>

          </div> -->

          <div class="row mb-4">
            <div class="col-md-12">
              <!-- <h4 class="mb-0 text-white">{{ __('connect with us') }}</h4> -->
              <ul class="d-flex footer-socails align-items-center justify-content-center ps-0 mb-0">
                <li v-if="$page.props.settings.web_facebook_link"><a target="_blank"
                    :href="$page.props.settings.web_facebook_link"><i class="bi bi-facebook"></i></a></li>
                <li v-if="$page.props.settings.web_youtube_link"><a target="_blank"
                    :href="$page.props.settings.web_youtube_link"><i class="bi bi-youtube"></i></a></li>
                <li v-if="$page.props.settings.web_twitter_link"><a target="_blank"
                    :href="$page.props.settings.web_twitter_link"><i class="bi bi-twitter"></i></a></li>
                <li v-if="$page.props.settings.web_linkedin_link"><a target="_blank"
                    :href="$page.props.settings.web_linkedin_link"><i class="bi bi-linkedin"></i></a></li>
                <li v-if="$page.props.settings.web_whatsapp_link"><a target="_blank"
                    :href="$page.props.settings.web_whatsapp_link"><i class="bi bi-whatsapp"></i></a></li>
                <li v-if="$page.props.settings.web_instagram_link"><a target="_blank"
                    :href="$page.props.settings.web_instagram_link"><i class="bi bi-instagram"></i></a></li>
                <li v-if="$page.props.settings.web_tiktok_link"><a target="_blank"
                    :href="$page.props.settings.web_tiktok_link"><i class="bi bi-tiktok"></i></a></li>
                <li v-if="$page.props.settings.web_snapchat_link"><a target="_blank"
                    :href="$page.props.settings.web_snapchat_link"><i class="bi bi-snapchat"></i></a></li>
                <li v-if="$page.props.settings.web_pinterest_link"><a target="_blank"
                    :href="$page.props.settings.web_pinterest_link"><i class="bi bi-pinterest"></i></a></li>
              </ul>
            </div>
          </div>

        </div>
      </div>


    </div>
    <div class="py-3 bg-secondary" >
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <span class=" text-white fs-6">© {{ new Date().getFullYear() }} {{ __('copyright')}}
              <Link class="link-primary" :href="route('home')"> {{ $page.props && $page.props.settings && $page.props.settings.site_title ?  $page.props.settings.site_title : __('law advisor') }} </Link>
            </span>
          </div>
        </div>
      </div>

    </div>
  </footer>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
  components: {
    Link,
  },
  data() {
    return {

    }
  },
  methods: {
  }

};

</script>
