<?php


<!DOCTYPE html>
<html lang="en" dir="ltr">
  
<head>
    <meta charset="utf-8">
    <title>Text Editor</title>
    <!--Bootstrap Cdn -->
    <link rel="stylesheet" 
          href=
"https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
          integrity=
"sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" 
          crossorigin="anonymous">
    <!-- fontawesome cdn For Icons -->
    <link rel="stylesheet"
          href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" 
          integrity=
"sha512-PgQMlq+nqFLV4ylk1gwUOgm6CtIIXkKwaIHp/PAIWHzig/lKZSEGKEysh0TCVbHJXCLN7WetD8TFecIky75ZfQ==" 
          crossorigin="anonymous" />
    <link rel="stylesheet"
          href=
"https://pro.fontawesome.com/releases/v5.10.0/css/all.css" 
          integrity=
"sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
          crossorigin="anonymous" />
  
    <!--Internal CSS start-->
    <style>
        h1 {
            padding-top: 40px;
            padding-bottom: 40px;
            text-align: center;
            color: #957dad;
            font-family: 'Montserrat', sans-serif;
        }
          
        section {
            padding: 5%;
            padding-top: 0;
            height: 100vh;
        }
          
        .side {
            margin-left: 0;
        }
          
        button {
            margin: 10px;
            border-color: #957dad !important;
            color: #888888 !important;
            margin-bottom: 25px;
        }
          
        button:hover {
            background-color: #fec8d8 !important;
        }
          
        textarea {
            padding: 3%;
            border-color: #957dad;
            border-width: thick;
        }
          
        .flex-box {
            display: flex;
            justify-content: center;
        }
    </style>
    <!--Internal CSS End-->
</head>
<!--Body start-->

<body>

<?php
if (have_posts()){
    while ( have_posts()){
        the_post();
        the_content();
    }// end while
}// end if
?>

