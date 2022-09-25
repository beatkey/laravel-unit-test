<?php

    namespace Tests\Feature;

    use App\Models\User;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Illuminate\Support\Str;
    use Tests\TestCase;

    class UserTest extends TestCase
    {
        /**
         * A basic feature test example.
         *
         * @return void
         */
        public function test_user_get(){
            $user = User::factory()->create();

            $this->getJson("/api/users/" . $user->id)
                ->assertStatus(200);
        }

        public function test_user_list(){
            User::query()->delete();
            $users = User::factory(2)->create()->map(function ($user){
                return $user->only(["id", "name", "email"]);
            });

            $this->getJson("/api/users")
                ->assertStatus(200)
                ->assertJson($users->toArray())
                ->assertJsonStructure([
                    "*" => ["id", "name", "email"]
                ]);
        }

        public function test_user_create(){
            $data = [
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ];

            $this->postJson('/api/users', $data)
                ->assertStatus(201);
        }

        public function test_user_update(){
            $user = User::factory()->create();

            $data = [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
            ];

            $this->putJson("/api/users/" . $user->id, $data)
                ->assertStatus(200)
                ->assertJson($data);
        }

        public function test_user_delete(){
            $user = User::factory()->create();

            $this->deleteJson("/api/users/" . $user->id)
                ->assertStatus(204);
        }
    }
