<?php

use App\Enums\AnswerOrderStatus;
use App\Enums\CorrectStatus;
use App\Enums\InputType;
use App\Enums\QuestionOrderStatus;
use App\Enums\RankingStatus;
use App\Enums\ResultStatus;
use App\Enums\TimeMode;

return [

    TimeMode::class => [
        TimeMode::NoLimit => 'Tanpa Batas',
        TimeMode::TimeLimit => 'Batas Waktu',
        TimeMode::PerQuestion => 'Per Pertanyaan',
    ],

    QuestionOrderStatus::class => [
        QuestionOrderStatus::Sequence => 'Urut',
        QuestionOrderStatus::Random => 'Acak',
    ],

    AnswerOrderStatus::class => [
        AnswerOrderStatus::Sequence => 'Urut',
        AnswerOrderStatus::Random => 'Acak',
    ],

    ResultStatus::class => [
        ResultStatus::Show => 'Tampilkan',
        ResultStatus::Hide => 'Sembunyikan',
    ],

    RankingStatus::class => [
        RankingStatus::Show => 'Tampilkan',
        RankingStatus::Hide => 'Sembunyikan',
    ],

    InputType::class => [
        InputType::Text => 'Teks',
        InputType::ImageUrl => 'Gambar',
    ],

    CorrectStatus::class => [
        CorrectStatus::True => 'Benar',
        CorrectStatus::False => 'Salah',
    ]
];
