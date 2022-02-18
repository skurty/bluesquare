<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <section v-if="error">
                    <p>Error to fetch the ticket list</p>
                </section>

                <section v-else>
                    <div v-if="loading">Loading...</div>
                    <div v-if="tickets && tickets.length === 0 && !loading">
                        Empty ticket list
                    </div>
                    <div v-if="tickets && tickets.length > 0 && !loading">
                        <h2>Project "{{ tickets[0].project.name }}"</h2>
                        <h5 style="margin-top: 20px">Ticket list:</h5>
                        <ul class="list-group">
                            <router-link :to="{name: 'TicketDetails', params: {projectId: ticket.project.id, ticketId: ticket.id}}" class="list-group-item list-group-item-action flex-column align-items-start"
                                         v-for="ticket in tickets"
                                         v-bind:key="ticket.id">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ ticket.title }}</h5>
                                </div>
                                <p class="mb-1">{{ ticket.description }}</p>
                            </router-link>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    data: function() {
        return {
            loading: true,
            error: false
        }
    },
    computed: {
        ...mapState({
            tickets: state => state.ticket.tickets
        })
    },
    methods: {
        ...mapActions({
            loadTickets: 'ticket/loadTickets'
        })
    },
    mounted () {
        this.loading = true;
        this.loadTickets(this.$route.params.projectId)
            .then(response => {
                this.loading = false;
            })
            .catch(error => {
                console.error(error);
                this.error = true;
            })
    }
};
</script>
