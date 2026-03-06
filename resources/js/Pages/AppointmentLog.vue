<template>

    <app-layout title="Appointment Log">
  <template #default>
          <lawyer-appointment v-if="$page.props.auth.logged_in_as == 'lawyer'" :appointment_status="appointment_status"></lawyer-appointment>
          <law-firm-appointment v-if="$page.props.auth.logged_in_as == 'law_firm'" :appointment_status="appointment_status"></law-firm-appointment>
          <customer-appointment v-if="$page.props.auth.logged_in_as == 'customer'" :appointment_status="appointment_status"></customer-appointment>
  </template>

    </app-layout>

  </template>

  <script>
  import { defineComponent } from "vue";
  import AppLayout from "@/Layouts/AppLayout.vue";
  import PageHeader from "@/Components/PageHeader.vue";
  import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
  import LawyerAppointment from "@/Components/Lawyers/AppointmentLogs/AppointmentLogs.vue";
  import LawFirmAppointment from "@/Components/LawFirms/AppointmentLogs/AppointmentLogs.vue";
  import CustomerAppointment from "@/Components/Customers/CustomerAppointment.vue";




  export default defineComponent({
    components: {
      AppLayout,
      Navbar,
      PageHeader,
      LawyerAppointment,
      LawFirmAppointment,
      CustomerAppointment,
    },
    props:['appointment_status'],
    created()
    {
    }
  });
  </script>
