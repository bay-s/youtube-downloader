<?php

require_once "./vendor/autoload.php";

use YouTube\YouTubeDownloader;
use YouTube\Exception\YouTubeException;

$youtube = new YouTubeDownloader();
$video = [];
$videoDetail = [];
if(isset($_POST['get-url'])){
    // "https://www.youtube.com/watch?v=aqz-KE-bpKQ"
   $url = $_POST['url'];
    try {
        $downloadOptions = $youtube->getDownloadLinks($url);
        $videoFormats = $downloadOptions->getVideoFormats(); // Assuming $downloadOptions is an object with the video formats

        $uniqueQualityLabels = [];
        if ($downloadOptions->getAllFormats()) {
            // echo $downloadOptions->getFirstCombinedFormat()->url;  
            $uniqueVideoFormats = array_filter($videoFormats, function($vid) use (&$uniqueQualityLabels) {
                if (!in_array($vid->qualityLabel, $uniqueQualityLabels)) {
                    $uniqueQualityLabels[] = $vid->qualityLabel;
                    return true;
                }
                return false;
            });
         $video =  $uniqueVideoFormats;
         foreach($downloadOptions-> getInfo() as $data){
             $videoDetail['thumb'] = $data['thumbnail']['thumbnails'];
             $videoDetail['title'] = $data['title'];
        }
        } else {
            echo 'No links found';
        }
    
    } catch (YouTubeException $e) {
        echo 'Something went wrong: ' . $e->getMessage();
    }
 
}

function formatFileSize($bytes) {
    $units = array('Bytes', 'KB', 'MB', 'GB');
    $i = 0;
    while ($bytes >= 1024 && $i < count($units) - 1) {
        $bytes /= 1024;
        $i++;
    }
    return round($bytes, 2) . ' ' . $units[$i];
}
?>

<?php require_once "./views/header.php"; ?>

<main class="container px-20 my-12  flex flex-col gap-6"  >

<form action="" method="post" >
    
<div class="mb-4">
      <label for="email" class="sr-only">Email</label>
        <input
          name="url"
          type="text"
          class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
          placeholder="Enter url"
          required
        />
</div>
<button name="get-url" type="submit" class="inline-block rounded border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:outline-none focus:ring active:text-indigo-500">
    Get Video
</button>

</form>
 
<?php if(!empty($videoDetail)){?>
<section class="grid gap-5 grid-cols-2">
  <article class="col-span-1 flex flex-col gap-4">
    <img src="<?php echo $videoDetail['thumb'][4]['url']?>" class="h-64 w-full rounded-sm" alt="">
  <h3 class="font-bold text-1xl"><?php echo $videoDetail['title'] ?></h3>
 
  </article>
  <article class="col-span-1 border">

  <!--
  Heads up! 👋

  Plugins:
    - @tailwindcss/forms
-->

<div>
  <div class="sm:hidden">
    <label for="Tab" class="sr-only">Tab</label>

    <select id="Tab" class="w-full rounded-md border-gray-200">
      <option>Settings</option>
      <option>Messages</option>
      <option>Archive</option>
      <option select>Notifications</option>
    </select>
  </div>

  <div class="hidden sm:block">
    <div class="border-b border-gray-200">
      <nav class="-mb-px flex gap-6">
        <a
          href="#"
          class="shrink-0 border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700"
        >
         Video
        </a>

        <a
          href="#"
          class="shrink-0 border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700"
        >
          Audio
        </a>

        <a
          href="#"
          class="shrink-0 border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700"
        >
          Archive
        </a>
      </nav>
    </div>
  </div>
</div>

<div class="flex flex-col gap-5 my-4">
    <?php foreach($video as $index => $vid) {
         $type = explode(";", $vid->mimeType)[0];
        ?>
        <ul class="flex items-center gap-4">
                <li><?php echo $vid->qualityLabel ?>-<?php echo $type ?></li>
                <li> <?php echo formatFileSize($vid->contentLength) ?></li>
                <li><a href="<?php echo $vid->url ?>" target="_blank" class="py-2 px-4 bg-blue-500">Download</a></li>
       </ul>
    <?php } ?>
</div>

  </article>
</section>
<?php } ?>

</main>
 

</body>
</html>
