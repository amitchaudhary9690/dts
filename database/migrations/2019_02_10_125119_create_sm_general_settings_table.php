<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_general_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school_name')->nullable();
            $table->string('site_title')->nullable();
            $table->string('school_code')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('currency')->nullable()->default('NPR');
            $table->string('currency_symbol')->nullable()->default('$');
            $table->integer('promotionSetting')->nullable()->default(0);
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('system_version')->nullable()->default('4.4');
            $table->integer('active_status')->nullable()->default(1);
            $table->string('currency_code')->nullable()->default('NPR');
            $table->string('language_name')->nullable()->default('en');
            $table->string('session_year')->nullable()->default('2019');
            $table->string('system_purchase_code')->nullable();
            $table->date('system_activated_date')->nullable();
            $table->string('envato_user')->nullable();
            $table->string('envato_item_id')->nullable();
            $table->string('system_domain')->nullable();
            $table->string('copyright_text')->nullable();
            $table->integer('api_url')->default(1);
            $table->integer('website_btn')->default(1);
            $table->integer('dashboard_btn')->default(1);
            $table->integer('report_btn')->default(1);
            $table->integer('style_btn')->default(1);
            $table->integer('ltl_rtl_btn')->default(1);
            $table->integer('lang_btn')->default(1);
            $table->string('website_url')->nullable();
            $table->integer('ttl_rtl')->default(2);
            $table->integer('phone_number_privacy')->default(1)->comments('1=enable, 0=disable');
            $table->timestamps();
            $table->integer('time_zone_id')->nullable();
            $table->integer('session_id')->nullable()->unsigned();
            $table->foreign('session_id')->references('id')->on('sm_academic_years')->onDelete('cascade');

            $table->integer('language_id')->nullable()->default(1)->unsigned();
            $table->foreign('language_id')->references('id')->on('sm_languages')->onDelete('cascade');

            $table->integer('date_format_id')->nullable()->default(1)->unsigned();
            $table->foreign('date_format_id')->references('id')->on('sm_date_formats')->onDelete('cascade');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('cascade');
            $table->string('software_version', 100)->nullable();




            $table->integer('FeesCollection')->default(0)->nullable();
            $table->integer('InfixBiometrics')->default(0)->nullable();
            $table->integer('ResultReports')->default(0)->nullable();
            $table->integer('TemplateSettings')->default(1)->nullable();
            $table->integer('RolePermission')->default(1)->nullable();
            $table->integer('RazorPay')->default(0)->nullable();
            $table->integer('Saas')->default(0)->nullable();
            $table->integer('ParentRegistration')->default(0)->nullable();
            $table->integer('Zoom')->default(0)->nullable();
            $table->integer('SaasSubscription')->default(0)->nullable();

            $table->integer('academic_id')->nullable()->default(1)->unsigned();
            $table->foreign('academic_id')->references('id')->on('sm_academic_years')->onDelete('cascade');
        });




        DB::table('sm_general_settings')->insert([
            [
                'copyright_text' => 'Copyright &copy; 2021 All rights reserved | This application is made by Digital TechnoSoft Pvt. Ltd.',
                'logo' => 'public/uploads/settings/logo.png',
                'favicon' => 'public/uploads/settings/favicon.png',
                'phone' => '+977-9810200907',
                'school_code' => '12345678',
                'email' => 'info@digitaltechnosoft.com.np',
                'address' => 'Jeetpursimara-02, Simara, Bara, Nepal',
                'currency' => 'NPR',
                'currency_symbol' => 'Rs',
                'school_name' => 'Digital Academic ERP',
                'site_title' => 'Digital TechnoSoft',
                'session_id' => 1,
                'time_zone_id' => 278,
                'software_version' => '5',
                'system_activated_date' => date('Y-m-d'),
                'system_domain' => url('/')
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_general_settings');
    }
}
