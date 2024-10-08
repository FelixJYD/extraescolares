<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('students', function (Blueprint $table) {
			$table->id();
			$table->string('inscription_code');
			$table->string('university_enrollment')->nullable();
			$table->string('name');
			$table->string('gender')->max(1);
			$table->foreignId('career_id')
				->constrained('careers')
				->cascadeOnDelete();
			$table->foreignId('activity_id')
				->constrained('activities')
				->cascadeOnDelete();
			$table->foreignId('period_id')
				->constrained('periods')
				->cascadeOnDelete();
			$table->string('illnes');
			$table->longText('observations')->nullable();
			$table->json('grades')->default(
				json_encode([
					'first_criteria' => "0",
					'second_criteria' => "0",
					'third_criteria' => "0",
					'fourth_criteria' => "0",
					'fifth_criteria' => "0",
					'sixth_criteria' => "0",
					'seventh_criteria' => "0",
				])
			);
			$table->boolean('first_validation')->default(false);
			$table->boolean('second_validation')->default(false);
			$table->string('validated_by')->nullable();
			$table->timestamp('validated_at')->nullable();
			$table->string('validation_token', 32)->nullable()->unique();
			$table->boolean('certificate_downloaded')->default(false);
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('students');
	}
};
