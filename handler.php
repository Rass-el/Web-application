<!DOCTYPE html>
<html>
    <head>
        <title>Answer</title>
        <link rel="stylesheet" href="styles/styles.css">
    </head>
    <body>

    <p class="center">
        <img src="images/area.png" alt="Area" width="270px" height="270px">
    </p>
    <?php
            $startTime = microtime();

            $x = $_GET["coordinateX"];
            $r = htmlspecialchars($_GET["radius"]);
            $y = htmlspecialchars($_GET["Y"]);
    
            for($i = 0; $i < count($x); ++$i) {
                $x[$i] = substr(htmlspecialchars($x[$i]), 0, 16);
            }
            $y = substr($y, 0, 16);
            $r = substr($r, 0, 16);

            for($i = 0; $i < count($x); ++$i) {
                if ( validateX($x[$i], $i) ) {
                    $x[$i] = (float)substr(htmlspecialchars($x[$i]), 0, 16);
                    $valid_points[$i] = true;
                }
            }
            
            if ( validateY($y) ) {
                $y = (float)$y;
            } else {
                for ($i = 0; $i < count($x); ++$i) {
                    $valid_points[$i] = false;
                }
            }

            if ( validateR($r) ) {
                $r = (float)$r;
            } else {
                for ($i = 0; $i < count($x); ++$i) {
                    $valid_points[$i] = false;
                }
            }
            
        
    
    ?>
                <p>
                    <table border=1px>
                        <tr>
                            <td>
                                X
                            </td>
                            <td>
                                <?php 
                                    echo $_GET["coordinateX"][0];
                                    for($i = 1; $i < count($x); ++$i) {
                                        echo ", ";
                                        echo $_GET["coordinateX"][$i];
                                    }
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Y
                            </td>
                            <td>
                                <?php echo $_GET["Y"] ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                R
                            </td>
                            <td>
                                <?php echo $_GET["radius"] ?>
                            </td>
                        </tr>

                        <tr>
                            <td colspan='2'>
                                <?php 
                                    for($i = 0; $i < count($x); ++$i) {
                                        if ($valid_points[$i] == true) {
                                            echo "for X=$x[$i]: ";
                                            echo isInside($x[$i], $y, $r);
                                            echo "<br>";
                                        }
                                    }
                                ?>
                            </td>
                        </tr>
                                
                    </table>     
                </p>
        <?php
            $endTime = microtime();
                $time = round( ($endTime - $startTime)* 1000, 5 );
                printf ("<br> <p class='center'>  time = $time ms </p>");


            function validateX($x, $i) {
                if (!is_numeric($x) || 
                    ($x != -2 && $x != -1.5 && $x != -1 && $x != -0.5 && $x != 0 && $x != 0.5 && $x != 1 && $x != 1.5 && $x != 2) ) {
                    print("x$i is not valid! \n");
                    return false;
                }
                return true;
            }
            function validateY($y) {
                if (!is_numeric($y) || $y >= 3 || $y <= -3) {
                    echo "y is not valid! \n";
                    return false;
                }
                return true;
            }
            function validateR($r) {
                if ( !is_numeric($r) || ($r != 1 && $r != 1.5 && $r != 2 && $r != 2.5 && $r != 3) ) {
                    print ("r is not valid! \n");
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