<template>
  <!-- Header -->
  <header id="page-header" class="bb-2-white">
    <!-- Header Content -->
    <div class="content-header">
      <!-- Left Section -->
      <h1 class="app-title justify-content-center">Database Monitor</h1>
      <!-- END Left Section -->
      <!-- Right Section -->
      <div>
        <!-- User Dropdown -->
        <div
          v-if="userLoggedIn == '0'"
          class="dropdown d-inline-block"
        >
          <button
            type="button"
            class="btn btn-dual"
            id="page-header-user-dropdown"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <i class="fa fa-fw fa-user d-sm-none"></i>
            <span class="d-none d-sm-inline-block">Guest</span>
            <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
          </button>

          <div
            class="dropdown-menu dropdown-menu-right"
            aria-labelledby="page-header-user-dropdown"
          >
            <div class>
              <a class="nav-main-link" v-bind:href="loginUrl">
                <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> Login
              </a>
            </div>
            <div class>
              <a class="nav-main-link" v-bind:href="registerUrl">
                <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> Register
              </a>
            </div>
          </div>
        </div>
        <div
          v-if="userLoggedIn == '1'"
          class="dropdown d-inline-block"
        >
          <button
            type="button"
            class="btn btn-dual"
            id="page-header-user-dropdown"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <i class="fa fa-fw fa-user d-sm-none"></i>
            <span class="d-none d-sm-inline-block">{{ userFirstName }}&nbsp;{{ userLastName }}</span>
            <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
          </button>
          <div
            class="dropdown-menu dropdown-menu-right p-0"
            aria-labelledby="page-header-user-dropdown"
          >
            <div class>
              <a
                class="nav-main-link"
                v-bind:href="logoutUrl"
                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
              >
                <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> Log Out
              </a>

              <form
                id="logout-form"
                v-bind:action="logoutUrl"
                method="POST"
                style="display: none;"
              >@csrf</form>
            </div>
            <div class>
              <a class="nav-main-link" v-bind:href="settingsUrl">
                <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> Settings
              </a>
            </div>
          </div>
        </div>

        <!-- END User Dropdown -->
        <!-- Notifications Dropdown -->
        <div
          v-if="userLoggedIn == '1'"
          class="dropdown d-inline-block"
        >
          <button
            type="button"
            class="btn btn-dual"
            id="page-header-notifications-dropdown"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <i class="fa fa-fw fa-bell"></i>
            <span class="badge badge-secondary badge-pill">5</span>
          </button>
          <div
            class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 notifications-main-div"
            aria-labelledby="page-header-notifications-dropdown"
          >
            <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">
              <h2 class="color-white mt-0 mb-0">Notifications</h2>
            </div>
            <ul class="nav-items">
              <li class="notification">
                <a class="text-dark media py-2" href="javascript:void(0)">
                  <div class="mx-3">
                    <i class="fa fa-fw fa-check-circle text-success"></i>
                  </div>
                  <div class="media-body font-size-sm pr-2">
                    <div>App was updated to v5.6!</div>
                    <div class="font-italic">3 min ago</div>
                  </div>
                </a>
              </li>
              <li class="notification">
                <a class="text-dark media py-2" href="javascript:void(0)">
                  <div class="mx-3">
                    <i class="fa fa-fw fa-user-plus text-info"></i>
                  </div>
                  <div class="media-body font-size-sm pr-2">
                    <div>New Subscriber was added! You now have 2580!</div>
                    <div class="font-italic">10 min ago</div>
                  </div>
                </a>
              </li>
              <li class="notification">
                <a class="text-dark media py-2" href="javascript:void(0)">
                  <div class="mx-3">
                    <i class="fa fa-fw fa-times-circle text-danger"></i>
                  </div>
                  <div class="media-body font-size-sm pr-2">
                    <div>Server backup failed to complete!</div>
                    <div class="font-italic">30 min ago</div>
                  </div>
                </a>
              </li>
              <li>
                <a class="text-dark media py-2" href="javascript:void(0)">
                  <div class="mx-3">
                    <i class="fa fa-fw fa-exclamation-circle text-warning"></i>
                  </div>
                  <div class="media-body font-size-sm pr-2">
                    <div>You are running out of space. Please consider upgrading your plan.</div>
                    <div class="font-italic">1 hour ago</div>
                  </div>
                </a>
              </li>
            </ul>
            <div class="p-2 border-top">
              <a class="btn btn-light btn-block text-center" href="javascript:void(0)">
                <i class="fa fa-fw fa-eye mr-1"></i> View All
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  props: {
    userFirstName: String,
    userLastName: String,
    userLoggedIn: String,
    loginUrl: String,
    registerUrl: String,
    logoutUrl: String,
    settingsUrl: String
  },
  data: function() {
    return {};
  },
  methods: {},
  components: {}
};
</script>
