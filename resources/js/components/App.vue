<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="info">
            <b-navbar-brand href="#">Bluesquare</b-navbar-brand>
        </b-navbar>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <b-alert v-model="alert.show" :variant="alert.type">{{alert.message}}</b-alert>
                </div>
            </div>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    name: 'app',
    computed: {
        ...mapState({
            alert: state => state.alert
        })
    },
    methods: {
        ...mapActions({
            clearAlert: 'alert/clear'
        })
    },
    watch: {
        $route() {
            // clear alert on location change
            this.clearAlert();
        }
    }
};
</script>
