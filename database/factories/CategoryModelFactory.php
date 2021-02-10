<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Shop\Categories\Category;
use Illuminate\Http\UploadedFile;

$factory->define(Category::class, function (Faker\Generator $faker) {
    $name = $faker->unique()->randomElement([
        'Appointment Cards',
        'Banners',
        'Booklets',
        'Bookmarks',
        'Brochures',
        'Buckslips',
        'Business Cards',
        'Calendars',
        'Car Magnets',
        'Carbonless Forms',
        'Catalogs',
        'CD Products',
        'Door Hangers',
        'DVD Products',
        'Envelopes',
        'Feather Flags',
        'Every Door Direct Mail®',
        'Flyers',
        'Greeting Cards',
        'Hang Tags',
        'Header Cards',
        'Holiday Cards',
        'Labels',
        'Magazines',
        'Magnet Printing',
        'Mailing Services',
        'Metal A-Frame Signs',
        'Menu Printing',
        'Newsletters',
        'Notepads',
        'Pocket Folders',
        'Plastic A-Frame Signs',
    ]);

    $file = UploadedFile::fake()->image('category.png', 600, 600);

    return [
        'name' => $name,
        'slug' => str_slug($name),
        'description' => $faker->paragraph,
        'cover' => $file->store('categories', ['disk' => 'public']),
        'status' => 1
    ];
});
