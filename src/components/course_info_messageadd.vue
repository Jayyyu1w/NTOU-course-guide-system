<script>
export default ({
    data: function () {
        return {
            submit: {
                text: "",
                time: "",
                hot: 0
            },
            class_ID: "",
            class: "",
            star: 0,
            sz: 0,
            isLogin: false,
            imgs: ['mark (1).png', 'mark (2).png', 'mark (3).png', 'mark (4).png', 'mark (5).png', 'mark (6).png', 'mark (7).png', 'mark (8).png', 'mark (9).png'],
        }
    },
    created: function () {
        let getUrlString = location.href;
        let url = new URL(getUrlString);
        this.class_ID = url.searchParams.get('course_ID');
        this.class = url.searchParams.get('class');
        this.isLogin = window.sessionStorage.length;
    },
    methods: {
        click: function () {
            let yy = new Date().getFullYear();
            let mm = new Date().getMonth() + 1;
            let dd = new Date().getDate();
            let hh = new Date().getHours();
            let mf = new Date().getMinutes() < 10 ? '0' + new Date().getMinutes() : new Date().getMinutes();
            let ss = new Date().getSeconds() < 10 ? '0' + new Date().getSeconds() : new Date().getSeconds();
            this.submit.text = this.$refs.text.value;
            this.submit.hot = this.star;
            this.submit.time = yy + '-' + mm + '-' + dd + ' ' + hh + ':' + mf + ':' + ss;
            var out = JSON.stringify(this.submit);
            console.log(out);
            var links = "https://database--project.000webhostapp.com/message_add.php?course_ID=" + this.class_ID + "&class=" + this.class;
            axios.post(links, out).then((res) => {
                console.log(res);
                location.href = 'course_info.html?course_ID=' + this.class_ID + "&class=" + this.class;
            });
        },
        clickStar: function (rate) {
            this.star = rate;
        }
    },
    mounted: function () {
        let idx = Math.floor(Math.random() * 9);
        $('#pic').attr('src', `https://database--project.000webhostapp.com/img/${this.imgs[idx]}`)
    }
});
</script>

<template>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card col-md-8">
                    <div class="row">
                        <div class="col-2">
                            <img src="" id="pic" width="70" class="rounded-circle mt-2">
                        </div>
                        <div class="col-10">
                            <div class="comment-box ml-2">
                                <h4>Add a comment</h4>
                                <div class="rating">
                                    <input type="radio" name="rating" value="5" id="5"><label for="5"
                                        @click="clickStar(5)">☆</label>
                                    <input type="radio" name="rating" value="4" id="4"><label for="4"
                                        @click="clickStar(4)">☆</label>
                                    <input type="radio" name="rating" value="3" id="3"><label for="3"
                                        @click="clickStar(3)">☆</label>
                                    <input type="radio" name="rating" value="2" id="2"><label for="2"
                                        @click="clickStar(2)">☆</label>
                                    <input type="radio" name="rating" value="1" id="1"><label for="1"
                                        @click="clickStar(1)">☆</label>
                                </div>
                                <div class="comment-area">
                                    <textarea v-if="isLogin != 0" class="form-control" ref="text"
                                        placeholder="留下你的看法" rows="3"></textarea>
                                    <textarea v-else class="form-control" ref="text"
                                        placeholder="請登入以留言" rows="3" disabled></textarea>
                                </div>
                                <div class="comment-btns mt-2 float-right">
                                    <button v-if="isLogin != 0" class="btn btn-primary send btn-sm" @click="click">送出
                                        <i class="fa fa-long-arrow-right ml-1"></i>
                                    </button>
                                    <button v-else class="btn send btn-sm" @click="click" disabled>送出
                                        <i class="fa fa-long-arrow-right ml-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>

</style>