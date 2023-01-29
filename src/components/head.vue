<script>
import { RouterLink, RouterView} from 'vue-router';

export default ({
    data: function () {
        return {
            userName: null,
            authorization: null,
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
                <RouterLink class="navbar-brand header_font" to="/">資工課程導覽</RouterLink>
                <a class="navbar-brand" href="https://www.ntou.edu.tw/" target="_blank">
                    <img src="../assets/ntou.png" width="150" height="30" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <RouterLink class="nav-link active" aria-current="page" to="/">首頁</RouterLink>
                        </li>
                        <li class="nav-item">
                            <RouterLink class="nav-link" to="/all_course">所有課程</RouterLink>
                        </li>
                        <li class="nav-item">
                            <RouterLink class="nav-link" to="/bulletin">所有公告</RouterLink>
                        </li>
                        <li class="nav-item">
                            <div v-if="this.userName!=null">
                                <a v-if="this.authorization==1" class="nav-link" href="https://database--project.000webhostapp.com/get_log_2.php">({{ userName }})</a>
                                <a v-else class="nav-link" href="#">({{ userName }})</a>
                            </div>
                            <div v-else>
                                <RouterLink class="nav-link" to="/login" >登入</RouterLink>
                            </div>
                        </li>
                        <div v-if="this.userName!=null">
                            <li class="nav-item">
                                <a class="nav-link" href="#" @click="logout">登出</a>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </section>
    <RouterView />
</template>

<style>
#banner .masthead {
    height: 20vh;
    min-height: 230px;
    background-image: url('../assets/banner.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.header_font{
    font-weight:bold;
    font-size: 28px
}
</style>