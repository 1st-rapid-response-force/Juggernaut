<style scoped>
    .action-link {
        cursor: pointer;
    }

    .m-b-none {
        margin-bottom: 0;
    }
</style>

<template>
    <div>
        <div class="alert alert-success" v-if="messages.length > 0">
            <ul>
                <li v-for="message in messages">
                    {{ message }}
                </li>
            </ul>
        </div>

        <div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span>
                            Assignments
                        </span>

                        <a class="action-link" @click="showCreateAssignmentForm">
                            Create New Assignment
                        </a>
                    </div>
                </div>

                <div class="panel-body">
                    <!-- No Tokens Notice -->
                    <p class="m-b-none" v-if="assignments.length === 0">
                        There are no assignments for this team.
                    </p>

                    <!-- Personal Access Tokens -->
                    <table class="table table-borderless m-b-none" v-if="assignments.length > 0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="assignment in assignments">
                                <!-- Client ID -->
                                <td style="vertical-align: middle;" class="col-lg-1">
                                    {{ assignment.id }}
                                </td>

                                <!-- Client Name -->
                                <td style="vertical-align: middle;" class="col-lg-8">
                                    {{ assignment.name }}
                                </td>

                                <!-- Buttons -->
                                <td style="vertical-align: middle;" class="col-lg-2">
                                    <a class="btn btn-primary action-link btn-xs" @click="showEditAssignmentForm(assignment)">
                                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                    </a>
                                    <a class="btn btn-warning action-link btn-xs" @click="showEditAssignmentMembersForm(assignment)">
                                        <i class="fa fa-users" data-toggle="tooltip" data-placement="top" title="Members"></i>
                                    </a>
                                    <a class="btn btn-info action-link btn-xs" @click="moveUp(assignment)">
                                        <i class="fa fa-arrow-up" data-toggle="tooltip" data-placement="top" title="Order Up"></i>
                                    </a>
                                    <a class="btn btn-info action-link btn-xs" @click="moveDown(assignment)">
                                        <i class="fa fa-arrow-down" data-toggle="tooltip" data-placement="top" title="Order Down"></i>
                                    </a>
                                    <a class="btn btn-danger action-link btn-xs" @click="revoke(assignment)">
                                        <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i>
                                    </a>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Create Assignment Modal -->
        <div class="modal fade" id="modal-create-assignment" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Create Assignment
                        </h4>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="formNew.errors.length > 0">
                            <p><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in formNew.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Create Token Form -->
                        <form class="form-horizontal" role="form" @submit.prevent="createAssignment">
                            <!-- Name -->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="create-assignment-name" type="text" class="form-control" name="name" v-model="formNew.name">
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="createAssignment">
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Assignment Modal -->
        <div class="modal fade" id="modal-update-assignment" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Update Assignment
                        </h4>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="formEdit.errors.length > 0">
                            <p><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in formEdit.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Create Token Form -->
                        <form class="form-horizontal" role="form" @submit.prevent="updateAssignment">
                            <!-- Name -->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="update-assignment-name" type="text" class="form-control" name="name" v-model="formEdit.name">
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="updateAssignment">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Assignment Members Modal -->
        <div class="modal fade" id="modal-edit-members" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Edit Assignment - Members
                        </h4>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="formMembers.errors.length > 0">
                            <p><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in formMembers.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Create Token Form -->
                        <form class="form-horizontal" role="form" @submit.prevent="saveMembers">
                            <!-- Name -->
                            <div class="form-group">
                                <select v-model="formMembers.members" multiple class="form-control">
                                    <option v-for="option in members" v-bind:value="option.id">
                                        {{ option.searchable_name }}
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="saveMembers">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    Array.prototype.move = function (old_index, new_index) {
        if (new_index >= this.length) {
            var k = new_index - this.length;
            while ((k--) + 1) {
                this.push(undefined);
            }
        }
        this.splice(new_index, 0, this.splice(old_index, 1)[0]);
        return this; // for testing purposes
    };

    export default {
        /*
         * The component's data.
         */
        data() {
            return {
                assignments: [],
                members: [],
                teams: [],
                messages: [],

                formNew: {
                    errors: [],
                    name: '',
                    team_id: 1,
                    order: 1,
                    enabled: 1
                },

                formEdit: {
                    errors: [],
                    name: '',
                    assignment_id: 1,
                },

                formMembers: {
                    errors: [],
                    members: [],
                    assignment_id: 1,
                },

                formOrder: {
                    errors: [],
                    assignments: []
                }
            };
        },

        props: ['team_id'],

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {

            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getAssignments();
                this.getMembers();
            },

            /**
             * Get all of the Assignments for the user.
             */
            getAssignments() {
                this.$http.get('/api/teams/'+this.team_id+'/assignments')
                        .then(response => {
                            this.assignments = response.data;
                        });
            },

            /**
             * Get all of the Assignments for the user.
             */
            getMembers() {
                this.$http.get('/api/teams/'+this.team_id+'/members')
                    .then(response => {
                        this.members = response.data;
                    });
            },

            /**
             * Get all of the members within an Assignment
             */
            getAssignmentMembers(assignment) {
                this.$http.get('/api/teams/'+this.team_id+'/members/'+assignment.id)
                    .then(response => {
                        this.formMembers.assignment_id = assignment.id;
                        this.formMembers.members = response.data;
                    });
            },

            /**
             * Gets all teams
             */
            getTeams() {
                this.$http.get('/api/teams')
                    .then(response => {
                        this.teams = response.data;
                    });
            },

            /**
             * Shows assignment form modal
             */
            showCreateAssignmentForm() {
                $('#modal-create-assignment').modal('show');
            },

            /**
             * Shows assignment member edit form modal
             */
            showEditAssignmentMembersForm(assignment) {
                this.formMembers.members = [];
                this.getAssignmentMembers(assignment);
                $('#modal-edit-members').modal('show');

            },

            /**
             * Shows assignment edit form modal
             */
            showEditAssignmentForm(assignment) {
                this.formEdit.name = assignment.name;
                this.formEdit.assignment_id = assignment.id;
                $('#modal-update-assignment').modal('show');

            },

            /**
             * Deletes assignment
             */
            revoke(assignment) {
                this.$http.delete('/api/teams/'+this.team_id+'/assignments/' + assignment.id)
                    .then(response => {
                        this.getAssignments();
                    });
            },

            /**
             * Moves assignment up and saves
             */
            moveUp(assignment) {
                let key = this.assignments.indexOf(assignment);
                // If at top do nothing
                if(key === 0)
                {
                    return true;
                }

                this.assignments.move(key-1,key);

                // Save Order
                this.saveOrder();
            },

            /**
             * Moves assignment down and saves
             */
            moveDown(assignment) {
                let key = this.assignments.indexOf(assignment);
                console.log(key);
                console.log(this.assignments.length);
                // If at top do nothing
                if(this.assignments.length-1 === key)
                {
                    return true;
                }

                this.assignments.move(key,key+1);

                // Save order
                this.saveOrder();
            },

            /**
             * Saves the order of the assignments
             */
            saveOrder()
            {
                // Extract only ids
                let ordering = [];
                this.assignments.forEach(function(item){
                   ordering.push(item.id)
                });
                this.formOrder.assignments = ordering;
                console.log(ordering);

                this.$http.post('/api/teams/'+this.team_id+'/assignments/ordering', this.formOrder)
                    .then(response => {
                        this.formOrder.assignments = [];
                        this.formOrder.errors = [];
                        this.messages = ['Order has been updated.'];
                    })
                    .catch(response => {
                        if (typeof response.data === 'object') {
                            this.formOrder.errors = _.flatten(_.toArray(response.data));
                        } else {
                            this.formOrder.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            },

            /**
             * Save a members for Assignment
             */
            saveMembers() {
                this.formMembers.errors = [];

                this.$http.post('/api/teams/'+this.team_id+'/members/'+this.formMembers.assignment_id, this.formMembers)
                    .then(response => {
                        this.formMembers.members = [];
                        this.formMembers.errors = [];
                        $('#modal-edit-members').modal('hide');
                        this.messages = ['Assignment members saved.'];
                    })
                    .catch(response => {
                        if (typeof response.data === 'object') {
                            this.formNew.errors = _.flatten(_.toArray(response.data));
                        } else {
                            this.formNew.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            },

            /**
             * Create a new Assignment
             */
            createAssignment() {
                this.formNew.team_id = this.team_id;
                this.formNew.errors = [];

                this.$http.post('/api/teams/'+this.team_id+'/assignments', this.formNew)
                    .then(response => {
                        this.formNew.name = '';
                        this.formNew.errors = [];

                        this.assignments.push(response.data);
                        $('#modal-create-assignment').modal('hide');
                        this.messages = ['New Assignment Created.'];
                    })
                    .catch(response => {
                        if (typeof response.data === 'object') {
                            this.formNew.errors = _.flatten(_.toArray(response.data));
                        } else {
                            this.formNew.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            },

            /**
             * Update an Assignment
             */
            updateAssignment() {
                this.formEdit.errors = [];

                this.$http.post('/api/teams/'+this.team_id+'/assignments/'+this.formEdit.assignment_id, this.formEdit)
                    .then(response => {
                        this.formEdit.name = '';
                        this.formEdit.assignment_id = 1;
                        this.formNew.errors = [];
                        this.getAssignments();

                        $('#modal-update-assignment').modal('hide');
                        this.messages = ['Assignment has been updated'];
                    })
                    .catch(response => {
                        if (typeof response.data === 'object') {
                            this.formNew.errors = _.flatten(_.toArray(response.data));
                        } else {
                            this.formNew.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            },
        }
    }
</script>
