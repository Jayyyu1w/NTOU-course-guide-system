<script>
    export default{
        data: function () {
            return {

            }
        },
        methods: {
            
        },
        mounted: function () {

        },
    }
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
                            <input type="text" class="form-control" id="inputEmail" placeholder="User Name">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">登入</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>