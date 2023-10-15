<?php
require_once __DIR__ . "/../app/init.php";
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YT DOWNLOADER</title>
    <link href="<?php echo $root ?>public/css/style.css" rel="stylesheet">
    <link href="<?php echo $root ?>public/css/tailwind.min.css" rel="stylesheet">
</head>
<body>
    
 
<header class="bg-white">
  <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between lg:px-36">
      <div class="flex-1 md:flex md:items-center md:gap-12">
        <a class=" text-teal-600 font-bold text-2xl" href="/">
        YT - Downloader
        </a>
      </div>

      <div class="md:flex md:items-center md:gap-12">
        <nav aria-label="Global" class="hidden md:block">
          <ul class="flex items-center gap-6 text-sm">
            <li>
              <a
                class="text-gray-500 transition hover:text-gray-500/75"
                href="/"
              >
              Download Video
              </a>
            </li>
            <li>
              <a
                class="text-gray-500 transition hover:text-gray-500/75"
                href="/"
              >
              Download Audio
              </a>
            </li>
          </ul>
        </nav>

        <div class="flex items-center gap-4">
 
          <div class="block md:hidden">
            <button
              class="rounded bg-gray-100 p-2 text-gray-600 transition hover:text-gray-600/75"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M4 6h16M4 12h16M4 18h16"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>