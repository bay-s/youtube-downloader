<?php

require_once "./vendor/autoload.php";

use YouTube\YouTubeDownloader;
use YouTube\Exception\YouTubeException;

$youtube = new YouTubeDownloader();
$video = [];
$audio = [];
$videoDetail = [];
$Exception = [];


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
        //  AUDIO
         foreach($downloadOptions->getAudioFormats() as $data){
               array_push($audio,$data);
          }
        } else {
            echo 'No links found';
        }
    
    } catch (YouTubeException $e) {
       $Exception = array(
        "error" => true,
        "message" => 'Something went wrong: ' . $e->getMessage()
       );
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


function convertSampleRateToKbps($sampleRate) {
  // Convert Hz to kHz
  $sampleRateKhz = $sampleRate / 1000;
  
  // The formula for converting sample rate to kbps
  $kbps = $sampleRateKhz * 16; // Assuming 16-bit audio
  
  return $kbps;
}

 
?>

<?php require_once "./views/header.php"; ?>

<main class="container lg:px-40 my-6 flex flex-col gap-6 h-screen">
 
<form action="" method="post" class="flex flex-col gap-5 rounded-md bg-white border p-5" >
<h1 class="font-bold text-3xl text-center">Download Video and Audio from YouTube</h1>  
<div class="mb-4 flex items-center border-4 rounded-md border-blue-500 mx-20">
        <input
          name="url"
          type="text"
          class="w-full rounded-lg outline-none  p-4 pe-12 text-sm shadow-sm   "
          placeholder="Enter url"
          required
        />
  <button name="get-url" type="submit" class="inline-block rounded border border-indigo-500 bg-indigo-500 px-12 py-4 text-sm font-medium text-white  focus:outline-none focus:ring active:text-indigo-500 whitespace-nowrap hover:bg-indigo-600">
    Get Video
</button>
</div>
</form>
 
<!-- ERROR -->
<?php if(!empty($Exception)) { ?>
  <?php if($Exception['error']) { ?>
<div role="alert" class="rounded border-s-4 border-red-500 bg-red-50 p-4">
  <p class="mt-2 text-sm text-red-700 font-bold">
  <?php echo $Exception['message'] ?>
  </p>
</div>
    <?php } ?>
<?php }  ?> 
<!-- END ERROR MESSAGE -->

<?php if(!empty($videoDetail)){?>
<section class="grid gap-5 grid-cols-2 p-4">
  <!-- STAR LEFT COL -->
  <article class="col-span-1 flex flex-col gap-4">
    <figure class="h-64 rounded bg-black">
    <img src="<?php echo $videoDetail['thumb'][count($videoDetail['thumb']) - 1]['url'] ?>" class="object-contain h-64  w-full rounded-sm" alt="">
  </figure>
  <h3 class="font-bold text-1xl"><?php echo $videoDetail['title'] ?></h3>
  </article>
  <!-- end left col -->
  <!-- START RIGHT COL -->
<article class="col-span-1">

<!-- TABS -->
<div class="hidden sm:block mb-6">
    <div class="border-b border-gray-200">
      <nav class="-mb-px flex gap-6 md:text-md" aria-label="Tabs">
        <a
          href="#"
          data-tabs="video"
          class="shrink-0 border-b-2 border-transparent px-1 pb-4 font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700 tabs"
        >
          Video
        </a>
        <a
          href="#"
          data-tabs="audio"
          class="shrink-0 border-b-2 border-transparent px-1 pb-4 font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700 tabs"
        >
          Audio
        </a>
      </nav>
    </div>
  </div>
<!-- END TABS -->
 
<div class="flex flex-col gap-5 fade" id="video">
<?php require_once "./views/video.php"; ?>
</div>

<div class="flex flex-col gap-5 hidden fade" id="audio">
<?php require_once "./views/audio.php"; ?>
</div>
  </article>
    <!-- END RIGHT COL -->
</section>
<?php } ?>

</main>
 
<?php require_once "./views/footer.php"; ?>
 
