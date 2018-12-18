<template>
  <div id="details-nav-bar" class="row justify-content-left details-nav-bar m-1 pl-3">
    <button
      v-bind:class="'btn btn-info' + (environmentId == 0 ? ' disabled' : '')"
      v-on:click="goTo('home')"
      style="font-size: 16px;"
    >Home</button>
    
    <span class="mt-auto mb-auto pl-1 pr-1" v-if="environmentId != 0">
      <i class="fa fa-arrow-right" aria-hidden="true"></i>
    </span>
    
    <button
      v-bind:class="'btn' + (datacenterId == 0 ? ' btn-danger disabled' : ' btn btn-info')"
      v-if="environmentId != '0'"
      v-on:click="goTo('environment')"
      style="font-size: 16px;"
    >{{environmentName}}</button>
    
    <span class="mt-auto mb-auto pl-1 pr-1" v-if="environmentId != '0' && datacenterId != '0'">
      <i class="fa fa-arrow-right" aria-hidden="true"></i>
    </span>
    
    <button
      v-bind:class="'btn' + (clusterId == 0 ? ' btn-danger disabled' : ' btn btn-info')"
      v-if="datacenterId != '0'"
      v-on:click="goTo('datacenter')"
      style="font-size: 16px;"
    >{{datacenterName}}</button>
    
    <span class="mt-auto mb-auto pl-1 pr-1" v-if="clusterId != '0'">
      <i class="fa fa-arrow-right" aria-hidden="true"></i>
    </span>
    
    <button
      v-bind:class="'btn' + (serverId == 0 ? ' btn-danger disabled' : ' btn btn-info')"
      v-if="clusterId != '0'"
      v-on:click="goTo('cluster')"
      style="font-size: 16px;"
    >{{clusterName}}</button>
    
    <span class="mt-auto mb-auto pl-1 pr-1" v-if="serverId != '0'">
      <i class="fa fa-arrow-right" aria-hidden="true"></i>
    </span>
    
    <button
      class="btn btn-danger disabled"
      v-if="serverId != '0'"
      v-on:click="goTo('cluster')"
      style="font-size: 16px;"
    >{{serverName}}</button>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      environmentId: "0",
      environmentName: "",
      datacenterId: "0",
      datacenterName: "",
      clusterId: "0",
      clusterName: "",
      serverId: "0",
      serverName: ""
    };
  },
  methods: {
    goTo(target) {
      switch (target) {
        case "environment":
          this.$parent.goToEnvironment(
            this.environmentId,
            this.environmentName
          );
          break;
        case "datacenter":
          this.$parent.goToDatacenter(this.datacenterId, this.datacenterName);
          break;
        case "cluster":
          this.$parent.goToCluster(this.clusterId, this.clusterName);
          break;
        case "home":
          this.$parent.goToHome();
          break;
      }
    }
  }
};
</script>
