<nav class="navbar navbar-default" id="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <!--
                uncomment on server
                <a class="navbar-brand" href="/~s231826/c0e1ee/">
            -->
            <a class="navbar-brand" href="/2016_09_project">
                Shares
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <?php
                        if ( !$username ) {
                            echo "<a href=\"auth_login.php\">
                                <button type=\"button\" class=\"btn btn-default\">
                                <span class=\"glyphicon glyphicon-log-in\" aria-hidden=\"true\"></span> Login
                                </button>
                              </a>";
                        }
                        else{
                            echo "<p>Signed in as <b>".$username."</b></p>                                                                 
                                  <a href=\"auth_logout.php\">
                                    <button type=\"button\" class=\"btn btn-default btn-lg\" onclick=\"clearSelectedSeats()\">
                                        <span class=\"glyphicon glyphicon-log-out\" aria-hidden=\"true\"></span> Logout                                                
                                    </button>                                                                                                                                                                    
                                  </a>";
                        }
                    ?>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>