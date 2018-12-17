<template>
<div class="container of-y-auto mt-5">

     <div class="row justify-content-center">
          <div v-for="o in JSON.parse(objects)" class="fl mr-2">
                    <div class="panel-header-light">
                         <h3>{{objectName}}
                              <br>
                              <span v-if="objectType == 'server'" class="color-blue">{{ o.hostname}} {{ o.port_name }}</span>
                              <span v-if="objectType != 'server'" class="color-blue">{{ o.name}}</span>
                         </h3>
                    </div>
                    <div v-if="objectType == 'server'" class="panel-body-light cursor-pointer" v-on:click="drillDown(o.server_id)"></div>
                    <div v-if="objectType == 'environment'" class="panel-body-light cursor-pointer" v-on:click="drillDown(o.environment_id)"></div>
                    <div v-if="objectType == 'datacenter'" class="panel-body-light cursor-pointer" v-on:click="drillDown(o.datacenter_id)"></div>
                    <div v-if="objectType == 'cluster'" class="panel-body-light cursor-pointer" v-on:click="drillDown(o.cluster_id)"></div>
          </div>     
    </div>
</div>
</template>


<script>
export default {
  props: {
       objectType: String,
       objects: String,
       objectName: String
  },
  methods: {
       drillDown(pkId) {
            var a = 1;
            var nb = this.$parent.$refs.navbar;

          switch (this.objectType) {
               case 'environment':
                    this.$parent.$refs.navbar.environmentId = pkId;
                    var objs = JSON.parse(this.objects);

                    for (var i = 0; i < objs.length; i++) {
                         if (objs[i].environment_id == pkId) {
                              this.$parent.$refs.navbar.environmentName = objs[i].name;
                         }
                    }
                    break;
          }
       }
  }
};
</script>
