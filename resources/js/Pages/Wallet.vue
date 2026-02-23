<template>
    <app-layout title="Wallet">
        <template #default>
            <div class="section p-0 profile">
                <div class="row mx-0 border-bottom border-dark py-5">
                    <div class="col-12 text-center py-3">
                        <p class="fs-2 mb-0">
                            {{ __("hello") }} {{ $page.props.auth.user.name }} |
                            <span class="fw-bold"> {{ __("Payment Wallet") }}</span>
                        </p>
                        <p> {{ __("discover The Best Lawyers Near You") }} </p>
                    </div>
                </div>
                <div class="container">
                    <div class="row py-md-5">
                        <div class="col-12 mt-3 mb-5">
                            <div class="card rounded-lg border-0 shadow bg-primary p-4 px-md-5">
                                <div class="d-md-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center mb-3 mb-md-0">
                                        <span class="fs-2 me-3 fw-bold"> {{ getDefaultCurrencySymbol() }}{{
                                            current_balance }}</span> <span class="fw-bold"> {{ __("Available Amount")
                                            }}</span>
                                    </div>
                                    <div class="text-end text-md-start">
                                        <button class="btn btn-dark me-2" data-bs-toggle="modal"
                                            data-bs-target="#withdrawAmountModal" :disabled="current_balance == 0"
                                            v-if="$page.props.auth.logged_in_as == 'lawyer' || $page.props.auth.logged_in_as == 'law_firm'">
                                            {{ __("Withdraw Amount") }}
                                        </button>
                                        <button class="btn btn-dark" v-if="$page.props.auth.logged_in_as == 'customer'"
                                            @click="renderCarousal" data-bs-toggle="modal"
                                            data-bs-target="#walletAddModal">
                                            {{ __("Add to wallet") }}
                                        </button>
                                    </div>
                                    <!-- Add To Wallet Modal -->
                                    <div class="modal fade" id="walletAddModal" tabindex="-1"
                                        aria-labelledby="walletAddModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="walletAddModalLabel">{{ __("Select Payment Method") }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group mb-4">
                                                            <input type="text" v-model="form.amount"
                                                                class="form-control" v-on:keypress="inputNumbersOnly()"
                                                                placeholder="Enter Amount">
                                                        </div>
                                                        <!-- <div v-for="gateway in gateways" :key="gateway.code" class="col-md-4 mb-2">
                                                            <button class="btn btn-primary" @click="this.form.gateway = gateway.code">{{ gateway.name }}</button>
                                                        </div> -->
                                                        <div class="px-4">
                                                            <Carousel :key="key" :settings="settings"
                                                                :breakpoints="breakpoints">
                                                                <Slide v-for="(gateway, index) in gateways" :key="index">
                                                                    <div :class="{ 'border border-5 border-warning': form.gateway == gateway.code }"
                                                                        @click="this.form.gateway = gateway.code">
                                                                        <img class="" :src="gateway.image"
                                                                            :alt="gateway.name">
                                                                        <h5 class="">{{ gateway.name }}</h5>
                                                                    </div>
                                                                </Slide>
                                                                <template #addons>
                                                                    <Navigation />
                                                                </template>
                                                            </Carousel>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal" id="close">{{ __("close") }}</button>
                                                    <button type="button" class="btn btn-primary"
                                                        @click="AddAmountToWallet">{{ __("submit") }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Withdraw from Wallet Modal -->
                                    <div class="modal fade" id="withdrawAmountModal" tabindex="-1"
                                        aria-labelledby="withdrawAmountModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="withdrawAmountModalLabel">{{
                                                        __("Withdraw Amount") }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group mb-4">
                                                        <label for="">{{ __("Amount") }}:</label>
                                                        <input type="text" v-model="withdraw.amount"
                                                            class="form-control" v-on:keypress="inputNumbersOnly()"
                                                            placeholder="Enter Amount">
                                                        <span class="text-danger" v-if="withdraw.errors.amount">
                                                            {{ withdraw.errors.amount }}
                                                        </span>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label for="">{{ __("Account Holder Name") }}:</label>
                                                        <input type="text" v-model="withdraw.account_holder"
                                                            class="form-control"
                                                            placeholder="Enter Account Holder Name">
                                                        <span class="text-danger" v-if="withdraw.errors.account_holder">
                                                            {{ withdraw.errors.account_holder }}
                                                        </span>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label for="">{{ __("Account Number") }}:</label>
                                                        <input type="text" v-model="withdraw.account_number"
                                                            class="form-control" placeholder="Enter Account Number">
                                                        <span class="text-danger" v-if="withdraw.errors.account_number">
                                                            {{ withdraw.errors.account_number }}
                                                        </span>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label for="">{{ __("Bank Name") }}:</label>
                                                        <input type="text" v-model="withdraw.bank" class="form-control"
                                                            placeholder="Enter Bank Name">
                                                        <span class="text-danger" v-if="withdraw.errors.bank">
                                                            {{ withdraw.errors.bank }}
                                                        </span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">{{ __("Additional Note") }}:</label>
                                                        <textarea class="form-control"
                                                            v-model="withdraw.additional_note" cols="30" rows="10"
                                                            placeholder="Enter Additional Notes"></textarea>
                                                        <span class="text-danger"
                                                            v-if="withdraw.errors.additional_note">
                                                            {{ withdraw.errors.additional_note }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal"
                                                        id="withdraw_close">{{ __("close") }}</button>
                                                    <button type="button" class="btn btn-primary"
                                                        @click="withdrawAmount">{{ __("submit") }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">



                            <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-transactions-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-transactions" type="button" role="tab"
                                        aria-controls="pills-transactions" aria-selected="true">Transactions</button>
                                </li>
                                <li v-if="$page.props.auth.logged_in_as == 'lawyer' || $page.props.auth.logged_in_as == 'law_firm'"
                                    class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-withdraw-requests-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-withdraw-requests" type="button" role="tab"
                                        aria-controls="pills-withdraw-requests" aria-selected="false">Withdraw
                                        Requests</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-pending-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-pending" type="button" role="tab"
                                        aria-controls="pills-pending" aria-selected="false">Pending
                                        Transactions</button>
                                </li>


                            </ul>
                            <div class="tab-content pb-5" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-transactions" role="tabpanel"
                                    aria-labelledby="pills-transactions-tab" tabindex="0">
                                    <div class="wallet-table">
                                        <h4>{{ __("Transactions") }}:</h4>
                                        <div class="table-responsive">
                                            <table class="table text-center ">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th>SR. #</th>
                                                        <th>{{ __("Amount") }}</th>
                                                        <th>{{ __("Type") }}</th>
                                                        <th>{{ __("Time") }}</th>
                                                        <th>{{ __("Info") }}</th>
                                                        <th>{{ __("Date") }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(transaction, index) in transactions.data" :key="index">
                                                        <td>{{ index + 1 }}</td>
                                                        <td>{{ getDefaultCurrencySymbol() }}{{ transaction.amount }}</td>
                                                        <td>{{ transaction.type }}</td>
                                                        <td>{{ getFormattedTime(transaction.created_at) }}</td>
                                                        <td>{{ getTransactionDetails(transaction.meta) }}</td>
                                                        <td>{{ getFormattedDateOnly(transaction.created_at) }}</td>
                                                    </tr>
                                                    <tr v-if="transactions.length == 0">
                                                        <td colspan="5">{{ __("No data found") }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <TablePagination @onPageChange="onPageChange" :meta="transactions">
                                            </TablePagination>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-pending" role="tabpanel"
                                                    aria-labelledby="pills-pending-tab">
                                                    <table class="table caption-top" v-if="fund_bank_transfers.length">
                                                        <tbody>
                                                            <tr v-if="
                                                                Object.keys(fund_bank_transfers).length < 0
                                                            ">
                                                                <td colspan="5" class="text-center text-muted fs-2 my-4 fw-bold">
                                                                    {{ __("No pending transactions") }}
                                                                </td>
                                                            </tr>
                                                            <tr v-for="(
                                  transaction, index
                                ) in fund_bank_transfers" :key="index">
                                                                <th class="tb-color" scope="row">
                                                                    <div class="d-flex align-items-center gap-3">
                                                                        {{ __("pending Deposit") }}
                                                                    </div>
                                                                </th>
                                                                <td class="tb-color fs-5">
                                                                    {{
                                                                        getFormattedDateOnly(transaction.created_at)
                                                                    }}
                                                                </td>
                                                                <td class="tb-color fs-5">
                                                                    {{ getTransactionDetails(transaction.meta) }}
                                                                </td>
                                                                <td class="tb-color fs-5">
                                                                    {{ getFormattedTime(transaction.created_at) }}
                                                                </td>
                                                                <td>
                                                                    <span style="color: #ff0000">
                                                                        {{ getDefaultCurrencySymbol()
                                                                        }}{{ transaction.fund.amount }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                        class="btn bg-transparent border-0"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#viewpayment"
                                                                        @click="setSelectedTransaction(transaction)">
                                                                        <i class="bi bi-eye fs-3"></i>
                                                                    </button>
                                                                    <Modal maxWidth="lg" id="viewpayment"
                                                                        aria-labelledby="walletAddModalLabel">
                                                                        <div class="modal-content add-wallet">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="walletAddModalLabel">
                                                                                    {{ __("Pending Deposit") }}
                                                                                </h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <table class="table">
                                                                                        <tbody v-if="selectedTransaction">
                                                                                            <tr>
                                                                                                <th>{{ __("Date") }}
                                                                                                </th>
                                                                                                <td>{{
                                                                                                    getFormattedDateOnly(selectedTransaction.created_at)
                                                                                                }}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>{{ __("Time") }}
                                                                                                </th>
                                                                                                <td>{{
                                                                                                    getFormattedTime(selectedTransaction.created_at)
                                                                                                }}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>{{ __("Amount") }}
                                                                                                </th>
                                                                                                <td>
                                                                                                    {{
                                                                                                        getDefaultCurrencySymbol()
                                                                                                    }}{{
                                                                                                        selectedTransaction.fund?.amount
                                                                                                    }}
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>{{ __("Image") }}
                                                                                                </th>
                                                                                                <td>
                                                                                                    <img height="350"
                                                                                                        width="350"
                                                                                                        :src="selectedTransaction.attachment"
                                                                                                        alt="Attachment" />
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>

                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal" id="close">
                                                                                    {{ __("Close") }}
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </Modal>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div v-else class="text-center text-muted fs-2 fw-bold my-4">
                                                        <hr>
            {{ __("No Pending transactions available") }}
        </div>
                                                </div>
                                <div class="tab-pane fade" id="pills-withdraw-requests" role="tabpanel"
                                    aria-labelledby="pills-withdraw-requests-tab" tabindex="0">
                                    <div class="wallet-table">
                                        <h4>{{ __("Withdraw Requests") }}:</h4>
                                        <div class="table-responsive">
                                            <table class="table text-center ">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th>SR. #</th>
                                                        <th>{{ __("Amount") }}</th>
                                                        <th>{{ __("Account Number") }}</th>
                                                        <th>{{ __("Holder Name") }}</th>
                                                        <th>{{ __("Bank Name") }}</th>
                                                        <th>{{ __("Status") }}</th>
                                                        <th>{{ __("Time") }}</th>
                                                        <th>{{ __("Date") }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(withdrawal, index) in withdrawals.data" :key="index">
                                                        <td>{{ index + 1 }}</td>
                                                        <td>{{ getDefaultCurrencySymbol() }} {{ withdrawal.amount }}</td>
                                                        <td>{{ withdrawal.account_number }}</td>
                                                        <td>{{ withdrawal.account_holder }}</td>
                                                        <td>{{ withdrawal.bank }}</td>
                                                        <td>{{ withdrawal.status.toUpperCase() }} <span
                                                                v-if="withdrawal.rejected_reason">({{
                                                                withdrawal.rejected_reason }})</span></td>
                                                        <td>{{ getFormattedTime(withdrawal.created_at) }}</td>
                                                        <td>{{ getFormattedDateOnly(withdrawal.created_at) }}</td>
                                                    </tr>
                                                    <tr v-if="withdrawals.length == 0">
                                                        <td colspan="8">{{ __("No data found") }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <TablePagination @onPageChange="onPageChange" :meta="withdrawals">
                                            </TablePagination>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </template>
    </app-layout>
</template>
<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import TablePagination from "@/Components/Shared/DataTable/TablePagination.vue";
import RoutePaginationMixin from "@/Mixins/RoutePaginationMixin.vue";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
import Modal from "@/Components/Modal.vue";
export default defineComponent({
    components: {
        Head,
        Link,
        AppLayout,
        TablePagination,
        Carousel,
        Slide,
        Modal,
        Pagination,
        Navigation
    },
    props: [
        "current_balance",
        "transactions",
        "withdrawals",
        "gateways",
        "fund_bank_transfers",
    ],
    mixins: [RoutePaginationMixin],
    data() {
        return {
            selectedTransaction:{},
            form: this.$inertia.form({
                amount: null,
                gateway: null
            }),
            withdraw: this.$inertia.form({
                amount: null,
                account_holder: '',
                account_number: '',
                bank: '',
                additional_note: ''
            }),
            currentTabIndex: 0,
            active_tab: 'transaction_tab',
            settings: {
                itemsToShow: 1,
                snapAlign: "start",
                autoplay: false,
            },
            // breakpoints are mobile firstTop Featured Lawyers
            // any settings not specified will fallback to the carousel settings
            breakpoints: {
                // 700px and up
                700: {
                    itemsToShow: 2,
                    snapAlign: "start",
                },
                // 1024 and up
                1024: {
                    itemsToShow: 2,
                    snapAlign: "start",
                },
                1240: {
                    itemsToShow: 4,
                    snapAlign: "start",
                }
            },
            key: 1

        }
    },
    created() {
        if (!parseInt(this.$page.props.settings.enable_wallet_system)) {
            this.$toast.error("Access Denied");
            this.$inertia.visit(route('home'))
        }
    },
    methods: {
        AddAmountToWallet() {
            if (!this.form.amount || this.form.amount <= 0) {
                this.$toast.error("Please enter amount greater than 0");
                return;
            }
            if (!this.form.gateway) {
                this.$toast.error("Please select a gateway");
                return;
            }
            this.form.post(this.route("wallet.addAmount"), {
                onSuccess: (resp) => {
                    document.getElementById('close').click()
                    window.location.replace(this.route('user.addFund.confirm', { transaction: resp.props.response_data.fund.transaction }))
                }
            });
        },
        setSelectedTransaction(transaction) {
            this.selectedTransaction = transaction;
        },
        withdrawAmount() {
            if (!this.withdraw.amount || this.withdraw.amount <= 0) {
                this.$toast.error("Please enter amount greater than 0");
                return;
            }
            this.withdraw.post(this.route("wallet.withdraw"), {
                onSuccess: () => {
                    document.getElementById('withdraw_close').click()
                }
            });
        },
        onChangeCurrentTab(index) {
            this.currentTabIndex = index;
        },
        getPaginatedData() {
            this.$inertia.replace(this.route("wallet"), { data: this.filter });
        },
        changeTab() {
            this.$inertia.replace(this.route("wallet"));
        },
        getTransactionDetails(jsonString) {
            if (jsonString) {
                const jsonObject = jsonString;
                return jsonObject.details;
            }
            else {
                return null;
            }

        },
        renderCarousal() {
            var myModalEl = document.getElementById('walletAddModal')
            let self = this;
            myModalEl.addEventListener('shown.bs.modal', function (event) {
                self.key++
            })
        }
    },
    mounted() {
        this.key++
    }
});
</script>
<style>
table td {
    vertical-align: middle;
}

table th {
    vertical-align: middle;
}
</style>
