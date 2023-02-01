<script>
import axios from 'axios';

export default ({
	data: function () {
		return {
			submit: {
				account: "",
				password: "",
			},
		}
	},
	methods: {
		click: function () {
			this.submit.account = this.$refs.account.value;
			this.submit.password = this.$refs.password.value;
			var out = JSON.stringify(this.submit);
			console.log(out);
			var name, authorization;
			axios.post('https://database--project.000webhostapp.com/login.php', out).then((res) => {
				console.log(res.data);
				var input = res.data;
				console.log(input);
				if (input == '登入失敗!') {
					alert('帳號或密碼錯誤!');
					return;
				}
				name = input.user_name;
				authorization = input.authorization;
				console.log(name);
				console.log(authorization);
				window.sessionStorage.setItem("userName", name);
				window.sessionStorage.setItem("authorization", authorization);
				alert(`歡迎${name}登入`);
				this.$router.push({ path: '/' })
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

<style>
#banner .masthead {
	height: 20vh;
	min-height: 230px;
	background-image: url('../assets/banner.png');
	background-size: cover;
	background-position: center;
	background-repeat: no-repeat;
}

.form-heading {
	color: #fff;
	font-size: 23px;
}

.panel h2 {
	color: #444444;
	font-weight: bold;
	font-style: normal;
	margin: 0 0 8px 0;
}

.panel p {
	color: #777777;
	font-size: 18px;
	margin-bottom: 30px;
	line-height: 24px;
}

.login-form .form-control {
	background: #f7f7f7 none repeat scroll 0 0;
	border: 1px solid #d4d4d4;
	border-radius: 4px;
	font-size: 14px;
	height: 50px;
	line-height: 50px;
}

.main-div {
	background: #ffffff none repeat scroll 0 0;
	border-radius: 2px;
	margin: 120px auto 30px;
	max-width: 40%;
	padding: 50px 70px 70px 71px;
	box-shadow: 2px 1px 2px 1px #444444;
	border-radius: 5px;
}

.login-form .form-group {
	margin-bottom: 10px;
}

.login-form {
	text-align: center;
}

.forgot a {
	color: #777777;
	font-size: 14px;
	text-decoration: underline;
}

.login-form .btn.btn-primary {
	background: #f0ad4e none repeat scroll 0 0;
	border-color: #f0ad4e;
	color: #ffffff;
	font-size: 14px;
	width: 100%;
	height: 50px;
	line-height: 50px;
	padding: 0;
}

.forgot {
	text-align: left;
	margin-bottom: 30px;
}

.login-form .btn.btn-primary.reset {
	background: #ff9900 none repeat scroll 0 0;
}

.back {
	text-align: left;
	margin-top: 10px;
}

.back a {
	color: #444444;
	font-size: 13px;
	text-decoration: none;
}
</style>