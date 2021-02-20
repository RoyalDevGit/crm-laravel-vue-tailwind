<template>
    <div>
        <p class="text-xs text-red-500" v-for="(error,index) in errorFor()" :key="fieldValue + index">
            {{ error }}
        </p>
    </div>
</template>
<script>
export default {
    name : 'ValidationErrorHelp',
    props: [
        'errors',
        'status',
        'fieldValue'
    ],
    methods : {
        errorFor(){
            return this.hasErrors && this.errors[this.fieldValue] ? this.errors[this.fieldValue] : null;
        }
    },
    computed : {
        hasErrors(){
            return 422 === this.status && this.errors != null;
        },
    }
}
</script>
