<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionCapFirst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = "CREATE FUNCTION CAP_FIRST_phuongnm (input VARCHAR(255), spec_char VARCHAR(1))
                  RETURNS VARCHAR(255)
                DETERMINISTIC
                  BEGIN
                    DECLARE len INT;
                    DECLARE i INT;
                    SET len   = CHAR_LENGTH(input);
                    SET input = LOWER(input);
                    SET i = 0;
                    WHILE (i < len) DO
                      IF (MID(input,i,1) = spec_char OR i = 0) THEN
                        IF (i < len) THEN
                          SET input = CONCAT(
                              LEFT(input,i),
                              UPPER(MID(input,i + 1,1)),
                              RIGHT(input,len - i - 1)
                          );
                        END IF;
                      END IF;
                      SET i = i + 1;
                    END WHILE;
                
                    RETURN input;
                  END;";
        DB::unprepared("DROP TRIGGER IF EXISTS CAP_FIRST_phuongnm");
        DB::unprepared($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::unprepared("DROP TRIGGER IF EXISTS CAP_FIRST_phuongnm");
    }
}
