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
                    <p>Bonjour <?php echo $user->first_name; ?>!</p>
                    <p>On vous demande de confirmer votre présence pour: </p>
                    <p><strong><?php echo $event->title; ?></strong><br />
                    le <?php echo $event->datetime_start; ?>, de <?php echo $event->datetime_start; ?> à <?php echo $event->datetime_end; ?></p>
                    <p>Cliquez ici pour confirmer votre présence à la rencontre:</p>
                    <p></p>
                    <p style="color:#F00"><strong> Il est très important de confirmer sa présence en cliquant sur le lien ci-dessus. </strong></p>
                    <p>Merci!</p>
                </td>
            </tr>
            <tr>
                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #999">
                    <p>Tech Portail, le portail d'Équipe Team 3990: Tech for Kids. </p>
                    <p>Ce message est un courriel automatisé pour vous aviser qu'un nouvel évènement a été créé sur Tech Portail et que votre confirmation de présence ou d'absence est requise. Veuillez ne pas répondre à ce courriel. </p>
                </td>
            </tr>
        </table>
	</body>
</html>
