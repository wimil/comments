<?php

namespace Wimil\Comments\Helpers;


class FilterWords
{
    private $blacklist;
    protected $wasFiltered = false;
    protected $filterChecks = [];
    protected $filteredStrings = [];


    public function __construct()
    {
        $this->blacklist = config('comments.blacklist');

        $this->generateFilterChecks();

        //$this->test = $this->filterChecks;
    }

    //ifltro
    public function filter($string)
    {
        $this->filterString($string);
        return $this->wasFiltered;
        //var_dump();
    }

    //buscamos en el string origianl y comparamos si existe alguna palabra prohibida
    private function filterString($string)
    {
        if (!empty($this->filterChecks)) {
            foreach ($this->filterChecks as $regex) {
                preg_match($regex, $string, $match);
                if (!empty($match)) {
                    if (!$this->wasFiltered) {
                        $this->wasFiltered = true;
                        return;
                    }
                }
            }
        }
    }

    //generar verificaciones de filtro
    private function generateFilterChecks()
    {
        foreach ($this->blacklist as $lockedWord) {
            $this->filterChecks[] = $this->getFilterRegexp($lockedWord);
        }
    }

    //crea el regexp segun la lista de palabras bloqueadas
    private function getFilterRegexp($lockedWord)
    {
        $ex = explode('.*', $lockedWord);
        $regex = "";
        if (count($ex) == 2) {
            $regex = empty($ex[0]) ? '/.*' . $ex[1] . '\b/' : '/\b' . $ex[0] . '\.*/';
        } elseif (count($ex) == 3) {
            $regex = '/\.*' . $ex[1] . '\.*/';
        } else {
            $regex = '/\b' . $ex[0] . '\b/';
        }

        return $regex . 'ui';
    }
}
