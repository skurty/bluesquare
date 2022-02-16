<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{ message }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            message: 'Hello world!'
        }
    }
};
</script>
