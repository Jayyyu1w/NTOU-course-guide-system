<script>
    export default({
        data: function () {
            return {
                submit: {
                    account: "",
                    password: "",
                },
            }
        },
        methods: {
            click :function(){
                this.submit.account=this.$refs.account.value;
                this.submit.password=this.$refs.password.value;
                var out=JSON.stringify(this.submit);
                console.log(out);
                var name,authorization;
                axios.post('https://database--project.000webhostapp.com/login.php', out).then((res) => {
                    console.log(res.data);
                    var input=res.data;
                    name=input.user_name;
                    authorization=input.authorization;
                    console.log(name);
                    console.log(authorization);
                    window.sessionStorage.setItem("userName",name);
                    window.sessionStorage.setItem("authorization",authorization);
                    location.href='../index.html';
                });
                //console.log(window.sessionStorage);
            }
        },
        mounted: function () {

        },
    });
</script>

<template>
    <section id="login">
        <div class="container">
            <div class="login-form">
                <div class="main-div border">
                    <div class="panel">
                        <h2>登入</h2>
                        <p>請輸入帳號密碼</p>
                    </div>
                    <form id="Login">
                        <div class="form-group">
                            <input type="text" ref="account" class="form-control" id="inputEmail" placeholder="User Name">
                        </div>
                        <div class="form-group">
                            <input type="password" ref="password" class="form-control" id="inputPassword" placeholder="Password">
                        </div>
                    </form>
                    <button type="submit" class="btn btn-primary" @click="click">登入</button>
                </div>
            </div>
        </div>
    </section>
</template>