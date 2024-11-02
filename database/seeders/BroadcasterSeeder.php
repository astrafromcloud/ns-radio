<?php

namespace Database\Seeders;

use App\Models\Broadcaster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BroadcasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $broadcasters =
        [
            ['name' => 'Иван Вельчинский', 'description' => 'Доброе утро, Алматы!', 'image_path' => 'broadcasters/presenter1.png', 'bio' => 'Привет, я Вэл, из династии не смотревших «Игру престолов», но надеющихся когда-нибудь её посмотреть! Родился на севере, и не понаслышке знаю, что такое -53 за окном. Единственное, с чем я никогда не смирюсь в этой жизни, это когда дерёшься во сне с замедлением. Панически боюсь высоты, но прыгал с парашютом БЕЗ ИНСТРУКТОРА (люблю своих друзей и их подарки). Я тебя еще не знаю, но иди сюда, обниму!', 'instagram_url' => 'https://www.instagram.com/radio_ns/', 'youtube_url' => 'https://www.instagram.com/radio_ns/', 'whatsapp_url' => 'https://www.instagram.com/radio_ns/', 'telegram_url' => 'https://www.instagram.com/radio_ns/'],
            ['name' => 'Алена Малышева', 'description' => 'Шоу Мода', 'image_path' => 'broadcasters/presenter2.png', 'bio' => 'Привет, я Вэл, из династии не смотревших «Игру престолов», но надеющихся когда-нибудь её посмотреть! Родился на севере, и не понаслышке знаю, что такое -53 за окном. Единственное, с чем я никогда не смирюсь в этой жизни, это когда дерёшься во сне с замедлением. Панически боюсь высоты, но прыгал с парашютом БЕЗ ИНСТРУКТОРА (люблю своих друзей и их подарки). Я тебя еще не знаю, но иди сюда, обниму!', 'instagram_url' => 'https://www.instagram.com/radio_ns/', 'youtube_url' => '', 'whatsapp_url' => 'https://www.instagram.com/radio_ns/', 'telegram_url' => 'https://www.instagram.com/radio_ns/'],
            ['name' => 'Павел Смелов', 'description' => 'Шоу Мода', 'image_path' => 'broadcasters/presenter3.png', 'bio' => 'Привет, я Вэл, из династии не смотревших «Игру престолов», но надеющихся когда-нибудь её посмотреть! Родился на севере, и не понаслышке знаю, что такое -53 за окном. Единственное, с чем я никогда не смирюсь в этой жизни, это когда дерёшься во сне с замедлением. Панически боюсь высоты, но прыгал с парашютом БЕЗ ИНСТРУКТОРА (люблю своих друзей и их подарки). Я тебя еще не знаю, но иди сюда, обниму!', 'instagram_url' => '', 'youtube_url' => 'https://www.instagram.com/radio_ns/', 'whatsapp_url' => 'https://www.instagram.com/radio_ns/', 'telegram_url' => 'https://www.instagram.com/radio_ns/'],
            ['name' => 'Арсен', 'description' => 'Шоу Мода', 'image_path' => 'broadcasters/arsen.png', 'bio' => 'Привет, я Вэл, из династии не смотревших «Игру престолов», но надеющихся когда-нибудь её посмотреть! Родился на севере, и не понаслышке знаю, что такое -53 за окном. Единственное, с чем я никогда не смирюсь в этой жизни, это когда дерёшься во сне с замедлением. Панически боюсь высоты, но прыгал с парашютом БЕЗ ИНСТРУКТОРА (люблю своих друзей и их подарки). Я тебя еще не знаю, но иди сюда, обниму!', 'instagram_url' => '', 'youtube_url' => 'https://www.instagram.com/radio_ns/', 'whatsapp_url' => 'https://www.instagram.com/radio_ns/', 'telegram_url' => ''],
            ['name' => 'Петр', 'description' => 'Шоу Мода', 'image_path' => 'broadcasters/petr.png', 'bio' => 'Привет, я Вэл, из династии не смотревших «Игру престолов», но надеющихся когда-нибудь её посмотреть! Родился на севере, и не понаслышке знаю, что такое -53 за окном. Единственное, с чем я никогда не смирюсь в этой жизни, это когда дерёшься во сне с замедлением. Панически боюсь высоты, но прыгал с парашютом БЕЗ ИНСТРУКТОРА (люблю своих друзей и их подарки). Я тебя еще не знаю, но иди сюда, обниму!', 'instagram_url' => '', 'youtube_url' => '', 'whatsapp_url' => '', 'telegram_url' => 'https://www.instagram.com/radio_ns/']
        ];

        foreach ($broadcasters as $broadcaster) {
            Broadcaster::create($broadcaster);
        }
    }
}
