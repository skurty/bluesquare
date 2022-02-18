<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <section v-if="error">
                    <p>Error to fetch the ticket details</p>
                </section>
                <section v-else>
                    <div v-if="loading">Loading...</div>
                    <b-alert variant="danger" :show="!ticket && !loading">No ticket found</b-alert>
                    <div v-if="ticket && !loading">
                        <b-form @submit="onSubmit" v-if="ticket && !loading">
                            <b-form-group
                                id="input-group-title"
                                label="Title:"
                                label-for="ticket-title"
                            >
                                <b-form-input
                                    id="ticket-title"
                                    v-model="ticket.title"
                                    type="text"
                                    placeholder="Enter title"
                                    required
                                ></b-form-input>
                            </b-form-group>
                            <b-form-group
                                id="input-group-type"
                                label="Type:"
                                label-for="ticket-type"
                            >
                                <b-form-select v-model="ticket.type" :options="types"></b-form-select>
                            </b-form-group>
                            <b-form-group
                                id="input-group-status"
                                label="Status:"
                                label-for="ticket-status"
                            >
                                <b-form-select v-model="ticket.status" :options="statutes"></b-form-select>
                            </b-form-group>
                            <b-form-group
                                id="input-group-priority"
                                label="Priority:"
                                label-for="ticket-priority"
                            >
                                <b-form-select v-model="ticket.priority" :options="priorities"></b-form-select>
                            </b-form-group>
                            <b-form-group id="input-group-description" label="Description:" label-for="ticket-description">
                                <b-form-textarea
                                    id="ticket-description"
                                    v-model="ticket.description"
                                    placeholder="Enter description"
                                    required
                                ></b-form-textarea>
                            </b-form-group>

                            <b-button type="submit" variant="primary">Save</b-button>
                        </b-form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    props: ['projectId', 'ticketId'],
    data: function() {
        return {
            loading: true,
            error: false,
            types: [
                { value: 1, text: 'Feature'},
                { value: 2, text: 'Bug'},
            ],
            statutes: [
                { value: 1, text: 'To do'},
                { value: 2, text: 'In progress'},
                { value: 3, text: 'Done'},
            ],
            priorities: [
                { value: 1, text: 'Low'},
                { value: 2, text: 'Medium'},
                { value: 3, text: 'High'},
            ]
        }
    },
    computed: {
        ...mapState({
            ticket: state => state.ticket.ticket
        })
    },
    methods: {
        getTicket(projectId, ticketId) {
            this.loading = true;
            let payload = {
                projectId: projectId,
                ticketId: ticketId
            };
            this.$store.dispatch('ticket/getTicket', payload)
                .then(response => {
                    this.loading = false;
                })
                .catch(error => {
                    console.error(error);
                    this.error = true;
                })
        },
        ...mapActions({
            updateTicket: 'ticket/updateTicket'
        }),
        async onSubmit(event) {
            event.preventDefault()

            this.updateTicket(this.ticketId)
                .then(async response => {
                    await this.$router.push({name: 'TicketDetails', params: {projectId: this.projectId, ticketId: this.ticketId}})
                    this.$store.dispatch('alert/success', 'Ticket updated')
                })
                .catch(error => {
                    console.log(error);
                    this.error = true;
                })
        },
    },
    created() {
        this.getTicket(this.projectId, this.ticketId)
    },
    beforeRouteUpdate(to, from, next) {
        this.getTicket(to.params.projectId, to.params.ticketId)
        next()
    }
};
</script>
