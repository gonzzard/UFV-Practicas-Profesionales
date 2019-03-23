<!DOCTYPE html>
<html>

<head>
	<title>Certificado de superación de prácticas profesionales</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; color: #00365f !important;">
	<div style="text-align: center;">
		<img src="{{ public_path('img/logo.jpg') }}" style="width:250px;">
	</div>
	<h1 style="text-align:center;">Certificado de superación de prácticas profesionales</h1>
	<br>
	<hr>
	<br>
	<p style="text-align: justify; text-justify: inter-word;">
		Pozuelo de Alarcón a {{$dia}} de {{$mes}} del {{$anyo}}:
	</p>
	<br>
	<p style="text-align: justify; text-justify: inter-word;">
		La Universidad Francisco de Vitoria certifica que el alumno {{mb_strtoupper($alumno, "UTF-8")}} ha superado satisfactoriamente
		el programa de prácticas profesionales {{mb_strtoupper($practica->denominacion, "UTF-8")}} ({{mb_strtoupper($practica->horasTotales)}}
		horas) correspondiente @if(isset($titulacion->titulacionPrincipal)) a la mención {{mb_strtoupper($titulacion->denominacion,
		"UTF-8")}} de la titulación {{mb_strtoupper($titulacion->titulacionPrincipal->denominacion, "UTF-8")}}, @else a la titulación
		{{mb_strtoupper($titulacion->denominacion, "UTF-8")}}, @endif con una nota de {{$asignacion->notaFinal / 100}} ({{$notaText}}).
	</p>
	<br>
	<p style="text-align: center;">
		Firmado, {{$director}}:
	</p>
	<p style="text-align: center;">
		<img src="{{ public_path('img/firma.png') }}" style="width:250px;">
	</p>
	<div style="position: absolute; bottom: 0; height: 40px; margin-top: 40px; font-size: x-small;">
		<br>
		<hr>
		<div style="text-align:center">
			Universidad Francisco de Vitoria. Carretera Pozuelo a Majadahonda, Km 1.800, 28223 Pozuelo de Alarcón, Madrid. {{$anyo}}.
		</div>
	</div>
</body>

</html>