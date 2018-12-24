<!DOCTYPE html>
<html>
<head>
	<title>user</title>
	<style type="text/css">
		#btn-add-user {
			background-color: blue;
			width: 40px;
			height: 15px;
			padding: 5px;
			text-align: center;
			border-radius: 4px;
			color: #fff;
			cursor: pointer;
		}
		.add-user:hover {
			opacity: 0.6;
		}
		.input {
			display: block;
			padding: 5px;
			border: 1px solid #eee;
			border-radius: 5px;
			margin-bottom: 10px;
		}
	</style>
	
</head>
<body>
	<form action="/ProjectOOP/user" method="post" id="form-add-user">
		<label for="username">Username: </label>
		<input type="text" name="username" id="username" class="input">
		<label for="email">Email: </label>
		<input type="text" name="email" id="email" class="input">
		<label for="password">Password: </label>
		<input type="text" name="password" id="password" class="input">
		<div id="btn-add-user">Add</div>
	</form>

	<script>
		let buttonAddUser = document.getElementById('btn-add-user');

		buttonAddUser.onclick = function() {
			document.getElementById('form-add-user').submit();
		};
	</script>
</body>
</html>
