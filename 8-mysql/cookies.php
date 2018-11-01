<?php
                                    //expiration
    setcookie("customerId", "1234", time()+60*60*24);
    echo $_COOKIE["customerId"];

    // to erase:
    // setcookie("customerId", "", time()-60);
?>