<script>
export default ({
    data: function () {
        return {
            course_info: [],
            grade_1: [],
            grade_2: [],
            grade_3: [],
            grade_4: [],
            display_course: [],
            no_course: false,
            keyword: ""
        }
    },
    created: function () {
        axios.get("http://localhost:3000/course")
            .then((res) => {
                this.course_info = res.data;
                console.log(this.course_info);
                for (let item of this.course_info) {
                    if (item.grade == 1)
                        this.grade_1.push(item);
                    if (item.grade == 2)
                        this.grade_2.push(item);
                    if (item.grade == 3)
                        this.grade_3.push(item);
                    if (item.grade == 4)
                        this.grade_4.push(item);
                }
                this.display_course = this.grade_1;
                console.log(this.course_info);
                console.log(this.grade_1);
                console.log(this.grade_2);
                console.log(this.grade_3);
                console.log(this.grade_4);
            })
    },
    method: {
        searching: function () {
            this.display_course = [];
            for(let item of this.course_info){
                if(this.keyword == ""){
                    this.display_course.push(item);
                }else if(item.course_name.search(this.keyword) != -1){
                    this.display_course.push(item);
                }
            }
        }
    },
    mounted: function () {

    }
});
</script>

<template>
    <div class="container" id="courses">
        <form class="d-flex round-top">
            <input class="form-control me-2" type="search" placeholder="keyword" v-model="keyword" aria-label="Search">
            <button class="btn btn-outline-success" type="submit" @click="searching">🔍</button>
        </form>
        <div class="radio_group my-3">
            <span class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radiobutton" id="grade1" :value="display_course"
                    @input="display_course = grade_1" checked>
                <label class="form-check-label" for="grade1">
                    大一
                </label>
            </span>
            <span class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radiobutton" id="grade2" :value="display_course"
                    @input="display_course = grade_2">
                <label class="form-check-label" for="grade2">
                    大二
                </label>
            </span>
            <span class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radiobutton" id="grade3" :value="display_course"
                    @input="display_course = grade_3">
                <label class="form-check-label" for="grade3">
                    大三
                </label>
            </span>
            <span class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radiobutton" id="grade4" :value="display_course"
                    @input="display_course = grade_4">
                <label class="form-check-label" for="grade4">
                    大四
                </label>
            </span>
        </div>
        <div>
            <ul class="list-group course_style" id="course_list">
                <div v-for="dis in display_course">
                    <li class="list-group-item" v-if="dis != undefined">
                        <div class="container">
                            <div class="col">
                                <div class="row-md-8 pt-2">
                                    <p>
                                        <span class="h4">
                                            {{ dis.course_name }}
                                        </span>
                                        <span class="semester">
                                            {{ dis.semester }}
                                        </span>
                                    </p>
                                </div>
                                <div class="row-md-4">
                                    <div>課號：{{ dis.course_id }}</div>
                                    <div>資訊工程學系&nbsp;&nbsp;&nbsp;{{ dis.grade }}&nbsp;&nbsp;&nbsp;{{ dis.class }}</div>
                                    <div>
                                        必選修別：{{ dis.compulsory }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        學分數：{{ dis.credit }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        授課教師：{{ dis.teacher }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</template>

<style>
.course_style {
    font-size: 16px;
}

#course_list li {
    height: auto;
}

.semester {
    float: right;
}
</style>