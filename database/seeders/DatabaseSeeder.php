<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rsu;
use App\Models\TrackingData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        /*User::factory()->create([
             'username' => 'root',
             'password' => 'root',
             'is_admin' => true
        ]);*/

        DB::table('users')->insert([
            'username' => 'root',
            'password' => Hash::make('root'),
            'is_admin' => true
        ]);

        //next lines are for testing purposes, delete when app is online
        $user = User::create([
            'username' => 'testuser',
            'password' => Hash::make('test')
        ]);
        $user2 = User::create([
            'username' => 'testuser2',
            'password' => Hash::make('test')
        ]);

        $rsu = Rsu::create([
            'user_id' => $user['id'],
        ]);
        $rsu2 = Rsu::create([
            'user_id' => $user2['id'],
        ]);

        $path = [[39.74084526081704, -8.802359366435601],
                [39.74004168723268, -8.804373422691963],
                [39.73980177796016, -8.805855464918467],
                [39.73957817225259, -8.808845159503642],
                [39.74023501196083, -8.809599398558404],
                [39.7413180850293, -8.810380899271072],
                [39.740947745839435, -8.811389580421277],
                [39.73975985194463, -8.812580005920537],
                [39.73943143060917, -8.814724589267373],
                [39.73937552894832, -8.816905521485008],
                [39.73873265660185, -8.818931971002364],
                [39.737243698832735, -8.82156880700348],
                [39.73528091211661, -8.82357019623503],
                [39.73387345567432, -8.823229660163358],
                [39.73263077411064, -8.821333051586823],
                [39.733978469984486, -8.82185651555642],
                [39.735069293462466, -8.820662083889975]];
        foreach ($path as $coords) {
            TrackingData::create([
                'latitude' => $coords[0],
                'longitude' => $coords[1],
                'rsu_id' => $rsu['id']
            ]);
        };
        $path2 = [];
    }
}
