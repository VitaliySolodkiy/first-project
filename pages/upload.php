<h1>Upload</h1>

<?php Message::get() ?>

<h2>Upload img to Uploads folder</h2>
<form action="index.php" method="POST" enctype="multipart/form-data">
    <div class="input-group">
        <input type="file" name="file" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary mt-3" name="action" value="uploadFile">Send</button>
</form>

<hr>

<h2>Create gallery folder</h2>
<form action="index.php" method="POST">
    <div class="input-group">
        <input type="text" name="folderName" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary mt-3" name="action" value="createFolder">Create Folder</button>
</form>

<hr>

<h2>Delete gallery folder</h2>
<form action="index.php" method="POST">
    <label for="deleteFolder" class="form-label">Select folder to delete:</label>
    <div class="input-group">

        <!-- <label for="deleteFolder" class="form-label">Subject:</label> -->
        <select class="form-select" name="select" id="deleteFolder">
            <?php
            $folders = glob('uploads/gallery/*', GLOB_ONLYDIR);
            //dump($folders);
            foreach ($folders as $folderPath) {
                $folderName = basename($folderPath);
                echo "<option value='$folderName'>$folderName</option>";
            }
            ?>

        </select>
    </div>
    <button type="submit" class="btn btn-primary mt-3" name="action" value="deleteFolder">Delete Folder</button>
</form>

<hr>

<h2>Upload img to gallery</h2>
<form action="index.php" method="POST" enctype="multipart/form-data">
    <label for="deleteFolder" class="form-label">Select folder for upload:</label>
    <div class="input-group">
        <!-- <label for="deleteFolder" class="form-label">Subject:</label> -->
        <select class="form-select" name="select" id="deleteFolder">
            <?php
            $folders = glob('uploads/gallery/*', GLOB_ONLYDIR);
            //dump($folders);
            foreach ($folders as $folderPath) {
                $folderName = basename($folderPath);
                echo "<option value='$folderName'>$folderName</option>";
            }
            ?>
        </select>
    </div>
    <div class="input-group mt-3">
        <input type="file" name="file" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary mt-3" name="action" value="uploadFile">Upload File</button>
</form>