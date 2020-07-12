<!-- Dropdown login container -->
<div id="loginContainer" class="headerStyle hiddenByDefault">	
	<div id="loginFailed" class="alert alert-danger bAlert hiddenByDefault" role="alert">Incorrect username or password!</div>
	<form onsubmit="return proccessInput()" id="loginForm">
		<label for="text">Username: </label>
		<input type="text" name="username" minlength="2" maxlength="15" required>
		<br>
		<label for="password">Password: </label>
		<input type="password" name="password" minlength="2" maxlength="15" required>
		<br>
		<input type="submit" value="Submit" id="loginBut" class="headerStyle effects">
	</form>
</div>