<?php

use Illuminate\Database\Seeder;

class ScoreBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('scoreboard')->delete();
        DB::table('scoreboard')->insert(array(
        	array('rank'=>'1','score'=>'100','name'=>'YEE'),
        	array('rank'=>'2','score'=>'90','name'=>'YEE'),
        	array('rank'=>'3','score'=>'80','name'=>'YEE'),
        	array('rank'=>'4','score'=>'70','name'=>'YEE'),
        	array('rank'=>'5','score'=>'60','name'=>'YEE'),
        	array('rank'=>'6','score'=>'50','name'=>'YEE'),
        	array('rank'=>'7','score'=>'40','name'=>'YEE'),
        	array('rank'=>'8','score'=>'30','name'=>'YEE'),
        	array('rank'=>'9','score'=>'20','name'=>'YEE'),
        	array('rank'=>'10','score'=>'10','name'=>'YEE'),
        ));
    }
}
