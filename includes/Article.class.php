
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Article
{
    
    private $allArticleList = array();


    function __construct($jasonFilePath = '')
    {   
        if (file_exists($jasonFilePath)) {  
            $jasonString = file_get_contents($jasonFilePath);

            
            $jsonObject = json_decode($jasonString);

            
            if (is_array($jsonObject->articles)) {  
                $this->allArticleList = $jsonObject->articles;
            }
        
            else { 
                echo '<p>WARNING: The Article appear to be malformed!</p>';
            }
        }
        
        else { 
            echo '<p>WARNING: Your file doesn\'t exist!</p>';
        }
    }


    public function output()
    { 
        if (is_array($this->allArticleList) && !empty($this->allArticleList)) { 
            echo '<h2>Article List</h2><ul>';
        
            foreach ($this->allArticleList as $i) { 
                $newArticle = new Article($i->id, $i->title, $i->content);
            
                echo '<li>' . $newArticle->output(FALSE) . '</li>';
            } 
            echo '</ul>';
        }
    }
}


