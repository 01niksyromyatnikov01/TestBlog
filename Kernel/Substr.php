<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 11.07.2018
 * Time: 16:37
 */

namespace Kernel;

class Substr {

    protected $string;


    function __construct($string,$length = 300)
    {
        return $this->substring($string,$length);
    }

    private function html_truncate($maxLength, $html){

        mb_internal_encoding("UTF-8");

        $printedLength = 0;
        $position = 0;
        $tags = array();

        ob_start();

        while ($printedLength < $maxLength && preg_match('{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;}', $html, $match, PREG_OFFSET_CAPTURE, $position)){

            list($tag, $tagPosition) = $match[0];

            // Print text leading up to the tag.

            $str = mb_strcut($html, $position, $tagPosition - $position);

            if ($printedLength + mb_strlen($str) > $maxLength){
                print(mb_strcut($str, 0, $maxLength - $printedLength));
                $printedLength = $maxLength;
                break;
            }

            print($str);
            $printedLength += mb_strlen($str);

            if ($tag[0] == '&'){
                // Handle the entity.
                print($tag);
                $printedLength++;
            }
            else{
                // Handle the tag.
                $tagName = $match[1][0];
                if ($tag[1] == '/'){
                    // This is a closing tag.

                    $openingTag = array_pop($tags);
                    assert($openingTag == $tagName); // check that tags are properly nested.

                    print($tag);
                }
                else if ($tag[mb_strlen($tag) - 2] == '/'){
                    // Self-closing tag.
                    print($tag);
                }
                else{
                    // Opening tag.
                    print($tag);
                    $tags[] = $tagName;
                }
            }

            // Continue after the tag.
            $position = $tagPosition + mb_strlen($tag);
        }



        // Print any remaining text.
        if ($printedLength < $maxLength && $position < mb_strlen($html))
            print(mb_strcut($html, $position, $maxLength - $printedLength));

        // Close any open tags.
        while (!empty($tags))
            printf('</%s>', array_pop($tags));


        $bufferOuput = ob_get_contents();

        ob_end_clean();

        $html = $bufferOuput;


        return $html;


    }


    public function substring($str,$length){
        $this->string = $this->html_truncate($length,$str);

    }

    function __toString()
    {
        return trim($this->string); // Remove </p> tag to add Read more on that line
    }

}