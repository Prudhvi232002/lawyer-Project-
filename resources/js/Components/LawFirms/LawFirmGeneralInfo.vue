<template>
  <div
    class="tab-pane"
    :class="{ active: active }"
    id="general-info"
    role="tabpanel"
    aria-labelledby="general-info-tab"
    tabindex="0"
  >
    <form @submit.prevent="submit" class="profileForm">
      <div class="row">
        <!-- <div class="col-12">
                    <div class="cover-header rounded-2">

                    </div>
                </div> -->
        <div class="col-12 position-relative">
          <label
            for="lawyer-cover-image"
            style="position: absolute; right: 20px; top: 10px"
          >
            <div
              class="icon z-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
              style="cursor: pointer; width: 40px; height: 40px"
            >
              <i class="bi bi-pencil-fill"></i>
            </div>
            <!-- <img
                                v-if="form.cover_image"
                                class="img-fluid w-100"
                                :src="form.cover_image"
                                alt="logo"
                            />
                            <img
                                v-if="!form.cover_image && $page.props.law_firm.cover_image"
                                class="img-fluid w-100"
                                :src="$page.props.law_firm.cover_image"
                                alt="logo"
                            /> -->

            <ImageCropperModal
              :show="showCoverImportModal"
              id="coverImageCropModal"
              :image_url="cover_image_url"
              @cropImage="cropCoverImage"
              aspectRatio="2/1"
            >
            </ImageCropperModal>
          </label>
          <div
            class="cover-header rounded-2"
            v-if="!form.cover_image && !$page.props.law_firm.cover_image"
          ></div>

          <div
            v-if="form.cover_image"
            class="cover-header rounded-2"
            v-bind:style="{
              'background-image': 'url(' + form.cover_image + ')',
            }"
          ></div>

          <div
            class="cover-header rounded-2"
            v-if="!form.cover_image && $page.props.law_firm.cover_image"
            v-bind:style="{
              'background-image':
                'url(' + $page.props.law_firm.cover_image + ')',
            }"
          ></div>
        </div>
        <div class="col-md-3">
          <label for="law_firm-image">
            <!-- <label for="image" class="mb-3">{{ __('select') }} {{ __('image') }}</label> -->
            <div
              class="profile-image mx-4 mb-5 shadow rounded-2 position-relative"
              style="background-color: #e4e4e4; width: 220px"
            >
              <div
                class="icon position-absolute z-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                style="cursor: pointer; width: 40px; height: 40px"
              >
                <i class="bi bi-pencil-fill"></i>
              </div>
              <img
                v-if="form.image"
                class="img-fluid"
                :src="form.image"
                alt="logo"
              />
              <img
                v-if="!form.image && $page.props.law_firm.image"
                class="img-fluid"
                :src="$page.props.law_firm.image"
                alt="logo"
              />
              <img
                v-if="!form.image && !$page.props.law_firm.image"
                class="img-fluid"
                src="@/images/account/default_avatar_men.png"
                alt="logo"
              />
            </div>
            <button
              data-bs-toggle="modal"
              id="law_firmImageCropperModalButton"
              data-bs-target="#law_firmImageCropModal"
              style="display: none"
            ></button>
            <ImageCropperModal
              :show="showImportModal"
              id="law_firmImageCropModal"
              :image_url="image_url"
              @cropImage="cropImage"
              aspectRatio="1/1"
            >
            </ImageCropperModal>
          </label>
          <input
            id="law_firm-image"
            style="display: none"
            @change="onFileChange"
            type="file"
          />
          <input
            id="lawyer-cover-image"
            style="display: none"
            @change="onFileChangeCover"
            type="file"
          />
        </div>

        <div class="col-12">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <label for="status" class="me-2"
                ><b>{{ __("status") }}:</b></label
              >
              <input
                id="healer-image"
                style="display: none"
                @change="onFileChange"
                type="file"
              />
              <span
                v-if="
                  $page.props &&
                  $page.props.law_firm &&
                  $page.props.law_firm.is_active
                "
                class="badge bg-success"
                >{{ __("active") }}</span
              >
              <span v-else class="badge bg-danger">{{ __("inactive") }}</span>
            </div>

            <div class="d-flex align-items-start" v-if="$page.props.settings.commission_type == 'subscription_base'">
              <label for="subscription" class="me-2"
                ><b>{{ __("package plan") }}:</b></label
              >
              <span class="badge mx-2 bg-primary">{{
                $page.props.law_firm.pricing_plan_name ?? "N/A"
              }}</span>
              <Link :href="route('pricing', { type: 'law_firm' })" class=""
                ><i class="bi bi-pencil-fill"></i
              ></Link>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <validation-errors></validation-errors>

          <div class="col-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="category"
                    >{{ __("choose") }} {{ __("category") }}</label
                  >
                  <Multiselect
                    v-model="form.law_firm_categories"
                    valueProp="id"
                    label="name"
                    groupLabel="name"
                    groupOptions="categories"
                    :groupSelect="true"
                    :groups="true"
                    mode="tags"
                    :close-on-select="false"
                    :searchable="true"
                    :options="this.law_firm_categories"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="law_firm_name"
                    >{{ __("law_firm") }} {{ __("name") }}</label
                  >
                  <input
                    v-model="form.law_firm_name"
                    class="w-100 form-control px-3"
                    placeholder="Please Enter"
                    type="text"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="law_firm_website"
                    >{{ __("law_firm") }} {{ __("website") }}</label
                  >
                  <input
                    v-model="form.law_firm_website"
                    class="w-100 form-control px-3"
                    placeholder="Please Enter"
                    type="text"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="user_name">{{ __("username") }}</label>
                  <input
                    v-model="form.user_name"
                    class="w-100 form-control px-3"
                    placeholder="Please Enter"
                    type="text"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="first_name">{{ __("first name") }}</label>
                  <input
                    v-model="form.first_name"
                    class="w-100 form-control px-3"
                    placeholder="Please Enter"
                    type="text"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="last_name">{{ __("last name") }}</label>
                  <input
                    v-model="form.last_name"
                    class="w-100 form-control px-3"
                    placeholder="Please Enter"
                    type="text"
                  />
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="country"
                    >{{ __("select") }} {{ __("country") }}</label
                  >
                  <select
                    v-model="form.country_id"
                    @change="getStates()"
                    class="form-select"
                    aria-label="country"
                  >
                    <option value="null" selected disabled>
                      {{ __("country") }}
                    </option>
                    <option
                      v-for="country in this.countries"
                      :key="country.id"
                      :value="country.id"
                    >
                      {{ country.name }}
                    </option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="state"
                    >{{ __("select") }} {{ __("state") }}</label
                  >
                  <select
                    v-model="form.state_id"
                    @change="getCities()"
                    class="form-select"
                    aria-label="state"
                  >
                    <option value="null" selected disabled>
                      {{ __("state") }}
                    </option>
                    <option
                      v-for="state in this.states"
                      :key="state.id"
                      :value="state.id"
                    >
                      {{ state.name }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="city">{{ __("select") }} {{ __("city") }}</label>
                  <select
                    v-model="form.city_id"
                    class="form-select"
                    aria-label="city"
                  >
                    <option value="null" selected disabled>
                      {{ __("city") }}
                    </option>
                    <option
                      v-for="city in this.cities"
                      :key="city.id"
                      :value="city.id"
                    >
                      {{ city.name }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="zip_code">{{ __("zip code") }}</label>
                  <input
                    v-model="form.zip_code"
                    class="w-100 form-control px-3"
                    placeholder="Please Enter"
                    type="text"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="address">{{ __("address line") }} 1</label>
                  <textarea
                    v-model="form.address_line_1"
                    class="w-100 form-control px-3"
                    placeholder="Please Enter"
                    type="text"
                  ></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="address">{{ __("address line") }} 2</label>
                  <textarea
                    v-model="form.address_line_2"
                    class="w-100 form-control px-3"
                    placeholder="Please Enter"
                    type="text"
                  ></textarea>
                </div>
              </div>
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li
                  v-for="(lang, index) in $page.props.translation_languages"
                  :key="lang.id"
                  class="nav-item"
                  role="presentation"
                >
                  <button
                    :class="{ active: index == 0 }"
                    class="nav-link mr-1"
                    :id="`nav-${lang.code}-tab`"
                    data-bs-toggle="tab"
                    :data-bs-target="`#nav-${lang.code}`"
                    type="button"
                    role="tab"
                    :aria-controls="`nav-${lang.code}`"
                    aria-selected="true"
                  >
                    {{ lang.name }}
                  </button>
                </li>
              </ul>
              <div
                v-for="(lang, secondIndex) in $page.props.translation_languages"
                :key="lang.id"
                class="tab-content mt-1"
                id="myTabContent"
              >
                <div
                  :class="{ 'show active': secondIndex == 0 }"
                  class="tab-pane fade mb-2"
                  :id="`nav-${lang.code}`"
                  role="tabpanel"
                  :aria-labelledby="`nav-${lang.code}-tab`"
                >
                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <label for="description"
                        >{{ __("description") }} ({{ lang.code }})</label
                      >
                      <textarea
                        :class="{
                          'is-invalid': form.errors[`description.${lang.code}`],
                        }"
                        v-model="form.description[lang.code]"
                        class="form-control"
                      ></textarea>
                      <span v-if="form.errors[`description.${lang.code}`]">
                        {{ form.errors[`description.${lang.code}`] }}
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3 position-relative">
                  <label for="home_phone">{{ __("home phone") }}</label>
                  <input
                    :disabled="disable_fields"
                    v-model="form.home_phone"
                    class="w-100 form-control px-3"
                    placeholder="Please Enter"
                    type="text"
                  />
                  <div
                    class="spinner-border position-absolute"
                    ref="home_phone"
                    role="status"
                    style="top: 35px; right: 10px; display: none"
                  >
                    <span class="visually-hidden">Loading...</span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3 position-relative">
                  <label for="cell_phone">{{ __("cell phone") }}</label>
                  <input
                    :disabled="disable_fields"
                    v-model="form.cell_phone"
                    class="w-100 form-control px-3"
                    placeholder="Please Enter"
                    type="text"
                  />
                  <div
                    class="spinner-border position-absolute"
                    ref="cell_phone"
                    role="status"
                    style="top: 35px; right: 10px; display: none"
                  >
                    <span class="visually-hidden">Loading...</span>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="job_title">{{ __("job title") }}</label>
                  <input
                    :disabled="disable_fields"
                    v-model="form.job_title"
                    class="w-100 form-control px-3"
                    placeholder="Please Enter"
                    type="text"
                  />
                  <div
                    class="spinner-border position-absolute"
                    ref="job_title"
                    role="status"
                    style="top: 35px; right: 10px; display: none"
                  >
                    <span class="visually-hidden">Loading...</span>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group mb-3 position-relative">
                  <label for="company">{{ __("company") }}</label>
                  <input
                    :disabled="disable_fields"
                    v-model="form.company"
                    class="w-100 form-control px-3"
                    placeholder="Please Enter"
                    type="text"
                  />
                  <div
                    class="spinner-border position-absolute"
                    ref="company"
                    role="status"
                    style="top: 35px; right: 10px; display: none"
                  >
                    <span class="visually-hidden">Loading...</span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="website">{{ __("website") }}</label>
                  <input
                    :disabled="disable_fields"
                    v-model="form.website"
                    class="w-100 form-control px-3"
                    placeholder="Please Enter"
                    type="text"
                  />
                  <div
                    class="spinner-border position-absolute"
                    ref="website"
                    role="status"
                    style="top: 35px; right: 10px; display: none"
                  >
                    <span class="visually-hidden">Loading...</span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3 position-relative">
                  <label for="email">{{ __("email") }}</label>
                  <input
                    :disabled="disable_fields"
                    v-model="form.email"
                    class="w-100 form-control px-3"
                    placeholder="Please Enter"
                    type="text"
                  />
                  <div
                    class="spinner-border position-absolute"
                    ref="email"
                    role="status"
                    style="top: 35px; right: 10px; display: none"
                  >
                    <span class="visually-hidden">Loading...</span>
                  </div>
                </div>
              </div>

              <div class="col-md-12 profile-page-wizrd">
                <Wizard
                  navigable-tabs
                  hideButtons
                  :custom-tabs="[
                    {
                      title: 'Home Address',
                    },
                    {
                      title: 'Work Address',
                    },
                    {
                      title: 'Billing Address',
                    },
                    {
                      title: 'Shipping Address',
                    },
                  ]"
                  :beforeChange="onTabBeforeChange"
                  @change="onChangeCurrentTab"
                >
                  <div v-if="currentTabIndex === 0">
                    <div class="card bg-white shadow-sm p-4">
                      <!-- Home Address -->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group mb-3">
                            <label for="country"
                              >{{ __("select") }} {{ __("country") }}</label
                            >
                            <select
                              v-model="form.country_id"
                              @change="getStates()"
                              class="form-select"
                              aria-label="country"
                            >
                              <option value="null" selected disabled>
                                {{ __("country") }}
                              </option>
                              <option
                                v-for="country in this.countries"
                                :key="country.id"
                                :value="country.id"
                              >
                                {{ country.name }}
                              </option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group mb-3">
                            <label for="state"
                              >{{ __("select") }} {{ __("state") }}</label
                            >
                            <select
                              v-model="form.state_id"
                              @change="getCities()"
                              class="form-select"
                              aria-label="state"
                            >
                              <option value="null" selected disabled>
                                {{ __("state") }}
                              </option>
                              <option
                                v-for="state in this.states"
                                :key="state.id"
                                :value="state.id"
                              >
                                {{ state.name }}
                              </option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group mb-3">
                            <label for="city"
                              >{{ __("select") }} {{ __("city") }}</label
                            >
                            <select
                              v-model="form.city_id"
                              class="form-select"
                              aria-label="city"
                            >
                              <option value="null" selected disabled>
                                {{ __("city") }}
                              </option>
                              <option
                                v-for="city in this.cities"
                                :key="city.id"
                                :value="city.id"
                              >
                                {{ city.name }}
                              </option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group mb-3 position-relative">
                            <label for="zip_code">{{ __("zip code") }}</label>
                            <input
                              :disabled="disable_fields"
                              v-model="form.zip_code"
                              class="w-100 form-control px-3"
                              placeholder="Please Enter"
                              type="text"
                            />
                            <div
                              class="spinner-border position-absolute"
                              ref="zip_code"
                              role="status"
                              style="top: 35px; right: 10px; display: none"
                            >
                              <span class="visually-hidden">Loading...</span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group mb-3">
                            <label for="address"
                              >{{ __("address line") }} 1</label
                            >
                            <div class="input-group-from position-relative">
                              <vue-google-autocomplete
                                id="map"
                                ref="address"
                                enable-geolocation
                                classname="w-100 form-control px-3"
                                :placeholder="__('please enter')"
                                v-on:inputChange="updateLocation"
                                v-on:placechanged="getAddressData"
                              >
                              </vue-google-autocomplete>
                              <button
                                type="button"
                                class="btn position-absolute"
                                style="right: 10px; top: 3px"
                                @click="getCurrentLocation()"
                              >
                                <i class="bi bi-geo-alt-fill"></i>
                              </button>
                            </div>
                            <GMapMap
                              :center="{
                                lat: this.form.latitude,
                                lng: this.form.longitude,
                              }"
                              :zoom="7"
                              class="mt-3"
                              map-type-id="terrain"
                              style="width: 100%; height: 500px"
                            >
                              <GMapMarker
                                @dragend="showInfo"
                                ref="myMarker"
                                @click="openInfoWIndow($event)"
                                :clickable="true"
                                :draggable="true"
                                :position="{
                                  lat: this.form.latitude,
                                  lng: this.form.longitude,
                                }"
                              />
                            </GMapMap>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group mb-3 position-relative">
                            <label for="address"
                              >{{ __("address line") }} 2</label
                            >
                            <textarea
                              :disabled="disable_fields"
                              v-model="form.address_line_2"
                              class="w-100 form-control px-3"
                              placeholder="Please Enter"
                              type="text"
                            ></textarea>
                            <div
                              class="spinner-border position-absolute"
                              ref="address_line_2"
                              role="status"
                              style="top: 35px; right: 10px; display: none"
                            >
                              <span class="visually-hidden">Loading...</span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="d-md-flex justify-content-end">
                          <button
                            type="button"
                            @click="onChangeCurrentTab(1)"
                            class="btn btn-primary"
                          >
                            Next
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div v-if="currentTabIndex === 1">
                    <div class="card bg-white shadow-sm p-4">
                      <div class="row">
                        <div class="form-group mb-3">
                          <div class="row">
                            <div class="col-6">
                              <div class="form-check form-switch">
                                <input
                                  class="form-check-input"
                                  v-model="billing_same_address"
                                  @change="makeSameAddress('billing')"
                                  type="checkbox"
                                  role="switch"
                                  id="CoCreationSwitch"
                                />
                                <label
                                  class="form-check-label"
                                  for="CoCreationSwitch"
                                  >{{ __("same as home address") }}?</label
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <!-- Billing Address -->
                          <div class="form-group mb-3">
                            <label for="country"
                              >{{ __("select") }} {{ __("country") }}</label
                            >
                            <select
                              v-model="form.billing_country_id"
                              @change="getBillingStates()"
                              class="form-select"
                              aria-label="country"
                            >
                              <option value="null" selected disabled>
                                {{ __("country") }}
                              </option>
                              <option
                                v-for="country in this.countries"
                                :key="country.id"
                                :value="country.id"
                              >
                                {{ country.name }}
                              </option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group mb-3">
                            <label for="state"
                              >{{ __("select") }} {{ __("state") }}</label
                            >
                            <select
                              v-model="form.billing_state_id"
                              @change="getBillingCities()"
                              class="form-select"
                              aria-label="state"
                            >
                              <option value="null" selected disabled>
                                {{ __("state") }}
                              </option>
                              <option
                                v-for="state in this.billing_states"
                                :key="state.id"
                                :value="state.id"
                              >
                                {{ state.name }}
                              </option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group mb-3">
                            <label for="city"
                              >{{ __("select") }} {{ __("city") }}</label
                            >
                            <select
                              v-model="form.billing_city_id"
                              class="form-select"
                              aria-label="city"
                            >
                              <option value="null" selected disabled>
                                {{ __("city") }}
                              </option>
                              <option
                                v-for="city in this.billing_cities"
                                :key="city.id"
                                :value="city.id"
                              >
                                {{ city.name }}
                              </option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group mb-3 position-relative">
                            <label for="zip_code">{{ __("zip code") }}</label>
                            <input
                              :disabled="disable_fields"
                              v-model="form.billing_zip_code"
                              class="w-100 form-control px-3"
                              placeholder="Please Enter"
                              type="text"
                            />
                            <div
                              class="spinner-border position-absolute"
                              ref="billing_zip_code"
                              role="status"
                              style="top: 35px; right: 10px; display: none"
                            >
                              <span class="visually-hidden">Loading...</span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group mb-3 position-relative">
                            <label for="address"
                              >{{ __("address line") }} 1</label
                            >
                            <textarea
                              v-model="form.billing_address_line_1"
                              class="w-100 form-control px-3"
                              placeholder="Please Enter"
                              type="text"
                            ></textarea>
                            <div
                              class="spinner-border position-absolute"
                              ref="billing_address_line_1"
                              role="status"
                              style="top: 35px; right: 10px; display: none"
                            >
                              <span class="visually-hidden">Loading...</span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group mb-3 position-relative">
                            <label for="address"
                              >{{ __("address line") }} 2</label
                            >
                            <textarea
                              :disabled="disable_fields"
                              v-model="form.billing_address_line_2"
                              class="w-100 form-control px-3"
                              placeholder="Please Enter"
                              type="text"
                            ></textarea>
                            <div
                              class="spinner-border position-absolute"
                              ref="billing_address_line_2"
                              role="status"
                              style="top: 35px; right: 10px; display: none"
                            >
                              <span class="visually-hidden">Loading...</span>
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="d-md-flex justify-content-between">
                            <button
                              type="button"
                              @click="onChangeCurrentTab(0)"
                              class="btn btn-primary"
                            >
                              Back
                            </button>

                            <button
                              type="button"
                              @click="onChangeCurrentTab(2)"
                              class="btn btn-primary"
                            >
                              Next
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div v-if="currentTabIndex === 2">
                    <div class="card bg-white shadow-sm p-4">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-check form-switch">
                            <input
                              class="form-check-input"
                              v-model="shipping_same_address"
                              @change="makeSameAddress('shipping')"
                              type="checkbox"
                              role="switch"
                              id="CoCreationSwitch"
                            />
                            <label
                              class="form-check-label"
                              for="CoCreationSwitch"
                              >{{ __("same as home address") }}?</label
                            >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group mb-3">
                            <label for="country"
                              >{{ __("select") }} {{ __("country") }}</label
                            >
                            <select
                              v-model="form.shipping_country_id"
                              @change="getShippingStates()"
                              class="form-select"
                              aria-label="country"
                            >
                              <option value="null" selected disabled>
                                {{ __("country") }}
                              </option>
                              <option
                                v-for="country in this.countries"
                                :key="country.id"
                                :value="country.id"
                              >
                                {{ country.name }}
                              </option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group mb-3">
                            <label for="state"
                              >{{ __("select") }} {{ __("state") }}</label
                            >
                            <select
                              v-model="form.shipping_state_id"
                              @change="getShippingCities()"
                              class="form-select"
                              aria-label="state"
                            >
                              <option value="null" selected disabled>
                                {{ __("state") }}
                              </option>
                              <option
                                v-for="state in this.shipping_states"
                                :key="state.id"
                                :value="state.id"
                              >
                                {{ state.name }}
                              </option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group mb-3">
                            <label for="city"
                              >{{ __("select") }} {{ __("city") }}</label
                            >
                            <select
                              v-model="form.shipping_city_id"
                              class="form-select"
                              aria-label="city"
                            >
                              <option value="null" selected disabled>
                                {{ __("city") }}
                              </option>
                              <option
                                v-for="city in this.shipping_cities"
                                :key="city.id"
                                :value="city.id"
                              >
                                {{ city.name }}
                              </option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group mb-3 position-relative">
                            <label for="zip_code">{{ __("zip code") }}</label>
                            <input
                              :disabled="disable_fields"
                              v-model="form.shipping_zip_code"
                              class="w-100 form-control px-3"
                              placeholder="Please Enter"
                              type="text"
                            />
                            <div
                              class="spinner-border position-absolute"
                              ref="shipping_zip_code"
                              role="status"
                              style="top: 35px; right: 10px; display: none"
                            >
                              <span class="visually-hidden">Loading...</span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group mb-3 position-relative">
                            <label for="address"
                              >{{ __("address line") }} 1</label
                            >
                            <textarea
                              :disabled="disable_fields"
                              v-model="form.shipping_address_line_1"
                              class="w-100 form-control px-3"
                              placeholder="Please Enter"
                              type="text"
                            ></textarea>
                            <div
                              class="spinner-border position-absolute"
                              ref="shipping_address_line_1"
                              role="status"
                              style="top: 35px; right: 10px; display: none"
                            >
                              <span class="visually-hidden">Loading...</span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group mb-3 position-relative">
                            <label for="address"
                              >{{ __("address line") }} 2</label
                            >
                            <textarea
                              :disabled="disable_fields"
                              v-model="form.shipping_address_line_2"
                              class="w-100 form-control px-3"
                              placeholder="Please Enter"
                              type="text"
                            ></textarea>
                            <div
                              class="spinner-border position-absolute"
                              ref="shipping_address_line_2"
                              role="status"
                              style="top: 35px; right: 10px; display: none"
                            >
                              <span class="visually-hidden">Loading...</span>
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="d-md-flex justify-content-between">
                            <button
                              type="button"
                              @click="onChangeCurrentTab(1)"
                              class="btn btn-primary"
                            >
                              Back
                            </button>
                            <button
                              type="button"
                              @click="onChangeCurrentTab(3)"
                              class="btn btn-primary"
                            >
                              Next
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div v-if="currentTabIndex === 3">
                    <div class="card bg-white shadow-sm p-4">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-check form-switch">
                            <input
                              :disabled="disable_fields"
                              class="form-check-input"
                              v-model="work_same_address"
                              @change="makeSameAddress('work')"
                              type="checkbox"
                              role="switch"
                              id="CoCreationSwitch"
                            />
                            <label
                              class="form-check-label"
                              for="CoCreationSwitch"
                              >{{ __("same as home address") }}?</label
                            >
                            <div
                              class="spinner-border position-absolute"
                              ref="work_same_address"
                              role="status"
                              style="top: 35px; right: 10px; display: none"
                            >
                              <span class="visually-hidden">Loading...</span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group mb-3">
                            <label for="country"
                              >{{ __("select") }} {{ __("country") }}</label
                            >
                            <select
                              v-model="form.work_country_id"
                              @change="getWorkStates()"
                              class="form-select"
                              aria-label="country"
                            >
                              <option value="null" selected disabled>
                                {{ __("country") }}
                              </option>
                              <option
                                v-for="country in this.countries"
                                :key="country.id"
                                :value="country.id"
                              >
                                {{ country.name }}
                              </option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group mb-3">
                            <label for="state"
                              >{{ __("select") }} {{ __("state") }}</label
                            >
                            <select
                              v-model="form.work_state_id"
                              @change="getWorkCities()"
                              class="form-select"
                              aria-label="state"
                            >
                              <option value="null" selected disabled>
                                {{ __("state") }}
                              </option>
                              <option
                                v-for="state in this.work_states"
                                :key="state.id"
                                :value="state.id"
                              >
                                {{ state.name }}
                              </option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group mb-3">
                            <label for="city"
                              >{{ __("select") }} {{ __("city") }}</label
                            >
                            <select
                              v-model="form.work_city_id"
                              class="form-select"
                              aria-label="city"
                            >
                              <option value="null" selected disabled>
                                {{ __("city") }}
                              </option>
                              <option
                                v-for="city in this.work_cities"
                                :key="city.id"
                                :value="city.id"
                              >
                                {{ city.name }}
                              </option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group mb-3 position-relative">
                            <label for="zip_code">{{ __("zip code") }}</label>
                            <input
                              :disabled="disable_fields"
                              v-model="form.work_zip_code"
                              class="w-100 form-control px-3"
                              placeholder="Please Enter"
                              type="text"
                            />
                            <div
                              class="spinner-border position-absolute"
                              ref="work_zip_code"
                              role="status"
                              style="top: 35px; right: 10px; display: none"
                            >
                              <span class="visually-hidden">Loading...</span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group mb-3 position-relative">
                            <label for="address"
                              >{{ __("address line") }} 1</label
                            >
                            <textarea
                              :disabled="disable_fields"
                              v-model="form.work_address_line_1"
                              class="w-100 form-control px-3"
                              placeholder="Please Enter"
                              type="text"
                            ></textarea>
                            <div
                              class="spinner-border position-absolute"
                              ref="work_address_line_1"
                              role="status"
                              style="top: 35px; right: 10px; display: none"
                            >
                              <span class="visually-hidden">Loading...</span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group mb-3 position-relative">
                            <label for="address"
                              >{{ __("address line") }} 2</label
                            >
                            <textarea
                              :disabled="disable_fields"
                              v-model="form.work_address_line_2"
                              class="w-100 form-control px-3"
                              placeholder="Please Enter"
                              type="text"
                            ></textarea>
                            <div
                              class="spinner-border position-absolute"
                              ref="work_address_line_2"
                              role="status"
                              style="top: 35px; right: 10px; display: none"
                            >
                              <span class="visually-hidden">Loading...</span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group mb-3">
                            <label for="category"
                              >{{ __("choose") }} {{ __n("tag") }}</label
                            >
                            <Multiselect
                              :placeholder="__('please select')"
                              v-model="form.tags"
                              valueProp="id"
                              label="name"
                              mode="tags"
                              :close-on-select="false"
                              :searchable="true"
                              :options="this.tags"
                            />
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group mb-3">
                            <label for="category"
                              >{{ __("choose") }} {{ __n("language") }}</label
                            >
                            <Multiselect
                              :placeholder="__('please select')"
                              v-model="form.languages"
                              valueProp="id"
                              label="name"
                              mode="tags"
                              :close-on-select="false"
                              :searchable="true"
                              :options="this.languages"
                            />
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="d-md-flex justify-content-end">
                            <button
                              type="button"
                              @click="onChangeCurrentTab(2)"
                              class="btn btn-primary"
                            >
                              Back
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Work Address -->
                  </div>
                </Wizard>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col-md-2">
                <button
                  type="submit"
                  class="submit btn btn-primary"
                  :disabled="form.processing"
                >
                  <SpinnerLoader v-if="form.processing" />
                  {{ __("save") }}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import ImageCropperModal from "@/Components//Shared/ImageCropperModal.vue";
import SpinnerLoader from "@/Components/Shared/SpinnerLoader.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import Multiselect from "@vueform/multiselect";
import VueGoogleAutocomplete from "vue-google-autocomplete";

export default defineComponent({
  components: {
    Head,
    ValidationErrors,
    Link,
    SpinnerLoader,
    ImageCropperModal,
    Multiselect,
    VueGoogleAutocomplete,
  },
  props: ["active", "law_firm"],
  async mounted() {
    await this.locatorButtonPressed();
    await this.$refs.address.update(this.$page.props.law_firm.address_line_1);
    this.form.latitude = parseFloat(this.$page.props.law_firm.latitude);
    this.form.longitude = parseFloat(this.$page.props.law_firm.longitude);
    if (!this.form.latitude && !this.form.longitude) {
      this.form.latitude = this.location_data.lat ?? -34.6161385;
      this.form.longitude = this.location_data.lng ?? -58.39748470000001;
    }
  },
  data() {
    return {
      currentTabIndex: 0,
      billing_same_address: false,
      shipping_same_address: false,
      work_same_address: false,
      form: this.$inertia.form({
        law_firm_categories: this.$page.props.law_firm.law_firm_category_ids,
        law_firm_name: this.$page.props.law_firm.law_firm_name,
        law_firm_website: this.$page.props.law_firm.law_firm_website,
        country_id: this.$page.props.law_firm.country_id,
        state_id: this.$page.props.law_firm.state_id,
        city_id: this.$page.props.law_firm.city_id,
        languages: this.$page.props.law_firm.language_ids,
        tags: this.$page.props.law_firm.tag_ids,
        law_firm_name: this.$page.props.law_firm.law_firm_name,
        law_firm_website: this.$page.props.law_firm.law_firm_website,
        first_name: this.$page.props.law_firm.first_name,
        last_name: this.$page.props.law_firm.last_name,
        description:
          this.$page.props.law_firm.description_translations.length == 0
            ? {}
            : this.$page.props.law_firm.description_translations,
        address_line_1: this.$page.props.law_firm.address_line_1,
        address_line_2: this.$page.props.law_firm.address_line_2,
        latitude: this.$page.props.law_firm.latitude,
        longitude: this.$page.props.law_firm.longitude,
        prefix: this.$page.props.law_firm.prefix,
        suffix: this.$page.props.law_firm.suffix,
        home_phone: this.$page.props.law_firm.home_phone,
        cell_phone: this.$page.props.law_firm.cell_phone,
        job_title: this.$page.props.law_firm.cell_phone,
        company: this.$page.props.law_firm.company,
        website: this.$page.props.law_firm.website,
        email: this.$page.props.law_firm.email,
        billing_country_id: this.$page.props.law_firm.billing_country_id,
        billing_state_id: this.$page.props.law_firm.billing_state_id,
        billing_city_id: this.$page.props.law_firm.billing_city_id,
        billing_address_line_1:
          this.$page.props.law_firm.billing_address_line_1,
        billing_address_line_2:
          this.$page.props.law_firm.billing_address_line_2,
        billing_zip_code: this.$page.props.law_firm.billing_zip_code,
        shipping_country_id: this.$page.props.law_firm.shipping_country_id,
        shipping_state_id: this.$page.props.law_firm.shipping_state_id,
        shipping_city_id: this.$page.props.law_firm.shipping_city_id,
        shipping_address_line_1:
          this.$page.props.law_firm.shipping_address_line_1,
        shipping_address_line_2:
          this.$page.props.law_firm.shipping_address_line_2,
        shipping_zip_code: this.$page.props.law_firm.shipping_zip_code,
        work_country_id: this.$page.props.law_firm.work_country_id,
        work_state_id: this.$page.props.law_firm.work_state_id,
        work_city_id: this.$page.props.law_firm.work_city_id,
        work_address_line_1: this.$page.props.law_firm.work_address_line_1,
        work_address_line_2: this.$page.props.law_firm.work_address_line_2,
        work_zip_code: this.$page.props.law_firm.work_zip_code,
        icon: null,
        image: null,
        cover_image: null,
        user_name: this.$page.props.law_firm.user_name,
        zip_code: this.$page.props.law_firm.zip_code,
      }),
      showImportModal: false,
      image_url: null,
      cover_image_url: null,
      croppedImageSrc: null,
      showCoverImportModal: false,
      croppedCoverImageSrc: null,
      countries: this.$page.props.countries,
      states: this.$page.props.states,
      cities: this.$page.props.cities,
      billing_states: this.$page.props.billing_states,
      billing_cities: this.$page.props.billing_cities,
      shipping_states: this.$page.props.shipping_states,
      shipping_cities: this.$page.props.shipping_cities,
      work_states: this.$page.props.work_states,
      work_cities: this.$page.props.work_cities,
      law_firm_categories: this.$page.props.law_firm_categories,
      languages: this.$page.props.languages,
      tags: this.$page.props.tags,
    };
  },

  methods: {
    showInfo(info) {
      this.form.latitude = info.latLng.lat();
      this.form.longitude = info.latLng.lng();
    },
    async getCurrentLocation() {
      this.form.latitude = this.location_data.lat ?? -34.6161385;
      this.form.longitude = this.location_data.lng ?? -58.39748470000001;
      if (this.form.latitude && this.form.longitude) {
        var user_address = await this.getStreetAddressFrom(
          this.form.latitude,
          this.form.longitude
        );
        this.$refs.address.update(user_address);
      }
    },
    makeSameAddress(type) {
      if (type == "billing" && this.billing_same_address) {
        this.form.billing_country_id = this.form.country_id;
        this.billing_states = this.states;
        this.form.billing_state_id = this.form.state_id;
        this.billing_cities = this.cities;
        this.form.billing_city_id = this.form.city_id;
        this.form.billing_address_line_1 = this.form.address_line_1;
        this.form.billing_address_line_2 = this.form.address_line_2;
        this.form.billing_zip_code = this.form.zip_code;
      }
      if (type == "shipping" && this.shipping_same_address) {
        this.form.shipping_country_id = this.form.country_id;
        this.shipping_states = this.states;
        this.form.shipping_state_id = this.form.state_id;
        this.shipping_cities = this.cities;
        this.form.shipping_city_id = this.form.city_id;
        this.form.shipping_address_line_1 = this.form.address_line_1;
        this.form.shipping_address_line_2 = this.form.address_line_2;
        this.form.shipping_zip_code = this.form.zip_code;
      }
      if (type == "work" && this.work_same_address) {
        this.form.work_country_id = this.form.country_id;
        this.work_states = this.states;
        this.form.work_state_id = this.form.state_id;
        this.work_cities = this.cities;
        this.form.work_city_id = this.form.city_id;
        this.form.work_address_line_1 = this.form.address_line_1;
        this.form.work_address_line_2 = this.form.address_line_2;
        this.form.work_zip_code = this.form.zip_code;
      }
    },
    updateLocation(address) {
      this.form.address_line_1 = address.newVal;
    },
    getAddressData: function (addressData, placeResultData, id) {
      this.form.latitude = addressData.latitude;
      this.form.longitude = addressData.longitude;
      this.form.address_line_1 = addressData.route;
    },
    onFileChange(e) {
      this.image_url = null;
      const file = e.target.files[0];
      this.image_url = URL.createObjectURL(file);
      this.croppedImageSrc = null;
      this.showImportModal = true;
    },
    cropImage(image) {
      this.croppedImageSrc = image;
      this.form.image = image;
      this.image_url = null;
      this.showImportModal = false;
    },
    onFileChangeCover(e) {
      this.cover_image_url = null;
      const file = e.target.files[0];
      this.cover_image_url = URL.createObjectURL(file);
      this.croppedCoverImageSrc = null;
      this.showCoverImportModal = true;
    },
    cropCoverImage(image) {
      this.croppedCoverImageSrc = image;
      this.form.cover_image = image;
      this.cover_image_url = null;
      this.showCoverImportModal = false;
    },
    getStates() {
      this.form.state_id = null;
      this.form.city_id = null;
      axios
        .get(
          this.route("account.getStates", {
            country_id: this.form.country_id,
          })
        )
        .then((res) => {
          this.states = res.data.data;
        });
    },
    getCities() {
      this.form.city_id = null;
      axios
        .get(
          this.route("account.getCities", {
            country_id: this.form.country_id,
            state_id: this.form.state_id,
          })
        )
        .then((res) => {
          this.cities = res.data.data;
        });
    },
    getBillingStates() {
      this.form.billing_state_id = null;
      this.form.billing_city_id = null;
      axios
        .get(
          this.route("account.getStates", {
            country_id: this.form.billing_country_id,
          })
        )
        .then((res) => {
          this.billing_states = res.data.data;
        });
    },
    getBillingCities() {
      this.form.billing_city_id = null;
      axios
        .get(
          this.route("account.getCities", {
            country_id: this.form.billing_country_id,
            state_id: this.form.billing_state_id,
          })
        )
        .then((res) => {
          this.billing_cities = res.data.data;
        });
    },
    getShippingStates() {
      this.form.shipping_state_id = null;
      this.form.shipping_city_id = null;
      axios
        .get(
          this.route("account.getStates", {
            country_id: this.form.shipping_country_id,
          })
        )
        .then((res) => {
          this.shipping_states = res.data.data;
        });
    },
    getShippingCities() {
      this.form.shipping_city_id = null;
      axios
        .get(
          this.route("account.getCities", {
            country_id: this.form.shipping_country_id,
            state_id: this.form.shipping_state_id,
          })
        )
        .then((res) => {
          this.shipping_cities = res.data.data;
        });
    },
    getWorkStates() {
      this.form.work_state_id = null;
      this.form.work_city_id = null;
      axios
        .get(
          this.route("account.getStates", {
            country_id: this.form.work_country_id,
          })
        )
        .then((res) => {
          this.work_states = res.data.data;
        });
    },
    getWorkCities() {
      this.form.work_city_id = null;
      axios
        .get(
          this.route("account.getCities", {
            country_id: this.form.work_country_id,
            state_id: this.form.work_state_id,
          })
        )
        .then((res) => {
          this.work_cities = res.data.data;
        });
    },
    autoUpdateProfile(elementRef) {
      this.disable_fields = true;
      this.$refs[elementRef].style.display = "block";
      this.autoUpdate(this.$refs[elementRef]);
    },
    autoUpdate(refElement) {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("law_firms.update_general_info"), {
          preserveScroll: true,
          onSuccess: () => {
            refElement.style.display = "none";
            this.disable_fields = false;
          },
          onError: () => {
            refElement.style.display = "none";
            this.disable_fields = false;
          },
        });
    },
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("law_firms.update_general_info"), {
          onSuccess: () => {
            this.goToNextTab();
          },
        });
    },
    goToNextTab() {
      this.$inertia.visit(route("account"), {
        data: { active_tab: "social-info" },
      });
    },
    onChangeCurrentTab(index) {
      this.currentTabIndex = index;
    },
    onTabBeforeChange() {
      if (this.currentTabIndex === 0) {
      }
    },
  },
});
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
