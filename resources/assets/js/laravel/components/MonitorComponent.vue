<template>
  <div>
    <div class="filter-bar-div">
      <div class="row justify-content-center">
        <div>
          <div class="fl">
            <div class="button-group filter-bar-button-div">
              <button
                type="button"
                class="btn btn-default btn-lg dropdown-toggle"
                data-toggle="dropdown"
              >
                Clusters
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li
                  class="filter-select-li"
                  v-for="cluster in clusters"
                  v-bind:key="cluster.cluster_id"
                >
                  <input
                    type="checkbox"
                    v-on:click="filterOptionClicked('cluster', cluster.cluster_id, $event)"
                  >
                  &nbsp;{{cluster.name}}
                </li>
              </ul>
            </div>
          </div>
          <div class="fl ml-5">
            <div class="button-group filter-bar-button-div">
              <button
                type="button"
                class="btn btn-default btn-lg dropdown-toggle"
                data-toggle="dropdown"
              >
                Environments
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li
                  class="filter-select-li"
                  v-for="environment in environments"
                  v-bind:key="environment.environment_id"
                >
                  <input
                    type="checkbox"
                    v-on:click="filterOptionClicked('environment', environment.environment_id, $event)"
                  >
                  &nbsp;{{environment.name}}
                </li>
              </ul>
            </div>
          </div>
          <div class="fl ml-5">
            <div class="button-group filter-bar-button-div">
              <button
                type="button"
                class="btn btn-default btn-lg dropdown-toggle"
                data-toggle="dropdown"
              >
                Datacenters
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li
                  class="filter-select-li"
                  v-for="datacenter in datacenters"
                  v-bind:key="datacenter.datacenter_id"
                >
                  <input
                    type="checkbox"
                    v-on:click="filterOptionClicked('datacenter', datacenter.datacenter_id, $event)"
                  >
                  &nbsp;{{datacenter.name}}
                </li>
              </ul>
            </div>
          </div>
          <div style="clear: both;"></div>
        </div>
      </div>
      <div class="row justify-content-center border-outset-top-gray">
        <input class="filter-checkbox" type="checkbox" v-on:click="hideShowHealthy()">
        <span>&nbsp;Show Healthy</span>
      </div>
    </div>
    <div>
      <div class="monitor-main-div">
        <div class="monitor-expand-collapse-div monitor-th">&nbsp;</div>
        <div class="monitor-hostname-div monitor-th">Hostname</div>
        <div class="monitor-port-name-div monitor-th">Port Name</div>
        <div class="monitor-ipaddress-div monitor-th">IP Address</div>
        <div class="monitor-connections-div monitor-th">Connections</div>
        <div class="monitor-disk-usage-div monitor-th">Disk Usage</div>
        <div class="monitor-cpu-load-div monitor-th">CPU Load</div>
        <div class="monitor-status-indicator-div monitor-th">&nbsp;</div>
        <div style="clear: both;"></div>
      </div>
    </div>
    <div class="monitor-main-div">
      <div v-for="server in status" v-bind:key="server.server_id">
        <div
          v-show="selectedEnvironments.includes(server.environment_id) && selectedClusters.includes(server.cluster_id) && selectedDatacenters.includes(server.datacenter_id) && (!server.is_healthy || server.is_healthy && showHealthy)"
        >
          <div>
            <div class="monitor-server-div">
              <div
                class="monitor-expand-collapse-div monitor-td"
                v-on:click="expandCollapseServer(server.server_id, $event)"
              >
                <i
                  class="fa fa-caret-down"
                  v-if="server.slaves.length > 0 && !server.expanded"
                  aria-hidden="true"
                ></i>
                <i
                  class="fa fa-caret-up"
                  v-if="server.slaves.length > 0 && server.expanded"
                  aria-hidden="true"
                ></i>
                <div v-show="server.slaves.length == 0">&nbsp;</div>
              </div>
              <div class="monitor-hostname-div monitor-td">{{server.hostname}}</div>
              <div
                class="monitor-port-name-div monitor-td"
              >{{(server.port_name == "" ? "&nbsp;" : server.port_name) }}</div>
              <div class="monitor-ipaddress-div monitor-td">{{server.ipaddress}}</div>
              <div class="monitor-connections-div monitor-td ta-r">{{server.connection_count}}</div>
              <div
                class="monitor-disk-usage-div monitor-td ta-c"
                v-b-tooltip.html.hover
                data-toggle="tooltip"
                data-html="true"
                v-bind:title="server.disk_used_title"
              >{{(server.disk_used != "" ? server.disk_used : "&nbsp;")}}</div>
              <div class="monitor-cpu-load-div monitor-td ta-r">{{server.cpu_load}}</div>
              <div
                v-bind:class="'monitor-status-indicator-div monitor-td ' + server.status_class"
              >&nbsp;</div>
              <div style="clear: both;"></div>
            </div>
          </div>

          <div class="mt-1">
            <div
              v-show="server.expanded"
              v-bind:id="'slave-header-' + server.server_id"
              class="monitor-server-slave-header-div"
            >
              <div class="monitor-connection-name-div monitor-th">Connection Name</div>
              <div class="monitor-master-binlog-filename-div monitor-th">Master Binlog Filename</div>
              <div class="monitor-master-binlog-pos-div monitor-th">Master Binlog Position</div>
              <div class="monitor-lag-time-div monitor-th">Lag Time</div>
              <div class="monitor-last-checked-div monitor-th">Last Checked</div>
              <div style="clear: both;"></div>
            </div>

            <div
              v-show="server.expanded"
              class="monitor-slave-entry"
              v-for="slave in server.slaves"
              v-bind:key="slave.server_slave_status_id"
            >
              <div>
                <!--  Slaves -->
                <div class="monitor-server-slave-div">
                  <div
                    class="monitor-connection-name-div monitor-slave-td"
                  >{{ slave.connection_name }}</div>
                  <div
                    class="monitor-master-binlog-filename-div monitor-slave-td"
                  >{{ slave.master_binlog_filename }}</div>
                  <div
                    class="monitor-master-binlog-pos-div monitor-slave-td"
                  >{{ slave.master_binlog_position }}</div>
                  <div class="monitor-lag-time-div monitor-slave-td">{{ slave.lag_time_secs }}</div>
                  <div class="monitor-last-checked-div monitor-slave-td">{{ slave.check_datetime }}</div>
                  <div style="clear: both;"></div>
                </div>
              </div>
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
      status: [],
      showHealthy: false
    };
  },
  methods: {
    expandCollapseServer(server_id, $event) {
      for (var i = 0; i < this.status.length; i++) {
        if (this.status[i].server_id == server_id) {
          this.status[i].expanded = !this.status[i].expanded;
          this.$forceUpdate();
          return;
        }
      }
    },
    hideShowHealthy($event) {
      this.showHealthy = !this.showHealthy;
      this.$forceUpdate();
    },
    filterOptionClicked(filterType, key, $event) {
      switch (filterType) {
        case "cluster":
          if (this.selectedClusters.includes(key)) {
            var index = this.selectedClusters.indexOf(key);
            if (index > -1) {
              this.selectedClusters.splice(index, 1);
            }
          } else {
            this.selectedClusters.push(key);
          }
          this.$forceUpdate();
          break;
        case "environment":
          if (this.selectedEnvironments.includes(key)) {
            var index = this.selectedEnvironments.indexOf(key);
            if (index > -1) {
              this.selectedEnvironments.splice(index, 1);
            }
          } else {
            this.selectedEnvironments.push(key);
          }
          this.$forceUpdate();
          break;
        case "datacenter":
          if (this.selectedDatacenters.includes(key)) {
            var index = this.selectedDatacenters.indexOf(key);
            if (index > -1) {
              this.selectedDatacenters.splice(index, 1);
            }
          } else {
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
  },
  computed: {
    // a computed getter
    diskUsageTitle: function() {
      // `this` points to the vm instance
      return this.message
        .split("")
        .reverse()
        .join("");
    }
  }
};
</script>
