<template>
  <div id="details-nav-bar" class="row justify-content-center details-nav-bar m-1">
    <a v-if="environmentId != 0" href="/home" style="font-size: 16px;">Home</a>
    
    <span v-if="environmentId == 0">&nbsp;</span>
    
    <span v-if="environmentId != 0">-></span>

    <a
      v-if="environmentId != '0' && datacenterId != '0'"
      v-bind:href="'/envdetail/' + environmentId"
      style="font-size: 16px;"
    >{{environmentName}}</a>

    <div v-if="environmentId != '0' && datacenterId == '0'">{{environmentName}}</div>
    
    <span v-if="environmentId != '0' && datacenterId != '0'">-></span>

    <a
      v-if="datacenterId != '0' && clusterId != '0'"
      v-bind:href="'/dcdetail/' + environmentId + '/' + datacenterId "
      style="font-size: 16px;"
    >{{datacenterName}}</a>

    <div v-if="datacenterId != '0' && clusterId == '0'">{{datacenterName}}</div>

    <span v-if="clusterId != '0'">-></span>

    {{clusterName}}  
  </div>
</template>

<script>
export default {
 data: function() {
    return {
      environmentId: '0',
    environmentName: '',
    datacenterId: '0',
    datacenterName: '',
    clusterId: '',
    clusterName: ''
    };
  }
};
</script>
