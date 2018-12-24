<!DOCTYPE html>
<html>
<head>
	<title>All User</title>
</head>
<body>
	<table border="1">
		<tr>
			<td>Id</td>
			<td>Username</td>
			<td>Email</td>
			<td>Password</td>
			<td>Delete</td>
		</tr>
		<?php foreach($users as $user):  ?>
			<tr>
				<td><?php echo $user['id']; ?></td>
				<td><?php echo $user['username']; ?></td>
				<td><?php echo $user['email']; ?></td>
				<td><?php echo $user['password']; ?></td>
				<td>
					<form action="/ProjectOOP/user/<?php echo $user['id']; ?>" method="post">
						<input type="hidden" name="_method" value="delete">
						<button>Xóa</button>
					</form>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>
