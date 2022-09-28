<?php
/**
 * Template Name: text editor
 */
?>

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
			width: 1000px;
    		height: 700px;
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

<body>
	<section class="">
    <h1 class="shadow-sm">TEXT EDITOR</h1>
    <div class="flex-box">
        <div class="row">
            <div class="col">
                <!-- Adding different buttons for
                     different functionality-->
                <!--onclick attribute is added to give 
                    button a work to do when it is clicked-->
                <button type="button" 
                        onclick="f1()" 
                        class=" shadow-sm btn btn-outline-secondary" 
                        data-toggle="tooltip"
                        data-placement="top" 
                        title="Bold Text">
        Bold</button> <button type="button" 
                        onclick="f2()" 
                        class="shadow-sm btn btn-outline-success" 
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="Italic Text">
        Italic</button> <button type="button" 
                        onclick="increaseFontSize(1)"
                        class="shadow-sm btn btn-outline-success" 
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="+">
        +</button> <button type="button" 
                        onclick="increaseFontSize(-1)" 
                        class="shadow-sm btn btn-outline-success" 
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="-">
        -</button> <button type="button" 
                        onclick="f3()" 
                        class=" shadow-sm btn btn-outline-primary" 
                        data-toggle="tooltip" 
                        data-placement="top"
                        title="Left Align">
        <i class="fas fa-align-left"></i></button> <button type="button" 
                        onclick="f4()" 
                        class="btn shadow-sm btn-outline-secondary" 
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="Center Align">
        <i class="fas fa-align-center"></i></button> <button type="button" 
                        onclick="f5()" 
                        class="btn shadow-sm btn-outline-primary" 
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="Right Align">
        <i class="fas fa-align-right"></i></button> <button type="button" 
                        onclick="f6()" 
                        class="btn shadow-sm btn-outline-secondary" 
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="Uppercase Text">
        Upper Case</button> <button type="button" 
                        onclick="f7()" 
                        class="btn shadow-sm btn-outline-primary" 
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="Lowercase Text">
        Lower Case</button> <button type="button" 
                        onclick="f8()" 
                        class="btn shadow-sm btn-outline-primary" 
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="Capitalize Text">
        Capitalize</button> <button type="button" 
                        onclick="f9()" 
                        class="btn shadow-sm btn-outline-primary side" 
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="Tooltip on top">
        Clear Text</button>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3 col-sm-3">
        </div>
        <div class="col-md-6 col-sm-9">
            <div class="flex-box">
                <textarea id="textarea1" 
                          class="input shadow" 
                          name="name"  
                          placeholder="Your text here ">
                </textarea>
            </div>
        </div>
        <div class="col-md-3">
        </div>
    </div>
    </section>

	<!--External JavaScript file-->
	<script>
		function f1() {
			//function to make the text bold using DOM method
			if (document.getElementById("textarea1").style.fontWeight == "normal") {
				document.getElementById("textarea1").style.fontWeight = "bold";
			} else {
				document.getElementById("textarea1").style.fontWeight = "normal";
			}
			
		}

		function f2() {
			//function to make the text italic using DOM method
			if (document.getElementById("textarea1").style.fontStyle == "normal") {
		    	document.getElementById("textarea1").style.fontStyle = "italic";
			} else {
				document.getElementById("textarea1").style.fontStyle = "normal";
			}
		}

		function f3() {
			//function to make the text alignment left using DOM method
			document.getElementById("textarea1").style.textAlign = "left";
		}

		function f4() {
			//function to make the text alignment center using DOM method
			document.getElementById("textarea1").style.textAlign = "center";
		}

		function f5() {
			//function to make the text alignment right using DOM method
			document.getElementById("textarea1").style.textAlign = "right";
		}

		function f6() {
			//function to make the text in Uppercase using DOM method
			document.getElementById("textarea1").style.textTransform = "uppercase";
		}

		function f7() {
			//function to make the text in Lowercase using DOM method
			document.getElementById("textarea1").style.textTransform = "lowercase";
		}

		function f8() {
			//function to make the text capitalize using DOM method
			document.getElementById("textarea1").style.textTransform = "capitalize";
		}

		function f9() {
			//function to make the text back to normal by removing all the methods applied 
			//using DOM method
			document.getElementById("textarea1").style.fontWeight = "normal";
			document.getElementById("textarea1").style.textAlign = "left";
			document.getElementById("textarea1").style.fontStyle = "normal";
			document.getElementById("textarea1").style.textTransform = "capitalize";
			document.getElementById("textarea1").value = " ";
		}
		function f10() {
			//function to increase font size
			document.getElementById("textarea1").style.fontSize = "x-large";
		}
		function increaseFontSize(increaseFactor){
	    	txt = document.getElementById("textarea1");
			style = window.getComputedStyle(txt, null).getPropertyValue('font-size');
			currentSize = parseFloat(style);
			txt.style.fontSize = (currentSize + increaseFactor) + 'px';
		}
	</script>
</body>
  
</html>








