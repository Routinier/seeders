<?php

namespace Routinier\Seeders;

use Carbon\Carbon;
use Faker\Generator;
use Spatie\HtmlElement\HtmlElement;
use function array_fill_keys;
use function compact;
use function mt_rand;
use function strtolower;

/**
 * Class Faker
 *
 * @package Routinier\Seeders
 */
class Faker
{
   public Generator $faker;

   public function __construct(Generator $faker)
   {
       $this->faker = $faker;
   }

   public function sometimes(): bool
   {
       return $this->faker->boolean(50);
   }

   public function rarely(): bool
   {
       return $this->faker->boolean(20);
   }

   public function mostly(): bool
   {
       return $this->faker->boolean(80);
   }

   public function sentence(int $words = 0): string
   {
       return $this->faker->sentence($words ?: mt_rand(4, 8));
   }

   public function sentences(int $min, $max = 0): string
   {
       $amount = $max ? mt_rand($min, $max) : $min;

       return $this->faker->sentences($amount, true);
   }

   public function title(): string
   {
       return rtrim($this->faker->sentence(mt_rand(2, 5)), '.');
   }

   public function paragraph(int $sentences = 0): string
   {
       return $this->faker->paragraph($sentences ?: mt_rand(6, 10));
   }

   public function paragraphs(int $min, int $max = 0): string
   {
       $amount = $max ? mt_rand($min, $max) : $min;

       return $this->faker->paragraphs($amount);
   }

   public function htmlParagraphs(int $min, int $max = 0): string
   {
       $amount = $max ? mt_rand($min, $max) : $min;

       return '<p>'.implode('</p><p>', $this->faker->paragraphs($amount)).'</p>';
   }

   public function text(): string
   {
       return HtmlElement::render('p.intro', $this->paragraph()).
           HtmlElement::render('h3', $this->sentence()).
           HtmlElement::render('p', $this->paragraph()).
           HtmlElement::render('blockquote', $this->paragraph()).
           HtmlElement::render('h3', $this->sentence()).
           HtmlElement::render('p', $this->paragraph()).
           HtmlElement::render('p', $this->paragraph());
   }

   public function person(string $firstName = '', string $lastName = ''): array
   {
       $firstName = $firstName ?: $this->faker->firstName;
       $lastName = $lastName ?: $this->faker->lastName;
       $email = strtolower($firstName) . '.' . strtolower($lastName) . '@example.tld';

       return compact('firstName', 'lastName', 'email');
   }

   public function pastDate(): Carbon
   {
       return Carbon::now()->addMinutes(-rand(0, 60 * 24 * 7 * 4));
   }

   public function futureDate(): Carbon
   {
       return Carbon::now()->addMinutes(rand(0, 60 * 24 * 7 * 4));
   }

   public function translate(string $text): array
   {
       return array_fill_keys(config('app.locales'), $text);
   }

    public function latitude(): float
    {
        return mt_rand(5035000000, 5147000000) / (10 ** 8);
    }

    public function longitude(): float
    {
        return mt_rand(266000000, 571000000) / (10 ** 8);
    }

    public function youTubeIds(int $amount): array
    {
        return collect(['iz7wtTO7roQ', 'PTvBpF-bWZI', '6v2L2UGZJAM', 'OnoNITE-CLc', 'Xq_a8f24UJI', 'k-QmqlY6Mnw'])
            ->shuffle()
            ->take($amount)
            ->toArray();
    }

    public function __get(string $name)
    {
        return $this->faker->$name;
    }

    public function __call(string $method, array $arguments)
    {
        return $this->faker->$method(...$arguments);
    }
}