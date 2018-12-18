<template>
<div class="of-y-auto mt-5">
     <div class="row justify-content-center mb-3">
          <h1 class="mb-0 color-white">{{objectName}}</h1>
     </div>
     <div class="row justify-content-center">
          <div v-for="o in objects" class="fl mr-2 mb-2">
               
                    <div class="panel-header justify-content-center">
                         <h3 class="mb-0 color-white ta-c">
                              <span v-if="objectType == 'server' || objecType == 'serverdetail'">{{ o.server_name}}</span>
                              <span v-if="objectType != 'server'">{{ o.name}}</span>
                         </h3>
                    </div>
                    <div v-if="objectType == 'server'" class="panel-body-light ta-c">
                         <button
                              class="btn btn-info"
                              v-on:click="drillDown(o.server_id, o.server_name)"
                              style="font-size: 16px;"
                         >Select</button>
                    </div>
                    <div v-if="objectType == 'environment'" class="panel-body-light ta-c">
                         <button
                              class="btn btn-info"
                              v-on:click="drillDown(o.environment_id, o.name)"
                              style="font-size: 16px;"
                         >Select</button>
                    </div>
                    <div v-if="objectType == 'datacenter'" class="panel-body-light ta-c">
                         <button
                              class="btn btn-info"
                              v-on:click="drillDown(o.datacenter_id, o.name)"
                              style="font-size: 16px;"
                         >Select</button>
                    </div>
                    <div v-if="objectType == 'cluster'" class="panel-body-light ta-c">
                         <button
                              class="btn btn-info"
                              v-on:click="drillDown(o.cluster_id, o.name)"
                              style="font-size: 16px;"
                         >Select</button>
                    </div>
                    <div v-if="objectType == 'serverdetails'" class="panel-body-light cursor-pointer">


                         <div>
                              <div class="row justify-content-center p-2"><div class="last-updated">Last Update: {{lastUpdated}}</div></div>
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
                         <div class="monitor-server-div">
                              <div
                              v-bind:class="'monitor-expand-collapse-div monitor-td monitor-td ' + (o.slaves.length > 0 ? 'cursor-pointer' : '')"
                              v-on:click="expandCollapseServer(o.server_id, $event)"
                              >
                              <i
                                   class="fa fa-caret-down"
                                   v-if="o.slaves.length > 0 && !o.expanded"
                                   aria-hidden="true"
                              ></i>
                              <i
                                   class="fa fa-caret-up"
                                   v-if="o.slaves.length > 0 && o.expanded"
                                   aria-hidden="true"
                              ></i>
                              <div v-show="o.slaves.length == 0">&nbsp;</div>
                              </div>
                              <div class="monitor-hostname-div monitor-td">{{o.hostname}}</div>
                              <div
                              class="monitor-port-name-div monitor-td"
                              >{{(o.port_name == "" ? "&nbsp;" : o.port_name) }}</div>
                              <div class="monitor-ipaddress-div monitor-td">{{o.ipaddress}}</div>
                              <div
                              v-if="o.status == 0"
                              class="monitor-active-div monitor-td ta-c cursor-pointer"
                              v-b-tooltip.html.hover
                              tabindex="0"
                              title="Click to make active"
                              v-on:click="makeServerActive(o.server_id, $event)"
                              >No</div>
                              <div
                              v-if="o.status != 0"
                              class="monitor-active-div monitor-td ta-c cursor-pointer"
                              v-b-tooltip.html.hover
                              tabindex="0"
                              title="Click to make in-active"
                              v-on:click="makeServerInactive(o.server_id, $event)"
                              >Yes</div>

                              <div v-if="o.status == 0" class="monitor-maintenance-div monitor-td">&nbsp;</div>
                              <div v-if="o.status == 1" class="monitor-maintenance-div monitor-td color-red">
                              <i
                                   class="fa fa-wrench"
                                   title="Turn on maintenance"
                                   v-b-tooltip.html.hover
                                   data-toggle="tooltip"
                                   data-html="true"
                                   v-on:click="turnOnMaintenance(o.server_id, $event)"
                              ></i>
                              </div>
                              <div
                              v-if="o.status == 2"
                              class="monitor-maintenance-div monitor-td color-green"
                              >
                              <i
                                   class="fa fa-wrench"
                                   title="Turn off maintenance"
                                   v-b-tooltip.html.hover
                                   data-toggle="tooltip"
                                   data-html="true"
                                   v-on:click="turnOffMaintenance(o.server_id, $event)"
                              ></i>
                              </div>

                              <div class="monitor-connections-div monitor-td ta-r">{{o.connection_count}}</div>
                              <div
                              class="monitor-disk-usage-div monitor-td ta-c"
                              v-b-tooltip.html.hover
                              tabindex="0"
                              v-bind:title="o.disk_used_title"
                              >{{(o.disk_used != "" ? o.disk_used : "&nbsp;")}}</div>
                              <div class="monitor-cpu-load-div monitor-td ta-r">{{o.cpu_load}}</div>
                              <div
                              v-bind:class="'monitor-status-indicator-div monitor-td ' + o.status_class"
                              >&nbsp;</div>
                              <div style="clear: both;"></div>
                         </div>
                         </div>

                         <div class="mt-1">
                         <div
                              v-bind:id="'slave-header-' + o.server_id"
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
                              class="monitor-slave-entry"
                              v-for="slave in o.slaves"
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
export default {
     mounted() {
          $(".monitor-expand-collapse-div")
               .on("contextmenu", function(e) {
               var top = e.pageY - 10;
               var left = e.pageX - 90;
               $("#context-menu")
                    .css({
                    display: "block",
                    top: top,
                    left: left
                    })
                    .addClass("show");
               return false; //blocks default Webbrowser right click menu
               })
               .on("click", function() {
               $("#context-menu")
                    .removeClass("show")
                    .hide();
               });


     },
     data: function() {
          return {
               pkId: 0,
               objecType: '',
               objects: [],
               objectName: '',
               lastUpdated: '',
               pollerTimeoutHandler: null
          };
     },
  methods: {
     statusPoller() {
          var self = this;

          $.ajax({
               url: "/api/serverstatus/" + self.pkId,
               cache: false,
               dataType: "json",
                    success: function(response) {
                         self.objects = response.status;
                         self.lastUpdated = convertUTCDateToLocalDate(new Date(response.last_updated))
                         .toLocaleString();
                         self.pollerTimeoutHandler = setTimeout(self.statusPoller, 10000);
                    }
               });
       },
       goToHome() {
               if (this.pollerTimeoutHandler) {
                    clearTimeout(this.pollerTimeoutHandler);
                    this.pollerTimeoutHandler = null;
               }

               this.objecType = 'environment';

               this.$parent.$refs.navbar.environmentId = "0";
               this.$parent.$refs.navbar.datacenterId = "0";
               this.$parent.$refs.navbar.clusterId = "0";
               this.$parent.$refs.navbar.environmentName = "";
               this.$parent.$refs.navbar.datacenterName = "";
               this.$parent.$refs.navbar.clusterName = "";

               var self = this;

               $.ajax({
                    url: "/api/getenvironments",
                    cache: false,
                    dataType: "json",
                    success: function(response) {
                         self.pkId = pkId;
                         self.objectType = "environment";
                         self.objectName = "Environments";
                         self.objects = response.environments;
                    }
               });
       },
       goToEnvironment(pkId, envName) {
               if (this.pollerTimeoutHandler) {
                    clearTimeout(this.pollerTimeoutHandler);
                    this.pollerTimeoutHandler = null;
               }
               
               this.objecType = 'datacenter';
               
               this.$parent.$refs.navbar.environmentId = pkId;
               this.$parent.$refs.navbar.environmentName = envName;

               this.$parent.$refs.navbar.datacenterId = "0";
               this.$parent.$refs.navbar.datacenterName = "";
               this.$parent.$refs.navbar.clusterId = "0";
               this.$parent.$refs.navbar.clusterName = "";
               this.$parent.$refs.navbar.serverId = 0;
               this.$parent.$refs.navbar.serverName = "";

               var self = this;

               $.ajax({
                    url: "/api/getdatacenters",
                    cache: false,
                    dataType: "json",
                    success: function(response) {
                         self.pkId = pkId;
                         self.objectType = "datacenter";
                         self.objectName = "Datacenters";
                         self.objects = response.datacenters;
                    }
               });
       },
       goToDatacenter(pkId, dcName) {
               if (this.pollerTimeoutHandler) {
                    clearTimeout(this.pollerTimeoutHandler);
                    this.pollerTimeoutHandler = null;
               }
               
               this.objecType = 'cluster';
               
               this.$parent.$refs.navbar.datacenterId = pkId;
               this.$parent.$refs.navbar.datacenterName = dcName;

               this.$parent.$refs.navbar.clusterId = "0";
               this.$parent.$refs.navbar.clusterName = "";

               this.$parent.$refs.navbar.serverId = 0;
               this.$parent.$refs.navbar.serverName = "";

               var self = this;

               $.ajax({
                    url: "/api/getclusters",
                    cache: false,
                    dataType: "json",
                    success: function(response) {
                         self.pkId = pkId;
                         self.objectType = "cluster";
                         self.objectName = "Clusters";
                         self.objects = response.clusters;
                    }
               });

       },
       goToCluster(pkId, clustName) {
               if (this.pollerTimeoutHandler) {
                    clearTimeout(this.pollerTimeoutHandler);
                    this.pollerTimeoutHandler = null;
               }
               
               this.objecType = 'server';
               
               this.$parent.$refs.navbar.clusterId = pkId;
               this.$parent.$refs.navbar.clusterName = clustName;

               this.$parent.$refs.navbar.serverId = 0;
               this.$parent.$refs.navbar.serverName = "";

               var self = this;

               $.ajax({
                    url: "/api/getservers/" + self.$parent.$refs.navbar.environmentId + "/" + self.$parent.$refs.navbar.datacenterId + "/" + self.$parent.$refs.navbar.clusterId,
                    cache: false,
                    dataType: "json",
                    success: function(response) {
                         self.pkId = pkId;
                         self.objectType = "server";
                         self.objectName = "Servers";
                         self.objects = response.servers;
                    }
               });
       },
       goToServer(pkId, servName) {
               this.objecType = 'serverdetail';
               
               this.$parent.$refs.navbar.serverId = pkId;
               this.$parent.$refs.navbar.serverName = servName;

               var self = this;

               $.ajax({
                    url: "/api/serverstatus/" + self.$parent.$refs.navbar.serverId,
                    cache: false,
                    dataType: "json",
                    success: function(response) {
                         self.pkId = pkId;
                         self.objectType = "serverdetails";
                         self.objectName = "Monitoring Status";
                         self.objects = response.status;

                         self.statusPoller();
                    }
               });
       },       
       drillDown(pkId, objName) {
            var a = 1;
            var nb = this.$parent.$refs.navbar;

          switch (this.objectType) {
               case 'home':
                    this.goToHome();
                    break;
               case 'environment':
                    this.goToEnvironment(pkId, objName);
                    break;
               case 'datacenter':
                    this.goToDatacenter(pkId, objName);
                    break;
               case 'cluster':
                    this.goToCluster(pkId, objName);
                    break;
               case 'server':
                    this.goToServer(pkId, objName);
                    break;
          }
       }
  }
};
</script>
