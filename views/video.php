
<?php foreach($video as $index => $vid) {
         $type = explode(";", $vid->mimeType)[0];
        ?>
        <ul class="grid grid-cols-3">
                <li class="border-b border-gray-200 pb-3"><?php echo $vid->qualityLabel . " " . "({$type})" ?>  </li>
                <li class="border-b border-gray-200 pb-3"><?php echo formatFileSize($vid->contentLength) ?></li>
                <li class="border-b border-gray-200 pb-3"><a href="<?php echo $vid->url ?>" target="_blank" class="py-2 px-4 bg-green-500 text-white  rounded-md font-bold hover:bg-green-600">Download</a></li>
       </ul>
<?php } ?>