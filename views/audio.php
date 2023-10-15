
<?php foreach($audio as $index => $mp3) {
         $type = explode(";", $mp3->mimeType)[0];
        ?>
        <ul class="grid grid-cols-3">
                <li class="border-b border-gray-200 pb-3 "><?php echo  "({$type})" ." " . convertSampleRateToKbps($mp3->audioSampleRate) . "kbps"   ?>  </li>
                <li class="border-b border-gray-200 pb-3"><?php echo formatFileSize($mp3->contentLength) ?></li>
                <li class="border-b border-gray-200 pb-3"><a href="<?php echo $mp3->url ?>" target="_blank" class="py-2 px-4 bg-green-500 text-white  rounded-md font-bold hover:bg-green-600">Download</a></li>
       </ul>
<?php } ?>

 