<template>

    <app-layout title="Appointment Log Detail">
  <template #default>
          <lawyer-appointment-detail v-if="$page.props.auth.logged_in_as == 'lawyer'" :appointment="appointment" :gateway="gateway"></lawyer-appointment-detail>
          <law-firm-appointment-detail v-if="$page.props.auth.logged_in_as == 'law_firm'" :appointment="appointment" :gateway="gateway"></law-firm-appointment-detail>
          <customer-appointment-detail v-if="$page.props.auth.logged_in_as == 'customer'" :appointment="appointment" :gateway="gateway"></customer-appointment-detail>
  </template>

    </app-layout>

  </template>

  <script>
  import { defineComponent } from "vue";
  import AppLayout from "@/Layouts/AppLayout.vue";
  import PageHeader from "@/Components/PageHeader.vue";
  import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
  import LawyerAppointmentDetail from "@/Components/Lawyers/AppointmentLogs/AppointmentLogDetail.vue";
  import LawFirmAppointmentDetail from "@/Components/LawFirms/AppointmentLogs/AppointmentLogDetail.vue";
  import CustomerAppointmentDetail from "@/Components/Customers/CustomerAppointmentDetail.vue";




  export default defineComponent({
    components: {
      AppLayout,
      Navbar,
      PageHeader,
      LawyerAppointmentDetail,
      CustomerAppointmentDetail,
      LawFirmAppointmentDetail,

    },
    props:['appointment','gateway'],
    created()
    {
    }
  });
  </script>
