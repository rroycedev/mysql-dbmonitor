<template>
<div class="content">
    <div class="row justify-content-center">
        <div>
            <div class="block block-rounded">
                <div class="panel-header">
                    <h3 class="panel-title">Users</h3>
                </div>
                <div class="block-content">
                    <div v-if="msg != ''" class="alert alert-success">
                         {{ msg }}
                    </div>
                    <div v-if="error != ''" class="alert alert-danger">
                         {{ error }}
                    </div>
   <!--                 
                    <table class="table table-striped table-hover">
                        <thead class="table-thead">
                            <tr>
                                <th class="user-name-table-col">Name</th>
                                <th class="user-email-table-col">Email Address</th>
                                <th class="change-delete-btn-table-col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            <tr v-for="user in users" v-bind:key="user.id">
                                <td class="user-name-table-col ellipsis-text" v-b-popover.html.hover.right tabindex="0" v-bind:title="user.name">{{user.name}}</td>
                                <td class="user-email-table-col ellipsis-text" v-b-popover.html.hover.right tabindex="0" v-bind:title="user.email">{{user.email}}</td>
                                <td class="change-delete-btn-table-col">
                                    <button class="btn btn-info" v-on:click="editUser(user.id)">Edit</button>&nbsp;
                                    <button class="btn btn-info" v-on:click="deleteUser(user.id)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
-->                    
                    <b-table :items="users" :fields="fields" :striped="true" :hover="true">
                         <template slot="actions" slot-scope="row">
                              <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
                              <b-button size="sm" @click.stop="editUser(row.item, row.index, $event.target)" class="btn btn-info mr-1">
                                   Change
                              </b-button>
                              <b-button size="sm" @click.stop="row.toggleDetails" class="btn btn-info">
                                   Delete
                              </b-button>
                         </template>
                    </b-table>

                    <b-modal id="modalInfo" @hide="resetModal" :title="modalInfo.title" ok-only>
                         <pre>{{ modalInfo.content }}</pre>
                    </b-modal>                    

                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <a class="btn btn-info" href="/admin/user/add">Add</a>
    </div>
</div>
</template>


<script>

export default {
     data: function() {
          return {
               users: [],
               fields: [ 
                         {key: 'first_name', label: 'First Name', class: 'user-name-table-col'},
                         {key: 'last_name', label: 'Last Name', class: 'user-name-table-col'},
                         {key: 'email', label: 'Email', class: 'user-email-table-col'},
                         {key: 'actions', label: 'Actions'},
                    ],
               msg: '',
               error: '',
               modalInfo: { title: '', content: '' },               
          };
     },
     methods: {
          editUser (item, index, button) {
               this.modalInfo.title = `Edit User`
               this.modalInfo.content = JSON.stringify(item, null, 2);
               this.$root.$emit('bv::show::modal', 'modalInfo', button);
          },          
          deleteUser(userId) {
               window.location.href='/admin/user/delete/' + userId;
          },
          resetModal () {
               this.modalInfo.title = ''
               this.modalInfo.content = ''
          }
     },
     mounted() {
          var self = this;

          $.ajax({
               url: "/api/getusers",
               cache: false,
               dataType: "json",
               success: function(response) {
                    self.users = response.users;
               }
          });

     }
};

</script>
