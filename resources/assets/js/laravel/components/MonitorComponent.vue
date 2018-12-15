<template>
  <div>
    <div class="filter-bar-div">
      <div class="row justify-content-center">
        <div class="mt-2 mb-2">
          <div class="fl">
            <div class="button-group filter-bar-button-div">
              <button
                type="button"
                class="btn btn-default btn-lg dropdown-toggle monitoring-filter-btn"
                data-toggle="dropdown"
              >
                <span>Clusters</span>
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
                    v-bind:checked="selectedClusters.includes(cluster.cluster_id)"
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
                class="btn btn-default btn-lg dropdown-toggle monitoring-filter-btn"
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
                    v-bind:checked="selectedEnvironments.includes(environment.environment_id)"
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
                class="btn btn-default btn-lg dropdown-toggle monitoring-filter-btn"
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
                    v-bind:checked="selectedDatacenters.includes(datacenter.datacenter_id)"
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

      <div class="row justify-content-center">
        <div class="checkbox-div">
          <div class="fl">
            <input
              class="filter-checkbox"
              type="checkbox"
              v-bind:checked="this.showHealthy"
              v-on:click="hideShowHealthy()"
            >
          </div>
          <div class="fl">
            <span>&nbsp;Show Healthy</span>
          </div>

          <div class="fl ml-5">
            <input
              class="filter-checkbox"
              type="checkbox"
              v-bind:checked="this.showMaintenance"
              v-on:click="hideShowMaintenance()"
            >
          </div>
          <div class="fl">
            <span>&nbsp;Show Maintenance</span>
          </div>
          <div class="fl ml-5">
            <input
              class="filter-checkbox"
              type="checkbox"
              v-bind:checked="this.showInactive"
              v-on:click="hideShowInactive()"
            >
          </div>
          <div class="fl">
            <span>&nbsp;Show Inactive</span>
          </div>

          <div style="clear: both;"></div>
        </div>
      </div>

      <div class="row justify-content-center mt-3">
        <span>
          Last Updated:
          <span class="monitoring-last-updated">{{lastUpdated}}</span>
        </span>
      </div>
    </div>
    <div class="of-auto">
      <div class="monitor-main-div bl-w">
        <div class="monitor-expand-collapse-div monitor-th">&nbsp;</div>
        <div class="monitor-hostname-div monitor-th">Hostname</div>
        <div class="monitor-port-name-div monitor-th">Port Name</div>
        <div class="monitor-ipaddress-div monitor-th">IP Address</div>
        <div class="monitor-active-div monitor-th">Active</div>
        <div class="monitor-maintenance-div monitor-th">Maintenance</div>
        <div class="monitor-connections-div monitor-th">Connections</div>
        <div class="monitor-disk-usage-div monitor-th">Disk Usage</div>
        <div class="monitor-cpu-load-div monitor-th">CPU Load</div>
        <div class="monitor-status-indicator-div monitor-th">&nbsp;</div>
        <div style="clear: both;"></div>
      </div>
      <div class="monitor-main-div">
        <div v-for="server in status" v-bind:key="server.server_id">
          <div
            v-show="selectedEnvironments.includes(server.environment_id) && selectedClusters.includes(server.cluster_id) && selectedDatacenters.includes(server.datacenter_id) && 
          (!server.is_healthy || server.is_healthy && showHealthy) && 
          (server.status == 1 || server.status == 2 && showMaintenance || server.status == 0 && showInactive)"
            style="border-left: 1px solid white;border-right: 1px solid white;"
          >
            <div>
              <div class="monitor-server-div">
                <div
                  v-bind:class="'monitor-expand-collapse-div monitor-td monitor-td ' + (server.slaves.length > 0 ? 'cursor-pointer' : '')"
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
                <div
                  v-if="server.status == 0"
                  class="monitor-active-div monitor-td ta-c cursor-pointer"
                  v-b-tooltip.html.hover
                  tabindex="0"
                  title="Click to make active"
                  v-on:click="makeServerActive(server.server_id, $event)"
                >No</div>
                <div
                  v-if="server.status != 0"
                  class="monitor-active-div monitor-td ta-c cursor-pointer"
                  v-b-tooltip.html.hover
                  tabindex="0"
                  title="Click to make in-active"
                  v-on:click="makeServerInactive(server.server_id, $event)"
                >Yes</div>

                <div v-if="server.status == 0" class="monitor-maintenance-div monitor-td">&nbsp;</div>
                <div v-if="server.status == 1" class="monitor-maintenance-div monitor-td color-red">
                  <i
                    class="fa fa-wrench"
                    title="Turn on maintenance"
                    v-b-tooltip.html.hover
                    data-toggle="tooltip"
                    data-html="true"
                    v-on:click="turnOnMaintenance(server.server_id, $event)"
                  ></i>
                </div>
                <div
                  v-if="server.status == 2"
                  class="monitor-maintenance-div monitor-td color-green"
                >
                  <i
                    class="fa fa-wrench"
                    title="Turn off maintenance"
                    v-b-tooltip.html.hover
                    data-toggle="tooltip"
                    data-html="true"
                    v-on:click="turnOffMaintenance(server.server_id, $event)"
                  ></i>
                </div>

                <div class="monitor-connections-div monitor-td ta-r">{{server.connection_count}}</div>
                <div
                  class="monitor-disk-usage-div monitor-td ta-c"
                  v-b-tooltip.html.hover
                  tabindex="0"
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
                <div class="monitor-slave-error-msg-div monitor-th">Last Error</div>
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
                    <div
                      class="monitor-slave-error-msg-div monitor-td color-red-bold"
                      v-bind:title="slave.last_error_msg"
                      v-b-tooltip.html.hover
                      data-toggle="tooltip"
                      data-html="true"
                    >{{ slave.last_error_msg}}</div>
                    <div
                      class="monitor-last-checked-div monitor-slave-td"
                    >{{ slave.check_datetime }}</div>
                    <div style="clear: both;"></div>
                  </div>
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
      showHealthy: false,
      showMaintenance: false,
      showInactive: false,
      lastUpdated: "",
      expandedServers: []
    };
  },
  methods: {
    convertUTCDateToLocalDate(date) {
      var newDate = new Date(
        date.getTime() + date.getTimezoneOffset() * 60 * 1000
      );

      var offset = date.getTimezoneOffset() / 60;
      var hours = date.getHours();

      newDate.setHours(hours - offset);

      return newDate;
    },
    makeServerActive(server_id, $event) {
      var self = this;

      $.ajax({
        url: "/api/makeserveractive/" + server_id,
        cache: false,
        dataType: "json",
        success: function(response) {
          for (var i = 0; i < self.status.length; i++) {
            if (self.status[i].server_id == server_id) {
              self.status[i].status = 1;
              self.$forceUpdate();
              return;
            }
          }
        }
      });
    },
    makeServerInactive(server_id, $event) {
      var self = this;

      $.ajax({
        url: "/api/makeserverinactive/" + server_id,
        cache: false,
        dataType: "json",
        success: function(response) {
          for (var i = 0; i < self.status.length; i++) {
            if (self.status[i].server_id == server_id) {
              self.status[i].status = 0;
              self.$forceUpdate();
              return;
            }
          }
        }
      });
    },
    expandCollapseServer(server_id, $event) {
      for (var i = 0; i < this.status.length; i++) {
        if (this.status[i].server_id == server_id) {
          if (this.status[i].slaves.length == 0) {
            return;
          }
          this.status[i].expanded = !this.status[i].expanded;
          if (!this.status[i].expanded) {
            if (this.expandedServers.includes(this.status[i].server_id)) {
              for (var j = 0; j < this.expandedServers.length; j++) {
                if (this.expandedServers[j] == this.status[i].server_id) {
                  this.expandedServers.splice(j, 1);
                }
              }
            }
          } else {
            if (!this.expandedServers.includes(this.status[i].server_id)) {
              this.expandedServers.push(this.status[i].server_id);
            }
          }
          $cookies.set("expandedServers", JSON.stringify(this.expandedServers));
          this.$forceUpdate();
          return;
        }
      }
    },
    turnOffMaintenance(server_id, $event) {
      var self = this;

      $.ajax({
        url: "/api/turnoffmaintenance/" + server_id,
        cache: false,
        dataType: "json",
        success: function(response) {
          for (var i = 0; i < self.status.length; i++) {
            if (self.status[i].server_id == server_id) {
              self.status[i].status = 1;
              self.$forceUpdate();
              return;
            }
          }
        }
      });
    },
    turnOnMaintenance(server_id, $event) {
      var self = this;

      $.ajax({
        url: "/api/turnonmaintenance/" + server_id,
        cache: false,
        dataType: "json",
        success: function(response) {
          for (var i = 0; i < self.status.length; i++) {
            if (self.status[i].server_id == server_id) {
              self.status[i].status = 2;
              self.$forceUpdate();
              return;
            }
          }
        }
      });
    },
    hideShowHealthy($event) {
      this.showHealthy = !this.showHealthy;
      $cookies.set("showHealthy", this.showHealthy ? "1" : "0");
      this.$forceUpdate();
    },
    hideShowMaintenance($event) {
      this.showMaintenance = !this.showMaintenance;
      $cookies.set("showMaintenance", this.showMaintenance ? "1" : "0");
      this.$forceUpdate();
    },
    hideShowInactive($event) {
      this.showInactive = !this.showInactive;
      $cookies.set("showInactive", this.showInactive ? "1" : "0");
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
          $cookies.set(
            "selectedClusters",
            JSON.stringify(this.selectedClusters)
          );
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
          $cookies.set(
            "selectedEnvironments",
            JSON.stringify(this.selectedEnvironments)
          );
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
          $cookies.set(
            "selectedDatacenters",
            JSON.stringify(this.selectedDatacenters)
          );
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

          var selClusters = JSON.parse($cookies.get("selectedClusters"));

          if (selClusters != null) {
            self.selectedClusters = selClusters;
          } else {
            self.clusters.forEach(function(c) {
              self.selectedClusters.push(c.cluster_id);
            });
          }

          var selEnvironments = JSON.parse(
            $cookies.get("selectedEnvironments")
          );

          if (selEnvironments != null) {
            self.selectedEnvironments = selEnvironments;
          } else {
            self.environments.forEach(function(e) {
              self.selectedEnvironments.push(e.environment_id);
            });
          }

          var selDatacenters = JSON.parse($cookies.get("selectedDatacenters"));

          if (selDatacenters != null) {
            self.selectedDatacenters = selDatacenters;
          } else {
            self.datacenters.forEach(function(d) {
              self.selectedDatacenters.push(d.datacenter_id);
            });
          }

          var showHealthy = $cookies.get("showHealthy");

          if (showHealthy != null) {
            self.showHealthy = showHealthy == "1" ? true : false;
          } else {
            self.showHealthy = 1;
          }

          var showMaintenance = $cookies.get("showMaintenance");

          if (showMaintenance != null) {
            self.showMaintenance = showMaintenance == "1" ? true : false;
          } else {
            self.showMaintenance = 1;
          }

          var showInactive = $cookies.get("showInactive");

          if (showInactive != null) {
            self.showInactive = showInactive == "1" ? true : false;
          }

          var expandedServers = JSON.parse($cookies.get("expandedServers"));

          if (expandedServers != null) {
            self.expandedServers = expandedServers;
          }
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
          self.lastUpdated = self
            .convertUTCDateToLocalDate(new Date(response.last_updated))
            .toLocaleString();
          for (var i = 0; i < self.status.length; i++) {
            if (self.expandedServers.includes(self.status[i].server_id)) {
              self.status[i].expanded = true;
            } else {
              self.status[i].expanded = false;
            }
          }
          setTimeout(self.statusPoller, 10000);
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
