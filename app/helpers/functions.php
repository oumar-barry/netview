<?php 

  
    
    /**
     * echap
     *
	 *	Cette fonction permet d'échaper les caractères pour eviter 
	 * les injections de balises 
     */
    function echap($string){
        return htmlspecialchars($string);
    }

    function is_empty($fields = []){
        if(count($fields) != 0){
            foreach($fields as $field){
                if(!empty($field)){
                    return false;
                }
            }

            return true;

        }
    }


   

   









?>