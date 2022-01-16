<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class YogiRental extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobil', function (Blueprint $table) {
            $table->id();
            $table->string("codemobil")->unique();
            $table->string("namamobil");
            $table->string("warna");
            $table->string("tahun");
            $table->string("hargaperjam");
            $table->string("hargaperhari");
            $table->string("gambar");
            $table->string("keterangan");
            $table->timestamps();
        });

        Schema::create('pinjam', function (Blueprint $table) {
            $table->id();
            $table->string("codemobil")->unique();
            $table->string("namapenyewa");
            $table->string("hp");
            $table->string("alamat");
            $table->bigInteger("ktp");
            $table->string("sim");
            $table->enum("ket", ["perjam","perhari"]);
            $table->string("tanggalsewa");
            $table->string("tanggalselesai");
            $table->timestamps();
        });

        Schema::create('log_sewa', function (Blueprint $table) {
            $table->id();
            $table->string("codemobil");
            $table->string("namapenyewa");
            $table->string("hp");
            $table->string("alamat");
            $table->bigInteger("ktp");
            $table->string("sim");
            $table->enum("ket", ["perjam","perhari"]);
            $table->string("tanggalsewa");
            $table->string("tanggalselesai");
            $table->string("tanggalkembali")->nullable();
            $table->timestamps();
        });

        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->string("username")->unique();
            $table->string("password");
            $table->timestamps();
        });


        DB::table('admin')->insert([
            'nama' => 'pemilik',
            'username' => 'admin',
            'password' => Hash::make('admin123')
        ]);

        DB::unprepared('
        CREATE TRIGGER tr_log AFTER DELETE ON pinjam FOR EACH ROW
            BEGIN
                UPDATE mobil SET keterangan="ada" WHERE codemobil=OLD.codemobil;

                INSERT into log_sewa 
                (codemobil,namapenyewa,hp,alamat,ktp,sim,ket,tanggalsewa,tanggalselesai) 
                VALUES 
                (old.codemobil,old.namapenyewa,old.hp,old.alamat,old.ktp,old.sim,old.ket,old.tanggalsewa,old.tanggalselesai);
            END
        ');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobil');
        Schema::dropIfExists('pinjam');
        DB::unprepared('DROP TRIGGER tr_log');
    }
}
