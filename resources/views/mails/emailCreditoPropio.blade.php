<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo $subject; ?></title>
</head>

<body>
	<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" style="margin:0 auto; border:1px solid #444;">
		<tr>
			<td>
				<span style="color:#00B0F0;font-size:18px;font-weight:bold;">DATOS CRÉDITO PROPIO</span>
			</td>
			<td>
				<img src="{{ $STATICS }}images/garbarino-viajes-logo.png">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div style="padding-bottom:15px;border-bottom:1px solid #444;">
					<table>
						<tr>
							<td><b>Nombre y Apellido del cliente:</b></td>
							<td><?php echo $clientName; ?></td>
						</tr>
						<tr>
							<td><b>Tipo y número de documento:</b></td>
							<td><?php echo $clave; ?> <?php echo $cuil; ?></td>
						</tr>
						<tr>
							<td><b>Teléfono:</b></td>
							<td><?php echo $telefono; ?></td>
						</tr>
						<tr>
							<td><b>E-mail:</b></td>
							<td><?php echo $email; ?></td>
						</tr>
						<tr>
							<td><b>Banco emisor:</b></td>
							<td><?php echo $bancoName; ?></td>
						</tr>
						<tr>
							<td><b>Tarjeta de crédito:</b></td>
							<td><?php echo $tarjetaName; ?></td>
						</tr>
						<tr>
							<td><b>Cantidad de cuotas:</b></td>
							<td><?php echo $cuotasQty; ?></td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>

	[RefID: <?php echo $bookingId; ?>
</body>
</html>