<!DOCTYPE html>
<html lang="fr-CA">
	<head>
		<meta charset="utf-8">
		<style type="text/css">
		body {
		  font-family: Arial, sans-serif;
		  font-size: 12pt;
		}
		</style>
	</head>
	<body>
		<table width="400" border="0" align="center" cellpadding="10" cellspacing="0">
            <tr>
                <td bgcolor="#333333" style="font-family: Arial, Helvetica, sans-serif; font-size: 18pt; color: #FFF;"><strong>Tech Portail</strong></td>
            </tr>
            <tr>
                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12pt;">
                    <p>Vous avez demandé à réinitialiser votre mot de passe. </p>
                    <p>Veuillez cliquer sur le lien suivant pour réinitialiser votre mot de passe:</p>
                    <p><a href="<?php echo route('portal.users.getreset', array($token)); ?>"><?php echo route('portal.users.getreset', array($token)); ?></a></p>
                    <p>Ce lien expire dans {{ Config::get('auth.reminder.expire', 60) }} minutes.</p>
                    <p>Si vous n'avez pas demandé à réinitialiser votre mot de passe, vous pouvez ignorer ce courriel.</p>
                </td>
            </tr>
            <tr>
                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #999">
                    <p>Tech Portail, le portail d'Équipe Team 3990: Tech for Kids. </p>
                    <p>Ce message est un courriel automatisé pour vous indiquer comment procéder pour réinitialiser votre mot de passe. Si vous n'avez pas fait une telle demande, veuillez ignorer ce courriel. Veuillez ne pas répondre à ce courriel. </p>
                </td>
            </tr>
        </table>
	</body>
</html>
