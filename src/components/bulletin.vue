<script>
export default ({
    data: function () {
        return {
            bulletin_info: []
        }
    },
    created: function () {
        axios.get("http://localhost:3000/bulletin")
            .then((res) => {
                this.bulletin_info=res.data;
                for (let item of this.bulletin_info) {
                    item.headid="head"+item.bulletin_ID;
                    item.bodyid="body"+item.bulletin_ID;
                    item.actbody="#"+item.bodyid;
                }
                console.log(this.bulletin_info);
            })
    },
    methods: {
        
    },
    mounted: function () {

    }
});
</script>

<template>
    <div class="container mt-5">
            <div class="row">
                <div class="row">
                    <div class="text-center">
                        <h3 class="fw-bolder">所有公告</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="accordion" id="bulletin">
                        <div v-for="info in bulletin_info">
                            <div class="accordion-item">
                                <div class="accordion-header" v-bind:id="info.headid">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        v-bind:data-bs-target="info.actbody" aria-expanded="false" v-bind:aria-controls="info.bodyid">
                                        <strong>{{ info.title }}</strong>
                                    </button>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="text-secondary">
                                                &nbsp;&nbsp;&nbsp;
                                                {{ info.class_name }}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="text-secondary">
                                                發布者：{{ info.sender }}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="text-secondary">
                                                對象：{{ info.receiver }}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="text-secondary">
                                                {{ info.time }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-bind:id="info.bodyid" class="accordion-collapse collapse" v-bind:aria-labelledby="info.headid"
                                    data-bs-parent="#bulletin">
                                    <div class="accordion-body">
                                        {{ info.content }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</template>

<style>
</style>