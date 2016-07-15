<?php
/**
 * SimpleParser.php
 */

namespace Sufir;

/**
 * SimpleParser
 *
 * Description of SimpleParser
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package Sufir
 */
class SimpleParser implements ParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function calcWords($html)
    {
        $js = '/<script[^>]*?>.*?<\/script>/si';
        $spaces = '/\s\s+/';

        $pattern = [
            '/<script[^>]*?>.*?<\/script>/si',
            '/\s\s+/',
        ];
        $replacement = [
            '',
            ' ',
        ];

        $text = html_entity_decode(
            strip_tags(
                preg_replace($pattern, $replacement, $html)
            )
        );

        preg_match_all('/([-+]?([0-9]*[,\.][0-9]+|[0-9]+))|(\w{2,})/iu', $text, $words);

        $counts = array_count_values($words[0]);
        arsort($counts);

        return $counts;
    }

    /**
     * {@inheritdoc}
     */
    public function findImages($html)
    {
        return $this->findProp($html, 'img', 'src');
    }

    /**
     * {@inheritdoc}
     */
    public function findLinks($html)
    {
        return $this->findProp($html, 'a', 'href');
    }

    /**
     * @param string $html
     * @param string $tag
     * @param string $prop
     * @return array
     */
    protected function findProp($html, $tag, $prop)
    {
        $pattern = '/<' . $tag . ' [^<>]*' . $prop . '=[\'"]([^\'"]+)[\'"][^<>]*>?/si';
        preg_match_all($pattern, $html, $matches);

        $result = [];
        foreach ($matches[1] as $url) {
            $result[] = html_entity_decode($url);
        }

        return array_unique($result);
    }
}
