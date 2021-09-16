<?php



namespace agli;



class Lorem
{


    
    /**
     * words
     * 
     * The Lorem words randomly picked to generate sentences.
     *
     * @var array
     */
    private $words = ['optio','error','iste','doloribus','animi','vel','eius','tempore','blanditiis','laborum','neque','sit','maxime','nisi','qui','ratione','perferendis','rem','dolorem','ducimus','vero','modi','officiis','architecto','molestiae','facilis','obcaecati','atque','quam','veniam','ut','corporis','maiores','explicabo','consequatur','delectus','pariatur','voluptas','eos','totam','possimus','debitis','in','voluptatum','itaque','nesciunt','cumque','placeat','natus','dicta','nulla','ullam','deserunt','suscipit','quod','harum','deleniti','hic','asperiores','voluptatibus','repellendus','sed','officia','corrupti','praesentium','nobis','cupiditate','quaerat','sint','consectetur','labore','et','similique','aliquam','rerum','quas','vitae','id','distinctio','libero','soluta','quisquam','numquam','sequi','earum','est','impedit','autem','eligendi','nemo','ab','culpa','repudiandae','voluptate','minus','recusandae','ex','magni','perspiciatis','aspernatur','quae','inventore','odio','aut','facere','unde','cum','tempora','repellat','enim','velit','quasi','fuga','aliquid','iure','quia','necessitatibus','quos','a','reiciendis','ipsum','porro','nam','voluptates','quis','beatae','doloremque','amet','adipisci','molestias','illum','quibusdam','nihil','ad','minima','eveniet','fugit','nostrum','exercitationem','alias','quidem','provident','quo','laudantium','mollitia','dolor','sunt','illo','voluptatem','aperiam','consequuntur','iusto','accusamus','assumenda','commodi','dolorum','veritatis','incidunt','ea','ipsa','fugiat','accusantium','esse','dolores','tenetur','excepturi','at','eum','saepe','temporibus','eaque','laboriosam','dignissimos','sapiente','dolore','expedita','magnam','omnis','ipsam','odit','non','reprehenderit'];


    
    /**
     * ponctuations
     * 
     * Ponctuations randomly added to the Lorem words.
     * Some characters are duplicated to add chances to appear.
     *
     * @var array
     */
    private $ponctuations = [',',',',',','?','?','.','.','.',';',':','!','!'];


        
    /**
     * previousPonctuation
     * 
     * The ponctuation previously picked : allows to avoid picking the same ponctuation.
     *
     * @var string
     */
    private $previousPonctuation = null;


    
    /**
     * get_random_word
     * 
     * Return a random Lorem word from the $words private propertie.
     *
     * @return string
     */
    private function get_random_word() :string
    {
        return $this->words[rand(0,count($this->words) - 1)];
    }


    
    /**
     * get_random_ponctuation
     * 
     * Return a random ponctuation character as long as it's different from the previous one
     * stored in the $previousPonctuation private propertie.
     *
     * @return string
     */
    private function get_random_ponctuation() :string
    {
        $newPonctuation = $this->ponctuations[rand(0,count($this->ponctuations) - 1)];
        while($this->previousPonctuation === $newPonctuation)
        {
            $newPonctuation = $this->ponctuations[rand(0,count($this->ponctuations) - 1)];
        }
        $this->previousPonctuation = $newPonctuation;
        return $newPonctuation;
    }


    
    /**
     * delete_space_char_ponct
     * 
     * Get rid of space between a alpha character and a ponctuation character (only ,?.!) inside $string.
     *
     * @param  string $string The string in which the changes occure
     * @return string
     */
    private function delete_space_char_ponct(string $string) :string
    {
        return preg_replace('#([a-z]) ([,?.!])#','$1$2',$string);
    }


    
    /**
     * uppercase_after_ponct
     * 
     * Turn lowercase alpha character following a ponctuation character (only ?.!)
     * into a uppercase character inside $string.
     *
     * @param  string $string The string in which the changes occure
     * @return string
     */
    private function uppercase_after_ponct(string $string) :string
    {
        return preg_replace_callback('#([?.!]) ([a-z])#',function($matches)
        {
            return $matches[1] . ' ' . strtoupper($matches[2]);
        },$string);
    }


    
    /**
     * ucfirst_end_ponctuation
     * 
     * Add a uppercase at the beginning of string, and a ponctuation character (only .?!) at the end.
     *
     * @param  string $string The string in which the changes occure
     * @return string
     */
    private function ucfirst_end_ponctuation(string $string) :string
    {
        $endPonctuation = ['.','.','.','?','!'];
        return ucfirst($string) . $endPonctuation[rand(0,count($endPonctuation) - 1)];
    }


    
    /**
     * wrap_with_tag
     * 
     * Return $string surrounded by a $tag HTML tag.
     *
     * @param  string $string The string to wrap
     * @param  string $tag String indicating the tag
     * @param  string $class A class to eventualy add to the tag
     * @return string
     */
    private function wrap_with_tag(string $string,string $tag,string $class = '') :string
    {
        if(!is_null($class))
        {
            $class = " class=\"$class\"";
        }
        return "<$tag$class>$string</$tag>";
    }


    
    /**
     * return_random_words_array
     * 
     * Add $howMany Lorem words to the $arr array.
     *
     * @param  mixed $arr The array in which the Lorem words are added
     * @param  mixed $howMany The number of words to add
     * @return array
     */
    private function return_random_words_array(array $arr,int $howMany) :array
    {
        $ponctuationsCounter = 0;
        for($i = 1; $i <= $howMany;$i++)
        {
            $ponctuationsCounter++;
            if($ponctuationsCounter > 1)
            {
                $ponctuationsCounter = 0;
                $randomNumber = rand(1,1000);
                if($randomNumber > 750)
                {
                    $arr[] = $this->get_random_ponctuation();
                }
            }
            $arr[] = $this->get_random_word();
        }
        return $arr;
    }


    
    /**
     * turn_into_sentence
     * 
     * Turn the $wordsArray array into a string sentence.
     *
     * @param  mixed $wordsArray The array to turn into string sentence
     * @return string
     */
    private function turn_into_sentence(array $wordsArray) :string
    {
        $outputString = '';
        $outputString = implode(' ',$wordsArray);
        $outputString = $this->delete_space_char_ponct($outputString);
        $outputString = $this->uppercase_after_ponct($outputString);
        $outputString = $this->ucfirst_end_ponctuation($outputString);
        return $outputString;
    }


    
    /**
     * __construct
     * 
     * Nothing in here
     *
     * @return void
     */
    public function __construct()
    {
        // ...Gold
    }


    
    /**
     * words
     * 
     * Return a string of $howMany words.
     * Add random ponctuations.
     *
     * @param  int $howMany How many words wanted
     * @param  string $tag HTML tag(s) eventualy wrapping the string result
     * @param  string $class Class(es) to add to the wrapping tag(s)
     * @return string
     */
    public function words(int $howMany = 15,string $tag = null,string $class = '') :string
    {
        $outputArray = [];

        $outputArray = $this->return_random_words_array($outputArray,$howMany);

        $outputString = $this->turn_into_sentence($outputArray);

        if(!is_null($tag))
        {
            $outputString = $this->wrap_with_tag($outputString,$tag,$class);
        }

        $this->outputString = $outputString;
        return $outputString;
    }


        
    /**
     * lorem
     * 
     * Return a string of $howMany - 5 words, beginning by 'Lorem ipsum dolor sit amet'.
     * Add random ponctuations.
     *
     * @param  int $howMany How many words wanted
     * @param  string $tag HTML tag(s) eventualy wrapping the string result
     * @param  string $class Class(es) to add to the wrapping tag(s)
     * @return string
     */
    public function lorem(int $howMany = 15,string $tag = null,string $class = ''): string
    {
        $outputArray = ['lorem','ipsum','dolor','sit','amet'];
        $howMany -= count($outputArray);

        $outputArray = $this->return_random_words_array($outputArray,$howMany);

        $outputString = $this->turn_into_sentence($outputArray);

        if(!is_null($tag))
        {
            $outputString = $this->wrap_with_tag($outputString,$tag,$class);
        }
        
        return $outputString;
    }



}
