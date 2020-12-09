<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department_array = [
            "文学科", "教育学科", "経済学科", "経営学科", "商学科",
            "社会学科", "法学科", "外国語学科", "国際学科", "体育学科",
            "福祉学科", "芸術学科", "観光学科", "神学科", "総合政策学科",
            "音楽学科","理学科", "工学科", "理工学科", "情報学科", "農学科",
            "医学科","看護学科", "薬学科", "歯学科", "建築学科", "海洋学科",
            "スポーツ健康科学科", "芸術工学科", "生命科学科", "その他"
        ];

        foreach ($department_array as $department_name)
        {
          DB::table('department')->insert([
            [
              'department_name' => $department_name,
              'created_at'   => new DateTime(),
              'updated_at'   => new DateTime(),
            ],
          ]);
        }
    }
}
