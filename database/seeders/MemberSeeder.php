<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws FileNotFoundException
     * @example php artisan db:seed --class=MemberSeeder
     */
    public function run(): void
    {
        // 讀取 JSON
//        $path = database_path('seeders/files/members.json');
        $path = database_path('seeders/files/members_25-11-18.json');

        if (!File::exists($path)) {
            $this->command->error("members.json not found: $path");
            return;
        }

        $members = json_decode(File::get($path), true);

        if (!is_array($members)) {
            $this->command->error("members.json 格式錯誤");
            return;
        }

        foreach ($members as $member) {

            // 密碼：員工生日 4 碼 → bcrypt
            $password = Hash::make($member['password_raw']);

            Member::query()->updateOrCreate(
                [
                    // 以 code 當唯一識別
                    'code' => $member['code']
                ],
                [
                    'role' => $member['role'],
                    'password' => $password,
                    'name' => $member['name'],
                    'english_name' => $member['english_name'],
                ]
            );

            $this->command->line("    MemberSeeder 匯入：" . $member['code'] . ' | ' . $member['name']);
        }

        $this->command->info("    MemberSeeder 執行完畢，共匯入：" . count($members) . " 位員工");
    }
}
