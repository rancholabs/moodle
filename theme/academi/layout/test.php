<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * TODO describe file ranchohome
 *
 * @package    theme_academi
 * @copyright  2024 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 defined('MOODLE_INTERNAL') || die();

 require_once(dirname(_FILE_) .'/includes/layoutdata.php');
 require_once(dirname(_FILE_) .'/includes/homeslider.php');
 
 $PAGE->requires->css(new moodle_url('/theme/academi/style/slick.css'));
 $PAGE->requires->js_call_amd('theme_academi/frontpage', 'init');
 $bodyattributes = $OUTPUT->body_attributes($extraclasses);
 // Jumbotron class.
 $jumbotronclass = (!empty(theme_academi_get_setting('jumbotronstatus'))) ? 'jumbotron-element' : '';
 // Slide show contnet added in the templatecontext.
 $templatecontext += $sliderconfig;

 // Carousel data
$carouselItems = [
    ['image' => 'https://ik.imagekit.io/036wrwwve/rancholabs/M1.HEIC?updatedAt=1720786287992', 'title' => 'Title 1', 'description' => 'Description 1'],
    ['image' => 'https://ik.imagekit.io/036wrwwve/rancholabs/M4.HEIC?updatedAt=1720786288136', 'title' => 'Title 2', 'description' => 'Description 2'],
    ['image' => 'https://ik.imagekit.io/036wrwwve/rancholabs/M3.HEIC?updatedAt=1720787009649', 'title' => 'Title 3', 'description' => 'Description 2'],
    // Add more items as needed
];
$logintoken = \core\session\manager::get_login_token();

$trydemocontext = [
    'output' => $OUTPUT,
    'bodyattributes' => $bodyattributes,
    'logintoken' => $logintoken,
    'domain' => $CFG->wwwroot,
];

$stories = [
  /*  [
        'index' => '1',
        'imageurl' => 'https://ik.imagekit.io/036wrwwve/Moodle/IMG_8131.HEIC?updatedAt=1725475843462',
        'name' => 'Niharika Singh',
        'class' => '7th-C',
        'event' => 'RoboFest Innovator',
        'descriptionbold' => 'Niharika Singh, 7th-C, RoboFest Innovator',
        'description' => '"Secured the Innovator Award at RoboFest. Niharika’s project, which utilized sensors and AI to monitor and maintain plant health, was praised for its creativity and real-world applicability."',
        'badges' => [
            [
                'title' => 'Platinum Badge'
            ],
            [
                'title' => 'Diamond Badge'
            ],
            [
                'title' => 'Gold Badge'
            ],
            [
                'title' => 'Silver Badge'
            ],
        ]
    ],
    [
        'index' => '2',
        'imageurl' => 'https://ik.imagekit.io/036wrwwve/Moodle/WhatsApp%20Image%202024-09-04%20at%2011.50.21.jpeg?updatedAt=1725472694321',
        'name' => 'Aarav Mehta',
        'class' => '6th-B',
        'event' => 'RoboWars Champion',
        'descriptionbold' => 'Won first place in the National RoboWars Champion Competetion,',
        'description' => 'showing exceptional programming skills and problem solving abilities. This prestigious achivement highlights a deep understanding of coding principles and was celebrated by TechCrunch',
        'badges' => [
            [
                'title' => 'Platinum Badge'
            ],
            [
                'title' => 'Diamond Badge'
            ],
            [
                'title' => 'Gold Badge'
            ],
            [
                'title' => 'Silver Badge'
            ],
        ]
        
    ],
    [
        'index' => '3',
        'imageurl' => 'https://ik.imagekit.io/036wrwwve/Moodle/WhatsApp%20Image%202024-09-04%20at%2011.47.43.jpeg?updatedAt=1725472694332',
        'name' => 'Sanchit Sharma',
        'class' => '8th-A',
        'event' => 'CodeCamp Quiz winner',
        'descriptionbold' => 'Won first place in the National CodeCamp Quiz Competetion,',
        'description' => 'showing exceptional programming skills and problem solving abilities. This prestigious achivement highlights a deep understanding of coding principles and was celebrated by TechCrunch',
        'badges' => [
            [
                'title' => 'Platinum Badge'
            ],
            [
                'title' => 'Diamond Badge'
            ],
            [
                'title' => 'Gold Badge'
            ],
            [
                'title' => 'Silver Badge'
            ],
        ]
    ],
    [
        'index' => '4',
        'imageurl' => 'https://ik.imagekit.io/036wrwwve/Moodle/WhatsApp%20Image%202024-09-04%20at%2011.44.56.jpeg?updatedAt=1725472694254',
        'name' => 'Dhruv',
        'class' => '8th-A',
        'event' => 'CodeCamp Quiz winner',
        'descriptionbold' => 'Won first place in the National CodeCamp Quiz Competetion,',
        'description' => 'showing exceptional programming skills and problem solving abilities. This prestigious achivement highlights a deep understanding of coding principles and was celebrated by TechCrunch',
        'badges' => [
            [
                'title' => 'Platinum Badge'
            ],
            [
                'title' => 'Diamond Badge'
            ],
            [
                'title' => 'Gold Badge'
            ],
            [
                'title' => 'Silver Badge'
            ],
        ]
    ],
    [
        'index' => '5',
        'imageurl' => 'https://ik.imagekit.io/036wrwwve/Moodle/IMG_0395.HEIC?updatedAt=1723615469379',
        'name' => 'Aaryan',
        'class' => '8th-A',
        'event' => 'CodeCamp Quiz winner',
        'descriptionbold' => 'Won first place in the National CodeCamp Quiz Competetion,',
        'description' => 'showing exceptional programming skills and problem solving abilities. This prestigious achivement highlights a deep understanding of coding principles and was celebrated by TechCrunch',
        'badges' => [
            [
                'title' => 'Platinum Badge'
            ],
            [
                'title' => 'Diamond Badge'
            ],
            [
                'title' => 'Gold Badge'
            ],
            [
                'title' => 'Silver Badge'
            ],
        ]
    ],
    [
        'index' => '6',
        'imageurl' => 'https://ik.imagekit.io/036wrwwve/Moodle/IMG_0581%201.png?updatedAt=1723445477873',
        'name' => 'Kajal Sharma',
        'class' => '8th-A',
        'event' => 'CodeCamp Quiz winner',
        'descriptionbold' => 'Won first place in the National CodeCamp Quiz Competetion,',
        'description' => 'showing exceptional programming skills and problem solving abilities. This prestigious achivement highlights a deep understanding of coding principles and was celebrated by TechCrunch',
        'badges' => [
            [
                'title' => 'Platinum Badge'
            ],
            [
                'title' => 'Diamond Badge'
            ],
            [
                'title' => 'Gold Badge'
            ],
            [
                'title' => 'Silver Badge'
            ],
        ]
    ],
*/
];




// Mark the first story as active
if (!empty($stories)) {
    $stories[0]['first'] = true; // Add 'first' => true for the first story
}

$storiescontext = ['stories' => $stories];

$eventsData = [
	'events' => [
/*
        [
            'index' => '1',
            'title' => 'Codeathon Challenge',
            'date' => 'September 15th, 2024',
            'location' => 'Amity International School, Noida',
            'image' => 'https://ik.imagekit.io/036wrwwve/Moodle/bbb5ed2979372f2f7e1d5e75cf20467d_Expires=1726444800&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=oLw01BICiHQeVMExqX0H-OZSTHyLOmgrfgT-b46FENYKjlhY75mlozm~yMtFZph6UBADl8gWG-TgLzaEvLdoY5DcegqX2Bjz3xtC8Ygpf4TQ6vVHmRvkiD-DQD65vHaaP-FQBo2BJNHp5xc1qEXDDd5iw2sbCiFSMUpPGlwKou9AAa5tP-YKvRvDDpirwG6HDFr3VZwJjq84xJQyeOp~gHDuLNhs1zli31dhV2eHxYJnX5YDo4NyIsCsdn881meSK98gCLNpDiUF1YTY5esKhJeW0pdTHn0N7cO42F~BI4UGK4cdrCTTKEzNdoEudaUy9W1~a4bFArp7hFDUji~3Yw__?updatedAt=1725477911646', 
            'details' => 'Join us for an exciting day of coding, problem-solving, and innovation...  (Add more details here)',
            'registrationLink' => '#', // Add your actual registration link
            'brochureLink' => '#'  // Add your actual brochure link
        ],
        [
            'index' => '2',
            'title' => 'Tinkerfest Robotics Competition',
            'date' => 'August 6th, 2024',
            'location' => 'Seth Anandram Jaipuria School, Vasundhara',
            'image' => 'https://ik.imagekit.io/036wrwwve/Moodle/bbb5ed2979372f2f7e1d5e75cf20467d_Expires=1726444800&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=oLw01BICiHQeVMExqX0H-OZSTHyLOmgrfgT-b46FENYKjlhY75mlozm~yMtFZph6UBADl8gWG-TgLzaEvLdoY5DcegqX2Bjz3xtC8Ygpf4TQ6vVHmRvkiD-DQD65vHaaP-FQBo2BJNHp5xc1qEXDDd5iw2sbCiFSMUpPGlwKou9AAa5tP-YKvRvDDpirwG6HDFr3VZwJjq84xJQyeOp~gHDuLNhs1zli31dhV2eHxYJnX5YDo4NyIsCsdn881meSK98gCLNpDiUF1YTY5esKhJeW0pdTHn0N7cO42F~BI4UGK4cdrCTTKEzNdoEudaUy9W1~a4bFArp7hFDUji~3Yw__?updatedAt=1725477911646',
            'details' => '(Add your expanded details here for Tinkerfest)',
            'registrationLink' => '#',
            'brochureLink' => '#'
        ],
        [
            'index' => '3',
            'title' => 'Tinkerfest Robotics Competition',
            'date' => 'August 13th, 2024',
            'location' => 'Seth Anandram Jaipuria School, Vasundhara',
            'image' => 'https://ik.imagekit.io/036wrwwve/Moodle/bbb5ed2979372f2f7e1d5e75cf20467d_Expires=1726444800&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=oLw01BICiHQeVMExqX0H-OZSTHyLOmgrfgT-b46FENYKjlhY75mlozm~yMtFZph6UBADl8gWG-TgLzaEvLdoY5DcegqX2Bjz3xtC8Ygpf4TQ6vVHmRvkiD-DQD65vHaaP-FQBo2BJNHp5xc1qEXDDd5iw2sbCiFSMUpPGlwKou9AAa5tP-YKvRvDDpirwG6HDFr3VZwJjq84xJQyeOp~gHDuLNhs1zli31dhV2eHxYJnX5YDo4NyIsCsdn881meSK98gCLNpDiUF1YTY5esKhJeW0pdTHn0N7cO42F~BI4UGK4cdrCTTKEzNdoEudaUy9W1~a4bFArp7hFDUji~3Yw__?updatedAt=1725477911646',
            'details' => '(Add your expanded details here for Tinkerfest)',
            'registrationLink' => '#',
            'brochureLink' => '#'
        ],
        [
            'index' => '4',
            'title' => 'Tinkerfest Robotics Competition',
            'date' => 'August 20th, 2024',
            'location' => 'Seth Anandram Jaipuria School, Vasundhara',
            'image' => 'https://ik.imagekit.io/036wrwwve/Moodle/bbb5ed2979372f2f7e1d5e75cf20467d_Expires=1726444800&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=oLw01BICiHQeVMExqX0H-OZSTHyLOmgrfgT-b46FENYKjlhY75mlozm~yMtFZph6UBADl8gWG-TgLzaEvLdoY5DcegqX2Bjz3xtC8Ygpf4TQ6vVHmRvkiD-DQD65vHaaP-FQBo2BJNHp5xc1qEXDDd5iw2sbCiFSMUpPGlwKou9AAa5tP-YKvRvDDpirwG6HDFr3VZwJjq84xJQyeOp~gHDuLNhs1zli31dhV2eHxYJnX5YDo4NyIsCsdn881meSK98gCLNpDiUF1YTY5esKhJeW0pdTHn0N7cO42F~BI4UGK4cdrCTTKEzNdoEudaUy9W1~a4bFArp7hFDUji~3Yw__?updatedAt=1725477911646',
            'details' => '(Add your expanded details here for Tinkerfest)',
            'registrationLink' => '#',
            'brochureLink' => '#'
        ],
	// ... more events
*/
    ]
    
];

// Add 'first' flag for active class in carousel
foreach ($carouselItems as $key => &$item) {
    $item['first'] = ($key === 0);
}

$context = [
    'items' => $carouselItems,
];

$principal_data=[
    "principal_name"=>"Light Yagami",
    "video_link"=>"",
    "heading"=>"hello this is your principal",
    "summary"=>"",
    "schoolBuilding_img"=>"",
    "principal_img"=>"",
];

try {
    $curl = curl_init();
    $schoolName = urlencode('Seth Anandram Jaipuria School');
    curl_setopt_array($curl, [
        CURLOPT_URL => 'http://host.docker.internal:4000/api/home?schoolName='.urlencode($schoolName),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => false, 
        CURLOPT_SSL_VERIFYPEER => false, 
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTPHEADER => [
            "Content-Type" => 'application/json'
        ]
    ]);
    $response = curl_exec($curl);
    if($response===false){
        $error=curl_error($curl);
        echo 'error: '.$error;
    }
    else{ 
        $data=json_decode($response);
        $principal_data = [
            "principal_name" => $data->principal->principalName,
            "video_link" => $data->principal->videoLinkUrl,
            "heading" => $data->principal->heading,
            "summary" => $data->principal->quickSummary,
            "schoolBuilding_img" => $data->principal->schoolBuildingImg,
            "principal_img" => $data->principal->principalImg
        ];
    
        
     }
     
    curl_close($curl);
} catch (Exception $e) {
    echo $e->getMessage();

}



// *** Start Output Buffering ***
ob_start();
?>

    <!-- Your Custom HTML Structure for the Home Page -->
    
<link rel="stylesheet" href="<?php echo $CFG->wwwroot; ?>/theme/academi/style/home_rancholabs.css">
<div>

        <div>
        <section class="section-1">
            <div class="section-1-left">
                <div class="school-logo-box">
                    <img
                        class="school-logo"
			src=<?php echo(getenv("SchoolLogo"))?>
                        alt="school logo" />
                    <div class="pole"></div>
                    <div class="logo-text ff-open-sans">
		    <h1 class="name-dark text-primary-text-color;"><?php echo(getenv("SchoolName"))?></h1>
                        <p class="name-light" style="font-weight: 400; color: #99A7B9;">in collaboration with</p>
                        <h1 class="name-dark text-primary-text-color;">Rancholabs</h1>
                    </div>
                </div>
                <div class="hero-text-box">
                    <div>
                        <h1 class="font-[700]"><span
                                class="text-primary-text-color">Guide</span> <span
                                class="text-orange-text-color">innovative</span></h1>
                        <h1 class="font-[700]"><span
                                class="text-orange-text-color">minds</span> <span class="text-primary-text-color">to
                                a</span></h1>
                        <h1 class="font-[700] text-primary-text-color">
                            brighter future</h1>
                    </div>
                    <p class="hero-paragraph text-[#0D1216] font-[400] max-w-[528px] leading-[28px]">Explore our
                        interactive courses in coding, robotics, and AI designed for students from class 3rd to 12th</p>
                </div>
            </div>
            <div class="section-1-right">
                <div></div>
                <img class="col-span-1 row-span-1 w-full h-full object-cover rounded-md"
                    src="https://ik.imagekit.io/036wrwwve/Moodle/Frame%201000002617.png?updatedAt=1723446488359"
                    alt="image1" />
                    <img class="col-span-1 row-span-1 w-full h-full object-cover rounded-md"
                    src="https://ik.imagekit.io/036wrwwve/Moodle/Frame%201000002622.png?updatedAt=1723446488115"
                    alt="image2" />
                    <img class="col-span-1 row-span-1 w-full h-full object-cover rounded-md"
                    src="https://ik.imagekit.io/036wrwwve/Moodle/demo2.jpg?updatedAt=1725356944606"
                    alt="image3" />
                    <div class="col-span-2 row-span-1 w-full h-full rounded-md: overflow: hidden;">
                    <video autoplay muted loop style="height: 100%; width: 100%; object-fit: cover; border-radius: 5px;">
                        <source
                            src="https://ilms-public.s3.ap-south-1.amazonaws.com/Homepage/rancholabs_awareness2.mp4"
                            type="video/mp4"
                        />
                        Your browser does not support the video tag.
                    </video>
                    </div>
                    <!-- <iframe class="col-span-2 row-span-1 w-full h-full rounded-md"
                    src="https://www.youtube.com/embed/ezbJwaLmOeM?si=r-J4LvvVgCnKMVk6&amp;start=4&amp;&amp;autoplay=1"
                    title="YouTube video player" frameBorder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerPolicy="strict-origin-when-cross-origin" allowFullScreen=""></iframe> -->
                    <img
                    class="col-span-1 row-span-1 w-full h-full object-cover rounded-md"
                    src="https://ik.imagekit.io/036wrwwve/Moodle/demo3.jpg?updatedAt=1725357219244"
                    alt="image4" />
                    <img class="col-span-1 row-span-1 w-full h-full object-cover rounded-md"
                    src="https://ik.imagekit.io/036wrwwve/Moodle/Frame%201000002620.png?updatedAt=1723446488140"
                    alt="image5" />
                <div></div>
            </div>
        </section>
        <section class="section-2 flex flex-col gap-[16px] py-[24px] bg-card-bg ">
            <div>
                <h1
                    class="sponser-heading-text text-primary-text-color text-center ff-raleway">
                    Backed & Funded by</h1>
            </div>
            <div class="flex justify-center items-center gap-[64px]">
                <div class="flex items-center gap-[12px]"><img class="sponser-image"
                        src="https://ik.imagekit.io/036wrwwve/Moodle/9eaab3dfe6d99c70ef0b48a24dfff68a.png?updatedAt=1723448229861"
                        alt="iit logo" />
                    <h1 class="sponser-text black-text">IIT DELHI</h1>
                </div>
                <div class="flex items-center gap-[12px]"><img class="sponser-image"
                        src="https://ik.imagekit.io/036wrwwve/Moodle/image%2041.png?updatedAt=1723448229774"
                        alt="IHFC logo" />
                    <h1 class="sponser-text black-text">IHFC</h1>
                </div>
                <div class="flex items-center gap-[12px]"><img class="sponser-image-2"
                        src="https://ik.imagekit.io/036wrwwve/Moodle/Frame%201000002613.png?updatedAt=1723448229796"
                        alt="MSAT logo" /></div>
                </div>
        </section>

        <!-- PRINCIPAL SECTION -->
        <section class="principal-section">
    <div class="principal-container" style="background-image: url('<?php echo $principal_data['schoolBuilding_img'] ?>')">
        <div class="principal-overlay">
            <div class="principal-content">
                <h2 class="principal-vision-title">OUR PRINCIPAL'S VISION</h2>
                <p class="principal-heading">
                    "<?php echo($principal_data['heading']);  ?>"
                </p>

                <p class="principal-summary"><?php echo($principal_data['summary']) ?></p>

                <div class="principal-info">
                    <img src="<?php echo($principal_data['principal_img'])?>" alt="<?php echo($principal_data['principal_name']) ?>" class="principal-img-small">
                    <div>
                        <strong><?php echo($principal_data['principal_name']) ?></strong><br>
                        Principal, <?php echo(getenv("SchoolName"))?>
                    </div>
                </div>
            </div>
            <div class="principal-image-container">
                <img src="<?php echo($principal_data['principal_img']) ?>" alt="Principal Profile Pic" class="principal-img-large">
                <div class="image-gradient"></div>
                <div class="play-button-container">
                        <button id="playButton" class="play-button">
                            <svg width="80" height="80" viewBox="0 0 102 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.9">
                                    <g filter="url(#filter0_d_624_1923)">
                                    <circle cx="48.8926" cy="52.8926" r="34.8926" fill="#FEFEFE"/>
                                    </g>
                                    <g filter="url(#filter1_i_624_1923)">
                                    <path d="M66.398 51.2977C68.1395 52.3031 68.1395 54.8168 66.398 55.8222L41.5024 70.1957C39.7609 71.2012 37.584 69.9444 37.584 67.9334L37.584 39.1865C37.584 37.1756 39.7609 35.9187 41.5024 36.9242L66.398 51.2977Z" fill="#FF9533"/>
                                    </g>
                                    </g>
                                    <defs>
                                    <filter id="filter0_d_624_1923" x="-3.4347" y="0.565301" width="104.655" height="104.655" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                    <feMorphology radius="4.29426" operator="dilate" in="SourceAlpha" result="effect1_dropShadow_624_1923"/>
                                    <feOffset/>
                                    <feGaussianBlur stdDeviation="6.57022"/>
                                    <feComposite in2="hardAlpha" operator="out"/>
                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_624_1923"/>
                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_624_1923" result="shape"/>
                                    </filter>
                                    <filter id="filter1_i_624_1923" x="37.584" y="36.5703" width="30.1211" height="33.9795" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                    <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                    <feOffset/>
                                    <feGaussianBlur stdDeviation="3.65012"/>
                                    <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>
                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.12 0"/>
                                    <feBlend mode="normal" in2="shape" result="effect1_innerShadow_624_1923"/>
                                    </filter>
                                    </defs>
                            </svg>
                        </button>
                    <div class="principal-name"><?php echo($principal_data['principal_name']) ?></div>
                </div>
            </div>
        </div>
    </div>
</section>
x`

        <div id="myModal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); justify-content: center; align-items: center;">
            <div style="position: relative; background-color: #fff; padding: 20px; width: 80%; max-width: 700px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <!-- <span id="closeBtn" style="position: absolute; top: 10px; right: 20px; font-size: 24px; font-weight: bold; color: #333; cursor: pointer;">X</span> -->
                <video id="videoPlayer" controls style="width: 100%; border-radius: 10px;">
                    <source src=<?php echo($principal_data['video_link'])?> >
                </video>
            </div>
        </div>

        <script>
            const modal = document.getElementById("myModal");
            const playButton = document.getElementById("playButton");
            const closeBtn = document.getElementById("closeBtn");
            const videoPlayer=document.getElementById("videoPlayer");

            playButton.onclick = function () {
                modal.style.display = "flex";
            }

            // closeBtn.onclick = function () {
            //     modal.style.display = "none";
            // }

            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    videoPlayer.pause();
                }
            }
        </script>


        <section class="section-3 py-[48px]">
            <div class="s3-school">
                <h1
                    class="ranchos-from text-primary-text-color text-center ff-raleway">
                    Ranchos from</h1>
                <h1
                    class="ranchos-from-school text-primary-text-color text-center ff-raleway">
                	<?php echo(getenv("SchoolName"))?> 
		</h1>
            </div>
            <div class="stories-grid ff-open-sans">
                <?php echo $OUTPUT->render_from_template('theme_academi/story_card', $storiescontext); ?>
            </div>
            <div class="stories-carousel">
                <?php echo $OUTPUT->render_from_template('theme_academi/stories-carousel', $storiescontext); ?>
            </div>
        </section>
        <section class="section-4 bg-hero-background">
            <div class="flex-1 flex items-center justify-center">
                <img class="object-cover"
                    src="https://ik.imagekit.io/036wrwwve/Moodle/d9135bf5c89a6e0fa2ddfc864ba13252_Expires=172644480%20(1).jpg?updatedAt=1725477675663"
                    alt="LMS" />
            </div>
            <div class="flex-1" style="display: flex; flex-direction: column; align-items: center;">
                <div>
                    <h2 class="text-orange-text-color text-[16px] font-[800] leading-[19.2px] __className_fd1bfb mb-2">Rancholabs&nbsp;iLMS</h2>

                    <h1 class="ilms-description text-primary-text-color max-w-[523px] __className_b40a1f mb-4">Transforming Education into Playful Adventures</h1>
                </div>
                <div class="lms-points flex flex-col gap-[20px] mb-[32px] ff-open-sans">
                    <div class="flex gap-[14px] items-center"><svg width="21" height="21" viewBox="0 0 21 21"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10.4453 20.9834C15.9682 20.9834 20.4453 16.5062 20.4453 10.9834C20.4453 5.46055 15.9682 0.983398 10.4453 0.983398C4.92246 0.983398 0.445312 5.46055 0.445312 10.9834C0.445312 16.5062 4.92246 20.9834 10.4453 20.9834ZM9.19479 12.9357L14.6932 5.68652L16.444 7.18652L9.44323 16.1865L4.44401 11.1873L5.94401 9.6873L9.19479 12.9357Z"
                                fill="#FF7A00"></path>
                        </svg>
                        <p class="text-[#21313D] opacity-[0.6]">Go beyond
                            paperwork with Dedicated Dashboards</p>
                    </div>
                    <div class="flex gap-[14px] items-center"><svg width="21" height="21" viewBox="0 0 21 21"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10.4453 20.9834C15.9682 20.9834 20.4453 16.5062 20.4453 10.9834C20.4453 5.46055 15.9682 0.983398 10.4453 0.983398C4.92246 0.983398 0.445312 5.46055 0.445312 10.9834C0.445312 16.5062 4.92246 20.9834 10.4453 20.9834ZM9.19479 12.9357L14.6932 5.68652L16.444 7.18652L9.44323 16.1865L4.44401 11.1873L5.94401 9.6873L9.19479 12.9357Z"
                                fill="#FF7A00"></path>
                        </svg>
                        <p class="text-[#21313D] opacity-[0.6]">Play with engaging
                            content and gamified activities</p>
                    </div>
                    <div class="flex gap-[14px] items-center"><svg width="21" height="21" viewBox="0 0 21 21"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10.4453 20.9834C15.9682 20.9834 20.4453 16.5062 20.4453 10.9834C20.4453 5.46055 15.9682 0.983398 10.4453 0.983398C4.92246 0.983398 0.445312 5.46055 0.445312 10.9834C0.445312 16.5062 4.92246 20.9834 10.4453 20.9834ZM9.19479 12.9357L14.6932 5.68652L16.444 7.18652L9.44323 16.1865L4.44401 11.1873L5.94401 9.6873L9.19479 12.9357Z"
                                fill="#FF7A00"></path>
                        </svg>
                        <p class="text-[#21313D] opacity-[0.6]">Manage everything
                            and everyone from any device</p>
                    </div>
                </div>
                <div class="trydemo">                      
                    
                </div>
            </div>
        </section>
	<section class="section-5">
<!--
            <div>
                <div class="genius_box_left">
                    <div class="flex flex-col gap-[20px] mb-[32px]">
                        <h2 class="text-orange-text-color text-[20px] font-[800] leading-[19.2px] ff-raleway">
                            Genius of the month
                        </h2>
                        <div style="mb-2 ff-open-sans">
                            <h1 class="genius_box-title-text text-primary-text-color max-w-[523px] mb-1 ff-open-sans">
                                Gokul Kataria makes invisible drones
                            </h1>
                            <p class="text-[#21313D] text-[20px] font-[500] leading-[24px] opacity-[0.6] ff-open-sans">
                                August 2024
                            </p>
                        </div>
                        <p class="genius-box-description text-[#21313D] opacity-[0.6] ff-open-sans" style="text-align: justify;">
                            Gokul Kataria made significant strides in his school robotics project by creating invisible drones. Leveraging cutting-edge technology and innovative design principles, Gokul developed drones that are not only highly functional but also difficult to detect. His work has garnered attention for its potential applications in various fields, from security to research. 
                        </p>
                    </div>
                </div>
                <div class="genius_box_right">
                    <?php echo $OUTPUT->render_from_template('theme_academi/carousel', $context); ?>
                </div>
	    </div>
	-->
        </section>

        <section class="section-6" style="background-color: #F7F8F9; padding-top: 32px; padding-bottom: 44px;">
            <div class="events-box">
                <h1 style="width: 100%; text-align:center;">Events</h1>
                <?php echo $OUTPUT->render_from_template('theme_academi/events_card', $eventsData); ?>
            </div>

        </section>
    </div>
</div>

<?php
// *** End Output Buffering & Capture Content ***
$custom_html_content = ob_get_clean();

$templatecontext += [
    'bodyattributes' => $bodyattributes,
    'jumbotronclass' => $jumbotronclass,
    'custom_main_content' => $custom_html_content,
];
echo $OUTPUT->render_from_template('theme_academi/ranchohome', $templatecontext);