<?php
include("header.php");
use App\Helper;
?>
<section>
    <div class="container">
        <div class="col">
            <h2>Media Library</h2>
            <div class="card">
                <div class="card-body">
                    <p>
                        <?php Helper::getImageCount() ?>
                    </p>
                    <div class="gallery">
                        <?php

                        if(is_dir(GALLERY_PATH))
                        {
                            $opendirectory = opendir(GALLERY_PATH);

                            while (($image = readdir($opendirectory)) !== false)
                            {
                                if(($image == '.') || ($image == '..'))
                                {
                                    continue;
                                }

                                $imgFileType = pathinfo($image,PATHINFO_EXTENSION);

                                $imageName = pathinfo($image,PATHINFO_BASENAME);


                                if(($imgFileType == 'jpg') || ($imgFileType == 'png'))
                                {?>

                                        <div class="item">
                                            <a href="editor.php?img=<?php echo $imageName;?>">
                                            <div class="item-body">
                                                <img src='Gallery/<?php echo $image?>' width="100%">
                                            </div>

                                            <div class="item-footer">
                                                <p><?php echo $imageName;?></p>
                                            </div>
                                            </a>
                                        </div>

<?php
                                }
                            }

                            closedir($opendirectory);

                        }
                        ?>


                    </div>
                </div>


                <div class="card-footer">
                    <div class="col-4">
                        <p>Upload Image</p>
                    </div>
                    <div class="col-8">
                        <div id="drop-area">
                            <form class="my-form">
                                <input type="file" id="fileElem" multiple accept="image/*" onchange="handleFiles(this.files)">
                                <label class="button" for="fileElem"><span>Drag and Drop or </span><strong>Browse for files</strong></label>
                            </form>
                            <progress id="progress-bar" max=100 value=0></progress>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="js/upload.js"></script>
</body>
</html>