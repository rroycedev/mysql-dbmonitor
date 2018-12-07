<template>
  <div>
    <div class="row justify-content-center">
      <div class="filterbar-div">
        <div
          v-bind:id="'cluster-filter-' + cluster.cluster_id"
          class="filter-div"
          v-for="cluster in clusters"
          v-bind:key="cluster.cluster_id"
          v-on:click="filterClicked('cluster', $event)"
        >{{ cluster.name }}</div>
        <div style="clear: both;"></div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="filterbar-div">
        <div
          v-bind:id="'environment-filter-' + environment.environment_id"
          class="filter-div"
          v-for="environment in environments"
          v-bind:key="environment.environment_id"
          v-on:click="filterClicked('environment', $event)"
        >{{ environment.name }}</div>
        <div style="clear: both;"></div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="filterbar-div">
        <div
          v-bind:id="'datacenter-filter-' + datacenter.datacenter_id"
          class="filter-div"
          v-for="datacenter in datacenters"
          v-bind:key="datacenter.datacenter_id"
          v-on:click="filterClicked('datacenter', $event)"
        >{{ datacenter.name }}</div>
        <div style="clear: both;"></div>
      </div>
    </div>
  </div>
</template>

<!-- style="" class="fl" v-for="$env in $environments" v-bind:key="$env->id" -->

<script>
var monitoringItems = [];

function statusPoller(c) {}

export default {
  data: function() {
    return {
      clusters: [],
      environments: [],
      datacenters: [],
      selectedClusters: [],
      selectedEnvironments: [],
      selectedDatacenters: []
    };
  },
  methods: {
    filterClicked(filterType, event) {
      var id = event.target.id;

      switch (filterType) {
        case "cluster":
          if (this.selectedClusters.includes(id)) {
            $("#" + id).removeClass("selected");
            var index = this.selectedClusters.indexOf(id);
            if (index > -1) {
              this.selectedClusters.splice(index, 1);
            }
          } else {
            $("#" + id).addClass("selected");
            this.selectedClusters.push(id);
          }
          break;
        case "environment":
          if (this.selectedEnvironments.includes(id)) {
            $("#" + id).removeClass("selected");
            var index = this.selectedEnvironments.indexOf(id);
            if (index > -1) {
              this.selectedEnvironments.splice(index, 1);
            }
          } else {
            $("#" + id).addClass("selected");
            this.selectedEnvironments.push(id);
          }
          break;
        case "datacenter":
          if (this.selectedDatacenters.includes(id)) {
            $("#" + id).removeClass("selected");
            var index = this.selectedDatacenters.indexOf(id);
            if (index > -1) {
              this.selectedDatacenters.splice(index, 1);
            }
          } else {
            $("#" + id).addClass("selected");
            this.selectedDatacenters.push(id);
          }
          break;
      }
    },
    startup() {
      var self = this;

      $.ajax({
        url: "/api/monitoringfilters",
        cache: false,
        dataType: "json",
        success: function(response) {
          self.clusters = response.clusters;
          self.environments = response.environments;
          self.datacenters = response.datacenters;

          self.statusPoller();
        }
      });
    },
    statusPoller() {
      var self = this;
    }
  },
  mounted() {
    console.log("Component mounted.");

    this.startup();
  }
};
</script>
