<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bookdetail_id');
            $table->foreign('bookdetail_id')->references('id')->on('book_details')->onDelete('cascade');

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->dateTime('borrow_date');
            $table->dateTime('due_date');
            $table->boolean('returned');
            $table->dateTime('return_date');
            $table->unsignedBigInteger('issued_by');
            $table->foreign('issued_by')->references('id')->on('users')->onDelete('cascade');

            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrows');
    }
}
