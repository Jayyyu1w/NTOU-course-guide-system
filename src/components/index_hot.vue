<script>
export default ({
    data: function () {
        return {
            course_info: [],
            hotSize: 3,
            curPage: 1,
            top_info: [],
            imgs: ['../imgsrc/medal1.png','../imgsrc/medal2.png','../imgsrc/medal3.png'],
        }
    },
    created: function () {
        axios.get("https://database--project.000webhostapp.com/get_hot.php") //發出http請求
            .then((res) => {
                this.course_info=res.data;
                this.top_info=this.course_info.slice((this.curPage*this.hotSize)-this.hotSize,(this.curPage*this.hotSize));
                this.top_info[0].img=this.imgs[0];
                this.top_info[1].img=this.imgs[1];
                this.top_info[2].img=this.imgs[2];
                this.top_info[0].star=this.top_info[0].hot;
                this.top_info[1].star=this.top_info[1].hot;
                this.top_info[2].star=this.top_info[2].hot;
                console.log(this.top_info);
            })
    },
    methods: {
        changeWeb: function (dis) {
            window.location.href = `course_info/course_info.html?course_ID=${dis.course_ID}&class=${dis.class}`;
        },
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
                    <img v-bind:src="course.img" style="width:23px; float: left;">
                    <h3 class="fw-bolder">&nbsp{{course.name}}</h3>
                    <h6>教師：{{ course.teacher }}</h6>
                    <h6 class="fw-bolder" style="float:left;">{{ course.star }}&nbsp&nbsp&nbsp</h6>
                    <div class="rating" style="float:left;">
                        <!--<input type="radio" name="rating" value="5" id="5">-->
                        <div v-if="course.star>=5"><label for="5" class="display">☆</label></div>
                        <div v-else><label for="5" class="no_display">☆</label></div>
                        
                        <!--<input type="radio" name="rating" value="4" id="4">-->
                        <div v-if="course.star>=4"><label for="4" class="display">☆</label></div>
                        <div v-else><label for="4" class="no_display">☆</label></div>

                        <!--<input type="radio" name="rating" value="3" id="3">-->
                        <div v-if="course.star>=3"><label for="3" class="display">☆</label></div>
                        <div v-else><label for="3" class="no_display">☆</label></div>

                        <!--<input type="radio" name="rating" value="2" id="2">-->
                        <div v-if="course.star>=2"><label for="2" class="display">☆</label></div>
                        <div v-else><label for="2" class="no_display">☆</label></div>

                        <!--<input type="radio" name="rating" value="1" id="1">-->
                        <div v-if="course.star>=1"><label for="1" class="display">☆</label></div>
                        <div v-else><label for="1" class="no_display">☆</label></div>
                    </div>
                    <h6 class="fw-bolder">&nbsp&nbsp(10)</h6>
                    <br>
                </li>
            </div>
        </ul>
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