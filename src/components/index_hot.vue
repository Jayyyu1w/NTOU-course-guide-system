<script>
export default ({
    data: function () {
        return {
            course_info: [],
            hotSize: 3,
            curPage: 1,
            top_info: [],
            imgs: ['medal1.png', 'medal2.png', 'medal3.png'],
            card: ['card_back.png', 'dian_zhi_da_lo.jpeg'],
            curCard: 'card_back.png'
        }
    },
    created: function () {
        axios.get("https://database--project.000webhostapp.com/get_hot.php") //發出http請求
            .then((res) => {
                this.course_info = res.data;
                console.log(res.data);
                this.top_info = this.course_info.slice((this.curPage * this.hotSize) - this.hotSize, (this.curPage * this.hotSize));
                this.top_info[0].img = this.imgs[0];
                this.top_info[1].img = this.imgs[1];
                this.top_info[2].img = this.imgs[2];
                this.top_info[0].star = this.top_info[0].hot.toFixed(2);
                this.top_info[1].star = this.top_info[1].hot.toFixed(2);
                this.top_info[2].star = this.top_info[2].hot.toFixed(2);
                console.log(this.top_info);
            })
    },
    methods: {
        changeWeb: function (dis) {
            window.location.href = `course_info/course_info.html?course_ID=${dis.course_ID}&class=${dis.class}`;
        },
        changeCardFront: function () {
            this.curCard = this.card[1];
        },
        changeCardBack: function () {
            this.curCard = this.card[0];
        }
    },
    mounted: function () {

    }
});
</script>

<template>
    <div class="container">
        <ul class="list-group">
            <div v-for="course of top_info">
                <li class="list-group-item" @click="changeWeb(course)">
                    <img v-bind:src="'https://database--project.000webhostapp.com/img/' + course.img"
                        style="width:23px; float: left;">
                    <h3 class="fw-bolder">&nbsp{{ course.name }}</h3>
                    <h6>教師：{{ course.teacher }}</h6>
                    <h6 class="fw-bolder" style="float:left;">{{ course.star }}&nbsp&nbsp&nbsp</h6>
                    <div class="rating" style="float:left;">
                        <div v-if="course.star >= 5"><label for="5" class="display">☆</label></div>
                        <div v-else><label for="5" class="no_display">☆</label></div>

                        <div v-if="course.star >= 4"><label for="4" class="display">☆</label></div>
                        <div v-else><label for="4" class="no_display">☆</label></div>

                        <div v-if="course.star >= 3"><label for="3" class="display">☆</label></div>
                        <div v-else><label for="3" class="no_display">☆</label></div>

                        <div v-if="course.star >= 2"><label for="2" class="display">☆</label></div>
                        <div v-else><label for="2" class="no_display">☆</label></div>

                        <div v-if="course.star >= 1"><label for="1" class="display">☆</label></div>
                        <div v-else><label for="1" class="no_display">☆</label></div>
                    </div>
                    <h6 class="fw-bolder">&nbsp&nbsp({{ course.count }})</h6>
                    <br>
                </li>
            </div>
        </ul>
        <br>
        <br>
        <a href="https://reurl.cc/Wq7la9" target="blank"><button type="button"
                class="btn btn-outline-primary">查看簡報</button></a>
        <br>
        <br>
        <img src="https://database--project.000webhostapp.com/img/qrcode.png" style="width: 200px">
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col">
                <a href="https://cse.ntou.edu.tw/" target="_blank">
                    <img v-bind:src="'https://database--project.000webhostapp.com/img/' + this.curCard"
                        style="width:300px" @mouseover="changeCardFront" @mouseleave="changeCardBack">
                </a>
            </div>
        </div>
    </div>
</template>

<style>
.rating {
    display: flex;
    margin-top: -10px;
    flex-direction: row-reverse;
    margin-left: -4px;
    float: left
}

.rating>div>label {
    position: relative;
    width: 19px;
    font-size: 25px;
    color: #ffdd00;
    cursor: pointer
}

.display::before {
    content: "\2605";
    position: absolute;
    opacity: 1;
}

.no_display::before {
    content: "\2605";
    position: absolute;
    opacity: 0;
}
</style>