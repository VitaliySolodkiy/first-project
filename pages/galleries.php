<h1>Galleries page</h1>

<?php
$folders = glob('uploads/gallery/*', GLOB_ONLYDIR);
foreach ($folders as $index => $folderPath) {
    $imagesArr = glob($folderPath . '/*');
    $imagesArrQuantity = count($imagesArr);
    if ($imagesArrQuantity > 0) {
        $folderName = ucfirst(basename($folderPath));
        echo "<h2>$folderName </h2>";            ?>

        <section class="splide mb-3" id="carousel<?php echo $index ?>" aria-label="Splide Basic HTML Example">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php
                    foreach ($imagesArr as $imgPath) {
                        echo "<li class='splide__slide'><img src='$imgPath' alt='First slide'></li>";
                    }
                    ?>
                </ul>
            </div>
        </section>
    <?php
    }
}

//монтируем слайдеры
for ($i = 0; $i < $imagesArrQuantity; $i++) {
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let splide = new Splide('#carousel<?php echo "$i" ?>', {
                rewind: true,
            });
            splide.mount();
        });
    </script>
<?php
}
?>