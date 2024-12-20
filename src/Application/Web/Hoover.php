<?php

namespace Application\Web;

use DOMDocument;

class Hoover
{
    private ?DOMDocument $content = NULL;

    public function getContent($url): DOMDocument
    {
        if (!$this->content) {
            // stripos 查找字符串首次出现的位置
            // 此处用于判断 url 是否以 http 开头
            if (stripos($url, 'http') !== 0) {
                $url = 'http://' . $url;
            }
            $this->content                     = new DOMDocument('1.0', 'utf-8');
            $this->content->preserveWhiteSpace = FALSE;
            @$this->content->loadHTMLFile($url);
        }
        return $this->content;
    }

    public function getTags($url, $tag): array
    {
        $count    = 0;
        $result   = [];
        $elements = $this->getContent($url)->getElementsByTagName($tag);
        foreach ($elements as $node) {
            $result[$count]['value'] = trim(preg_replace('/\s+/', ' ', $node->nodeValue));
            if ($node->hasAttributes()) {
                foreach ($node->attributes as $name => $attr) {
                    $result[$count]['attributes'][$name] = $attr->value;
                }
            }
            $count++;
        }
        return $result;
    }

    public function getAttribute($url, $attr, $domain = NULL): array
    {
        $result   = [];
        $elements = $this->getContent($url)->getElementsByTagName('*');
        foreach ($elements as $node) {
            if ($node->hasAttribute($attr)) {
                $value = $node->getAttribute($attr);
                if ($domain) {
                    if (stripos($value, $domain) !== FALSE) {
                        $result[] = $value;
                    }
                } else {
                    $result[] = trim($value);
                }
            }
        }
        return $result;
    }
}