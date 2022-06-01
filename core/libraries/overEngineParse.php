<?php

namespace Zero\libraries;

class overEngineParse
{
    protected function parseVariables($pageContent)
    {
        return preg_replace_callback("/{(.*?)}/", function ($match) {
            return "<?php echo " . trim($match[1]) . "?>";
        }, $pageContent);
    }
    protected function parseforeach($pageContent)
    {
        return preg_replace_callback("/@foreach\((.*?)\)/", function ($match) {
            return "<?php foreach(" . $match[1] . "):?>";
        }, $pageContent);
    }
    protected function parseEndforeach($pageContent)
    {
        return preg_replace_callback("/@endforeach/", function ($match) {
            return "<?php endforeach; ?>";
        }, $pageContent);
    }
    protected function parseIf($pageContent)
    {
        return preg_replace_callback("/@if\((.*?)\)/", function ($match) {
            return "<?php if($match[1]){ ?>";
        }, $pageContent);
    }
    protected function parseEndIf($pageContent)
    {
        return preg_replace_callback("/@endif/", function ($match) {
            return "<?php } ?>";
        }, $pageContent);
    }

    protected function render($view, $pageContent, $data)
    {
        extract($data);

        $cache = realpath(".") . "/cache/" . md5($view) . ".php";

        $pageContent = $this->parseVariables($pageContent);
        $pageContent = $this->parseforeach($pageContent);
        $pageContent = $this->parseEndforeach($pageContent);
        $pageContent = $this->parseIf($pageContent);
        $pageContent = $this->parseEndIf($pageContent);


        file_put_contents($cache, $pageContent);
        require_once $cache;
    }
}
