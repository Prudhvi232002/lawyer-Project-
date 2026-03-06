export default {
    methods: {

       hasRole(role){
         const authenticated = this.$page.props.auth ?? null;
         if(authenticated){
             const user_roles = authenticated.roles;
             if(user_roles.length > 0){
                 var is_granted = user_roles.includes(role);
                 return is_granted
               }else{
                 return false;
               }
         }else{
             return false;
         }
       },
       hasModule(module,type = 'lawyer',modules = null){
         let user_modules = []
         if(modules != null){
             user_modules = Object.values(modules)
         }
         else if(type == 'lawyer'){
             user_modules = Object.values(this.$page.props.auth.lawyer_modules)
         }
         else if(type == 'law_firm'){
             user_modules = Object.values(this.$page.props.auth.law_firm_modules)
         }
         if(user_modules.length > 0){
           var is_granted = user_modules.includes(module);
           return is_granted
         }else{
           return false;
         }
       },
       checkPermisison(permisison){
         const user_permisions = Object.values(this.$page.props.auth.permissions)
       //  const user_permisions = this.$page.props.auth.permissions;
         if(user_permisions.length > 0){
           var is_granted = user_permisions.includes(permisison);
           return is_granted
         }else{
           return false;
         }
       }

     },
 }
