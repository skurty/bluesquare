<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <section v-if="error">
                    <p>Error to fetch the project list</p>
                </section>

                <section v-else>
                    <div v-if="loading">Loading...</div>
                    <div v-if="projects && projects.length === 0 && !loading">
                        Empty project list
                    </div>
                    <ul class="list-group" v-if="projects && projects.length > 0 && !loading">
                        <router-link :to="{name: 'TicketList', params: {projectId: project.id}}" class="list-group-item list-group-item-action flex-column align-items-start"
                                     v-for="project in projects"
                                     v-bind:key="project.id">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ project.name }}</h5>
                            </div>
                        </router-link>
                    </ul>
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
            projects: state => state.project.projects
        })
    },
    methods: {
        ...mapActions({
            loadProjects: 'project/loadProjects'
        })
    },
    mounted () {
        this.loading = true;
        this.loadProjects()
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
