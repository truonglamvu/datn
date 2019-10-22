<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionSlugify extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $query = "CREATE FUNCTION slugify_phuongnm (str text, f_char VARCHAR(1), t_char VARCHAR(1), is_lower BOOLEAN, cap_first BOOLEAN) returns text
                  BEGIN
                    DECLARE len, i INTEGER;
                    DECLARE codau,kdau,dup_char VARCHAR(255);
                    IF is_lower Then
                      SET str = lower(str);
                    END IF;
                    SET codau = 'áàảãạâấầẩẫậăắằẳẵặđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵ\#$%&/¿?¡!¬|@~«<{[()]}>»·*+=.,;:ªº^°\"''''`´‘’”“';
                    SET kdau =  'aaaaaaaaaaaaaaaaadeeeeeeeeeeeiiiiiooooooooooooooooouuuuuuuuuuuyyyyy                                                ';
                    SET len = CHAR_LENGTH(codau);
                    SET i = 1;
                
                    WHILE len >= i  DO
                      SET str = replace(str, substr(codau,i,1), substr(kdau,i,1));
                      SET i = i + 1;
                    END WHILE;
                    SET str = REPLACE(
                        REPLACE(
                            str
                            ,f_char
                            ,t_char
                        )
                        , ' '
                        , t_char
                    );
                    SET dup_char = Concat(t_char,t_char);
                
                    IF substr(str,1,1) = t_char Then
                      SET str = right(str, CHAR_LENGTH(str) - 1);
                    END IF;
                    IF substr(str,CHAR_LENGTH(str),1) = t_char Then
                      SET str = left(str, CHAR_LENGTH(str) - 1);
                    END IF;
                    IF cap_first Then
                      SET str = CAP_FIRST_phuongnm(str, t_char);
                    END IF;
                    RETURN str;
                  END;";
        DB::unprepared("DROP TRIGGER IF EXISTS slugify_phuongnm");
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
        DB::unprepared("DROP TRIGGER IF EXISTS slugify_phuongnm");
    }
}
