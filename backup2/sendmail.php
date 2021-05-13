<?php

ini_set("SMTP","ssl://smtp.gmail.com");
ini_set("smtp_port","465");

if(mail("ja.ramirez@ljrj.net","hi","it worked","From: sender\ 's email"))
{
    echo"sent";
}
else {
    echo "failed";
}