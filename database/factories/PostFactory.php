<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $topics = ['Ciągniki rolnicze',"Kombajny","Produkcja roślinna","Produkcja zwierzęca","Inne"];
        return [
            //<option selected value="Ciągniki rolnicze">Ciągniki rolnicze</option>
            //                               <option value="Kombajny">Kombajny</option>
            //                               <option value="Produkcja roślinna">Produkcja roślinna</option>
            //                               <option value="Produkcja zwierzęca">Produkcja zwierzęca</option>
            //                               <option value="Inne">Inne</option>
            'user_id'=>1,
            'topic'=>$topics[array_rand($topics,1)],
            'comment'=>$this->faker->text(200),
        ];
    }
}
