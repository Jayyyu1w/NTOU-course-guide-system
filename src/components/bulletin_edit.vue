<script>
export default ({
    data: function () {
        return {
            submit: {
                title: "",
                content: "",
                //course_ID: 1,
                class: 'A',
                class_name: "",
                sender: "",
                receiver: "",
                time: "",
                bulletin_ID: ""
            },
            courses: [],
            sz: 0
        }
    },
    created: function () {
        axios.get("https://database--project.000webhostapp.com/course.php")
            .then((res) => {
                this.courses = res.data;
            })
        /*axios.get("http://localhost:3000/bulletin")
            .then((res) => {
                this.sz=res.data.length;
                console.log(this.sz);
            }) // modify:get this bulletin_ID from php to update*/
    },  // add a new bulletin:get count of bulledtin to sz, add new bulletin(sz+1)
    methods: {
        click :function(){
            let yy = new Date().getFullYear();
            let mm = new Date().getMonth()+1;
            let dd = new Date().getDate();
            let hh = new Date().getHours();
            let mf = new Date().getMinutes()<10 ? '0'+new Date().getMinutes() : new Date().getMinutes();
            let ss = new Date().getSeconds()<10 ? '0'+new Date().getSeconds() : new Date().getSeconds();
            this.submit.title=this.$refs.title.value;
            this.submit.class_name=this.$refs.class_name.value;
            this.submit.sender=this.$refs.sender.value;
            this.submit.receiver=this.$refs.receiver.value;
            this.submit.class=this.$refs.class.value;
            this.submit.content=this.$refs.content.value;
            this.submit.time=yy+'-'+mm+'-'+dd+' '+hh+':'+mf+':'+ss
            this.submit.bulletin_ID=String(this.sz+1); // if you modify this billetin, why sz+1
            var out=JSON.stringify(this.submit);
            console.log(out);
            axios.post('https://database--project.000webhostapp.com/bulletin_add.php', out).then((res) => {
                console.log(res);
            });
            location.href='../bulletin/bulletin.html';
        }
    },
    mounted: function () {

    }
});
</script>

<template>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col">
            <form>
                <div class="mb-1">
                    <label class="form-label">標題</label>
                    <input type="text" class="form-control" ref="title" aria-describedby="title_help">
                    <div id="title_help" class="form-text">請輸入公告標題</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">課程名稱</label>
                    <select class="form-select" aria-label="Default select example" ref="class_name">
                        <option selected></option>
                        <option v-bind:value="course.name" v-for="course in courses">{{course.name}}</option>
                    </select>
                    <div id="class_help" class="form-text">請選擇課程名稱</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">班級</label>
                    <select class="form-select" aria-label="Default select example" ref="class">
                        <option selected></option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                    </select>
                    <div id="class_id_help" class="form-text">請選擇班級</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">發布者</label>
                    <input type="text" class="form-control" ref="sender" aria-describedby="sender_help">
                    <div id="sender_help" class="form-text">請輸入發布者</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">接收對象</label>
                    <input type="text" class="form-control" ref="receiver" aria-describedby="receiver_help">
                    <div id="receiver_help" class="form-text">請輸入接收對象</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">內容</label>
                    <textarea class="form-control" ref="content" rows="10" aria-describedby="content_help"></textarea>
                    <div id="content_help" class="form-text">請輸入內容</div>
                </div>
            </form>
            <button style="float:right;" @click="click">送出</button>
        </div>
        <div class="col-md-2"></div>
    </div>
</template>

<style>
</style>