<template>
    <div>
        <v-btn @click="$emit('continue')" color="info">Continue</v-btn>
        <v-btn @click="$emit('skip')">Skip this step</v-btn>
        <v-btn @click="$emit('back')" depressed color="#fff" v-if="!hideBack">Back</v-btn>
    </div>
</template>
<script>
export default {
    props: ['hideBack']
}
</script>
