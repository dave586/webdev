<?php



/**
 * Generate head for HTML pages
 * @param $title STRING title to use for HTML pages
 * @return string generated HTML
 */
function generateHead($title)
{
    $output = '<head>
    <meta charset=utf-8>
    <title>'.$title.'</title>
    <link href=\'https://fonts.googleapis.com/css?family=Merriweather\' rel=\'stylesheet\' type=\'text/css\'>
    <link href=\'https://fonts.googleapis.com/css?family=Open+Sans\' rel=\'stylesheet\' type=\'text/css\'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
    <script src="js/misc.js"></script>
    <script src="js/searchFunction.js"></script>
    <script type="text/javascript">
        window.jQuery ||
        document.write(\'<script src="js/jquery-3.1.1.min.js"><\/script>\');
    </script>

    <link href="css/semantic.css" rel="stylesheet">
    <link href="css/icon.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/mystyles.css" rel="stylesheet">

</head>';


    return $output;
}

?>