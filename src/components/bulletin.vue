<script>
export default ({
    data: function () {
        return {
            bulletin_info: [],
            totBulletin: 0,
            pageSize: 10,
            curPage: 1,
            cut: [],
            totPage: 0
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
                    this.totBulletin+=1;
                }
                this.slice(1);
                this.totPage=Math.ceil(this.totBulletin/this.pageSize);
                console.log(this.totPage);
            })
    },
    methods: {
        slice :function(cur){
            window.scrollTo(0, 0);
            console.log(cur);
            this.curPage=cur;
            this.cut=this.bulletin_info.slice((this.curPage*this.pageSize)-this.pageSize,(this.curPage*this.pageSize))
        }
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
                        <div v-for="info in cut">
                            <div class="accordion-item">
                                <div class="accordion-header" v-bind:id="info.headid">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        v-bind:data-bs-target="info.actbody" aria-expanded="true" v-bind:aria-controls="info.bodyid">
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
                        <li class="page-item" v-for="n in this.totPage" >
                            <button class="page-link" @click="slice(n)">{{n}}</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</template>

<style>
</style>