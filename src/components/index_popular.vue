<script>
export default {
    data() {
        return {
            popular_course: [],
        }
    },
    created() {
        axios.get("http://localhost:3000/top_course")
        .then((res) => {
            console.log(res.data);
            this.popular_course = res.data;
        })
    },
    methods: {

    },
    mounted() {

    }
}
</script>

<template>
    <div id="popular" class="border" v-for="pop of popular_course">
        <h4>{{pop.course_name}}</h4>
    </div>
</template>