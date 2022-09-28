<?php
/**
 * Template Name: save
 */
?>

<form method="POST" action="">
    <div data-label="Index.php" class="demo-code-preview" contentEditable="true">
          <pre><code class="language-html">
              <textarea name="content">
            <?php
            $file = "index.php";
            echo(htmlspecialchars(file_get_contents($file)));
            ?>
            </textarea>
          </code></pre>
    </div>
    <!-- 
    This does not submit the form, it only makes a get request with the SubmitFile parameter.
    You need ot submit the form and send the SubmitFile in the post, or add the SubmitFile
    parameter to the form action if you really want to see it in the GET params.
       
    <a href="?SubmitFile=true" class="bar-anchor" name="SaveFile"><span>Save</span></a>
    -->
    <button type="submit" name="SubmitFile">Save</button>
</form>


<?php
/*
 * This will be true if the parameter is in the GET, but does not guarantee that
 * the form was posted, so you cannot rely on this as a GET parameter.
 * Change it to POST in the markup and here.
 * 
 * if (isset($_GET['SubmitFile']))
 */
if (isset($_POST['SubmitFile']))
{
    $content = $_POST['content'];
    echo "<script>console.log('" . $content . "' );</script>";
    $file       = "myfile.txt"; // cannot be an online resource
    $Saved_File = fopen($file, 'a+');
    fwrite($Saved_File, $content);
    fclose($Saved_File);
}
?>