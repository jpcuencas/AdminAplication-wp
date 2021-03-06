<!DOCTYPE html>
<html lang="es">

    <head>

        <meta charset="utf-8">
		
		<meta name="description" content="{descripcion}"/>
		<meta name="keywords" content="{keywords}"/>
		<meta name="author" content="FiveDoorsNetwork"/>
        <title>{title}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster">
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Lato:400,700'>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Header -->
        <div class="container">
            <div class="header row">
                <div class="logo span4">
                    <h1><a href="#">{titulo}</a> <span>.</span></h1>
                </div>
                <div class="call-us span8">
                    <p>{textotelefono}<span>{telefono}</span> | {textoskype} <span>{skype}</span></p>
                </div>
            </div>
        </div>

        <!-- Coming Soon -->
        <div class="coming-soon">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="span12">
                            <h2>{subtitulo1}</h2>
                            <p>{texto1}</p>
                            <div class="timer">
                                <div class="days-wrapper">
                                    <span class="days"></span> <br>{dias}
                                </div>
                                <div class="hours-wrapper">
                                    <span class="hours"></span> <br>{horas}
                                </div>
                                <div class="minutes-wrapper">
                                    <span class="minutes"></span> <br>{minutos}
                                </div>
                                <div class="seconds-wrapper">
                                    <span class="seconds"></span> <br>{segundos}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="container">
            <div class="row">
                <div class="span12 subscribe">
                    <h3>{subtitulo2}</h3>
                    <p>{texto2}</p>
                    <form class="form-inline" action="assets/sendmail.php" method="post">
                        <input type="text" name="email" placeholder="Enter your email...">
                        <button type="submit" class="btn">{textoenviar}</button>
                    </form>
                    <div class="success-message"></div>
                    <div class="error-message"></div>
                </div>
            </div>
            <div class="row">
                <div class="span12 social">
                    <a href="{facebook}" class="facebook" rel="tooltip" data-placement="top" data-original-title="Facebook"></a>
                    <a href="{twitter}" class="twitter" rel="tooltip" data-placement="top" data-original-title="Twitter"></a>
                    <a href="{dribbble}" class="dribbble" rel="tooltip" data-placement="top" data-original-title="Dribbble"></a>
                    <a href="{google}" class="googleplus" rel="tooltip" data-placement="top" data-original-title="Google Plus"></a>
                    <a href="{pinterest}" class="pinterest" rel="tooltip" data-placement="top" data-original-title="Pinterest"></a>
                    <a href="{flickr}" class="flickr" rel="tooltip" data-placement="top" data-original-title="Flickr"></a>
                </div>
            </div>
        </div>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.8.2.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/jquery.countdown.js"></script>
        <script src="assets/js/scripts.js"></script>

    </body>

</html>

