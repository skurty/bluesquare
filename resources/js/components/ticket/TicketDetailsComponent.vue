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
                        <b-row style="margin-top: 10px">
                            <b-col cols="10">
                                <h3>{{ ticket.title }}</h3>
                            </b-col>
                            <b-col>
                                <router-link :to="{name: 'TicketUpdate'}">
                                    <b-button variant="outline-primary">Edit</b-button>
                                </router-link>
                            </b-col>
                        </b-row>
                        <b-row style="margin-top: 10px">
                            <b-col cols="2">Type:</b-col>
                            <b-col cols="2">
                                <b-badge v-if="ticket.type == 1" variant="primary">Feature</b-badge>
                                <b-badge v-if="ticket.type == 2" variant="warning">Bug</b-badge>
                            </b-col>
                        </b-row>
                        <b-row style="margin-top: 10px">
                            <b-col cols="2">Status:</b-col>
                            <b-col cols="2">
                                <b-badge v-if="ticket.status == 1" variant="light">To do</b-badge>
                                <b-badge v-if="ticket.status == 2" variant="primary">In progress</b-badge>
                                <b-badge v-if="ticket.status == 3" variant="success">Done</b-badge>
                            </b-col>
                        </b-row>
                        <b-row style="margin-top: 10px">
                            <b-col cols="2">Priority:</b-col>
                            <b-col cols="2">
                                <b-badge v-if="ticket.priority == 1" variant="light">Low</b-badge>
                                <b-badge v-if="ticket.priority == 2" variant="warning">Medium</b-badge>
                                <b-badge v-if="ticket.priority == 3" variant="danger">High</b-badge>
                            </b-col>
                        </b-row>
                        <b-row style="margin-top: 10px">
                            <b-col>Description:</b-col>
                        </b-row>
                        <b-row>
                            <b-col>{{ ticket.description }}</b-col>
                        </b-row>
                        <b-row style="margin-top: 20px">
                            <b-col>
                                <h5>Comments</h5>
                                <p v-if="!ticket.comments">No comments for now</p>
                                <div v-for="comment in ticket.comments"
                                     v-bind:key="comment.id">{{ comment.message }}</div>
                            </b-col>
                        </b-row>
                    </div>
                </section>
                <p style="margin-top: 20px">
                    <router-link :to="{name: 'TicketList', params: {projectId: this.projectId}}">Back</router-link>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
    props: ['projectId', 'ticketId'],
    data: function() {
        return {
            loading: true,
            error: false
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
