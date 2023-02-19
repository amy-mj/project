<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function(Blueprint $table) {
            $table->charset     = 'utf8mb4';
            $table->collation   = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('userid'         , 50)->comment('아이디');
            $table->string('name'           , 50)->comment('이름');
            $table->string('password'       , 100)->comment('비밀번호');
            $table->string('email'          , 100)->nullable()->comment('이메일');
            $table->string('phone'          , 15)->nullable()->comment('휴대폰번호');
            $table->string('address'        , 255)->nullable()->comment('주소');
            $table->string('detail_address' , 255)->nullable()->comment('상세주소');
            $table->string('zipcode'        , 8)->nullable()->comment('우편번호');
            $table->string('birthday'       , 8)->nullable()->comment('생년월일');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('member');
    }
}
