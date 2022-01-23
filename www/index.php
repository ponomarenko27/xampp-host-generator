<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<style>
			body
			{
				font-size: 1.25rem;
			}
		</style>
	</head>
	<body>
		<table width="100%" cellpadding="30">
			<tr>
				<td>Usefull Links</td>
				<td><a href="/show-vhosts.php">Show Local Domains</a></td>
				<td><a href="http://localhost/phpmyadmin/">phpMyAdmin</a></td>
				<td><a href="/phpinfo.php">phpinfo()</a></td>
				<td><input value="file:///C:/xampp/apache/logs/" type="text" id="error_log_input" onclick="copy_error_log_input()" /></td>
			</tr>
			<tr style="background: #cccccc;">
				<td>------</td>
				<td>------</td>
				<td>------</td>
				<td>------</td>
				<td>------</td>
			</tr>
			<tr>
				<td>vHosts file (XAMPP Config)</td>
				<td><a href="/look-vhosts.php">Look</a></td>
				<td><a href="/generate-vhosts.php">Generate</a></td>
				<td><a href="/cleanup-vhosts.php">Clean Up</a></td>
				<td><a href="/set-default-vhosts.php">Set Default</a></td>
			</tr>
			<tr style="background: #cccccc;">
				<td>------</td>
				<td>------</td>
				<td>------</td>
				<td>------</td>
				<td>------</td>
			</tr>
			<tr>
				<td>Hosts file (OS)</td>
				<td><a href="/look-hosts.php">Look</a></td>
				<td><a href="/generate-hosts.php">Generate</a></td>
				<td><a href="/cleanup-hosts.php">Clean Up</a></td>
				<td><a href="/set-default-hosts.php">Set Default</a></td>
			</tr>
		</table>
		<script type="text/javascript">
			function copy_error_log_input() {
				/* Get the text field */
				var copyText = document.getElementById("error_log_input");
				/* Select the text field */
				copyText.select();
				copyText.setSelectionRange(0, 99999); /* For mobile devices */
				/* Requires HTTPS protocol. Copy the text inside the text field */
				navigator.clipboard.writeText(copyText.value);
				/* Alert the copied text */
				alert("Copied to clipboard: " + copyText.value);
			}
		</script>
	</body>
</html>
