<template>

    <app-layout title="Service Log Detail">
  <template #default>
          <lawyer-service-detail v-if="$page.props.auth.logged_in_as == 'lawyer'" :service="service"></lawyer-service-detail>
          <law-firm-service-detail v-if="$page.props.auth.logged_in_as == 'law_firm'" :service="service"></law-firm-service-detail>
          <customer-service-detail v-if="$page.props.auth.logged_in_as == 'customer'" :service="service" ></customer-service-detail>
  </template>

    </app-layout>

  </template>

  <script>
  import { defineComponent } from "vue";
  import AppLayout from "@/Layouts/AppLayout.vue";
  import PageHeader from "@/Components/PageHeader.vue";
  import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
  import LawyerServiceDetail from "@/Components/Lawyers/ServiceLogs/ServiceLogDetail.vue";
  import LawFirmServiceDetail from "@/Components/LawFirms/ServiceLogs/ServiceLogDetail.vue";
  import CustomerServiceDetail from "@/Components/Customers/ServiceLogs/ServiceLogDetail.vue";




  export default defineComponent({
    components: {
      AppLayout,
      Navbar,
      PageHeader,
      LawyerServiceDetail,
      CustomerServiceDetail,
      LawFirmServiceDetail,

    },
    props:['service'],
    created()
    {
    }
  });
  </script>
