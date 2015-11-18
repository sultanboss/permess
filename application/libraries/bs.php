<?php
/**
 * Description of BhuiyanSoft
 * @author BhuiyanSoft
 */
class bs{
    public function search($array, $key, $value)
        {
        $results = array();
        if (is_array($array)) 
        {
            if (isset($array[$key]) && $array[$key] == $value)
            {
                $results[] = $array;
            }
            foreach ($array as $subarray) 
            {
                $results = array_merge($results, $this->search($subarray, $key, $value));
            }
        }
        return $results;
        }    
}
