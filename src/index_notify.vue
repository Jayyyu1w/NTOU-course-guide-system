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
                let limit = 3;
                for (let i = 0; i < Math.min(res.data.length, limit); i++) {
                    this.inform.push(res.data[i]);
                }
            })
    },
}
</script>

<template>
    <div id="notification">
        <div v-for="notify in inform" class="notifies">
            <div>
                <h3>{{ notify.notify_title }}</h3>
                <p>{{ notify.notify_content }}</p>
            </div>
        </div>
        <a href="bulletin.html" class="more">>&nbsp;更多...</a>
    </div>
</template>

<style>
.more {
    text-decoration: none;
    color: navy;
    float: right;
}

.notifies :hover {
    background-color: #E0E0E0;
    user-select: none;
    cursor: pointer;
}
</style>