<?php
/**
 * File for PostgreSql Database Expression class
 */

namespace Cayman\Manager\DbExpression;

use Cayman\Manager\DbExpression;

/**
 * Class for PostgreSql Database Expression
 *
 */
class PostgreSql extends DbExpression
{
    
    /**
     * New expression for current date and time
     * 
     * @see http://www.postgresql.org/docs/9.5/static/functions-datetime.html
     * 
     * @return DbExpression
     */
    static function now()
    {
        $exp = new static('NOW()');
        return $exp;
    }
    
    /**
     * New expression for current date and time
     * 
     * @see http://www.postgresql.org/docs/9.5/static/functions-datetime.html
     * 
     * @return DbExpression
     */
    static function currentDate()
    {
        $exp = new static('CURRENT_DATE');
        return $exp;
    }
    
    /**
     * New expression for current date and time
     * 
     * @see http://www.postgresql.org/docs/9.5/static/functions-datetime.html
     * 
     * @return DbExpression
     */
    static function currentTime()
    {
        $exp = new static('CURRENT_TIME');
        return $exp;
    }
    
    /**
     * New expression for current timestamp
     * 
     * @see http://www.postgresql.org/docs/9.5/static/functions-datetime.html
     * 
     * @return DbExpression
     */
    static function currentTimestamp()
    {
        $exp = new static('CURRENT_TIMESTAMP');
        return $exp;
    }
    
    /**
     * New expression for current timestamp
     * 
     * @see http://www.postgresql.org/docs/9.5/static/functions-datetime.html
     * 
     * @return DbExpression
     */
    static function statementTimestamp()
    {
        $exp = new static('STATEMENT_TIMESTAMP()');
        return $exp;
    }
    
    /**
     * New expression for current date and time
     * 
     * @see http://www.postgresql.org/docs/9.5/static/functions-datetime.html
     * 
     * @param string $minutes
     * @return DbExpression
     */
    static function nowPlusMinutes($minutes)
    {
        $expStr = sprintf('NOW() + INTERVAL \'%d MINUTE\'', intval($minutes));
        $exp    = new static($expStr);
        return $exp;
    }
}
