<template>

    <app-layout title="Service Log">
        <template #default>
                <lawyer-services v-if="$page.props.auth.logged_in_as == 'lawyer'" :service_statuses="service_statuses"></lawyer-services>
                <law-firm-services v-if="$page.props.auth.logged_in_as == 'law_firm'" :service_statuses="service_statuses"></law-firm-services>
                <customer-services v-if="$page.props.auth.logged_in_as == 'customer'" :service_statuses="service_statuses"></customer-services>
        </template>
    </app-layout>
  </template>

  <script>
  import { defineComponent } from "vue";
  import AppLayout from "@/Layouts/AppLayout.vue";
  import PageHeader from "@/Components/PageHeader.vue";
  import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
  import LawyerServices from "@/Components/Lawyers/ServiceLogs/ServiceLogs.vue";
  import LawFirmServices from "@/Components/LawFirms/ServiceLogs/ServiceLogs.vue";
  import CustomerServices from "@/Components/Customers/ServiceLogs/ServiceLogs.vue";


  export default defineComponent({
    components: {
      AppLayout,
      Navbar,
      PageHeader,
      LawyerServices,
      LawFirmServices,
      CustomerServices,
    },
    props:['service_statuses'],
    created()
    {
    }
  });
  </script>
