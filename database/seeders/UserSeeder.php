<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table("users")->insert([
            [
                "name" => "ADMIN",
                "email" => "admin@gmail.com",
                "password" => Hash::make("admin"),
                "admin" => true,
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "data_nasc" => "2008-02-26",
                "created_at" => "2025-05-25"
            ],
            [
                "name" => "Alessandro",
                "email" => "alessandro@gmail.com",
                "password" => Hash::make("alessandro123"),
                "admin" => false,
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "data_nasc" => "2007-02-26",
                "created_at" => "2025-05-25"
            ],
            [
                "name" => "user3",
                "email" => "user3@gmail.com",
                "password" => Hash::make("user3"),
                "admin" => true,
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "data_nasc" => "2008-02-26",
                "created_at" => "2025-05-25"
            ],
            [
                "name" => "user4",
                "email" => "user4@gmail.com",
                "password" => Hash::make("user4"),
                "admin" => true,
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "data_nasc" => "2008-02-26",
                "created_at" => "2025-05-25"
            ],
            [
                "name" => "user5",
                "email" => "user5@gmail.com",
                "password" => Hash::make("user5"),
                "admin" => true,
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "data_nasc" => "2008-02-26",
                "created_at" => "2025-05-25"
            ],
            [
                "name" => "user6",
                "email" => "user6@gmail.com",
                "password" => Hash::make("user6"),
                "admin" => true,
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "data_nasc" => "2008-02-26",
                "created_at" => "2025-05-25"
            ],
            [
                "name" => "user7",
                "email" => "user7@gmail.com",
                "password" => Hash::make("user7"),
                "admin" => true,
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "data_nasc" => "2008-02-26",
                "created_at" => "2025-05-25"
            ],
            [
                "name" => "user8",
                "email" => "user8@gmail.com",
                "password" => Hash::make("user8"),
                "admin" => true,
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "data_nasc" => "2008-02-26",
                "created_at" => "2025-05-25"
            ],
            [
                "name" => "user9",
                "email" => "user9@gmail.com",
                "password" => Hash::make("user9"),
                "admin" => true,
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "data_nasc" => "2008-02-26",
                "created_at" => "2025-05-25"
            ],
            [
                "name" => "user10",
                "email" => "user10@gmail.com",
                "password" => Hash::make("user10"),
                "admin" => true,
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "data_nasc" => "2008-02-26",
                "created_at" => "2025-05-25"
            ],
        ]);
    }
}
