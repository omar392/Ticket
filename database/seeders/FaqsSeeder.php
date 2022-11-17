<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::create([
            'question_ar' => 'هنا انت تسأل ؟',
            'question_en' => 'Are You Ask ?',
            'answer_ar' => 'هنا نحن نجيب على اسئلتك',
            'answer_en' => 'There we answer your Questions',
        ]);
    }
}
