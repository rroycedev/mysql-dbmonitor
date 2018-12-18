<template>
     <div>
          <detailsnav ref="navbar"></detailsnav>
          <detailscontent ref="detailscontent"></detailscontent>
     </div>
</template>


<script>
export default {
     props: {
          objectType: String
     },
     data: function() {
          return {
               objectName: ''
          }
     },
     mounted() {
          var self = this;

          //  This is mounted
          switch (self.objectType) {
               case 'home':

                    $.ajax({
                         url: "/api/getenvironments",
                         cache: false,
                         dataType: "json",
                         success: function(response) {
                              self.$refs.detailscontent.objectType = 'environment';
                              self.$refs.detailscontent.objectName = 'Environment';
                              self.$refs.detailscontent.objects = response.environments;
                         }
                    });
                    break;

          }
     },
     methods: {
          goToHome() {
               this.$refs.detailscontent.goToHome();
          },
          goToEnvironment(envId, envName) {
               this.$refs.detailscontent.goToEnvironment(envId, envName);
          },
          goToDatacenter(dcId, dcName) {
               this.$refs.detailscontent.goToDatacenter(dcId, dcName);
          },
          goToCluster(clustId, clustName) {
               this.$refs.detailscontent.goToCluster(clustId, clustName);
          },
          goToServer(servId, servName) {
               this.$refs.detailscontent.goToServer(servId, servName);
          }
     }

};
</script>
