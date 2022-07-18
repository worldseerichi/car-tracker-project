<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Device;
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

        $device = Device::create([
            'user_id' => $user['id'],
            'device_id' => '123456789012345',
        ]);
        $device2 = Device::create([
            'user_id' => $user2['id'],
            'device_id' => '123456789012346',
        ]);
        $device3 = Device::create([
            'user_id' => $user['id'],
            'device_id' => '123123123123123',
        ]);
        $device4 = Device::create([
            'user_id' => $user2['id'],
            'device_id' => '321321321321321',
        ]);

        $device5 = Device::create([
            'user_id' => $user['id'],
            'device_id' => '121212121212121',
        ]);

        $device6 = Device::create([
            'user_id' => $user['id'],
            'device_id' => '323232323232323',
        ]);

        /*$path = [[39.74084526081704, -8.802359366435601],
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
                'device_id' => $device['id']
            ]);
            sleep(2);
        };
        $path2 = [[39.73385903886764, -8.824208772332776],
                 [39.73395778524304, -8.823491417392402],
                 [39.73359612407674, -8.823071977746904],
                 [39.73256143083124, -8.82233589635804],
                 [39.73260295288116, -8.82161978762878],
                 [39.732960403889145, -8.820824230249205],
                 [39.7339662629056, -8.821831328380538],
                 [39.73414262189743, -8.82266286748996],
                 [39.73476103196309, -8.821842035682156]];
        foreach ($path2 as $coords) {
            TrackingData::create([
                'latitude' => $coords[0],
                'longitude' => $coords[1],
                'device_id' => $device2['id']
            ]);
            sleep(2);
        };
        $path3 = [[39.73566746680331, -8.799291723872722],
                 [39.735490749258176, -8.799880957062419],
                 [39.73545690268953, -8.80053947054053],
                 [39.73429987143241, -8.803849372304667]];
        foreach ($path3 as $coords) {
            TrackingData::create([
                'latitude' => $coords[0],
                'longitude' => $coords[1],
                'device_id' => $device3['id']
            ]);
            sleep(2);
        };*/
    }
}
