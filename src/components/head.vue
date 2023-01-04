<script>
export default ({
    data: function () {
        return {
            userName: null
        }
    },
    created: function () {
        this.userName = window.sessionStorage.getItem('userName');
        this.authorization = window.sessionStorage.getItem('authorization');
        console.log(this.userName);
    },
    methods: {
        logout :function(){
            window.sessionStorage.removeItem('userName');
            window.sessionStorage.removeItem('authorization');
            this.userName=null;
            location.href='../index.html';
        }
    },
    mounted: function () {

    }
});
</script>

<template>
    <section id="banner">
        <div class="masthead">
            <div class="container">
                <div class="row h-100 align-items-center">
                </div>
            </div>
        </div>
    </section>
    <section id="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
            <div class="container mt-1 mb-1">
                <a class="navbar-brand header_font" href="../index.html">資工課程導覽</a>
                <a class="navbar-brand" href="https://www.ntou.edu.tw/" target="_blank">
                    <img src="../imgsrc/ntou.png" width="150" height="30" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.html">首頁</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../all_course/all_course.html">所有課程</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../bulletin/bulletin.html">所有公告</a>
                        </li>
                        <li class="nav-item">
                            <div v-if="this.userName!=null&&this.userName!='登入失敗!'">
                                <a v-if="this.authorization==1" class="nav-link" href="https://database--project.000webhostapp.com/get_log_2.php">({{ userName }})</a>
                                <a v-else class="nav-link" href="#">({{ userName }})</a>
                            </div>
                            <div v-else>
                                <a class="nav-link" href="../login/login.html" >登入</a>
                            </div>
                        </li>
                        <div v-if="this.userName!=null&&this.userName!='登入失敗!'">
                            <li class="nav-item">
                                <a class="nav-link" href="#" @click="logout">登出</a>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </section>
</template>

<style>

</style>