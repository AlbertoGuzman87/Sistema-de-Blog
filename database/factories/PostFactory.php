<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //SLUG
        //Hola Mundo Como  Estas
        //hola-mundo-como-estas

        $name = $this->faker->unique()->sentence();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'extract' => $this->faker->text(250),
            'body' => $this->faker->text(2000),
            'status' => $this->faker->randomElement([1, 2]),
            //Del modelo category taer todo y escoge uno al azar y toma su id
            'category_id' => Category::all()->random()->id,
            //Del modelo user taer todo y escoge uno al azar y toma su id
            'user_id' => User::all()->random()->id,


        ];
    }
}
