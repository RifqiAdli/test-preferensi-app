<?php
// config.php
define('DB_HOST', 'localhost');
define('DB_USER', 'luetsjkh_preferensi');
define('DB_PASS', 'preferensitfd');
define('DB_NAME', 'luetsjkh_preferensi');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define questions and options as constants
define('QUESTIONS', [
    1 => "Anda lebih suka bekerja dalam situasi yang…",
    2 => "Dalam mengerjakan tugas, Anda lebih memilih…",
    3 => "Ketika berada di tempat baru, Anda lebih tertarik untuk…",
    4 => "Saat menghadapi masalah, Anda lebih suka…",
    5 => "Dalam komunikasi, Anda lebih nyaman dengan…",
    6 => "Anda lebih tertarik pada…",
    7 => "Ketika bekerja dalam proyek, Anda lebih suka…",
    8 => "Dalam memilih aktivitas akhir pekan, Anda lebih suka…",
    9 => "Anda lebih termotivasi oleh…",
    10 => "Dalam menghadapi perubahan, Anda lebih…",
    11 => "Jika diberi pilihan pekerjaan, Anda lebih memilih…",
    12 => "Saat berkomunikasi, Anda lebih suka…",
    13 => "Dalam menghadapi tekanan, Anda lebih cenderung…",
    14 => "Ketika mendengarkan musik, Anda lebih suka…",
    15 => "Anda lebih menyukai jenis cerita yang…",
    16 => "Dalam kehidupan sosial, Anda lebih merasa nyaman…",
    17 => "Anda lebih suka belajar dengan cara…",
    18 => "Jika sedang memiliki waktu luang, Anda lebih cenderung…",
    19 => "Anda lebih menghargai…",
    20 => "Dalam mengambil keputusan, Anda lebih mengandalkan…"
]);

define('OPTIONS', [
    1 => [
        'A' => "Terstruktur dan terencana",
        'B' => "Fleksibel dan spontan"
    ],
    2 => [
        'A' => "Bekerja sendiri dengan fokus penuh",
        'B' => "Bekerja dalam tim dan berdiskusi"
    ],
    3 => [
        'A' => "Mengamati lingkungan sekitar dengan tenang",
        'B' => "Langsung berinteraksi dengan orang-orang"
    ],
    4 => [
        'A' => "Menganalisis semua kemungkinan sebelum bertindak",
        'B' => "Mengambil keputusan cepat berdasarkan intuisi"
    ],
    5 => [
        'A' => "Percakapan mendalam dengan satu orang",
        'B' => "Diskusi dengan banyak orang dalam satu kelompok"
    ],
    6 => [
        'A' => "Fakta dan data yang konkret",
        'B' => "Ide dan konsep yang abstrak"
    ],
    7 => [
        'A' => "Mengikuti rencana yang sudah ditentukan",
        'B' => "Mengembangkan ide-ide baru sepanjang proses"
    ],
    8 => [
        'A' => "Bersantai di rumah dengan buku atau film",
        'B' => "Pergi keluar dan mencoba hal baru"
    ],
    9 => [
        'A' => "Kejelasan tujuan dan hasil yang terukur",
        'B' => "Proses belajar dan eksplorasi"
    ],
    10 => [
        'A' => "Berusaha mempertahankan rutinitas yang ada",
        'B' => "Terbuka terhadap perubahan dan mencoba hal baru"
    ],
    11 => [
        'A' => "Pekerjaan yang menuntut ketelitian dan detail",
        'B' => "Pekerjaan yang memungkinkan kreativitas dan inovasi"
    ],
    12 => [
        'A' => "Menyampaikan informasi dengan jelas dan langsung",
        'B' => "Menggunakan analogi dan cerita untuk menjelaskan sesuatu"
    ],
    13 => [
        'A' => "Menyusun strategi dan menghadapi tantangan dengan logis",
        'B' => "Mengandalkan insting dan improvisasi"
    ],
    14 => [
        'A' => "Musik dengan lirik yang mendalam dan bermakna",
        'B' => "Musik dengan irama yang menyenangkan dan energik"
    ],
    15 => [
        'A' => "Berdasarkan peristiwa nyata dan sejarah",
        'B' => "Imajinatif dan penuh fantasi"
    ],
    16 => [
        'A' => "Bersama beberapa teman dekat dalam lingkungan yang tenang",
        'B' => "Menghadiri acara besar dan bertemu banyak orang"
    ],
    17 => [
        'A' => "Membaca buku dan melakukan riset sendiri",
        'B' => "Berdiskusi dan belajar melalui pengalaman langsung"
    ],
    18 => [
        'A' => "Menghabiskannya untuk refleksi dan berpikir",
        'B' => "Mencari aktivitas yang melibatkan banyak interaksi"
    ],
    19 => [
        'A' => "Stabilitas dan keamanan",
        'B' => "Kebebasan dan variasi"
    ],
    20 => [
        'A' => "Logika dan analisis",
        'B' => "Perasaan dan intuisi"
    ]
]);