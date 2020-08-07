<?php
define("APP_PATH", dirname(__FILE__));
define("GALLERY_PATH", $_SERVER['DOCUMENT_ROOT'] . "/Gallery/");
$originalImage = $_REQUEST['img'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/styles.css" rel="stylesheet">
    <title>Imagefolio</title>
</head>
<body>
<header>
    <div class="container">
        <div class="col">
            <h1>IMAGEFOLIO</h1>
        </div>
    </div>
</header>
<section>
    <div class="container">
        <div class="col">
            <h2>Media Library</h2>
            <div class="card">
                <div class="card-body">
                    <div class="editor-panel">
                        <div class="image">
                            <img src="Gallery/<?php echo $originalImage ?>" width="500" id="image">
                        </div>

                        <div>

                           <div class="rotate">
                               <button onclick="Rotate(0)">0 deg</button>
                               <button onclick="Rotate(30)">30 deg</button>
                               <button onclick="Rotate(60)">60 deg</button>
                               <button onclick="Rotate(90)">90 deg</button>
                               <button onclick="Rotate(180)">180 deg</button>
                           </div>
                            <div class="ratio">
                                <button onclick="makeCrop(16/9)">16:19</button>
                                <button onclick="makeCrop(10/7)">10:7</button>
                                <button onclick="makeCrop(7/5)">7:5</button>
                                <button onclick="makeCrop(3/2)">3:2</button>
                                <button onclick="makeCrop(12/2)">12:2</button>
                            </div>

                            <div class="col">
                                <div class="gallery">
                                    <div class="filter-img">
                                        <img src="Gallery/<?php echo $originalImage ?>" width="100" id="original"  onclick="applyOriginal()">
                                        <p>Original</p>
                                    </div>
                                    <div class="filter-img">
                                        <img src="Gallery/<?php echo $originalImage ?>" width="100" id="grayscale" style="filter: grayscale(1)" onclick="applyGrayscale()">
                                        <p>Grayscale</p>
                                    </div>
                                    <div class="filter-img">
                                        <img src="Gallery/<?php echo $originalImage ?>" width="100" id="sepia" style="filter: sepia(100%)" onclick="applySepia()">
                                        <p>Sepia</p>
                                    </div>
                                    <div class="filter-img">
                                        <img src="Gallery/<?php echo $originalImage ?>" width="100" id="invert" style="filter: invert(100%)" onclick="applyInvert()">
                                        <p>Invert</p>
                                    </div>

                                </div>
                            </div>


                            <div class="adjust">
                                <div class="form-group">
                                    <label>Exposure</label>
                                    <input type="range" value="1" onchange="applyFilter()" oninput="applyFilter()" data-filter="brightness" data-scale="%" step="1" min="1" max="200">
                                </div>
                                <div class="form-group">
                                    <label>Contrast</label>
                                    <input type="range" value="1" onchange="applyFilter()" oninput="applyFilter()" data-filter="contrast" data-scale="%" step="1" min="1" max="200">
                                </div>

                                <div class="form-group">
                                    <label>Saturation</label>
                                    <input type="range" value="1" onchange="applyFilter()" oninput="applyFilter()" data-filter="saturate" data-scale="%" step="1" min="1" max="100">
                                </div>


                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-8">
                &nbsp;
            </div>
            <div class="col-4 ">
                <form class="float-right">
                    <a class="btn" href="index.php">Back</a>
                    <input class="btn btn-primary" type="button" value="SAVE" onclick="saveImage()">
                </form>
            </div>
        </div>

    </div>
</footer>

<script type="text/javascript" src="js/editor.js"></script>
</body>
</html>