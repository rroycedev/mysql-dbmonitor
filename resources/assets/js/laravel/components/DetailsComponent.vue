<template>
     <div>
          <detailsnav
               ref="navbar"
               v-bind:environment-id="environmentId"
               v-bind:environment-name="environmentName"
               v-bind:datacenter-id="datacenterId"
               v-bind:data-center-name="datacenterName"
               v-bind:cluster-id="clusterId"
               v-bind:cluster-name="clusterName"
          ></detailsnav>
          <detailscontent
               ref="detailscontent"
               v-bind:objects="objects"
               v-bind:object-type="objectType"
               v-bind:object-name="objectName"
          ></detailscontent>
     </div>
</template>


<script>
export default {
  props: {
    objectType: String,
    objects: String,
    objectName: String,
    environmentId: String,
    environmentName: String,
    datacenterId: String,
    datacenterName: String,
    clusterId: String,
    clusterName: String
  }

};
</script>
