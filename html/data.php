<?php
// data.php

$site_name = "Old News";
$base_dir = "/var/www/vjbe.net/html"; 
$articles_base = $base_dir . "/oldnews-articles-only";
$photos_base = "https://oldnews-photos.vjbe.net/";

$publications = [
    'liverpool_mercury' => 'Liverpool Mercury',
    'manchester_guardian' => 'The Manchester Guardian',
];

$metadata = [
    'spectator/1837/07/nichol-s-architecture-of-the-heavens.html' => [
        'title' => "Dr. Nichol's Architecture of the Heavens.",
        'summary' => "A review of Dr. Nichol's popularization of Herschel's astronomical discoveries, exploring the 'Architecture' of the Milky Way and the nebular hypothesis.",
        'day_num' => '22',
        'source_url' => "https://archive.spectator.co.uk/article/22nd-july-1837/17/dr-nichols-architecture-of-the-heavens"
    ],
     'examiner/1840/06/preparations-war-china.html' => [
        'title' => "The Preparations For War in China",
        "day_num" => "14",
        "source_url" => "https://www.britishnewspaperarchive.co.uk/viewer/BL/0000054/18400614/001/0001?browse=true"
    ],
     'examiner/1840/06/bane-antidote.html' => [
        'title' => "The Bane and the Antidote",
        "day_num" => "14",
        "source_url" => "https://www.britishnewspaperarchive.co.uk/viewer/BL/0000054/18400614/001/0001?browse=true"
    ],
     'examiner/1840/06/attempt-queen.html' => [
        'title' => "The Attempt on the Queen's Life",
        "day_num" => "14",
        "source_url" => "https://www.britishnewspaperarchive.co.uk/viewer/BL/0000054/18400614/001/0001?browse=true"
    ],
     'examiner/1840/03/election_news.html' => [
        'title' => "Election News",
        "day_num" => "8",
        "source_url" => "https://www.britishnewspaperarchive.co.uk/viewer/bl/0000054/18400308/008/0010"
    ],
     'examiner/1844/11/vestiges.html' => [
        'title' => "Vestiges of the Natural History of Creation",
        "day_num" => "9",
        "source_url" => "https://www.britishnewspaperarchive.co.uk/viewer/BL/0000054/18441109/003/0002?browse=true&fullscreen=true"
    ],
     'dublin_evening_post/1845/05/vestiges.html' => [
        'title' => "Professor Nichol",
        "day_num" => "17",
        "source_url" => "https://www.britishnewspaperarchive.co.uk/viewer/bl/0000435/18450517/035/0003"
    ],
    'liverpool_mercury/1845/10/readership.html' => [
        'title' => 'Mercury Extraordinary!',
        'day_num' => '03',
        'day_name' => 'Friday',
        'source_url' => "https://britishnewspaperarchive.co.uk/viewer/bl/0000081/18451017/005/0001"
    ],
    'liverpool_mercury/1845/10/vestiges-sedgwick-review-of-review.html' => [
        'title' => 'The Edinburgh Review, and Vestiges of the Natural History of Creation',
        'day_num' => '03',
        'day_name' => 'Friday',
        'source_url' => "https://britishnewspaperarchive.co.uk/viewer/bl/0000081/18451017/005/0001"
    ],
    'atlas/1845/12/explanations-review.html' => [
        'title' => "Review of New Books: Explanations: a Sequel to \"Vestiges of the Natural History of Creation\" By the Author of that Work. Churchill. London, 1845",
        "day_num" => "20",
        "source_url" => "https://www.findmypast.co.uk/image-viewer?issue=BL%2F0002115%2F18451220&page=1&fulfillmentTypeKey=4000&record-id=BL%2F0002115%2F18451220%2F006"
    ],
    'edinburgh_evening_post_and_scottish_standard/1846/01/vestiges.html' => [
        'title' => "Vestiges of the Natural History of Creation",
        "day_num" => "10",
        "source_url" => "https://www.britishnewspaperarchive.co.uk/viewer/bl/0001177/18460110/033/0003"
    ],
    'waterford_chronicle/1846/05/review-vestiges.html' => [
        'title' => "Vestiges of the Natural History of Creation - Avowed Infidelity",
        "day_num" => "20",
        "source_url" => "https://www.britishnewspaperarchive.co.uk/viewer/bl/0000838/18460520/005/0001"
    ],
];
