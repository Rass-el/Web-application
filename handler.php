<!DOCTYPE html>
<html>
    <head>
        <title>Answer</title>
        <link rel="stylesheet" href="styles/styles.css">
    </head>
    <body>
        
    <?php
            $startTime = microtime();
            $x = $_GET["coordinateX"];
            $r = $_GET["radius"];
            $y = $_GET["Y"];

            if (validateX($x) && validateY($y) && validateR($r)) {
                $x = (float)$x;
                $y = (float)$y;
                $r = (float)$r;
                printf ("
                    <p>
                        <table border='1'>
                            <tr>
                                <td>X</td>
                                <td>$x</td>
                            </tr>
                            <tr>
                                <td>Y</td>
                                <td>$y</td>
                            </tr>
                            <tr>
                                <td>R</td>
                                <td>$r</td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                ");
                                isInside($x, $y, $r);
                printf ("
                                </td>
                            </tr>
                        </table>
                    </p>
                ");
                
                
            }
            $endTime = microtime();
                $time = round( ($endTime - $startTime)* 1000, 5 );
                printf ("<br> time = $time ms");


            function validateX($x) {
                if (!is_numeric($x) && $x != -2 && $x != -1.5 && $x != -1 && $x != -0.5 && $x != 0 && $x != 0.5 && $x != 1 && $x != 1.5 && $x != 2) {
                    print "x is not valid!";
                    return false;
                }
                return true;
            }
            function validateY($y) {
                if (!is_numeric($y) || $y >= 3 || $y <= -3) {
                    print "y is not valid!";
                    return false;
                }
                return true;
            }
            function validateR($r) {
                if (!is_numeric($r) && $r != 1 && $r != 1.5 && $r != 2 && $r != 2.5 && $r != 3) {
                    print "r is not valid!";
                    return false;
                }
                return true;
            }
            function isInside($x, $y, $z) {
                // check rectangle area
                if ($x <= 0 && $x >= -$r && $y <= $r/2 && $y >= 0) {
                    print "Point inside!";
                    return true;
                }
                // check triangle area
                if ($x >= 0 && $x <= $r/2 && $y <= $r/2 && $y >= 0 && $x <= -$y + 2) {
                    print "Point inside!";
                    return true;
                }
                // check circle area
                if ($x >= 0 && $x <= $r/2 && $y >= -$r/2 && $y <= 0 && $x*$x + $y*$y <= $r*$r/4) {
                    print "Point inside!";
                    return true;
                }
                print "Point outside!";
                return false;
            }
        ?>   
    </body>  
</html> 