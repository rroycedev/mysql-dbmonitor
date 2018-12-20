<template>
  <nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="side-header">
      <div class="content-header">
        <a class="link-fx font-w600 font-size-lg text-white" href="/">
          <h2 class="text-white-75 mb-0">Royce Consulting</h2>
        </a>
        <div>
          <a
            class="d-lg-none text-white ml-2"
            data-toggle="layout"
            data-action="sidebar_close"
            href="javascript:void(0)"
          >
            <i class="fa fa-times-circle"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="content-side content-side-full">
      <ul v-show="userLoggedIn == '1'" class="nav-main">
        <li
          v-bind:class="'nav-main-item nav-item-bordered' + (requestUrl.substring(0, 7) == 'monitor' ? ' open' : '')"
        >
          <a
            v-bind:class="'nav-main-link nav-main-link-submenu' + (requestUrl.substring(0, 7) == 'monitor' ? ' active' : '')"
            data-toggle="submenu"
            aria-haspopup="true"
            aria-expanded="true"
            href="#"
          >
            <i class="nav-main-link-icon si si-eyeglasses"></i>
            <span class="nav-main-link-name">Monitor</span>
          </a>
          <ul class="nav-main-submenu">
            <li class="nav-main-item">
              <a
                v-bind:class="'nav-main-link nav-main-link-font' + (requestUrl == 'monitor/all' ? ' active' : '')"
                href="/monitor/all"
              >
                <span class="nav-main-link-name">All Servers</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a
                v-bind:class="'nav-main-link nav-main-link-font' + (requestUrl == 'monitor/specific' ? ' active' : '')"
                href="/monitor/specific"
              >
                <span class="nav-main-link-name">Specific Server</span>
              </a>
            </li>
          </ul>
        </li>

        <!--  Admin menu -->
        <li
          v-bind:class="'nav-main-item nav-item-bordered' + (requestUrl.substring(0, 5) == 'admin' ? ' open' : '')"
        >
          <a
            v-bind:class="'nav-main-link nav-main-link-submenu' + (requestUrl.substring(0, 5) == 'admin' ? ' active' : '')"
            data-toggle="submenu"
            aria-haspopup="true"
            aria-expanded="true"
            href="#"
          >
            <i class="nav-main-link-icon si si-settings"></i>
            <span class="nav-main-link-name">Administration</span>
          </a>
          <ul class="nav-main-submenu">
            <li class="nav-main-item">
              <a
                v-bind:class="'nav-main-link nav-main-link-font' + (requestUrl.substring(0, 10) == 'admin/user' ? ' active' : '')"
                href="/admin/user"
              >
                <span class="nav-main-link-name">Users</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a
                v-bind:class="'nav-main-link nav-main-link-font' + (requestUrl.substring(0, 12) == 'admin/server' ? ' active' : '')"
                href="/admin/server"
              >
                <span class="nav-main-link-name">Servers</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a
                v-bind:class="'nav-main-link nav-main-link-font' + (requestUrl.substring(0, 17) == 'admin/environment' ? ' active' : '')"
                href="/admin/environment"
              >
                <span class="nav-main-link-name">Environments</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a
                v-bind:class="'nav-main-link nav-main-link-font' + (requestUrl.substring(0, 16) == 'admin/datacenter' ? ' active' : '')"
                href="/admin/datacenter"
              >
                <span class="nav-main-link-name">Datacenters</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a
                v-bind:class="'nav-main-link nav-main-link-font' + (requestUrl.substring(0, 13) == 'admin/cluster' ? ' active' : '')"
                href="/admin/cluster"
              >
                <span class="nav-main-link-name">Clusters</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a
                v-bind:class="'nav-main-link nav-main-link-font' + (requestUrl.substring(0, 14) == 'admin/dnsalias' ? ' active' : '')"
                href="/admin/dnsalias"
              >
                <span class="nav-main-link-name">DNS Aliases</span>
              </a>
            </li>

            <li
              v-bind:class="'nav-main-item' + (requestUrl.substring(0, 11) == 'admin/alert' ? ' open' : '')"
            >
              <a
                class="nav-main-link nav-main-link-submenu nav-main-link-font"
                data-toggle="submenu"
                aria-haspopup="true"
                aria-expanded="true"
                href="#"
              >
                <span class="nav-main-link-name">Alerts</span>
              </a>
              <ul class="nav-main-submenu">
                <li class="nav-main-item">
                  <a
                    v-bind:class="'nav-main-link nav-main-link-font' + (requestUrl.substring(0, 19) == 'admin/alert/repllag' ? ' active' : '')"
                    href="/admin/alert/repllag"
                  >
                    <span class="nav-main-link-name">Replication Lag</span>
                  </a>
                </li>
                <li class="nav-main-item">
                  <a
                    v-bind:class="'nav-main-link nav-main-link-font' + (requestUrl.substring(0, 16) == 'admin/alert/disk' ? ' active' : '')"
                    href="/admin/alert/disk"
                  >
                    <span class="nav-main-link-name">Disk Space</span>
                  </a>
                </li>
                <li class="nav-main-item">
                  <a
                    v-bind:class="'nav-main-link nav-main-link-font' + (requestUrl.substring(0, 19) == 'admin/alert/cpuload' ? ' active' : '')"
                    href="/admin/alert/cpuload"
                  >
                    <span class="nav-main-link-name">CPU Load</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li
          style="display: none;"
          v-bind:class="'nav-main-item' + (requestUrl.substring(0, 7) == 'reports' ? ' open' : '') + ' nav-item-bordered'"
        >
          <a
            class="nav-main-link nav-main-link-submenu"
            data-toggle="submenu"
            aria-haspopup="true"
            aria-expanded="true"
            href="#"
          >
            <i class="nav-main-link-icon si si-chart"></i>
            <span class="nav-main-link-name">Reports</span>
          </a>
          <ul class="nav-main-submenu">
            <li class="nav-main-item">
              <a
                v-bind:class="'nav-main-link nav-main-link-font' + (requestUrl == 'reports/dataintegrity' ? ' active' : '')"
                href="/reports/dataintegrity"
              >
                <span class="nav-main-link-name">Data Integrity</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a
                v-bind:class="'nav-main-link nav-main-link-font' + (requestUrl == 'reports/dbcompare' ? ' active' : '')"
                href="/reports/dbcompare"
              >
                <span class="nav-main-link-name">Database Comparison</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  props: {
    userLoggedIn: String,
    requestUrl: String
  },
  data: function() {
    return {};
  },
  methods: {},
  components: {}
};
</script>
