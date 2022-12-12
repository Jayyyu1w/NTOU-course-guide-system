<script>

export default {
    data: function () {
        return {
            inform: [],
        }
    },
    methods: {

    },
    mounted: function () {
        axios.get("http://localhost:3000/notify") //發出http請求
            .then((res) => {
                console.log(res);
                this.inform = res.data;
            })
    },
}
</script>

<template>
    <div id="notification">
        <ul>
            <li v-for="notify in inform">
                <h3>{{ notify.notify_title }}</h3>
                <p>{{ notify.notify_content }}</p>
            </li>
        </ul>
    </div>
</template>