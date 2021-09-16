<?php



namespace agli;



class Lorem
{



    private $words = ['optio','error','iste','doloribus','animi','vel','eius','tempore','blanditiis','laborum','neque','sit','maxime','nisi','qui','ratione','perferendis','rem','dolorem','ducimus','vero','modi','officiis','architecto','molestiae','facilis','obcaecati','atque','quam','veniam','ut','corporis','maiores','explicabo','consequatur','delectus','pariatur','voluptas','eos','totam','possimus','debitis','in','voluptatum','itaque','nesciunt','cumque','placeat','natus','dicta','nulla','ullam','deserunt','suscipit','quod','harum','deleniti','hic','asperiores','voluptatibus','repellendus','sed','officia','corrupti','praesentium','nobis','cupiditate','quaerat','sint','consectetur','labore','et','similique','aliquam','rerum','quas','vitae','id','distinctio','libero','soluta','quisquam','numquam','sequi','earum','est','impedit','autem','eligendi','nemo','ab','culpa','repudiandae','voluptate','minus','recusandae','ex','magni','perspiciatis','aspernatur','quae','inventore','odio','aut','facere','unde','cum','tempora','repellat','enim','velit','quasi','fuga','aliquid','iure','quia','necessitatibus','quos','a','reiciendis','ipsum','porro','nam','voluptates','quis','beatae','doloremque','amet','adipisci','molestias','illum','quibusdam','nihil','ad','minima','eveniet','fugit','nostrum','exercitationem','alias','quidem','provident','quo','laudantium','mollitia','dolor','sunt','illo','voluptatem','aperiam','consequuntur','iusto','accusamus','assumenda','commodi','dolorum','veritatis','incidunt','ea','ipsa','fugiat','accusantium','esse','dolores','tenetur','excepturi','at','eum','saepe','temporibus','eaque','laboriosam','dignissimos','sapiente','dolore','expedita','magnam','omnis','ipsam','odit','non','reprehenderit'];



    private $ponctuations = [',',',',',','?','?','.','.','.',';',':','!','!'];



    private $previousPonctuation = null;



    private $outputString = '';



    private function get_random_word()
    {
        return $this->words[rand(0,count($this->words) - 1)];
    }



    private function get_random_ponctuation()
    {
        $newPonctuation = $this->ponctuations[rand(0,count($this->ponctuations) - 1)];
        while($this->previousPonctuation === $newPonctuation)
        {
            $newPonctuation = $this->ponctuations[rand(0,count($this->ponctuations) - 1)];
        }
        $this->previousPonctuation = $newPonctuation;
        return $newPonctuation;
    }



    private function delete_space_char_ponct($string)
    {
        return preg_replace('#([a-z]) ([,?.!])#','$1$2',$string);
    }



    private function uppercase_after_ponct($string)
    {
        return preg_replace_callback('#([?.!]) ([a-z])#',function($matches)
        {
            return $matches[1] . ' ' . strtoupper($matches[2]);
        },$string);
    }



    private function ucfirst_end_ponctuation($string)
    {
        $endPonctuation = ['.','.','.','?','!'];
        return ucfirst($string) . $endPonctuation[rand(0,count($endPonctuation) - 1)];
    }



    private function tagify($string,$tag,$class = '')
    {
        if(!is_null($class))
        {
            $class = " class=\"$class\"";
        }
        return "<$tag$class>$string</$tag>";
    }



    private function return_random_words_array($arr,$howMany)
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



    private function turn_into_sentence($wordsArray)
    {
        $outputString = '';
        $outputString = implode(' ',$wordsArray);
        $outputString = $this->delete_space_char_ponct($outputString);
        $outputString = $this->uppercase_after_ponct($outputString);
        $outputString = $this->ucfirst_end_ponctuation($outputString);
        return $outputString;
    }



    public function __construct()
    {
        // ...Gold
    }



    public function words($howMany = 15,$tag = null,$class = '')
    {
        $outputArray = [];

        $outputArray = $this->return_random_words_array($outputArray,$howMany);

        $outputString = $this->turn_into_sentence($outputArray);

        if(!is_null($tag))
        {
            $outputString = $this->tagify($outputString,$tag,$class);
        }

        $this->outputString = $outputString;
        return $outputString;
    }



    public function lorem($howMany = 15,$tag = null,$class = '')
    {
        $outputArray = ['lorem','ipsum','dolor','sit','amet'];
        $howMany -= count($outputArray);

        $outputArray = $this->return_random_words_array($outputArray,$howMany);

        $outputString = $this->turn_into_sentence($outputArray);

        if(!is_null($tag))
        {
            $outputString = $this->tagify($outputString,$tag,$class);
        }
        
        $this->outputString = $outputString;
        return $outputString;
    }



}
