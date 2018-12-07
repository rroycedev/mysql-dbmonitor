<template>
  <div>
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
    <div>
      <div class="monitor-server-header-div">
        <div class="monitor-expand-collapse-header-div">&nbsp;</div>
        <div class="monitor-hostname-header-div">Hostname</div>
        <div class="monitor-port-name-header-div">Port Name</div>
        <div class="monitor-ipaddress-header-div">IP Address</div>
        <div style="clear: both;"></div>
      </div>
    </div>
    <div>
      <div v-for="server in status" v-bind:key="server.server_id">
        <div
          v-show="selectedEnvironments.includes(server.environment_id) && selectedClusters.includes(server.cluster_id) && selectedDatacenters.includes(server.datacenter_id)"
        >
          <div class="monitor-server-div">
            <div class="monitor-expand-collapse-div" v-on:click="expandCollapse($event)">
              <i class="fa fa-caret-down" aria-hidden="true"></i>
            </div>
            <div class="monitor-hostname-div">{{server.hostname}}</div>
            <div
              class="monitor-port-name-div"
            >{{(server.port_name == "" ? "&nbsp;" : server.port_name) }}</div>
            <div class="monitor-ipaddress-div">{{server.ipaddress}}</div>
            <div style="clear: both;"></div>
          </div>
        </div>

        <div
          v-if="server.slaves.length > 0 && selectedEnvironments.includes(server.environment_id) && selectedClusters.includes(server.cluster_id) && selectedDatacenters.includes(server.datacenter_id)"
        >
          <div class="monitor-server-slave-header-div">
            <div class="monitor-connection-name-header-div">Connection Name</div>
            <div class="monitor-master-binlog-filename-header-div">Master Binlog Filename</div>
            <div class="monitor-master-binlog-pos-header-div">Master Binlog Position</div>
            <div class="monitor-lag-time-header-div">Lag Time</div>
            <div class="monitor-last-checked-header-div">Last Checked</div>
            <div style="clear: both;"></div>
          </div>
        </div>
        <div v-for="slave in server.slaves" v-bind:key="slave.server_slave_status_id">
          <div
            v-show="selectedEnvironments.includes(server.environment_id) && selectedClusters.includes(server.cluster_id) && selectedDatacenters.includes(server.datacenter_id)"
          >
            <div class="monitor-server-slave-div">
              <div class="monitor-connection-name-div">{{ slave.connection_name }}</div>
              <div class="monitor-master-binlog-filename-div">{{ slave.master_binlog_filename }}</div>
              <div class="monitor-master-binlog-pos-div">{{ slave.master_binlog_position }}</div>
              <div class="monitor-lag-time-div">{{ slave.lag_time_secs }}</div>
              <div class="monitor-last-checked-div">{{ slave.check_datetime }}</div>
              <div style="clear: both;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

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
      selectedDatacenters: [],
      status: []
    };
  },
  methods: {
    filterClicked(filterType, event) {
      var id = event.target.id;
      var key = parseInt(id.substring(filterType.length + 8), 10);

      switch (filterType) {
        case "cluster":
          if (this.selectedClusters.includes(key)) {
            $("#" + id).removeClass("selected");
            var index = this.selectedClusters.indexOf(key);
            if (index > -1) {
              this.selectedClusters.splice(index, 1);
            }
          } else {
            $("#" + id).addClass("selected");
            this.selectedClusters.push(key);
          }
          this.$forceUpdate();
          break;
        case "environment":
          if (this.selectedEnvironments.includes(key)) {
            $("#" + id).removeClass("selected");
            var index = this.selectedEnvironments.indexOf(key);
            if (index > -1) {
              this.selectedEnvironments.splice(index, 1);
            }
          } else {
            $("#" + id).addClass("selected");
            this.selectedEnvironments.push(key);
          }
          this.$forceUpdate();
          break;
        case "datacenter":
          if (this.selectedDatacenters.includes(key)) {
            $("#" + id).removeClass("selected");
            var index = this.selectedDatacenters.indexOf(key);
            if (index > -1) {
              this.selectedDatacenters.splice(index, 1);
            }
          } else {
            $("#" + id).addClass("selected");
            this.selectedDatacenters.push(key);
          }
          this.$forceUpdate();
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

      $.ajax({
        url: "/api/serverstatus",
        cache: false,
        dataType: "json",
        success: function(response) {
          self.status = response.status;

          // setTimeout(self.statusPoller(), 10000);
        }
      });
    }
  },
  mounted() {
    this.startup();
  }
};
</script>
