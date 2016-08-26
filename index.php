<?php
    include 'functions.php';
    include 'functions_database.php';
    include 'functions_messages.php';

    session_start();
    if ( $username = user_logged_in() ){
        include 'auth_sessions.php';
        set_https();
    }
    else{
        unset_https();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Theater Booker</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="bootstrap/html5shiv.min.js"></script>
    <script type="text/javascript" src="bootstrap/respond.min.js"></script>
    <![endif]-->

    <link href="shares_style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="shares_functions.js"></script>
</head>

<body>
    <noscript>
        <div class="no-script-warning">
            Sorry: Your browser does not support or has disabled javascript.
        </div>
        <br>
        <div class="no-script-info">
            Please use a different browser or enabled javascript.
        </div>
        <br>
    </noscript>

    <?php
        include 'navbar.php';
        manage_messages();
    ?>

    <?php if($username){ ?>
    <div class="col-lg-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Your account</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        Username: <?php echo $username;?>
                    </li>
                    <li class="list-group-item">
                        Balance: <?php echo get_user_balance($username); ?>
                    </li>
                    <li class="list-group-item">
                        Amount of shares: <?php echo get_user_shares_amount($username); ?>
                    </li>
                </ul>

                <?php
                    $shares = get_user_ordered_shares($username);
                    if (count($shares) > 0){
                ?>
                    <div class="panel panel-success">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <h3 class="panel-title">Your past orders</h3>
                    </div>
                    <!--
                        <div class="panel-body">
                            <p>...</p>
                        </div>
                    -->

                    <!-- Table -->
                    <table class="table">
                        <tr>
                            <th>No.</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Price</th>
                        </tr>
                        <?php
                            foreach ($shares as $s){
                                echo "<tr>";
                                echo "<td>".$s['shares_order_id']."</td>";
                                echo "<td>".$s['shares_type']."</td>";
                                echo "<td>".$s['amount']."</td>";
                                echo "<td>".$s['price']."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
    <?php } ?>

    <?php if($username){ ?>
    <div class="col-lg-8">
    <?php } else{ ?>
    <div class="col-lg-12">
    <?php } ?>
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <h3 class="panel-title">Shares book</h3>
            </div>
            <!--
                <div class="panel-body">
                    <p>...</p>
                </div>
            -->

            <!-- Table -->
            <table class="table">
                <tr>
                    <th>Buying amount</th>
                    <th>Buying price</th>
                    <th>Selling price</th>
                    <th>Selling amount</th>
                </tr>
                <?php
                $buying_shares = get_buying_shares();
                $buying_dimension = count($buying_shares);
                $selling_shares = get_selling_shares();
                $selling_dimension = count($selling_shares);

                for ($i = 0; $i < TABLE_ROWS; $i++){
                    echo "<tr>";
                    if ($i < $buying_dimension){
                        echo "<td>".$buying_shares[$i]['amount']."</td>";
                        echo "<td>".$buying_shares[$i]['price']."</td>";
                    }
                    else
                        echo "<td></td><td></td>";
                    if ($i < $selling_dimension){
                        echo "<td>".$selling_shares[$i]['amount']."</td>";
                        echo "<td>".$selling_shares[$i]['price']."</td>";
                    }
                    else
                        echo "<td></td><td></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <?php if($username){ ?>
            <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title">Order</h3>
            </div>
            <div class="panel-body">
                <div class="input-group col-lg-12">
<!--
                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        <a href="#" class="btn btn-default" role="button">Buy</a>
                        <a href="#" class="btn btn-default" role="button">Sell</a>
                    </div>
-->
                    <form method="post" action="order.php" onsubmit="return checkAmount();">
                        <input type="number" min="0" step="1" value="0" id="amount-of-shares"
                               name="amount" class="form-control" aria-describedby="basic-addon1">

                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <input type="submit" name="type" class="btn btn-default" value="Buy"/>
<!--                                    <button type="submit" class="btn btn-default">Buy</button> -->
                            </div>
                            <div class="btn-group" role="group">
                                <input type="submit" name="type" class="btn btn-default" value="Sell"/>
<!--                                    <button type="submit" class="btn btn-default">Sell</button> -->
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <script type="text/javascript">
        if (navigator.cookieEnabled == true) {

        }
        else{
            // preventing site usage
            printCookieDisabledMessage();
        }
    </script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="bootstrap/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>