<template>

  <app-layout title="My Profile">
<template #header>
    <!-- <page-header >
    My Profile
    </page-header> -->
</template>
<template #default>
        <lawyer-account v-if="$page.props.auth.logged_in_as == 'lawyer'"></lawyer-account>
        <customer-account v-if="$page.props.auth.logged_in_as == 'customer'"></customer-account>
        <law-firm-account v-if="$page.props.auth.logged_in_as == 'law_firm'"></law-firm-account>
</template>

  </app-layout>

</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import LawyerAccount from "@/Components/Lawyers/LawyerAccount.vue";
import CustomerAccount from "@/Components/Customers/CustomerAccount.vue";
import LawFirmAccount from "@/Components/LawFirms/LawFirmAccount.vue";




export default defineComponent({
  components: {
    AppLayout,
    Navbar,
    PageHeader,
    LawyerAccount,
    CustomerAccount,
    LawFirmAccount
  },
});
</script>
