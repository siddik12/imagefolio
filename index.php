<?php
define("APP_PATH",dirname(__FILE__));
define("GALLERY_PATH",APP_PATH."/Gallery");

?>


<!doctype html >
<html lang="en" class="no-js">
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
                    <p>
                        <?php
                        require_once ("app/Helper.php");
                        use App\Helper;

                        Helper::getImageCount() ?>
                    </p>
                    <div class="gallery">
                        <?php
                        $imagesDirectory = "Gallery/";

                        if(is_dir($imagesDirectory))
                        {
                            $opendirectory = opendir($imagesDirectory);

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

<script>
    // ************************ Drag and drop ***************** //
    let dropArea = document.getElementById("drop-area");

   // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false)
        document.body.addEventListener(eventName, preventDefaults, false)
    })

    // Highlight drop area when item is dragged over it
    ;['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false)
    })

    ;['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false)
    })

    // Handle dropped files
    dropArea.addEventListener('drop', handleDrop, false)

    function preventDefaults (e) {
        e.preventDefault()
        e.stopPropagation()
    }

    function highlight(e) {
        dropArea.classList.add('highlight')
    }

    function unhighlight(e) {
        dropArea.classList.remove('active')
    }

    function handleDrop(e) {
        var dt = e.dataTransfer
        var files = dt.files

        handleFiles(files)
    }

    let uploadProgress = []
    let progressBar = document.getElementById('progress-bar')

    function initializeProgress(numFiles) {
        progressBar.value = 0
        uploadProgress = []

        for(let i = numFiles; i > 0; i--) {
            uploadProgress.push(0)
        }
    }

    function updateProgress(fileNumber, percent) {
        uploadProgress[fileNumber] = percent
        let total = uploadProgress.reduce((tot, curr) => tot + curr, 0) / uploadProgress.length
        console.debug('update', fileNumber, percent, total)
        progressBar.value = total
    }

    function handleFiles(files) {
        files = [...files]
        initializeProgress(files.length)
        files.forEach(uploadFile)
        files.forEach(previewFile)
    }

    function previewFile(file) {
        let reader = new FileReader()
        reader.readAsDataURL(file)
        reader.onloadend = function() {
            let img = document.createElement('img')
            img.src = reader.result
        }
    }

    function uploadFile(file, i) {
        var url = 'upload.php'
        var xhr = new XMLHttpRequest()
        var formData = new FormData()
        xhr.open('POST', url, true)
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')

        // Update progress (can be used to show progress indicator)
        xhr.upload.addEventListener("progress", function(e) {
            updateProgress(i, (e.loaded * 100.0 / e.total) || 100)
        })

        xhr.addEventListener('readystatechange', function(e) {
            if (xhr.readyState == 4 && xhr.status == 200) {
                updateProgress(i, 100) // <- Add this
                location.reload(true);
            }
            else if (xhr.readyState == 4 && xhr.status != 200) {
                // Error. Inform the user
            }
        })

        formData.append('file', file)
        xhr.send(formData)
    }
</script>
</body>
</html>