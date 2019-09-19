<?php

namespace Wimil\Comments\Helpers;

class FilterLinks
{
    //private $enable;
    private $limit;
    private $totalLinks;
    private $filterRegexp;
    protected $wasFiltered = false;

    public function __construct()
    {
        //$config = config('comments.rules.links');

        //$this->enable = $config['enable'];
        $this->limit = config('comments.rules.links.limit');

        $this->initFilter();
    }

    private function initFilter()
    {
        $this->getFilterRegexp();
    }

    public function filter($string)
    {
        $this->filterLinks($string);

        //var_dump($this->wasFiltered);
        return $this->wasFiltered;
    }

    private function filterLinks($string)
    {
        preg_match_all($this->filterRegexp, $string, $match);
        if (!empty($match[0])) {
            $count = count($match[0]);
            if ($count > $this->limit) {
                $this->totalLinks = $count;
                $this->wasFiltered = true;
            }
        }
    }

    private function getFilterRegexp()
    {
        //obtiene urls completas
        $this->filterRegexp = '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#i';

        //
    }
}
