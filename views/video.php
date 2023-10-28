
<?php foreach($video as $index => $vid) {
         $type = explode(";", $vid->mimeType)[0];
        ?>
        <ul class="grid grid-cols-3">
                <li class="border-b border-gray-200 pb-3 sm:text=sm text-xs"><?php echo $vid->qualityLabel . " " . "({$type})" ?>  </li>
                <li class="border-b border-gray-200 pb-3 sm:text=sm text-xs"><?php echo formatFileSize($vid->contentLength) ?></li>
                <li class="border-b border-gray-200 pb-3"><a href="<?php echo $vid->url ?>" target="_blank" class="sm:py-2 py-1.5 px-2 sm:px-4 text-xs sm:text-sm bg-green-500 text-white  rounded-md font-bold hover:bg-green-600">Download</a></li>
       </ul>
<?php } ?>