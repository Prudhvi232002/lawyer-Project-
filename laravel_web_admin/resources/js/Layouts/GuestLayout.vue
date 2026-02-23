<template>
  <div>
    <slot></slot>
  </div>
</template>

<script>

export default {

components: {
},

data() {
  return {
  };
},
watch: {
    "$page.props.flash.alert": {
      handler() {
        this.showAlert()
      },
      deep: true,
    }
},
mounted(){
    this.showAlert()
},
methods: {
  logout() {
    this.$inertia.post(route("logout"));
  },
  showAlert(){
    if (this.$page.props.flash.alert) {
            if(this.$page.props.flash.alert.type == 'success'){
                this.$toast.success(this.$page.props.flash.alert.message)
            }
            else if(this.$page.props.flash.alert.type == 'error'){
                this.$toast.error(this.$page.props.flash.alert.message)
            }
            else if(this.$page.props.flash.alert.type == 'warning'){
                this.$toast.warning(this.$page.props.flash.alert.message)
            }
            else if(this.$page.props.flash.alert.type == 'info'){
                this.$toast.info(this.$page.props.flash.alert.message)
            }else{
                this.$toast.show(this.$page.props.flash.alert.message)
            }
        }
  }
},

computed: {
}
}
</script>
