<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise', function (Blueprint $table) {
            $table->id();
            
            $table->string('name', 60)->unique();
            $table->string('phone', 15);
            $table->string('contactperson', 100);
            $table->text('address');
            $table->string('taxnumber', 20);

            $table->timestamps();
            /*
            CREATE TRIGGER pre_enterprise_insert
            BEFORE INSERT ON enterprise FOR EACH ROW
            SET NEW.name = ucase(NEW.name);
            */
        });
        DB::unprepared('create trigger pre_enterprise_insert
                        before insert on enterprise for each row
                        set new.name = ucase(new.name)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enterprise');
    }
}
